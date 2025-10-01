<?php
include "../_include/config.php";

$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
 
$selectvalue = mysqli_real_escape_string($connection, $_GET['svalue']);
 
mysqli_select_db($connection, DBNAME);
$result = mysqli_query($connection, "SELECT id, name FROM dynteams WHERE confid = '$selectvalue'");
 
echo '<option value="">Select team...</option>';
while($row = mysqli_fetch_array($result))
  {
    echo '<option value="'.$row['id'].'">' . $row['name'] . "</option>";
    //echo $row['drink_type'] ."<br/>";
  }
 
mysqli_free_result($result);
mysqli_close($connection);
 
?>