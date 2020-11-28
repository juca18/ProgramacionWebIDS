<?php
    include "../app/app.php";
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

            <form method="POST" action="../auth">
                <input type="email" required="" class="in" name="email" id="email" placeholder="Email">
                <input type="password" required="" name="password" id="password" class="in" placeholder="Contraseña"> <br>
                <button type="submit">INICIAR SESION</button>
                <input type="hidden" name="action" value="access">
                <input type="hidden" name="token" value=<?= $_SESSION['token'] ?>>
            </form>
        </fieldset>

        <fieldset>
            <legend>
                Register
            </legend>

            <form method="POST" action="../auth">
                <input type="text" class="in" required="" name="name" placeholder="Nombre">
                <input type="text" class="in"  required="" name="lastname" id="lastname" placeholder="Apellidos"> <br>
                <input type="date" class="in"  required="" name="birthdate" id="birthdate" placeholder="Fecha de nacimiento"> <br>
                <input type="email" class="in" required="" name="email" placeholder="Email"> <br>
                <input type="password" class="in" required="" name="password" placeholder="Contraseña"> <br>
                <button type="submit">ENVIAR REGISTRO</button>
                <input type="hidden" name="action" value="store">
                <input type="hidden" name="token" value=<?= $_SESSION['token'] ?>>
            </form>
        </fieldset>


    </body>
</html>