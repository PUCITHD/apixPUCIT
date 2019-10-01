<?php
/**
 * User Class
 */

if (!class_exists('Database')) {
  require_once 'classes/Database.php';
}
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
    $db=new Database();
    if($db->select_single('users', array('user_name' => $this->rollno )))
    return false;
    if(!$db->insert('users', array('user_name' => $this->rollno, 'user_password' => $this->password, 'user_fname' => $this->name,'user_status'=>'pending')))
    return false;
    $user=$db->select_single('users', array('user_name' => $this->rollno ));
    $this->id=$user['user_id'];
    $this->status=$user['user_status'];
    return true;
  }
  public function sendVerifications()
  {
    $db=new Database();
    $code =md5(rand());
    if(!$db->insert('verifications', array('user_id' => $this->id, 'code' => $code)))
    return false;
    //write code to send email on signup
    return true;
  }

}
?>
