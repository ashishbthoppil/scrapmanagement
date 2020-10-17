<?php
if (isset($_POST["login"])){

	$servername = "localhost";
	$user = "ashish";
	$pass = "Thoppil4-";
	$dbname = "smdb";

	$username = $_POST["username"];
	$password = $_POST["password"];

	try{

	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$nRowsUser = $conn->query("SELECT count(*) FROM user WHERE username='$username' AND password='$password' AND userType='user'")->fetchColumn();

	$nRowsAdmin = $conn->query("SELECT count(*) FROM user WHERE username='$username' AND password='$password' AND userType='admin'")->fetchColumn();

    $nRowsEmployee = $conn->query("SELECT count(*) FROM user WHERE username='$username' AND password='$password' AND userType='employee'")->fetchColumn();

	$conn = null;

	session_start();

		if($nRowsUser == 1){
			
			$_SESSION["username"] = $username;
	 	  	header("Location: user_home.html?user=" . $username);
		}else if($nRowsAdmin == 1){
			
			$_SESSION["username"] = $username;
	 	  	header("Location: admin_home.php?admin=yes");
		}
		else if($nRowsEmployee == 1){
			
			$_SESSION["username"] = $username;
	 	  	header("Location: emp_home.php?user=".$username);
		}
		else{
			header("Location: index.html?user=" . $username);
		}
	} catch(PDOException $e){
	echo $e->getMessage();
	}

}
?>
