<?php
require 'connect.inc.php';

if (isset($_POST['uname']) and isset($_POST['username']) and isset($_POST['pwd1']) and isset($_POST['pwd2']) and !empty($_POST['uname']) and !empty($_POST['username']) and !empty($_POST['pwd1']) and !empty($_POST['pwd2'])) {

	$uname = mysqli_real_escape_string($conn, $_POST['uname']);
	$username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
	$pwd1 = $_POST['pwd1'];
	$pwd2 = $_POST['pwd2'];


		//Check if username exists

$sql = "SELECT username FROM user WHERE username='$username'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

if (mysqli_num_rows($res)>0) {
	echo 'That username is taken...';
} else {
	if ($pwd1 == $pwd2) {
		#$pwd1 = PASSWORD_HASH($pwd1, PASSWORD_BCRYPT);

		//The higher the number on the cost is, the longer it takes to hash the password and the harder it is to crack. Anything from 10-14 should be fine.
        
		$sql = "INSERT INTO user (uname, username, passkey, uemail, ucity) VALUES ('$uname', '$username', '$pwd1', '$email', '$city')";
		$res = mysqli_query($conn, $sql);
		header("Location: index.php");
		exit();
			
		

	} else {
		echo 'The passwords you entered didn\'t match...';
	}
}


}


?>


<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<style type="text/css">
		#register{
			height: auto;
			width: 310px;
			margin: auto;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
			margin: auto;
			font-family: Helvetica;
			text-align: center;
		}
		
		INPUT {
			height: 40px;
			width: 300px;
			margin-top: 5px;
			border-radius: 5px;
			border: 1px solid skyblue;
		}

		INPUT:HOVER {
			border: 1px solid blue;
		}

		.button {
			background-color: white;
			width: 150px;
		}
	</style>
</head>
<body>
	<div id="container">
		<div id="register">
			<h2>Register</h2>
			<form action="register.php" method="POST">
	<input type="text" name="uname" placeholder="Real Name"><br>
	<input type="text" name="username" placeholder="Username"><br>
    <input type="text" name="email" placeholder="Email"><br>
    <input type="text" name="city" placeholder="City"><br>
	<input type="password" name="pwd1" placeholder="Password"><br>
	<input type="password" name="pwd2" placeholder="Re-Enter Password"><br><br>
	<input type="submit" value="Register" class="button">
</form>
</div>
</div>

</body>
</html>