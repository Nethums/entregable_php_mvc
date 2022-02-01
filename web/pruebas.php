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

?>

