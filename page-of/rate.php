<?php
$con = @mysqli_connect('127.0.0.1', 'root','','finalproject2')
    or die('Could not connect: ' . mysql_error());
session_start();
$username = $_SESSION['username'];
$track_id = "";
$track_title = "";
$track_artist = "";
$track_duration = "";
if(isset($_POST['rate_button']))
{
    $track_id = $_POST['track_id'];
    $track_title = $_POST['track_title'];
}

#$result = mysqli_query($con, "INSERT INTO `Playrecord` (username, tid, playtime, alid, lid) VALUE ('$username','$track_id',NOW(),NULL,NULL);");
echo "Rate the song: $track_title"
?>
<br></br>
Score (between 1 and 5):
<form action="rate_success.php" method = "POST">
        <input  name="track_id" type="hidden" value = "<?php echo $track_id?>">
        <input  name="track_title" type="hidden" value = "<?php echo $track_title?>">
        <input type="number" name="score" min="1" max="5">
        <input type="submit" name="rate_this_song" value = "rate"><br>
</form>