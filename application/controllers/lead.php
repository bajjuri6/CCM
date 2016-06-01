<?php

class leadController extends Controller{
  function __construct() {
      parent::__construct();
  }
  
  public function index(){
    $this->view->render('index/leads');
  }
  
  public function newLead(){
    $this->view->render('index/newlead', true, false);
  }
  
  public function saveLead(){
    if((isset($_SESSION['usr_id']) && $_SESSION['usr_lvl'] >= 1) || isset($_POST['MS'])){
      require_once APP_PATH . '/models/Lead.php';
      $name = $_POST['name'];
      $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
      $addr = $_POST['addr'];
      $occupation = $_POST['occupation'];
      $occupationdetail = $_POST['occupationdetail'];
      $biz = json_encode($_POST['biz']);
      $income = $_POST['income'];
      $pan = $_POST['pan'];
      $aadhaar = $_POST['aadhaar'];
      
      if(!preg_match('/^[a-zA-Z0-9. ]+$/', $name)){
        return '{"status":0,"msg":"Full Name should contain only alphabets, numerals and space!"}';
      }
      elseif (empty($phone)) {
        return '{"status":0,"msg":"Enter a valid mobile number."}';
      }
      else {
        $leadModel = new Lead();
        $status = $leadModel ->addLead($name, $phone, $addr, $occupation, 
                                      $occupationdetail, $biz, $income, $pan, $aadhaar); 
        if($status) {
          return '{"status": 1, "msg": "Lead added successfully"}';
        } else {
          return '{"status": 0, "msg": "Something went wrong please try again!!"}';
        }
      }
    } else {
      return '{"status": -1, "msg": "You dont\'t have enough privileges to add lead"}';
    }  
  }
  
  public function edit(){
    require_once APP_PATH . '/models/userAccount.php';
    $id = $POST['id'];
    $password = $POST['password'];
    
    $userModel = new userAccount();
    return $userModel -> signin($id, $password);
  }
  
  public function all(){
    $this->view->render('index/leads');
  }
  
  
}
