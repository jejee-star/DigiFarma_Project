<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Validation\Rule;
class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['user','produk'])->latest()->get();
        
        return view('pages.pesanan.index', [
            'pesanans' => $pesanans, 
        ]);
    }

    public function create()
    {
        return view('pages.pesanan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gambar_obat' => ['required','image','mimes:jpeg,png,jpg','max:2048'],
            'nama_obat' => ['required', 'max:255'],
            'dosis' => ['required', 'max:30'],
            'jumlah' => ['required', 'max:30'],
            'harga' => ['required', 'max:50'],
            'status_pembayaran' => ['required', Rule::in(['belum bayar','lunas'])],
            'status_pesanan' => ['required', Rule::in(['Dikemas','Dikirim','Diterima'])],
        ]);
        if ($request->hasFile('gambar_obat') && $request->file('gambar_obat')->isValid()) {
        $validatedData['gambar_obat'] = $request->file('gambar_obat')->store('gambar_obat', 'public');
        }
        $produk = Produk::findOrFail($request->produk_id);
        if ($produk->stok < $request->jumlah) {
        return redirect()->back()->with('error', 'Maaf, stok obat tidak mencukupi!');
        }
         $produk->stok = $produk->stok - $request->jumlah;
        $produk->save();
        Pesanan::create($validatedData);
        
        return redirect('/pesanan')->with('success','Berhasil menambahkan!');
    }

    public function edit($id)
    {
        $pesanans = Pesanan::find($id);

        return view('pages.pesanan.edit',compact('pesanans'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_pasien' => ['required','max:255'],
            'gambar_obat' => ['nullable','image','max:2048'],
            'nama_obat' => ['required', 'max:255'],
            'jumlah' => ['required', 'numeric'],
            'total_harga' => ['required'],
            'status_pesanan' => ['required', Rule::in(['Dikemas','Dikirim','Diterima'])],
        ]);

        if ($request->hasFile('gambar_obat')) {
            $validatedData['gambar_obat'] = $request->file('gambar_obat')->store('gambar_obat', 'public');
        } else {
            unset($validatedData['gambar_obat']);
        }

        $hargaBersih = str_replace(['Rp','.',''],'',$request->harga);
        $validatedData['harga']= (int) $hargaBersih;

        Pesanan::findOrFail($id)->update($validatedData);

        return redirect('/pesanan')->with('success','Berhasil mengubah data!');
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();
        
        return redirect('/pesanan')->with('success'.'Berhasil menghapus!');
    }

    public function delete($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->gambar_obat && file_exists(storage_path('app/public/' . $pesanan->gambar_obat))) {
            unlink(storage_path('app/public/' . $pesanan->gambar_obat));
        }

        $pesanan-> delete();

        return redirect()->route('pesanan.index')->with('success','Data berhasil dihapus!');
    }
}
