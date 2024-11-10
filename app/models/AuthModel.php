<?php
class AuthModel
{
  private $db;
  public function __construct()
  {
    $this->db = new DataBase;
  }



  public function findAdmin($codemelli)
  {
    try {
      $this->db->query("SELECT * FROM users WHERE codemelli = :codemelli AND admin = :admin");
      $this->db->bind(":codemelli", $codemelli);
      $this->db->bind(":admin", 1);
      $this->db->fetch();
      return $this->db->rowCount() > 0;
    } catch (Exception $e) {
      error_log("Error in findAdmin: " . $e->getMessage());
      return false;
    }
  }



  public function register($data)
  {
    try {
      $hashedPassword = password_hash($data["password"], PASSWORD_DEFAULT);
      $this->db->query("INSERT INTO `users`(`email`,`password`, `name`, `codemelli`, `mobile`, `ostan`, `shahr`, `address`, `phone`, `hours`, `codeposti`) VALUES (:email,:password,:name,:codemelli,:mobile,:ostan,:shahr,:address,:phone,:hours,:codeposti) ");
      $this->db->bind(":email", $data["email"]);
      $this->db->bind(":password", $hashedPassword);
      $this->db->bind(":name", $data["name"]);
      $this->db->bind(":codemelli", $data["codemelli"]);
      $this->db->bind(":mobile", $data["mobile"]);
      $this->db->bind(":ostan", $data["ostan"]);
      $this->db->bind(":shahr", $data["shahr"]);
      $this->db->bind(":address", $data["address"]);
      $this->db->bind(":phone", $data["phone"]);
      $this->db->bind(":hours", $data["hours"]);
      $this->db->bind(":codeposti", $data["codeposti"]);
      $this->db->execute();
      return true;
    } catch (Exception $e) {
      error_log("Registration error: " . $e->getMessage());
      return false;
    }
  }



  public function login($data)
{
    try {
        $this->db->query("SELECT * FROM users WHERE codemelli = :codemelli");
        $this->db->bind(":codemelli", $data["codemelli"]);
        $user = $this->db->fetch();

        if ($user && password_verify($data["password"], $user->password)) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['codemelli'] = $user->codemelli;
            $_SESSION['name'] = $user->name;
            $_SESSION['is_admin'] = ($user->admin == 1);
            
            return true;
        }
        return false;
    } catch (Exception $e) {
        error_log("Login error: " . $e->getMessage());
        return false;
    }
}



  public function findUserBycodemelli($codemelli)
  {
    $this->db->query("SELECT * FROM users WHERE codemelli = :codemelli");
    $this->db->bind(":codemelli", $codemelli);
    $this->db->fetch();
    return $this->db->rowCount() > 0;
  }
}
