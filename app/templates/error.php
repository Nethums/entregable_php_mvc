<?php ob_start();
if (isset($params['mensaje'])) {
    ?>
<b><span style="color: red;">
<?php

    echo $params['mensaje'];
    echo "</span></b>";
}
?>

<div class="row">

			<h3>Ha habido un error</h3>


<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
