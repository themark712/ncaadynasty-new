<?php
session_start();
include "../_include/config.php";
include "../_include/func.php";

$e = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "UPDATE dynstandings SET ";
    $sql .= " win=" . $_POST["win"] . ", ";
    $sql .= " confwin=" . $_POST["confwin"] . ", ";
    $sql .= " loss=" . $_POST["loss"] . ", ";
    $sql .= " confloss=" . $_POST["confloss"] . " ";
    $sql .= "WHERE id=" . $_POST["id"]; 
echo $sql;
    $result = query($sql);
    header('Location: standings.php?sea=' . $_POST["sea"] . "&c=" . $_POST["c"]. "&w=" . $_POST["w"]);
}
