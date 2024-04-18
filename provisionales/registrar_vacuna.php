<?php
session_start();

include("conexion.php");

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

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_mascota = $_POST['id_mascota'];
    $tipo_vacuna = $_POST['tipo_vacuna'];

    // Consulta para actualizar las vacunas en la tabla perfil_mascota
    $consulta_actualizar_vacunas = "UPDATE perfil_mascota SET vacunas = CONCAT_WS(',', vacunas, '$tipo_vacuna') WHERE id_mascota = $id_mascota";
    if(mysqli_query($conex, $consulta_actualizar_vacunas)) {
        echo "Vacuna registrada correctamente.";
        // Después de registrar la vacuna, se vuelve al perfil de la mascota con una secuencia..
        // *de JavaScript que redirige automáticamente a la página del perfil de la mascota..
        // *correspondiente después de 2 segundos.
        echo '<script>
                  setTimeout(function() {
                      window.location = "perfil_mascota.php?id_mascota='.$id_mascota.'";
                  }, 2000);
              </script>';
    } else {
        echo "Error al registrar la vacuna: " . mysqli_error($conex);
    }
}
?>
