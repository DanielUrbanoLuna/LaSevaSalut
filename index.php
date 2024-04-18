<?php

    session_start();

    if(isset($_SESSION['usuario'])){//entrar directo al perfil del usuario que se habia conectado con anterioridad..
        //..para no tener que volver a loguearte
        header("location: perfilUsuario.php");
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaSevaSalut</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css"><!-- en la fila 18, librería ajax para usar iconos y estilo css con el archivo style.css -->
</head>
<body>
<?php
?>
    <h1><i class="fa-solid fa-dog"></i> La Seva Salut <i class="fa-solid fa-cat"></i></h1>
    <header class="header">

        <!-- Usar <div para encapsular por secciones y darles estilo con archivo css -->
        <div class="menu container">
            <a href="#" class="logo">LaSevaSalut</a>
            <label for="menu">
            </label>
            <nav class="nave"><!-- Menu con directrices a donde direccionar en caso de clicar en cada uno -->
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#nosotros">Nosotros</a></li>
                    <li><a href="#servicios">Servicios</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <li><a href="#registrar">Registrarse</a></li>
                    <li><a href="#iniciar sesion">Iniciar sesión</a></li>
                </ul>
            </nav>
        </div>

    </header>

    <div class="header-content container">
            <div class="header-txt">
                <h1>La salud de tu Mascota</h1>
                <p><!-- Breve explicación para dar contenido -->
                LaSevaSalut es una aplicación diseñada para 
                brindar un seguimiento completo y personalizado 
                de la salud de tus mascotas. Con nuestra plataforma, 
                podrás llevar un registro detallado de las vacunas, 
                desparasitaciones, visitas al veterinario y más, todo 
                en un solo lugar. Nunca más perderás de vista la salud 
                de tu fiel compañero. Únete a nosotros y descubre cómo 
                podemos hacer que cuidar de tus mascotas sea más fácil 
                y conveniente que nunca.
                </p>
            </div>
            <div class="header-img">
                <img src="img/mascota1.jpg" alt=""><!-- insertar imagen indicando la ruta, siendo la misma ruta que los archivos -->
            </div>
        </div>

    <section class="about container">

        <div class="about-txt">
            <h2 id="nosotros">Nosotros</h2>

            <p>
            LaSevaSalut nace de la combinación de ser un alumno 
            que desea aprender y poner en práctica lo aprendido 
            a la vez de crear soluciones útiles. He decidido 
            enfocar mis esfuerzos en el desarrollo de una aplicación 
            dedicada al cuidado de las mascotas. Reconozco 
            la importancia que tienen nuestras mascotas en 
            nuestras vidas y la necesidad de mantener su 
            salud en óptimas condiciones. Es por ello que 
            he puesto mi atención en crear una herramienta 
            que facilite a los dueños de mascotas llevar un 
            registro detallado y actualizado de la salud de 
            sus queridos compañeros.
            </p>
            <br>
            <p>
            Entiendo que mantener al día la salud de nuestras 
            mascotas puede ser una tarea desafiante en medio de 
            nuestras ya ocupadas vidas. Mi objetivo creando esta 
            aplicación es proporcionar una solución práctica y 
            eficiente para ayudar a los amantes de los animales 
            a gestionar la salud y el bienestar de sus mascotas 
            de manera efectiva. Juntos, podemos garantizar que 
            nuestros fieles compañeros disfruten de una vida larga 
            y saludable e ir convirtiendo esta herramienta, a partir 
            de renovaciones y actualizaciones, en una cada vez más 
            aplicación completa y de utilidad a todas esas personas 
            que queremos tener controlado el bienestar y la salud de 
            nuestros compañeros de vida no humanos.
            </p>
        </div>

        <div class="about-img">
            <img src="img/mascota2.jpg" alt="">
        </div>

    </section>
    
    <main class="Servicios"><!-- Servicios que tiene la aplicación -->
        <h2 id="servicios">Servicios que podrás disfrutar</h2>
       
        <div class="Servicios-content container">

            <div class="Servicio-1">
                <i class="fa-solid fa-pencil"></i>
                <h3>registros mascotas</h3>
            </div>
        
            <div class="Servicio-1">
            <i class="fa-solid fa-bell"></i>
            <h3>Avisos futuras visitas veterinarias</h3>
            </div>

            <div class="Servicio-1">
            <i class="fa-solid fa-syringe"></i>
            <h3>vacunas</h3>
            </div>

            <div class="Servicio-1">
            <i class="fa-solid fa-house-medical"></i>

            <!-- Sección para chatear con otros usuarios a los que tienes agregados como amigos -->
            <h3>Comparte con tus amigos</h3>
            </div>
        </div>
    </main>


    <section class="formulario container">

        <form action="login_usuario.php" method="post" autocomplete="off">

            <h2 id="iniciar sesion">Iniciar sesión</h2>
            <!-- Sección Iniciar sesión llamando a archivo login_usuario.php para funcionalidad con la base de datos -->

            <div class="input-group"><!-- Aportar correo y contraseña para iniciar sesión -->

                <div class="input-container">
                    <input type="correo" name="correo" placeholder="Correo electrónico">
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div class="input-container">
                    <input type="text" name="contrasena" placeholder="Contraseña">
                    <i class="fa-regular fa-keyboard"></i>                
                </div>

                <input type="submit" name="submit" class="btn" value="Iniciar sesión"><!-- Botón de iniciar sesión -->

            </div>

        </form>

    </section>

    <section class="formulario container">

        <form action="send.php" method="post" autocomplete="off">

        <!-- Sección para registrarse llamando archivo send.php para funcionalidad con base de datos para añadir nuevos usuarios -->
            <h2 id="registrar">Eres nuevo? Registrarse</h2>

            <div class="input-group">

                <div class="input-container">
                    <input type="text" name="name" placeholder="Nombre y Apellido">
                    <i class="fa-solid fa-circle-user"></i>                </div>

                <div class="input-container">
                    <input type="correo" name="correo" placeholder="Correo electrónico">
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div class="input-container">
                    <input type="usuario" name="usuario" placeholder="Usuario">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="input-container">
                    <input type="text" name="contrasena" placeholder="Contraseña">
                    <i class="fa-regular fa-keyboard"></i>                
                </div>

                <input type="submit" name="submit" class="btn" value="Registrarse">

            </div>

        </form>

    </section>

    <footer class="footer">

        <div class="footer-content container">

            <div class="link"><!-- Logo en footer a la izquierda de los demás apartados del footer -->
                <a href="#" class="logo">LaSevaSalut</a>
            </div>

            <div class="link">
                <ul><!-- Links a diferentes partes del index.php y a contacto.php -->
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#nosotros">Nosotros</a></li>
                    <li><a href="#servicios">Servicios</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                </ul>
            </div>

        </div>

    </footer>

    <?php
        include("send.php");
    ?>

    <script>
        function myFunction() {
            window.location.href="http://localhost/LaSevaSalut"
        }
    </script>
    
</body>
</html>