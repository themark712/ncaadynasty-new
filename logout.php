<?php
session_start();
unset($_SESSION["userid"]);
unset($_SESSION["username"]);
unset($_SESSION["admin"]);
unset($_SESSION["dyn"]);
unset($_SESSION["prem"]);
unset($_SESSION["email"]);
header('Location: home.php');
