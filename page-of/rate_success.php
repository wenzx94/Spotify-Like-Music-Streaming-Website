<?php
$con = @mysqli_connect('127.0.0.1', 'root','','finalproject2')
    or die('Could not connect: ' . mysql_error());
session_start();
$username = $_SESSION['username'];
$track_title = "";
$track_artist = "";
$track_duration = "";
if(isset($_POST['rate_this_song']))
{
    $track_id = $_POST['track_id'];
    $score = $_POST['score'];
    $track_title = $_POST['track_title'];
}

#$result = mysqli_query($con, "INSERT INTO `Playrecord` (username, tid, playtime, alid, lid) VALUE ('$username','$track_id',NOW(),NULL,NULL);");
echo "Rate success for: $track_title"
?>
<br></br>
<?php
$result = mysqli_query($con, "select * from rate where username = '$username' and tid = '$track_id'");
if(mysqli_num_rows($result) > 0)//Return the number of rows in a result set
{
	mysqli_query($con, "UPDATE `rate` SET score = $score where username = '$username' and tid = '$track_id';"); 

} 
else 
{
	mysqli_query($con, "INSERT INTO `rate` (username, tid, ratetime, score) VALUES ('$username','$track_id',NOW(),$score);"); 
}
?>
<br></br>
    <a href="../Browser/search.php" >back to search..</a>