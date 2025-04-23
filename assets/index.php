<?php
ob_start();  // شروع بافر خروجی
require_once "../app/bootstrap.php";
require_once "../app/helpers/helpers.php";
require_once "../vendor/autoload.php";

$core = new Core;