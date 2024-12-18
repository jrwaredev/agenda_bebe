<?php
include "../conexion.php";
$id = $_POST['id'];
$eliminar = mysqli_query($conexion, "DELETE FROM citas WHERE id_cita = $id");
header('location: principal.php');
?>