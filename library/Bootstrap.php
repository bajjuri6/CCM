<?php

class Bootstrap {

    function __construct() {
        $temp_url = strtolower(trim($_SERVER['REQUEST_URI'], '/'));
        $url = explode('/', $temp_url);

        //Check for default/home and USER activity
        if (empty($url[0])) {
            if ($_SESSION['usr_id'] != '') {
                require APP_PATH . '/controllers/lead.php';
                (new leadController())->index();
            } else {
                require APP_PATH . '/controllers/index.php';
                (new indexController())->index();
            }
        } elseif ($url[0] == 'signin') {
            require APP_PATH . '/controllers/user.php';
            (new userController())->signin();
        } elseif ($url[0] == 'saveuser') {
            require APP_PATH . '/controllers/user.php';
            (new userController())->saveUser();
        } elseif ($url[0] == 'newuser') {
            require APP_PATH . '/controllers/user.php';
            (new userController())->newuser();
        } elseif ($url[0] == 'updateuserstatus') {
            require APP_PATH . '/controllers/user.php';
            (new userController())->updateUserStatus();
        } elseif ($url[0] == 'getusers') {
            require APP_PATH . '/controllers/user.php';
            (new userController())->getUsers();
        } elseif ($url[0] == 'logout') {
            require APP_PATH . '/controllers/user.php';
            (new userController())->logout();
        } elseif ($url[0] == 'users') {
            require APP_PATH . '/controllers/user.php';
            (new userController())->userPage();
        } elseif ($url[0] == 'verifyuser') {
            require APP_PATH . '/controllers/user.php';
            (new userController())->verifyUser();
        }

        //Check for LEADS activity
        elseif ($url[0] == 'leads') {
            require APP_PATH . '/controllers/lead.php';
            (new leadController())->index();
        } elseif ($url[0] == 'newlead') {
            require APP_PATH . '/controllers/lead.php';
            (new leadController())->newLead();
        } elseif ($url[0] == 'adld') {
            require APP_PATH . '/controllers/lead.php';
            echo (new leadController())->saveLead();
        } elseif ($url[0] == 'madld') {
            require APP_PATH . '/controllers/lead.php';
            echo (new leadController())->saveLeadFromMobile();
        } elseif ($url[0] == 'gtlds') {
            require APP_PATH . '/models/Lead.php';
            echo (new Lead())->getLeads();
        } elseif ($url[0] == 'aprvld') {
            require APP_PATH . '/models/Lead.php';
            echo (new Lead())->approveLeads();
        } elseif ($url[0] == 'dltld') {
            require APP_PATH . '/models/Lead.php';
            echo (new Lead())->deleteLead();
        }
    }

}
