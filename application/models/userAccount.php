<?php

/**
 * userlevel -- demo(1), rcp(2), emp(3), manager(4), admin(5), owner(6)
 */
class userAccount{
    
  public function setSession($userId, $usr_name, $usr_lvl){
    
    $_SESSION['usr_id'] = $userId;
    $_SESSION['usr_name'] = $usr_name;
    $_SESSION['usr_lvl'] = $usr_lvl;
    $_SESSION['usr_region'] = $usr_region;
    
  }
  
  public function addUser($name, $phone, $id, $password, $email, $addr, $lvl){
    $db = $this -> getDB('w', '');
    $UId = md5($db->quote($id));
    
    $qs = "INSERT INTO _table_user_ccm VALUES ('$UId',".$db->quote($name).",". $db->quote($phone).", "
        . $db->quote($id).", ".$db->quote(SHA1($password)).", ".$db->quote($email).", ".$db->quote($addr).", "
        . "15, 1, ".$db->quote($lvl).", 'Admin',".time().")";
    $result = $db -> exec($qs);
    if($result){
      return '{"status":1,"msg":"User added successfully"}';
    }
    else{
      return '{"status":0,"msg":"Could not add user. Please try again later."}';
    }
  }
  
  public function signin($userId, $password){
    $db = $this -> getDB('r', '');
    
    $temp = $db->query("SELECT _tbl_usr_ccmid, _tbl_usr_name, _tbl_usr_lvl FROM "
        . "_table_user_ccm WHERE _tbl_usr_ccmid = ".$db->quote($userId)
        . " AND _tbl_usr_pwd = ".$db->quote(SHA1($password))
        . " AND _tbl_usr_status = 1");
    
    $result = $temp->fetch(PDO::FETCH_ASSOC);

    if($result){
      
      $this->setSession($result['_tbl_usr_ccmid'], $result['_tbl_usr_name'], $result['_tbl_usr_lvl']);
      return '{"status":1,"msg":"Signed in successfully"}';
    }
    else{
      return '{"status":0,"msg":"Username, password combo failed. Please try again."}';
    }
  }
    
  public function checkIfUserNameExists($userId){
    $db = $this -> getDB('r', '');
    $temp = $db->query("SELECT _tbl_usr_ccmid FROM _table_user_ccm WHERE "
                      . "_tbl_usr_ccmid = ".$db->quote($userId));
    $result = $temp->fetch(PDO::FETCH_ASSOC);

    if($result) return '{"status":0,"msg":"Username exists. Please try another name."}';
    else return '{"status":1,"msg":"Username available"}';
    
  }

  public function logout($urlArray){
      session_unset();
      session_destroy();

      header("Location: /");
      exit();
  }
  
  public function setUserStatus($userId, $status){
    $db = $this -> getDB('w', '');
    $qs = "UPDATE _table_user_ccm SET _tbl_usr_status = ".$db->quote($status)." WHERE _tbl_usr_ccmid = ".$db->quote($userId);
    $result = $db -> exec($qs);

    if($result) return '{"status":1,"msg":"Successfully updated user status"}';
    else return '{"status":0,"msg":"Could not update user status. Pls try again later."}';
    
  }
  
  public function getUsers($lvl){
    $db = $this -> getDB('r', '');
    $temp = $db->query("SELECT _tbl_usr_name AS name, "
        . "_tbl_usr_ccmid AS id, "
        . "_tbl_usr_phone AS phone, "
        . "_tbl_usr_email AS email, "
        . "_tbl_usr_addr AS addr, "
        . "_tbl_usr_status AS status,"
        . "_tbl_usr_lvl AS lvl "
        . "FROM _table_user_ccm");
//                      . "WHERE _tbl_usr_lvl & ".$db->quote($lvl));
    $r = $temp->fetchAll(PDO::FETCH_ASSOC);
    return '{"status": 1, "msg": '.  json_encode($r).'}';
    
    
  }

  public function getDB($type, $db){
    return (new Model())->getDBConnection($type, $db);
  }
}


