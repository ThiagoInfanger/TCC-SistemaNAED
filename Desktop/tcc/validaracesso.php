<?php
$url_login = $url_site . "login.php";

if (!isset($_SESSION['idusuario']) || $_SESSION['idusuario']=='')
{
	session_destroy();
  $url_redirect = $url_login."?origem=".urlencode($url_base.$_SERVER['REQUEST_URI']);
	header("Location: $url_redirect");
	exit;
}


?>