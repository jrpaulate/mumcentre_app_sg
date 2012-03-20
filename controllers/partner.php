<?php

//require_once('C:/xampp/htdocs/mumcentre/forum/smf_2_api.php');

require_once('/var/www/mumcentre/forum/smf_2_api.php');

class Partner extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->library('rb');
        $this->load->library('session');
        $this->load->library('mcapi');
        $this->load->library('mcox');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('miscfuncs');
        $this->avatar_path = $this->config->item('user_avatar_gen_path');
        $this->company_id = 0;
        
        $this->mini_ad1 = $this->_generateTags(41);
        $this->mini_ad2 = $this->_generateTags(42);
        $this->mini_ad3 = $this->_generateTags(43);

        $this->featban = $this->_generateTags(27);
    }

    private function _check_logged() {
        if ($this->session->userdata('partner_logged_in') != TRUE) {
            redirect('partner', 'refresh');
        }
    }

    function index() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/blank');
        $this->bucket->set_content_id('partner_portal/partner_login');
        $this->bucket->add_css('modal_orig');
        $this->bucket->add_css('pow');
        $this->bucket->add_css('style');
        $this->bucket->set_data('title', "Mumcentre - Partner Portal");
        $this->bucket->render_layout();
    }

    function daily_stats() {
        $start_date = new DateTime("2012-01-25");
        $end_date = new DateTime("2012-01-26");
        $stats = $this->mcox->get_ad_daily_stats(3, $start_date, $end_date);
//        $response = array("stats" => array());
        $response = array();
        foreach ($stats as $s) {
            $date = new DateTime($s["day"]);
            $s["day"] = $date->format("Y-m-d h:gA");
            array_push($response, $s);
        }
        echo json_encode($response);
    }

    function dashboard() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/dashboard');
        $this->bucket->add_css('partner_style');
        $this->bucket->set_data('title', "Mumcentre - Partner Portal");
        $this->bucket->render_layout();
        $this->bucket->add_css('ad_chart');
    }

    function register() {
//        $this->session->set_userdata('temp_id', 0);
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('partner_portal/partner_registration');
//        $this->bucket->set_content_id('partner_portal/manage_listing');
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

    function user_account() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/manage_user_account');
        $this->bucket->add_css('partner_style');

//      $this->bucket->set_data('id_get', $response['id_get']);
        $this->bucket->set_data('title', "Mumcentre - Partner Portal");
        $this->bucket->render_layout();
    }

    function add_user_account() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/partner_add_user');
        $this->bucket->add_css('partner_style');
        $this->bucket->set_data('title', "Mumcentre - Partner Portal");
        $this->bucket->render_layout();
        $this->bucket->add_css('ad_chart');
    }

    function manage_listing() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/manage_listing');
        $this->bucket->add_css('partner_style');
        $this->bucket->set_data('title', "Mumcentre - Partner Portal");
        $this->bucket->render_layout();
    }

    function listing() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/listing');
        $this->bucket->add_css('partner_style');
        $this->bucket->set_data('title', "Mumcentre - Partner Portal");
        $this->bucket->render_layout();
    }

    function add_listing() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/partner_add_listing');
        $this->bucket->add_css('cms');
        $this->bucket->add_css('partner_style');
        $this->bucket->set_data('title', "Mumcentre - Partner Portal");
        $this->bucket->render_layout();
    }

    function add_program() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/partner_add_program');
        $this->bucket->add_css('cms');
        $this->bucket->add_css('partner_style');
        $this->bucket->set_data('title', "Mumcentre - Partner Portal");
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
//                R::debug(true);
                //$this->session->set_userdata('alert_id', $this->alert_id);
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $salt = substr(md5(mt_rand()), 0, 32);
                $encrypted_password = md5(md5($password).$salt);
                $avatar = base_url().'uploaded/user/avatar/'.$this->input->post('user_avatar');
                
                $smf_id = $this->_smf_register($this->input->post('given_name'). " " .$this->input->post('family_name'),
                    $email, $this->input->post('password'), $this->input->ip_address(), $avatar);
                
                $user = R::dispense("user");
                $user->smf_id = $smf_id;
                $user->first_name = $this->input->post('given_name');
                $user->last_name = $this->input->post('family_name');
                $user->birth_date = date("Y-m-d H:i:s", strtotime($this->input->post('dob')));
                $user->gender = $this->input->post('gender');
                $user->email_address = $email;
                $user->location = $this->input->post('loc');
                $user->password = $encrypted_password;
                $user->avatar_filepath = $this->input->post('user_avatar');
                $user->subscription_info = -1;
                $user->alerts_info = -1;
                $user->fb_user_id = 0;
                $user->salt = $salt;
                $user->created_date = date("Y-m-d H:i:s");
                $id = R::store($user);
//                $this->session->set_userdata('temp_id', $id);
//                $this->session->set_userdata('uid', $id);
                
                $c_id = $this->_company_register($this->input->post('company_name'), $this->input->post('company_address'));
                
                $provider_user = R::dispense('provider_user');
                $provider_user->provider_id = $c_id;
                $provider_user->user_id = $id;
                R::store($provider_user);

//                $listID = "2e3861cf16"; // obtained by calling lists();
//                $retval = $this->mcapi->listSubscribe($listID, $email);
//                echo $c_id;
                echo json_encode(array("error_code" => 0));
            }
        
    }
    
    private function _company_register($company_name, $company_address){
                $al = R::dispense('provider_profile');
                $al->name = $company_name;
                $al->location = $company_address;
                $company_id = R::store($al);
                
                $provider = R::dispense('provider_country');
                $provider->provider_id = $company_id;
                $provider->country_id = $this->config->item('country_id');
                R::store($provider);
                
                return $company_id;
    }

    function signup_logged() {

        $al = R::dispense('company_info');
        $al->user_id = $this->input->post('user_id');
        $al->company_name = $this->input->post('company_name');
        $al->company_address = $this->input->post('company_address');
        $al->country = $this->input->post('company_country');
        $al->postcode = $this->input->post('postcode');
        $al->city = $this->input->post('city');
        $al->province = $this->input->post('province');
        R::store($al);

        echo json_encode(array("error_code" => 0));
    }

    function signup_logged_2() {
        //insert code for partner portal package update
        echo json_encode(array("error_code" => 0));
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
//        $alert_id = $this->session->userdata('alert_id');
        //$alert = R::load("user_alerts", $this->session->userdata('alert_id'));
        $alert = R::dispense('user_alerts');
        $alert->user_id = $this->session->userdata('temp_id');
        if ($this->input->post('articles')) {
            $alert->has_article = 1;
        }
        if ($this->input->post('reviews')) {
            $alert->has_reviews = 1;
        }
        if ($this->input->post('programs')) {
            $alert->has_programs = 1;
        }
        if ($this->input->post('curriculum')) {
            $alert->has_curriculum = 1;
        }
        if ($this->input->post('events')) {
            $alert->has_events = 1;
        }
        if ($this->input->post('mon')) {
            $alert->week_day = 0;
        }
        if ($this->input->post('tue')) {
            $alert->week_day = 1;
        }
        if ($this->input->post('wed')) {
            $alert->week_day = 2;
        }
        if ($this->input->post('thur')) {
            $alert->week_day = 3;
        }
        if ($this->input->post('fri')) {
            $alert->week_day = 4;
        }
        if ($this->input->post('sat')) {
            $alert->week_day = 5;
        }
        if ($this->input->post('sun')) {
            $alert->week_day = 6;
        }
        R::store($alert);
        echo json_encode(array("error_code" => 0));
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

//        $authenicated = smfapi_authenticate($email_address, $pword);
//			if ($authenicated) {
//				smfapi_login($email_address);
//			}
//        
//        $data = array(
//            'name' => $user_info['first_name'],
//            'avatar' => $user_info['avatar_filepath'],
//            'user_id' => $user_info['id'],
//            'smf_email' => $email_address,
//            'partner_logged_in' => TRUE
//        );
//        $this->session->set_userdata($data);

        $user = R::getRow("SELECT a.id AS user_id, a.first_name AS name, a.avatar_filepath AS avatar, b.provider_id FROM user AS a INNER JOIN provider_user AS b ON a.id = b.user_id WHERE a.email_address='" . $email_address . "'");

//        $authenicated = smfapi_authenticate($email_address, $pword);
//        if ($authenicated) {
//        smfapi_login($email_address);
//        $this->session->set_userdata('smf_email', $email_address);
//        } else {
//        echo "smf authentication fail";
//        }

        $this->session->set_userdata($user);
        $this->session->set_userdata('partner_logged_in', TRUE);
    }

    private function _user_info($email_address) {
        $meta = R::getRow("SELECT id, first_name, last_name, avatar_filepath
            FROM user
            WHERE email_address = '" . $email_address . "'"
        );
        return $meta;
    }

    function logout() {
//		$smfemail = $this->session->userdata('smf_email');
//		smfapi_logout($smfemail);

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

    function login() {
        $email_address = $this->input->post('email_address');
        $password = $this->input->post('password');
        $user_salt = R::getRow("SELECT salt from user WHERE email_address = '".$email_address."'");
        
        $encrypted_password = $this->_encrypt_password($password, $user_salt['salt']);
        $user = reset(R::find('user', ' email_address = ? and password = ?', array($email_address, $encrypted_password)));
        if ($user) {
            $partner = reset(R::find('provider_user', ' user_id = ? ', array($user->id)));
            if ($partner) {
                $response['code'] = 1;
                $response['message'] = 'Logging in...';
            } else {
                $response['code'] = -2;
                $response['message'] = 'User is not registered for Partner Portal';
            }
        } else {
            $response['code'] = -1;
            $response['message'] = 'Invalid email address / password.';
        }

        echo $response['code'] . ":" . $response['message'];
    }

    function profile_data($user_id) {
        echo '{"profile_data": [{' . $this->_profile($user_id) . '}]}';
    }

    private function _profile($user_id) {
        $profile = R::getRow("SELECT first_name, last_name, birth_date, gender, location, avatar_filepath, email_address
    FROM user
    WHERE id = " . $user_id . " 
    ");

        $profile['gender'] = $this->_getGender($profile['gender']);


        return '"profile":' . json_encode($profile);
    }

    private function _getGender($gender) {
        if ($gender == 1) {
            $g = 'Female';
        } else {
            $g = 'Male';
        }

        return $g;
    }

    function child_data($user_id) {
        echo '{"child_data": [{' . $this->_child($user_id) . '}]}';
    }

    private function _child($user_id) {
        $child = R::getAll("SELECT c.name, c.birth_date, c.gender, c.parent_id, u.first_name, u.last_name
    FROM user_signup_children As c
    INNER JOIN user AS u
    WHERE c.parent_id = " . $user_id . " 
    ");

        foreach ($child AS &$child) {
            $child['gender'] = $this->_getGender($child['gender']);
        }
        return '"child":' . json_encode($child);
    }

    function profile_children() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/profile_children');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
    }

    function profile_alerts() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/profile_alerts');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
    }

    function profile_subscription() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/profile_subscription');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
    }

    function profile_forums() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/profile_forums');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
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
    
    function my_alerts(){
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/manage_my_alerts');
        $this->bucket->add_css('partner_style');
        $this->bucket->set_data('title', "Mumcentre - Partner Portal");
        $this->bucket->render_layout();
    }
    
    
        function ads_listing(){
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/manage_ads_listing');
        $this->bucket->add_css('partner_style');
        $this->bucket->set_data('title', "Mumcentre - Partner Portal");
        $this->bucket->render_layout();
    }
    
    private function _encrypt_password($password, $salt){
        return md5(md5($password).$salt);
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
    
    private function _generateTags($zoneId) {
        $ajs = "http://50.19.248.24/openx/www/delivery/ajs.php";
        $loc = urlencode(current_url());
        $cb = rand(0, 99999999999);
        return '<script type="text/javascript" src="' . $ajs . '?zoneid=' . $zoneId .
                '&amp;cb=' . $cb . '&amp;charset=ISO-8859-1&amp;loc=' . $loc . '"></script>';
    }

}
