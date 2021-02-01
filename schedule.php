<?php 

session_start();
$link = mysqli_connect("localhost", "root", "", "xopes");

if (array_key_exists("id", $_COOKIE)) {

    $_SESSION['id'] = $_COOKIE['id'];
    $quantum = $_SESSION['site'].$_SESSION['line'];
}

if (array_key_exists("id", $_SESSION)) {

    
    
} else {
    
    header("Location: login.php");

}
	

	if (isset($_POST['save'])){

		
    include 'Mysql_connect.php';
		
		if ((isset($_POST['chk1'])) AND (isset($_POST['checbox1'])) AND (isset($_POST['time0']))){

	$check = $_POST['chk1'];
	$checbox = $_POST['checbox1'];
	$time0 = $_POST['time0'];
	$quantum = $_SESSION['site'].$_SESSION['line'];
	
	
		
		if (mysqli_connect_error()) {
    
    die ("There was an error connecting to the database");

	} 
	
	else
	{

	$checkNew = "";
	
	foreach($check as $checkNew1)
	{
		$checkNew .= $checkNew1 . ",";
	
	}

		 $query = "INSERT INTO `$quantum` (`scheduled_days`,`scheduled_time`,`scheduled_period`) VALUES('$checkNew','".$time0."','".$checbox."')";

	mysqli_query($link, $query);
		
	
				
		} 
			
	}	
	
	}



    ?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Quantumx Energy</title>
      <link rel="stylesheet" type="text/css" href ="page1_css_style2.css">
	  
	  <style type="text/css">

		  input.toggle-btn {
				visibility: hidden;
			}
			input.toggle-btn::before {
				content: attr(value);
				display: inline-block;
				padding: 5px;
				background: #fff;
				font-size: 14pt;
				color: #aaa;
				border-radius: 5px;
				border: 1px solid #aaa;
				visibility: visible;
			}
			input.toggle-btn:checked::before {
				background: rgb(50,150,250);
				color: #eee;
				border-color: #eee;
			}
	  </style>
	  
  </head>
  <body>
      <div class="container">
                           
          
          <div class="card text-center">
  
              <div class="card-header">
                    <h3>schedule <?php echo $_SESSION["site"]." ".$_SESSION["line"] ?></h3>
				   <P><button id="myButton1" class="btn btn-success float-right submit-button" >Back</button>

            <script type="text/javascript">
                document.getElementById("myButton1").onclick = function () {
                    location.href = "loggedinpage.php";
                };
            </script>
				  </P>
              </div>
              
			   <form  method="post">
				   
          <div class="card-body">
            
				<p><b>STATE</b></p>   
			 
			  <p> <input class="toggle-btn" name="checbox1" type="checkbox" value="ON" ></p><br> 
	   		  <p> <input class="toggle-btn" name="checbox1" type="checkbox" value="OFF"></p> <br>
			               			 
              <p><b>SELECT DAYS</b></p>
              			  
				  <input type="checkbox" name="chk1[]" value="Mon">Monday<br/>
				  <input type="checkbox" name="chk1[]" value="Tue">Tuesday<br/>
				  <input type="checkbox" name="chk1[]" value="Wed">Wednesday<br/>
				  <input type="checkbox" name="chk1[]" value="Thur">Thursday<br/>
				  <input type="checkbox" name="chk1[]" value="Fri">Friday<br/>
				  <input type="checkbox" name="chk1[]" value="Sat">Saturday<br/>
				  <input type="checkbox" name="chk1[]" value="Sun">Sunday<br/>
				  <br>
			  
			 
			
			 <div class="select" name="time1">
				  <b>SET TIME</b>
              <p><input type="time" name="time0" value="time0"></p>
			               
              
				 </div>
                    
              
          </div>
              
      <div class="card-footer text-muted" >

           <P><input type="submit" class="btn btn-success" value="Save" name="save"></P>


		  		</div>
            
			</form>
     
   		</div>

    </div>
	  
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>