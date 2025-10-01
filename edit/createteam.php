<?php
$hero_title = "Created Teams";
$hero_text = "View your created teams here";

include '../_include/header.php';

$aryb[0][0] = "/mydynasties.php";
$aryb[0][1] = "My Dynasties";
$aryb[1][0] = "/edit/dynasty.php?id=" . $_SESSION["dyn"];
$aryb[1][1] = "Dynasty Home";

if ($userid == "") {
    redirect($filepath . "signin.php");
}

if (!isset($_SESSION["dyn"])) {
    redirect("mydynasties.php");
}

if (getDynastyOwner($_SESSION["dyn"]) != $userid) {
    redirect("mydynasties.php");
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

// get created teams list
$queryt = "SELECT * FROM dynteams WHERE dynastyid=" . $_SESSION["dyn"] . " ORDER BY name";
$result = query($queryt);
$teamslist = "";

if ($result) {
    foreach ($result as $row) {
        $teamslist .= "<div class='col-2'>" . $row["name"] . "</div>";
        $teamslist .= "<div class='col-2'>" . $row["mascot"] . "</div>";
    }
    $teamslist .= "</select>";
}
$dynastyname = getDynastyName($_SESSION["dyn"]);

?>
<section class="pagetitle">
    <div class="row mb-3">
        <?php
        if ($_SESSION["prem"] == 1) { ?>
        
        <div class="row mb-4">
        <h5>My Created Teams</h5>
            <?=$teamslist?>
        </div>

            <div class="row mb-3">
                <div class="col-10">
                    <h5>Add Created Team</h5>
                </div>
                <div class="row mb-3">
                    <form class="form col-10" action="createteamu.php" method="post" enctype="multipart/form-data">
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text w-25" id="inputGroup-sizing-sm">Team Name</span>
                            <input type="text" id="name" name="name" class="form-control" placeholder="name" aria-label="name" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text w-25" id="inputGroup-sizing-sm">Mascot</span>
                            <input type="text" id="mascot" name="mascot" class="form-control" placeholder="mascot" aria-label="mascot" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text w-25" id="inputGroup-sizing-sm">Location</span>
                            <input type="text" id="location" name="location" class="form-control" placeholder="location" aria-label="location" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text w-25" id="inputGroup-sizing-sm">Color (HTML Hex Code)</span>
                            <input type="text" id="color" name="color" class="form-control" placeholder="color" maxlength="6" aria-label="color" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text w-25" id="inputGroup-sizing-sm">Conference</span>
                            <?= $conflist ?>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text w-25" id="inputGroup-sizing-sm">Logo</span>
                            <input type="file" name="logo" id="logo" class="form-control" placeholder="logo" aria-label="logo" c aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <div class="input-group input-group-sm mt-3">
                            <button id="create" class="btn btn-primary">Add Team</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<?php include '../_include/footer.php' ?>