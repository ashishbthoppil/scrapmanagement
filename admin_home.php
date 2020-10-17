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
				<li class="nav-item active"><a class="nav-link" href="admin_home.php?admin=yes"><strong>Home</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="user_manage.php"><strong>Users</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="employee_manage.php"><strong>Employees</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="admin_request_history.php"><strong>Complete History</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="admin_feedback.php"><strong>User Feedback</strong></a></li>
			</ul>
		</nav>
		<button class="btn btn-secondary logout" id="logout"><span class="fa fa-sign-out"></span> Logout</button>
	</div>
</head>
<body>
	<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title">Employee Assignment</h4>
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


	$stmt = $conn->prepare("SELECT * FROM user WHERE userType='employee'");

				$stmt->execute();

				$results = $stmt->fetchAll();

				echo "<div class='container'><div class='row'><div class='col-12 col-md-12 m-auto'><select class='form-control-sm' id='employee'>";
				if(!empty($results)){
				foreach($results as $result){
					echo "<option value='". $result['username'] ."'>" . $result['name'] . "</option>";

			}
		}else{
			echo "<option></option>";
		}
		echo "</select> <button class='btn-sm btn-success empAssign'>Assign</button></div></div></div>";

			} catch(PDOException $e){
				echo $e->getMessage();
			}

      	?>
      </div>
    </div>

  </div>
</div>


<div class="container">
		<div class="row">
			<h2><strong id="welcomeText">Welcome Admin,</strong></h2>
		</div><br>
		<div class="row">
			<div class="col-12 col-md-8 m-auto">	
				<h3 style="text-align: center;"><span style="border-style: solid;padding : 5px;border-radius: 10px;background-color: grey;color: white;"><strong>Pending User Requests</strong></span></h3>
			</div>
		</div>

		<?php 

	$servername = "localhost";
	$user = "ashish";
	$pass = "Thoppil4-";
	$dbname = "smdb";

	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$stmt = $conn->prepare("SELECT * FROM request WHERE status='0' ORDER BY createdAt DESC");

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
			$content = $content . "<tr><td>". $itemArray[$i] . "(". $quantArray[$i] ." kg)" ."</td><td rowspan=". $size ." style='vertical-align:middle;text-align:right;'>Rs. ". $result["totalAmt"] ."</td><td rowspan=". $size ." style='vertical-align:middle;text-align:right;'><button id='". $result['id'] ."' class='btn btn-primary assignTask'><span class='fa fa-tasks'></span> Assign</button></td><td rowspan=". $size ." style='vertical-align:middle;text-align:right;'><button id='". $result['id'] ."' class='btn btn-danger delTask'><span class='fa fa-closer'></span> Delete</button></td></tr>";	
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

</html>
<script type="text/javascript">
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

	$("body").on('click','.assignTask',function() {
			let thisId = this.id;
			$('#myModal').modal('show');
			$('.empAssign').prop('id',thisId);
		});

	$("body").on('click','.delTask',function() {
			let thisId = this.id;
			$.ajax({
			type:"POST",
			url:"delete_request.php",
			data:"id="+thisId,
			success: function(data){
				alert("Task deleted succesfully");
				window.location.replace("admin_home.php");
			}
		});
		});


$('.empAssign').click(function(){
	let employee = $('#employee').val();
	let reqId = this.id;
	$.ajax({
			type:"POST",
			url:"assign_employee_to_request.php",
			data:"id="+reqId+"&employee="+employee,
			success: function(data){
				alert("Task assigned to "+employee);
				window.location.replace("admin_home.php");
				}
		});
});

</script>
