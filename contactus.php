<!DOCTYPE html>
<html>

<style type="text/css">
	body{
		background-image: url("image/scrap.jpg");
		background-repeat: no-repeat;
 		background-size: 100% 100%;
	}
	
</style>

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

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title">Feedbacks & Replies</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<?php

      	$servername = "localhost";
		$user = "ashish";
	    $pass = "Thoppil4-";
	    $dbname = "smdb";

		try{

// DB connection
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	session_start();
	$username = $_SESSION["username"];
	
	$userStmt = $conn->prepare("SELECT * FROM user WHERE username='$username'");

					$userStmt->execute();

					$userId = $userStmt->fetchAll()[0]['id'];

	$stmt = $conn->prepare("SELECT * FROM feedback WHERE sender='$userId' OR receiver='$userId' ORDER BY sentAt ASC");

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
		}else{
			echo "You haven't given a feedback yet";
		}

			} catch(PDOException $e){
				echo $e->getMessage();
			}

      	?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


	<title>Scrap Management System</title>
	<div class="jumbotron">
		<h1 style="text-align: center;"><strong>Scrap Management System</strong></h1>
		<nav class="navbar navbar-dark navbar-expand-lg" style="position: absolute;right: 10px;top: 140px;">
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="user_home.html"><strong>Home</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="user_history.php"><strong>History</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="profile.php"><strong>Profile</strong></a></li>
				<li class="nav-item active"><a class="nav-link" href="contactus.php"><strong>Contact Us</strong></a></li>
			</ul>
		</nav>
		<button class="btn btn-secondary logout" id="logout"><span class="fa fa-sign-out"></span> Logout</button>
	</div>
</head>
<body>
	<div class="container">
		<h3 style="color: floralwhite;"><strong>Feedback Form</strong></h3>
		<div class="row">
			<div class="col-12 col-md-6 m-auto">
			<form class="form">
						   <label for="name" style="color: floralwhite;">Name: </label>
						   <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name">
						   <label for="email" style="color: floralwhite;">Email: </label>
						   <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email id">
						   <label for="feedback" style="color: floralwhite;">Feedback: </label>
						   <textarea id="feedback" class="form-control" style="resize: none;" rows="7"></textarea>
						   <a href="#" class="btn btn-success" id="submitFeedback" style="float: right;position:relative;top: 20px;"><span class="fa fa-paper-plane"></span> Send</a>
						   <button type="button" class="btn btn-warning" id="viewMsg" style="float: right;position:relative;right:5px;top: 20px;"><span class="fa fa-comments-o"> Replies</span></button>
			</form>		
			</div>	
		</div>
		<div class="row">
			<div class="col-12 col-md-10 m-auto">
			<footer class="footer">
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
		</div>
	</div>
	
</body>
</html>

<script type="text/javascript">

	$(document).ready(function(){
			user = sessionStorage.getItem("user");
		if(user == ''){
			document.body.innerHTML = "";
			document.body.innerHTML = '<div class="jumbotron">'+
		'<h1 style="text-align: center;"><strong>Scrap Management System</strong></h1>'+
		'<span style="position:absolute;top:10em;"><strong>Please login to proceed!</strong></span>'+
		'<a href="/" class="btn btn-secondary logout" id="logout"><span class="fa fa-sign-out"></span> Logout</a>'+
	'</div>;'
		}
		});
	
	$('#viewMsg').click(function(){
		$('#myModal').modal('show');
	});

	$('#submitFeedback').click(function(e){

		let name = $('#name').val();
		let email = $('#email').val();
		let feedback = $('#feedback').val();
		
		$.ajax({
			type:"POST",
			url:"add_feedback.php",
			data:"name="+name+'&email='+email+'&feedback='+feedback,
			success: function(data){
				alert('Feedback Sent!');
				window.location.replace("contactus.php");
			}
		});
	});
$('#logout').click(function(){
	sessionStorage.setItem("user",'');
	window.location.replace("/scrap_management");
});

</script>
