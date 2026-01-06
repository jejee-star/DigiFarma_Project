@extends ('layout.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Ubah Pesanan Obat</h1>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger" style="color: red; background: #ffeeee; padding: 10px; border: 1px solid red;">
        <strong>Ada kesalahan:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    
    <div class="row">
        <div class="col">
            <form action="{{ route('pesanan.update', $pesanans->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nama_pasien">Nama Pasien</label>
                            <input type="text" inputmode="text" name="nama_pasien" id="nama_pasien" class="form-control" value="{{ old('nama_pasien', $pesanans->nama_pasien) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="gambar_obat">Gambar Obat</label>
                            <div class="mb-2">
                                @if($pesanans->gambar_obat)
                                    <img src="{{ asset('storage/' . $pesanans->produk->gambar_obat) }}" alt="Gambar Obat" width="150" class="img-thumbnail">
                                @elseif($pesanans->produk && $pesanans->produk->gambar_obat)
                                    <img src="{{ asset('storage/' . $pesanans->produk->gambar_obat) }}" alt="Gambar Produk" width="150" class="img-thumbnail">
                                @else
                                    <p class="text-danger">Belum ada gambar</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama_obat">Nama Obat</label>
                            <input type="text" inputmode="text" name="nama_obat" id="nama_obat" class="form-control" value="{{ old('nama_obat', $pesanans->nama_obat) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" inputmode="text" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah', $pesanans->jumlah) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="total_harga">Harga</label>
                            <input type="text" inputmode="text" name="total_harga" id="total_harga" class="form-control" value="{{ old('harga', $pesanans->harga) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="status_pesanan">Status Pesanan</label>
                            <select name="status_pesanan" id="status_pesanan" class="form-control" value="{{ old('status_pesanan', $pesanans->status_pesanan) }}">
                                <option value="Dikemas">Dikemas</option>
                                <option value="Dikirim">Dikirim</option>
                                <option value="Diterima">Diterima</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end" style="gap: 10px;">
                            <a href="/pesanan" class="btn btn-outline-secondary">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-warning">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection