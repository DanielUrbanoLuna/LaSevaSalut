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

// Consulta para obtener las mascotas del usuario actual
$correo = $_SESSION['usuario'];
$consulta_mascotas = "SELECT id_mascota, nombre_mascota FROM mascotas WHERE id_usuario IN (SELECT id FROM usuarios WHERE correo = '$correo')";
$resultado_mascotas = mysqli_query($conex, $consulta_mascotas);

// Obtener el ID de usuario asociado al correo electrónico del usuario actual
$consulta_id_usuario = "SELECT id FROM usuarios WHERE correo = '$correo'";
$resultado_id_usuario = mysqli_query($conex, $consulta_id_usuario);
$fila_id_usuario = mysqli_fetch_assoc($resultado_id_usuario);
$id_usuario = $fila_id_usuario['id'];

$_SESSION['id_usuario'] = $id_usuario;

// Consulta para obtener la lista de amigos del usuario
$consulta_amigos = "SELECT id_usuario1, id_usuario2 FROM amigos WHERE id_usuario1 = '$id_usuario' OR id_usuario2 = '$id_usuario'";
$resultado_amigos = mysqli_query($conex, $consulta_amigos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="estiloperfilusuario.css"> 
</head>
<body>
    <div class="section-container">
    <h1>Bienvenido/a a tu perfil, <?php echo $_SESSION['usuario']; ?></h1>
    <a href="cerrar_sesion.php">Cerrar sesión</a> <!--Enlace para cerrar sesión llamando archivo cerrar_sesion.php y volver a index.php-->
    </div>

    <div class="section-container">
    <div class="header-img">
                <img src="img/mascota3.jpg" alt="">
    </div>
    </div>

    <div class="section-container">
    <h2>Registrar Mascota</h2>
    <form action="registrar_mascota.php" method="post">
        <!-- Sección para registrar mascota indicando su nombre, si es perro o gato, género, edad, raza y peso -->
        <label for="nombre_mascota">Nombre de la mascota:</label>
        <input type="text" id="nombre_mascota" name="nombre_mascota" required><br><br>

        <label for="tipo_mascota">Tipo de mascota:</label>
        <select id="tipo_mascota" name="tipo_mascota" required>
            <option value="Perro">Perro</option>
            <option value="Gato">Gato</option>
        </select><br><br>

        <label for="genero">Género:</label>
        <select id="genero" name="genero" required>
            <option value="Macho">Macho</option>
            <option value="Hembra">Hembra</option>
        </select><br><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required><br><br>

        <label for="raza">Raza:</label>
        <input type="text" id="raza" name="raza"><br><br>

        <label for="peso">Peso:</label>
        <input type="number" id="peso" name="peso" step="0.01" required><br><br>

        <!-- botón para registrar a la mascota, y almacenarla en la base de datos relacionandola con su dueño -->
        <input type="submit" value="Registrar Mascota">
    </form>
    </div>

    <div class="section-container">
    <h2>Ir al perfil de mi mascota:</h2>
    <form action="perfil_mascota.php" method="get"> <!--sección con opción de elegir mascota y ir a su perfil de la mascota llamando al archivo perfil_mascota.php-->
        <select name="id_mascota">
            <?php
            while ($fila = mysqli_fetch_assoc($resultado_mascotas)) {
                echo "<option value='" . $fila['id_mascota'] . "'>" . $fila['nombre_mascota'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Ir al perfil"> <!--botón para ir al perfil de la mascota-->
    </form>
    </div>

    <div class="section-container">
    <h2>Recordatorios</h2>
    <div id="recordatorios">
        <?php
        // Consulta para obtener los recordatorios del usuario
        $consulta_recordatorios = "SELECT mensaje, fecha FROM alertas WHERE id_usuario = $id_usuario ORDER BY fecha DESC";
        $resultado_recordatorios = mysqli_query($conex, $consulta_recordatorios);

        // Mostrar los recordatorios
        while ($fila_recordatorio = mysqli_fetch_assoc($resultado_recordatorios)) {
            echo "<p>{$fila_recordatorio['fecha']}: {$fila_recordatorio['mensaje']}</p>";
        }
        ?>
    </div>
    </div>

    <div class="section-container">
    <h2>Solicitudes de amistad pendientes</h2>
    <div id="solicitudes_pendientes">
        <?php
        // Consulta para obtener las solicitudes de amistad pendientes para el usuario actual
        $consulta_solicitudes_pendientes = "SELECT id, id_usuario_envia FROM solicitudes_amistad WHERE id_usuario_recibe = $id_usuario AND estado = 'pendiente'";
        $resultado_solicitudes_pendientes = mysqli_query($conex, $consulta_solicitudes_pendientes);

        // Mostrar las solicitudes pendientes
        while ($fila_solicitud = mysqli_fetch_assoc($resultado_solicitudes_pendientes)) {
            // Obtener el ID del usuario que envió la solicitud
            $id_usuario_envia = $fila_solicitud['id_usuario_envia'];

            // Consultar el nombre del usuario que envió la solicitud
            $consulta_nombre_envia = "SELECT nombre FROM usuarios WHERE id = $id_usuario_envia";
            $resultado_nombre_envia = mysqli_query($conex, $consulta_nombre_envia);
            $fila_nombre_envia = mysqli_fetch_assoc($resultado_nombre_envia);
            $nombre_envia = $fila_nombre_envia['nombre'];

            // Mostrar el nombre del usuario que envió la solicitud y los botones de aceptar y rechazar
            echo "<p>$nombre_envia te ha enviado una solicitud de amistad. ¿Aceptar o rechazar?</p>";
            echo "<button class='aceptar_solicitud' data-id='{$fila_solicitud['id']}'>Aceptar</button>";
            echo "<button class='rechazar_solicitud' data-id='{$fila_solicitud['id']}'>Rechazar</button>";
        }
        ?>
    </div>
    </div>

    <div class="section-container">
    <h2>Amigos con los que compartir</h2>
    <div id="lista_amigos">
    <?php   
    // Mostrar la lista de amigos del usuario
    $amigos = array(); // Array para almacenar los ID de amigos
    while ($fila_amigo = mysqli_fetch_assoc($resultado_amigos)) {
        // Determinar el ID del amigo basado en las columnas id_usuario1 e id_usuario2
        $id_amigo = ($fila_amigo['id_usuario1'] == $id_usuario) ? $fila_amigo['id_usuario2'] : $fila_amigo['id_usuario1'];
        
        // Consultar el estado de la amistad para este par de usuarios
        $consulta_estado_amistad = "SELECT estado FROM solicitudes_amistad WHERE (id_usuario_envia = '$id_usuario' AND id_usuario_recibe = '$id_amigo') OR (id_usuario_envia = '$id_amigo' AND id_usuario_recibe = '$id_usuario')";
        $resultado_estado_amistad = mysqli_query($conex, $consulta_estado_amistad);
        $fila_estado_amistad = mysqli_fetch_assoc($resultado_estado_amistad);
        $estado_amistad = $fila_estado_amistad['estado'];
        
        // Si la amistad está aceptada, mostrar el amigo
        if ($estado_amistad == 'aceptada') {
            // Verificar si el amigo ya está en la lista
            if (!in_array($id_amigo, $amigos)) {
                // Agregar el ID del amigo al array
                $amigos[] = $id_amigo;

                // Consultar el nombre del amigo utilizando su ID
                $consulta_nombre_amigo = "SELECT nombre FROM usuarios WHERE id = '$id_amigo'";
                $resultado_nombre_amigo = mysqli_query($conex, $consulta_nombre_amigo);

                // Verificar si la consulta devolvió resultados válidos
                if(mysqli_num_rows($resultado_nombre_amigo) > 0) {
                    // Extraer el nombre del amigo si hay resultados
                    $fila_nombre_amigo = mysqli_fetch_assoc($resultado_nombre_amigo);
                    $nombre_amigo = $fila_nombre_amigo['nombre'];
                    
                    // Imprimir el nombre del amigo como un enlace cliclable para abrir el chat
                    echo "<p><a href='#' class='nombre_amigo' data-id-amigo='$id_amigo'>$nombre_amigo</a></p>";
                } else {
                    // Manejar el caso donde no se encuentra el nombre del amigo
                    echo "<p>No se encontró el nombre del amigo.</p>";
                }
            }
        }
    }
    ?>
    </div>
    
    <div id="chat_window">
    <!-- Ventana de chat -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Librería ajax para el chat -->

    <script>
    // Manejar clic en el nombre del amigo
    $(document).on("click", ".nombre_amigo", function(event){
    event.preventDefault();
    var id_amigo = $(this).data("id-amigo");
    $.ajax({
        url: "chatamigos.php",
        method: "POST",
        data: { id_amigo: id_amigo },
        success: function(data){
            if(data.trim() === '') {
                // Si no hay conversación previa, abrir un nuevo chat
                $.ajax({
                    url: "nuevo_chat.php", // Ruta al archivo que maneja la creación de un nuevo chat
                    method: "POST",
                    data: { id_amigo: id_amigo },
                    success: function(newChatData){
                        $("#chat_window").html(newChatData);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                // Mostrar la conversación existente
                $("#chat_window").html(data);
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});
    </script>

    </script>
    </div>

    <div class="section-container">
    <h2>Agregar amigo</h2>
    <form id="form_agregar_amigo" action="agregar_amigo.php" method="post">
        <input type="text" name="correo_amigo" placeholder="Correo del amigo" required>
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
        <input type="submit" value="Agregar amigo">
    </form> <!--mandar solicitud amistad a usuario indicando su correo, llamando archivo agregar_amigo.php para funcionalidades de enviar solicitud y guardar en la base de datos-->

    <script>
            // Enviar solicitud de amistad cuando se envía el formulario de agregar amigo
            $("#form_agregar_amigo").submit(function(e){
                e.preventDefault();
                var correo_amigo = $(this).find("input[name='correo_amigo']").val();
                var id_usuario = $(this).find("input[name='id_usuario']").val();
                $.ajax({//almacenar solicitud en base de datos llamando archivo enviar_solicitud_amistad.php
                    url: "enviar_solicitud_amistad.php",
                    method: "POST",
                    data: { correo_amigo: correo_amigo, id_usuario: id_usuario },
                    success: function(data){
                        alert(data); // Mostrar mensaje de éxito o error
                    }
                });
            });

            // Manejar clics en botones de aceptar solicitud
            $(".aceptar_solicitud").click(function() {
                var id_solicitud = $(this).data("id");
                $.ajax({
                    url: "aceptar_solicitud.php",
                    method: "POST",
                    data: { id_solicitud: id_solicitud },
                    success: function(data) {
                        alert(data); // Mostrar mensaje de éxito o error
                        // Actualizar la lista de solicitudes pendientes
                        $("#solicitudes_pendientes").load("perfilUsuario.php #solicitudes_pendientes");
                        // Actualizar la lista de amigos
                        $("#lista_amigos").load("perfilUsuario.php #lista_amigos");
                    }
                });
            });

            // Manejar clics en botones de rechazar solicitud
            $(".rechazar_solicitud").click(function() {
                var id_solicitud = $(this).data("id");
                $.ajax({//usar ajax para que al rechazar usuario no se deba recargar la página. Se rechaza llamando a rechazar_solicitud.php para interactuar con la base de datos
                    url: "rechazar_solicitud.php",
                    method: "POST",
                    data: { id_solicitud: id_solicitud },
                    success: function(data) {
                        alert(data); // Mostrar mensaje de éxito o error
                        // Actualizar la lista de solicitudes pendientes
                        $("#solicitudes_pendientes").load("perfilUsuario.php #solicitudes_pendientes");
                    }
                });
            });
        
    </script>
    </div>

</body>
</html>
