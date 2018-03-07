<?php
session_start();
require 'connect.inc.php';
ob_start();

if (isset($_POST['uname']) and isset($_POST['pwd']) and !empty($_POST['uname']) and !empty($_POST['pwd'])) {

	$uname = mysqli_real_escape_string($conn, $_POST['uname']);
	$pwd = $_POST['pwd'];

	$sql = "SELECT * FROM user WHERE username= '$uname'";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($res);
    #echo $row['passkey'];
    #echo $pwd;
	if (mysqli_num_rows($res)<1) {
		echo 'We couldn\'t find that user';
	} else {
		#$pwd = PASSWORD_VERIFY($pwd, $row['passkey']);
        
		$dbuser = $row['username'];
		$dbpwd = $row['passkey'];
        
		#$id = $row['uname'];
        
        
		if ($pwd == $dbpwd and $uname == $dbuser) {
			$_SESSION['username'] = $uname;
			header("Location: dashboard.php");
            #echo 'login success';
			exit();
		} else {
			echo 'Invalid password';
		}
	}

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style type="text/css">
		#login{
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
		A {
			text-decoration: none;
			color: Black;
		}
	</style>
</head>
<body>
	<div id="container">
	<div id="login">
		<h2>Login</h2>
		<form action="index.php" method="POST">
			<input type="text" name="uname" placeholder="Username"><br>
			<input type="password" name="pwd" placeholder="Password"><br><br>
			<a href="register.php">Register</a><br><br>
			<input type="submit" class="button" value="Login">
		</form>
	</div>

</body>
</html>