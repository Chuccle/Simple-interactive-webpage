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

<?php if ($emailValid && $mobileValid == TRUE) {
savetodb(); }
else {
  header('Location: Jobs.php');}
  ?>




<?php function savetodb() {
$servername = "localhost";
$username = "root";
$dbname = "mySQL";
$password = "";
$FirstName = $_POST['firstname'];
$LastName = $_POST['lastname'];
$mobile = $_POST['mobile'];
$email = ($_POST["email"]);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO jobinterest (FirstName, LastName, MobileNumber, Email)
VALUES ('{$FirstName}', '{$LastName}', '{$mobile}', '{$email}')";
//$sql2 = "INSERT INTO project_pdf (File_Name, pdf_doc) VALUES ('{$FirstName}', '{$LastName}', '{$Mobile}', '{$Email}')";
?>
<br>
<?php
if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$conn->close(); }
?>


    </br>      
  </p>

        

        <p> Go <a href="Jobs.php">back</a> to the form</p>

