
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
    include_once "header.php";
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
                            <label for="fecha">Fecha:</label>
                            <input type="date" name="fecha" id="fecha" placeholder="Fecha" class="form-control">
                        </div>
                        <div class="form group pt-2">
                            <label for="hora">Hora:</label>
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
                $query_agenda = mysqli_query($conexion, 'SELECT citas.*, especialidades.nombre FROM citas inner join especialidades on citas.id_especialidad = especialidades.id_especialidad WHERE citas.estado <> "realizada" ORDER BY citas.fecha ASC');
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
                        <tr class="table-warning">
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
                                        <a href="check_cita.php?id_cita=' . $data_citas["id_cita"] . '" class="btn btn-outline-success"><i
                                                class="fa fa-calendar-check-o"></i></a>
                                        <a href="form_delete_cita.php?id_cita=' . $data_citas["id_cita"] . '" class="btn btn-outline-danger"><i
                                                class="fa fa-calendar-times-o"></i></a>
                                        <a href="edit_cita.php?id_cita=' . $data_citas["id_cita"] . '" class="btn btn-outline-primary"><i
                                                class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                </tr>';
                            }
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
                    <?php
                    include('modal_delete_cita.php');
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php
    include_once "footer.php";
    ?>