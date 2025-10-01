<?php
include  "../_include/config.php";
include  "../_include/func.php";
include  "../_include/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $arystat = array( "Score",
        "2pt Attempts", "2pt Conversions", "3rd Down Attempts", "3rd Down Conversions", "4th Down Attempts", "4th Down Conversions", "First Downs",
        "Pass Attempts", "Pass Completions", "Pass Yards", "Pass TDs", "Rush Attempts", "Rush Yards", "Rush TDs", "Time of Possession"
    );
    // "1st", "2nd", "3rd", "4th", "OT", "Final Score"

    $arymystats = array(
        $_POST["myscore"], $_POST["my2a"], $_POST["my2c"], $_POST["my3a"], $_POST["my3c"], $_POST["my4a"], $_POST["my4c"], $_POST["myfd"]
        , $_POST["mypa"], $_POST["mypc"], $_POST["mypy"], $_POST["mypt"], $_POST["myra"], $_POST["myry"], $_POST["myrt"], $_POST["mytop"]
    );
    
    $aryoppstats = array(
        $_POST["oppscore"], $_POST["opp2a"], $_POST["opp2c"], $_POST["opp3a"], $_POST["opp3c"], $_POST["opp4a"], $_POST["opp4c"], $_POST["oppfd"]
        , $_POST["opppa"], $_POST["opppc"], $_POST["opppy"], $_POST["opppt"], $_POST["oppra"], $_POST["oppry"], $_POST["opprt"], $_POST["opptop"]
    );

    $c=0;

    $myid = $_POST["myid"];
    $oppid = $_POST["oppid"];
    $sid = $_POST["sid"];

    foreach ($arystat as $stat) {
        // opp STATS
        $sql = "SELECT * FROM dyngamestats WHERE schid=" . $sid . " AND name='" . $stat . "' AND teamid=" . $oppid;
        $result = query($sql);

        if ($result) {
            foreach($result as $row) {
                $id=$row["id"];
                $sql = "UPDATE dyngamestats SET value='" . $aryoppstats[$c] . "' WHERE id=" . $id;
                //echo $sql . "<br>"; 
                $results=query($sql);
            }
        } else {
            $sql="INSERT INTO dyngamestats (schid,teamid,name,value) VALUES (" . $sid . ", " . $oppid . ", '" . $stat . "', '" . $aryoppstats[$c] . "')";
            $results=query($sql);
        }

        // my STATS
        $sql = "SELECT * FROM dyngamestats WHERE schid=" . $sid . " AND name='" . $stat . "' AND teamid=" . $myid;
        $result = query($sql);

        if ($result) {
            foreach($result as $row) {
                $id=$row["id"];
                $sql = "UPDATE dyngamestats SET value='" . $arymystats[$c] . "' WHERE id=" . $id;
                //echo $sql . "<br>"; 
                $results=query($sql);
            }
        } else {
            $sql="INSERT INTO dyngamestats (schid,teamid,name,value) VALUES (" . $sid . ", " . $myid . ", '" . $stat . "',' " . $arymystats[$c] . "')";
            echo $sql;
            $results=query($sql);
        }

        $c++;
        
    }
    header('Location: gamestats.php?sid=' . $sid);
}
