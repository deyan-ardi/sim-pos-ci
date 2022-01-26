 <!-- Required Js -->
 <script src="<?= base_url(); ?>/assets/plugins/sweetalert/js/sweetalert.min.js"></script>
 <script src="<?= base_url(); ?>/assets/js/pcoded.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
 <!-- sweet alert Js -->
 <script>
     function formatRupiah(angka, prefix) {
         var number_string = angka.replace(/[^,\d]/g, '').toString(),
             split = number_string.split(','),
             sisa = split[0].length % 3,
             rupiah = split[0].substr(0, sisa),
             ribuan = split[0].substr(sisa).match(/\d{3}/gi);

         // tambahkan titik jika yang di input sudah menjadi angka ribuan
         if (ribuan) {
             separator = sisa ? '.' : '';
             rupiah += separator + ribuan.join('.');
         }

         rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
         return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
     }
 </script>
 <?= $this->renderSection('footer'); ?>