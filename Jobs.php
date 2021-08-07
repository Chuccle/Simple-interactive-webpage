<html lang="en">
<html>
    <head> 
        <link rel="stylesheet" href="Jobs.css">
    </head>

  

<body>
  
    <ul>
        <li><strong><a href="about_us.html">About us</strong></a></li>
        <li><strong><a href="Jobs.php">Jobs</a></strong></li>
      </ul>
      <img src="Assets/Image for jobs page.jpg" alt="">

  
    

    </div>
    
    <h1>Required skills </h1>
    <H2> This job generally requires the ability to do the following work:<br></H2>
      <br>
    <p>
     - Know HTML, CSS, JavaScript, PHP, and other relevant web design coding languages<br> <br>
     - Create and test applications for websites<br><br>
     - Collaboration<br><br>
     - Present design specs<br><br>
     - Work with graphics and other designers<br><br>
     - Troubleshoot website problems<br><br>
     - Maintain and update websites<br><br>
     - Monitor website traffic<br><br>
     - Stay up-to-date on technology<br><br>
  </p>
    <hr>
    <h1>Click on one of the links below to see the relevant qualifications and course resources</h1>
      
    <div class="row">
       <div class="column 1">
        <a href = "https://www.w3schools.com/cert/cert_html_new.asp" target = "_self"> 
          <img src="Assets/HTML.png" alt="Snow" style="width:100%">
      </div>
      
    
      
      
      <div class="column 2">
        <a href = "https://www.w3schools.com/cert/cert_css.asp" target = "_self">
        <img src="Assets/CSS.png" alt="Forest" style="width:100%">
      </div>
  
      
   
     <div class="column 3">
       <a href = "https://www.w3schools.com/cert/cert_bootstrap_reg.asp" target = "_self">
      <img src="Assets/BS.png" alt="Mountains" style="width:105%">
     </div>
  

      <div class="column 4">
        <a href = "https://www.w3schools.com/cert/cert_javascript.asp" target = "_self">
        <img src="Assets/JS.png" alt="Mountains" style="width:100%">
      </div>
 

      <div class="column 5">
        <a href = "https://www.w3schools.com/cert/cert_php.asp" target = "_self">
        <img src="Assets/PHP.png" alt="Mountains" style="width:102%">
      </div>

    

      <div class="column 6">
        <a href = "https://www.w3schools.com/cert/cert_sql.asp" target = "_self">
        <img src="Assets/MYSQL.png" alt="Mountains" style="width:100%">
        </a>
      </div>
      
    </div> 
 
   <div class="container">
  
   <?php if (isset($_POST['form_submitted'])): ?>

<?php if (!isset($_POST['agree'])): ?>

    <p>You have not accepted our terms of service</p>

    <?php else: 

    header('Location: FormSubmittedFIles.php') ?>



    <?php endif; ?>
    <?php else: ?>


  <h1>Register</h1>
    
    <p>Please fill in this form apply.</p>
    <hr>
  
  <form id="theForm" form action="FormSubmittedFIles.php" method="POST" enctype="multipart/form-data">
  

  <h2>Registration Form</h2>


    First name:
    <input type="text" name="firstname" required>
    
    <br> Last name:
    <input type="text" name="lastname" required>
    
    <br> Email address:
    <input type="text" name="email" required>

    <br> Mobile Number:
    <input type="number" name="mobile">
    
    <br> Agree to Terms of Service:
    <input type="checkbox" name="agree">
    <br>

    <input type="hidden" name="form_submitted" value="1" />

<br>
    <input type="submit" value="Submit">
    </br>
</form>
<?php endif; ?>
 

</div> 

</body>

<footer>

  <ul>
    <li><strong><a href="">Contact</strong></a></li>
    <li><strong><a href="">Legal</strong></a></li>
    <li><strong><a href="">Modern slavery statement </strong></a></li>
  </ul>
  


</footer>
</html>
