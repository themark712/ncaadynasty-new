<?php
session_start();
include "../_include/config.php";
include "../_include/func.php";

$e = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // check image

    $sql = "UPDATE dynasty SET activeseason=" . $_POST["activeseason"] . " WHERE id=" . $_SESSION["dyn"];
    $result = query($sql);

        header('Location: dynasty.php');
}
