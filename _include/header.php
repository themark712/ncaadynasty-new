<?php
session_start();

$userid = "";
$admin = "";
$username = "Login";
$profile_img = "blank";
$userLoggedIn = false;
$filepath = "";
$currentSeason = 0;
$userTeamId = 0;
$dynastyname="";

if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
    $profile_img = $userid;
    $userLoggedIn = true;
}

if (isset($_SESSION["admin"])) {
    $admin = $_SESSION["admin"];
}

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
}

if (strpos($_SERVER['REQUEST_URI'], "admin") > 0 || strpos($_SERVER['REQUEST_URI'], "edit") > 0) {
    $filepath = "../";
}

if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
}

$file =  $_SERVER['REQUEST_URI'];

include $filepath . "_include/config.php";
include $filepath . "_include/func.php";
include $filepath . "_include/db.php";

if (isset($_SESSION["dyn"])) {
    $currentSeason = getCurrentSeasonId($_SESSION["dyn"]);
    $userTeamId = getTeamIdFromDynasty($_SESSION["dyn"]);
    $dynastyname = getDynastyName($_SESSION["dyn"]);
}

//$conn = dbconnect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= $filepath ?>_assets/img/favicon.png" rel="icon">
    <link href="<?= $filepath ?>_assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= $filepath ?>_assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--<link href="<?= $filepath ?>_assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="<?= $filepath ?>_assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= $filepath ?>_assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= $filepath ?>_assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= $filepath ?>_assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= $filepath ?>_assets/vendor/summernote/summernote-lite.min.css">

    <!-- Template Main CSS File -->
    <link href="<?= $filepath ?>_assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="<?= $filepath ?>home.php" class="logo d-flex align-items-center">
                <img src="<?= $filepath ?>_assets/img/logo.png" style="border-radius:25%;height:30px;width:100px;">
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="<?= $filepath ?>search">
                <input type="text" name="query" placeholder="Search Dynasties" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <?php
                if ($userid != "") {
                    $query = "SELECT * FROM dynmessages WHERE touser=" . $userid;
                    $result = query($query);
                    $c = 0;
                    if ($result) {
                        foreach ($result as $row) {
                            $c++;
                            $messagetext = "<li class='message-item'>";
                            $messagetext .= "<a href='#'>";
                            $messagetext .= "<img src='" . $filepath . "_assets/img/messages-1.jpg' alt='' class='rounded-circle'>";
                            $messagetext .= "<div>";
                            $messagetext .= "<h4>" . getUsername($row["fromuser"]) . "</h4>";
                            $messagetext .= "<p>" . $row["message"] . "</p>";
                            $messagetext .= "<p>" . $row["datesent"] . "</p>";
                            $messagetext .= "</div>";
                            $messagetext .= "</a>";
                            $messagetext .= "</li>";
                            $messagetext .= "<li>";
                            $messagetext .= "<hr class='dropdown-divider'>";
                            $messagetext .= "</li>";
                        }
                    }
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-chat-left-text"></i>
                            <span class="badge bg-success badge-number"><?= $c ?></span>
                        </a><!-- End Messages Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                            <li class="dropdown-header">
                                You have <?= $c ?> new messages
                                <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <?= $messagetext ?>
                            <li class="dropdown-footer">
                                <a href="messages.php">Show all messages</a>
                            </li>

                        </ul><!-- End Messages Dropdown Items -->

                    </li><!-- End Messages Nav -->

                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-2" style="height:20px;width:20px;" src="<?= $filepath ?>_assets/img/users/<?= $profile_img ?>.jpg">
                            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $username ?></span>
                        </a><!-- End Profile Iamge Icon -->
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6><?= $username ?></h6>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="profile.pph">
                                    <i class="bi bi-person"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                    <i class="bi bi-question-circle"></i>
                                    <span>Need Help?</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="<?=$filepath?>logout.php">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </a>
                            </li>

                        </ul><!-- End Profile Dropdown Items -->

                    </li><!-- End Profile Nav -->

            </ul>
        <?php } else { ?>
            <ul class="d-flex align-items-end me-4">
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="signin.php">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign In</span>
                    </a>
                </li>
            </ul>
        <?php } ?>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="<?= $filepath ?>home.php">
                    <i class="bi bi-grid"></i>
                    <span>Home</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#dyn-nav" data-bs-toggle="collapse" href="#">
                    <i class='bx bx-ball'></i><span>Dynasties</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="dyn-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="<?= $filepath ?>mydynasties.php">
                            <i class="bi bi-circle"></i><span>My Dynasties</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $filepath ?>mydynasties.php">
                            <i class="bi bi-circle"></i><span>Public Dynasties</span>
                        </a>
                    </li>
                    <li>
                        <a href="charts-echarts.html">
                            <i class="bi bi-circle"></i><span>ECharts</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Charts Nav -->

            <?php if ($userLoggedIn) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#dynasty-nav" data-bs-toggle="collapse" href="#">
                        <i class='bx bx-crown'></i><span>My Dynasties</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="dynasty-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                        <?php
                        $sql = "SELECT * FROM dynasty WHERE userid=" . $userid;
                        $result = query($sql);
                        if ($result) {
                            $dynastylist = "";
                            foreach ($result as $row) {
                                $dynastylist .= "<li>";
                                $dynastylist .= "<a href='" . $filepath . "dynasty.php?id=" . $row['id'] . "'>";
                                $dynastylist .= "<i class='bi bi-circle'></i><span>" . $row['name'] . "</span> ";
                                $dynastylist .= "</a><a href='" . $filepath . "edit/dynasty.php?id=" . $row['id'] . "'>Edit</>";
                                $dynastylist .= "</li>";
                            }
                        }
                        echo $dynastylist;
                        ?>
                        <li>
                            <hr class="m-0">
                        </li>
                        <li class="align-items-start">
                            <a href="<?=$filepath?>mydynasties.php">
                                <i class="bi bi-circle ms-0"></i><span>View All</span>
                            </a>
                        </li>
                        <li class="align-items-start">
                            <a href="<?=$filepath?>mydynasties.php">
                                <i class="bi bi-circle ms-0"></i><span>Create Dynasty</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Components Nav -->
            <?php } ?>

            <?php if ($admin == 1) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-person-badge"></i><span>Admin</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="forms-elements.html">
                                <i class="bi bi-circle"></i><span>Edit Rosters</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?=$filepath?>admin/auditdata.php">
                                <i class="bi bi-circle"></i><span>Audit Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="forms-editors.html">
                                <i class="bi bi-circle"></i><span>Form Editors</span>
                            </a>
                        </li>
                        <li>
                            <a href="forms-validation.html">
                                <i class="bi bi-circle"></i><span>Form Validation</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Forms Nav -->
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="tables-general.html">
                            <i class="bi bi-circle"></i><span>General Tables</span>
                        </a>
                    </li>
                    <li>
                        <a href="tables-data.html">
                            <i class="bi bi-circle"></i><span>Data Tables</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Tables Nav -->


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="icons-bootstrap.html">
                            <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
                        </a>
                    </li>
                    <li>
                        <a href="icons-remix.html">
                            <i class="bi bi-circle"></i><span>Remix Icons</span>
                        </a>
                    </li>
                    <li>
                        <a href="icons-boxicons.html">
                            <i class="bi bi-circle"></i><span>Boxicons</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Icons Nav -->

            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="users-profile.html">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-faq.html">
                    <i class="bi bi-question-circle"></i>
                    <span>F.A.Q</span>
                </a>
            </li><!-- End F.A.Q Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-contact.html">
                    <i class="bi bi-envelope"></i>
                    <span>Contact</span>
                </a>
            </li><!-- End Contact Page Nav -->

            <li class="nav-item">
                <?php if ($userid != "") { ?>
                    <a class="nav-link collapsed" href="<?= $filepath ?>logout.php">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Logout</span>
                    </a>
                <?php } else { ?>
                    <a class="nav-link collapsed" href="<?= $filepath ?>signin.php">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Login</span>
                    </a>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= $filepath ?>signup.php">
                    <i class="bi bi-card-list"></i>
                    <span>Register</span>
                </a>
            </li><!-- End Register Page Nav -->
        <?php } ?>
        </li><!-- End Login Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1><?= $hero_title ?></h1>
            <nav>
                <ol id="breadcrumb" class="breadcrumb">
                </ol>
            </nav>
        </div><!-- End Page Title -->