<?php
$e = "";
$hero_title = "Season - Standings";
$hero_text = "View conference standings";

include '../_include/header.php';

$aryb[0][0] = "/mydynasties.php";
$aryb[0][1] = "My Dynasties";
$aryb[1][0] = "/edit/dynasty.php?id=" . $_SESSION["dyn"];
$aryb[1][1] = "Dynasty Home";
$aryb[2][0] = "/edit/standings.php?c=" . $_REQUEST["c"];
$aryb[2][1] = "Standings";

$menu = "";
$table = "";

$c = "";
if (isset($_REQUEST["c"])) {
    $c = $_REQUEST["c"];
}

$w = "";
if (isset($_POST["week"])) {
    $w = $_POST["week"];
}
if (isset($_REQUEST["w"])) {
    $w = $_REQUEST["w"];
}

if ($w != "") {
    
    $aryteams = getConfTeamIdList($currentSeason, $c);
    // get list of teams in conference, checking custom conferences
    $sql = "SELECT t.id, t.name as team, c.name as conf FROM dynteams t LEFT JOIN dynconf c ON t.confid=c.id ";
    $sql .= " WHERE t.confid = " .  $c;
    $sql .= " AND t.id IN (" . implode(',', $aryteams) . ") ";
    //$sql .= " AND t.id NOT IN (SELECT replacedteamid FROM dyncustomconf WHERE confid=" . $c . " AND seasonid=" . $currentSeason . ")";
    //$sql .= " UNION ";
    //$sql .= " SELECT t.id, t.name as team, c.name as conf FROM dynteams t LEFT JOIN dynconf c ON t.confid=c.id WHERE t.id IN (SELECT newteamid FROM dyncustomconf WHERE confid=" . $c . " AND seasonid=" . $currentSeason . ") ";
    //echo $sql;
    
    $result = query($sql);
    
    if ($result) {
        // make sure each team has a row in standings
        foreach ($result as $row) {
            $sql = "SELECT * FROM dynstandings WHERE seasonid=" . $currentSeason . " AND week=" . $w . " AND teamid=" . $row["id"];
            $result2=query($sql);

            if (!$result2) {
                $sql = "INSERT INTO dynstandings (seasonid, confid, week, teamid) VALUES (";
                $sql .= $currentSeason . ", ";
                $sql .= $c . ", ";
                $sql .= $w . ", ";
                $sql .= $row["id"]. ") ";
                $result3=query($sql);
            }
        }
    }


    $sql = "SELECT s.id, s.win, s.loss, s.confwin, s.confloss, t.name, t.logo FROM dynstandings s LEFT JOIN dynteams t ON s.teamid=t.id WHERE seasonid=" . $currentSeason;
    $sql .= " ORDER BY confwin/(confwin+confloss) DESC, win/(win+loss) DESC, t.name";
    
    $standings = query($sql);

    $table = "<table class='table sm'>";
    $table .="<tr>";
    $table .="<th colspan='2'>Team</th>";
    $table .="<th>Conf W</th>";
    $table .="<th>Conf L</th>";
    $table .="<th>Ovr W</th>";
    $table .="<th>Ovr L</th>";
    $table .="<th>Update</th>";
    $table .="</tr>";
    
    $currentconf = "";
    $confdiv = "";

    if ($standings) {
        foreach ($standings as $rowt) {
            $rank = 0;
            if ($rank > 25) {
                $rank = '';
            };
            $table .="<form name='standings' action='standingsu.php' method='post'>";
            $table .= "<input type='hidden' name='id' value='" . $rowt["id"] . "'>";
            $table .= "<input type='hidden' name='w' value='" . $w . "'>";
            $table .= "<input type='hidden' name='c' value='" . $c . "'>";
            $table .= "<input type='hidden' name='sea' value='" . $currentSeason . "'>";
            $table .= "<tr>";
            if ($c == "r") {
                $table .= "<td class='col-1'>" . $rank . "</td>";
            }
            $table .= "<td class='col-1'><img src='" . $filepath . "_assets/img/logos/" . $rowt["logo"] . ".png' style='height:30px;' /></td>";
            $table .= "<td class='col-3'>";
            if ($rank > 0  && $c != "r") {
                $table .= " <sup class='me-1'>#" . $rank . "</sup>";
            }
            $table  .= $rowt["name"] . "</td>";
            $table .= "<td class='col-1'><input type='text' name='confwin' class='w-75' value='" . $rowt["confwin"] . "'></td>";
            $table .= "<td class='col-1'><input type='text' name='confloss' class='w-75' value='" . $rowt["confloss"] . "'></td>";
            $table .= "<td class='col-1'><input type='text' name='win' class='w-75' value='" . $rowt["win"] . "'></td>";
            $table .= "<td class='col-1'><input type='text' name='loss' class='w-75' value='" . $rowt["loss"] . "'></td>";
            $table .= "<td class='col-2'><button type='submit' name='confwin' class='btn btn-primary btn-sm' value='" . $rowt["loss"] . "'>Update</dutton></td>";
            $table .= "</tr>\r\n";
            $table .="</form>";
        }
    }
    $table .= "</table>";
}
?>

<section class="pagetitle">
<div class="row">
    <div class="col-sm-6 d-flex align-items-stretch mb-3">
        <form name="selweek" action="standings.php?&c=<?=$c?>" method="post">
            Week: <select onchange="submit();" name="week">
                <option value='0'>- week -</option>
                <?php
                foreach (WEEKS as $i) {
                ?>
                    <option value="<?php echo $i; ?>" <?php if ($w == $i) {
                                                            echo " selected";
                                                        } ?>><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-sm-10 align-items-stretch mb-4">
        <?php echo $table; ?>
    </div>
</div>
</div>
</section>
<?php include "../_include/footer.php"; ?>