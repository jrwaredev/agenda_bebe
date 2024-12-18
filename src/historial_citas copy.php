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
            <?php
            include "../conexion.php";
            $query_agenda = mysqli_query($conexion, 'SELECT citas.*, especialidades.nombre FROM citas inner join especialidades on citas.id_especialidad = especialidades.id_especialidad WHERE citas.estado = "realizada"');
            $result_citas = mysqli_num_rows($query_agenda);
            ?>
            <div class="pt-4">
                <h2 class="text-secondary text-center text-danger"><u>Historial de citas</u></h2>
                <br>
                <table class="table table-hover table-striped bg-white">
                    <thead>
                        <tr class="table-light">
                            <td>Cita</td>
                            <td>Fecha</td>
                            <td>Hora</td>
                            <td>Estado</td>
                            <td>Opciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- codigo listar agenda-->
                        <?php
                        if ($result_citas > 0) {

                            while ($data_citas = mysqli_fetch_assoc($query_agenda)) {
                                echo '
                                <tr>
                                    <td><a href="view_cita.php?id_cita='. $data_citas["id_cita"] .'">' . $data_citas["nombre"] . '</a></td>
                                    <td>' . $data_citas["fecha"]. '</td>
                                    <td>' . $data_citas["hora"] . '</td>
                                    <td>' . $data_citas["estado"] . '</td>
                                    <td>
                                        
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                            data-target="#modal_delete_cita">
                                            <i class="fa fa-calendar-times-o"></i>
                                        </button>
                                        <a href="edit_cita.php" class="btn btn-outline-primary"><i
                                                class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                </tr>';
                            }
                        }else{
                            '<tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>';
                        }
                        ?>
                        <!-- fin codigo listar agenda-->
                    </tbody>
                    <?php
                    include('modal_check_cita.php');
                    include('modal_delete_cita.php');
                    ?>
                </table>
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