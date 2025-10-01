<?php
$hero_title = "Dynasty Home";
$hero_text = "";

include '_include/header.php';

$_SESSION["dyn"] = $_REQUEST["id"];


$e = "";
if (isset($_REQUEST["e"])) {
    $e = $_REQUEST["e"];
}

// get teams for select list
$queryt = "SELECT * FROM dynteams ";
$queryt .= " ORDER BY name";

$result = query($queryt);

$list = "<select class='form-select' name='teamid'>";
$list .= "<option value='-select team-'></option>";

foreach ($result as $row) {
    $list .= "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
}
$list .= "</select>";

$logo = "";
$bgcolor = "";
$teamid = "";

$querys = "SELECT d.name AS dynasty,s.id as seasonid, s.year, t.id as tid, t.name as team, t.logo, t.color,t.mascot ";
$querys .= "FROM dynseasons s  ";
$querys .= "  LEFT JOIN dynteams t ON s.teamid=t.id  ";
$querys .= "  LEFT JOIN dynasty d ON d.id=s.dynastyid  ";
$querys .= "WHERE s.dynastyid=" . $_SESSION["dyn"];
$querys .= " ORDER BY s.id DESC LIMIT 1";
//echo $querys;
$result = query($querys);

if ($result) {
    foreach ($result as $row) {
        $team = $row["team"];
        $logo = $row["logo"];
        $bgcolor = $row["color"];
        $teamid = $row["tid"];
        $mascot = $row["mascot"];
        $mascot = $row["mascot"];
        $seasonid = $row["seasonid"];
    }
} 

// get latest article
$querya = "SELECT * FROM dynarticles WHERE seasonid IN (SELECT id FROM dynseasons WHERE dynastyid=" . $_SESSION["dyn"] . ") ORDER BY seasonid DESC LIMIT 1";
$result = query($querya);
$latestart = "";

if ($result) {
    foreach ($result as $row) {
        $latestart .= "<h6 class='display-7'>" . $row["title"] . "</h6>";
        $latestart .= "<p class='m-0 p-0'>" . $row["created"] . "</p>";
        $latestart .= "<p>" . $row["content"] . "</p>";
    }
}

// get schedule
$querys = "SELECT s.id, s.ishome, s.oppid, s.gamedate, op.name as opp,op.logo as oplogo ";
$querys .= "FROM dynsch s  ";
$querys .= "  LEFT JOIN dynteams op ON s.oppid=op.id  ";
//$querys .= "  LEFT JOIN dynteams my ON s.awayid=my.id  ";
$querys .= "WHERE (s.seasonid = " . $seasonid . ") ORDER BY gamedate";

$result = query($querys);
$schedule = "";
$displaydate = "";

if ($result) {
    foreach ($result as $row) {
        $phpdate = strtotime( $row["gamedate"] );
        $displaydate = date( 'm/d/Y', $phpdate );
        if ($row["ishome"] == 1) {
            $schedule .= $displaydate . "<img class='img-xs mx-2' src='_assets/img/logos/" . $row["oplogo"] . ".png'>" . $row["opp"] . " (" . ")<br>";
        } else {
            $schedule .= $displaydate  . "<img class='img-xs mx-2' src='_assets/img/logos/" . $row["oplogo"] . ".png'> @ " . $row["opp"] . " (" . ")<br>";
        }
    }
}
?>
<section style="padding-top:8px;margin-bottom:0px;">
    <div class="container-fluid mx-3">

        <div class="row mb-3 me-1">
            <div class="col-1 py-2 text-end" style="background-color:#<?= $bgcolor ?>;">
                <img src="<?= $filepath ?>_assets/img/logos/<?= $logo ?>.png" class="img-md me-1">
            </div>
            <div class="col-7 pt-3 text-start" style="background-color:#<?= $bgcolor ?>; color:white;">
                <h4 class="my-auto py-2" style="font-size:2.0rem;font-family: StanDSteEL;"><?= $team . " " . $mascot ?></h4>
            </div>
            <div class="col-4 pt-3 text-end" style="background-color:#<?= $bgcolor ?>"><?= $dynastyname ?>
            <?php if(playerIsDynastyOwner($_SESSION["dyn"], $userid))    { ?> 
            <a class="btn btn-secondary" href="edit/dynasty.php?id=<?=$_SESSION["dyn"]?>">Edit</a>
            <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 col-sm-12 border-end">
                <div class="row mb-3">
                    <div class="col-12">
                        <h3>Lastest News</h3>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <?php echo $latestart; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12 ps-2 small" style="line-height: 20px;">
                <h3><a class="dynlink" href="schedule.php">Schedule</a></h3>
                <?=$schedule?>
            </div>
        </div>
    </div>
</section>
<?php include '_include/footer.php' ?>