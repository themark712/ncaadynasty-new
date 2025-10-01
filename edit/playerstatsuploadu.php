<?php
if (isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a CSV
    if ($fileType != "csv") {
        echo "Sorry, only CSV files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";

            // Open the file and parse it
            if (($handle = fopen($target_file, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    // Process the CSV data
                    //echo "<pre>";
                    //print_r($data);
                    //echo "</pre>";
                    foreach ($data as $row) {
                        if ($row != "") {
                            echo $row . "<br>";
                        }
                    }
                }
                fclose($handle);
            }
        } else {
            echo "Sorry, there was an error uploading your file: " . $target_file;
        }
    }
}
