<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">



<h1>Register to database to view PDFs</h1>

            <p>Please fill in the form.</p>
            <hr>
            <form id="theForm" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST" enctype="multipart/form-data">
           
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter email" name="email" id="email" required>
            <hr>

            <label for="password"><b>       Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required>

           
            <label for="passwordconfirm"><b>Confirm password</b></label>
            <input type="password" placeholder="Enter Password" name="passwordconfirm" id="passwordconfirm" required>
            <hr>


            <input type="hidden" name="form_submitted" value="1" />

<br>
    <input type="submit" value="Submit">
    </br>
</form>
<p>Go <a href=Login.php>back</a></p>

<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
    
//only trigger when form is submitted 
    
$Registrationdata = [];
if (isset($_POST['form_submitted'])); {
   if (CheckPassword()){
        
  //variables start off undefined causing warning

        $Registrationdata = array($_POST['email'], $_POST['password']);
    //Make error messages look nicer
 print_r(Signup($Registrationdata));
}
}

//function to determine if inputted password fields match
function CheckPassword()
{
$password1 = $_POST['password'];
$password2 = $_POST['passwordconfirm'];


if ($password1 != $password2) {
  echo "passwords do not match";
  return false;

}else { 

  return true;
}

}        
        
        
        
        
        function Signup(array $data) 
        {
            //cleaning up input data to protect against sql injection vulnerabilities
            $Data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
            $email = stripcslashes(strip_tags($Data['email']));
            $password = htmlspecialchars($Data['password']);
        
            $Errors = [];
        
        
        //performing validation and checks to email data
            $emailExists = checkEmail($email);
           
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $Errors['invalid'] = "Sorry, This email is in a incorrect format.";
            return ($Errors);
            }

            
           if ($emailExists['status']) {
                $Errors['email'] = "Sorry, This email already exists.";
                return ($Errors);
            }
        
            if (strlen($password) < 7) {
                $Errors['password'] = "Sorry, Use a stronger password";
                return ($Errors);
            }
        
            if (count($Errors) > 0) {           
                $Errors['error'] = "Please, correct the Errors in your form in order to continue.";
                return $Errors;
            } else {
         //constructing our $Data array
                $Data = [
                    'email' => $email,
                    'password' => $password
                ];
                
                //assigning a variable to hold our boolean output of Register function
                $registration = Register($Data);
                
                if ($registration) {
                    // TODO verify the user before header redirect with email confirmation
                    array_pop($Data);

                    header("Location: projects.php");
                } else {
                    $Errors['error'] = "Sorry an unexpected error and your account could not be created. Please try again later.";
                    print_r($Errors);
                    return $Errors;
                }
            }
        }
        
        
        function Register(array $data)
        {
            require 'dbconfig.php'; 
           
            try
            {
            //change PDO arguments to match your MYSQL details
              $pdo = new PDO ("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
            echo 'connection failed: '.$e->getMessage();
            }
            //SQL query to insert our bound parameters into their respective columns 
                $stmt = $pdo->prepare("INSERT INTO `database admins` (email, password) VALUES (:email, :password)");
                $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            
           //default hashing algorithm is blowfish, for compatibility with other standard cryptography functions.
           //Note: changing the default algorithm will cause other dependent functions to break i.e:password_verify
            $password = password_hash($data['password'], PASSWORD_BCRYPT);
            //bind our values for statement preparation
            $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        

            $result = $stmt->execute();
            if ($result) {
                return true;
            } else {
                return false;
            }
        }



function checkEmail(string $email) : array
{
    require 'dbconfig.php';
    
    try
    {
    //change PDO arguments to match your MYSQL details
      $pdo = new PDO ("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
     
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
    echo 'connection failed: '.$e->getMessage();
    }

    
    {
    //Our SQL statement to recall all records which match our email parameter    
    $stmt = $pdo->prepare("SELECT `email`, `password` FROM `database admins` WHERE `email` = :email");
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

  //if our SQL query returns unsuccessful, return $response array with empty data variable and status as false
    if (empty($result)) {
        $response['status'] = false;
        $response['data'] = [];
        return $response;
    }
//if our SQL query returns successful, return $response array with data 
    $response['status'] = true;
    $response['data'] = $result;
    return $response;
}}
?>
