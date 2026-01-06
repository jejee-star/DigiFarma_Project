<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Apotek Digital" />
        <meta name="author" content="DigiFarma" />
        <title>DigiFarma - Apotek Digital Pilihan Semua</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <style>
            .card-img-top {
                height: 200px;
                object-fit: contain; 
                padding: 10px;
            }
        </style>
    </head>
    <body class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success bg-opacity-75">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand fw-bold" href="#!">DigiFarma</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" href="{{ route('store') }}">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('store') }}">Semua Produk</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex me-2">
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-light">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-light text-dark ms-1 rounded-pill">
                                @auth
                                    {{ \App\Models\Cart::where('user_id', Auth::id())->count() }}
                                @else
                                    0
                                @endauth
                            </span>
                        </a>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn btn-outline-light border-0" id="userDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi-person-fill"></i>
                                @auth {{ Auth::user()->name }} @endauth
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                @guest
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                    <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                                @endguest
                                
                                @auth
                                    @if(Auth::user()->role === 'admin')
                                        <li><a class="dropdown-item" href="{{ route('produk.index') }}">Dashboard Admin</a></li>
                                        <li><hr class="dropdown-divider" /></li>
                                    @endif
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                                        </form>
                                    </li>
                                @endauth
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <header class="bg-success bg-gradient bg-opacity-50 text-white py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center">
                    <h1 class="display-4 fw-bolder">Make Your Body Healthy</h1>
                    <p class="lead fw-normal text-white-50 mb-0">By Purchasing Quality Medicine</p>
                </div>
            </div>
        </header>
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h2 class="fw-bolder mb-4">Daftar Produk</h2>
                        <hr class="mx-auto" style="width: 100px; height: 3px; background-color: #198754;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @yield('content') 
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @if(isset($produks) && count($produks) > 0)
                        @foreach ($produks as $data)
                        <div class="col mb-5">
                            <div class="card h-100 shadow-sm border-0">
                                <img class="card-img-top" src="{{ asset('template/img/' . $data->gambar) }}" alt="{{ $data->nama_obat }}" />
                                
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <h5 class="fw-bolder">{{ $data->nama_obat }}</h5>
                                        <div class="text-success fw-bold mb-3">
                                            Rp {{ number_format($data->harga, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <form action="{{ route('cart.store', $data->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="produk_id" value="{{ $data->id }}">
                                            <div class="input-group mb-3 justify-content-center">
                                                <input type="number" name="jumlah" value="1" min="1" class="form-control text-center" style="max-width: 70px;">
                                            </div>
                                            <button type="submit" class="btn btn-outline-success mt-auto w-100">
                                                <i class="bi-cart-plus me-1"></i> Beli
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div> </div> </section>
        <footer class="py-5 bg-dark mt-auto">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; DigiFarma {{ date('Y') }}</p></div>
        </footer>
    </body>
</html>