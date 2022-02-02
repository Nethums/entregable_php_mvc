<?php



session_start();



function alumnoUltimaId() {
    
    $pdo = new PDO('mysql:host=localhost;dbname=dws_mvc_instituto', "root", "");
    // Realiza el enlace con la BD en utf-8
    $pdo->exec("set names utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

    $consultaId = "select max(id) from alumnos";
    //$resultId = $pdo->prepare($consultaId);
    $resultId = $pdo->query($consultaId);
    $user = $resultId->fetchColumn();
    return $user;
}

$id = alumnoUltimaId();
print_r($id);

echo "<br>";

//print_r($_SESSION['errores']);

$foto = "foto dE PruEba.jpg";
echo $foto . "<br>";
$foto = str_replace(" ", "_", $foto);
$foto = strtolower($foto);
echo $foto;

echo "<br><br><br>";

$prueba = "foto dE PruEba SegunDA.jpg";
echo $prueba . "<br>";
$prueba = strtolower(str_replace(" ", "_", $prueba));

echo $prueba;

?>

