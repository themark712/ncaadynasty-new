<?php
include  "../_include/config.php";
include  "../_include/func.php";
include  "../_include/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $home = 0;
    if (isset($_REQUEST["home"])) {
        if ($_REQUEST["home"] == "home") {
            $home = 1;
        }
    }

    if ($_REQUEST["m"] == "a") {
        $sql = "INSERT INTO dynsch (seasonid, oppid, ishome, location, gamedate, week) VALUES (";
        $sql .= $currentSeason . ", ";
        $sql .= $_POST["opp"] . ", ";
        $sql .= $home . ", ";
        $sql .= "'" . $_POST["location"] . "', ";
        $sql .= "'" . $_POST["date"] . "', ";
        $sql .= $_POST["week"] . " ";
        $sql .= ")";
        echo $sql;
        $result = query($sql);
        header('Location: schedule.php');
    }
    if ($_REQUEST["m"] == "u") {
        $sql = "UPDATE dynsch SET oppid=" . $_POST["opp"] . ", ";
        $sql .= "location='" . $_POST["location"] . "', ";
        $sql .= "gamedate='" . $_POST["date"] . "', ";
        $sql .= "myscore=" . $_POST["myscore"] . ", ";
        $sql .= "oppscore=" . $_POST["oppscore"] . ", ";
        $sql .= "ishome=" . $home . ", ";
        $sql .= "week=" . $_POST["week"];
        $sql .= " WHERE id=" . $_POST["sid"];
        echo $sql;
        $result = query($sql);
        header('Location: schedule.php?sea=' . $_POST["sea"] . "&tid=" . $_POST["tid"]);
    }
} else {
    if ($_REQUEST["m"] == "d") {
        $sql = "DELETE FROM dynsch WHERE id=" . $_REQUEST["sid"];
        //echo $sql;
        $result = query($sql);
        header('Location: schedule.php?sea=' . $currentSeason . "&tid=" . $_REQUEST["tid"]);
    }
}
