<?php
session_start();

include("conexion.php");

if(isset($_POST['nombre_mascota'], $_POST['tipo_mascota'], $_POST['genero'], $_POST['edad'], $_POST['peso'])) {
    $nombre_mascota = $_POST['nombre_mascota'];
    $tipo_mascota = $_POST['tipo_mascota'];
    $genero = $_POST['genero'];
    $edad = $_POST['edad'];
    $raza = isset($_POST['raza']) ? $_POST['raza'] : ''; // Si no se especifica la raza, dejarla como cadena vacía
    $peso = $_POST['peso'];

    // Obtener el correo del usuario actual
    $correo = $_SESSION['usuario'];

    // Obtener el ID de usuario asociado al correo electrónico
    $consulta_id_usuario = "SELECT id FROM usuarios WHERE correo = '$correo'";
    $resultado_id_usuario = mysqli_query($conex, $consulta_id_usuario);

    if ($fila = mysqli_fetch_assoc($resultado_id_usuario)) {
        $id_usuario = $fila['id'];

        // Insertar la mascota en la tabla 'mascotas'
        $consulta_mascota = "INSERT INTO mascotas (nombre_mascota, tipo_mascota, genero, edad, raza, peso, id_usuario, correo)
                     VALUES ('$nombre_mascota', '$tipo_mascota', '$genero', '$edad', '$raza', '$peso', '$id_usuario', '$correo')";

        $resultado_mascota = mysqli_query($conex, $consulta_mascota);

        if($resultado_mascota) {
            // Obtener el ID de la mascota recién insertada
            $id_mascota = mysqli_insert_id($conex);

            // Insertar el perfil de la mascota en la tabla 'perfil_mascota'
            $consulta_perfil = "INSERT INTO perfil_mascota (nombre_mascota, id_mascota) VALUES ('$nombre_mascota', '$id_mascota')";
            $resultado_perfil = mysqli_query($conex, $consulta_perfil);

            if($resultado_perfil) {
                echo '
                    <script>
                        alert("Se ha registrado su mascota correctamente y se le ha creado un perfil.");
                        // Redirigir a perfil_mascota.php
                        window.location.href = "perfil_mascota.php?id_mascota='.$id_mascota.'";
                    </script>
                ';
                    exit();
            } else {
                echo '
                    <script>
                        alert("Error: No se pudo crear el perfil de la mascota.");
                        window.location = "perfilUsuario.php";
                    </script>
                ';
                exit();
            }
        } else {
            echo '
                <script>
                    alert("Error: No se pudo registrar la mascota.");
                    window.location = "perfilUsuario.php";
                </script>
            ';
            exit();
        }
    } else {
        // Si no se encuentra el ID de usuario, muestra un mensaje de error o realiza alguna otra acción adecuada
        echo "Error: No se pudo encontrar el ID de usuario asociado al correo electrónico del usuario actual.";
        exit();
    }
}

mysqli_close($conex);
?>
