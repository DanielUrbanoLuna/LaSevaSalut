<?php
session_start();

include("conexion.php");

if(isset($_POST['id_amigo'])) {
    // Código para cargar el historial de chat entre el usuario y el amigo
} else {
    echo "No se recibió información del amigo.";
}
?>
