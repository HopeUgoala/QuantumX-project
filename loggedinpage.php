<?php

session_start();

if (array_key_exists("id", $_COOKIE)) {

    $_SESSION['id'] = $_COOKIE['id'];
    
}

if (array_key_exists("id", $_SESSION)) {

    
    
} else {
    
    header("Location: login.php");

}

?>


<?php


$link = mysqli_connect("localhost", "root", "", "xopes");
// Check connection

if (!$link) {
    die ("Connection failed: " . mysqli_connect_error());

}
 $q ="CREATE TABLE IF NOT EXISTS `site_infos` (
			 `id` int(11) NOT NULL AUTO_INCREMENT,
			 `site_id` VARCHAR(30) NOT NULL,
			 `nums_of_lines` VARCHAR(8) NOT NULL,
			 `ip_address` VARCHAR(20) NOT NULL,
			 PRIMARY KEY (`id`)
			 )";

	mysqli_query($link, $q);
		

	if (isset($_POST['submit'])){
		
		if (mysqli_connect_error()) {
    
    die ("There was an error connecting to the database");

	}
		
		
	if($_POST['sitename'] =='') {
        
        echo "<p>site name is required.</p>";
        
    } else if($_POST['no_site'] ==''){
        
        echo "<p>number of line field is required.</p>";
		
    } else if($_POST['ip_no'] ==''){
        
        echo "<p>IP address field is required.</p>";
    } else {
        
		
		$query = "INSERT INTO `site_infos` (`site_id`,`nums_of_lines`,`ip_address`) VALUES ('".mysqli_real_escape_string($link, $_POST['sitename'])."','".mysqli_real_escape_string($link, $_POST['no_site'])."','".mysqli_real_escape_string($link, $_POST['ip_no'])."')";
            
		mysqli_query($link, $query);
		
	
		
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
    
      <style type="text/css">
        
        body {
        
            position: relative; 
            margin-top: 20px;
        }
        
		  
		  .modal {
		  
			  position: fixed;
		  }
    
		  .dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #CCCDCE;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: whitesmoke}

.show {display:block;}
    </style>
      
	  

	  
    </head>
    
    
  
    <body>
       
         <div class="container">

        
        <div class="card text-center">
  <div class="card-header">
	  
	  
	  
   
            
            <P><button id="myButton1" class="btn btn-success float-right submit-button" >LOG OUT</button>

             <button type="button"  class="btn btn-success  submit-button"  data-toggle="modal" data-target="#exampleModal" >INCLUDE SITE</button>
			 
			
			<button type="button"  class="btn btn-success  submit-button" data-toggle="modal" data-target="#exampleModalLong">INFO</button>
				
			<button type="button"  class="btn btn-success float-left  submit-button" data-toggle="modal" data-target="#removeSiteModal">REMOVE SITE</button>
					  
					

				
				
				 <script type="text/javascript">
					document.getElementById("myButton1").onclick = function () {
						location.href = "login.php";
					};
            	</script>
							
            	

            </P>
								 
        
            
            </div>
 
  <div class="card-body">
      	  
	 
		
		
			<?php

		$count=1;
		$sel_query="SELECT * FROM site_infos ORDER BY site_id ASC";
		$result = mysqli_query($link, $sel_query);
		
		while($row = mysqli_fetch_assoc($result)) { ?>
		
	  
		<form method="post">
			<tr>
				<button id="site" name="site" onclick="myFunction(<?php echo $row["id"]; ?>)" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 250px;"> 
				
			<td align="center"> <?php echo $row["site_id"]; ?>
								
					  <div id="myDropdown" class="dropdown-content linetog <?php echo $row["id"]; ?>" aria-labelledby="site">
						<?php $lines = $row["nums_of_lines"];
							  $i = 0;
							  while($i < $lines){ 
								$i++;
						  ?>
						 
						    <a href="#" onclick= "line(<?php echo "'". $row["site_id"]."',".$i; ?>)"><?php echo $row["site_id"]." Line ".$i; ?></a>
						  <?php } ?>
					  </div>
				 	
					</td></button>
				
			</tr>
			
			<br>
			<br>
		<?php $count++; } ?>
				 
		</form>


	  
  </div>
	
			

	<script type="text/javascript">
      
	   function line(site,id){
	   	window.location = "ikotun_fcbma.php?id="+site+"&line_id=Line"+id;
		
	   }

	   function myFunction(id) {

		   var dropdowns2 = document.getElementsByClassName("dropdown-content");
			var i;
			for (i = 0; i < dropdowns2.length; i++) {
			  var openDropdown2 = dropdowns2[i];
			  if (openDropdown2.classList.contains('show')) {
				openDropdown2.classList.remove('show');
			  }
			}
		   if(!document.getElementsByClassName(id)[0].classList.contains("show")){
		   		document.getElementsByClassName(id)[0].classList.toggle("show");
		   }else{
		   document.getElementsByClassName(id)[0].classList.remove("show");
		   }
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
    </script>
  
			
			
					
				
				 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					 <div class="container">  
					 <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<h4 class="modal-title" id="exampleModalLabel"><b>Include site</b></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						  </div>
							<form method="post">
						  <div class="modal-body">
							  <h4><b>hint on how to write a valid site name</b></h4>
							  <h5>precede by writing the location name follow by an underscore ( _ ) and lastely the organisation name</h5>
							  <p>Site Name <input type="text" id="sitename"  name="sitename"></p>
							  <p>Number of Line <input type="text" id="no_site" name="no_site" ></p>
							  <p>IP Address <input type = "text" id="ip_no"  name= "ip_no"></p>
						  </div>
							<div class="container">
						  <div class="modal-footer">
							<p><input type="submit" class="btn btn-primary" name="submit" value="submit"></p>
						  </div>
								
							</div>
								
							</form>
						</div>
					  </div>
					</div>
					</div>
				
					 <div class="modal fade" id="removeSiteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					 <div class="container">  
					 <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<h4 class="modal-title" id="exampleModalLabel"><b>REMOVE SITE</b></h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						  </div>
							<form method="post">
						  <div class="modal-body">
					
							  <h4>ENTER SITE NAME </h4>
							  <input type="text" name="remove_site" placeholder="e.g: AGEGE_FIRST_BANK">
							  
						  </div>
							<div class="container">
						  <div class="modal-footer">
							<p><input type="submit" class="btn btn-primary" name="submit1" value="submit"></p>
						  </div>
								
							</div>
								
							</form>
						</div>
					  </div>
					</div>
					</div>
			
					<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle"><h2>ABOUT THE WEB APPLICATION</h2></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						  </div>
						  <div class="modal-body">
					
							  the application was a moldification of Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

								Why do we use it?
								It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).

							  <div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						  </div>
						</div>
					  </div>
					</div>
				</div>
				
			<div class="card-footer text-muted">
  
  			</div> 
		</div>
	 </div>
		
		
          <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>