<?php
$hero_title = "My Dynasties";
$hero_text = "View your dynasties here";

include '_include/header.php';

$aryb[0][0] = "/mydynasties.php";
$aryb[0][1] = "My Dynasties";

if ($userid == "") {
    $URL = $filepath . "signin.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

unset($_SESSION["dyn"]);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usingCT = 0;
    if ($_POST["team"] == "999") {
        $usingCT = 1;
    }

    $usingCC = 0;
    if ($_POST["customconferences"] == "cc") {
        $usingCC = 1;
    }

    $aryn["name"] = $_POST["dynastyname"];
    $aryn["userid"] = $_SESSION["userid"];
    $aryn["createdteams"] = $usingCT;
    $aryn["customconferences"] = $usingCC;
    $query = "INSERT INTO dynasty (name, userid, createdteams, customconferences) VALUES (:name, :userid, :createdteams, :customconferences)";
    $result = ins_query($query, $aryn);

    if ($result) {
        $_SESSION["dyn"] = $result;
    }
    
    if ($_POST["team"] == "999") {
        $URL = $filepath . "edit/createteam.php";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
    
    if ($usingCC == 1) {
        $URL = $filepath . "customconf.php";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
}

$e = "";
if (isset($_REQUEST["e"])) {
    $e = $_REQUEST["e"];
}

$sql = "SELECT * FROM dynasty WHERE userid=" . $_SESSION["userid"];
$result = query($sql);

$list = "<table class='table'>";

if ($result) {
    foreach ($result as $row) {
        $list .= "<tr>";
        $list .= "<td><a href='" . $filepath . "dynasty.php?id=" . $row["id"] . "'>" . $row["name"] . "</a></td>";
        if ($_SESSION["userid"] == $row["userid"]) {
            $list .= "<td><a href='edit/dynasty.php?id=" . $row["id"] . "'>Edit</a></td>";
            //$list .= "<td><a href='edit/dynastyd.php?id=" . $row["id"] . "' class='text-danger' onclick='validateDelete();'><i class='bi bi-trash text-danger me-2'></i>Delete</a></td>";
            $list .= "<td><a href='#' class='text-danger' onclick='alert(\"This is not yet functional\");'><i class='bi bi-trash text-danger me-2'></i>Delete</a></td>";
        }
        $list .= "</tr>";
    }
} else {
    $e .= "No dynasties found";
}
$list .= "</table>";

// get teams for select list
$queryt = "SELECT * FROM dynteams ";
$queryt .= " ORDER BY Name";

$result = query($queryt);

$teams = "<option value='-select team-'></option>";
$teams.="<option value='999'>Created Team</option>";

foreach ($result as $row) {
    $teams .= "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
}
?>

<section class="pagetitle">
    <div class="row mb-3">
        <div class="col-12">
            <?php echo $list; ?>
        </div>
    </div>
    <?php
    if ($_SESSION["prem"] == 1) { ?>
        <div class="row mb-1">
            <div class="col-12">
                <h5>Create Dynasty</h5>
            </div>
        </div>
        <form class="row row-cols-lg-12 mb-3" action="mydynasties.php" method="post">
            <div class="col-3">
                <label class="visually-hidden" for="dynastyname">Username</label>
                <div class="input-group">
                    <input type="text" id="dynastyname" name="dynastyname" class="form-control" placeholder="Dynasty Name" maxlength="30" onblur="checkDynastyAvailability()">
                </div>
            </div>
            <div class="col-3">
                <label class="visually-hidden" for="team">Team</label>
                <div class="input-group">
                    <select name="team" class="form-select" id="team" placeholder="Team"><?= $teams ?></select>
                </div>
            </div>
            <div class="form-check col-2">
                <input class="form-check-input" type="checkbox" name="customconferences" value="cc" id="customconferences">
                <label class="form-check-label" for="flexCheckDefault" style="font-size:0.8rem;">
                    Using custom conferences
                </label>
            </div>
            <div class="col-2">
                <button type="submit" id="create" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-12">
                <span id="dynasty-availability-status" class="text-center ms-3" onchange="setButton()"></span>
            </div>
        </form>
    <?php } ?>
</section>
<?php include '_include/footer.php' ?>

<script>
    function checkDynastyAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "_include/check_availability.php",
            data: 'dynastyname=' + $("#dynastyname").val(),
            type: "POST",
            success: function(data) {
                $("#dynasty-availability-status").html(data);
                $("#loaderIcon").hide();
                var msg = $("#dynasty-availability-status").html();
                setButton(msg);
            },
            error: function() {}
        });
    }
</script>