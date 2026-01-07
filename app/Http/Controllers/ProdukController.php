<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        
        return view('pages.produk.index', compact('produks')
        );
    }

    public function toko()
    {
        $produks = Produk::latest()->get();
        
        return view('layout.store', ['produks' => $produks]
        );
    }
    public function create()
    {
        return view('pages.produk.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gambar' => ['required','image','mimes:jpeg,png,jpg','max:2048'],
            'nama_obat' => ['required', 'max:255'],
            'harga' => ['required', 'max:50'],
            'stok' => ['required', Rule::in(['Tersedia','Habis'])],
        ]);
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time()."_". $file->getClientOriginaLName();
            $file->move(public_path('template/img'), $nama_file);
            $validatedData['gambar'] = $nama_file;
        } 
        
        Produk::create($validatedData);
        
        return redirect()->route('produk.index')->with('success','Berhasil menambahkan!');
    }

    public function edit($id)
    {
        $produks = Produk::find($id);

        return view('pages.produk.edit',compact('produks'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'gambar_obat' => ['nullable','image','mimes:jpeg,png,jpg','max:2048'],
            'nama_obat' => ['required', 'max:255'],
            'harga' => ['required', 'max:50'],
            'stok' => ['required', Rule::in(['Tersedia','Habis'])],
        ]);

        if ($request->hasFile('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('gambar', 'public/template/img');
        } else {
            unset($validatedData['gambar']);
        }

        $hargaBersih = str_replace(['Rp','.',''],'',$request->harga);
        $validatedData['harga']= (int) $hargaBersih;

        Produk::findOrFail($id)->update($validatedData);

        return redirect('/produk')->with('success','Berhasil mengubah data!');
    }

    public function destroy($id)
    {
        $produks = Produk::findOrFail($id);
        $produks->delete();
        
        return redirect('/produk')->with('success'.'Berhasil menghapus!');
    }

    public function delete($id)
    {
        $produks = Produk::findOrFail($id);

        if ($produks->gambar && file_exists(storage_path('app/public/template/img' . $produks->gambar))) {
            unlink(storage_path('app/public/template/img' . $produks->gambar));
        }

        $produks-> delete();

        return redirect()->route('produk.index')->with('success','Data berhasil dihapus!');
    }
}
