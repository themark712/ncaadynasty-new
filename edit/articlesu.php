<?php
session_start();
include "../_include/config.php";
include "../_include/func.php";

$e = "";
echo $_SESSION["seas"];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $currentSeason = getCurrentSeasonId($_SESSION["dyn"]);
    $arra["seasonid"] = $currentSeason;
    $arra["week"] = $_POST["week"];
    $arra["title"] = $_POST["title"];
    $arra["content"] = $_POST["content"];
    $arra["created"] = date('Y-m-d H:i:s');
    $sql = "INSERT INTO dynarticles (seasonid, week, title, content, created) VALUES (:seasonid, :week, :title, :content, :created)";
    $result = ins_query($sql, $arra);
}

if ($_REQUEST["m"] == "d") {
    $sql = "DELETE FROM dynarticles WHERE id=" . $_REQUEST["a"];
    $result=query($sql);
}

header('Location: articles.php');
