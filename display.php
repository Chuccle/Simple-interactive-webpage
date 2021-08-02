<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ID'])){
    try
    {
    //change PDO arguments to match your MYSQL details
      $pdo = new PDO ("mysql:host=localhost;dbname=mysql","root", "");
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e)
    {
       echo 'connection failed: '.$e->getMessage();
    }

    $ID = htmlspecialchars($_GET['ID']);
    $query = "SELECT `project_name`, `pdf_doc`
              FROM jobinterest
              WHERE `ID` = :ID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':ID', $ID, PDO::PARAM_INT);
    $stmt->bindColumn(1, $project_name);
    $stmt->bindColumn(2, $pdf_doc, PDO::PARAM_LOB);
    if ($stmt->execute() === FALSE) {
        echo 'Could not display pdf';
    } else {
        $stmt->fetch(PDO::FETCH_BOUND);
        header("Content-type: application/pdf");
        header('Content-disposition: inline; filename="'.$project_name.'.pdf"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        echo $pdf_doc;

    }
} else {
    header('location: projects.php');
}

?>