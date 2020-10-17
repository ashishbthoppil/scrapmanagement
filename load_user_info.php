<?php
	
	$servername = "localhost";
	$user = "ashish";
	$pass = "Thoppil4-";
	$dbname = "smdb";

	$html = "<table class='table table-striped'>";

	$id = $_POST["id"];

	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->prepare("SELECT * FROM user WHERE id='$id'");

			$stmt->execute();

			$result = $stmt->fetchAll()[0];

			$html = $html . "<tr><td><strong>Name </strong></td><td>". $result["name"] ."</td></tr>
			<tr><td><strong>Username</strong></td><td>". $result["username"] ."</td></tr>
			<tr><td><strong>Email</strong></td><td>". $result["email"] ."</td></tr>
			<tr><td><strong>Mobile</strong></td><td>". $result["mobile"] ."</td></tr>
			<tr><td><strong>Age</strong></td><td>". $result["age"] ."</td></tr>
			<tr><td><strong>Gender</strong></td><td>". $result["gender"] ."</td></tr>
			<tr><td><strong>Address</strong></td><td>". $result["address"] ."</td></tr>
			<tr><td><strong>Country</strong></td><td>". $result["country"] ."</td></tr>
			<tr><td><strong>Landmark</strong></td><td>". $result["landmark"] ."</td></tr>
			</table>";

			echo $html;


?>
