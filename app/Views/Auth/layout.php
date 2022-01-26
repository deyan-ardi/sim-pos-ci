<!DOCTYPE html>
<html lang="en">

<head>

    <title>Dintara Point Of Sale - <?= $this->renderSection('title'); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Point of Sale Project" />
    <meta name="keywords" content="point of sale, aplikasi kasir, codeigniter">
    <meta name="author" content="Ganatech ID" />

    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url(); ?>/logo-white.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/animation/css/animate.min.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css">


</head>
<?= $this->renderSection('main'); ?>

<!-- Required Js -->
<script src="<?= base_url(); ?>/assets/js/vendor-all.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });
    });
</script>
</body>

</html>