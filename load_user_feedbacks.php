<?php

	$servername = "localhost";
	$user = "ashish";
	$pass = "Thoppil4-";
	$dbname = "smdb";

	$username = $_POST["id"];

	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$stmt = $conn->prepare("SELECT * FROM feedback WHERE sender='$username' OR receiver='$username' ORDER BY sentAt ASC");

				$stmt->execute();

				$results = $stmt->fetchAll();

				
				if(!empty($results)){
				foreach($results as $result){
					if($result["sender"] == $username){
						echo "<p><a href='#'>" . $result["name"] . "</a>:" . $result["comment"] ."</p>";
					}else{
						echo "<p><a href='#'>" . $result["name"] . "</a>	:" . $result["comment"] ."</p>";
					}
			}
			
		
					echo "<form class='form' method='POST' action='send_admin_feedback.php'><input type='text' value='". $username ."' name='hiddenUsername' class='hidden'><textarea style='margin-top:10px;resize:none;' class='form-control' name='adminComments' id='adminComments' rows='3'></textarea><input style='margin-top:5px;float:right;' type='submit' value='send' class='btn btn-success'></form>";
				}else{
					echo "Nothing to display";
				}

?>
