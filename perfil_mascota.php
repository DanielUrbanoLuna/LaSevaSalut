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

// Obtener el ID de la mascota desde la URL
if(isset($_GET['id_mascota'])) {
    $id_mascota = $_GET['id_mascota'];

    // Consulta para obtener el nombre de la mascota
    $consulta_nombre_mascota = "SELECT nombre_mascota FROM mascotas WHERE id_mascota = $id_mascota";
    $resultado_nombre_mascota = mysqli_query($conex, $consulta_nombre_mascota);

    if($fila = mysqli_fetch_assoc($resultado_nombre_mascota)) {
        $nombre_mascota = $fila['nombre_mascota'];
    } else {
        echo "No se encontró la mascota solicitada.";
        exit();
    }

    // Consulta para obtener las visitas pendientes
    $consulta_visitas_pendientes = "SELECT * FROM visitas WHERE id_mascota = $id_mascota AND fecha_visita > CURDATE()";
    $resultado_visitas_pendientes = mysqli_query($conex, $consulta_visitas_pendientes);
    $num_visitas_pendientes = mysqli_num_rows($resultado_visitas_pendientes);
} else {
    echo "ID de mascota no especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Mascota</title>
    <link rel="stylesheet" href="estiloperfilusuario.css"> 
</head>
<body>
    <div class="section-container">
    <h1>Bienvenido al perfil de <?php echo $nombre_mascota; ?></h1>
    <a href="perfilUsuario.php">Regresar al perfil de mi dueño</a>
    </div>

    <!-- Sección para registrar futura nueva visita veterinaria, con las especialidades de visita disponible, llamando archivo registrar_visita.php para funcionalidades con la base de datos. -->
    <!-- Guardará la visita y la mostrará en la sección recordatorios del perfil del usuario -->
    <div class="section-container">
    <h2>Registrar Visita Veterinaria Futura</h2>
    <form action="registrar_visita.php" method="post">
        <label for="tipo_visita">Tipo de Visita:</label>
        <select name="tipo_visita" id="tipo_visita">
            <option value="chequeos_generales">Chequeos Generales</option>
            <option value="vacunacion">Visitas de vacunación</option>
            <option value="esterilización">Visitas por esterilización</option>
            <option value="lesión física">Visitas por lesión física</option>
            <option value="dermatología">Visitas de dermatología</option>
            <option value="odontología">Visitas de odontología</option>
            <option value="oftalmología">Visitas de oftalmología</option>
            <option value="geriátría">Visitas geriátría</option>
            <option value="medicina preventiva">Visitas de medicina preventiva</option>
            <option value="sistema digestivo">Visitas de sistema digestivo</option>
            <option value="analíticas">Visitas para analíticas</option>
            <option value="otros motivos">Visitas por otros motivos</option>
        </select><br><br>

        <label for="fecha_visita">Fecha de la Visita:</label>
        <input type="date" id="fecha_visita" name="fecha_visita"><br><br>
        <input type="hidden" name="id_mascota" value="<?php echo $id_mascota; ?>"> 
        <input type="submit" value="Registrar Visita">
    </form>
    </div>

    <?php if ($num_visitas_pendientes > 0) { ?>
        <!--Si hay visitas pendientes las mostrará en la sección visitas pendientes-->
    <div class="section-container">
    <h2>Visitas Pendientes</h2>
    <p>Tienes <?php echo $num_visitas_pendientes; ?> visitas pendientes:</p>
    <ul> <!--mientras haya visitas, mostrará el tipo de visita con su fecha-->
        <?php while ($fila_visita = mysqli_fetch_assoc($resultado_visitas_pendientes)) { ?>
            <li><?php echo $fila_visita['tipo_visita']; ?> - <?php echo $fila_visita['fecha_visita']; ?></li>
        <?php } ?>
    </ul>
    </div>
    <?php } ?>

    <div class="section-container">
    <form action="registrar_vacuna.php" method="post"> <!--Registrar vacunas suministradas llamando archivo registrar_vacuna.php-->
        <label for="tipo_vacuna">Vacunas administradas:</label>
            <select name="tipo_vacuna" id="tipo_vacuna"> <!--tipos de vacunas disponibles para registrar en la base de datos-->
                <option value="rabia">Rabia</option>
                <option value="moquillo">Moquillo</option>
                <option value="parvovirosis">Parvovirosis</option>
                <option value="hepatitis infecciosa canina">Hepatitis infecciosa canina</option>
                <option value="tos de las perreras">Tos de las perreras</option>
                <option value="herpervirus felino">Herpervirus felino</option>
                <option value="calicivirus felino">Calicivirus felino</option>
                <option value="panleucopenia felina">Panleucopenia felina</option>
                <option value="leucemia felina">Leucemia felina</option>
            </select><br><br>
            <input type="hidden" name="id_mascota" value="<?php echo $id_mascota; ?>"> 
            <input type="submit" value="Registrar Vacuna">
    </form>
    </div>

    <div class="section-container">
    <h2>Vacunas Registradas</h2> <!--sección que mostrará las vacunas que tiene la mascota suministrada, consultándolas en la base de datos con un SELECT-->
    <?php
    $consulta_vacunas = "SELECT vacunas FROM perfil_mascota WHERE id_mascota = $id_mascota";
    $resultado_vacunas = mysqli_query($conex, $consulta_vacunas);
    if($fila = mysqli_fetch_assoc($resultado_vacunas)) {
    $vacunas = explode(',', $fila['vacunas']);
    echo "<ul>";
    foreach($vacunas as $vacuna) {
        echo "<li>$vacuna</li>";
    }
    echo "</ul>";
} else {
    echo "No hay vacunas registradas para esta mascota.";
}
?>
    </div>


</body>
</html>
