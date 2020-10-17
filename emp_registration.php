<?php

if(isset($_POST['register'])){
	
	$servername = "localhost";
	$user = "ashish";
	$pass = "Thoppil4-";
	$dbname = "smdb";

	$username = $_POST["username"];
	$password = $_POST["password"];
	$name = $_POST["name"];
	$email = $_POST["email"];
	$mobile = $_POST["mobile"];
	$age = $_POST["age"];
	$gender = $_POST["gender"];
	$address = $_POST["address"];
	$country = $_POST["country"];
	$landmark = $_POST["landmark"];

	try{

// DB connection
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Check if user already exists

	$nRows = $conn->query("SELECT count(*) FROM user WHERE username='$username' OR email='$email'")->fetchColumn(); 

	if($nRows > 0){
		// If user exists redirect back to registration to show error
		header("Location: employee_manage.php");
	}else{
	// New registration
	$sql = "INSERT INTO user (username, password, name, email, mobile, age, gender, address, country, landmark, userType) VALUES ('$username', '$password', '$name', '$email', '$mobile', '$age', '$gender', '$address', '$country', '$landmark', 'employee')";

 	$conn->exec($sql);

	$conn = null;

	header("Location: employee_manage.php");
}

	} catch(PDOException $e){
		echo $e->getMessage();
	}
}

  ?>
