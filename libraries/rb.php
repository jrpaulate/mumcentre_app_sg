<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rb {

    function __construct() {
        // Include database configuration 
        include(APPPATH . '/config/database.php');
        // Get Redbean 
        include(APPPATH . '/third_party/rb/rb.php');
        // Database data 
        $host = $db[$active_group]['hostname'];
        $user = $db[$active_group]['username'];
        $pass = $db[$active_group]['password'];
        $db = $db[$active_group]['database'];
        // Setup DB connection 
        R::setup("mysql:host=$host;dbname=$db", $user, $pass);
        R::addDatabase("forums", "mysql:host=$host;dbname=mumcentre_forum_sg", $user, $pass, TRUE);
    }

//end __contruct() 
}
