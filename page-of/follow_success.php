<?php
$con = @mysqli_connect('127.0.0.1', 'root','','finalproject2')
    or die('Could not connect: ' . mysql_error());
session_start();
$username = $_SESSION['username'];
if(isset($_POST['follow_button']))
{
    $user_name2 = $_POST['user_name2'];
}

#$result = mysqli_query($con, "INSERT INTO `Playrecord` (username, tid, playtime, alid, lid) VALUE ('$username','$track_id',NOW(),NULL,NULL);");

?>
<?php
echo "Follow $user_name2 successfully! ";
mysqli_query($con, "INSERT INTO `follow` (username1, username2, followtime) VALUES ('$username','$user_name2',NOW());");
?>
<br></br>
    <a href="../Browser/search.php">back to search results..</a>