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
- Buka terminal/cmd, arahkan ke folder root project. Jalankan perintah `composer install`. Setelah itu, jalankan perintah berikut secara bertahap

1. `php spark migrate`
2. `php spark db:seed`
3. Tulis `DataSeeder`, lalu Enter
4. `php spark serve`

- Jika tidak ada masalah, selanjutnya silahkan akses kehalaman `http://localhost:8080/` maka seharusnya halaman login akan muncul

## How To Update?

- Untuk mengupdate aplikasi, silahkan buka terminal project di Visual Studio Code, lalu lakukan perintah `git pull origin master` dan `git fetch origin master` secara berurutan
- Jika tidak ada masalah, selanjutnya silahkan akses kehalaman `http://localhost:8080/` maka seharusnya halaman login akan muncul

## User and Permission

1. Login Sebagai Super Admin

- email : super.admin@dintarakitchen.com
- password : 12345678

2. Login Sebagai Atasan

- email : atasan@dintarakitchen.com
- password : 12345678

3. Login Sebagai User Gudang

- email : gudang@dintarakitchen.com
- password : 12345678

4. Login Sebagai User Finance

- email : finance@dintarakitchen.com
- password : 12345678

5. Login Sebagai User Purchasing

- email : purchasing@dintarakitchen.com
- password : 12345678

6. Login Sebagai User Marketing

- email : marketing@dintarakitchen.com
- password : 12345678

7. Login Sebagai User Tim Proyek

- email : proyek@dintarakitchen.com
- password : 12345678

## Credit

Aplikasi ini dikembangkan oleh GanaDev Com, Copyright 2021
