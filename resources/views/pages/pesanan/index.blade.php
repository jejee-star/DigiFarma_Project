@extends('layout.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">DAFTAR PESANAN OBAT</h1>
        <a href="/pesanan/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i>Tambah</a>
    </div>

    <!-- Tables -->
     <div class="row">
        <div class="col">
            <div class="card shadow">
            <div class="card-body">
                <table class="table table-responsive table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>Nama Pasien</th>
                            <th>Alamat Pasien</th>
                            <th>Gambar Obat</th>
                            <th>Nama Obat</th>
                            <th>Dosis</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th>Aksi</th>               
                        </tr>
                    </thead>
                    @if (count($pesanans) < 1)
                        <tbody>
                            <tr>
                                <td colspan="10">
                                    <p class="text-center pt-3">Tidak ada pesanan</p>
                                </td>
                            </tr>
                        </tbody>
                    @else
                        <tbody>
                        @foreach ($pesanans as $data)
                        <tr>
                            <td>{{$data->nama_pasien}}</td>
                            <td>{{$data->alamat_pasien}}</td>
                            <td>
                                <img src="{{ asset('storage/' . $data->gambar) }}" alt="gambar_obat" width="100">
                            </td>
                            <td>{{$data->nama_obat}}</td>
                            <td>{{$data->dosis}}</td>
                            <td>{{$data->jumlah}}</td>
                            <td>{{$data->harga}}</td>
                            <td>{{$data->status_pembayaran}}</td>
                            <td>{{$data->status_pesanan}}</td>
                            <td>
                                <div class="d-flex g-2">
                                    <a href="{{ route('pesanan.edit', $data->id) }}" class="d-inline-block mr-2 btn btn-sm btn-warning">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationDelete-{{ $data->id }}">
                                         <i class="fas fa-eraser"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('pages.pesanan.confirmation-delete')
                        @endforeach
                    </tbody>       
                    @endif                
                </table>
            </div>
            </div>
        </div>
     </div>
@endsection