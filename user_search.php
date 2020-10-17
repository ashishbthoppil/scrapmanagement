<?php

		$servername = "localhost";
		$user = "ashish";
	    $pass = "Thoppil4-";
	    $dbname = "smdb";

		$term = $_POST["term"];

		$fromEmp = $_POST["fromEmp"];

		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if($fromEmp != 1){
			$stmt = $conn->prepare("SELECT * FROM user WHERE userType='user' AND username LIKE '$term%'");
			echo "<tr>
					<th>User</th>
					<th style='text-align: right;'>Details</th>
					<th></th>
				</tr>";
		}else{
			$stmt = $conn->prepare("SELECT * FROM user WHERE userType='employee' AND username LIKE '$term%'");
			echo "<tr>
					<th>Employee</th>
					<th style='text-align: right;'>Details</th>
					<th></th>
				</tr>";
		}

		$stmt->execute();

		$results = $stmt->fetchAll();

		
		if(!empty($results)){
			foreach($results as $result){
				echo "<tr><td><a class='userLink' id='". $result["id"] ."'>". $result["username"] ."</a></td><td style='text-align: right;''><button id='". $result["username"] ."' class='btn btn-primary viewHistory'><span class='fa fa-note'></span> View requests</button></td><td style='text-align: right;''><button id='". $result["id"] ."' class='btn btn-danger delUser'><span class='fa fa-close'></span> Delete User</button></td></tr>";
					}
		}else{
			echo "<tr><td colspan='3' style='text-align:center;'>No Users</td></tr>";
		}
		

				?>
