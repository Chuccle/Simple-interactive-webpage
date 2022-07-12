<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

<h1>Log in to database to view PDFs</h1>

            <p>Please fill in the form.</p>
            <hr>
            <form id="theForm" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST" enctype="multipart/form-data">
           
            <label for="email"><b>email</b></label>
            <input type="text" placeholder="Enter email" name="email" id="email" required>
<br>
<hr>
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required>
            <hr>
            <input type="hidden" name="form_submitted" value="1" />

<br>
    <input type="submit" value="Submit">
    </br>
</form>

<p>or <a href=Register.php>Register</a></p>
     

    <?php
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
    
    //only trigger when form is submitted and completed
$logindata = [];   
if (isset($_POST['form_submitted'])); {
        if(!empty($_POST['email']) && !empty($_POST['password']));
        //variables start off undefined causing warning
        $logindata = array($_POST['email'], $_POST['password']);
      //Make error messages look nicer
        print_r(Login($logindata));

           }
           function Login(array $data)
        {
            //pre-data cleaning to mitigate rsik of SQL injection
            $Data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $Errors = [];
            $Email = stripcslashes(strip_tags($Data['email']));
            $Password = htmlspecialchars($Data['password']);

            //check if the email address matches a record in the table
            $Email_check = checkEmail($Email);
            if (!$Email_check['status']) {
            $Errors['error'] = "Invalid credentials passed. Please, check the Email or Password and try again.";
            return $Errors;
            } else {
            //we check that the password matches the blowfish hash
            if (password_verify($Password, $Email_check['data']['password'])) {
                $_SESSION['current_session'] = [
                'status' => 1,
                'user' => $Email_check['data'],
                ];
                header("Location: projects.php");
            }

             //if inputted password parameter doesnt match the password when it's hashed
             //then exit function with associated error 
            if (!password_verify($Password, $Email_check['data']['password'])) {
                $Errors['error'] = "Invalid credentials passed. Please, check the Email or Password and try again.";
                return $Errors;
            }
            }
        }
        
            function checkEmail(string $email) : array
            
            {
                require_once 'dbconfig.php';
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
                $statement = $pdo->prepare("SELECT `email`, `password` FROM `database admins` WHERE `email` = :email");
                $statement->bindValue(':email', $email, PDO::PARAM_STR);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
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
            }
        }

