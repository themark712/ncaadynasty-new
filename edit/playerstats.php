<?php
$hero_title = "Player Stats";
$hero_text = "Update your games's player stats here";

include '../_include/header.php';

$aryb[0][0] = "/mydynasties.php";
$aryb[0][1] = "My Dynasties";
$aryb[1][0] = "/edit/dynasty.php?id=" . $_SESSION["dyn"];
$aryb[1][1] = "Dynasty Home";
$aryb[2][0] = "/edit/schedule.php"; //schedule.php?sea=15&tid=996957
$aryb[2][1] = "Schedule";
$aryb[3][0] = "/edit/playerstats.php?sid=" . $_REQUEST["sid"] . "&tid=" . $userTeamId;;
$aryb[3][1] = "Player Stats";

if ($userid == "") {
    redirect($filepath . "signin.php");
}

if (getDynastyOwner($_SESSION["dyn"]) != $_SESSION["userid"]) {
    redirect("home");
}

$e = "";
if (isset($_REQUEST["e"])) {
    $e = $_REQUEST["e"];
}

$m = "";
if (isset($_REQUEST["m"])) {
    $m = $_REQUEST["m"];
}

// return stats model and list based on category sent in url
$statlist = "";
$statsmodel = "";
$cid = "";

if (isset($_REQUEST["cid"])) {
    $cid = $_REQUEST["cid"];
    $statlist = strtoupper($cid) . "STATS";
}
if ($cid == "Passing") {
    $statlist = PASSINGSTATS;
}

if ($cid == "Rushing") {
    $statlist = RUSHINGSTATS;
}

if ($cid == "Receiving") {
    $statlist = RECEIVINGSTATS;
}

if ($cid == "Defense") {
    $statlist = DEFENSESTATS;
}

if ($cid == "Blocking") {
    $statlist = BLOCKINGSTATS;
}

// initialize variables
$homeid = 0;
$awayid = 0;
$home = "";
$away = "";
$homelogo = "";
$awaylogo = "";

// get my team
$queryt = "SELECT id, name, logo FROM dynteams WHERE id=" . $userTeamId;
$resultt = query($queryt);
if ($resultt) {
    foreach ($resultt as $row) {
        $homeid = $row["id"];
        $home = $row["name"];
        $homelogo = $row["logo"];
    }
}
// get oppenent team
$queryt = "SELECT id, name, logo FROM dynteams WHERE id IN (SELECT oppid FROM dynsch WHERE id=" . $_REQUEST["sid"] . ")";
$resultt = query($queryt);
if ($resultt) {
    foreach ($resultt as $row) {
        $awayid = $row["id"];
        $away = $row["name"];
        $awaylogo = $row["logo"];
    }
}

$tid = 0;

if (isset($_REQUEST["tid"])) {
    $tid = $_REQUEST["tid"];
}

$logo = "";

if ($tid == $homeid) {
    $logo = $homelogo;
}

if ($tid == $awayid) {
    $logo = $awaylogo;
}

if ($cid != "") {
    // get stats by category passed in url
    $query = "SELECT s.*, s.id as stid, r.id as pid, r.fname as fname, r.lname as lname ";
    $query .= "FROM dynpstats" . strtolower($_REQUEST["cid"]) . "  s ";
    $query .= "  LEFT JOIN dynroster r ON s.playerid=r.id ";
    $query .= "WHERE s.schid=" . $_REQUEST["sid"] . " ";
    $query .= " AND s.playerid IN (SELECT id FROM dynroster WHERE teamid=" . $tid . ") ";
    $query .= "ORDER BY s.playerid";
    //echo $query;

    $result = query($query);  //$statsmodel->findAll($query);
    $list = "<div class='row mb-3  small'>";
    $list .= "<div class='row mb-1 small'>";
    $list .= "<div class='col-2 w-20'>&nbsp;</div>";

    foreach ($statlist as $p => $q) {
        $list .= "<div class='col-2 w-5'>" . $q . "</div>";
    }

    $list .= "</div>";

    //print_r($statlist);
    if ($result) {
        foreach ($result as $row) {
            $list .= "<form name='update' class='row w-100 row-cols-sm-auto small-st' action='_include/" . strtolower($_REQUEST["cid"]) . "statsu.php?m=u' method='post'>";
            $list .= "<input type='hidden' name='stid' value='" . $row["stid"] . "'>";
            $list .= "<input type='hidden' name='pid' value='" . $row["pid"] . "'>";
            $list .= "<input type='hidden' name='sid' value='" . $_REQUEST["sid"] . "'>";
            $list .= "<input type='hidden' name='cid' value='" . $_REQUEST["cid"] . "'>";
            $list .= "<input type='hidden' name='tid' value='" . $_REQUEST["tid"] . "'>";
            //$list .= "<div class='col-3 w-30'>&nbsp;</div>";
            $list .= "<div class='col-2 w-20'>" . $row["lname"] . ", " . $row["fname"] . "</div>";
            foreach ($statlist as $p => $q) {
                $list .= "<div class='col-2 w-5'><input type='text' class='list ms-2' style='width:30px' name='" . strtolower($q) . "' value='" . $row[strtolower($q)]  . "' /></div>";
            }
            $list .= "<div class='ms-2 col-2 w-20'>";
            $list .= "<button type='submit' class='btn btn-primary btn-small float-right me-2'><i class='bi bi-pen'></i></button>";
            $list .= "<a href='_include/" . strtolower($_REQUEST["cid"]) . "statsu.php?sid=" . $_REQUEST["sid"] . "&cid=" . $_REQUEST["cid"] . "&tid=" . $_REQUEST["tid"] . "&stid=" . $row["stid"] . "&m=d' class='btn btn-danger btn-small float-left'><i class='bi bi-trash'></i></a>";
            $list .= "</div>";
            $list .= "</form>";
            //sid=2&cid=Passing&tid=352
        }
    }
    $list .= "</div>";
}
?>
<section class="pagetitle">
    <div class="row mb-2">
        <div class="col-7 my-auto">
            <h5><?= $away ?> @ <?= $home ?></h5>
        </div>
    </div>
    <div class="row mb-4 d-flex">
        <div class="col-12 my-auto">
            <form name="fredirect" action="playerstats.php" method="post" class="row d-flex">
                <select id="team" name="team" onchange="redirect();" class="form-select w-30 me-2">
                    <option value="">-- select team--</option>
                    <option value="<?= $homeid ?>"<?php if($tid==$homeid) { ?> selected<?php } ?>><?= $home ?></option>
                    <option value="<?= $awayid ?>"<?php if($tid==$awayid) { ?> selected<?php } ?>><?= $away ?></option>
                </select>
                <select id="cid" name="cid" onchange="redirect();" class="form-select w-30 ms-2">
                    <option value="">-- select stat--</option>
                    <option value="Passing"<?php if($cid=="Passing") { ?> selected<?php } ?>>Passing</option>
                    <option value="Rushing"<?php if($cid=="Rushing") { ?> selected<?php } ?>>Rushing</option>
                    <option value="Passing"<?php if($cid=="Receiving") { ?> selected<?php } ?>>Receiving</option>
                    <option value="Defense"<?php if($cid=="Defense") { ?> selected<?php } ?>>Defense</option>
                </select>
            </form>
        </div>
    </div>
    <!--<div class="row small mb-3">
        <div class="col-3"><a href="playerstats.php?sid=<?= $_REQUEST["sid"] ?>&cid=Passing&tid=<?= $awayid ?>" <?php if ($cid == "Passing" && $tid == $awayid) { ?> class="stat-link-active" <?php } ?>><?= $away ?> Passing</a></div>
        <div class="col-3"><a href="playerstats.php?sid=<?= $_REQUEST["sid"] ?>&cid=Passing&tid=<?= $homeid ?>" <?php if ($cid == "Passing" && $tid == $homeid) { ?> class="stat-link-active" <?php } ?>><?= $home ?> Passing</a></div>
    </div>-->
    <?php if ($cid == "Passing") {
        include "_include/passtable.php";
    } ?>
    <!--<div class="row small mb-3">
        <div class="col-3"><a href="playerstats.php?sid=<?= $_REQUEST["sid"] ?>&cid=Rushing&tid=<?= $awayid ?>" <?php if ($cid == "Rushing" && $tid == $awayid) { ?> class="stat-link-active" <?php } ?>><?= $away ?> Rushing</a></div>
        <div class="col-3"><a href="playerstats.php?sid=<?= $_REQUEST["sid"] ?>&cid=Rushing&tid=<?= $homeid ?>" <?php if ($cid == "Rushing" && $tid == $homeid) { ?> class="stat-link-active" <?php } ?>><?= $home ?> Rushing</a></div>
    </div>-->
    <?php if ($cid == "Rushing") {
        include "_include/rushtable.php";
    } ?>
    <!--<div class="row small mb-3">
        <div class="col-3"><a href="playerstats.php?sid=<?= $_REQUEST["sid"] ?>&cid=Receiving&tid=<?= $awayid ?>" <?php if ($cid == "Receiving" && $tid == $awayid) { ?> class="stat-link-active" <?php } ?>><?= $away ?> Receiving</a></div>
        <div class="col-3"><a href="playerstats.php?sid=<?= $_REQUEST["sid"] ?>&cid=Receiving&tid=<?= $homeid ?>" <?php if ($cid == "Receiving" && $tid == $homeid) { ?> class="stat-link-active" <?php } ?>><?= $home ?> Receiving</a></div>
    </div>-->
    <?php if ($cid == "Receiving") {
        include "_include/receivingtable.php";
    } ?>
    <!--<div class="row small mb-3 ">
        <div class="col-3"><a href="playerstats.php?sid=<?= $_REQUEST["sid"] ?>&cid=Defense&tid=<?= $awayid ?>" <?php if ($cid == "Defense" && $tid == $awayid) { ?> class="stat-link-active" <?php } ?>><?= $away ?> Defense</a></div>
        <div class="col-3"><a href="playerstats.php?sid=<?= $_REQUEST["sid"] ?>&cid=Defense&tid=<?= $homeid ?>" <?php if ($cid == "Defense" && $tid == $homeid) { ?> class="stat-link-active" <?php } ?>><?= $home ?> Defense</a></div>
    <!--</div>-->
    <?php if ($cid == "Defense") {
        include "_include/defensetable.php";
    } ?>
    <!--<div class="row small mb-3">
        <div class="col-3"><a href="playerstats.php?sid=<?= $_REQUEST["sid"] ?>&cid=Blocking&tid=<?= $awayid ?>" <?php if ($cid == "Blocking" && $tid == $awayid) { ?> class="stat-link-active" <?php } ?>><?= $away ?> Blocking</a></div>
        <div class="col-3"><a href="playerstats.php?sid=<?= $_REQUEST["sid"] ?>&cid=Blocking&tid=<?= $homeid ?>" <?php if ($cid == "Blocking" && $tid == $homeid) { ?> class="stat-link-active" <?php } ?>><?= $home ?> Blocking</a></div>
    </div>-->
    <?php if ($cid == "Blocking") {
        include "_include/blocktable.php";
    } ?>
</section>
<?php include '../_include/footer.php' ?>

<script type="text/javascript">
    $(document).ready(function() {
        $("#player").on("keyup", function() {
            var search = $(this).val();
            var tid = "<?= $_REQUEST["tid"] ?>";
            if (search !== "") {
                $.ajax({
                    url: " query.php",
                    type: "POST",
                    cache: false,
                    data: {
                        term: search,
                        tid: tid
                    },
                    success: function(data) {
                        $("#search-result").html(data);
                        $("#search-result").fadeIn();
                    }
                });
            } else {
                $("#search-result").html("");
                $("#search-result").fadeOut();
            }
        });

        // click one particular search name it's fill in textbox
        $(document).on("click", "li", function() {
            $('#player').val($(this).text());
            $('#search-result').fadeOut("fast");
        });
    });
</script>
<script>
    function redirect() {
        let _team = document.getElementById("team");
        let _cid = document.getElementById("cid");
        let tid = _team.value;
        let cid = _cid.value;
        
        if (tid != "" && cid != "") {
            window.location = "playerstats.php?sid=<?= $_REQUEST["sid"] ?>&cid=" + cid + "&tid=" + tid;
        }
    }
</script>