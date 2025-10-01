<?php
session_start();
include "../_include/config.php";
include "../_include/func.php";

$e="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // check image
    echo count($_FILES);
    $target_file = LOGO_IMAGE_DIR . basename($_FILES["logo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($imageFileType != "png") {
        $e .= "Sorry, PNG files are allowed for logo images.<br>";
        $uploadOk = 0;
    }
    if ($_FILES["logo"]["size"] > 30000) {
        $e .= "Sorry, your file is too large. Images should be less than 30kb<br>";
        $uploadOk = 0;
    }

    if ($e == "") {
        $teamid = 990000;
        $rand = mt_rand(1,9000);
        $teamid = $teamid + $_SESSION["dyn"] + $rand;

        $sql = "INSERT INTO dynteams (id, dynastyid, name, mascot, location, color, confid) VALUES (";
        $sql .= $teamid . ", ";
        $sql .= $_SESSION["dyn"] . ", ";
        $sql .= "'" . $_POST["name"] . "', ";
        $sql .= "'" . $_POST["mascot"] . "', ";
        $sql .= "'" . $_POST["location"] . "', ";
        $sql .= "'" . $_POST["color"] . "', ";
        $sql .= $_POST["conf"] . ") ";

        $newId = ins_query($sql);

        if ($newId) {
            $target_file = LOGO_IMAGE_DIR . $newId;
            if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file . "." . $imageFileType)) {
                echo "The file " . htmlspecialchars(basename($_FILES["logo"]["name"])) . " has been uploaded.";
            } else {
                $e = "Sorry, there was an error uploading your file.";
            }
            $sql = "UPDATE dynteams SET logo='" . $newId . "' WHERE id=" . $newId;
            $result = query($sql);
        }
    }
    if ($e == "") {
        header('Location: dynasty.php?id=' . $_SESSION["dyn"]);
    } else {
        echo $e;
    }
}
