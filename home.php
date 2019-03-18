<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user']) ) {
 header("Location: index.php");
 exit;
}
// select logged-in users details
$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);


if(isset($_GET["id"])){
	$id = $_GET["id"];
	$fk_user = $_SESSION["user"];

	echo "<form method='post'><input type='date' name='td'><input type='date' name='bd'><input type='submit' name='submitbook'> </form>";

	if(isset($_POST["submitbook"])){
		$takedate= $_POST["td"];
		$backdate= $_POST["bd"];

		$sql = "insert into booking (TakeDate ,	BackDate 	,CarId 	,userId) values ('$takedate','$backdate',$id,$fk_user)";
		mysqli_query($conn,$sql);
	}


}

?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div class="alert alert-info" role="alert">
  <a href="#" class="alert-link"> Welcome <?php echo $userRow['userName'] ." to our Booking-Page!";?></a>
   <a href="logout.php?logout"><button type="" class="btn btn-danger">Sign Out</button></a>

</div>

	<div class="container">
		  <h2>All cars</h2>
				<div class="row">
		
			    	<?php
				        $sql = "SELECT Model, Type,CarId FROM car";
						$result = $conn->query($sql);
							if ($result->num_rows > 0) {
					   		 while($row = $result->fetch_assoc()) {
					   		 echo
					   		 "<div class='col-3 pb-4'>
					   		 <div class='card'>
					   		 <img class='card-img-top' src='.../100px180/' alt='Card image cap'>
					   		 <div class='card-body'>
					   		 	<h5 class='card-title'>".$row['Model']." ".$row['Type']."
					   		 	</h5>
			    			 	<p class='card-text'>Some quick example text to build on the card title and make up the bulk of the cards content.</p>
			    			 	<a href='home.php?id=".$row['CarId']."' class='btn btn-primary'>Delete</a>
			    			 </div>
							 </div></div>";
					   		 }
						}
					?>
		</div>
	</div>
	   
	    
	    

 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
<?php ob_end_flush(); ?>