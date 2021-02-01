
<?php
session_start();

$link = mysqli_connect("localhost", "root", "", "xopes");

@$siteId = $_GET['id'];
@$lineId = $_GET['line_id'];
$site2 =$siteId.$lineId;


$doon = "CREATE TABLE IF NOT EXISTS `$site2` (
		 `id` int(11) NOT NULL AUTO_INCREMENT,
		 `scheduled_days` varchar(50) NOT NULL,
		 `scheduled_time` varchar(50) NOT NULL,
		 `scheduled_period` varchar(50) NOT NULL,
		  PRIMARY KEY (`id`)
		 )";

if (array_key_exists("id", $_COOKIE)) {

    $_SESSION['id'] = $_COOKIE['id'];
   
}

if (array_key_exists("id", $_SESSION)) {

    mysqli_query($link, $doon);


} else {
    
    header("Location: login.php");

}



?>

			<?php

			$_SESSION["site"] = "$siteId";
			$_SESSION["line"] = "$lineId";
			$_SESSION['site3'] = "$site2";
			$quantum = $_SESSION["site"].$_SESSION["line"];
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
  </head>
  <body>
      <div class="container">
                     
         
              <div class="card text-center">
          <div class="card-header">
			
        	<h3> <?php echo $_SESSION["site"]." ".$_SESSION["line"] ?></h3>
			  
			  
              <P><button id="backpage"  class="btn btn-success float-right"  >Back</button>

                <script type="text/javascript">
                    document.getElementById("backpage").onclick = function () {
                        location.href = "loggedinpage.php";
                    };
                </script>
            </P>

          </div>
				  
				  
          <div class="card-body">
			  
			  	<?php
			  
			  include 'Mysql_connect.php';

		?>
			  
		<tbody>
		<?php 
		
		$count=1;
		$sel_query="SELECT * FROM `$quantum`";
		@$result = mysqli_query($link, $sel_query);
		while($row = mysqli_fetch_assoc($result)) { ?>
		<tr><td align="centre"><?php echo $count ."."; ?></td>
		<td align="centre"><?php echo $row["scheduled_time"]; ?></td>
		<td align="centre"><?php echo $row["scheduled_days"]; ?></td>
		<td align="centre"><?php echo "TURN " .$row["scheduled_period"]; ?></td>
		<td align="centre">
		<a  href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
		</td>
		<br>
		</tr>
		<?php $count++; }  ?>
		</tbody> 

		
                  </div>
          
                  <div class="card-footer text-muted">
					  
					    <P><button id="schedule_page"  class="btn btn-success"  >SCHEDULE </button>

                <script type="text/javascript">
                    document.getElementById("schedule_page").onclick = function () {
                        location.href = "schedule.php";
                    };
                </script>
            </P>
           
                </div>
        </div>

          </div>
	  
	  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous">
	  
		   $.post({
			  url: "192.168.3.95/collect.php",
			  data: {
				users: {
					0: {                
						time_on: $row["scheduled_time"],    
						time_off: $row["scheduled_time"],       
						days: $row["scheduled_days"],
						
						},
						1: {
							name: "Billy",
							age: 28,
							work: "road worker"
						},
						
					  }
					},
				   success: function(response) {
					console.log(response);
			   }
			  });
	 
	  </script>
	  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>