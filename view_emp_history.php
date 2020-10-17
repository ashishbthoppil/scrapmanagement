<?php

$servername = "localhost";
	$user = "ashish";
	$pass = "Thoppil4-";
	$dbname = "smdb";
	$username = $_POST["username"];

	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$empStmt = $conn->prepare("SELECT * FROM user WHERE username='$username'");

				$empStmt->execute();

				$empId = $empStmt->fetchAll()[0]['id'];


				$stmt = $conn->prepare("SELECT * FROM request WHERE employee='$empId' ORDER BY createdAt DESC");
				//  WHERE username='$username'

				$stmt->execute();

				$results = $stmt->fetchAll();

				// $content
$count = count($results);

if(!empty($results)){

	foreach ($results as $result) {
		$status = '';
		$itemString = $result["items"];
		$quantString = $result["quantities"];
		$itemArray = explode(',', $itemString);
		$quantArray = explode(',', $quantString);
		$size = sizeof($itemArray);
		if($result["status"] == 0){
			$status = "Pending";
		}else if($result["status"] == 1){
			$status = "In progress";
		}else{
			$status = "Completed";
		}
		$content = "<div class='historyDiv' style='height:auto;'><p><u>Transaction " . $count . "(Requested by :<a href='#'>". $result["requester"] ."</a>)</u><span style='font-size:10px;float:right;'>Created At: ". date("d-M-Y, H:i A", strtotime($result["createdAt"] )) ."</span></p><table class='table table-striped' style='width:100%'><tr><th><u>Items(Qty)</u></th><th><u>Total</u></th><th><u>Status</u></th></tr>";

		// <th><u>Status</u></th></tr>

		for($i = 0; $i < $size; $i++){
			
			if($i == 0){
			$content = $content . "<tr><td>". $itemArray[$i] . "(". $quantArray[$i] ." kg)" ."</td><td rowspan=". $size ." style='vertical-align:middle;'>Rs. ". $result["totalAmt"] ."</td><td rowspan=". $size ." style='vertical-align:middle;'>". $status ."</td></tr>";	
		}else{
			$content = $content . "<tr><td>". $itemArray[$i] . "(". $quantArray[$i] ." kg)" ."</td></tr>";	
		}
		
		}

		$content = $content . "</table></div>";

		echo $content;

		$count--;
		
	}
}else{
	$content = "<div class='historyDiv table-striped' style='overflow:auto;text-align:center;padding:30px;'><strong>Nothing to display</strong></div>";
	echo $content;
}

$conn = null;


?>
