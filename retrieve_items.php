<?php

      	$servername = "localhost";
		$user = "ashish";
	    $pass = "Thoppil4-";
	    $dbname = "smdb";

	try{

	$type = $_POST["type"];

// DB connection
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $conn->prepare("SELECT * FROM items WHERE type='$type'");

				$stmt->execute();

				$results = $stmt->fetchAll();

	foreach($results as $result){
		echo "<option id='" . $result["id"] . "'>" . $result["itemName"] . "</option>";
	}

	$conn = null;
}catch(PDOException $e){
		echo $e->getMessage();
	}


?>
