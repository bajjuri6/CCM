<?php

class View {

    function __construct() {
    }
    
    public function render($file,$noRender=NULL,$loadNav=true){
      if(!$noRender){  
        require APP_PATH.'/layout/header.php';
      }
      if($loadNav){
            require APP_PATH.'/layout/navigationHeader.php';
      }
      require APP_PATH.'/views/'.$file.'.php';
      require APP_PATH.'/layout/footer.php';
    }

}