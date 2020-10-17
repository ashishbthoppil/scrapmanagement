<!DOCTYPE html>
<html>

<!-- jQuery -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<!-- Bootstrap CDN -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- Bootstrap JS CDN -->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<!-- Stylesheet -->

<link rel="stylesheet" type="text/css" href="css/styles.css">

<!-- Social Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
	<title>Scrap Management System</title>
	<div class="jumbotron">
		<h1 style="color: floralwhite;"><strong>Scrap Management System</strong></h1>
		<nav class="navbar navbar-dark navbar-expand-lg" style="position: absolute;right: 10px;top: 140px;">
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="emp_home.php"><strong>Home</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="emp_profile.php"><strong>Profile</strong></a></li>
				<li class="nav-item active"><a class="nav-link" href="emp_history.php"><strong>History</strong></a></li>
				
			</ul>
		</nav>
		<button class="btn btn-secondary logout" id="logout"><span class="fa fa-sign-out"></span> Logout</button>
	</div>
</head>
	<body>
		<div class="row">
			<div class="col-12 col-md-4">
				<h3><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Complete History</h3>
			</div>
		</div><br>
		<div class="row">
			<div class="col-12 col-md-8 m-auto">
	<?php 

	$servername = "localhost";
	$user = "ashish";
	$pass = "Thoppil4-";
	$dbname = "smdb";

	session_start(); 
	$username = $_SESSION["username"];

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
			$status = "Assigned (" .$result['employee']. ")";
		}else{
			$status = "Completed";
		}
		$content = "<div class='historyDiv' style='height:auto;'><p><u>Transaction " . $count . " (Requested by: <a href>". $result["requester"] ."</a>)</u><span style='font-size:10px;float:right;'>Created At: ". date("d-M-Y, H:i A", strtotime($result["createdAt"] )) ."</span></p><table class='table table-striped table-bordered' style='width:100%'><tr><th><u>Items(Qty)</u></th><th><u>Total</u></th><th><u>Status</u></th></tr>";

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



				
			</div>
		</div>
	
	</body>

<footer>
<div class="footer">
		<h4 style="padding: 15px;"><strong>Contact us: </strong></h4>
		<p style="font-size: 15px;position:absolute;left: 13em;bottom: 3em;">Tele : +0469-234567</p>
		<p style="font-size: 15px;position: absolute;left: 13em;bottom: 1em;">Mob : +91-9876543210</p>
		<h4 style="padding: 15px;position: absolute;right: 10em;bottom: 1.7em;"><strong>Follow us: </strong></h4>
		<div style="position: absolute;right: 8em;">
		<a href="#" class="fa fa-facebook" style="font-size: 30px;"></a>&nbsp;&nbsp;
		<a href="#" class="fa fa-twitter" style="font-size: 30px;"></a>&nbsp;&nbsp;
		<a href="#" class="fa fa-instagram" style="font-size: 30px;"></a>
	</div>
</div>
</footer>
</html>


<script type="text/javascript">
	$('#edit').click(function(){
		$('.editInputs').removeClass('editInp');
		$('#save').prop('disabled', null);
		$('#edit').prop('disabled', 'true');
	});

	$('#logout').click(function(){
	sessionStorage.setItem("user",'');
	window.location.replace("/scrap_management");
});

</script>
