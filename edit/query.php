<?php
include "../_include/config.php";
include "../_include/db.php";
include "../_include/func.php";

if (isset($_POST['term'])) {
    //$search_query = $_POST['query'];
    $conn = dbconnect();
    $query = "SELECT * FROM dynroster WHERE lname LIKE '%" . $_POST['term'] . "%' AND teamid=" . $_POST["tid"] . " ORDER BY lname,fname LIMIT 12";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($user = mysqli_fetch_array($result)) {
            $res[] = $user['lname'] . ", " . $user["fname"];
        }
    } else {
        $res = array();
    }
    //return json res
    foreach ($res as $name) {
        echo "<li>" . $name . "</li>";
    }
}
