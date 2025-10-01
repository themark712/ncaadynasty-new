<?php
$hero_title = "Custom Conferences";
$hero_text = "View your created teams here";
include '../_include/header.php';

$aryb[0][0] = "/mydynasties.php";
$aryb[0][1] = "My Dynasties";
$aryb[1][0] = "/edit/dynasty.php?id=" . $_SESSION["dyn"];
$aryb[1][1] = "Dynasty Home";
$aryb[2][0] = "/edit/customconf.php";
$aryb[2][1] = "Custom Conferences";


if ($userid == "") {
    redirect($filepath . "signin.php");
}

if (!isset($_SESSION["dyn"])) {
    redirect("mydynasties.php");
}

if (getDynastyOwner($_SESSION["dyn"]) != $userid) {
    redirect("home.php");
}

$e = "";
if (isset($_REQUEST["e"])) {
    $e = $_REQUEST["e"];
}

// get conference for select list
$queryt = "SELECT * FROM dynconf ";
$queryt .= " ORDER BY name";

$result = query($queryt);

$conflist = "<option value='-select team-'></option>";

foreach ($result as $row) {
    $conflist .= "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
}

$sql = "SELECT cc.id, cr.name as rconf, cn.name as nconf, tn.name as nteam, tr.name as rteam ";
$sql .= " FROM dyncustomconf cc ";
$sql .= "    LEFT JOIN dynteams tn ON cc.newteamid=tn.id ";
$sql .= "    LEFT JOIN dynteams tr ON cc.replacedteamid=tr.id ";
$sql .= "    LEFT JOIN dynconf cn ON cc.newconfid=cn.id ";
$sql .= "    LEFT JOIN dynconf cr ON cc.replacedconfid=cr.id ";
$sql .= " WHERE cc.seasonid=" . $currentSeason;
$sql .= " ORDER BY cc.id, tn.name";

$result = query($sql);

$cclist = "<div class='row sm'>";
$cclist .= "<div class='col-3'>New Conference</div>";
$cclist .= "<div class='col-2'>New Team</div>";
$cclist .= "<div class='col-3'>Replaced Conference</div>";
$cclist .= "<div class='col-2'>Replaced Team</div>";
$cclist .= "<div class='col-1'>Delete</div>";
$cclist .= "</div>";

if ($result) {
    foreach ($result as $row) {
        $cclist .= "<form name='ccdelete'>";
        $cclist .= "<div class='row sm mb-1'>";
        $cclist .= "<div class='col-3 text-success align-middle'>" . $row["nconf"] . "</div>";
        $cclist .= "<div class='col-2 text-success align-middle'>" . $row["nteam"] . "</div>";
        $cclist .= "<div class='col-3 text-danger align-middle'>" . $row["rconf"] . "</div>";
        $cclist .= "<div class='col-2 text-danger align-middle'>" . $row["rteam"] . "</div>";
        $cclist .= "<div class='col-1 text-danger'><a type='submit' class='btn btn-sm-comp btn-danger' href='customconfu.php?m=d&id=" . $row["id"] . "'><i class='bi bi-x'></i></a>";
        $cclist .= "</div>";
        $cclist .= "</form>";
    }
} else {
    $cclist = "No custom conferences found";
}

$dynastyname = getDynastyName($_SESSION["dyn"]);
$confid = getConfid($currentSeason, $userTeamId);
?>
<section class="pagetitle">
    <div class="row mb-2 mt-0">
        <div class="col-12 mt-3">
            <h5 class='mb-0'>Conference Changes</h5>
        </div>
    </div>
    <?= $cclist ?>
    <div class="row">
        <div class="col-12">
            <a href="standings.php?c=<?= $confid ?>" target="_blank">View Standings Page <sup><i class="bi bi-arrow-up-right-square"></i></sup></a>
        </div>
    </div>
    <?php
    if ($_SESSION["prem"] == 1) { ?>
        <div class="row mb-2">
            <div class="col-12 mt-3">
                <h5 class='mb-0'>Create Custom Conferences</h5>
                <b><a href="#notes">Please see note before making conference changes</a></b>
            </div>
        </div>
        <form class="form row mb-4" action="customconfu.php?sea=<?= $currentSeason ?>" method="post">
            <div>Team To Move</div>
            <div class="input-group input-group-sm mb-1 col-6">
                <span class="input-group-text w-25" id="inputGroup-sizing-sm">Conference</span>
                <select id='oldconf' class='form-select w-50' name='oldconf'>
                    <?= $conflist ?>
                </select>
            </div>
            <div class="input-group input-group-sm col-6 mb-3">
                <span class="input-group-text w-25" id="inputGroup-sizing-sm">Select Team</span>
                <select id='moveteam' class='form-select w-50' name='moveteam'></select>
            </div>
            <div>Team To Replace</div>
            <div class="input-group input-group-sm mb-1">
                <span class="input-group-text w-25" id="inputGroup-sizing-sm">New Conference</span>
                <select id='newconf' class='form-select' name='newconf'>
                    <?= $conflist ?>
                </select>
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text w-25" id="inputGroup-sizing-sm">Replace Team</span>
                <select id='replacedteam' class='form-select' name='replacedteam'></select>
            </div>
            <div class="input-group input-group-sm mt-1">
                <button id="create" class="btn btn-primary">Add Team</button>
            </div>
        </form>
    <?php } ?>
    <div class="row">
        <div class="col-12">
            <a name="notes">
                <h6>Custom Conference Notes</h6>
            </a>
            <ul>
                <li>You should only make changes to the conference that YOUR dynasty team is in. This will allow you to update and view
                    the standings for your conference. At this time, you only standings to your conference are viewable.</li>
                <li>Conferences changes are on a one-for-one basis, meaning you may only swap two teams between their respective conferences.
                    For example, swapping Western Kentucky for Tennessee will place WKU in the SEC and UT in Conference USA.
                </li>
                <li class="text-danger">Changes to conferences are limited to 16 changes. This is necessary to keep the flow of data manageable.</li>
            </ul>
        </div>
    </div>
</section>
<?php include '../_include/footer.php' ?>
<script>
    $(document).ready(function($) {
        var list_target_id = 'moveteam'; //first select list ID
        var list_select_id = 'oldconf'; //second select list ID
        var initial_target_html = '<option value="">Please select conference...</option>'; //Initial prompt for target select

        $('#' + list_target_id).html(initial_target_html); //Give the target select the prompt option

        $('#' + list_select_id).change(function(e) {
            //Grab the chosen value on first select list change
            var selectvalue = $(this).val();
            //Display 'loading' status in the target select list
            $('#' + list_target_id).html('<option value="">Loading...</option>');

            if (selectvalue == "") {
                //Display initial prompt in target select if blank value selected
                $('#' + list_target_id).html(initial_target_html);
            } else {
                //Make AJAX request, using the selected value as the GET
                $.ajax({
                    url: 'get_options.php?svalue=' + selectvalue,
                    success: function(output) {
                        //alert(output);
                        $('#' + list_target_id).html(output);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " " + thrownError);
                    }
                });
            }
        });

        var list_target_id2 = 'replacedteam'; //first select list ID
        var list_select_id2 = 'newconf'; //second select list ID
        var initial_target_html = '<option value="">Please select conference...</option>'; //Initial prompt for target select

        $('#' + list_target_id2).html(initial_target_html); //Give the target select the prompt option

        $('#' + list_select_id2).change(function(e) {
            //Grab the chosen value on first select list change
            var selectvalue = $(this).val();
            //Display 'loading' status in the target select list
            $('#' + list_target_id2).html('<option value="">Loading...</option>');

            if (selectvalue == "") {
                //Display initial prompt in target select if blank value selected
                $('#' + list_target_id2).html(initial_target_html);
            } else {
                //Make AJAX request, using the selected value as the GET
                $.ajax({
                    url: 'get_options.php?svalue=' + selectvalue,
                    success: function(output) {
                        //alert(output);
                        $('#' + list_target_id2).html(output);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " " + thrownError);
                    }
                });
            }
        });
    });
</script>