<?php
    //App Root
    define('APPROOT', dirname(dirname(__FILE__)));
    //URL Root
    define('URLROOT', '.');
    
    //App Version
    define('APPVERSION', '0.2.0');

    //Database Configuration
    // define('DB_HOST', 'localhost');
    // define('DB_USER', 'caresqub_care');
    // define('DB_PASS', '2r.cumdBzUEG');
    // define('DB_NAME', 'caresqub_care');

    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'advise');

    define("ADMIN_AVATAR", "https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png");

    $page_name = basename($_SERVER['PHP_SELF']);
    $split_page_name = explode(".", $page_name);
    $current_page_name = $split_page_name[0];
    
    if($current_page_name === "index"){
        $current_page_name = "home";
    }else if(strpos($current_page_name, "-")){
        $current_page_name = str_replace("-", " ", $current_page_name);
    }
       
    //Page Title
    define('PAGETITLE', ucwords($current_page_name).' - Result Checker');
    //Site Name
    define('SITENAME', "Highland Group of Schools");
    //Site Logo
    define("LOGO", "");
