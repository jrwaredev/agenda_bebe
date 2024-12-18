<?php
session_start();
if (!empty($_SESSION['active'])) {
    header('location: src/');
} else {
    if (!empty($_POST)) {
        header('Location: src/principal.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda bebe</title>
<!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/bootstrap.css">
    <link rel="stylesheet" href="assets/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="hold-transition login-page" style="background-image: url('assets/img/fondo1.png'); background-size: contain">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Agenda</b> BEBÉ(s)</a>
        </div>

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ingresa tu usuario y contraseña</p>
                <?php echo (isset($alert)) ? $alert : '' ; ?>
                <form action="" method="post" autocomplete="on">
                    <div class="form group pt-2">
                        <input type="text" name="user" id="user" placeholder="Usuario" class="form-control">
                    </div>
                    <div class="form group pt-2">
                        <input type="text" name="pass" id="pass" placeholder="Contraseña" class="form-control">
                    </div>
                    <div class="form group pt-2 text-center">
                        <button type="submit" class="btn btn-danger">Entrar</button>
                    </div>
                </form>
            </div>

            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
</body>

</html>