<?php
$hero_title = "Admin - Rosters";
$hero_text = "Edit roster here";
include '../_include/header.php';

if (!isset($_SESSION["userid"]) || $_SESSION["userid"] != "1") {
    header('Location: ' . $filepath . 'signin');
}

if (!isset($_SESSION["admin"]) || $_SESSION["admin"] != "1") {
    header('Location: ' . $filepath . 'signin');
}

$e = "";
$m = "";
if (isset($_REQUEST["m"])) {
    $m = $_REQUEST["m"];
}

$table = "";
$conflist = "";

if ($m != "") {

    if ($m == "a") {
        // add game
        $arya["year"] = $_POST["year"];
        $arya["number"] = $_POST["number"];
        $arya["position"] = $_POST["position"];
        $arya["fname"] = $_POST["fname"];
        $arya["lname"] = $_POST["lname"];
        $arya["ovr"] = $_POST["ovr"];
        //$arya["isredshirt"] = $_POST["isredshirt"];
        $arya["teamid"] = $_REQUEST["tid"];
        //$roster->insert($arya);
        redirect("editroster/" . $_REQUEST["tid"]);
    }
    if ($m == "u") {
        $id = $_REQUEST["pid"];
        $aryu["year"] = $_POST["year"];
        $aryu["number"] = $_POST["number"];
        $aryu["position"] = $_POST["position"];
        $aryu["fname"] = $_POST["fname"];
        $aryu["lname"] = $_POST["lname"];
        //$aryu["isredshirt"] = $_POST["isredshirt"];
        $aryu["ovr"] = $_POST["ovr"];
        $roster->update($id, $aryu);
        redirect("editroster/" . $_REQUEST["tid"]);
    }
}
$teamid = 0;

if (isset($_REQUEST["tid"])) {
    $teamid = $_REQUEST["tid"];
}

// position list
$poslist = "";
$arypos = array("-POS-", "QB", "HB", "WR", "TE", "C", "LG","RG","RT", "LT", "DT", "LE", "RE", "MLB", "LOLB", "ROLB", "DB", "CB", "FS", "SS", "K", "P", "LS");

foreach ($arypos as $o => $p) {
    $poslist .= "<option value='" . $p . "'>" . $p . "</option>";
}

// get roster
if ($teamid != 0 && $teamid != "") {

    $queryr = "SELECT r.id, r.teamid, t.id as tid, t.name as team, t.logo as logo, r.fname, r.lname, r.number, r.position, r.year, r.isredshirt, r.ovr ";
    $queryr .= " FROM dynroster r LEFT JOIN dynteams t ON r.teamid = t.id ";
    $queryr .= " WHERE r.teamid=" . $teamid . " ";
    $queryr .= " ORDER BY r.ovr DESC, r.lname";
    //echo $queryr;
    
    $result = query($queryr);

    $menu = "";

    $table = "<table class='table table-sm'>";

    if ($result) {
        foreach ($result as $row) {

            $table .= "<tr style='line-height:6px;'>";
            $table .= "<form name='update' class='small' action='" . $filepath . "editroster/" . $_REQUEST["tid"] . "/" . $row["id"]. "/u' method='post'>";
            $table .= "<td><img class='img-xs' src='" . $filepath . "_assets/img/logos/" . $row["logo"] . ".png' /></td>";
            //$table .= "<td>" . $row["team . "</td>";
            //$table .= "<td>" . $list . "</td>";
            $table .= "<td><input type='text' class='list' style='width:40px' name='number' value='" . $row["number"] . "' /></td>";
            $table .= "<td class='pt-2 mt-1'>" . $row["id"] . "</td>";
            $table .= "<td><input type='text' class='list' style='width:130px' name='fname' value='" . $row["fname"] . "' /></td>";
            $table .= "<td><input type='text' class='list' style='width:130px' name='lname' value='" . $row["lname"] . "' /></td>";
            $table .= "<td><select name='position'>";

            foreach ($arypos as $o => $p) {
                $table .= "<option value='" . $p . "'";
                if ($p == $row["position"]) {
                    $table .= " selected";
                }
                $table .= ">" . $p . "</option>";
            }
            $table .= "' /></td>";

            $table .= "<td> <select  name='year'>";
            $table .= "                    <option value='0'>- YR -</option>";
            $table .= "                    <option value='SR'";
            if ($row["year"] == "SR") {
                $table .= " selected";
            }
            $table .= ">SR</option>";
            $table .= "                    <option value='JR'";
            if ($row["year"] == "JR") {
                $table .= " selected";
            }
            $table .= ">JR</option>";
            $table .= "                    <option value='SO'";
            if ($row["year"] == "SO") {
                $table .= " selected";
            }
            $table .= ">SO</option>";
            $table .= "                    <option value='FR'";
            if ($row["year"] == "FR") {
                $table .= " selected";
            }
            $table .= ">FR</option>";
            $table .= "                </select>  ";
            //$table .= "<td>RS?<input type='checkbox' class='list' style='width:40px' name='redshirt' value='" . $row["isredshirt . "' /></td>";
            $table .= "<td><input type='hidden' name='rid' value='" . $row["id"] . "' /> ";
            $table .= "<td><input type='text' class='list' style='width:40px' name='ovr' value='" . $row["ovr"] . "' maxlength='2' /></td>";
            $table .= "<td><input type='submit' class='button py-auto' style='width:40px;height:20px;' value='Edit'></td>";
            $table .= "<td class='pt-2 mt-1' style='width:140px;'><a href='" . $filepath . "editplayerinfo/" . $teamid . "/" . $row["id"] . "' class='float-left'>Player Info</a></td>";
            $table .= "</form>";
            $table .= "</tr>\r\n";
        }
    }
}

$table .= "</table>";


// get teams for select list
$queryt = "SELECT * FROM dynteams ";
$queryt .= " ORDER BY Name";

$result = query($queryt);

$list = "<option value='-select team-'></option>";
if (!$result) { echo "nothing";}
foreach ($result as $row) {
    $list .= "<option value='" . $row["id"] . "'";
    if ($teamid == $row["id"]) {
        $list .= " selected";
    }
    $list .= ">" . $row["name"] . "</option>";
}
?>

<section class="pagetitle">
    <div class="container-fluid container-page">
        <div class="row">
            <div class="col-sm-2 align-items-stretch">
                <h2>Roster</h2>
            </div>
            <div class="col-sm-4 align-items-stretch mt-2">
                <form name="selteam" action="rosters.php?tid=<?=$teamid?>" method="post">
                    <select onchange="reload(this, 'admin/rosters.php', '<?= $filepath ?>');" name="team">
                        <?= $list ?>
                    </select>
                </form>
            </div>
        </div>
        <form name="newplayer" class='mb-3' action="<?= $filepath ?>editroster.php?t=<?= $teamid ?>&p=0&m=a" method="post">
            <div class="row row-cols-sm-auto g-1 align-items-center">
                <div class="col-3">
                    <div class="input-group"><select class="form-select" name="tid"><?= $list ?></select></div>
                </div>
                <div class="col-1">
                    <div class="input-group">
                        <select class="form-select" name="number" id="number">
                            <option value='0'>- # -</option>
                            <?php
                            for ($i = 0; $i <= 99; $i++) {
                            ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-1">
                    <div class="input-group">
                        <select class="form-select" name="year">
                            <option value='0'>- YR -</option>
                            <option value="SR">SR</option>
                            <option value="JR">JR</option>
                            <option value="SO">SO</option>
                            <option value="FR">FR</option>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="input-group"><select class="form-select" name="position"><?= $poslist ?></select></div>
                </div>
                <div class="col-2">
                    <div class="input-group"><input class="form-control" type="text" name="fname" placeholder="fname" /></div>
                </div>
                <div class="col-2">
                    <div class="input-group"><input class="form-control" type="text" name="lname" placeholder="lname" /></div>
                </div>
                <div class="col-1">
                    <div class="input-group"><input class="form-control" type="text" name="ovr" placeholder="ovr" maxlength="2" /></div>
                </div>
                <div class="col-1 form-check">
                    <input class="form-check-input" type="checkbox" name="isredshirt" id="isredshirt">
                    <label class="form-check-label" for="isredshirt">
                        Redshirt?
                    </label>
                </div>
                <div class="col-12 mb-2">
                    <div class="input-group"><input type="submit" value="Add" class="btn btn-primary"></div>
                </div>
            </div>
        </form>
        <div class="row mt-0">
            <div class="col-sm-12 align-items-stretch mb-4">
                <?php echo $table; ?>
            </div>
        </div>
    </div>
</section>

<?php include "../_include/footer.php"; ?>

<script>
    document.getElementById("number").focus();
</script>