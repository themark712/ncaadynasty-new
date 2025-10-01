<?php
$hero_title = "Game Stats";
$hero_text = "Update your games's stats here";

include '../_include/header.php';

$aryb[0][0] = "/mydynasties.php";
$aryb[0][1] = "My Dynasties";
$aryb[1][0] = "/edit/dynasty.php?id=" . $_SESSION["dyn"];
$aryb[1][1] = "Dynasty Home";
$aryb[2][0] = "/edit/schedule.php?sea=" . $currentSeason . "&tid=" . $userTeamId; //schedule.php?sea=15&tid=996957
$aryb[2][1] = "Schedule";
$aryb[3][0] = "/edit/gamestats.php?sid=" . $_REQUEST["sid"];
$aryb[3][1] = "Game Stats";

if ($userid == "") {
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

// initialize variables
$myid = 0;
$oppid = 0;
$my = "";
$opp = "";
$mylogo = "";
$opplogo = "";

// my - database values
$myscore = 0;    // Home Score
$myfd = 0;    // First Downs
$mypa = 0;    // Pass Attempts
$mypc = 0;    // Pass Completions
$mypy = 0;    // Pass Yards
$mypt = 0;    // Pass TDs
$myra = 0;    // Rush Attempts
$myry = 0;    // Rush Yards
$myrt = 0;    // Rush TDs
$my3a = 0;    // 3rd Down Attempts
$my3c = 0;    // 3rd Down Conversions
$my4a = 0;    // 4th Down Attempts
$my4c = 0;    // 4th Down Conversions
$my2a = 0;    // 2pt Attempts
$my2c = 0;    // 2pt Conversions
$mytop = "";  // Time of Possession

// my - calculated values
$myty = 0;    // Total Yards
$myypp = 0;   // Yards Per Pass
$myypr = 0;   // Yards Per Rush

// opp - database values
$oppscore = 0;    // Away Score
$oppfd = 0;    // First Downs
$opppa = 0;    // Pass Attempts
$opppc = 0;    // Pass Completions
$opppy = 0;    // Pass Yards
$opppt = 0;    // Pass TDs
$oppra = 0;    // Rush Attempts
$oppry = 0;    // Rush Yards
$opprt = 0;    // Rush TDs
$opp3a = 0;    // 3rd Down Attempts
$opp3c = 0;    // 3rd Down Conversions
$opp4a = 0;    // 4th Down Attempts
$opp4c = 0;    // 4th Down Conversions
$opp2a = 0;    // 2pt Attempts
$opp2c = 0;    // 2pt Conversions
$opptop = "";  // Time of Possession

// opp - calculated values
$oppty = 0;    // Total Yards
$oppypp = 0;   // Yards Per Pass
$oppypr = 0;   // Yards Per Rush

// get opponent team
$queryt = "SELECT t.id, t.name, t.logo, s.oppid FROM dynsch s LEFT JOIN dynteams t ON t.id=s.oppid WHERE s.id =" . $_REQUEST["sid"];
$resultt = query($queryt);
if ($resultt) {
    foreach ($resultt as $row) {
        $oppid = $row["oppid"];
        $opp = $row["name"];
        $opplogo = $row["logo"];
        //$oppscore = $row["oppscore"];
    }
}

// get my team
$queryt = "SELECT t.id, t.name, t.logo, s.ishome FROM dynsch s LEFT JOIN dynteams t ON t.id=" . $userTeamId . " WHERE t.id =" . $userTeamId . " AND s.id=" . $_REQUEST["sid"];
$resultt = query($queryt);
if ($resultt) {
    foreach ($resultt as $row) {
        $myid = 352;
        $my = $row["name"];
        $mylogo = $row["logo"];
        //$myscore = $row["myscore"];
    }
}

// get game stats
$query = "SELECT * ";
$query .= " FROM dyngamestats ";
$query .= " WHERE schid=" . $_REQUEST["sid"] . " ORDER BY teamid, name";
$result = query($query);

if ($result) {
    foreach ($result as $row) {
        if ($row["teamid"] == $myid) {
            switch ($row["name"]) {
                case "Score":
                    $myscore = $row["value"];
                    break;
                case "First Downs":
                    $myfd = $row["value"];
                    break;
                case "Pass Attempts":
                    $mypa = $row["value"];
                    break;
                case "Pass Completions":
                    $mypc = $row["value"];
                    break;
                case "Pass Yards":
                    $mypy = $row["value"];
                    break;
                case "Pass TDs":
                    $mypt = $row["value"];
                    break;
                case "Rush Attempts":
                    $myra = $row["value"];
                    break;
                case "Rush Yards":
                    $myry = $row["value"];
                    break;
                case "Rush TDs":
                    $myrt = $row["value"];
                    break;
                case "3rd Down Attempts":
                    $my3a = $row["value"];
                    break;
                case "3rd Down Conversions":
                    $my3c = $row["value"];
                    break;
                case "4th Down Attempts":
                    $my4a = $row["value"];
                    break;
                case "4th Down Conversions":
                    $my4c = $row["value"];
                    break;
                case "2pt Attempts":
                    $my2a = $row["value"];
                    break;
                case "2pt Conversions":
                    $my2c = $row["value"];
                    break;
                case "Time of Possession":
                    $mytop = $row["value"];
                    break;
            }
        }
        if ($row["teamid"] == $oppid) {
            switch ($row["name"]) {
                case "Score":
                    $oppscore = $row["value"];
                    break;
                case "First Downs":
                    $oppfd = $row["value"];
                    break;
                case "Pass Attempts":
                    $opppa = $row["value"];
                    break;
                case "Pass Completions":
                    $opppc = $row["value"];
                    break;
                case "Pass Yards":
                    $opppy = $row["value"];
                    break;
                case "Pass TDs":
                    $opppt = $row["value"];
                    break;
                case "Rush Attempts":
                    $oppra = $row["value"];
                    break;
                case "Rush Yards":
                    $oppry = $row["value"];
                    break;
                case "Rush TDs":
                    $opprt = $row["value"];
                    break;
                case "3rd Down Attempts":
                    $opp3a = $row["value"];
                    break;
                case "3rd Down Conversions":
                    $opp3c = $row["value"];
                    break;
                case "4th Down Attempts":
                    $opp4a = $row["value"];
                    break;
                case "4th Down Conversions":
                    $opp4c = $row["value"];
                    break;
                case "2pt Attempts":
                    $opp2a = $row["value"];
                    break;
                case "2pt Conversions":
                    $opp2c = $row["value"];
                    break;
                case "Time of Possession":
                    $opptop = $row["value"];
                    break;
            }
        }
    }
    $myty = $mypy + $myry;
    $oppty = $opppy + $oppry;

    if ($mypa > 0) {
        $myypp = round($mypy / $mypa, 1);
    }
    if ($opppa > 0) {
        $oppypp = round($opppy / $opppa, 1);
    }

    if ($myra > 0) {
        $myypr = round($myry / $myra, 1);
    }
    if ($oppra > 0) {
        $oppypr = round($oppry / $oppra, 1);
    }
}
?>
<section class="pagetitle">
    <form name="gamestats" class="mb-3" action="gamestatsu.php" method="post">
        <div class="row mb-2">
            <input type="hidden" name="myid" value="<?= $myid ?>">
            <input type="hidden" name="oppid" value="<?= $oppid ?>">
            <input type="hidden" name="sid" value="<?= $_REQUEST["sid"] ?>">
            <div class="col-6 text-center"><img class="rounded-circle img-md me-2" src="<?= $filepath ?>_assets/img/logos/<?= $opplogo ?>.png"><?= $opp ?></div>
            <div class="col-6 text-center"><?= $my ?><img class="rounded-circle img-md ms-2" src="<?= $filepath ?>_assets/img/logos/<?= $mylogo ?>.png"></div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <div class="col-12 text-end"><input type="text" class="list w-15" name="oppscore" value="<?= $oppscore ?>"></div>
                </div>
                <div class="row">
                    <div class="col-12 text-end"><input type="text" class="list w-15" name="oppfd" value="<?= $oppfd ?>"></div>
                </div>
                <div class="row">
                    <div class="col-12 text-end"><?= $oppty ?></div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <input type="text" class="list w-15" name="oppra" value="<?= $oppra ?>"> |
                        <input type="text" class="list w-15" name="oppry" value="<?= $oppry ?>"> |
                        <input type="text" class="list w-15" name="opprt" value="<?= $opprt ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end"><?= $oppypr ?></div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <input type="text" class="list w-15" name="opppc" value="<?= $opppc ?>">/
                        <input type="text" class="list w-15" name="opppa" value="<?= $opppa ?>"> |
                        <input type="text" class="list w-15" name="opppt" value="<?= $opppt ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end"><?= $oppypp ?></div>
                </div>
                <div class="row">
                    <div class="col-12 text-end"><input type="text" class="list w-15" name="opppy" value="<?= $opppy ?>"></div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <input type="text" class="list w-15" name="opp3c" value="<?= $opp3c ?>">/
                        <input type="text" class="list w-15" name="opp3a" value="<?= $opp3a ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <input type="text" class="list w-15" name="opp4c" value="<?= $opp4c ?>">/
                        <input type="text" class="list w-15" name="opp4a" value="<?= $opp4a ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <input type="text" class="list w-15" name="opp2c" value="<?= $opp2c ?>">/
                        <input type="text" class="list w-15" name="opp2a" value="<?= $opp2a ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end"><input type="text" class="list w-20" name="opptop" value="<?= $opptop ?>"></div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-12 text-center">Score</div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">First Downs</div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">Total Offense</div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">Rushes | Yards | TDs</div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">Yards Per Rush</div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">Comp/Att | TDs</div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">Yards Per Pass</div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">Pass Yards</div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">3rd Down Conv</div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">4th Down Conv</div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">2 Pt Conv</div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">Time of Possession</div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-12 text-start"><input type="text" class="list w-15" name="myscore" value="<?= $myscore ?>"></div>
                </div>
                <div class="row">
                    <div class="col-12 text-start"><input type="text" class="list w-15" name="myfd" value="<?= $myfd ?>"></div>
                </div>
                <div class="row">
                    <div class="col-12 text-start"><?= $myty ?></div>
                </div>
                <div class="row">
                    <div class="col-12 text-start">
                        <input type="text" class="list w-15" name="myra" value="<?= $myra ?>"> |
                        <input type="text" class="list w-15" name="myry" value="<?= $myry ?>"> |
                        <input type="text" class="list w-15" name="myrt" value="<?= $myrt ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-start"><?= $myypr ?></div>
                </div>
                <div class="row">
                    <div class="col-12 text-start">
                        <input type="text" class="list w-15" name="mypc" value="<?= $mypc ?>">/
                        <input type="text" class="list w-15" name="mypa" value="<?= $mypa ?>"> |
                        <input type="text" class="list w-15" name="mypt" value="<?= $mypt ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-start"><?= $myypp ?></div>
                </div>
                <div class="row">
                    <div class="col-12 text-start"><input type="text" class="list w-15" name="mypy" value="<?= $mypy ?>"></div>
                </div>
                <div class="row">
                    <div class="col-12 text-start">
                        <input type="text" class="list w-15" name="my3c" value="<?= $my3c ?>">/
                        <input type="text" class="list w-15" name="my3a" value="<?= $my3a ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-start">
                        <input type="text" class="list w-15" name="my4c" value="<?= $my4c ?>">/
                        <input type="text" class="list w-15" name="my4a" value="<?= $my4a ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-start">
                        <input type="text" class="list w-15" name="my2c" value="<?= $my2c ?>">/
                        <input type="text" class="list w-15" name="my2a" value="<?= $my2a ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-start"><input type="text" class="list w-20" name="mytop" value="<?= $mytop ?>"></div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-2">&nbsp;</div>
            <div class="col-2">&nbsp;</div>
            <div class="col-1">1</div>
            <div class="col-1">2</div>
            <div class="col-1">3</div>
            <div class="col-1">4</div>
            <div class="col-2">Final</div>
            <div class="col-2">&nbsp;</div>
        </div>
        <div class="row mt-3">
            <div class="col-2">&nbsp;</div>
            <div class="col-2"><?= $opp ?></div>
            <div class="col-1">0</div>
            <div class="col-1">7</div>
            <div class="col-1">3</div>
            <div class="col-1">7</div>
            <div class="col-2">17</div>
            <div class="col-2">&nbsp;</div>
        </div>
        <div class="row mt-3">
            <div class="col-2">&nbsp;</div>
            <div class="col-2"><?= $my ?></div>
            <div class="col-1">0</div>
            <div class="col-1">14</div>
            <div class="col-1">0</div>
            <div class="col-1">7</div>
            <div class="col-2">21</div>
            <div class="col-2">&nbsp;</div>
        </div>
        <div class="row mt-2">
            <div class="col-12 text-center"><input type="submit" class="btn btn-primary" value="Update"></div>
        </div>
</section>
<?php include '../_include/footer.php' ?>