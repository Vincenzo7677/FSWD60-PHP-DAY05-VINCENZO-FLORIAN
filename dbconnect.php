
	<?php 
		$hostname="localhost";
		$username="root";
		$password="";
		$dbname="Cars";

		$conn=mysqli_connect($hostname,$username,$password,$dbname);
		if(!$conn){
			echo "connection error";
		}else{
			echo "connection success";
		}

		
	 ?>