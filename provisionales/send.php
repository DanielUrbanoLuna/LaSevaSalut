<?php

include("conexion.php");

if(isset($_POST['submit'])) {
    if(
        strlen($_POST['name']) >= 1 &&
        strlen($_POST['correo']) >= 1 &&
        strlen($_POST['usuario']) >= 1 &&
        strlen($_POST['contrasena']) >= 1 
    ) {
        $name = trim($_POST['name']);
        $correo = trim($_POST['correo']);
        $usuario = trim($_POST['usuario']);
        $contrasena = trim($_POST['contrasena']);
        $consulta = "INSERT INTO usuarios(nombre, correo, usuario, contrasena)
                VALUES ('$name', '$correo', '$usuario', '$contrasena')";

        $consulta2 = "INSERT INTO mascotas(correo)
                VALUES ('$correo')";
        
        //Verificamos que el correo no se repita en la base de datos
        $verificar_correo = mysqli_query($conex, "SELECT * FROM usuarios WHERE correo='$correo'");

        if(mysqli_num_rows($verificar_correo) > 0) {
            echo '
                <script>
                    alert("Este correo ya tiene cuenta registrada, prueba con otro diferente");
                    window.location = "index.php";
                </script>
            ';
            exit();
        }

        //Verificamos que el usuario no se repita en la base de datos
        $verificar_usuario = mysqli_query($conex, "SELECT * FROM usuarios WHERE usuario='$usuario'");

        if(mysqli_num_rows($verificar_usuario) > 0) {
            echo '
                <script>
                    alert("Este usuario ya tiene cuenta registrada, prueba con otro diferente");
                    window.location = "index.php";
                </script>
            ';
            exit();
        }

        $resultado = mysqli_query($conex, $consulta);
    }

    if($resultado) {
        echo '
            <script>
                alert("Usuario registrado correctamente.");
                window.location = "index.php";
            </script>
        ';
    }else {
        echo '
            <script>
                alert("Error: Usuario no registrado, inténtelo de nuevo.");
                window.location = "index.php";
            </script>
        ';
    }
}

mysqli_close($conex);

?>