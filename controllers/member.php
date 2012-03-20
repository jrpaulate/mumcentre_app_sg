<?php

//require_once('C:/nginx/www/mumcentre/forum/smf_2_api.php');

class Member extends CI_Controller {

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
        
        $this->mini_ad1 = $this->_generateTags(41);
        $this->mini_ad2 = $this->_generateTags(42);
        $this->mini_ad3 = $this->_generateTags(43);

        $this->featban = $this->_generateTags(27);
    }

    function register() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/member_registration');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
        $this->bucket->add_css('registration');
        $this->bucket->add_css('member_reg');
        $this->bucket->set_data('title', "Mumcentre");
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        
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
        $email_check = reset(R::find('user', ' email_address = ? ', array($this->input->post('email'))));
        if ($email_check) {
            echo json_encode(array('error_code' => 2));
        } else {
            $subscriptions = "";
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $salt = substr(md5(mt_rand()), 0, 32);
            
            $encrypted_password = md5(md5($password).$salt);
            $avatar = base_url().'uploaded/user/avatar/'.$this->input->post('user_avatar');
//            $regOptions = array(
//                'interface' => 'guest',
//                'member_name' => $this->input->post('given_name') . " " . $this->input->post('family_name'), //the variable from the form for the inputted username
//                'email' => $email, //likewise, the email address that was inputted in the form
//                'password' => $password, //the password that the user inputted
//                'password_check' => $password, //the second confirmation password inputted
//                'check_reserved_name' => true, //this will make sure that SMF first checks for a reserved name before writing the user to the database
//                'check_password_strength' => false,
//                'check_email_ban' => true, //checks for ban on the email address that was inputted
//                'send_welcome_email' => false, //true if you want SMF to send an email, false if you want your other software to handle it.  I'd recommend false.
//                'require' => 'nothing',
//                'extra_register_vars' => array(),
//                'theme_vars' => array(),
//            );
//            $smf_id = smfapi_registerMember($regOptions);
            $smf_id = $this->_smf_register($this->input->post('given_name'). " " .$this->input->post('family_name'),
                    $email, $this->input->post('password'), $this->input->ip_address(), $avatar);

            $user = R::dispense("user");
//            $user->smf_id = $smf_id;
            $user->first_name = $this->input->post('given_name');
            $user->last_name = $this->input->post('family_name');
            $user->birth_date = date("Y-m-d H:i:s", strtotime($this->input->post('dob')));
            $user->gender = $this->input->post('gender');
            $user->email_address = $email;
            $user->location = $this->input->post('loc');
            $user->password = $encrypted_password;
            $user->avatar_filepath = $this->input->post('user_avatar');
            $user->subscription_info = 0;
            $user->alerts_info = -1;
            $user->fb_user_id = 0;
            $user->salt = $salt;
	    $user->smf_id = $smf_id;
	    $user->country_id = $this->session->userdata('country_id');
            $user->created_date = date("Y-m-d H:i:s");

            if ($this->input->post('newsletter')) {
                $user->subscription_info += 1;
                if ($subscriptions == "") {
                    $subscriptions .= "Weekly Newsletter";
                } else {
                    $subscriptions .= ",Weekly Newsletter";
                }
            }
            if ($this->input->post('weekend_planner')) {
                $user->subscription_info += 2;
                if ($subscriptions == "") {
                    $subscriptions .= "Weekend Planner";
                } else {
                    $subscriptions .= ",Weekend Planner";
                }
            }
            if ($this->input->post('partner_news')) {
                $user->subscription_info += 4;
                if ($subscriptions == "") {
                    $subscriptions .= "Partner News";
                } else {
                    $subscriptions .= ",Partner News";
                }
            }
            if ($this->input->post('pow_results')) {
                $user->subscription_info += 8;
                if ($subscriptions == "") {
                    $subscriptions .= "Pic of the Week Results";
                } else {
                    $subscriptions .= ",Pic of the Week Results";
                }
            }
            if ($this->input->post('preg_guide')) {
                $user->subscription_info += 16;
                if ($subscriptions == "") {
                    $subscriptions .= "Pregnancy Guide";
                } else {
                    $subscriptions .= ",Pregnancy Guide";
                }
            }
            if ($this->input->post('pc_dev_guide')) {
                $user->subscription_info += 32;
                if ($subscriptions == "") {
                    $subscriptions .= "Parent-Child Development Guide";
                } else {
                    $subscriptions .= ",Parent-Child Development Guide";
                }
            }
            if ($this->input->post('vacation_guide')) {
                $user->subscription_info += 64;
                if ($subscriptions == "") {
                    $subscriptions .= "Vacation Guide";
                } else {
                    $subscriptions .= ",Vacation Guide";
                }
            }
            if ($this->input->post('bday_planner')) {
                $user->subscription_info += 128;
                if ($subscriptions == "") {
                    $subscriptions .= "Birthday Planner";
                } else {
                    $subscriptions .= ",Birthday Planner";
                }
            }
            
            $id = R::store($user);
//            $this->session->set_userdata('subscriptions', $subscriptions);
//            $this->session->set_userdata('temp_id', $id);
//            $this->session->set_userdata('temp_email', $email);
            
            if ($this->input->post('child_fname1')) {
                $child = R::dispense("user_children");
                $child->name = $this->input->post('child_fname1');
                $child->gender = $this->input->post('child_gender1');
                $child->birth_date = date("Y-m-d H:i:s", strtotime($this->input->post('child_dob1')));
                $child->parent_id = $id;
                R::store($child);
            }
            if ($this->input->post('child_fname2')) {
                $child = R::dispense("user_children");
                $child->name = $this->input->post('child_fname2');
                $child->gender = $this->input->post('child_gender2');
                $child->birth_date = date("Y-m-d H:i:s", strtotime($this->input->post('child_dob2')));
                $child->parent_id = $id;
                R::store($child);
            }
            if ($this->input->post('child_fname3')) {
                $child = R::dispense("user_children");
                $child->name = $this->input->post('child_fname3');
                $child->gender = $this->input->post('child_gender3');
                $child->birth_date = date("Y-m-d H:i:s", strtotime($this->input->post('child_dob3')));
                $child->parent_id = $id;
                R::store($child);
            }
            if ($this->input->post('pregnant')) {
                $pregnant = R::dispense("pregnant_users");
                $pregnant->user_id = $id;
                $pregnant->due_date = date("Y-m-d H:i:s", strtotime($this->input->post('due_date')));
                R::store($pregnant);
            }
            
        $alert_groups = '';
        $alert_schedule = '';
//        $alert_id = $this->session->userdata('alert_id');
        //$alert = R::load("user_alerts", $this->session->userdata('alert_id'));
//        $email = $this->session->userdata('temp_email');
        $alert = R::dispense('user_alert');
        $alert->user_id = $id;
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
                
                 $listID = '3387bb7b40';       
                 $mergeVars = array(
                        'GROUPINGS' => array(
                        array('id'=>'4497', 'groups'=>$subscriptions),
                        array('id'=>'4501', 'groups'=>$alert_groups),
                        array('id'=>'4505', 'groups'=>$alert_schedule)

                    )
                );        
        //        echo $this->session->userdata('subscriptions');
                if ($this->input->post('alerts_status')==1){
                $retval = $this->mcapi->listSubscribe($listID,$email,$mergeVars);
                 }
            echo json_encode(array("error_code" => 0));
        }
    }
    
    private function _smf_register($member_name, $email, $password, $ip, $avatar) {
        R::selectDatabase('forums');
        $smf_writer = new SMFWriter(R::$adapter); 
        $smf_rb = new RedBean_OODB($smf_writer);
        $smf_bean = $smf_rb->dispense('smf_members');        
        $smf_bean->member_name = $member_name;
        $smf_bean->email_address = $email;
        $smf_bean->passwd = sha1(strtolower($member_name) . $password);
        $smf_bean->password_salt = substr(md5(mt_rand()), 0, 4);
        $smf_bean->posts = 0;
        $smf_bean->date_registered = time();
        $smf_bean->member_ip = $ip;
        $smf_bean->member_ip2 = '';
        $smf_bean->validation_code = '';
        $smf_bean->real_name = $member_name;
        $smf_bean->personal_text = '';
        $smf_bean->pm_email_notify = 1;
        $smf_bean->id_theme = 0;
        $smf_bean->id_post_group = 4;
        $smf_bean->lngfile = '';
        $smf_bean->buddy_list = '';
        $smf_bean->pm_ignore_list = '';
        $smf_bean->message_labels = '';
        $smf_bean->website_title = '';
        $smf_bean->website_url = '';
        $smf_bean->location = '';
        $smf_bean->icq = '';
        $smf_bean->aim = '';
        $smf_bean->yim = '';
        $smf_bean->msn = '';
        $smf_bean->time_format = '';
        $smf_bean->signature = '';
        $smf_bean->avatar = $avatar;
        $smf_bean->usertitle = '';
        $smf_bean->secret_question = '';
        $smf_bean->secret_answer = '';
        $smf_bean->additional_groups = '';
        $smf_bean->ignore_boards = '';
        $smf_bean->smiley_set = '';
        $smf_bean->openid_uri = '';
        $smf_bean->is_activated = 1;
        $smf_id = $smf_rb->store($smf_bean);
        R::selectDatabase("default");
        
        return $smf_id;
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
//        R::store($alert);
//        echo json_encode(array("error_code" => 0));
//        echo $this->session->userdata('subscriptions');
    }
    
    private function _generateTags($zoneId) {
        $ajs = "http://50.19.248.24/openx/www/delivery/ajs.php";
        $loc = urlencode(current_url());
        $cb = rand(0, 99999999999);
        return '<script type="text/javascript" src="' . $ajs . '?zoneid=' . $zoneId .
                '&amp;cb=' . $cb . '&amp;charset=ISO-8859-1&amp;loc=' . $loc . '"></script>';
    }
}
