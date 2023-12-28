<?php
include_once "config.php";
session_destroy();
$url_padrao = $url_site . "home.php";
header("Location: $url_padrao");
exit;
?>