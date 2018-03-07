<?php
$con = @mysqli_connect('127.0.0.1', 'root','','finalproject2')
    or die('Could not connect: ' . mysql_error());
session_start();
$username = $_SESSION['username'];
$artist_id = "";
$artist_name = "";
if(isset($_POST['like_button']))
{
    $artist_id = $_POST['artist_id'];
}

#$result = mysqli_query($con, "INSERT INTO `Playrecord` (username, tid, playtime, alid, lid) VALUE ('$username','$track_id',NOW(),NULL,NULL);");

?>
<?php
$result = mysqli_query($con, "SELECT aname as name FROM artist where aid = '$artist_id'");
$row = mysqli_fetch_assoc($result);
$artist_name = $row['name'];
echo "Like $artist_name successfully! ";
mysqli_query($con, "INSERT INTO `likes` (username, aname, liketime) VALUES ('$username','$artist_name',NOW());");
?>
<br></br>
    <a href="../Browser/search_artist_result.php" >back to search results..</a>