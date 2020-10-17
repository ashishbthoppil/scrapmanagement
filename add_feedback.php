<?php

	$servername = "localhost";
	$user = "ashish";
	$pass = "Thoppil4-";
	$dbname = "smdb";

	session_start();

	$username = $_SESSION["username"];
	$name = $_POST["name"];
	$email = $_POST["email"];
	$feedback = $_POST["feedback"];
	$date = date('Y-m-d H:i:s');


	try{

// DB connection
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$userStmt = $conn->prepare("SELECT * FROM user WHERE username='$username'");

					$userStmt->execute();

					$userId = $userStmt->fetchAll()[0]['id'];

	$adminStmt = $conn->prepare("SELECT * FROM user WHERE userType='admin'");

				$adminStmt->execute();

	$adminId = $adminStmt->fetchAll()[0]['id'];

	// New feedback
	$sql = "INSERT INTO feedback (sender, receiver, name, email, comment, sentAt) VALUES ('$userId','$adminId' , '$name', '$email', '$feedback', '$date')";

 	$conn->exec($sql);

	$conn = null;

	} catch(PDOException $e){
		echo $e->getMessage();
	}


?>
