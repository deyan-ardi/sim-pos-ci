   <!-- [ navigation menu ] start -->
   <nav class="pcoded-navbar menupos-fixed menu-dark menu-item-icon-style6 ">
       <div class="navbar-wrapper ">
           <div class="navbar-brand header-logo">
               <a href="index-2.html" class="b-brand">
                   <img src="<?= base_url(); ?>/assets/images/logo.svg" alt="" class="logo images">
                   <img src="<?= base_url(); ?>/assets/images/logo-icon.svg" alt="" class="logo-thumb images">
               </a>
               <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
           </div>
           <div class="navbar-content scroll-div">
               <ul class="nav pcoded-inner-navbar mb-5">
                   <li class="nav-item pcoded-menu-caption">
                       <label>Main Menu</label>
                   </li>
                   <!--<li data-username="animations" class="nav-item"><a href="landing.html" class="nav-link"><span class="pcoded-micon"><i class="feather icon-aperture"></i></span><span class="pcoded-mtext">New front</span></a></li>-->
                   <li data-username="dashboard home page profile setting logout main" class="nav-item pcoded-hasmenu">
                       <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                   class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                       <ul class="pcoded-submenu">
                           <li class=""><a href="<?= base_url(); ?>/home-page" class="">Halaman Beranda</a></li>
                           <li class=""><a href="<?= base_url(); ?>/profile-setting" class="">Pengaturan Profil</a></li>
                           <li class=""><a href="<?= base_url(); ?>/logout" class="">Keluar</a></li>
                       </ul>
                   </li>
                   <li class="nav-item pcoded-menu-caption">
                       <label>Menu Supplier</label>
                   </li>
                   <li data-username="supplier items order report suppliers" class="nav-item pcoded-hasmenu">
                       <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                   class="feather icon-shopping-cart"></i></span><span class="pcoded-mtext">Manajemen
                               Supplier</span></a>
                       <ul class="pcoded-submenu">
                           <li class=""><a href="<?= base_url(); ?>/suppliers" class="">Data Supplier</a></li>
                           <li class=""><a href="<?= base_url(); ?>/suppliers/order-items" class="">Order Barang</a>
                           </li>
                       </ul>
                   </li>

                   <li class="nav-item pcoded-menu-caption">
                       <label>Menu Item Barang</label>
                   </li>
                   <li data-username="items item management categories" class="nav-item pcoded-hasmenu">
                       <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                   class="feather icon-box"></i></span><span class="pcoded-mtext">Manajemen
                               Barang</span></a>
                       <ul class="pcoded-submenu">
                           <li class=""><a href="<?= base_url(); ?>/categories" class="">Data Kategori Barang</a></li>
                           <li class=""><a href="<?= base_url(); ?>/items" class="">Data Barang</a></li>
                       </ul>
                   </li>

                   <li class="nav-item pcoded-menu-caption">
                       <label>Menu User Member</label>
                   </li>
                   <li data-username="user users admin atasan super kasir members member shop"
                       class="nav-item pcoded-hasmenu">
                       <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                   class="feather icon-users"></i></span><span class="pcoded-mtext">Manajemen User
                               Member</span></a>
                       <ul class="pcoded-submenu">
                           <li class=""><a href="<?= base_url(); ?>/members" class="">Data Member Toko</a></li>
                           <li class=""><a href="<?= base_url(); ?>/users" class="">Data User Sistem</a></li>
                       </ul>
                   </li>

                   <li class="nav-item pcoded-menu-caption">
                       <label>Menu Transaksi</label>
                   </li>
                   <li data-username="payment cashier report" class="nav-item pcoded-hasmenu">
                       <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                   class="feather icon-lock"></i></span><span class="pcoded-mtext">Manajemen
                               Transaksi</span></a>
                       <ul class="pcoded-submenu">
                           <li class=""><a href="<?= base_url(); ?>/transaction" class="">Sistem Kasir</a></li>
                           <li class=""><a href="<?= base_url(); ?>/transaction/report" class="">Laporan Transaksi</a>
                           </li>
                       </ul>
                   </li>
                   <li class="nav-item pcoded-menu-caption">
                       <label>Menu Laporan Keuangan</label>
                   </li>
                   <li data-username="financial report payment" class="nav-item"><a href="<?= base_url(); ?>/report"
                           class="nav-link"><span class="pcoded-micon"><i
                                   class="feather icon-file-text"></i></span><span class="pcoded-mtext">Data Laporan
                               Keuangan</span></a></li>
               </ul>
           </div>

       </div>
   </nav>
   <!-- [ navigation menu ] end -->