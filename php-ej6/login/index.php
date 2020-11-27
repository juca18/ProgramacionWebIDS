<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    include_once "../app/authController.php";
    include "../layouts/alerts.template.php";
?>

<html>
    <head>
        <title>Consulta</title>
        <style type="text/css">
            fieldset{
                weight:400px;
            }
        </style>
    </head>
    <body>
        <?php
            if(isset($_SESSION) && isset($_SESSION['error'])){
                echo "<h3>Error: ".$_SESSION['error']."</h3>";
                unset($_SESSION['error']);
            }
        ?>

        <fieldset>
            <legend>
                Login
            </legend>

            <form method="POST" action="../app/authController.php">
                <input type="email" required="" class="in" name="email" id="email" placeholder="Email">
                <input type="password" required="" name="password" id="password" class="in" placeholder="Contraseña"> <br>
                <button type="submit">INICIAR SESION</button>
                <input type="hidden" name="action" value="access">    
            </form>
        </fieldset>

        <fieldset>
            <legend>
                Register
            </legend>

            <form method="POST" action="../app/authController.php">
                <input type="text" class="in" required="" name="name" id="name" placeholder="Nombre">
                <input type="text" class="in"  required="" name="lastname" id="lastname" placeholder="Apellidos"> <br>
                <input type="date" class="in"  required="" name="birthdate" id="birthdate" placeholder="Fecha de nacimiento"> <br>
                <input type="email" class="in" required="" name="email" id="email" placeholder="Email"> <br>
                <input type="password" class="in" required="" name="password" id="password" placeholder="Contraseña"> <br>
                <button type="submit">ENVIAR REGISTRO</button>
                <input type="hidden" name="action" value="store">
            </form>
        </fieldset>


    </body>
</html>