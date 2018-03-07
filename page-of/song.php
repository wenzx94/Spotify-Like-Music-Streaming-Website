<?php
$con = @mysqli_connect('127.0.0.1', 'root','','finalproject2')
    or die('Could not connect: ' . mysql_error());
$track_id = "";
$track_title = "";
$track_artist = "";
$track_duration = "";
if(isset($_POST['song_select_button_1']))
{
    $track_id = $_POST['track_id']; 
}
if(isset($_POST['song_select_button_2']))
{
    $track_id = $_POST['track_id']; 
}
$result = mysqli_query($con, "select * from track where tid = '$track_id'");
if(mysqli_num_rows($result) > 0)//Return the number of rows in a result set
{
	while($row = mysqli_fetch_assoc($result))//Fetch a result row as an associative array
	{
        $track_title = $row['ttitle'];
        $track_artist = $row['aname'];
        $track_duration = $row['duration'];
    }

}
?>
<h1><?php echo $track_title?></h1>
<p style="font-size:20px"><?php echo "$track_artist   "?></p>
    
    <form action="play.php" method = "POST">
        <input  name="track_id" type="hidden" value = "<?php echo $track_id?>">
        <input  name="track_title" type="hidden" value = "<?php echo $track_title?>">
        <input type = "submit"  name="play_button" value = "play">
    </form>
    <form action="rate.php" method = "POST">
        <input  name="track_id" type="hidden" value = "<?php echo $track_id?>">
        <input  name="track_title" type="hidden" value = "<?php echo $track_title?>">
        <input type = "submit"  name="rate_button" value = "rate this song">
    </form>
    <form action="mylist.php" method = "POST">
        <input  name="track_id" type="hidden" value = "<?php echo $track_id?>">
        <input  name="track_title" type="hidden" value = "<?php echo $track_title?>">
        <input type = "submit"  name="list_button" value = "add to list">
    </form>
<a href="../Browser/search.php" >back to search..</a>
<?php
mysqli_close($con);
?>