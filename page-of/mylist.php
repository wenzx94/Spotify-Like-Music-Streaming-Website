<?php
$con = @mysqli_connect('127.0.0.1', 'root','','finalproject2')
    or die('Could not connect: ' . mysql_error());
session_start();
$username = $_SESSION['username'];
$track_title = "";
$track_artist = "";
$track_duration = "";
if(isset($_POST['list_button']))
{
    $track_id = $_POST['track_id'];
    $track_title = $_POST['track_title'];
}

#$result = mysqli_query($con, "INSERT INTO `Playrecord` (username, tid, playtime, alid, lid) VALUE ('$username','$track_id',NOW(),NULL,NULL);");
?>


<!DOCTYPE html>
<html>

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
  width: 200px;
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
<br></br>
<?php
$result = mysqli_query($con, "select * from list where username = '$username'");
?>
<h2> My List:</h2>
<form action="add_list_success.php" method = "POST">


<?php
if(mysqli_num_rows($result) > 0)
{
    ?>
    <table>
    <tr>
    <th>  </th>
    <th>Title</th>
        <th>  </th>
    <th>Create Date</th>
    </tr>
<?php
    $i = 0;
    while($row = mysqli_fetch_assoc($result))
    {
?>
     	<tr>
        <th><input type = 'radio' name = 'list_id' value = "<?php echo $row["lid"]?>"></th>
          	<input  name="user_name" type="hidden" value = "<?php echo $username?>">
            <input  name="track_id" type="hidden" value = "<?php echo $track_id?>">
            <input  name="track_title" type="hidden" value = "<?php echo $track_title?>">
            <th><?php echo $row["ltitle"]?></th>
            <th>  </th>
            <th><?php echo $row["lissuedate"]?></th>

        </tr>
        <?php
    }?></table>

    <br></br>
    <input type = "submit"  name="add_to_list_button" value = "select">

    
<?php
} 
else 
{
    echo "no table found";
?></table><?php
}?>
    <br></br>
    <a href="../Browser/search_songs_result.php" >back to search results..</a>   
    <a href="create_new_list.php" style="float: right;">create new list..</a>
</form>



<?php
// Free resultset
mysqli_free_result($result);

// Closing connection
mysqli_close($con);
?>

</body>
</html>