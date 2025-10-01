<?php
$hero_title = "Player Stats";
$hero_text = "Update your games's player stats here";

include '../_include/header.php';

if ($userid == "") {
    $URL = $filepath . "../signin.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

$aryb[0][0] = "/mydynasties.php";
$aryb[0][1] = "My Dynasties";
$aryb[1][0] = "/edit/dynasty.php?id=" . $_SESSION["dyn"];
$aryb[1][1] = "Dynasty Home";
$aryb[2][0] = "/edit/schedule.php"; //schedule.php?sea=15&tid=996957
$aryb[2][1] = "Schedule";
$aryb[3][0] = "/edit/playerstatsupload.php?sid=" . $_REQUEST["sid"] . "&tid=" . $userTeamId;;
$aryb[3][1] = "Upload Player Stats";

?>
<section class="pagetitle">
    <div class="row mb-2">
        <div class="col-12 my-auto">
            <form action="playerstatsuploadu.php" method="post" enctype="multipart/form-data">
                Select CSV file to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload CSV" name="submit">
            </form>
        </div>
    </div>
</section>

<?php include '../_include/footer.php' ?>