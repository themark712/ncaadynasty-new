<?php
$hero_title = "Sign In";
$hero_text = "Sign in to your account here";

require '_include/header.php';

$aryb[0][0] = "/signin.php";
$aryb[0][1] = "Sign In";
$e = "";

?>
<section class="pagetitle">
<div class="container container-page mx-auto">
    <div class="col-10">
        <p class="text-danger"><?php echo $e; ?></p>
        <form class="form" action="signinu.php" method="post">
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text w-25" id="inputGroup-sizing-sm">User Name</span>
                <input type="text" name="username" class="form-control" placeholder="username" aria-label="username" aria-describedby="inputGroup-sizing-sm" text="">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text w-25" id="inputGroup-sizing-sm">Password</span>
                <input type="password" name="password" class="form-control" placeholder="password" aria-label="password" aria-describedby="inputGroup-sizing-sm" value="">
            </div>
            <div class="input-group input-group-sm mt-3">
                <button class="btn btn-primary">Sign In</button>
            </div>
        </form>
    </div>
</div>
<section class="pagetitle">
<?php include '_include/footer.php' ?>