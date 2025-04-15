<?php
class Database
{
  private $localhost = DB__Host;
  private $username = DB__USER;
  private $password = DB__PASS;
  private $dbName = DB__NAME;
  private $dbh;
  private $stmt;
  public function __construct()
  {
    try {
      $this->dbh = new PDO("mysql:host=" . $this->localhost . ";dbname=" . $this->dbName, $this->username, $this->password);
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
  public function query($sql)
  {
    $this->stmt = $this->dbh->prepare($sql);
  }
  public function bind($param, $value)
  {
    $this->stmt->bindParam($param, $value);
  }
  public function execute()
  {
    $this->stmt->execute();
  }
  public function fetchAll()
  {
    $this->execute();
    return $this->stmt->fetchAll();
  }
  public function fetch()
  {
    $this->execute();
    return $this->stmt->fetch();
  }
  public function rowCount()
  {
    return $this->stmt->rowCount();
  }
  public function getError()
  {
    return $this->stmt->errorInfo();
  }
  public function errorInfo()
  {
    return $this->stmt->errorInfo();
  }
}
