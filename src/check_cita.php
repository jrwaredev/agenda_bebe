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
                <h2 class="text-primary text-center">Confirmar cita</h2>
                <form action="update_check_cita.php" method="post">
                    <?php
                    if ($result_citas > 0) {

                        while ($data_citas = mysqli_fetch_assoc($query_cita)) {
                            echo '
                            <h5 class="text-primary text-center">' . $data_citas["nombre"] . '</h5>
                            <p class="text-secundary text-center">' . $data_citas["fecha"] . '</p>
                            <input type="hidden" name="id" value="' . $data_citas["id_cita"] . '">
                            <div class="form group pt-2">
                                <label for="resultados" class="form-label mt-4">Resultados:</label>
                                <textarea class="form-control" id="resultados" name="resultados" rows="3"></textarea>
                            </div>
                            <div class="form group pt-2">
                                <label for="notas" class="form-label mt-4">Notas:</label>
                                <textarea class="form-control" id="notas" name="notas" rows="3">' . $data_citas["notas"] . '</textarea>
                            </div>';
                        }
                    }
                    ?>
                    <div class="form group pt-2 text-center">
                        <button type="submit" class="btn btn-info">Guadar</button>
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