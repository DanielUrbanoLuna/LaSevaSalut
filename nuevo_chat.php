<?php
session_start();

include("conexion.php");

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    echo '
        <script>
            alert("Por favor, debes iniciar sesión.");
            window.location = "index.php";
        </script>
    ';
    session_destroy();
    die();
}

// Obtener el ID del amigo y el ID del usuario actual
$id_amigo = $_POST['id_amigo'];
$id_usuario = $_SESSION['id_usuario'];

// Insertar un nuevo registro en la tabla de historial_chat para iniciar el chat
$insertar_chat = "INSERT INTO historial_chat (id_usuario, id_amigo, mensaje) VALUES ('$id_usuario', '$id_amigo', '¡Hola! Empecemos a chatear.')";
if (mysqli_query($conex, $insertar_chat)) {
    // Obtener y mostrar el historial de chat actualizado
    include("chatamigos.php");
} else {
    echo "Error al crear el nuevo chat: " . mysqli_error($conex);
}
?>
