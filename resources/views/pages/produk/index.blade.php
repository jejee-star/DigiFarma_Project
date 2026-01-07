@extends('layout.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">DAFTAR OBAT</h1>
        <a href="/produk/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i>Tambah</a>
    </div>

    <!-- Tables -->
     <div class="row">
        <div class="col">
            <div class="card shadow">
            <div class="card-body">
                <table class="table table-responsive table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>Gambar Obat</th>
                            <th>Nama Obat</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>               
                        </tr>
                    </thead>
                    @if (count($produks) < 1)
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <p class="text-center pt-3">Tidak ada pesanan</p>
                                </td>
                            </tr>
                        </tbody>
                    @else
                        <tbody>
                        @foreach ($produks as $data)
                        <tr>
                            <td>
                                <img src="{{ asset('template/img/' . $data->gambar) }}" style="width: 120px; height: auto; object-fit: cover;">
                            </td>
                            <td>{{$data->nama_obat}}</td>
                            <td>Rp {{ number_format($data->harga) }}</td>
                            <td>{{ $data->stok }}</td>
                            <td>
                                <div class="d-flex g-2">
                                    <a href="{{ route('produk.edit', $data->id) }}" class="d-inline-block mr-2 btn btn-sm btn-warning">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationDelete-{{ $data->id }}">
                                         <i class="fas fa-eraser"></i>
                                    </button>                        
                                    @include('pages.produk.confirmation-delete')
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>       
                    @endif                
                </table>
            </div>
            </div>
        </div>
     </div>
@endsection