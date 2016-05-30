<?php

class Lead{
    
  public function addLead($name, $phone, $addr, $occupation, $occupationdetail, $biz, $income, $pan, $aadhaar){
    $biz = $occupation == '1' ? $biz : '';
    $db = $this -> getDB('r', '');
    $time = time();
    $id = md5($time.$_POST['name'].$phone);
    if($db->query("INSERT INTO _table_leads_ccm VALUES(".$db->quote($id).", '', ".$db->quote($name).",
               ".$db->quote($addr).", ".$db->quote($phone).", ".$db->quote($occupation).", ".$db->quote($occupationdetail).",
               ".$db->quote($biz).", ".$db->quote($income).", ".$db->quote($pan).", ".$db->quote($aadhaar).", 0, '', ".$db->quote($_SESSION['usr_id']).", ".$time.", '')")) {
      return 1;
    }
    else {
      return 0;
    }
  }
  
  public function getLeads(){
    $db = $this -> getDB('r', '');
    $tmp = $db->query("SELECT _tbl_lead_id as lid, _tbl_lead_cust_name as name, _tbl_lead_cust_addr as addr, "
                    . " _tbl_lead_cust_phone as phone, _tbl_lead_cust_occupation as occupation, "
                    . " _tbl_lead_cust_occupation_sub as occupationdetail, _tbl_lead_cust_biz as biz, "
                    . " _tbl_lead_cust_income as income, _tbl_lead_cust_pan as pan, _tbl_lead_cust_aadhaar as aadhaar, "
                    . " _tbl_lead_status as sts, _tbl_lead_added_by_ccmid as user, _tbl_lead_added_on as time FROM _table_leads_ccm WHERE _tbl_lead_status=0 ORDER BY _tbl_lead_added_on LIMIT 0,20");
    $r = $tmp->fetchAll(PDO::FETCH_ASSOC);
    return '{"status": 1, "msg": '.json_encode($r).'}';
  }
    
  public function approveLeads($leadId, $status){
    $db = $this -> getDB('r', '');
  }

  public function deleteLead($leadId){
      session_unset();
      session_destroy();

      header("Location: /");
      exit();
  }

  public function getDB($type, $db){
    return (new Model())->getDBConnection($type, $db);
  }
}


