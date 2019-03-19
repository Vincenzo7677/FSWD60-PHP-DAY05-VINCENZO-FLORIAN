<?php
ob_start();
session_start(); // start a new session or continues the previous
if( isset($_SESSION['user'])!="" ){ //session to make global variables accessable all over our pages
    header("Location: home.php"); // redirects to home.php and ONLY there!
}
include_once 'dbconnect.php';
$error = false;

if ( isset($_POST['btn-signup']) ) {
 
      // sanitize user input to prevent sql injection
      $name = trim($_POST['name']);
      $name = strip_tags($name);

      // strip_tags — strips HTML and PHP tags from a string
      $name = htmlspecialchars($name);

      // htmlspecialchars converts special characters to HTML entities
      $email = trim($_POST['email']);
      $email = strip_tags($email);
      $email = htmlspecialchars($email);

      $pass = trim($_POST['pass']);
      $pass = strip_tags($pass);
      $pass = htmlspecialchars($pass);

      // basic name validation
      if (empty($name)) {
          $error = true;
          $nameError = "Please enter your full name.";
      } else if (strlen($name) < 3) {
          $error = true;
          $nameError = "Name must have at least 3 characters.";
      } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
          $error = true;
          $nameError = "Name must contain alphabets and space.";
      }
      
      //basic email validation
      if (!filter_var($email,FILTER_VALIDATE_EMAIL) ) {
          $error = true;
          $emailError = "Please enter valid email address.";
      } else {
      // checks whether the email exists or not
      $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
      $result = mysqli_query($conn, $query);
      $count = mysqli_num_rows($result);
      if($count!=0){
          $error = true;
          $emailError = "Provided Email is already in use.";
      }
   }
   // password validation
   if (empty($pass)){
    $error = true;
    $passError = "Please enter password.";
   } else if(strlen($pass) < 6) {
    $error = true;
    $passError = "Password must have atleast 6 characters.";
 }

 // password hashing for security
	$password = hash('sha256', $pass); //$password is hashing $pass


 // if there's no error, continue to signup
 if( !$error ) {
 
  $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
  $res = mysqli_query($conn, $query);
 
  if ($res) {
   $errTyp = "success";
   $errMSG = "Successfully registered, you may login now";
   unset($name); //delete from input field
   unset($email);
   unset($pass);
  } else { //if there's something wrong with the connection or $query, let's say 'userass' instead of 'userPass'
   $errTyp = "danger";
   $errMSG = "Something went wrong, try again later...";
  }
 
 }


}

$nameError="";
$emailError="";
$passError="";
$name="";
$email="";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Registration</title>
	<meta charset="UTF-8"?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" class="login100-form validate-form">
					<span class="login100-form-title p-b-33">
						Registration
					</span>
				    <?php
				    	if ( isset($errMSG) ) {
					     	?>
					      	<div class="alert alert-<?php echo $errTyp ?>">
					          <?php echo $errMSG; ?>
					      	</div>

					      	<?php
				      	}
				     ?>
					<div class="wrap-input100 validate-input" data-validate = "Name is required">
						<input class="input100" type="text" name="name" placeholder="Name" value="<?php echo $name;?>">
						<span class="text-danger"><?php echo $nameError; ?></span>

						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email" value="<?php echo $email; ?>">
						<span class="text-danger"><?php echo $emailError; ?></span>

						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100 form-control" type="password" name="pass" placeholder="Password">
						<span class="text-danger"><?php echo $passError; ?></span>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button name="btn-signup" class="login100-form-btn">
							Sign up
						</button>
					</div>
					 <hr />
 
            		<div class="text-center p-t-45 p-b-4">
						<a href="index.php" class="txt2 hov1">
							Sign in Here...
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>