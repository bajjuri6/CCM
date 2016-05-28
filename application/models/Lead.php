<?php

/**
 * userlevel -- demo(1), rcp(2), emp(3), manager(4), admin(5), owner(6)
 */
class Lead{
    
  public function addLead($name, $phone, $id, $password, $email, $addr, $region, $lvl){
    $db = $this -> getDB('w', '');
    $UId = md5($db->quote($id));
    
    $qs = "INSERT INTO _table_user_ccm VALUES ('$UId','$db->quote($name)', '$db->quote($phone)', "
        . "'$db->quote($id)', 'SHA1($db->quote($password))', '$db->quote($email)', '$db->quote($addr)', "
        . "'$db->quote($region)', 1, '$db->quote($lvl)', ".$_SESSION['usr_id'].", 'time()')";
    
    $result = $this -> getDB('w', '') -> exec($qs);

    if($result){
      return 1;
    }
    else{
      return 0;
    }
  }
  
  public function getLeads($region = null){
    $db = $this -> getDB('r', '');
    $temp = $db->query("SELECT _tbl_usr_ccmid, _tbl_usr_name, _tbl_usr_lvl FROM "
        . "_table_user_ccm WHERE _tbl_usr_ccmid = ".$db->quote($userId))
        . " AND _tbl_usr_pwd = ".$db->quote(SHA1($password))
        . " AND _tbl_usr_status = 1";
    $result = $temp->fetch(PDO::FETCH_ASSOC);

    if($result){
      setSession($result['_tbl_usr_ccmid'], $result['_tbl_usr_name'], $result['_tbl_usr_lvl']);
      return 1;
    }
    else{
      return 0;
    }
  }
    
  public function approveLeads($leadId, $status){
    $db = $this -> getDB('r', '');
    $temp = $db->query("SELECT _tbl_usr_ccmid FROM _table_user_ccm WHERE "
                      . "_tbl_usr_ccmid = ".$db->quote($userId));
    $result = $temp->fetch(PDO::FETCH_ASSOC);

    if($result){
      return true;
    }
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


