<?php
$con = @mysqli_connect('127.0.0.1', 'root','','finalproject2')
    or die('Could not connect: ' . mysql_error());
session_start();
$username = $_SESSION['username'];
$track_id = "";
$track_title = "";
$track_artist = "";
$track_duration = "";
#$result = mysqli_query($con, "INSERT INTO `Playrecord` (username, tid, playtime, alid, lid) VALUE ('$username','$track_id',NOW(),NULL,NULL);");
?>
<br></br>
List title:
<form action="create_list_success.php" method = "POST">
        <input type="text" name="list_title" placeholder="List title"><br>
    is it a public list?<br>
        <input type = 'radio' name = 'yes' value = 1>yes<br>
        <input type = 'radio' name = 'yes' value = 0>no<br>
        <input type="submit" name="confirm_create" value = "create"><br>
</form>