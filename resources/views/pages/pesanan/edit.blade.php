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
                            <label for="alamat_pasien">Alamat Pasien</label>
                            <input type="text" inputmode="text" name="alamat_pasien" id="alamat_pasien" class="form-control" value="{{ old('alamat_pasien', $pesanans->alamat_pasien) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="gambar_obat">Gambar Obat</label>
                            <input type="file" name="gambar_obat" id="gambar_obat" class="form-control" value="{{ old('gambar_obat', $pesanans->gambar_obat)}}">  
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama_obat">Nama Obat</label>
                            <input type="text" inputmode="text" name="nama_obat" id="nama_obat" class="form-control" value="{{ old('nama_obat', $pesanans->nama_obat) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="dosis">Dosis</label>
                            <input type="text" inputmode="text" name="dosis" id="dosis" class="form-control" value="{{ old('dosis', $pesanans->dosis) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" inputmode="text" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah', $pesanans->jumlah) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga">Harga</label>
                            <input type="text" inputmode="text" name="harga" id="harga" class="form-control" value="{{ old('harga', $pesanans->harga) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="status_pembayaran">Status Pembayaran</label>
                            <select name="status_pembayaran" id="status_pembayaran" class="form-control" value="{{ old('status_pembayaran', $pesanans->status_pembayaran) }}">
                                <option value="belum bayar">Belum Bayar</option>
                                <option value="lunas">Lunas</option>
                            </select>
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