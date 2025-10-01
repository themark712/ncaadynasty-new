<?php
$hero_title = "Dynasty - Schedule";
$hero_text = "Complete slate of games by week";

include '../_include/header.php';
$aryb[0][0] = "/mydynasties.php";
$aryb[0][1] = "My Dynasties";
$aryb[1][0] = "/edit/dynasty.php?id=" . $_SESSION["dyn"];
$aryb[1][1] = "Dynasty Home";
$aryb[2][0] = "/edit/schedule.php";
$aryb[2][1] = "Schedule";

if ($userid == "") {
    redirect("signin");
}

if (getDynastyOwner($_SESSION["dyn"]) != $_SESSION["userid"]) {
    redirect("home");
}

$e = "";

$m = "";
if (isset($_REQUEST["m"])) {
    $m = $_REQUEST["m"];
}

$table = "";
$conflist = "";

/* if ($m != "") {

    if ($m == "a") {
        // add game
        $data["week"] = $_POST["week"];
        $data["gamedate"] = $_POST["date"];
        $data["location"] = $_POST["location"];
        $data["homeid"] = $_POST["home"];
        $data["awayid"] = $_POST["away"];

        $query = "INSERT INTO dynsch (week, gamedate, location, homeid, awayid) VALUES (:week, :gamedate, :location, :homeid, :awayid)";
        $id = ins_query($query, $data);
    }
    if ($m == "u") {
        // update game
        $id = $_POST["sid"];
        $aryu["date"] = $_POST["date"];
        $aryu["hscore"] = $_POST["hscore"];
        $aryu["ascore"] = $_POST["ascore"];
        $query = "UPDATE dynsch SET gamedate='" . $_POST["date"] . ", hscore=" . $_POST["hscore"] . ", ascore=" . $_POST["ascore"] . " WHERE id=" . $id;
        $result = query($query);
    }

    if ($m == "d") {
        // delete game
        //$sch->delete($sea);
    }
} */

// get team info
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

// get teams for select list
$queryt = "SELECT * FROM dynteams ";
$queryt .= " ORDER BY Name";

$result = query($queryt);

$list = "<option value='-select team-'></option>";

foreach ($result as $row) {
    $list .= "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
}

// get week's games
$querys = "SELECT s.id as sid, s.week as week, s.ishome, s.gamedate as date,  ";
$querys .= " s.location as location, op.name as opp,s.oppid ";
$querys .= " FROM dynsch s LEFT JOIN dynteams op ON s.oppid = op.id ";
$querys .= " WHERE s.seasonid=" . $currentSeason;
$querys .= " ORDER BY week, s.gamedate";
//echo $querys;
$result = query($querys);

$table = "";

if ($result) {
    foreach ($result as $row) {
        $hclass = "sch-text";
        $aclass = "sch-text";
        //echo $row["oppid"];
        //$awaylist = str_replace("value='" . $row["awayid"] . "'", "value='" . $row["awayid"] . "' selected", $list);
        //$list = str_replace("value='" . $row["oppid"] . "'", "value='" . $row["oppid"] . "' selected", $list);
        $table .= "<form name='update' class='row row-cols-md-auto small border-start border-bottom ps-1 mb-2' action='scheduleu.php?m=u' method='post'>";
        //$table .= "<div class='border-start border-bottom'>";
        $table .= "<input type='hidden' name='sea' value='" . $currentSeason . "' />";
        $table .= "<input type='hidden' name='tid' value='" . $userTeamId . "' />";
        $table .= "<input type='hidden' name='sid' value='" . $row["sid"] . "' />";
        $table .= "<input type='hidden' name='week' value='" . $row["week"] . "' />";
        
        $table .= "<div class='col-sm-2 col-md-1 col-lg-1 p-0 '><span class='me-1'>" . $row["week"] . "</span></div>";
        
        $table .= "<div class='col-sm-10 col-md-3 col-lg-2 p-0'><input type='text' name='date' value='" . $row["date"] . "'/></div>";

        $table .= "<div class='col-sm-2 col-md-1 col-lg-1 w-5 form-check'>";
        $table .= "<input class='form-check-input' type='checkbox' name='home' value='home'";
        if ($row["ishome"]) {
            $table .= " checked";
        }
        $table .= " id='flexCheckDefault'>";
        $table .= "<label class='form-check-label' for='flexCheckDefault'>H</label>";
        $table .= "</div>";
        
        $table .= "<div class='col-sm-5 col-md-3 col-lg-2 p-0 me-1'><select class='form-select small' name='opp'>" . str_replace("value='" . $row["oppid"] . "'", "value='" . $row["oppid"] . "' selected", $list) . "</select></div>";
        
        $table .= "<div class='col-sm-5 col-md-3 col-lg-2 p-0'><input type='text' class='list' name='location' value='" . $row["location"] . "' /></div>";
        
        $table .= "<div class='col-sm-6 col-md-4 col-lg-1 p-0'><a href='gamestats.php?sid=" . $row["sid"] . "' class=' me-1'>Game Stats</a> | ";
        $table .= "<a href='playerstats.php?sid=" . $row["sid"] . "' class='float-left'>Player Stats</a>";
        $table .= "</div>";
        
        $table .= "<div class='col-sm-6 col-md-4 col-lg-1 p-0'><button type='submit' class='btn btn-primary btn-small float-right me-2'>U</button>";
        $table .= "<a href='scheduleu.php?sea=" . $currentSeason . "&tid=" . $userTeamId . "&m=d&sid=" . $row["sid"] . "' class='btn btn-danger btn-small float-left'>D</a>";
        $table .= "</div>";
        
        //$table .= "</div>";
        $table .= "</form>";
    }
}
?>
<section class="pagetitle">
    <div class="row mt-0 ms-1">
        <div class="col-sm-12 mb-4 ">
            <?php echo $table; ?>
        </div>
    </div>
    <form name="newgame" action="scheduleu.php?tid=<?= $userTeamId ?>&m=a" method="post">
        <div class="row">
            <div class="col-6">
                Add Game
            </div>
        </div>
        <div class="row row-cols-sm-auto g-3 align-items-center mt-1">
            <div class="col-2 w-15">
                <div class="input-group">
                    <select class="form-select" name="week">
                        <option value='0'>- week -</option>
                        <?php
                        for ($i = 0; $i <= 15; $i++) {
                        ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-2 w-25">
                <div class="input-group"><input class="form-control" type="text" name="date" placeholder="date" /></div>
            </div>
            <div class="col-2 w-25">
                <div class="input-group"><input class="form-control" type="text" name="location" placeholder="location" /></div>
            </div>
        </div>
        <div class="row row-cols-sm-auto g-3 align-items-center mt-1">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="home" value="home" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Home
                </label>
            </div>
            <div class="col-2 w-20">
                <div class="input-group"><select class="form-select" name="opp"><?= $list ?></select></div>
            </div>
            <div class="col-12 w-15">
                <div class="input-group"><input type="submit" value="Add" class="btn btn-primary"></div>
            </div>
        </div>

        <div class="row row-cols-md-auto g-3 align-items-center mt-2">
        </div>
    </form>
</section>
<?php include "../_include/footer.php"; ?>