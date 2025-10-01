<?php
$hero_title = "Dynasty Home";
$hero_text = "View your dynasty information here";

include '../_include/header.php';

$aryb[0][0] = "/mydynasties.php";
$aryb[0][1] = "My Dynasties";
$aryb[1][0] = "/edit/dynasty.php";
$aryb[1][1] = "Dynasty Home";

if ($userid == "") {
    redirect($filepath . "signin.php");
}

if (!isset($_SESSION["dyn"])) {
    $_SESSION["dyn"] = $_REQUEST["id"];
}

if (getDynastyOwner($_SESSION["dyn"]) != $userid) {
    redirect("home.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data["dynastyid"] = $_SESSION["dyn"];
    $data["teamid"] = $_POST["teamid"];
    $data["year"] = $_POST["year"];

    $query = "INSERT INTO dynseasons (dynastyid, teamid, year) VALUES (:dynastyid, :teamid, :year)";
    $id = ins_query($query, $data);
}

$e = "";
if (isset($_REQUEST["e"])) {
    $e = $_REQUEST["e"];
}

// get conference for select list
$queryt = "SELECT * FROM dynconf ";
$queryt .= " ORDER BY name";

$result = query($queryt);

$conflist = "<select class='form-select' name='conf'>";
$conflist .= "<option value='-select team-'></option>";

foreach ($result as $row) {
    $conflist .= "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
}
$conflist .= "</select>";


$list = "<select class='form-select' name='teamid'>";
$list .= "<option value='-select team-'></option>";

// get teams for select list 
$queryt = "SELECT * FROM dynteams WHERE dynastyid in (0, " . $_SESSION["dyn"] . ") ";
$queryt .= " ORDER BY name";

$result = query($queryt);

foreach ($result as $row) {
    $list .= "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
}
$list .= "</select>";

$querys = "SELECT d.name AS dynasty, s.id as sid, s.teamid as teamid, s.year, t.name as team, t.confid as conf, d.activeseason ";
$querys .= "FROM dynseasons s LEFT JOIN dynteams t ON s.teamid=t.id LEFT JOIN dynasty d ON d.id=s.dynastyid WHERE s.dynastyid=" . $_SESSION["dyn"];
//echo $querys;
$result = query($querys);

$seasonslist = "<select name='activeseason'>";
$seasonslist .= "<option value='0'></option>";

$seasons = "<table class='table sm'>";
$seasons .= "<thead>";
$seasons .= "<th>Team</th>";
$seasons .= "<th>Year</th>";
$seasons .= "<th colspan='6'>Edit</th>";
$seasons .= "</thead>";

if ($result) {
    foreach ($result as $row) {
        $confid = getConfid($row["sid"],$row["teamid"] );
        $seasonslist .= "<option value='" . $row["sid"] . "'";
        if ($row["sid"] == $row["activeseason"]) {
            $seasonslist .= " selected";
        }
        $seasonslist  .= ">" . $row["year"] . "</option>";
        $seasons .= "<tr>";
        $seasons .= "<td>" . $row["team"] . "</td>";
        $seasons .= "<td>" . $row["year"] . "</td>";
        $seasons .= "<td><a href='rosters.php?tid=" . $row["teamid"] . "'>Roster</a></td>";
        $seasons .= "<td><a href='schedule.php?tid=" . $row["teamid"] . "'>Schedule</a></td>";
        $seasons .= "<td><a href='standings.php?c=" . $confid . "'>Standings</a></td>";
        $seasons .= "<td><a href='articles.php'>Articles</a></td>";
        $seasons .= "<td><a href='createteam.php'>Created Teams</a></td>";
        $seasons .= "<td><a href='customconf.php'>Custom Conferences</a></td>";
        $seasons .= "</tr>";
    }
} else {
    $e .= "No seasons found";
}

$seasons .= "</table>";
$seasonslist .= "</select>";
?>
<section class="pagetitle">
    <div class="row mb-1">
        <div class="col-12">
            <h5><?= $dynastyname ?> - Seasons</h5>
            <p class="text-danger"><?php echo $e; ?></p>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12">
            <?php echo $seasons; ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <form class="form row" action="activeseason.php" method="post">
                <div class="input-group input-group-sm mb-3 w-75">
                    <span class="input-group-text w-25" id="inputGroup-sizing-sm">Active Season</span>
                    <?= $seasonslist ?>
                    <button id="create" class="btn btn-primary w-10">Set</button>
                </div>
            </form>
        </div>
        <?php
        if ($_SESSION["prem"] == 1) { ?>
            <div class="row mb-1">
                <div class="col-12">
                    <h5>Add Season</h5>
                </div>
                    <div class="col-12">
                        <form class="form " action="dynasty.php" method="post">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text w-25" id="inputGroup-sizing-sm">Season Year</span>
                                <input type="text" id="year" name="year" class="form-control" placeholder="year" aria-label="year" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text w-25" id="inputGroup-sizing-sm">Team</span>
                                <?= $list ?>
                            </div>
                            <div class="input-group input-group-sm mt-2">
                                <button id="create" class="btn btn-primary">Add Season</button>
                            </div>
                        </form>
                </div>
            </div>
        <?php } ?>
</section>
<?php include '../_include/footer.php' ?>