<?php

	$servername = "localhost";
	$user = "ashish";
	$pass = "Thoppil4-";
	$dbname = "smdb";

	$id = $_POST["id"];

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
 
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql2 = "DELETE FROM request WHERE username='$id'";

  $conn->exec($sql2);

  $sql1 = "DELETE FROM user WHERE id='$id'";

  $conn->exec($sql1);

  
} catch(PDOException $e) {
  echo $e->getMessage();
}

$conn = null;

?>
