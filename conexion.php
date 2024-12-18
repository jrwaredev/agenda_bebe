<?php
    $host = "localhost";
    $user = "root";
    $clave = "";
    $bd = "agenda_bebe";
    /*$host = "sql309.infinityfree.com";
    $user = "if0_37323856";
    $clave = "mM3w158Ozodem";
    $bd = "if0_37323856_agendabebe";*/
    $conexion = mysqli_connect($host,$user,$clave,$bd);
    if (mysqli_connect_errno()){
        echo "No se pudo conectar a la base de datos";
        exit();
    }
    mysqli_select_db($conexion,$bd) or die("No se encuentra la base de datos");
    mysqli_set_charset($conexion,"utf8");
?>