<?php
/**
 * Insufficient permissions = -99
 * DB Success = 1 
 * DB Failed = 0
 */

class userController extends Controller{
  function __construct() {
      parent::__construct();
  }
  
  public function login(){
    $this->view->render('index/login');
  }
  
  public function newuser(){
    $this->view->render('index/adduser', true, false);
  }
  
  public function saveUser(){
    if(isset($_SESSION['usr_id']) && $_SESSION['usr_lvl'] >= 99){
      require_once APP_PATH . '/models/userAccount.php';
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $addr = $_POST['addr'];
      $lvl = $_POST['lvl'];
      $pan = $_POST['pan'];
      $aadhaar = $_POST['aadhaar'];

      $userModel = new userAccount();
      echo $userModel -> addUser($name, $phone, $password, $email, $addr, $lvl, $pan, $aadhaar);
    } else echo '{"status":-99,"msg":"You do not have sufficient previleges to do this."}';
    
  }
  
  public function signin(){
    require_once APP_PATH . '/models/userAccount.php';
    $id = $_POST['id'];
    $password = $_POST['password'];
    
    $userModel = new userAccount();
    echo $userModel -> signin($id, $password);
  }
  
  public function updateUserStatus(){
    if(isset($_SESSION['usr_id']) && $_SESSION['usr_lvl'] >= 4){
      require_once APP_PATH . '/models/userAccount.php';
      $id = $_POST['id'];
      $status = $_POST['status'];
      $userModel = new userAccount();
      return $userModel -> setUserStatus($id, $status);
    } else echo '{"status":-99,"msg":"You do not have sufficient previleges to do this."}';
  }
  
  public function getUsers($type="all"){
    if(isset($_SESSION['usr_id']) && $_SESSION['usr_lvl'] >= 4){
      if(!isset($_POST['type'])){
        $type = $_POST['type'];
      }
      require_once APP_PATH . '/models/userAccount.php';
      $userModel = new userAccount();
      echo $userModel -> getUsers($type);
    } else echo '{"status":-99,"msg":"You do not have sufficient previleges to do this."}';
    
  }
  
  public function userPage(){
    $this->view->render('index/users');
  }
  
  public function verifyUser(){
    require_once APP_PATH . '/models/userAccount.php';
    $id = $_POST['id'];
    $pan = $_POST['pan'];
    $password = $_POST['password'];
    
    $userModel = new userAccount();
    echo $userModel ->checkIfUserExists($id, $pan, $password);
  }
  
  public function logout(){
    session_unset();
    session_destroy();
    
    header("location: /");
    exit();
  }
}