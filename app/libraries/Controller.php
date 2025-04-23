<?php
class Controller
{
  public function model($model)
  {
    require_once "../app/models/" . ucwords($model) . ".php";
    return new $model;
  }
  public function view($view, $data = [])
  {
    if (file_exists("../app/views/" . $view . ".php")) {
      require_once "../app/views/" . $view . ".php";
    } else {
      die("this page is'nt available....!");
    }
  }
 
  public function redirect($path)
  {
    header("location:" . URLROOT . "/" . $path);
  }
  public function varDump($data)
  {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";  
  }
  
}