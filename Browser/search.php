<?php
// Connecting, selecting database
$link = @mysqli_connect('127.0.0.1', 'root','','finalproject2')
    or die('Could not connect: ' . mysql_error());
// echo 'Connected successfully';
session_start();
$username = $_SESSION['username'];
if(isset($_POST['search_button']))
{
    $keywords = $_POST['keywords']; 
    $_SESSION['keywords'] = $keywords; 
}
$keywords = $_SESSION['keywords'];
// Performing SQL query
$song_query = "select * from track where ttitle like '%$keywords%'";
$song_result = mysqli_query($link, $song_query) or die('Song Query failed: ' . mysql_error());
$artist_query = "select * from artist where aname like '%$keywords%' or adescr like '%$keywords%'";
$artist_result = mysqli_query($link, $artist_query) or die('Artist Query failed: ' . mysql_error());
$album_query = "select * from album where atitle like '%$keywords%'";
$album_result = mysqli_query($link, $album_query) or die('Album Query failed: ' . mysql_error());
$user_query = "select * from user where username like '%$keywords%' or uname like '%$keywords%'";
$user_result = mysqli_query($link, $user_query) or die('Album Query failed: ' . mysql_error());
$list_query = "select * from list natural join user where ltitle like '%$keywords%' and ispublic = 1";
$list_result = mysqli_query($link, $list_query) or die('Album Query failed: ' . mysql_error());
?> 

<!DOCTYPE html>
<html>

<h2> Song:</h2>

<style>
	form {
  /* Just to center the form on the page */
  margin: 0 auto;
  width: 800px;
  /* To see the outline of the form */
  padding: 1em;
  border: 1px solid #CCC;
  border-radius: 1em;
}

form div + div {
  margin-top: 1em;
}

label {
  /* To make sure that all labels have the same size and are properly aligned */
  display: inline-block;
  width: 110px;
  text-align: right;
}

input, textarea {
  /* To make sure that all text fields have the same font settings
     By default, textareas have a monospace font */
  font: 1em sans-serif;

  /* To give the same size to all text fields */
  width: 150px;
  box-sizing: border-box;

  /* To harmonize the look & feel of text field border */
  border: 1px solid #999;
}

input:focus, textarea:focus {
  /* To give a little highlight on active elements */
  border-color: #000;
}

textarea {
  /* To properly align multiline text fields with their labels */
  vertical-align: top;

  /* To give enough room to type some text */
  height: 5em;
}

.button {
  /* To position the buttons to the same position of the text fields */
  padding-left: 90px; /* same size as the label elements */
}

button {
  /* This extra margin represent roughly the same space as the space
     between the labels and their text fields */
  margin-left: .5em;
}
	

	
</style>
    

<body>

<!------------------------------------------------ show songs result ----------------------------------------------------->

<form name = "song_form" action="../page-of/song.php" method = "POST">


<?php
if(mysqli_num_rows($song_result) > 0)
{
    ?>
    <table>
    <tr>
    <th>  </th>
    <th>Name</th>
    <th>Artist</th>
    <th>Duration</th>
    </tr>
<?php
    $i = 0;
    $_SESSION['song_result'] = $song_result;
    while($row = mysqli_fetch_assoc($song_result) and $i<10 )
    {
?>
     	<tr>
        <th><input type = 'radio' name = 'track_id' value = "<?php echo $row["tid"]?>"></th>
          	<input  name="user_name" type="hidden" value = "<?php echo $username?>">
            <th><?php echo $row["ttitle"]?></th>
            <th><?php echo $row["aname"]?></th>
            <th><?php echo $row["duration"]?></th>

        </tr>
        <?php
        $i++;
    }?></table>
    <a href="search_songs_result.php" style="float: right;">See all..</a>
    <br></br>
    <!--<input type = "submit"  name="song_select_button_1" value = "select">-->

    
<?php
} 
else 
{
    echo "no table found";
?></table><?php
}?>
    <br></br>
    <a href="../login/dashboard.php" >back to search..</a>
</form>




<?php
// Free resultset
mysqli_free_result($song_result);

// Closing connection
//mysqli_close($link);
?>

<!--------------------------------------show artist result----------------------------------------------->
<h2> Artist:</h2>
<form name = "artist_form" action="../page-of/artist.php" method = "POST">


<?php
if(mysqli_num_rows($artist_result) > 0)
{
    ?>
    <table>
    <tr>
    <th>  </th>
    <th>Name</th>
    <th>Description</th>
    </tr>
<?php
    $i = 0;
    while($row = mysqli_fetch_assoc($artist_result) and $i<10 )
    {
?>
     	<tr>
        <th><input type = 'radio' name = 'artist_id' value = "<?php echo $row["aid"]?>"></th>
          	<input  name="user_name" type="hidden" value = "<?php echo $username?>">
            <input  name="artist_name" type="hidden" value = "<?php echo $row["aname"]?>">
            <th><?php echo $row["aname"]?></th>
            <th><?php echo $row["adescr"]?></th>

        </tr>
        <?php
        $i++;
    }?></table>
    <a href="search_artist_result.php" style="float: right;">See all..</a>


    
<?php
} 
else 
{
    echo "no table found";
?></table><?php
}?>
    <br></br>
    <a href="../login/dashboard.php" >back to search..</a>
</form>




<?php
// Free resultset
mysqli_free_result($artist_result);

// Closing connection
//mysqli_close($link);
?>

<!--------------------------------------show album result----------------------------------------------->
<h2> Album:</h2>
<form action="album.php" method = "POST">


<?php
if(mysqli_num_rows($album_result) > 0)
{
    ?>
    <table>
    <tr>
    <th>  </th>
    <th>Title</th>
    <th>Issue Date</th>
    </tr>
<?php
    $i = 0;
    while($row = mysqli_fetch_assoc($album_result) and $i<10 )
    {
?>
     	<tr>
        <th><input type = 'radio' name = 'album_id' value = "<?php echo $row["alid"]?>"></th>
          	<input  name="user_name" type="hidden" value = "<?php echo $username?>">
            <th><?php echo $row["atitle"]?></th>
            <th><?php echo $row["aissuedate"]?></th>

        </tr>
        <?php
        $i++;
    }?></table>
    <a href="search_album_result.php" style="float: right;">See all..</a>
    <!--<br></br>
    <input type = "submit"  name="album_select_button_1" value = "select">-->

    
<?php
} 
else 
{
    echo "no table found";
?></table><?php
}?>
    <br></br>
    <a href="../login/dashboard.php" >back to search..</a>
</form>

<!--------------------------------------show list result----------------------------------------------->
<h2> List:</h2>
<form action="list.php" method = "POST">


<?php
if(mysqli_num_rows($list_result) > 0)
{
    ?>
    <table>
    <tr>
    <th>  </th>
    <th>Title</th>
    <th>User Name</th>
    <th>Create Date</th>
    </tr>
<?php
    $i = 0;
    while($row = mysqli_fetch_assoc($list_result) and $i<10 )
    {
?>
     	<tr>
        <th><input type = 'radio' name = 'list_id' value = "<?php echo $row["lid"]?>"></th>
          	<input  name="user_name" type="hidden" value = "<?php echo $username?>">
            <th><?php echo $row["ltitle"]?></th>
            <th><?php echo $row["uname"]?></th>
            <th><?php echo $row["lissuedate"]?></th>

        </tr>
        <?php
        $i++;
    }?></table>
    <a href="search_list_result.php" style="float: right;">See all..</a>
    <!--<br></br>
    <input type = "submit"  name="album_select_button_1" value = "select">-->

    
<?php
} 
else 
{
    echo "no table found";
?></table><?php
}?>
    <br></br>
    <a href="../login/dashboard.php" >back to search..</a>
</form>
<!--------------------------------------show user result----------------------------------------------->
<h2> User:</h2>
<form action="user.php" method = "POST">


<?php
if(mysqli_num_rows($user_result) > 0)
{
    ?>
    <table>
    <tr>
    <th>  </th>
    <th>User Name</th>
    <th>City</th>
    </tr>
<?php
    $i = 0;
    while($row = mysqli_fetch_assoc($user_result) and $i<10 )
    {
?>
     	<tr>
        <th><input type = 'radio' name = 'user_name2' value = "<?php echo $row["username"]?>"></th>
          	<input  name="user_name" type="hidden" value = "<?php echo $username?>">
            <input  name="uname" type="hidden" value = "<?php echo $row["uname"]?>">
            <th><?php echo $row["uname"]?></th>
            <th><?php echo $row["ucity"]?></th>

        </tr>
        <?php
        $i++;
    }?></table>
    <a href="search_user_result.php" style="float: right;">See all..</a>
    <!--<br></br>
    <input type = "submit"  name="album_select_button_1" value = "select">-->

    
<?php
} 
else 
{
    echo "no table found";
?></table><?php
}?>
    <br></br>
    <a href="../login/dashboard.php" >back to search..</a>
</form>


<?php
// Free resultset
mysqli_free_result($album_result);

// Closing connection
mysqli_close($link);
?>

</body>
</html>