<?php
$con = @mysqli_connect('127.0.0.1', 'root','','finalproject2')
    or die('Could not connect: ' . mysql_error());
session_start();
$username = $_SESSION['username'];

if(isset($_POST['confirm_create']) and !empty($_POST['list_title']))
{
    $list_title = $_POST['list_title'];
    $yes = $_POST['yes'];
    echo "List created successfully!";
    $result = mysqli_query($con, "INSERT INTO `list` (username, ltitle, lissuedate, ispublic) VALUES ('$username','$list_title', CURDATE(), $yes);");
}else {
    echo "input the title please";
}

#$result = mysqli_query($con, "INSERT INTO `Playrecord` (username, tid, playtime, alid, lid) VALUE ('$username','$track_id',NOW(),NULL,NULL);");

?>
<br></br>
    <a href="../Browser/search.php" >back to my search result..</a>