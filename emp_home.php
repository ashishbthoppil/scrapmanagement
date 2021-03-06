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
				<li class="nav-item active"><a class="nav-link" href="emp_home.php"><strong>Home</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="emp_profile.php"><strong>Profile</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="emp_history.php"><strong>History</strong></a></li>
				
			</ul>
		</nav>
		<button class="btn btn-secondary logout" id="logout"><span class="fa fa-sign-out"></span> Logout</button>
	</div>
</head>
<body>
	<div class="container">
		<div class="row">
			<h2><strong id="welcomeText">LoggedIn as Employee,</strong></h2>
		</div><br>
		<div class="row">
			<div class="col-12 col-md-8 m-auto">	
				<h3 style="text-align: center;"><span style="border-style: solid;padding : 5px;border-radius: 10px;background-color: grey;color: white;"><strong>Assigned Works</strong></span></h3>
			</div>
		</div>

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

				$stmt = $conn->prepare("SELECT * FROM request WHERE status='1' AND employee='$empId' ORDER BY createdAt DESC");
				//  WHERE username='$username'

				$stmt->execute();

				$results = $stmt->fetchAll();
			if(!empty($results)){
				foreach($results as $result){

					$itemString = $result["items"];
					$quantString = $result["quantities"];
					$itemArray = explode(',', $itemString);
					$quantArray = explode(',', $quantString);
					$size = sizeof($itemArray);

					$content = "<div class='historyDiv' style='height:auto;'><p><u><strong>Request (Requested by: <a class='userInf'>". $result["requester"] ."</a>) </strong></u><span style='font-size:10px;float:right;'>Requested On: ". date("d-M-Y, H:i A", strtotime($result["createdAt"] )) ."</span></p><table class='table table-striped' style='width:100%'><tr><th><u>Items(Qty)</u></th><th style='text-align:right;'><u>Total</u></th><th></th><th></th><th></th></tr>";
			

		// <th><u>Status</u></th></tr>

		for($i = 0; $i < $size; $i++){
			
			if($i == 0){
			$content = $content . "<tr><td>". $itemArray[$i] . "(". $quantArray[$i] ." kg)" ."</td><td rowspan=". $size ." style='vertical-align:middle;text-align:right;'>Rs. ". $result["totalAmt"] ."</td><td></td><td rowspan=". $size ." style='vertical-align:middle;text-align:right;'><button id='". $result['id'] ."' class='btn btn-success Done'><span class='fa fa-check'></span> Done</button></td></tr>";	
		}else{
			$content = $content . "<tr><td>". $itemArray[$i] . "(". $quantArray[$i] ." kg)" ."</td></tr>";	
		}
		
		}

		$content = $content . "</table></div>";

		echo $content;

	}
				}else{
				echo "<div class='historyDiv' style='height:auto;text-align:center;padding:15px;'><p><strong>No pending requests</strong></p></div>";
			}

		?>


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
	
	$("body").on('click','.Done',function() {
			let thisId = this.id;
			$.ajax({
			type:"POST",
			url:"complete_task.php",
			data:"id="+thisId,
			success: function(data){
				alert("Task completed succesfully");
				window.location.replace("emp_home.php");
			}
		});
		});


	$('#logout').click(function(){
	sessionStorage.setItem("user",'');
	window.location.replace("/scrap_management");
});

</script>














