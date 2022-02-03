<?php ob_start() ?>

<h2>Inicia sesión</h2>
<p>Introduce tus datos</p>

<form name="formLogin" action="index.php?ctl=iniciarSesion" method="POST" enctype="multipart/form-data">
    
    <input type="text" name="usuario"  placeholder="Usuario" />
    <input type="text" name="password"  placeholder="Contraseña"/>    

    <input type="submit" value="Inciar Sesión" name="iniciarSesion" />
</form>

<?php
    if (isset($_SESSION['errores'])) {
        echo "<pre>";
        print_r($_SESSION['errores']);
        echo "</pre>";
    }
?>



<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
