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
				<li class="nav-item active"><a class="nav-link" href="user_manage.php"><strong>Users</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="employee_manage.php"><strong>Employees</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="admin_request_history.php"><strong>Complete History</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="admin_feedback.php"><strong>User Feedback</strong></a></li>
			</ul>
		</nav>
		<button class="btn btn-secondary logout" id="logout"><span class="fa fa-sign-out"></span> Logout</button>
	</div>
</head>
<body>

	<!--User info Modal -->
<div id="userInfo" class="modal fade" role="dialog" style="height: auto;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">User Info</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body userInfoBody">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!--History info Modal -->
<div id="historyInfo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">User History Info</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body historyInfoBody" style="overflow-y: auto;">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

	<div class="row">
		<h2 style="margin-left: 40px;"><strong>Manage Users</strong></h2>
	</div>
	<div class="row">
		<div class="col-12 col-md-8 m-auto">
			<input id="search" type="text" name="search" class="form-control-md" placeholder="Search" style="margin-bottom: 5px;float: right;">
			<table id="userTable" class="table table-striped table-bordered">
				<tr>
					<th>User</th>
					<th style="text-align: right;">Details</th>
					<th></th>
				</tr>
				<?php

					$servername = "localhost";
					$user = "ashish";
	                $pass = "Thoppil4-";
	                $dbname = "smdb";

					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$stmt = $conn->prepare("SELECT * FROM user WHERE userType='user'");

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
				url:"load_user_info.php",
				data:"id="+id,
				success: function(data){
					$('.userInfoBody').html(data);
					$('#userInfo').modal('show');
				}
			});
		});

		$("body").on('click','.viewHistory',function() {
			let username = this.id; 
		
			$.ajax({
				type:"POST",
				url:"view_user_history.php",
				data:"username="+username,
				success: function(data){

					$('.historyInfoBody').html(data);
					$('#historyInfo').modal('show');
				}
			});
		});

		$("body").on('click','.delUser',function() {
			let id = this.id; 
		
			$.ajax({
				type:"POST",
				url:"delete_user.php",
				data:"id="+id,
				success: function(data){
					window.location.replace("user_manage.php");
					alert("The user was removed");
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

	$('#search').keyup(function(){

		let term = this.value; 
			$.ajax({
				type:"POST",
				url:"user_search.php",
				data:"term="+term+"&fromEmp=0",
				success: function(data){
					$('#userTable').html(data);
				}
			});
	});
</script>
