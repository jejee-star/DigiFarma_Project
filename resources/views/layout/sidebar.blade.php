<ul class="navbar-nav bg-gradient-success bg-opacity-50 sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand rounded-circle d-flex align-items-center" >
                    <div class="rounded-circle d-flex" style="width: 40px; height: 40px; overflow: hidden;">
                        <img src="{{ asset('template/img/logo_apotek.jpeg') }}">
                    </div>
                    <div class="sidebar-brand-text mx-3">DIGIFARMA</div>
                </div>
                
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Heading -->
             <div class="sidebar-heading">
               Manajemen Commerse
             </div>
            
             <!-- Nav Item Tables -->
             <li class="nav-item {{ request()->is('produk*')? 'active' :'' }} " >
                <a class="nav-link" href="/produk">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Daftar Obat</span>
                </a>
             </li>
            <!-- Nav Item Tables -->
             <li class="nav-item {{ request()->is('pesanan*')? 'active' :'' }} " >
                <a class="nav-link" href="/pesanan">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Pesanan Obat</span>
                </a>
             </li>

            <!--  Heading
             <div class="sidebar-heading">
               Manajemen Consultant
             </div>
            
            Nav Item Tables -->
             <!-- <li class="nav-item">
                <a class="nav-link" href="/konsultasi">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Jadwal Konsultasi Pasien</span>
                </a>
             </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>