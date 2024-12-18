<?php
include_once "header.php";
?>
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card card-body">
                    <?php
                    include "../conexion.php";
                    $id_cita = $_GET['id_cita'];
                    $query_cita = mysqli_query($conexion, 'SELECT citas.*, especialidades.nombre FROM citas inner join especialidades on citas.id_especialidad = especialidades.id_especialidad WHERE id_cita = ' . $id_cita);
                    $result_citas = mysqli_num_rows($query_cita);
                    ?>
                    <h2 class="text-primary text-center">Editar Cita</h2>
                    <form action="update_cita.php" method="post">
                        <?php
                        if ($result_citas > 0) {

                            while ($data_citas = mysqli_fetch_assoc($query_cita)) {
                                echo '
                                <h5 class="text-primary text-center">'.$data_citas["nombre"].'</h5>
                                <input type="hidden" name="id" value="'.$data_citas["id_cita"].'">
                                <div class="form group pt-2">
                                    <label for="new_fecha">Fecha: '.$data_citas["fecha"].'</label>
                                    <input type="date" name="new_fecha" id="new_fecha" placeholder="Nueva fecha" value="'.$data_citas["fecha"].'"
                                        class="form-control">
                                </div>
                                <div class="form group pt-2">
                                    <label for="new_hora">Hora: '.$data_citas["hora"].'</label>
                                    <input type="time" name="new_hora" id="new_hora" placeholder="Nueva hora" value="'.$data_citas["hora"].'"
                                        class="form-control">
                                </div>
                                <div class="form group pt-2">
                                    <label for="new_lugar">Lugar</label>
                                    <input type="text" name="new_lugar" id="new_lugar" placeholder="Lugar" value="'.$data_citas["lugar"].'"
                                        class="form-control">
                                </div>
                                <div class="form group pt-2">
                                    <label for="new_notas" class="form-label mt-4">Notas:</label>
                                    <textarea class="form-control" id="new_notas" name="new_notas" rows="3">'.$data_citas["notas"].'</textarea>
                                </div>';
                            }
                        }
                        ?>
                        <div class="form group pt-2 text-center">
                            <button type="submit" class="btn btn-info">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
<?php
include_once "footer.php";
?>