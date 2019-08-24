<?php
/**
 * User Class
 */
class User
{
  private $id;
  private $rollno;
  private $password;
  private $name;
  private $status;
  function __construct($rollno,$password,$name=NULL)
  {
    $this->rollno = $rollno;
    $this->password = $password;
    if (isset($name))
      $this->name=$name;
  }
  public function signup()
  {
  }
  public function sendVerifications()
  {
    // code...
  }

}
?>
