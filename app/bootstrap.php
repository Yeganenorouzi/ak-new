<?php 
session_start();
require_once "config/config.php";
function my__autoload($classes){
  require_once "libraries/" . $classes . ".php";
}
spl_autoload_register("my__autoload");


