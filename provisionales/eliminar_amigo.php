<?php
session_start();

include("conexion.php");

if(isset($_POST['id_amigo'])) {
    $id_amigo = $_POST['id_amigo'];
    $id_usuario = $_SESSION['id_usuario'];

    // Eliminar la amistad
    $consulta_eliminar_amigo = "DELETE FROM amigos WHERE (id_usuario = '$id_usuario' AND id_amigo = '$id_amigo') OR (id_usuario = '$id_amigo' AND id_amigo = '$id_usuario')";
    $resultado_eliminar_amigo = mysqli_query($conex, $consulta_eliminar_amigo);

    if($resultado_eliminar_amigo) {
        echo "Amigo eliminado correctamente.";
    } else {
        echo "Error al eliminar el amigo.";
    }
} else {
    echo "No se recibió información del amigo.";
}
?>
