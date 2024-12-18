<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Agenda bebe</title>
</head>

<body class="hold-transition princ-page"
    style="background-image: url('../assets/img/fondo1.png'); background-size: contain">
    <nav class="navbar navbar-expand-lg bg-light" data-bs-theme="light">
        <div class="container-fluid">
            <a class="navbar-brand">Agenda BEBÉ(s)</a>
            <a href="principal.php" class="btn btn-outline-dark"><i class="fa fa-home"></i></a>
        </div>
    </nav>
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card card-body">
                    <?php
                    include "../conexion.php";
                    $id_cita = $_GET["id_cita"];
                    $query_cita = mysqli_query($conexion, 'SELECT citas.*, especialidades.nombre FROM citas inner join especialidades on citas.id_especialidad = especialidades.id_especialidad WHERE citas.id_cita ='.$id_cita);
                    $result_cita = mysqli_num_rows($query_cita);
                    if ($result_cita > 0) {
                        while ($data_cita = mysqli_fetch_assoc($query_cita)) {
                            echo '<h2 class="text-primary text-center">Detalles de la cita</h2>
                            <h4>CITA:</h4>
                            <p>'.$data_cita["nombre"].'</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>FECHA:</h4>
                                    <p>'.$data_cita["fecha"].'</p>
                                </div>
                                <div class="col-md-4">
                                    <h4>HORA:</h4>
                                    <p>'.$data_cita["hora"].'</p>
                                </div>
                                <div class="col-md-4">
                                    <h4>LUGAR:</h4>
                                    <p>'.$data_cita["lugar"].'</p>
                                </div>
                            </div>
                            <h4>NOTAS:</h4>
                            <p>'.$data_cita["notas"].'</p>
                            <h4>RESULTADOS:</h4>
                            <p>'.$data_cita["resultados"].'</p>
                            <h4>ANEXOS:</h4>';
                        }
                    }else{
                        echo'<h2 class="text-primary text-center">Detalles de la cita</h2>
                        <h4>CITA:</h4>
                        <p></p>
                        <div class="row">
                            <div class="col-md-4">
                                <h4>FECHA:</h4>
                                <p></p>
                            </div>
                            <div class="col-md-4">
                                <h4>HORA:</h4>
                                <p></p>
                            </div>
                            <div class="col-md-4">
                                <h4>LUGAR:</h4>
                                <p></p>
                            </div>
                        </div>
                        <h4>NOTAS:</h4>
                        <p></p>
                        <h4>RESULTADOS:</h4>
                        <p></p>
                        <h4>ANEXOS:</h4>';
                    }
                    ?>
                    

                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    </div>

    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
</body>

</html>