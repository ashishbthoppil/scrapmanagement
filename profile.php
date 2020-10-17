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


<!-- Stylesheet -->

<link rel="stylesheet" type="text/css" href="css/styles.css">

<!-- Social Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
	<title>Scrap Management System</title>
	<div class="jumbotron">
		<h1 style="text-align: center;"><strong>Scrap Management System</strong></h1>
		<nav class="navbar navbar-dark navbar-expand-lg" style="position: absolute;right: 10px;top: 140px;">
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="user_home.html"><strong>Home</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="user_history.php"><strong>History</strong></a></li>
				<li class="nav-item active"><a class="nav-link" href="profile.php"><strong>Profile</strong></a></li>
				<li class="nav-item"><a class="nav-link" href="contactus.php"><strong>Contact Us</strong></a></li>
			</ul>
		</nav>
		<button class="btn btn-secondary logout" id="logout"><span class="fa fa-sign-out"></span> Logout</button>
	</div>
</head>
<body>
	<?php

	$servername = "localhost";
	$user = "ashish";
	$pass = "Thoppil4-";
	$dbname = "smdb";

	session_start(); 
	$username = $_SESSION["username"];

	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$stmt = $conn->prepare("SELECT * FROM user WHERE username='$username'");

				$stmt->execute();

				$result = $stmt->fetchAll()[0];

				$name = $result["name"];
				$email = $result["email"];
				$mobile = $result["mobile"];
				$age = $result["age"];
				$gender = $result["gender"];
				$address = $result["address"];
				$country = $result["country"];
				$landmark = $result["landmark"];
				$username = $result["username"];
				$password = $result["password"];
	  ?>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6 m-auto">
			   <div class="userEditSection">
					<h2 style="text-align:center;"><strong>User Profile</strong></h2>
				       <form class="form" method="POST" action="edit_user.php">
						   <label for="name">Name: </label>&nbsp;&nbsp;&nbsp;<span id="nameError" class="hidden" style="color: red;"><strong>*Name should be 6 or more characters</strong></span>	
						   <input type="text" name="name" id="name" required="true"  class="form-control editInputs editInp" value="<?php echo $name; ?>">
						   <label for="email">Email: </label>&nbsp;&nbsp;&nbsp;<span id="emailError" class="hidden" style="color: red;"><strong>*Invalid email address</strong></span>
						   <input type="email" name="email" id="email" required="true"  class="form-control editInputs editInp" value="<?php echo $email; ?>">
						   <label for="mob">Mobile: </label>&nbsp;&nbsp;&nbsp;<span id="mobileError" class="hidden" style="color: red;"><strong>*Invalid mobile no.</strong></span>
						   <input type="text" name="mobile" id="mobile" required="true"  class="form-control editInputs editInp" value="<?php echo $mobile; ?>">
                           <label for="age">Age: </label>&nbsp;&nbsp;&nbsp;<span id="ageError" class="hidden" style="color: red;"><strong>*Invalid age</strong></span>
						   <input type="text" name="age" id="age" required="true"  class="editInputs editInp form-control" value="<?php echo $age; ?>">
						   <br>
						   <label for="gender">Gender: </label>
						   <?php 
						   	if ($gender == 'Male') {
						   		echo "<input checked='true' type='radio' class='editInputs editInp' name='gender' id='genderm' value='Male' style='position: absolute;left: 17.5em;bottom: 30.8em;'><span style='position: absolute;left: 15em;'>Male</span></input>
						   		<input type='radio'  class='editInputs editInp' name='gender' id='genderf' value='Female' style='position: absolute;left: 22.5em;bottom: 30.8em;'><span style='position: absolute;left: 19em;'>Female</span></input>";
						   	}else{
						   		echo "<input type='radio'  class='editInputs editInp' name='gender' id='genderm' value='Male' style='position: absolute;left: 17.5em;bottom: 30.8em;'><span style='position: absolute;left: 15em;'>Male</span></input>
						   		<input checked='true' type='radio'  class='editInputs editInp' name='gender' id='genderf' value='Female' style='position: absolute;left: 22.5em;bottom: 30.8em;'><span style='position: absolute;left: 19em;'>Female</span></input>";
						   	}

						   ?>
						<br>
						   <label for="address">Address: </label>&nbsp;&nbsp;&nbsp;<span id="addressError" class="hidden" style="color: red;"><strong>*Address should be 10 or more characters</strong></span>
						   <textarea  name="address" id="address" class="form-control editInputs editInp" style="resize: none;" rows="3" required="true"><?php echo $address; ?></textarea>
						   <label for="address">Country: </label>
						   <select  id="country" name="country" class="form-control editInputs editInp">
						   	<option value=""></option>
						   <?php 
						   	if($country == 'India'){
							  echo "<option value='India' selected='selected'>India</option>";
							}else{
 							echo "<option value='India'>India</option>";
							}
							if($country == 'USA'){
							   echo "<option value='USA' selected='selected'>USA</option>";
							}else{
								echo "<option value='USA'>USA</option>";
							}
							if($country == 'UK'){
							   echo "<option value='UK' selected='selected'>UK</option>";
							}else{
							echo "<option value='UK'>UK</option>";
							}
							if($country == 'Australia'){
							 echo "<option value='Australia' selected='selected'>Australia</option>";
							}else{
							  echo "<option value='Australia'>Australia</option>";
}
							?>
							
						</select>
						   <label for="landmark">Landmark: </label>
						   <input  type="text" name="landmark" id="landmark" class="form-control editInputs editInp" value="<?php echo $landmark; ?>">
						   <label for="username">Username : </label>&nbsp;&nbsp;&nbsp;<span id="usernameError" class="hidden" style="color: red;"><strong>*Username should be between 6 and 15 characters</strong></span>
						   <input  type="text" name="username" id="username" class="form-control editInputs editInp" required="true" value="<?php echo $username; ?>">
						     <label for="password">Password : </label>&nbsp;&nbsp;&nbsp;<span id="passwordError" class="hidden" style="color: red;"><strong>*Password should be between 6 and 15 characters</strong></span>
						   <input type="password" name="password" id="password" class="form-control editInputs editInp" required="true" value="<?php echo $password; ?>">
						   <!-- <label for="cpassword">Confirm password : </label>&nbsp;&nbsp;&nbsp;<span id="cpasswordError" class="hidden" style="color: red;"><strong>*Passwords do not match</strong></span>
						   <input type="password" name="cpassword" id="cpassword" class="form-control" required="true"> -->
						   <input type="submit" id="save" name="save" value="Save" class="btn btn-success" style="float: right;margin-top: 15px;margin-right:1em;" disabled>
							<input type="button" id="edit" name="edit" class="btn btn-primary" value="Edit" style="float: right;margin-top: 15px;margin-right:1em;">
							
					   </form>
			   </div>
		</div>
	</div>
		<div class="row">
			<div class="col-12 col-md-10 m-auto">
			<footer class="footer">
		<h4 style="padding: 15px;"><strong>Contact us: </strong></h4>
		<p style="font-size: 15px;position:absolute;left: 13em;bottom: 3em;">Tele : +0469-2345674</p>
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
	$('#edit').click(function(){
		$('.editInputs').removeClass('editInp');
		$('#save').prop('disabled', null);
		$('#edit').prop('disabled', 'true');
	});

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

	$('#logout').click(function(){
	sessionStorage.setItem("user",'');
	window.location.replace("/scrap_management");
});

</script>
