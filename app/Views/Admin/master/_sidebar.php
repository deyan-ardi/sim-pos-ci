   <!-- [ navigation menu ] start -->
   <nav class="pcoded-navbar menupos-fixed menu-dark menu-item-icon-style6 ">
       <div class="navbar-wrapper ">
           <div class="navbar-brand header-logo">
               <a href="<?= base_url(); ?>" class="b-brand">
                   <img src="<?= base_url(); ?>/logo-white.png" width="30%" alt="" class="logo images">
                   <img src="<?= base_url(); ?>/logo-white.png" width="50%" alt="" class="logo-thumb images">
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
                       <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                       <ul class="pcoded-submenu">
                           <li class=""><a href="<?= base_url(); ?>/home-page" class="">Halaman Beranda</a></li>
                           <li class=""><a href="<?= base_url(); ?>/profile-setting" class="">Pengaturan Profil</a></li>
                           <li class=""><a href="<?= base_url(); ?>/logout" class="">Keluar</a></li>
                       </ul>
                   </li>
                   <?php if (in_groups('SUPER ADMIN') || in_groups('MARKETING')) : ?>
                       <li class="nav-item pcoded-menu-caption">
                           <label>Menu Marketing</label>
                       </li>
                       <li data-username="marketing items order report suppliers" class="nav-item pcoded-hasmenu">
                           <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-percent"></i></span><span class="pcoded-mtext">Manajemen Marketing</span></a>
                           <ul class="pcoded-submenu">
                               <li class=""><a href="<?= base_url(); ?>/marketing" class="">Data Barang</a></li>
                               <li class=""><a href="<?= base_url(); ?>/marketing/order-items" class="">Request Order Barang</a>
                               </li>
                               <li class=""><a href="<?= base_url(); ?>/marketing/view-orders" class="">Daftar Order Barang</a>
                               </li>
                           </ul>
                       </li>
                   <?php endif; ?>
                   <?php if (in_groups('SUPER ADMIN') || in_groups('GUDANG') || in_groups('PURCHASING')) : ?>
                       <li class="nav-item pcoded-menu-caption">
                           <label>Menu Supplier</label>
                       </li>
                       <li data-username="supplier items order report suppliers" class="nav-item pcoded-hasmenu">
                           <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span><span class="pcoded-mtext">Manajemen
                                   Supplier</span></a>
                           <ul class="pcoded-submenu">
                               <?php if (in_groups('SUPER ADMIN') || in_groups('PURCHASING')) : ?>
                                   <li class=""><a href="<?= base_url(); ?>/suppliers" class="">Data Supplier</a></li>
                                   <li class=""><a href="<?= base_url(); ?>/suppliers/view-orders" class="">Daftar Permintaan Order</a>
                                   </li>
                               <?php endif; ?>
                               <li class=""><a href="<?= base_url(); ?>/suppliers/order-items" class="">Order Barang</a>
                               </li>
                           </ul>
                       </li>
                       <li class="nav-item pcoded-menu-caption">
                           <label>Menu Item Barang</label>
                       </li>
                       <li data-username="items item management categories" class="nav-item pcoded-hasmenu">
                           <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Manajemen
                                   Barang</span></a>
                           <ul class="pcoded-submenu">
                               <li class=""><a href="<?= base_url(); ?>/categories" class="">Data Kategori Barang</a></li>
                               <li class=""><a href="<?= base_url(); ?>/items" class="">Data Barang</a></li>
                               <li class=""><a href="<?= base_url(); ?>/item-reports" class="">Laporan Transaksi Barang</a></li>
                           </ul>
                       </li>
                   <?php endif; ?>
                   <?php if (in_groups('SUPER ADMIN') || in_groups('KASIR') || in_groups('MARKETING')) : ?>
                       <li class="nav-item pcoded-menu-caption">
                           <label>Menu Manajemen User</label>
                       </li>
                       <li data-username="user users admin atasan super kasir members member shop" class="nav-item pcoded-hasmenu">
                           <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Manajemen User</span></a>
                           <ul class="pcoded-submenu">
                               <li class=""><a href="<?= base_url(); ?>/members" class="">Data Pelanggan Project</a></li>
                               <?php if (in_groups('SUPER ADMIN')) : ?>
                                   <li class=""><a href="<?= base_url(); ?>/users" class="">Data User Sistem</a></li>
                               <?php endif; ?>
                           </ul>
                       </li>
                       <?php if (in_groups('SUPER ADMIN') || in_groups('KASIR')) : ?>
                           <li class="nav-item pcoded-menu-caption">
                               <label>Menu Transaksi</label>
                           </li>
                           <li data-username="payment cashier report" class="nav-item pcoded-hasmenu">
                               <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-lock"></i></span><span class="pcoded-mtext">Manajemen
                                       Transaksi</span></a>
                               <ul class="pcoded-submenu">
                                   <li class=""><a href="<?= base_url(); ?>/transaction" class="">Kasir Transaksi Project</a></li>
                                   <li class=""><a href="<?= base_url(); ?>/transaction/report" class="">Laporan Transaksi Project</a>
                                   </li>
                               </ul>
                           </li>
                       <?php endif; ?>
                   <?php endif; ?>
                   <?php if (in_groups('SUPER ADMIN') || in_groups('ATASAN')) : ?>

                       <li class="nav-item pcoded-menu-caption">
                           <label>Menu Laporan Keuangan</label>
                       </li>
                       <li data-username="financial report payment" class="nav-item"><a href="<?= base_url(); ?>/report" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Data Laporan
                                   Keuangan</span></a></li>
                   <?php endif; ?>
               </ul>
           </div>

       </div>
   </nav>
   <!-- [ navigation menu ] end -->