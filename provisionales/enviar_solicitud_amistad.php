<?php
session_start();
include("conexion.php");

if(isset($_POST['correo_amigo'])) {
    $correo_amigo = $_POST['correo_amigo'];

    // Obtener el ID del usuario actual
    $id_usuario = $_SESSION['id_usuario'];

    // Prevenir SQL Injection con una consulta preparada
    $consulta_id_amigo = "SELECT id FROM usuarios WHERE correo = ?";
    $stmt = mysqli_prepare($conex, $consulta_id_amigo);
    mysqli_stmt_bind_param($stmt, "s", $correo_amigo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $id_amigo);//Coger id del usuario amigo y almacenar en la variable $id_amigo
        mysqli_stmt_fetch($stmt);

        // Verificar si ya hay una solicitud de amistad pendiente
        $consulta_solicitud_pendiente = "SELECT id_amistad FROM amigos WHERE ((id_usuario1 = ? AND id_usuario2 = ?) OR (id_usuario1 = ? AND id_usuario2 = ?)) AND estado = 'pendiente'";
        $stmt_solicitud_pendiente = mysqli_prepare($conex, $consulta_solicitud_pendiente);
        mysqli_stmt_bind_param($stmt_solicitud_pendiente, "iiii", $id_usuario, $id_amigo, $id_amigo, $id_usuario);
        mysqli_stmt_execute($stmt_solicitud_pendiente);
        mysqli_stmt_store_result($stmt_solicitud_pendiente);

        if(mysqli_stmt_num_rows($stmt_solicitud_pendiente) > 0) {//si hay enviado una solicitud a este amigo mandar mensaje de abajo
            echo "Ya has enviado una solicitud de amistad a este usuario.";
        } else {
            // Agregar la solicitud de amistad a la tabla solicitudes_amistad
            $consulta_insertar_solicitud = "INSERT INTO solicitudes_amistad (id_usuario_envia, id_usuario_recibe, fecha_envio, estado) VALUES (?, ?, NOW(), 'pendiente')";
            $stmt_insertar_solicitud = mysqli_prepare($conex, $consulta_insertar_solicitud);
            mysqli_stmt_bind_param($stmt_insertar_solicitud, "ii", $id_usuario, $id_amigo);
            $resultado_insertar_solicitud = mysqli_stmt_execute($stmt_insertar_solicitud);

            if($resultado_insertar_solicitud) {
                // Agregar la solicitud de amistad a la tabla amigos
                $consulta_enviar_solicitud = "INSERT INTO amigos (id_usuario1, id_usuario2, estado) VALUES (?, ?, 'pendiente')";
                $stmt_enviar_solicitud = mysqli_prepare($conex, $consulta_enviar_solicitud);
                mysqli_stmt_bind_param($stmt_enviar_solicitud, "ii", $id_usuario, $id_amigo);
                $resultado_enviar_solicitud = mysqli_stmt_execute($stmt_enviar_solicitud);

                if($resultado_enviar_solicitud) {
                    echo "Solicitud de amistad enviada correctamente.";
                } else {
                    echo "Error al enviar la solicitud de amistad.";
                }
            } else {
                echo "Error al enviar la solicitud de amistad.";
            }
        }
    } else {
        echo "No se encontró ningún usuario con el correo proporcionado.";
    }
} else {
    echo "No se recibió información del amigo.";
}
?>
