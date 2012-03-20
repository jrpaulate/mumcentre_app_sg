<?php

//require_once('C:/xampp/htdocs/mumcentre/forum/smf_2_api.php');

require_once('/var/www/mumcentre_sg/forum/smf_2_api.php');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->library('rb');
        $this->load->library('session');
        $this->load->library('mcapi');
        $this->load->library('common');
        $this->load->library('mcox');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('miscfuncs');
        $this->avatar_path = $this->config->item('user_avatar_gen_path');
        
        $this->mrec1 = $this->_generateTags(45);
        $this->mrec2 = $this->_generateTags(46);
        $this->mrec3 = $this->_generateTags(63);
        $this->mrec4 = $this->_generateTags(112);
        $this->mrec5 = $this->_generateTags(113);
        $this->mrec6 = $this->_generateTags(114);
        
        $this->mini_ad1 = $this->_generateTags(41);
        $this->mini_ad2 = $this->_generateTags(42);
        $this->mini_ad3 = $this->_generateTags(43);

        $this->featban = $this->_generateTags(27);
//        $this->session->set_userdata('country_id', $this->config->item('country_id'));
    }

    

    function register() {
        $this->session->set_userdata('temp_id', 0);
        if ($this->input->post('temp_name')) {
            $this->session->set_userdata('temp_name', $this->input->post('temp_name'));
        }
        if ($this->input->post('temp_email')) {
            $this->session->set_userdata('temp_email', $this->input->post('temp_email'));
        }
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/user_registration');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
        $this->bucket->add_css('registration');
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
    }

    function uploadify() {
        $file = $this->input->post('filearray');
        $json = json_decode($file);
        $data['json'] = $json;
        $id = $json->{'file_name'};
        $id = str_replace($json->{'file_ext'}, "", $id);
        $file_extension = str_replace(".", "", $json->{'file_ext'});
        $fwidth = 0;
        $fheight = 0;

        list($width, $height, $type, $attr) = getimagesize($json->{'file_path'});

        if ($width > 640) {
            $fwidth = 640;
        }
        if ($height > 480) {
            $fheight = 480;
        }

        switch ($json->{'file_ext'}) {
            case ".jpg":
            case ".jpeg":
            case ".png":
            case ".gif":
                $this->media->smart_resize_image($json->{'file_path'}, $fwidth, $fheight, false, $this->avatar_path . $id . ".jpg", false, false);
                break;
        }

        echo $id . ".jpg";
    }

    function signup() {
        $temp_id = $this->session->userdata('temp_id');
        if ($temp_id == 0) {
            $email_check = reset(R::find('user', ' email_address = ? ', array($this->input->post('email'))));
            if ($email_check) {
                echo json_encode(array('error_code' => 2));
            } else {


                $this->session->set_userdata('subscriptions', '');
                //$al = R::dispense('user_alerts');
                //$al->user_id = $id;
                //$this->alert_id = R::store($al);
                //$this->session->set_userdata('alert_id', $this->alert_id);
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $avatar = base_url().'uploaded/user/avatar/'.$this->input->post('user_avatar');

                $regOptions = array(
                    'interface' => 'guest',
                    'member_name' => $this->input->post('given_name')." ".$this->input->post('family_name'), //the variable from the form for the inputted username
                    'email' => $email, //likewise, the email address that was inputted in the form
                    'password' => $password, //the password that the user inputted
                    'password_check' => $password, //the second confirmation password inputted
                    'check_reserved_name' => true, //this will make sure that SMF first checks for a reserved name before writing the user to the database
                    'check_password_strength' => false,
                    'check_email_ban' => true, //checks for ban on the email address that was inputted
                    'send_welcome_email' => false, //true if you want SMF to send an email, false if you want your other software to handle it.  I'd recommend false.
                    'require' => 'nothing',
                    'extra_register_vars' => array(),
                    'theme_vars' => array(),
		    'avatar' => $avatar
                );

                $smf_id = smfapi_registerMember($regOptions);


                $user = R::dispense("user_signup");
                $user->smf_id = $smf_id;
                $user->first_name = $this->input->post('given_name');
                $user->last_name = $this->input->post('family_name');
                $user->birth_date = date("Y-m-d H:i:s", strtotime($this->input->post('dob')));
                $user->gender = $this->input->post('gender');
                $user->email_address = $email;
                $user->location = $this->input->post('loc');
                $user->password = md5($this->input->post('password'));
                $user->avatar_filepath = $this->input->post('user_avatar');
                $user->subscription_info = -1;
                $user->alerts_info = -1;
                $user->fb_user_id = 0;
                $user->created_date = date("Y-m-d H:i:s");

                $id = R::store($user);
                $this->session->set_userdata('temp_id', $id);
                $this->session->set_userdata('temp_email', $email);

                echo json_encode(array("error_code" => 0));
            }
        } else {//$_POST['']
            $subscriptions = "";
            $temp_user = R::load('user_signup', $temp_id);
            if ($temp_user->subscription_info == -1) {
                $temp_user->subscription_info = 0;
                if ($this->input->post('newsletter')) {
                    $temp_user->subscription_info += 1;
                    if($subscriptions == ""){
                        $subscriptions .= "Weekly Newsletter";
                    } else {
                        $subscriptions .= ",Weekly Newsletter";
                    }
                }
                if ($this->input->post('weekend_planner')) {
                    $temp_user->subscription_info += 2;
                    if($subscriptions == ""){
                        $subscriptions .= "Weekend Planner";
                    } else {
                        $subscriptions .= ",Weekend Planner";
                    }
                }
                if ($this->input->post('partner_news')) {
                    $temp_user->subscription_info += 4;
                    if($subscriptions == ""){
                        $subscriptions .= "Partner News";
                    } else {
                        $subscriptions .= ",Partner News";
                    }
                }
                if ($this->input->post('pow_results')) {
                    $temp_user->subscription_info += 8;
                    if($subscriptions == ""){
                        $subscriptions .= "Pic of the Week Results";
                    } else {
                        $subscriptions .= ",Pic of the Week Results";
                    }
                }
                if ($this->input->post('preg_guide')) {
                    $temp_user->subscription_info += 16;
                    if($subscriptions == ""){
                        $subscriptions .= "Pregnancy Guide";
                    } else {
                        $subscriptions .= ",Pregnancy Guide";
                    }
                }
                if ($this->input->post('pc_dev_guide')) {
                    $temp_user->subscription_info += 32;
                    if($subscriptions == ""){
                        $subscriptions .= "Parent-Child Development Guide";
                    } else {
                        $subscriptions .= ",Parent-Child Development Guide";
                    }
                }
                if ($this->input->post('vacation_guide')) {
                    $temp_user->subscription_info += 64;
                    if($subscriptions == ""){
                        $subscriptions .= "Vacation Guide";
                    } else {
                        $subscriptions .= ",Vacation Guide";
                    }
                }
                if ($this->input->post('bday_planner')) {
                    $temp_user->subscription_info += 128;
                    if($subscriptions == ""){
                        $subscriptions .= "Birthday Planner";
                    } else {
                        $subscriptions .= ",Birthday Planner";
                    }
                }
                $this->session->set_userdata('subscriptions', $subscriptions);
                R::store($temp_user);
                if ($this->input->post('child_fname1')) {
                    $child = R::dispense("user_signup_children");
                    $child->name = $this->input->post('child_fname1');
                    $child->gender = $this->input->post('child_gender1');
                    $child->birth_date = date("Y-m-d H:i:s", strtotime($this->input->post('child_dob1')));
                    $child->parent_id = $temp_id;
                    R::store($child);
                }
                if ($this->input->post('child_fname2')) {
                    $child = R::dispense("user_signup_children");
                    $child->name = $this->input->post('child_fname2');
                    $child->gender = $this->input->post('child_gender2');
                    $child->birth_date = date("Y-m-d H:i:s", strtotime($this->input->post('child_dob2')));
                    $child->parent_id = $temp_id;
                    R::store($child);
                }
                if ($this->input->post('child_fname3')) {
                    $child = R::dispense("user_signup_children");
                    $child->name = $this->input->post('child_fname3');
                    $child->gender = $this->input->post('child_gender3');
                    $child->birth_date = date("Y-m-d H:i:s", strtotime($this->input->post('child_dob3')));
                    $child->parent_id = $temp_id;
                    R::store($child);
                }
                if ($this->input->post('pregnant')) {
                    $pregnant = R::dispense("user_signup_pregnant");
                    $pregnant->user_id = $temp_id;
                    $pregnant->due_date = date("Y-m-d H:i:s", strtotime($this->input->post('due_date')));
                    R::store($pregnant);
                }
                echo json_encode(array("error_code" => 0));
                
//                $listID = 'ec383af104'; //Singapore Newsletter
//                $listID = '';
                   
//                $retval = $this->mcapi->listSubscribe($listID, $email);
            } else {
                $temp_user = R::load('user_signup', $temp_id);
                $temp_user_data = $temp_user->export();
                $user = R::dispense('user');
                $user->import($temp_user_data, 'first_name,last_name,birth_date,gender,email_address,location,password,avatar_filepath,subscription_info,fb_user_id,smf_id');
                $user->created_date = date("Y-m-d H:i:s");
                $user_id = R::store($user);
//                $this->alert['id'] = $user_id;
                $data = array('user_id' => $user_id);
                $this->session->set_userdata($data);

                $temp_user_children = R::find('user_signup_children', ' parent_id = ?', array($temp_id));
                foreach ($temp_user_children as $id => $child) {
                    $child_data = $child->export();
                    $user_child = R::dispense('user_children');
                    $user_child->import($child_data, 'name,gender,birth_date');
                    $user_child->parent_id = $user_id;
                    R::store($user_child);
                    R::trash($child);
                }

                $pu = R::find('user_signup_pregnant', ' user_id = ?', array($temp_id));
                foreach ($pu as $id => $p) {
                    $p_data = $p->export();
                    $pregnant_user = R::dispense('pregnant_users');
                    $pregnant_user->import($p_data, 'due_date');
                    $pregnant_user->user_id = $user_id;
                    R::store($pregnant_user);
                    R::trash($p);
                }

                R::trash($temp_user);
                echo json_encode(array("error_code" => 0));
            }
        }
    }

    function signup_fb() {
        $temp_id = $this->session->userdata('temp_id');
        if ($temp_id == 0) {
            $user = R::dispense("user_signup");
            $user->first_name = $this->input->post('given_name');
            $user->last_name = $this->input->post('family_name');
            $user->birth_date = date("Y-m-d H:i:s", strtotime($this->input->post('dob')));
            $user->gender = $this->input->post('gender');
            $user->email_address = $this->input->post('email');
            $user->location = $this->input->post('loc');
            $user->avatar_filepath = $this->input->post('user_avatar');
            $user->subscription_info = -1;
            $user->alerts_info = -1;
            $user->fb_user_id = $this->input->post('fb_id');
            $user->created_date = date("Y-m-d H:i:s");
            $id = R::store($user);
            $this->session->set_userdata('temp_id', $id);
            echo json_encode(array("error_code" => 0));



            /*             * * smf hook for registration ** */
        } else {//$_POST['']
            $temp_user = R::load('user_signup', $temp_id);
            if ($temp_user->subscription_info == -1) {
                $temp_user->subscription_info = 0;
                if ($_POST['newsletter']) {
                    $temp_user->subscription_info += 1;
                }
                if ($_POST['weekend_planner']) {
                    $temp_user->subscription_info += 2;
                }
                if ($_POST['partner_news']) {
                    $temp_user->subscription_info += 4;
                }
                if ($_POST['pow_results']) {
                    $temp_user->subscription_info += 8;
                }
                if ($_POST['preg_guide']) {
                    $temp_user->subscription_info += 16;
                }
                if ($_POST['pc_dev_guide']) {
                    $temp_user->subscription_info += 32;
                }
                if ($_POST['vacation_guide']) {
                    $temp_user->subscription_info += 64;
                }
                if ($_POST['bday_planner']) {
                    $temp_user->subscription_info += 128;
                }
                R::store($temp_user);
                if ($this->input->post('child_fname1')) {
                    $child = R::dispense("user_signup_children");
                    $child->name = $this->input->post('child_fname1');
                    $child->gender = $this->input->post('child_gender1');
                    $child->birth_date = date("Y-m-d H:i:s", strtotime($this->input->post('child_dob1')));
                    $child->parent_id = $temp_id;
                    R::store($child);
                }
                if ($this->input->post('child_fname2')) {
                    $child = R::dispense("user_signup_children");
                    $child->name = $this->input->post('child_fname2');
                    $child->gender = $this->input->post('child_gender2');
                    $child->birth_date = date("Y-m-d H:i:s", strtotime($this->input->post('child_dob2')));
                    $child->parent_id = $temp_id;
                    R::store($child);
                }
                if ($this->input->post('child_fname3')) {
                    $child = R::dispense("user_signup_children");
                    $child->name = $this->input->post('child_fname3');
                    $child->gender = $this->input->post('child_gender3');
                    $child->birth_date = date("Y-m-d H:i:s", strtotime($this->input->post('child_dob3')));
                    $child->parent_id = $temp_id;
                    R::store($child);
                }
                if ($this->input->post('pregnant')) {
                    $pregnant = R::dispense("user_signup_pregnant");
                    $pregnant->user_id = $temp_id;
                    $pregnant->due_date = date("Y-m-d H:i:s", strtotime($this->input->post('due_date')));
                    R::store($pregnant);
                }
                echo json_encode(array("error_code" => 0));
            } else {
                $temp_user = R::load('user_signup', $temp_id);
                $temp_user_data = $temp_user->export();
                $user = R::dispense('user');
                $user->import($temp_user_data, 'first_name,last_name,birth_date,gender,email_address,location,password,avatar_filepath,subscription_info,fb_user_id');
                $user->created_date = date("Y-m-d H:i:s");
                $user_id = R::store($user);
                $data = array('user_id' => $user_id);
                $this->session->set_userdata($data);

                $listID = "2e3861cf16"; // obtained by calling lists();
                $retval = $this->mcapi->listSubscribe($listID, $email);

                $temp_user_children = R::find('user_signup_children', ' parent_id = ?', array($temp_id));
                foreach ($temp_user_children as $id => $child) {
                    $child_data = $child->export();
                    $user_child = R::dispense('user_children');
                    $user_child->import($child_data, 'name,gender,birth_date');
                    $user_child->parent_id = $user_id;
                    R::store($user_child);
                    R::trash($child);
                }

                $pu = R::find('user_signup_pregnant', ' user_id = ?', array($temp_id));
                foreach ($pu as $id => $p) {
                    $p_data = $p->export();
                    $pregnant_user = R::dispense('pregnant_users');
                    $pregnant_user->import($p_data, 'due_date');
                    $pregnant_user->user_id = $user_id;
                    R::store($pregnant_user);
                    R::trash($p);
                }

                R::trash($temp_user);
                echo json_encode(array("error_code" => 0));
            }
        }
    }

    function alerts() {
        $alert_groups = '';
        $alert_schedule = '';
//        $alert_id = $this->session->userdata('alert_id');
        //$alert = R::load("user_alerts", $this->session->userdata('alert_id'));
        $email = $this->session->userdata('temp_email');
        $alert = R::dispense('user_alert');
        $alert->user_id = $this->session->userdata('temp_id');
        if ($this->input->post('articles')) {
            $alert->has_article = 1;
            if($alert_groups == ""){
                        $alert_groups .= "Articles";
                    } else {
                        $alert_groups .= ",Articles";
                    }
        }
        if ($this->input->post('reviews')) {
            $alert->has_reviews = 1;
            if($alert_groups == ""){
                        $alert_groups .= "Reviews";
                    } else {
                        $alert_groups .= ",Reviews";
                    }
        }
        if ($this->input->post('programs')) {
            $alert->has_programs = 1;
            if($alert_groups == ""){
                        $alert_groups .= "Programs";
                    } else {
                        $alert_groups .= ",Programs";
                    }
        }
        if ($this->input->post('curriculum')) {
            $alert->has_curriculum = 1;
            if($alert_groups == ""){
                        $alert_groups .= "Curriculum";
                    } else {
                        $alert_groups .= ",Curriculum";
                    }
        }
        if ($this->input->post('events')) {
            $alert->has_events = 1;
            if($alert_groups == ""){
                        $alert_groups .= "Events";
                    } else {
                        $alert_groups .= ",Events";
                    }
        }
        
        $country_id = $this->config->item('country_id');
        
            //Singapore Alerts
                if ($this->input->post('mon')) {
                    $alert->week_day = 0;
//                    $listID = 'e2cd8da598';
                      $alert_schedule = "Monday";                  
                }
                if ($this->input->post('tue')) {
                    $alert->week_day = 1;
//                    $listID = 'dca3ded258';
                    $alert_schedule = "Tuesday";
                }
                if ($this->input->post('wed')) {
                    $alert->week_day = 2;
//                    $listID = '18f709ccb1';
                    $alert_schedule = "Wednesday";
                }
                if ($this->input->post('thur')) {
                    $alert->week_day = 3;
//                    $listID = '92fee60184';
                    $alert_schedule = "Thursday";
                }
                if ($this->input->post('fri')) {
                    $alert->week_day = 4;
//                    $listID = 'b8f7cb3086';
                    $alert_schedule = "Friday";
                }
                if ($this->input->post('sat')) {
                    $alert->week_day = 5;
//                    $listID = '0a81999a51';.
                    $alert_schedule = "Saturday";
                }
                if ($this->input->post('sun')) {
                    $alert->week_day = 6;
//                    $listID = '071a800324';
                    $alert_schedule = "Sunday";
                }
                if ($this->input->post('daily')) {
                    $alert->week_day = 7;
//                    $listID = '934af5142d';
                    $alert_schedule = "Daily";
                }
                //Philippines Alerts
//                if ($this->input->post('mon')) {
//                    $alert->week_day = 0;
//                    $listID = '177ec561a1';
//                }
//                if ($this->input->post('tue')) {
//                    $alert->week_day = 1;
//                    $listID = '1620a79c66';
//                }
//                if ($this->input->post('wed')) {
//                    $alert->week_day = 2;
//                    $listID = 'f1837c494e';
//                }
//                if ($this->input->post('thur')) {
//                    $alert->week_day = 3;
//                    $listID = 'bd9be673fb';
//                }
//                if ($this->input->post('fri')) {
//                    $alert->week_day = 4;
//                    $listID = '6a9657c476';
//                }
//                if ($this->input->post('sat')) {
//                    $alert->week_day = 5;
//                    $listID = '3432f1bc4c';
//                }
//                if ($this->input->post('sun')) {
//                    $alert->week_day = 6;
//                    $listID = 'cbdccb0405';
//                }
//                if ($this->input->post('daily')) {
//                    $alert->week_day = 7;
//                    $listID = '90611e4dd8';
//                }
              
             //Malaysia Alerts
//                if ($this->input->post('mon')) {
//                    $alert->week_day = 0;
//                    $listID = '2248ce243b';
//                }
//                if ($this->input->post('tue')) {
//                    $alert->week_day = 1;
//                    $listID = '36dd35bae1';
//                }
//                if ($this->input->post('wed')) {
//                    $alert->week_day = 2;
//                    $listID = '2cc0d197d7';
//                }
//                if ($this->input->post('thur')) {
//                    $alert->week_day = 3;
//                    $listID = '49aa08c5bf';
//                }
//                if ($this->input->post('fri')) {
//                    $alert->week_day = 4;
//                    $listID = '459af310d8';
//                }
//                if ($this->input->post('sat')) {
//                    $alert->week_day = 5;
//                    $listID = '4ffa9de20b';
//                }
//                if ($this->input->post('sun')) {
//                    $alert->week_day = 6;
//                    $listID = 'e97864791f';
//                }
//                if ($this->input->post('daily')) {
//                    $alert->week_day = 7;
//                    $listID = '6436520bb8';
//                }
         $listID = '2e3861cf16';       
        $mergeVars = array(
                'GROUPINGS' => array(
                array('id'=>'3145', 'groups'=>$this->session->userdata('subscriptions')),
                array('id'=>'3209', 'groups'=>$alert_groups),
                array('id'=>'3149', 'groups'=>$alert_schedule)
                    
            )
        );        
//        echo $this->session->userdata('subscriptions');
        $retval = $this->mcapi->listSubscribe($listID,$email,$mergeVars);
//        
//        if ($this->mcapi->errorCode){  
//
//            echo "Unable to subscribe email using listSubscribe()!";  
//            echo "\n\tCode=".$this->mcapi->errorCode;  
//            echo "\n\tMsg=".$this->mcapi->errorMessage."\n";  
//
//        }else{  
//
//            echo $email." added successfully\n";  
//
//        }
        R::store($alert);
        echo json_encode(array("error_code" => 0));
//        echo $this->session->userdata('subscriptions');
    }

    function register_fb() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/user_registration_fb');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
        $this->bucket->add_css('registration');
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
    }

    function fb_check($fb_id) {
        $user = R::getAll("SELECT id
    FROM user
    WHERE fb_user_id = '" . $fb_id . "'
    ");
        if (empty($user)) {
            echo '0';
        } else {
            echo '1';
        }
    }

    function set_session() {
        $name = $this->input->post('fb_name');
        $fb_id = $this->input->post('fb_id');
        $data = array(
            'name' => $name,
            'fb_id' => $fb_id,
            'logged_in' => TRUE
        );
        $this->session->set_userdata($data);
    }

    function set_session_2() {
        $email_address = $this->input->post('email');
        $pword = $this->input->post('password');
        $user_info = $this->_user_info($email_address);

//        $authenicated = smfapi_authenticate($email_address, md5($pword), true);
//			if ($authenicated) {
				smfapi_login($email_address);
//			}
//        
//        $data = array(
//            'name' => $user_info['first_name'],
//            'avatar' => $user_info['avatar_filepath'],
//            'user_id' => $user_info['id'],
//            'smf_email' => $email_address,
//            'logged_in' => TRUE
//        );
//        $this->session->set_userdata($data);

        $user = R::getRow("SELECT id AS user_id, first_name AS name, last_name, avatar_filepath AS avatar, smf_id FROM user WHERE email_address='" . $email_address . "'");

//        $authenicated = smfapi_authenticate($email_address, md5($pword), true);
//        if ($authenicated) {
//            smfapi_login($email_address);
//            $this->session->set_userdata('smf_email', $email_address);
//        } else {
//            echo "smf authentication fail";
//        }
	$this->session->set_userdata('smf_email', $email_address);
        $this->session->set_userdata($user);
        $this->session->set_userdata('logged_in', TRUE);
    }

    private function _user_info($email_address) {
        $meta = R::getRow("SELECT id, first_name, last_name, avatar_filepath
            FROM user
            WHERE email_address = '" . $email_address . "'"
        );
        return $meta;
    }

    function logout() {
        $smfemail = $this->session->userdata('smf_email');

        smfapi_logout($smfemail);

        $this->session->sess_destroy();
    }

    function crop() {
        $orig_image = 'uploaded/user/avatar/' . $this->input->post('avatar');
        $crop_image = 'uploaded/user/avatar/cropped-' . $this->input->post('avatar');
        $cropped_image = 'cropped-' . $this->input->post('avatar');
        $cropped = cropImage($orig_image, $crop_image, $this->input->post('wd'), $this->input->post('ht'), $this->input->post('x1'), $this->input->post('y1'));
//        $cropped = cropImage($orig_image,$crop_image, $this->input->post('wd'), $this->input->post('ht'), $this->input->post('x1'), $this->input->post('y1'));  
        echo $cropped_image;
//        $orig_image = 'uploaded/test/koalabear.jpg';
//        $crop_image = 'uploaded/test/cropped-koalabear.jpg';        
//        printr(array(APPPATH, BASEPATH, $orig_image, $crop_image));
//        
//        cropImage ( $orig_image, $crop_image, 368, 275, 346,314);
//        
    }

/*
    function login() {
        $email_address = $this->input->post('email_address');
        $password = $this->input->post('password');
        $user_salt = R::getRow("SELECT salt from user WHERE email_address = '".$email_address."'");
        
        $encrypted_password = $this->_encrypt_password($password, $user_salt['salt']);
        $user = reset(R::find('user', ' email_address = ? and password = ?', array($email_address, $encrypted_password)));
        if ($user) {
            $response['code'] = 1;
            $response['message'] = 'Logging in...';
        } else {
            $response['code'] = -1;
            $response['message'] = 'Invalid email address / password.';
        }

        echo $response['code'] . ":" . $response['message'];
    }

*/

    function login() {
	$email_address = $this->input->post('email_address');
        $password = $this->input->post('password');
	$valid_user = false;

	$sql="
	  SELECT 
	      id
	    , IFNULL(user_name,'') AS user_name
	    , password
	    , IFNULL(salt,'') AS salt
	  FROM user 
	  WHERE email_address ='".$email_address."'
	";
	$user_info = R::getRow($sql);

	if($user_info){	
	  $user_id=$user_info['id'];
	  $salt= $user_info['salt'];
	  $enc_password = $this->_encrypt_password($password, $salt);
	  if ($enc_password == $user_info['password']){
	    $valid_user=true;

	    // update login history
            $sql="
              UPDATE user
                SET last_login=NOW()
                  , login_count=IFNULL(login_count,0) + 1
		  , login_option='1' 
              WHERE id=".$user_id;
            R::exec($sql);

	  } elseif ($this->_check_alternate_password($user_id,$password)){
	    $valid_user=true;

	    // update password and history in user table 
	    $sql="
	      UPDATE user 
		SET password='".$enc_password."'
		  , salt='".$salt."'
		  , last_login=NOW()
                  , login_count=IFNULL(login_count,0) + 1
                  , login_option='2'
	      WHERE id=".$user_id;
	    R::exec($sql);
	  } 
	}

	if($valid_user == true){
	    $response['code'] = 1;
            $response['message'] = 'Logging in...';
	} else {
	    $response['code'] = -1;
            $response['message'] = 'Invalid email address / password.';
	}
        
        echo $response['code'] . ":" . $response['message'];
    } 

    private function _check_alternate_password($user_id, $password) {
	$sql="
	  SELECT
	    user_id
	  , jos_password
	  , pg_password
	  , vb_password
	  , vb_salt
	  FROM user_altpassword
	  WHERE user_id=".$user_id;

	$user_info=R::getRow($sql);
	if(!$user_info){
	  return false;
	}

	$ee_password=$this->_encrypt_password($password, $user_info['vb_salt']); //extended encrypted password
	$se_password=md5($password); //simple encrypted password

	// check VB password
	if($ee_password == $user_info['vb_password']){
	  return true;
	}

	// check PG password
	if($se_password == $user_info['pg_password']){
	  return true;
	}

	// check JOS password
	if($se_password == $user_info['jos_password']){
          return true;
        }
	return false;
    }

    private function _getGender($gender) {
        if ($gender == 1) {
            $g = 'Female';
        } else {
            $g = 'Male';
        }

        return $g;
    }

    

    function user_alerts_check($user_id) {
        echo '{"user_alerts": [{' . $this->_user_alerts_check($user_id) . '}]}';
    }

    private function _user_alerts_check($user_id) {
        $alerts = R::getRow("SELECT age_group, has_article, has_events, has_curriculum, has_reviews, has_programs, has_products, has_forums
    FROM user_alerts
    WHERE user_id = " . $user_id . ""
        );

        return '"alerts":' . json_encode($alerts);
    }

    function load_alerts($content_id) {
        echo '{"load_alerts": [{' . $this->_load_alerts($content_id) . '}]}';
    }

    private function _load_alerts($content_id) {
        $alerts = R::getAll("SELECT a.title as alert_title, a.summary as alert_summary, a.url as alert_url 
    FROM alert as a
    WHERE a.content_id = " . $content_id . "    
    "
        );

        foreach ($alerts as &$a) {
            $a['alert_summary'] = $this->_trimSummary($a['alert_summary']);
        }

        return '"alerts":' . json_encode($alerts);
    }

    private function _trimSummary($article_summary) {
        $trimmed_summary = strlen($article_summary) > 59 ? substr($article_summary, 0, 56) . "..." : $article_summary;
//      $dashed_summary = str_replace(' ', '-', $trimmed_summary);
//      return $dashed_summary;
        return $trimmed_summary;
    }

    function manual_invite() {
//        $email1 = $this->input->post('email1');
//        $email2 = $this->input->post('email2');
//        $email3 = $this->input->post('email3');
//        $email4 = $this->input->post('email4');
//        $email5 = $this->input->post('email5');
        $email_address = $this->input->post('email_adds');
        $sender_email = $this->input->post('sender_email');
//        $email_addresses = implode(",", $email_address);
        $email_subject = $this->input->post('email_subject');
        $email_body = $this->input->post('email_body');
        $email_sender = $this->input->post('sender');

        $this->load->library('email');
        $this->config->load('email');

        $this->email->from($this->config->item('email_from_address'), $email_sender);
        $this->email->to($email_address, $sender_email);
        $this->email->subject($email_subject);
        $this->email->message($email_body);

        if (!$this->email->send()) {
            $response['code'] = -3;
            $response['message'] = "Unable to send email to " . $email_address . "," . $sender_email;
//            $response['message'] = $this->email->print_debugger();
            $data['signup_error_msg'] = "<br/>Unable to send email.";
            $success = FALSE;
//            echo $this->email->print_debugger();
        } else {
            $response['code'] = 0;
            $response['message'] = "An email has been sent to the addresses you provided.";
        }

//        echo $response['code'] . ":" . $this->email->print_debugger();
        echo $response['code'] . ":" . $response['message'];
    }

    function request_reset_pass() {
        $email_check = reset(R::find('user', ' email_address = ? ', array($this->input->post('email'))));
        if (!$email_check) {
            $response['code'] = -2;
            $response['message'] = "Email is not registered.";
        } else {
            $email_address = $this->input->post('email');
            $user = R::getRow("SELECT id, first_name, salt
                FROM user
                WHERE email_address = '" . $email_address . "'"
            );
            $reset_pass_key = $this->common->generate_password();
            $encrypted_password = md5(md5($reset_pass_key).$user['salt']);
            $first_name = $user['first_name'];

            $this->load->library('email');
            $this->config->load('email');
            $this->email->set_newline("\r\n");

            $this->email->from($this->config->item('email_from_address'), $this->config->item('email_from_name'));
            $this->email->to($email_address);
            $this->email->subject('Mumcentre - Reset Password');
            $email_message = "
                    <html>
                    <body>
                    Hi " . $first_name . ",
                    <br><br>
                    Here is your new password:
                    <br><br>
                    " . $reset_pass_key . "
                    <br><br>
                    Don't forget to change your password at the profile page after logging-in.
                    <br><br>
                    Thank you,
                    <br>
                    Mumcentre™ Administrator
                    </body>
                    </html>
                ";

            $this->email->message($email_message);

            if (!$this->email->send()) {
                $response['code'] = -3;
                $response['message'] = "Unable to send email.";
            } else {
                $reset = R::load('user', $user['id']);
                $reset->password = $encrypted_password;
                R::store($reset);

                $response['code'] = 0;
                $response['message'] = 'Request for reset password successful. Check your email for details.';
            }
        }
        echo $response['code'] . ":" . $response['message'];
    }

    function change_pass() {
        $new_pass = $this->input->post('new_pass');
        $user_id = $this->input->post('user_id');
        
        $user = R::getRow("SELECT salt
                FROM user
                WHERE id = " . $user_id
            );

        $change = R::load('user', $user_id);
        $change->password = md5(md5($new_pass).$user['salt']);
        R::store($change);
        
        echo 'Change password successful.';
    }

    function advertise_now(){
		$emails = array('listings-ph@bdmg.com','listings-sg@bdmg.com','listings-my@bdmg.com','listings-au@bdmg.com');
		//'jan@en-gageinc.com','april@en-gageinc.com'
		//'listings-ph@bdmg.com','listings-sg@bdmg.com','listings-my@bdmg.com','listings-au@bdmg.com'
		$comp_name = $this->input->post('comp_name');
		$contact_name = $this->input->post('contact_name');
		$industry = $this->input->post('industry');
		$budget = $this->input->post('budget');
		$email_add = $this->input->post('email_add');
		$contact_number = $this->input->post('contact_number');
		$msg = $this->input->post('msg');
		
                $this->load->library('email');
                $this->config->load('email');
                $this->email->set_newline("\r\n");
                
		$this->email->from($email_add);
		$this->email->to('listings-sg@bdmg.com');
		$this->email->subject('Mumcentre - Advertisement Subscriber');
		$email_message = "
			<html>
			<body>
			<table border='0' cellspacing=''>
				<tr>
					<td colspan='2'><strong>Advertisement Subscriber</strong></td>
				</tr>
				<tr>
					<td><strong>Company Name :</strong></td>
					<td>".$comp_name."</td>
				</tr>
				<tr>
					<td><strong>Contact Name :</strong></td>
					<td>".$contact_name."</td>
				</tr>
				<tr>
					<td><strong>Industry :</strong></td>
					<td>".$industry."</td>
				</tr>
				<tr>
					<td><strong>Budget :</strong></td>
					<td>".$budget."</td>
				</tr>
				<tr>
					<td><strong>Email Address :</strong></td>
					<td>".$email_add."</td>
				</tr>
				<tr>
					<td><strong>Contact Number :</strong></td>
					<td>".$contact_number."</td>
				</tr>
				<tr>
					<td><strong>Message :</strong></td>
					<td>".$msg."</td>
				</tr>
			</table>
			</body>
			</html>
        ";
		$this->email->message($email_message);
		if(!$this->email->send()){
			echo "Unable to send request";
		}
		else{
			echo "Email sent. Please wait till we get back at you using the contact you provided.";
		}
	}
        
    private function _encrypt_password($password, $salt){
        return md5(md5($password).$salt);
    }
	
	
	
	 
 function profile() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/profile');
       $this->bucket->add_css('mums');
       $this->bucket->add_css('layout');
       $this->bucket->add_css('mystyle');
        $this->bucket->set_data('title', "Mumcentre");
        
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        
        $this->bucket->render_layout();
    }





function profile_data($user_id) {
        echo '{"profile_data": [{' . $this->_profile($user_id) . '}]}';
    }

    private function _profile($user_id) {
        $profile = R::getRow("SELECT first_name
         ,u.last_name
         ,u.birth_date
         ,u.gender
         ,u.location
         ,u.avatar_filepath
         ,u.email_address
         ,u.biography 
         ,u.occupation 
         ,u.hobbies
         ,u.celphone
         ,u.landline
         ,c.name AS country
         ,u.country_id 
    FROM user AS u
    INNER JOIN country AS c
    ON u.country_id = c.id
    WHERE u.id = " . $user_id . " 
    ");

	$profile['gender_number'] = $profile['gender'];
        $profile['gender'] = $this->_getGender($profile['gender']);


        return '"profile":' . json_encode($profile);
    }






 function child_data($user_id) {
        echo '{"child_data": [{' . $this->_child($user_id) . '}]}';
    }

    private function _child($user_id) {
        $sql="SELECT c.id AS child_id,
        c.name AS name, 
        c.birth_date, 
        c.gender,
        c.avatar_filepath 
        FROM user_children AS c
        WHERE c.parent_id = ". $user_id;
        
         $child = R::getAll($sql);

        foreach ($child AS &$c) {
            $c['gender'] = $this->_getGender($c['gender']);
        }
        return '"child":' . json_encode($child);
    }

    function profile_children() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/profile_children');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
        $this->bucket->add_css('mystyle');
        $this->bucket->set_data('title', "Mumcentre");
        
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        
        $this->bucket->render_layout();
    }

    function profile_alerts() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/profile_alerts');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
         $this->bucket->add_css('mystyle');
        $this->bucket->set_data('title', "Mumcentre");
        
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        
        $this->bucket->render_layout();
    }
    
    
    function profile_edit() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/profile_edit');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
        
        $this->bucket->add_css('mystyle');
        $this->bucket->set_data('title', "Mumcentre");
        
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        
        $this->bucket->render_layout();
    }
    
    
    function profile_pow() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/profile_pow');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
         $this->bucket->add_css('mystyle');
        $this->bucket->set_data('title', "Mumcentre");
        
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        
        $this->bucket->render_layout();
    }

    
    

    function profile_subscription() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/profile_subscription');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
        $this->bucket->set_data('title', "Mumcentre");
        
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        
        $this->bucket->render_layout();
    }

    function profile_forums() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/profile_forums');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
         $this->bucket->add_css('mystyle');
        $this->bucket->set_data('title', "Mumcentre");
        
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        
        $this->bucket->render_layout();
    }
    
    
    
     function profile_children_edit() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/profile_children_edit');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
        $this->bucket->add_css('mystyle');
        $this->bucket->set_data('title', "Mumcentre");
        
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        
        $this->bucket->render_layout();
    }






function children_data($child_id) {
        echo '{"children_data": [{' . $this->_children($child_id) . '}]}';
    }

    private function _children($child_id) {
        $children = R::getAll("SELECT c.id AS child_id,
        c.name AS name, 
        c.birth_date, 
        c.gender, 
        c.parent_id, 
        c.avatar_filepath 
        FROM user_children As c
        WHERE c.id = $child_id");

        foreach ($children AS &$children) {
            $children['gender'] = $this->_getGender($children['gender']);
        }
        return '"children":' . json_encode($children);
    }
    
    
    
    function force_delete($id){
        
        $child = R::load('user_children',$id);
   
        
        $id = R::trash($child);
        
        $response['code'] = 0;
        $response['message'] = "Status Successfully Updated.";

        echo $response['code'] . ":" . $response['message'] ;  
        
        
    }
    
    private function _generateTags($zoneId) {
        $ajs = "http://50.19.248.24/openx/www/delivery/ajs.php";
        $loc = urlencode(current_url());
        $cb = rand(0, 99999999999);
        return '<script type="text/javascript" src="' . $ajs . '?zoneid=' . $zoneId .
                '&amp;cb=' . $cb . '&amp;charset=ISO-8859-1&amp;loc=' . $loc . '"></script>';
    }

    function forum_list($id) {
        echo '{"forum_list": [{' . $this->_forum_list($id) . '}]}';
    }

    
    private function _forum_list($id){
         $smfdbname = 'mumcentre_forum_sg';
        $forum = R::getAll("SELECT msg.id_msg, msg.id_topic, msg.id_board, msg.subject, msg.poster_name, msg.body, DATE_FORMAT(FROM_UNIXTIME(msg.poster_time), '%e-%d-%y %r') as time_posted, a.num_replies, a.num_views
	FROM $smfdbname.smf_messages msg
        INNER JOIN $smfdbname.smf_topics AS a
        ON msg.id_topic = a.id_topic        
	WHERE a.id_member_started = ".$id."
        ORDER by msg.poster_time DESC      
	LIMIT 7");
        
        foreach ($forum as &$article) {
        $article['subject'] = $this->_trimForumTitle($article['subject']);
        $article['body'] = $this->_trimForumBody($article['body']);
        }
        
        return '"forum":' . json_encode($forum);
    }
    
    private function _trimForumTitle($article_summary) {
        $trimmed_summary = strlen($article_summary) > 20 ? substr($article_summary, 0, 17) . "..." : $article_summary;
        return $trimmed_summary;
    }
    
    private function _trimForumBody($article_summary) {
        $trimmed_summary = strlen($article_summary) > 23 ? substr($article_summary, 0, 20) . "..." : $article_summary;
        return $trimmed_summary;
    }
    
    function pow_current($id) {
        echo '{"pow_list": [{' . $this->_pow_current($id) . '}]}';
    }

    
    private function _pow_current($id){
        $pow = R::getAll("SELECT a.id, a.token_id, a.photo_filename, a.name, a.caption
                FROM pow_entry as a
                INNER JOIN pow_contest_category as b
                ON b.id = a.pow_category_id
                INNER JOIN pow_contest as c
                ON c.id = b.pow_contest_id
                WHERE a.user_id = ".$id."
                AND (c.status = 1
		OR c.status = 2)
                AND a.status = 1
                ");
        
        
        return '"pow":' . json_encode($pow);
    }
    
    function pow_past($id) {
        echo '{"pow_list": [{' . $this->_pow_past($id) . '}]}';
    }

    
    private function _pow_past($id){
        $pow = R::getAll("SELECT a.id, a.token_id, a.photo_filename, a.name, a.caption
                FROM pow_entry as a
                INNER JOIN pow_contest_category as b
                ON b.id = a.pow_category_id
                INNER JOIN pow_contest as c
                ON c.id = b.pow_contest_id
                WHERE a.user_id = ".$id."
                AND c.status > 2
                AND a.status = 1
                ");
        
        
        return '"pow":' . json_encode($pow);
    }
    
    function delete_pow(){
        $id = $this->input->post('id');
        $pow = R::load('pow_entry',$id);
   
        
        R::trash($pow);
        
        $response['code'] = 0;
        $response['message'] = "Entry deleted.";

        echo $response['code'] . ":" . $response['message'] ;  
    }

	

}
