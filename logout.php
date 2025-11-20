<?php
require_once "./inc/classes/Session.php";
Session::start();
Session::destroy();
header("Location:index.php");
exit;
