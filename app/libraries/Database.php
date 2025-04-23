<?php
class Database
{
  private $localhost = DB__Host;
  private $username = DB__USER;
  private $password = DB__PASS;
  private $dbName = DB__NAME;
  private $dbh;
  private $stmt;
  private $error;

  public function __construct()
  {
    try {
      $dsn = "mysql:host=" . $this->localhost . ";dbname=" . $this->dbName . ";charset=utf8mb4";
      $options = [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES => false
      ];
      $this->dbh = new PDO($dsn, $this->username, $this->password, $options);
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      error_log("Database Connection Error: " . $this->error);
      throw new Exception("خطا در اتصال به پایگاه داده");
    }
  }

  public function query($sql)
  {
    try {
      $this->stmt = $this->dbh->prepare($sql);
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      error_log("Query Preparation Error: " . $this->error);
      throw new Exception("خطا در آماده‌سازی کوئری");
    }
  }

  public function bind($param, $value)
  {
    try {
      $type = match(true) {
        is_int($value) => PDO::PARAM_INT,
        is_bool($value) => PDO::PARAM_BOOL,
        is_null($value) => PDO::PARAM_NULL,
        default => PDO::PARAM_STR
      };
      $this->stmt->bindValue($param, $value, $type);
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      error_log("Parameter Binding Error: " . $this->error);
      throw new Exception("خطا در اتصال پارامترها");
    }
  }

  public function execute()
  {
    try {
      return $this->stmt->execute();
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      error_log("Query Execution Error: " . $this->error);
      throw new Exception("خطا در اجرای کوئری");
    }
  }

  public function fetchAll()
  {
    try {
      $this->execute();
      return $this->stmt->fetchAll();
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      error_log("FetchAll Error: " . $this->error);
      throw new Exception("خطا در دریافت اطلاعات");
    }
  }

  public function fetch()
  {
    try {
      $this->execute();
      return $this->stmt->fetch();
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      error_log("Fetch Error: " . $this->error);
      throw new Exception("خطا در دریافت اطلاعات");
    }
  }

  public function rowCount()
  {
    return $this->stmt->rowCount();
  }

  public function getLastError()
  {
    return $this->error;
  }

  public function lastInsertId()
  {
    return $this->dbh->lastInsertId();
  }
}
