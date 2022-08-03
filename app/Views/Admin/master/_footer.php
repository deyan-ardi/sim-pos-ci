 <!-- Required Js -->
 <script src="<?= base_url(); ?>/assets/plugins/sweetalert/js/sweetalert.min.js"></script>
 <script src="<?= base_url(); ?>/assets/js/pcoded.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
 <!-- sweet alert Js -->
 <script>
     function format_rupiah(angka) {
         if (angka == null) {
             angka = 0;
         }
         var rupiah = angka.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
         return 'Rp. ' + rupiah;
     }
 </script>
 <?= $this->renderSection('footer'); ?>