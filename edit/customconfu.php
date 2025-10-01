<?php
session_start();
include "../_include/config.php";
include "../_include/func.php";

$e = "";

/* SAMPLE DATA
ID  NEWTEAM   CONFID   SEASONID   REPLACEDTEAM
5   50        14       4          352
27  352       4        4          50
*/

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $arra["seasonid"] = $_REQUEST["sea"];
    $arra["replacedconfid"] = $_POST["oldconf"];
    $arra["newconfid"] = $_POST["newconf"];

    $arra["newteamid"] = $_POST["moveteam"];
    $arra["replacedteamid"] = $_POST["replacedteam"];


    $sql = "INSERT INTO dyncustomconf (seasonid, newconfid, newteamid, replacedconfid, replacedteamid) VALUES (:seasonid, :newconfid, :newteamid, :replacedconfid, :replacedteamid)";
    $result = ins_query($sql, $arra);
}

if (isset($_REQUEST["m"]) && $_REQUEST["m"] == "d") {
    $sql = "DELETE FROM dyncustomconf WHERE id=" . $_REQUEST["id"];
    $result=query($sql);
}

header('Location: customconf.php');
