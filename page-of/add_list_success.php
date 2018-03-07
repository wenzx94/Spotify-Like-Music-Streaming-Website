<?php
$con = @mysqli_connect('127.0.0.1', 'root','','finalproject2')
    or die('Could not connect: ' . mysql_error());
session_start();
$username = $_SESSION['username'];
$track_id = "";
$list_id = "";
$track_name = "";
if(isset($_POST['add_to_list_button']))
{
    $track_id = $_POST['track_id'];
    $list_id = $_POST['list_id'];
    $track_title = $_POST['track_title'];
}

#$result = mysqli_query($con, "INSERT INTO `Playrecord` (username, tid, playtime, alid, lid) VALUE ('$username','$track_id',NOW(),NULL,NULL);");
echo "Add $track_title to list successfully! "
?>
<br></br>
<?php
$result = mysqli_query($con, "SELECT COUNT(*) as num FROM listcontains where lid = $list_id");
$row = mysqli_fetch_assoc($result);
$num_of_song = $row['num']+1;
#echo $track_id;
mysqli_query($con, "INSERT INTO `listcontains` (lid, tid, listnumber) VALUES ($list_id,'$track_id',$num_of_song);");
?>
<br></br>
    <a href="../Browser/search.php" >back to search..</a>