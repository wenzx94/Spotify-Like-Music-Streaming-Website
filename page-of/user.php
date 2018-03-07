<?php
$con = @mysqli_connect('127.0.0.1', 'root','','finalproject2')
    or die('Could not connect: ' . mysql_error());
$artist_id = "";
$artist_name = "";
$artist_descr = "";
session_start();
$username = $_SESSION['username'];

if(isset($_POST['user_select_button_2']))
{
    $user_name2 = $_POST['user_name2'];
    $uname = $_POST['uname'];
}
$result = mysqli_query($con, "select * from list where username = '$user_name2' and ispublic = 1");
?>

<!DOCTYPE html>
<html>

<h2> <?php echo "Lists of $uname"; ?></h2>

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

<form action="../page-of/list.php" method = "POST">
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
            <th><?php echo $row["ltitle"]?></th>
            <th><?php echo $row["lissuedate"]?></th>

        </tr>
        <?php
    }
    
} 
else 
{
    echo "no table found";
}?></table>
    
    <br></br>
    <input type = "submit"  name="list_select_button_2" value = "select">
    <br></br>
    <a href="../Browser/search.php" >back to search..</a>
</form>
<form action="../page-of/follow_success.php" method = "POST">
    <input  name="user_name" type="hidden" value = "<?php echo $username?>">
    <input  name="user_name2" type="hidden" value = "<?php echo $user_name2?>">
    <input type = "submit"  name="follow_button" value = "follow this user">
</form>

</body>
</html>


<?php
mysqli_close($con);
?>