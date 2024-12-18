<?php
require_once "../conexion.php";
$id_cita=$_POST['id'];
$notas=$_POST['notas'];
$resultados=$_POST['resultados'];
$sql="UPDATE citas SET  notas='$notas', resultados='$resultados', estado='realizada' WHERE id_cita='$id_cita'";
$query=mysqli_query($conexion,$sql);
if($query){
    Header("Location: principal.php");
}
?>