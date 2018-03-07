<?php
$con = @mysqli_connect('127.0.0.1', 'root','','finalproject2')
    or die('Could not connect: ' . mysql_error());
session_start();
$username = $_SESSION['username'];
$track_title = "";
$track_artist = "";
$track_duration = "";
if(isset($_POST['play_button']))
{
    $track_id = $_POST['track_id'];
    $track_title = $_POST['track_title'];
}

$result = mysqli_query($con, "INSERT INTO `Playrecord` (username, tid, playtime, alid, lid) VALUE ('$username','$track_id',NOW(),NULL,NULL);");
echo "Playing: $track_title"
?>
<br></br>
<a href="../Browser/search.php" >back to search..</a>