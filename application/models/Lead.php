<?php

class Lead{
    
  public function dump($jo){
    $db = $this -> getDB('w', '');
    if($db->query("INSERT INTO dump VALUES(".$db->quote($jo).")")) {
      return 1;
    }
  }
  public function addLead($name, $phone, $addr, $occupation, $occupationdetail, $biz, $income, $pan, $aadhaar){
    $biz = $occupation == '1' ? $biz : '';
    $db = $this -> getDB('w', '');
    $time = time();
    $id = md5($time.$_POST['name'].$phone);
    if($db->query("INSERT INTO _table_leads_ccm VALUES(".$db->quote($id).", ".$db->quote($_SESSION['usr_id']).", ".$db->quote($name).",
               ".$db->quote($addr).", ".$db->quote($phone).", ".$db->quote($occupation).", ".$db->quote($occupationdetail).",
               ".$db->quote($biz).", ".$db->quote($income).", ".$db->quote($pan).", ".$db->quote($aadhaar).", 0, '', '', ".$time.", '')")) {
      return 1;
    }
    else {
      return 0;
    }
  }
  
  public function getLeads(){
    if(isset($_SESSION['usr_id']) && $_SESSION['usr_lvl'] >= 1){
      $db = $this -> getDB('r', '');
      $tmp = $db->query("SELECT _tbl_lead_id as lid, _tbl_lead_cust_name as name, _tbl_lead_cust_addr as addr, "
                      . " _tbl_lead_cust_phone as phone, _tbl_lead_cust_occupation as occupation, "
                      . " _tbl_lead_cust_occupation_sub as occupationdetail, _tbl_lead_cust_biz as biz, "
                      . " _tbl_lead_cust_income as income, _tbl_lead_cust_pan as pan, _tbl_lead_cust_aadhaar as aadhaar, "
                      . " _tbl_lead_status as sts, _tbl_lead_ref_id as user, _tbl_lead_added_on as time FROM _table_leads_ccm ORDER BY _tbl_lead_added_on LIMIT 0,20");
      $r = $tmp->fetchAll(PDO::FETCH_ASSOC);
      return '{"status": 1, "msg": '.json_encode($r).'}';
    }else {
      return '{"status": -1, "msg": "You dont\'t have enough privileges for this action"}';
    }
  }  
  public function approveLeads(){
    if(isset($_SESSION['usr_id']) && $_SESSION['usr_lvl'] >= 1){
      $leadId = $_POST['id'];
      $db = $this -> getDB('r', '');
      if($db->query("UPDATE _table_leads_ccm SET _tbl_lead_status = 1, _tbl_lead_added_by_ccmid = ".$db->quote($_SESSION['usr_id'])." WHERE _tbl_lead_id=".$db->quote($leadId))){
        return '{"status": 1, "msg": "Lead approved successfully!!"}';
      }
      else {
        return '{"status": 0, "msg": "Something went wrong please try again!!"}';
      }
    }else {
      return '{"status": -1, "msg": "You dont\'t have enough privileges for this action"}';
    }  
  }

  public function deleteLead(){
    if(isset($_SESSION['usr_id']) && $_SESSION['usr_lvl'] >= 1){
      $leadId = $_POST['id'];
      $db = $this -> getDB('r', '');
      if($db->query("UPDATE _table_leads_ccm SET _tbl_lead_status = -1, _tbl_lead_added_by_ccmid = ".$db->quote($_SESSION['usr_id'])." WHERE _tbl_lead_id=".$db->quote($leadId))){
        return '{"status": 1, "msg": "Lead deleted successfully!!"}';
      }
      else {
        return '{"status": 0, "msg": "Something went wrong please try again!!"}';
      }
    }else {
      return '{"status": -1, "msg": "You dont\'t have enough privileges for this action"}';
    }  
  }

  public function getDB($type, $db){
    return (new Model())->getDBConnection($type, $db);
  }
}


