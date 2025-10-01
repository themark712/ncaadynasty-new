<?php
session_start();
include  "../../_include/config.php";
include  "../../_include/func.php";
include  "../../_include/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $statlist = DEFENSESTATS;

    if ($_REQUEST["m"] == "a") {
        $playername = explode(', ', $_POST["player"]);
        $lname = trim($playername[0]);
        $fname = trim($playername[1]);

        // check if player exists in roster
        $pid = 0;
        $sql = "SELECT * FROM dynroster WHERE seasonid=" . $_POST["sea"] . " AND teamid=" . $_POST["tid"] . " AND fname='" . $fname . "' AND lname='" . $lname . "'";
        $result = query($sql);
        //echo $sql;

        if ($result) {
            foreach ($result as $row) {
                echo $row["fname"] . " " . $row["lname"];
                $pid = $row["id"];
            }
        } else {
            $sql = "INSERT INTO dynroster (seasonid, teamid, fname, lname) VALUES (:seasonid, :teamid, :fname, :lname)";
            $arya["seasonid"] = $_POST["sea"];
            $arya["teamid"] = $_POST["tid"];
            $arya["fname"] = $fname;
            $arya["lname"] = $lname;
            $pid = ins_query($sql, $arya);
        }

        if ($pid != 0) {
            $sql = "INSERT INTO dynpstatsdefense (schid, playerid, tackles, tfl, sacks, forcedfumbles, fumblerecoveries, tds) VALUES (:schid, :playerid, :tackles, :tfl, :sacks, :forcedfumbles, :fumblerecoveries, :tds)";
            $arys["schid"] = $_POST["sid"];
            $arys["playerid"] = $pid;
            
            foreach ($statlist as $p => $q) {
                $arys[$q] = $_POST[$q];
            }

            $pid = ins_query($sql, $arys);
        }
        //echo ('Location: playerstats.php?sid=' . $_POST["sid"] . "&cid=" . $_POST["cid"] . "&tid=" . $_REQUEST["tid"]);
        header('Location: ../playerstats.php?sid=' . $_POST["sid"] . "&cid=" . $_POST["cid"] . "&tid=" . $_REQUEST["tid"]);
    }

    if ($_REQUEST["m"] == "u") {
        $sql = "UPDATE dynpstatsdefense SET ";

        foreach ($statlist as $p => $q) {
            $sql .= "`" . $q . "`" . "=" . $_POST[$q] . ",";
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql .= " WHERE id=" . $_POST["stid"];
        //echo $sql;
        $result = query($sql);
        header('Location: ../playerstats.php?sid=' . $_POST["sid"] . "&cid=" . $_POST["cid"] . "&tid=" . $_REQUEST["tid"]);
    }
} else {
    if ($_REQUEST["m"] == "d") {
        $sql = "DELETE FROM dynpstatsdefense WHERE id=" . $_REQUEST["stid"];
        //echo $sql;
        $result = query($sql);
        header('Location: ../playerstats.php?sid=' . $_REQUEST["sid"] . "&cid=" . $_REQUEST["cid"] . "&tid=" . $_REQUEST["tid"]);
    }
}
