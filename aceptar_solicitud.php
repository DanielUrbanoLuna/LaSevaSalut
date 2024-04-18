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

// Obtener los datos de la solicitud de amistad
$consulta_solicitud = "SELECT id_usuario_envia, id_usuario_recibe FROM solicitudes_amistad WHERE id = $id_solicitud";
$resultado_solicitud = mysqli_query($conex, $consulta_solicitud);

if (!$resultado_solicitud || mysqli_num_rows($resultado_solicitud) == 0) {
    echo "Error: No se encontró la solicitud de amistad.";
    exit;
}

$fila_solicitud = mysqli_fetch_assoc($resultado_solicitud);
$id_usuario_envia = $fila_solicitud['id_usuario_envia'];
$id_usuario_recibe = $fila_solicitud['id_usuario_recibe'];

// Actualizar el estado de la solicitud en la tabla solicitudes_amistad
$sql_update_solicitud = "UPDATE solicitudes_amistad SET estado = 'aceptada' WHERE id = $id_solicitud AND id_usuario_recibe = $id_usuario";

if (mysqli_query($conex, $sql_update_solicitud)) {
    // Insertar una nueva entrada en la tabla amigos para reflejar la amistad
    $sql_insert_amigo = "INSERT INTO amigos (id_usuario1, id_usuario2, estado) VALUES ($id_usuario_envia, $id_usuario_recibe, 'aceptada')";
    if (mysqli_query($conex, $sql_insert_amigo)) {
        // Asegurar que la amistad sea recíproca
        $sql_insert_amigo_inverso = "INSERT INTO amigos (id_usuario1, id_usuario2, estado) VALUES ($id_usuario_recibe, $id_usuario_envia, 'aceptada')";
        if (mysqli_query($conex, $sql_insert_amigo_inverso)) {
            echo "Solicitud aceptada correctamente.";
        } else {
            echo "Error al insertar en la tabla amigos (inverso): " . mysqli_error($conex);
        }
    } else {
        echo "Error al insertar en la tabla amigos: " . mysqli_error($conex);
    }
} else {
    echo "Error al actualizar la solicitud de amistad: " . mysqli_error($conex);
}

mysqli_close($conex);
?>
