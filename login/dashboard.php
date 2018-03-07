<?php
session_start();
require 'connect.inc.php';
if (!isset($_SESSION['username'])) {
	header("Location: index.php");
	exit();
}

//get user info
$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username='$username'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<style type="text/css">
		BODY {
			margin: 0;
			padding: 0;
			background-color: lightgray;
		}

		#header {
			height: 30px;
			width: 100%;
			background-color: skyblue;
			text-align: center;
			top: 0;
			position: fixed;
		}

		#header H2{
			margin-top: -1px;
		}

		#welcome {
			margin-top: 30px;
		}
	</style>
</head>
<body>
	<div id="container">
	<div id="header"><h2>Welcome to the World of Music!</h2></div>
	<?php
	echo '<div id="welcome"><h3>Hello, '. $row['uname'].'!<br></h3></div>';
	?>
        
    <form action="../Browser/search.php" method = "post">
    <input name="keywords" type="text" placeholder="Search Keywords">
    <input type="submit" name = "search_button" value = "search">
    </form>    
	<a href="logout.php">Logout</a>

</body>
</html>