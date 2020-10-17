<?php

$servername = "localhost";
	$user = "ashish";
	$pass = "Thoppil4-";
	$dbname = "smdb";

	$adminComment = $_POST["adminComments"];
	$hiddenUsername = $_POST["hiddenUsername"];
	$date = date('Y-m-d H:i:s');

	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$adminStmt = $conn->prepare("SELECT * FROM user WHERE userType='admin'");

				$adminStmt->execute();

				$adminId = $adminStmt->fetchAll()[0]['id'];

	// New reply
	$sql = "INSERT INTO feedback (sender, receiver, name, email, comment, sentAt) VALUES ('$adminId', '$hiddenUsername', 'Admin', 'admin@smdb.com', '$adminComment', '$date')";

 	$conn->exec($sql);


	$conn = null;

	header("Location: admin_feedback.php");


?>
