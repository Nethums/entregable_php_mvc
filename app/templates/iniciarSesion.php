<?php ob_start() ?>

<div class="intro">
    <h2>Identifícate</h2>
    <p>Introduce tu usuario y contraseña.</p>
</div>

<form name="formLogin" action="index.php?ctl=iniciarSesion" method="POST" enctype="multipart/form-data">
    
    <input type="text" name="usuario"  placeholder="Usuario" />
    <input type="text" name="password"  placeholder="Contraseña"/>    

    <input type="submit" value="Inciar Sesión" name="iniciarSesion" />
</form>

<!--
    Foreach que muestra los errrores al macenados en $_SESSION['errores'] guardados cuando se han validado los campos del formulario
-->
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
