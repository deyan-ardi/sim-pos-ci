   <!-- [ navigation menu ] start -->
   <nav class="pcoded-navbar menupos-fixed menu-dark menu-item-icon-style6 navbar-collapsed">
       <div class="navbar-wrapper ">
           <div class="navbar-brand header-logo">
               <a href="<?= base_url(); ?>" class="b-brand">
                   <img src="<?= base_url(); ?>/logo-white.png" width="30%" alt="" class="logo images">
                   <img src="<?= base_url(); ?>/logo-white.png" width="50%" alt="" class="logo-thumb images">
               </a>
               <a class="mobile-menu on" id="mobile-collapse" href="#!"><span></span></a>
           </div>
           <div class="navbar-content scroll-div">
               <ul class="nav pcoded-inner-navbar mb-5">
                   <li class="nav-item pcoded-menu-caption">
                       <label>Main Menu</label>
                   </li>
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
                       <li data-username="marketing item order laporan supplier request permintaan" class="nav-item pcoded-hasmenu">
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
                       <li data-username="supplier item order barang receiving permintaan" class="nav-item pcoded-hasmenu">
                           <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span><span class="pcoded-mtext">Manajemen
                                   Supplier</span></a>
                           <ul class="pcoded-submenu">
                               <?php if (in_groups('SUPER ADMIN') || in_groups('PURCHASING')) : ?>
                                   <li class=""><a href="<?= base_url(); ?>/suppliers" class="">Data Supplier</a></li>
                                   <li class=""><a href="<?= base_url(); ?>/suppliers/view-orders" class="">Daftar Permintaan Order</a>
                                   </li>
                                   <li class=""><a href="<?= base_url(); ?>/suppliers/order-items" class="">Order Barang</a>
                                   </li>
                               <?php endif; ?>
                               <?php if (in_groups('SUPER ADMIN') || in_groups('GUDANG')) : ?>
                                   <li class=""><a href="<?= base_url(); ?>/suppliers/receiving" class="">Receiving Order Barang</a>
                                   </li>
                               <?php endif; ?>
                           </ul>
                       </li>
                   <?php endif; ?>
                   <?php if (in_groups('SUPER ADMIN') || in_groups('GUDANG') || in_groups('PURCHASING') || in_groups('ATASAN')) : ?>
                       <li class="nav-item pcoded-menu-caption">
                           <label>Menu Item Barang</label>
                       </li>
                       <li data-username="item data barang transaksi laporan" class="nav-item pcoded-hasmenu">
                           <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Manajemen
                                   Barang</span></a>
                           <ul class="pcoded-submenu">
                               <li class=""><a href="<?= base_url(); ?>/categories" class="">Data Kategori Barang</a></li>
                               <li class=""><a href="<?= base_url(); ?>/items" class="">Data Barang</a></li>
                               <li class=""><a href="<?= base_url(); ?>/item-reports" class="">Laporan Transaksi Barang</a></li>
                           </ul>
                       </li>
                   <?php endif; ?>
                   <?php if (in_groups('SUPER ADMIN') || in_groups('FINANCE') || in_groups('MARKETING')) : ?>
                       <li class="nav-item pcoded-menu-caption">
                           <label>Menu Manajemen User</label>
                       </li>
                       <li data-username="user admin atasan super kasir member pelanggan projek" class="nav-item pcoded-hasmenu">
                           <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Manajemen User</span></a>
                           <ul class="pcoded-submenu">
                               <li class=""><a href="<?= base_url(); ?>/members" class="">Data Pelanggan Projek</a></li>
                               <?php if (in_groups('SUPER ADMIN')) : ?>
                                   <li class=""><a href="<?= base_url(); ?>/users" class="">Data User Sistem</a></li>
                               <?php endif; ?>
                           </ul>
                       </li>
                   <?php endif; ?>

                   <?php if (in_groups('SUPER ADMIN') ||  in_groups('MARKETING')) : ?>
                       <li class="nav-item pcoded-menu-caption">
                           <label>Menu Transaksi Marketing</label>
                       </li>
                       <li data-username="transaksi projek laporan" class="nav-item pcoded-hasmenu">
                           <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Marketing Project</span></a>
                           <ul class="pcoded-submenu">
                               <li class=""><a href="<?= base_url(); ?>/transaction/marketing/kasir-penawaran" class="">Kasir Penawaran</a></li>
                               <li class=""><a href="<?= base_url(); ?>/transaction/marketing/list-penawaran" class="">Laporan Penawaran</a>
                               <li class=""><a href="<?= base_url(); ?>/transaction/marketing/report" class="">Laporan Transaksi Projek</a>
                               </li>
                           </ul>
                       </li>
                   <?php endif; ?>

                   <?php if (in_groups('SUPER ADMIN') ||  in_groups('FINANCE')) : ?>
                       <li class="nav-item pcoded-menu-caption">
                           <label>Menu Transaksi Kasir Finance</label>
                       </li>
                       <li data-username="transaksi general laporan daftar" class="nav-item pcoded-hasmenu">
                           <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-minus"></i></span><span class="pcoded-mtext">Transaksi General</span></a>
                           <ul class="pcoded-submenu">
                               <li class=""><a href="<?= base_url(); ?>/transaction-general" class="">Kasir General</a></li>
                               <li class=""><a href="<?= base_url(); ?>/transaction-general/report" class="">Laporan Transaksi General</a>
                               </li>
                           </ul>
                       </li>
                       <li data-username="transaksi projek laporan" class="nav-item pcoded-hasmenu">
                           <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Transaksi Projek</span></a>
                           <ul class="pcoded-submenu">
                               <li class=""><a href="<?= base_url(); ?>/transaction/cashier/transaction-project" class="">Kasir Projek</a>
                               <li class=""><a href="<?= base_url(); ?>/transaction/cashier/list-penawaran" class="">Daftar Penawaran</a>
                               <li class=""><a href="<?= base_url(); ?>/transaction/cashier/report" class="">Laporan Transaksi Projek</a>
                               </li>
                           </ul>
                       </li>
                       <li data-username="pengaturan pph invoice transaksi project general" class="nav-item pcoded-hasmenu">
                           <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Setelan Transaksi</span></a>
                           <ul class="pcoded-submenu">
                               <li class=""><a href="<?= base_url(); ?>/transaction/cashier/pengaturan" class="">PPh dan Invoice</a>
                               </li>
                           </ul>
                       </li>
                   <?php endif; ?>

                   <?php if (in_groups('SUPER ADMIN') ||  in_groups('PROYEK') ||  in_groups('MARKETING') ||  in_groups('GUDANG')) : ?>
                       <li class="nav-item pcoded-menu-caption">
                           <label>Menu SPPB</label>
                       </li>
                       <li data-username="transaksi general laporan daftar" class="nav-item pcoded-hasmenu">
                           <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-minus"></i></span><span class="pcoded-mtext">SPPB General</span></a>
                           <ul class="pcoded-submenu">
                               <?php if (in_groups('SUPER ADMIN') ||  in_groups('PROYEK') ||  in_groups('MARKETING')) : ?>
                                   <li class=""><a href="<?= base_url(); ?>/sppb/transaction-general" class="">Cetak SPPB</a>
                                   </li>
                               <?php endif; ?>
                               <?php if (in_groups('SUPER ADMIN') ||  in_groups('GUDANG')) : ?>
                                   <li class=""><a href="<?= base_url(); ?>/surat-jalan/transaction-general" class="">Cetak Surat Jalan</a>
                                   </li>
                               <?php endif; ?>
                           </ul>
                       </li>
                       <li data-username="transaksi projek laporan" class="nav-item pcoded-hasmenu">
                           <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">SPPB Projek</span></a>
                           <ul class="pcoded-submenu">
                               <?php if (in_groups('SUPER ADMIN') ||  in_groups('PROYEK') ||  in_groups('MARKETING')) : ?>
                                   <li class=""><a href="<?= base_url(); ?>/sppb/transaction-project" class="">Cetak SPPB</a>
                                   </li>
                               <?php endif; ?>
                               <?php if (in_groups('SUPER ADMIN') ||  in_groups('GUDANG')) : ?>
                                   <li class=""><a href="<?= base_url(); ?>/surat-jalan/transaction-project" class="">Cetak Surat Jalan</a>
                                   </li>
                               <?php endif; ?>
                           </ul>
                       </li>
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