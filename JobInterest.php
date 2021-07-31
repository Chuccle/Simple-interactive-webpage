<?php
$servername = "localhost";
$username = "root";
$dbname = "mySQL";

// Create connection
$conn = new mysqli($servername, $username, $dbname;
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql1 = "INSERT INTO jobinterest (FirstName, LastName, MobileNumber, Email)
VALUES ('{$FirstName}', '{$LastName}', '{$Mobile}', '{$Email}')";
//$sql2 = "INSERT INTO project_pdf (File_Name, pdf_doc) VALUES ('{$FirstName}', '{$LastName}', '{$Mobile}', '{$Email}')";

$conn->close();
?>