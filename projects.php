<?php
    try 
    {
      $pdo = new PDO ("mysql:host=localhost;dbname=mysql","root", "");
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
   $sql = "SELECT ID, project_name
            FROM jobinterest
            ORDER BY project_name ASC;";
    $result = $pdo->query($sql);
    foreach ($result as $row) {
        $records[] = [
        'ID' => $row['ID'],
            'project_name' => $row['project_name']
        ];

    }
    $title = 'Display PDF File';
    ob_start();
    include __DIR__."/templates/display.html.php";
    $output = ob_get_clean();
} catch (PDOException $e) {
    echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
        ': '. $e->getLine();   
}
include __DIR__."/templates/base.html.php";


?>