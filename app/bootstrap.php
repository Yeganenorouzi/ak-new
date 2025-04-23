<?php
session_start();
require_once "config/config.php";

// اطمینان از اینکه autoload مربوط به Composer به درستی لود شده است
require_once __DIR__ . '/../vendor/autoload.php';

// تابع اتولود برای بارگذاری کلاس‌های داخل `libraries/`
function my__autoload($classes)
{
  $file = __DIR__ . "/libraries/" . $classes . ".php";
  if (file_exists($file)) {
    require_once $file;
  }
}
spl_autoload_register("my__autoload");
