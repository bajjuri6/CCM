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
    if(isset($_SESSION['usr_id']) && $_SESSION['usr_lvl'] >= 1){
      require_once APP_PATH . '/models/Lead.php';
      $name = $POST['name'];
      $phone = $POST['phone'];
      $addr = $POST['addr'];
      $occupation = $POST['occupation'];
      $occupationdetail = $POST['occupationdetail'];
      $biz = $POST['biz'];
      $pan = $POST['pan'];
      $aadhaar = $POST['aadhaar'];
      
      $leadModel = new Lead();
      return $leadModel -> submitLead($name, $phone, $addr, $occupation, 
                                      $occupationdetail, $biz, $pan, $aadhaar);
    } else return -1;
    
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
