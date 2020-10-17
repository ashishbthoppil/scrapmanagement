<!DOCTYPE html>
<html>

<!-- jQuery -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<!-- Bootstrap JS CDN -->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<!-- Bootstrap CDN -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

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
				<li class="nav-item"><a class="nav-link" href="admin_home.php?admin=yes"><strong>Home</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="user_manage.php"><strong>Users</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="employee_manage.php"><strong>Employees</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="admin_request_history.php"><strong>Complete History</strong></a></li>
				<li class="nav-item active"><a class="nav-link" href="admin_feedback.php"><strong>User Feedback</strong></a></li>
			</ul>
		</nav>
		<button class="btn btn-secondary logout" id="logout"><span class="fa fa-sign-out"></span> Logout</button>
	</div>
</head>
<body>

	<!--User info Modal -->
<div id="feedbackModal" class="modal fade" role="dialog" style="height: auto;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">User Info</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body feedbackModalBody">
       
      </div>
    </div>

  </div>
</div>


	<div class="row">
		<h2 style="margin-left: 40px;"><strong>Feedbacks</strong></h2>
	</div>
	<div class="row">
		<div class="col-12 col-md-8 m-auto">
			<input id="search" type="text" name="search" class="form-control-md" placeholder="Search" style="margin-bottom: 5px;float: right;">
			<table id="userTable" class="table table-striped table-bordered">
				<tr>
					<th>Sl no.</th>
					<th>Users with feedback</th>
				</tr>
				<?php

					$servername = "localhost";
					$user = "ashish";
					$pass = "Thoppil4-";
					$dbname = "smdb";

					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$adminStmt = $conn->prepare("SELECT * FROM user WHERE userType='admin'");

				$adminStmt->execute();

				$adminId = $adminStmt->fetchAll()[0]['id'];

					$stmt = $conn->prepare("SELECT DISTINCT sender FROM feedback WHERE sender != '$adminId'");

					$stmt->execute();

					$results = $stmt->fetchAll();

					$count = 0;

					if(!empty($results)){
					foreach($results as $result){
						$count++;
						echo "<tr><td>". $count ."</td><td><a class='userLink' id='". $result["sender"] ."'>". $result["sender"] ."</a></td></tr>";
					}
				}else{
					echo "<tr><td colspan='3' style='text-align:center;'>No Users</td></tr>";
				}

				?>
			</table>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	
	$("body").on('click','.userLink',function() {
			let id = this.id; 
			$.ajax({
				type:"POST",
				url:"load_user_feedbacks.php",
				data:"id="+id,
				success: function(data){
					$('.feedbackModalBody').html(data);
					$('#feedbackModal').modal('show');
				}
			});
		});

		$(document).ready(function(){


		let searchParams = new URLSearchParams(window.location.search);
		if (searchParams.get('admin') !== undefined && searchParams.get('admin') !== null) {
			sessionStorage.setItem("user", searchParams.get('admin'));
		}
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

	$('#logout').click(function(){

	sessionStorage.setItem("user",'');
	window.location.replace("/scrap_management");
});


</script>
