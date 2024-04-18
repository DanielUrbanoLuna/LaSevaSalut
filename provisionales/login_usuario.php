<?php

session_start();

include("conexion.php");

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$validar_login = mysqli_query($conex, "SELECT * FROM usuarios WHERE correo='$correo' and contrasena='$contrasena'");

if(mysqli_num_rows($validar_login) > 0){
    // Establezco la sesión del usuario
    $_SESSION['usuario'] = $correo;
    //Dirijo al usuario a la página de perfil de usuario
    header("location: perfilUsuario.php");
    exit();
}else{
    echo '
                <script>
                    alert("Correo o contraseña no encontrados, por favor, revise los datos introducidos.");
                    window.location = "index.php";
                </script>
            ';
            exit();
}

?>