<?php

	
	$servername = "localhost";
	$user = "ashish";
	$pass = "Thoppil4-";
	$dbname = "smdb";

	$id = $_POST["id"];
	$employee = $_POST["employee"];

	try{

// DB connection
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$empStmt = $conn->prepare("SELECT * FROM user WHERE username='$employee'");

					$empStmt->execute();

					$empId = $empStmt->fetchAll()[0]['id'];

	$sql = "UPDATE request SET employee='$empId', status='1' WHERE id='$id'";

    $stmt = $conn->prepare($sql);
	$stmt->execute();

	$conn = null;

	} catch(PDOException $e){
		echo $e->getMessage();
	}

?>
