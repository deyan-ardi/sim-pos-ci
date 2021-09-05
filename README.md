# CodeIgniter 4 Point Of Sales Project
<img alt="php" src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"> <img alt="bootstrap" src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white"> <img alt="bootstrap" src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white"> <img alt="bootstrap" src="https://img.shields.io/badge/Codeigniter-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white">



## Point Of Sales - Aplikasi Kasir Berbasis Web

Point of Sales(POS) adalah suatu sistem yang digunakan oleh berbagai macam usaha ritel untuk menyelesaikan transaksi jual beli. Merupakan versi modern dari mesin kasir konvensional/cash register yang biasanya sudah dilengkapi dengan cash drawer. Aplikasi ini dikembangkan dengan menggunakan Codeigniter 4. Aplikasi ini merupakan versi beta dan terus mengalami pengembangan

## System Requerements
- PHP >= 7.4
- [GIT Windows](https://git-scm.com/download/win)
- [Composer](https://getcomposer.org/download/)
- Apache Server dan SQL Server => [Dapat diperoleh dengan menginstall [XAMPP](https://www.apachefriends.org/download.html) atau [Laragon](https://laragon.org/download/index.html)]
- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php)

Selanjutnya, pastikan pada `php.ini` anda telah mengaktifkan:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)

## How To Install?

- Buka folder `xampp/htdocs` lalu clone repository ini dengan menggunakan perintah `git clone https://github.com/deyan-ardi/pos-project`
- Buka folder pos-project di Visual Studio Code, selanjutnya rename file `env rename` menjadi `.env`
- Buat sebuah database di mysql, boleh menggunakan phpmyadmin. Selanjutnya buka file `.env` lalu lihat bagian `database.default.database = db_pos_project`, ganti `db_pos_project` menjadi nama database yang baru saja anda buat
- Buka terminal/cmd, arahkan ke folder root project. Jalankan perintah `composer update`. Setelah itu, jalankan perintah berikut secara bertahap
1. `php spark migrate`
2. `php spark db:seed AddGroupUser`
3. `php spark db:seed AddUserSuperAdmin`
4. `php spark serve`
- Jika tidak ada masalah, selanjutnya silahkan akses kehalaman `http://localhost:8080/` maka seharusnya halaman login akan muncul

## How To Update?
- Untuk mengupdate aplikasi, silahkan buka terminal project di Visual Studio Code, lalu lakukan perintah `git pull origin master` dan `git fetch origin master` secara berurutan
- Jika anda pernah merubah code di project pada versi sebelumnya, biasanya akan terjadi conflict saat tahap ini, jika terjadi conflict hal yang bisa dilakukan adalah mengulang melakukan tahap `instalasi`. Silahkan rename nama folder project di versi sebelumnya jika terjadi masalah ini.
- Kemudian, silahkan buat database baru di phpmyadmin dengan nama bebas
- Ubah nama database di file .env di project masing-masing dengan nama database yang baru dibuat
- Kemudian di terminal jalankan syntax berikut secara berurutan
1. `php spark migrate`
2. `php spark db:seed AddGroupUser`
3. `php spark db:seed AddUserSuperAdmin`
4. `php spark serve`
- Jika tidak ada masalah, selanjutnya silahkan akses kehalaman `http://localhost:8080/` maka seharusnya halaman login akan muncul

## User and Permission
1. Login Sebagai Super Admin
- email : super.admin@ganatech.id
- password : 12345678
2. Login Sebagai Atasan
- email : atasan@ganatech.id
- password : 12345678
3. Login Sebagai User Gudang
- email : gudang@ganatech.id
- password : 12345678
4. Login Sebagai User Kasir
- email : kasir@ganatech.id
- password : 12345678
5. Login Sebagai User Purchasing
- email : purchasing@ganatech.id
- password : 12345678
6. Login Sebagai User Marketing
- email : marketing@ganatech.id
- password : 12345678

## Codeigniter Fitur In This Project
Last Updated : 27 Juni 2021
- Menu Kasir
- Print PDF
- Master Data
- Multiple Login User

## Credit
Aplikasi ini dikembangkan oleh Ganatech ID, Copyright 2021