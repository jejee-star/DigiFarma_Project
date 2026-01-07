@extends ('layout.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Tambah Pesanan Obat</h1>
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
            <form action="{{ route('pesanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nama_pasien">Nama Pasien</label>
                            <input type="text" inputmode="text" name="nama_pasien" id="nama_pasien" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="gambar_obat">Gambar Obat</label>
                            <input type="file" name="gambar_obat" id="gambar_obat" class="form-control">  
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama_obat">Nama Obat</label>
                            <input type="text" inputmode="text" name="nama_obat" id="nama_pasien" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" inputmode="text" name="jumlah" id="jumlah" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="total_harga">Total Harga</label>
                            <input type="text" inputmode="text" name="total_harga" id="total_harga" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="status_pesanan">Status Pesanan</label>
                            <select name="status_pesanan" id="status_pesanan" class="form-control">
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
                            <button type="submit" class="btn btn-success">
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection