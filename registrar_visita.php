<?php
session_start();

include("conexion.php");

function insertarAlertaRecordatorio($conex, $id_usuario, $mensaje) {
    $fecha_actual = date("Y-m-d");
    $consulta = "INSERT INTO alertas (id_usuario, mensaje, fecha) VALUES ('$id_usuario', '$mensaje', '$fecha_actual')";
    $resultado = mysqli_query($conex, $consulta);
    return $resultado;
}

if(isset($_POST['tipo_visita'], $_POST['fecha_visita'], $_POST['id_mascota'])) {
    $id_mascota = $_POST['id_mascota'];
    $tipo_visita = $_POST['tipo_visita'];
    $fecha_visita = $_POST['fecha_visita'];

    // Insertar la visita en la tabla 'visitas'
    $consulta_visita = "INSERT INTO visitas (id_mascota, tipo_visita, fecha_visita) VALUES ('$id_mascota', '$tipo_visita', '$fecha_visita')";
    $resultado_visita = mysqli_query($conex, $consulta_visita);

    if($resultado_visita) {
        // Obtener el ID de usuario asociado al dueño de la mascota
        $consulta_id_usuario = "SELECT id_usuario FROM mascotas WHERE id_mascota = $id_mascota";
        $resultado_id_usuario = mysqli_query($conex, $consulta_id_usuario);
        $fila_id_usuario = mysqli_fetch_assoc($resultado_id_usuario);
        $id_usuario = $fila_id_usuario['id_usuario'];

        // Enviar alerta al perfil del dueño de la mascota
        $mensaje_alerta = "Recuerda, el día $fecha_visita tu mascota tiene una visita de tipo $tipo_visita.";
        insertarAlertaRecordatorio($conex, $id_usuario, $mensaje_alerta);

        echo '<script>alert("Visita registrada correctamente."); window.location = "perfil_mascota.php?id_mascota='.$id_mascota.'";</script>';
    } else {
        echo '<script>alert("Error: No se pudo registrar la visita."); window.location = "perfil_usuario.php";</script>';
    }
}

mysqli_close($conex);
?>
