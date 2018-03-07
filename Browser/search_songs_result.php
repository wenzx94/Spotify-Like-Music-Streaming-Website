<?php
// Connecting, selecting database
$link = @mysqli_connect('127.0.0.1', 'root','','finalproject2')
    or die('Could not connect: ' . mysql_error());
// echo 'Connected successfully';
session_start();
$username = $_SESSION['username'];
$keyword = $_SESSION['keywords'];
$query = "select * from track where ttitle like '%$keyword%' ORDER BY aname";
$result = mysqli_query($link, $query) or die('Query failed: ' . mysql_error());
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

<form action="../page-of/song.php" method = "POST">
<table>
<tr>
<th>  </th>
<th>Name</th>
<th>Artist</th>
<th>Duration</th>
</tr>

<?php
if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
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
    }
} 
else 
{
    echo "no table found";
}?></table>
    
    <br></br>
    <input type = "submit"  name="song_select_button_2" value = "select">
    <br></br>
    <a href="search.php" >back to search..</a>
</form>


</body>
</html>

<?php
// Free resultset
mysqli_free_result($result);

// Closing connection
mysqli_close($link);
?> 
