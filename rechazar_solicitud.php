<?php
session_start();
include("conexion.php");

// Verificar si se ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    echo "Error: No se ha iniciado sesión.";
    exit;
}

// Obtener el ID del usuario actual
$id_usuario = $_SESSION['id_usuario'];

// Verificar si se recibió el ID de la solicitud
if (!isset($_POST['id_solicitud'])) {
    echo "Error: No se ha proporcionado el ID de la solicitud.";
    exit;
}

// Obtener el ID de la solicitud
$id_solicitud = $_POST['id_solicitud'];

// Actualizar el estado de la solicitud en la tabla solicitudes_amistad
$sql_update_solicitud = "UPDATE solicitudes_amistad SET estado = 'rechazada' WHERE id = $id_solicitud AND id_usuario_recibe = $id_usuario";

if (mysqli_query($conex, $sql_update_solicitud)) {
    // Eliminar la entrada correspondiente en la tabla amigos si existe
    $sql_delete_amigo = "DELETE FROM amigos WHERE (id_usuario1 = $id_usuario OR id_usuario2 = $id_usuario) AND (id_usuario1 = (SELECT id_usuario_envia FROM solicitudes_amistad WHERE id = $id_solicitud) OR id_usuario2 = (SELECT id_usuario_envia FROM solicitudes_amistad WHERE id = $id_solicitud))";
    if (mysqli_query($conex, $sql_delete_amigo)) {
        echo "Solicitud rechazada correctamente.";
    } else {
        echo "Error al eliminar la entrada en la tabla amigos: " . mysqli_error($conex);
    }
} else {
    echo "Error al rechazar la solicitud: " . mysqli_error($conex);
}

mysqli_close($conex);
?>
