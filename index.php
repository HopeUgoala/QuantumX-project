<?php

//include 'Mysql_connect.php';

session_start();
include 'createDatabase.php';
include 'createTable.php';

$error = "";

if (array_key_exists("logout", $_GET)) {

    unset($_SESSION);
    setcookie("id", "", time() - 60*60);
    $_COOKIE["id"] = "";
    
} else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR
          (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])){

    header("location: logged1npage.php");

}

if (array_key_exists("submit", $_POST)) {

    
    if (mysqli_connect_error()) {
    
        die ("Database Connection Error");
        
    }
    
    if (!$_POST['email']) {
    
     $error .="An email address is required<br>";
     
    }
    
    if (!$_POST['password']) {
     
        $error .="A password is required<br>";
    }

     if ($error != "") {

         $error ="<p>There were error(s) in your form</p>".$error;
     
 }
    else {
      
     if ($_POST['signUp'] =='1') {
     
        $query = "SELECT id FROM `user2` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
         
        $result = mysqli_query($link, $query);
        
        if (mysqli_num_rows($result) > 0) {
        
            $error = "That email address is taken.";
        } else {
            
            $query = "INSERT INTO `user2` (`email`,`password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."','".mysqli_real_escape_string($link, $_POST['password'])."')";
            
            if (!mysqli_query($link, $query)) {
                
                $error = "<p>Could not sign you up -please try again later.</p>";
            } else {
                
                $query = "UPDATE `user2` SET password ='".md5(md5(mysqli_insert_id($link))).($_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
            
            mysqli_query($link, $query);
            
            $_SESSION['id'] = mysqli_insert_id($link);
            
            if ($_POST['stayLoggedIn'] == '1') {
            
                setcookie("id", mysqli_insert_id($link), time() + 60*60*24*365);
            }
            
            header("location: loggedinpage.php");
            
          }
            
       }
                
     } else {
         
         $query = "SELECT * FROM `user2` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
         
         $result = mysqli_query($link, $query);
         
         $row = mysqli_fetch_array($result);
          
         if (isset($row)) {
        
        $hashedPassword = md5(md5($row['id']).$_POST['password']);
            
        if ($hashedPassword == $row['password']) {
            
            $_SESSION['id'] = $row['id'];
            
            if ($_POST['stayLoggedIn'] == '1') {
              
                setcookie("id", $row['id'], time() + 60*60*24*365);
            }
            
            header ("Location: loggedinpage.php");
        
                
    } else {
             
             $error = "That email/password combination could not be found.";
         
        }
         
     } else {
         
         $error = "That email/password combination could not be found.";
    
         }
     
     }
 
  }
}
mysqli_close($link);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    
      <title> Quantumx Energy</title>
        
        <link rel="stylesheet" type="text/css" href ="page1_css_style1.css">
  </head>
  <body>
    
<div class="container">
      
        <h1>Quantumx Energy</h1>  
          
      <form method="post" id="signUpForm">
        
      <fieldset class="form-group">        
          
         <input class="form-control" type="email" name="email" placeholder="Your Email">       
    
        </fieldset>
    
       <fieldset class="form-group">        
       
           <input class="form-control"type="password" name="password" placeholder="Password">       
     
        </fieldset>  
        
        <div class="checkbox">
            
            <label>
       
           <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in
                
            </label>
            
        </div>
        
       <fieldset class="form-group">        
        
          <input type="hidden" name="signUp" value="1">
           
          <input class="btn btn-success" type="submit" name="submit" value="Sign Up!"> 
      
       </fieldset>
          
      <p><a id="showLogInForm">Log in</a></p>
         
    </form>
        
     <form method="post" id="logInForm">
     
      <fieldset class="form-group">        
      
          <input class="form-control"type="email" name="email" placeholder="Your Email">       
      
     </fieldset>
    
      <fieldset class="form-group">        
     
          <input class="form-control" type="password" name="password" placeholder="Password">       
    
      </fieldset>  
        
     <div class="checkbox">
            
            <label>
       
           <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in
                
            </label>
            
        </div>
        
         <input type="hidden" name="submit" value="0">
         
       <fieldset class="form-group">        
           
          <input class="btn btn-success" type="submit" name="submit" value="Log In!"> 
      
       </fieldset>
    </form>
      
      </div>
     
  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
