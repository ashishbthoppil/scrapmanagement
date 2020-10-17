<?php

	$servername = "localhost";
  $user = "ashish";
  $pass = "Thoppil4-";
  $dbname = "smdb";

	$id = $_POST["id"];

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
 
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "UPDATE request SET status='2' WHERE id='$id'";

  $conn->exec($sql);

  $conn = null;
  
} catch(PDOException $e) {
  echo $e->getMessage();
}

?>
