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
                    <h2 class="text-primary text-center">Eliminar Cita</h2>
                    <form action="delete_cita.php" method="post">
                        <?php
                        if ($result_citas > 0) {

                            while ($data_citas = mysqli_fetch_assoc($query_cita)) {
                                echo '
                                <h5 class="text-primary text-center">'.$data_citas["nombre"].'</h5>
                                <input type="hidden" name="id" value="'.$data_citas["id_cita"].'">
                                <p>¿Estas segur@ que quieres eliminar esta cita?</p>
                                ';
                            }
                        }
                        ?>
                        <div class="form group pt-2 text-center">
                            <button type="submit" class="btn btn-outline-success">Si</button>
                            <a href="principal.php" class="btn btn-outline-danger">No</a>
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