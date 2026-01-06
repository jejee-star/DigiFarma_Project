<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('produk')->get();
        
        return view('pages.cart.index', compact('carts'));
    }

    public function store(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cek_keranjang = Cart::where('user_id', Auth::id())
                                ->where('produk_id',$id)->first();
        if ($cek_keranjang) {
            $cek_keranjang->jumlah += $request->jumlah;
            $cek_keranjang->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'produk_id' => $id,
                'jumlah' => $request->jumlah ?? 1 
            ]);
        }
        return redirect()->route('cart.index')->with('success', 'Produk masuk keranjang!');
    }

    public function destroy($id)
    {
        Cart::destroy($id);
        return back()->with('success', 'Item dihapus dari keranjang.');
    }

    public function checkout()
    {
        $keranjang_user = Cart::where('user_id', Auth::id())->get();

        if($keranjang_user->isEmpty()) {
            return redirect()->back()->with('error','Keranjang kamu kosong!');
        }

        foreach ($keranjang_user as $data) {
            Pesanan::create([
                'user_id' => Auth::id(),
                'produk_id' => $data->produk_id,
                'jumlah'=>$data->jumlah,
                'total_harga' =>$data->produk->harga * $data->jumlah,
                'nama_pasien'=> Auth::user()->name,
                'nama_obat' => $data->produk->nama_obat,
                'status_pesanan' => 'dikemas',
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('store')->with('success','Pesanan berhasil dibuat!');
    }
}
