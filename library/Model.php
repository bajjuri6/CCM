<?php

class Model{

  public function getDBConnection($type, $db) {
    if(ISLIVE){
      switch($type){
        case 'r':
        default:
          $host = 'localhost';
          break;
      }

      switch($db){
        default:
          $db = 'ccm_v0';
          break;
      }
      return (new PDO('mysql:host='.$host.';dbname='.$db, 'root', 'vivenfarms'));
    }
    else{
      switch($db){
        default:
          $db = 'ccm_v0';
          break;
      }
      return new PDO('mysql:host=localhost;dbname='.$db, 'root', 'vivenfarms');
    }
  }
}
