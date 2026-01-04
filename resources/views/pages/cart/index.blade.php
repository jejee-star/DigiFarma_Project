@extends('layout.store') @section('content')
<div class="container py-5">
    <h2 class="mb-4">Your Carts</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama_Obat</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total_bayar = 0; @endphp
                    @foreach ($carts as $data)
                    <tr>
                        <td>
                            <img src="{{ asset('template/img/' . $data->produk->gambar) }}" width="50">
                        </td>
                        <td>{{ $data->produk->nama_obat }}</td>
                        <td>Rp {{ number_format($data->produk->harga) }}</td>
                        <td>{{ $data->jumlah }}</td>
                        <td>
                            Rp {{ number_format($data->produk->harga * $data->jumlah) }}
                            @php $total_bayar += ($data->produk->harga * $data->jumlah); @endphp
                        </td>
                        <td>
                            <form action="{{ route('cart.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total Bayar:</th>
                        <th colspan="2">Rp {{ number_format($total_bayar) }}</th>
                    </tr>
                </tfoot>
            </table>

            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('store') }}" class="btn btn-secondary me-2">Belanja Lagi</a>
                <a href="#" class="btn btn-success">Checkout (Bayar)</a>
            </div>
        </div>
    </div>
</div>
@endsection