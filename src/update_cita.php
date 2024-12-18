<?php
require_once "../conexion.php";
$id_cita=$_POST['id'];
$fecha=$_POST['new_fecha'];
$hora=$_POST['new_hora'];
$lugar=$_POST['new_lugar'];
$notas=$_POST['new_notas'];
$estado = '';
if ($fecha == ''){
    $estado = 'pendiente';
}else{
    $estado = 'agendada';
}
$sql="UPDATE citas SET  fecha='$fecha', hora='$hora', lugar='$lugar', notas='$notas', estado='$estado' WHERE id_cita='$id_cita'";
$query=mysqli_query($conexion,$sql);
if($query){
    Header("Location: principal.php");
}
?>