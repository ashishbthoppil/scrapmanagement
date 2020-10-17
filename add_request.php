<?php

	$servername = "localhost";
	$user = "ashish";
	$pass = "Thoppil4-";
	$dbname = "smdb";
	$item = $_POST["item"];
	$quantity = $_POST["quantity"];

	session_start();

	$username = $_SESSION["username"];
	$date = date('Y-m-d H:i:s');

	try{

	// DB connection
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$itemsArray = explode('_', $item);
	$quantitiesArray = explode('_', $quantity);


	$items = '';
	$quantities = '';
	$totalAmt = 0;

	for($i=0;$i<(sizeof($itemsArray)-1);$i++){
		if ($itemsArray[$i] != '' || $itemsArray[$i] != null) {
			$singleItem = $itemsArray[$i];
			$stmt = $conn->prepare("SELECT * FROM items WHERE itemName='$singleItem'");
			$stmt->execute();
			$amt = $stmt->fetchAll()[0]["price"] * $quantitiesArray[$i];
			$totalAmt = $totalAmt + $amt;
		}
		if($i == (sizeof($itemsArray)-2)){
			$items = $items . $itemsArray[$i];
		$quantities = $quantities . $quantitiesArray[$i];
	}else{
		$items = $items . $itemsArray[$i] . ',';
		$quantities = $quantities . $quantitiesArray[$i] . ',';
	}
	}

	$userStmt = $conn->prepare("SELECT * FROM user WHERE username='$username'");

					$userStmt->execute();

					$userId = $userStmt->fetchAll()[0]['id'];

	// New entry
	$sql = "INSERT INTO request (username, items, quantities, totalAmt, createdAt, status, employee, requester) VALUES ('$userId', '$items', '$quantities', '$totalAmt', '$date', '0', null, '$username')";

 	$conn->exec($sql);

	$conn = null;

	echo $totalAmt;

	} catch(PDOException $e){
		echo $e->getMessage();
	}


  ?>
