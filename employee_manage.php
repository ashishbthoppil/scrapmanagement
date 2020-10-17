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
				<li class="nav-item active"><a class="nav-link" href="employee_manage.php"><strong>Employees</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="admin_request_history.php"><strong>Complete History</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="admin_feedback.php"><strong>User Feedback</strong></a></li>
			</ul>
		</nav>
		<button class="btn btn-secondary logout" id="logout"><span class="fa fa-sign-out"></span> Logout</button>
	</div>
</head>
<body>


	<!-- New Employee  Modal -->
<div id="newEmpModal" class="modal fade" role="dialog" style="overflow: auto;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add employee details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body newEmpBody">
       <form class="form" method="POST" action="emp_registration.php">
						   <label for="name">Name: </label>
						   <!-- &nbsp;&nbsp;&nbsp;<span id="nameError" class="hidden" style="color: red;"><strong>*Name should be 6 or more characters</strong></span> -->	
						   <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name" required="true">
						   <label for="email">Email: </label>
						   <!-- &nbsp;&nbsp;&nbsp;<span id="emailError" class="hidden" style="color: red;"><strong>*Invalid email address</strong></span> -->
						   <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email id" required="true">
						   <label for="mob">Mobile: </label>
						   <!-- &nbsp;&nbsp;&nbsp;<span id="mobileError" class="hidden" style="color: red;"><strong>*Invalid mobile no.</strong></span> -->
						   <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter Mobile Number" required="true">
                           <label for="age">Age: </label>
                           <!-- &nbsp;&nbsp;&nbsp;<span id="ageError" class="hidden" style="color: red;"><strong>*Invalid age</strong></span> -->
						   <input type="text" name="age" id="age" class="form-control" placeholder="Enter your age" required="true">
						   <br>
						   <label for="gender">Gender: </label>
						   
						   	 <input type="radio" name="gender" id="genderm" value="Male" style="position: absolute;left: 17.5em;bottom: 34.4em;" checked="true"><span style="position: absolute;left: 15em;">Male</span></input>
							<input type="radio" name="gender" id="genderf" value="Female" style="position: absolute;left: 22.5em;bottom: 34.4em;"><span style="position: absolute;left: 19em;">Female</span></input>
						<br>
						   <label for="address">Address: </label>
						   <!-- &nbsp;&nbsp;&nbsp;<span id="addressError" class="hidden" style="color: red;"><strong>*Address should be 10 or more characters</strong></span> -->
						   <textarea name="address" id="address" class="form-control" placeholder="Enter Address" style="resize: none;" rows="3" required="true"></textarea>
						   <label for="address">Country: </label>
						   <select id="country" name="country" class="form-control">
							   <option value="India">India</option>
							   <option value="USA">USA</option>
							   <option value="UK">UK</option>
							   <option value="Australia">Australia</option>
						</select>
						   <label for="landmark">Landmark: </label>
						   <input type="text" name="landmark" id="landmark" class="form-control" placeholder="Enter nearest Landmark">
						   <label for="username">Username : </label>
						   <!-- &nbsp;&nbsp;&nbsp;<span id="usernameError" class="hidden" style="color: red;"><strong>*Username should be between 6 and 15 characters</strong></span> -->
						   <input type="text" name="username" id="username" class="form-control" placeholder="Enter a username" required="true">
						     <label for="password">Password : </label>
						     <!-- &nbsp;&nbsp;&nbsp;<span id="passwordError" class="hidden" style="color: red;"><strong>*Password should be between 6 and 15 characters</strong></span> -->
						   <input type="password" name="password" id="password" class="form-control" placeholder="Enter a password" required="true">
						   <label for="cpassword">Confirm password : </label>
						   <!-- &nbsp;&nbsp;&nbsp;<span id="cpasswordError" class="hidden" style="color: red;"><strong>*Passwords do not match</strong></span> -->
						   <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Enter a password again" required="true">
							<input type="submit" name="register" value="Register" class="btn btn-primary" style="float: right;margin-top: 15px;">
					   </form>
      </div>
      <!-- <div class="modal-footer"> -->
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
      <!-- </div> -->
    </div>

  </div>
</div>


	<!--Employee info Modal -->
<div id="empInfo" class="modal fade" role="dialog" style="height: auto;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Employee Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body empInfoBody">
       
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
        <h4 class="modal-title">Employee Work History</h4>
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
		<h2 style="margin-left: 40px;"><strong>Employee Management</strong></h2>
	</div>
	<div class="row">
		<div class="col-12 col-md-8 m-auto">
			<button style="margin-bottom: 5px;" id="newEmp" class="btn btn-warning"><span class="fa fa-plus"> New Employee</span></button>
			<input id="search" type="text" name="search" class="form-control-md" placeholder="Search" style="margin-bottom: 5px;float: right;">
			<table id="empTable" class="table table-striped table-bordered">
				<tr>
					<th>Employee name</th>
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

					$stmt = $conn->prepare("SELECT * FROM user WHERE userType='employee'");

					$stmt->execute();

					$results = $stmt->fetchAll();

					if(!empty($results)){
					foreach($results as $result){
						echo "<tr><td><a href='#' class='empLink' id='". $result["id"] ."'>". $result["username"] ."</a></td><td style='text-align: right;''><button id='". $result["username"] ."' class='btn btn-primary viewHistory'><span class='fa fa-note'></span> View Work History</button></td><td style='text-align: right;''><button id='". $result["id"] ."' class='btn btn-danger delEmp'><span class='fa fa-close'></span> Terminate Employee</button></td></tr>";
					}
				}else{
					echo "<tr><td colspan='3' style='text-align:center;'>No Employees</td></tr>";
				}

				?>
			</table>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$('#newEmp').click(function(){
		$('#newEmpModal').modal('show');
	});

	$("body").on('click','.delEmp',function() {
			let id = this.id; 
			
			$.ajax({
				type:"POST",
				url:"terminate_employee.php",
				data:"id="+id,
				success: function(data){
					window.location.replace("employee_manage.php");
					alert("The employee was terminated!");
				}
			});
		});

	$("body").on('click','.empLink',function() {
			let id = this.id; 
			$.ajax({
				type:"POST",
				url:"load_emp_info.php",
				data:"id="+id,
				success: function(data){
					$('.empInfoBody').html(data);
					$('#empInfo').modal('show');
				}
			});
		});


	$("body").on('click','.viewHistory',function() {
			let username = this.id; 
		
			$.ajax({
				type:"POST",
				url:"view_emp_history.php",
				data:"username="+username,
				success: function(data){

					$('.historyInfoBody').html(data);
					$('#historyInfo').modal('show');
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
				data:"term="+term+"&fromEmp=1",
				success: function(data){
					$('#empTable').html(data);
				}
			});
	});

</script>

