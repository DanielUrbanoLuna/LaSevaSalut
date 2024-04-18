<?php
session_start();

include("conexion.php");

// Verificar si el usuario está autenticado
if(!isset($_SESSION['usuario'])){
    echo '
        <script>
            alert("Por favor, debes iniciar sesión.");
            window.location = "index.php";
        </script>
    ';
    session_destroy();
    die();
}

// Obtener el ID del amigo a partir de la solicitud POST
if(isset($_POST['id_amigo'])) {
    $id_amigo = $_POST['id_amigo'];

    // Obtener el ID del usuario actual desde la sesión
    $id_usuario = $_SESSION['id_usuario'];

    // Consultar el nombre del amigo utilizando su ID
    $consulta_nombre_amigo = "SELECT nombre FROM usuarios WHERE id = '$id_amigo'";
    $resultado_nombre_amigo = mysqli_query($conex, $consulta_nombre_amigo);

    if(mysqli_num_rows($resultado_nombre_amigo) > 0) {
        $fila_nombre_amigo = mysqli_fetch_assoc($resultado_nombre_amigo);
        $nombre_amigo = $fila_nombre_amigo['nombre'];

        // Mostrar el nombre del amigo
        echo "<h1>Chat con $nombre_amigo</h1>";

        // Incluir el formulario para enviar mensajes
        include("formulario_mensaje.php");

        // Consultar y mostrar el historial de chat entre el usuario y el amigo
        $consulta_chat = "SELECT hc.mensaje, u.nombre AS nombre_usuario FROM historial_chat hc JOIN usuarios u ON hc.id_usuario = u.id WHERE (hc.id_usuario = '$id_usuario' AND hc.id_amigo = '$id_amigo') OR (hc.id_usuario = '$id_amigo' AND hc.id_amigo = '$id_usuario') ORDER BY hc.fecha_envio ASC";
        $resultado_chat = mysqli_query($conex, $consulta_chat);

        echo "<div id='chat_history'>";
        while($fila_chat = mysqli_fetch_assoc($resultado_chat)) {//mientras se detecta usuario amigo...
            echo "<p>{$fila_chat['nombre_usuario']}: {$fila_chat['mensaje']}</p>";//nombre del amigo: + mensaje
        }
        echo "</div>";
    } else {//si no, mensaje de que no se encontró el nombre del amigo
        echo "No se encontró el nombre del amigo.";
    }
} else {
    echo "No se recibió información del amigo.";
}
?>
