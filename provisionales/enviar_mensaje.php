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

// Verificar si se recibieron los datos del mensaje
if (isset($_POST['mensaje']) && isset($_POST['id_amigo'])) {
    $mensaje = $_POST['mensaje'];
    $id_amigo = $_POST['id_amigo'];

    // Obtener el ID del usuario actual desde la sesión
    $id_usuario = $_SESSION['id_usuario'];

    // Insertar el mensaje en la base de datos
    $consulta_insertar_mensaje = "INSERT INTO historial_chat (id_usuario, id_amigo, mensaje) VALUES ('$id_usuario', '$id_amigo', '$mensaje')";
    $resultado_insertar_mensaje = mysqli_query($conex, $consulta_insertar_mensaje);

    if ($resultado_insertar_mensaje) {
        echo "Mensaje enviado correctamente.";
        // Redirigir al perfil después de 1 segundo de enviar el mensaje
        echo '
            <script>
                setTimeout(function(){
                    window.location = "perfilUsuario.php?id_amigo=' . $id_amigo . '";
                }, 1000);
            </script>
        ';
    } else {
        echo "Error al enviar el mensaje.";
    }
} else {
    echo "No se recibieron los datos del mensaje.";
}
?>
