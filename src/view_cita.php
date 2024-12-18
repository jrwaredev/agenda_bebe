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
                    $id_cita = $_GET["id_cita"];
                    $query_cita = mysqli_query($conexion, 'SELECT citas.*, especialidades.nombre FROM citas inner join especialidades on citas.id_especialidad = especialidades.id_especialidad WHERE citas.id_cita ='.$id_cita);
                    $result_cita = mysqli_num_rows($query_cita);
                    if ($result_cita > 0) {
                        while ($data_cita = mysqli_fetch_assoc($query_cita)) {
                            echo '<h2 class="text-primary text-center text-info">Detalles de la cita</h2>
                            <h4 class="text-danger">CITA:</h4>
                            <p>'.$data_cita["nombre"].'</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4 class="text-danger">FECHA:</h4>
                                    <p>'.$data_cita["fecha"].'</p>
                                </div>
                                <div class="col-md-4">
                                    <h4 class="text-danger">HORA:</h4>
                                    <p>'.$data_cita["hora"].'</p>
                                </div>
                                <div class="col-md-4">
                                    <h4 class="text-danger">LUGAR:</h4>
                                    <p>'.$data_cita["lugar"].'</p>
                                </div>
                            </div>
                            <h4 class="text-danger">NOTAS:</h4>
                            <p>'.$data_cita["notas"].'</p>
                            <h4 class="text-danger">RESULTADOS:</h4>
                            <p>'.$data_cita["resultados"].'</p>
                            <h4 class="text-danger">ANEXOS:</h4>';
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
<?php
include_once "footer.php";
?>