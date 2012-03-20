<?php

require_once('/var/www/mumcentre_sg/forum/smf_2_api.php');

class Test extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
    }
    
    function index(){
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/fb_test');
        $this->bucket->add_css('mums');
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
    }
   
    function smflogin() {

	$email_address = 'sean@bdmg.com';
        $pword = '1234';

//        $authenicated = smfapi_authenticate($email_address, $pword);
//                      if ($authenicated) {
//                              smfapi_login($email_address);
//                      }
//
//        $data = array(
//            'name' => $user_info['first_name'],
//            'avatar' => $user_info['avatar_filepath'],
//            'user_id' => $user_info['id'],
//            'smf_email' => $email_address,
//            'logged_in' => TRUE
//        );
//        $this->session->set_userdata($data);

        $authenicated = smfapi_authenticate($email_address, md5($pword), true);
        if ($authenicated) {
		echo "authenticated";
            echo smfapi_login($email_address);
        } else {
            echo "smf authentication fail<br>";
        }
	
	echo $email_address."<br>";
	echo $pword."<br>";
	}
}
?>
