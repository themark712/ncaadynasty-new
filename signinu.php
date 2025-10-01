<?php
session_start();
include "_include/db.php";
include "_include/config.php";
include "_include/func.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $query = "SELECT * FROM dynuser WHERE username='" . $_POST["username"] . "' AND password='" . $_POST["password"] . "' ";
    $result = query($query);

    if ($result) {
        foreach($result as $row) {
            $_SESSION["userid"]=$row["id"];
            $_SESSION["username"]=$row["username"];
            $_SESSION["admin"]=$row["isadmin"];    
            $_SESSION["prem"]=$row["ispremium"];    
            $_SESSION["email"]=$row["email"];    
            header('Location: home.php');
        }
    } else {
        $e = "user not found";
    }
}
?>