<?php

if(isset($_POST['save'])){
	
	$servername = "localhost";
	$user = "ashish";
	$pass = "Thoppil4-";
	$dbname = "smdb";

	$newUsername = $_POST["username"];
	$newPassword = $_POST["password"];
	$newName = $_POST["name"];
	$newEmail = $_POST["email"];
	$newMobile = $_POST["mobile"];
	$newAge = $_POST["age"];
	$newGender = $_POST["gender"];
	$newAddress = $_POST["address"];
	$newCountry = $_POST["country"];
	$newLandmark = $_POST["landmark"];

	try{

		

// DB connection
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



	// $nRows = $conn->query("SELECT count(*) FROM user WHERE username='$username' OR email='$email'")->fetchColumn(); 

	// if($nRows > 0){
		// If user exists redirect back to registration to show error
		// header("Location: registration.html?user=taken");
	// }else{
	// New registration
	session_start();

	$oldUsername = $_SESSION['username'];
	$sql = "UPDATE user SET username='$newUsername', password='$newPassword', name='$newName', email='$newEmail', mobile='$newMobile', age='$newAge', gender='$newGender', address='$newAddress', country='$newCountry', landmark='$newLandmark' WHERE username='$oldUsername'";

    $stmt = $conn->prepare($sql);
	$stmt->execute();

// adding new username to session
	
	$_SESSION["username"] = $newUsername;



	$conn = null;

// redirect to homepage
	header("Location: profile.php");
// }

	} catch(PDOException $e){
		echo $e->getMessage();
	}
}

?>
