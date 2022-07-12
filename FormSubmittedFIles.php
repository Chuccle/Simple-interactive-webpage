<html>

 <h2>Thank You, <?php echo $_POST['firstname']; ?></h2>

        <br>

        <p>- You have been registered as
            <?php echo $_POST['firstname'] . ' ' . $_POST['lastname']; ?>
    </br>

        <br>
            - Your email address is registered as:

            <?php

  $email = ($_POST["email"]);
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
    echo $emailErr;

   echo '<script type="text/javascript"  alert("Please enter a valid email address (format = example@example.com)")
 </script>';

   }
  else {
        echo $email;
        $emailValid = True;

  }

   ?>
    </br>
    <br>
    - Your mobile number is registered as:
   <?php

$mobile = $_POST['mobile'];

$regex = "/^([0-9]{10,11})$/";

if (preg_match($regex, $mobile)) {
    echo $mobile;
    $mobileValid = True;

} else {
 echo "Invalid telephone number.";

}

    ?>
    <?php
if (!empty($_FILES['pdf_file']['name'])) {
     //a $_FILES 'error' value of zero means success. Anything else and something wrong with attached file.
  }  if ($_FILES['pdf_file']['error'] != 0) {
        echo 'Something wrong with the file.';
       } else { //pdf file uploaded okay.
        //project_name supplied from the form field
     $PdfFileOK = TRUE;}

?>

<?php if ($emailValid && $mobileValid && $PdfFileOK == TRUE) {
savetodb(); }
else {
  header('Location: Jobs.php');}
  ?>


<?php function savetodb() {

require_once 'dbconfig.php';

$FirstName = $_POST['firstname'];
$LastName = $_POST['lastname'];
$mobile = $_POST['mobile'];
$email = ($_POST["email"]);
$project_name = htmlspecialchars($_POST['project_name']);
$file_name = $_FILES['pdf_file']['name'];
$file_tmp = $_FILES['pdf_file']['tmp_name'];

if ($pdf_blob = fopen($file_tmp, "rb")) {

  try
  {
  //change PDO arguments to match your MYSQL details
    $pdo = new PDO ("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "INSERT INTO jobinterest (FirstName, LastName, MobileNumber, Email, `project_name`, `pdf_doc`)
VALUES (:FirstName, :LastName, :mobile, :email, :project_name, :pdf_doc);";
//We bind our parameters and prepare them to mitigate risk of SQL injection
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':project_name', $project_name);
                $stmt->bindParam(':FirstName', $FirstName);
                $stmt->bindParam(':LastName', $LastName);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':mobile', $mobile);

                $stmt->bindParam(':pdf_doc', $pdf_blob, PDO::PARAM_LOB);

                if ($stmt->execute() === FALSE) {
                  echo 'Could not save information to the database';
              } else {
                  echo 'Information saved';
              }

             } catch (PDOException $e)
              {
                 echo 'connection failed: '.$e->getMessage();
              }

        } else {
            //fopen() was not successful in opening the .pdf file for reading.
            echo 'Could not open the attached pdf file';
        }
      }

?>
<br>

  </p>

        <p> Go <a href="Jobs.php">back</a> to the form or <a href="projects.php">view</a>the PDFs?</p>