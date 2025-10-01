<?php
$hero_title = "Roster Audit";
$hero_text = "Update your games's stats here";

include '../_include/header.php';

$aryb[0][0] = "";
$aryb[0][1] = "";

if ($userid == "" || $admin="") {
    $URL = $filepath . "signin.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

if (getDynastyOwner($_SESSION["dyn"]) != $_SESSION["userid"]) {
    $URL = $filepath . "home.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

$e = "";

if (isset($_REQUEST["e"])) {
    $e = $_REQUEST["e"];
}

// get roster info
$roster="";
$sql = "SELECT * FROM dynroster WHERE id NOT IN (SELECT playerid FROM dynpstatspassing) ";
$sql .= " AND id NOT IN (SELECT playerid FROM dynpstatsrushing) ";
$sql .= " AND id NOT IN (SELECT playerid FROM dynpstatsreceiving) ";
$sql .= " AND id NOT IN (SELECT playerid FROM dynpstatsdefense) ";
$sql .= " AND id NOT IN (SELECT playerid FROM dynpstatsturnovers) ";
$sql .= " AND teamid NOT IN (352, 91, 131, 361, 144)";
$result = query($sql);

if ($result) {
    foreach ($result as $row) {
        $roster .= $row["id"] . " - " . $row["fname"] . " " . $row["lname"] . " - " . $row["teamid"] . "<br>";
    }
}
?>
<section class="pagetitle">
    <form name="gamestats" class="mb-3" action="gamestatsu.php" method="post">
        <div class="row">
          <?=$roster?>
        </div>
</form>
</section>
<?php include '../_include/footer.php' ?>