<?php ob_start() ?>

<div class="intro">
    <h2>Has cerrado sesión correctamente</h2>
    <p>Ahora estás navegando como usuario invitado.</p>
</div>

<form name="formLogin" action="index.php?ctl=iniciarSesion" method="POST" enctype="multipart/form-data">
    
    <input type="text" name="usuario"  placeholder="Usuario" />
    <input type="text" name="password"  placeholder="Contraseña"/>    

    <input type="submit" value="Inciar Sesión" name="iniciarSesion" />
</form>

<?php
    if (isset($_SESSION['errores'])) {
        echo "<div class='errores'>";
        foreach ($_SESSION['errores'] as $error) {
            echo "<p>$error</p>";
        }
        echo "</div>";
    }    
    unset($_SESSION['errores']);
?>



<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
