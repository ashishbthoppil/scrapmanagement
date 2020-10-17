<?php

      	$servername = "localhost";
		$user = "ashish";
	     $pass = "Thoppil4-";
	     $dbname = "smdb";

	try{

	$item = $_POST["item"];
	$quantity = $_POST["quantity"];

// DB connection
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $conn->prepare("SELECT * FROM items WHERE itemName='$item'");

				$stmt->execute();

				$result = $stmt->fetchAll()[0];

	echo "x Rs." . $result["price"] . " = <span style='color:red;'><strong>Rs." . $result["price"]*$quantity . "</strong></span>";

	$conn = null;
}catch(PDOException $e){
		echo $e->getMessage();
	}


?>
