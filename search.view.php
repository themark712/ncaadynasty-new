<?php
$hero_title = "Dynasty Search";
$hero_text = "View your seasons here";
unset($_SESSION["dyn"]);
include '_include/header.php';

$e = "";
if (isset($_REQUEST["e"])) {
    $e = $_REQUEST["e"];
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $dyn=new DynastyM;
    $query = "SELECT d.id as did, t.id as tid, d.name as dname FROM dynasty d LEFT JOIN dynseasons s ON d.id = s.dynastyid LEFT JOIN dynteams t ON s.teamid=t.id WHERE d.id IN (SELECT id FROM dynteams WHERE name like '%" . $this->key . "%')";
    $result=$dyn->findAll($query);
} else {
    $result=false;
}

$seasons = "<table class='table table-sm'>";

if ($result) {
    foreach ($result as $x => $y) {
        $seasons .= "<tr>";
        $seasons .= "<td>" . $y->dname . "</td>";
        $seasons .= "<td><a href='" . $filepath . "rosters/" . $y->tid . "'>Roster</a></td>";
        $seasons .= "<td><a href='" . $filepath . "schedule/" . $y->did . "'>Schedule</a></td>";
        $seasons .= "<td><a href='" . $filepath . "articles/" . $y->did . "'>Articles</a></td>";
        $seasons .= "</tr>";
    }
} else {
    $e .= "No seasons found";
}
$seasons .= "</table>";
?>
<section class="pagetitle">
<div class="container container-page mx-auto">
    <div class="row mb-1">
        <div class="col-10">
            <h2>Dynasty Search</h2>
            <p class="text-danger"><?php echo $e; ?></p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-10">
            <?php echo $seasons; ?>
        </div>
    </div>

</div>
</section>
<?php include '_include/footer.php' ?>
