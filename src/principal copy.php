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
    <?php
    include "../conexion.php";
    if (!empty($_POST)) {
        $alert = "";
        $especialidad = $_POST['selec_esp'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $lugar = $_POST['lugar'];
        $notas = $_POST['notas'];
        if ($especialidad < 1) {
            $alert = '<div class="alert alert-dismissible alert-danger">
            Algunos datos son necesarios
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        } else {
            $value_fecha = '';
            $value_hora = '';
            $value_estado = '';
            if ($fecha == '' || $hora == '') {
                $value_fecha = '0000-00-00';
                $value_hora = '00:00:00';
                $value_estado = 'pendiente';
            } else {
                $value_fecha = $fecha;
                $value_hora = $hora;
                $value_estado = 'agendada';
            }
            $query_insert = mysqli_query($conexion, "INSERT INTO citas (id_especialidad,fecha,hora,lugar,notas,resultados,estado) VALUES ('$especialidad','$value_fecha','$value_hora','$lugar','$notas','','$value_estado')");
            if ($query_insert == true) {
                $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Cita agregada
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                Error al crear la cita
                </div>';
            }
        }
    }
    ?>
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-body">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <h2 class="text-primary text-center">Registrar cita</h2>
                    <form action="" method="post">
                        <?php
                        $query_esp = mysqli_query($conexion, "SELECT * FROM especialidades WHERE estado = 'ACTIVO'");
                        $result_esp = mysqli_num_rows($query_esp);
                        ?>
                        <div class="form group pt-2">
                            <label for="selec_esp" class="form-label mt-4">Cita:</label>
                            <select class="form-select" id="selec_esp" name="selec_esp">
                                <?php
                                if ($result_esp > 0) {
                                    echo '<option value="0">Seleccionar</option>';
                                    while ($data_esp = mysqli_fetch_assoc($query_esp)) {
                                        echo '<option value="' . $data_esp["id_especialidad"] . '">' . $data_esp["nombre"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form group pt-2">
                            <input type="date" name="fecha" id="fecha" placeholder="Fecha" class="form-control">
                        </div>
                        <div class="form group pt-2">
                            <input type="time" name="hora" id="hora" placeholder="Hora" class="form-control">
                        </div>
                        <div class="form group pt-2">
                            <input type="text" name="lugar" id="lugar" placeholder="Lugar" class="form-control">
                        </div>
                        <div class="form group pt-2">
                            <label for="notas" class="form-label mt-4">Notas:</label>
                            <textarea class="form-control" id="notas" name="notas" rows="3"></textarea>
                        </div>
                        <!--<div class="form group pt-2">
                        <label for="anexo" class="form-label mt-4">Anexo:</label>
                        <input class="form-control" type="file" id="anexo">
                    </div>-->
                        <div class="form group pt-2 text-center">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7 pt-4">
                <?php
                $query_agenda = mysqli_query($conexion, 'SELECT citas.*, especialidades.nombre FROM citas inner join especialidades on citas.id_especialidad = especialidades.id_especialidad WHERE citas.estado <> "realizada"');
                $result_citas = mysqli_num_rows($query_agenda);
                ?>
                <h2 class="text-secondary text-center text-danger"><u>Agenda</u></h2>
                <div align="right">
                    <form action="historial_citas.php" method="post">
                        <button type="submit" class="btn btn-outline-info">
                            Ver historial <i class="fa fa-calendar-check-o"></i>
                        </button>
                    </form>
                </div>
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
                                $val_fecha = '';
                                $val_hota = '';
                                if ($data_citas["fecha"] == '0000-00-00') {
                                    $val_fecha = 'Sin fecha';
                                } else {
                                    $val_fecha = $data_citas["fecha"];
                                }
                                if ($data_citas["hora"] == '00:00:00') {
                                    $val_hora = 'Sin hora';
                                } else {
                                    $val_hora = $data_citas["hora"];
                                }
                                echo '
                                <tr>
                                    <td><a href="view_cita.php?id_cita=' . $data_citas["id_cita"] . '">' . $data_citas["nombre"] . '</a></td>
                                    <td>' . $val_fecha . '</td>
                                    <td>' . $val_hora . '</td>
                                    <td>' . $data_citas["estado"] . '</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                            data-target="#modal_check_cita">
                                            <i class="fa fa-calendar-check-o"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                            data-target="#modal_delete_cita">
                                            <i class="fa fa-calendar-times-o"></i>
                                        </button>
                                        <a href="edit_cita.php" class="btn btn-outline-primary"><i
                                                class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                </tr>';
                            }
                            include('modal_delete_cita.php');
                        } else {
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