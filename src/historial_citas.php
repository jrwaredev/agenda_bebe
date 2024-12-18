<?php
include_once "header.php";
?>
    <div class="container pt-4">
        <div class="row">
            <?php
            include "../conexion.php";
            $query_agenda = mysqli_query($conexion, 'SELECT citas.*, especialidades.nombre FROM citas inner join especialidades on citas.id_especialidad = especialidades.id_especialidad WHERE citas.estado = "realizada" ORDER BY citas.fecha DESC');
            $result_citas = mysqli_num_rows($query_agenda);
            ?>
            <div class="pt-4">
                <h2 class="text-secondary text-center text-danger"><u>Historial de citas</u></h2>
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
                                echo '
                                <tr>
                                    <td><a href="view_cita.php?id_cita='. $data_citas["id_cita"] .'">' . $data_citas["nombre"] . '</a></td>
                                    <td>' . $data_citas["fecha"]. '</td>
                                    <td>' . $data_citas["hora"] . '</td>
                                    <td>' . $data_citas["estado"] . '</td>
                                    <td>
                                        
                                        <a href="form_delete_cita.php?id_cita=' . $data_citas["id_cita"] . '" class="btn btn-outline-danger"><i
                                                class="fa fa-calendar-times-o"></i></a>
                                        <a href="edit_cita.php?id_cita=' . $data_citas["id_cita"] . '" class="btn btn-outline-primary"><i
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
                </table>
            </div>
        </div>
    </div>
<?php
include_once "footer.php";
?>