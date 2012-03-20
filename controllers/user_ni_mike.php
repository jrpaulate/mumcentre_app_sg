<?php

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->library('rb');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->avatar_path = $this->config->item('user_avatar_gen_path');
    }

    function register() {
        $this->session->set_userdata('temp_id', 0);
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/user_registration');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('layout');
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

        switch ($json->{'file_ext'}) {
            case ".jpg":
            case ".jpeg":
            case ".png":
            case ".gif":
                $this->media->smart_thumb_image($json->{'file_path'}, 165, 165, 170, 170, true, $this->avatar_path . $id . ".jpg", false, false);
                break;
        }

        echo $id . ".jpg";
    }

    function signup() {
        $temp_id = $this->session->userdata('temp_id');
        if ($temp_id == 0) {
            $user = R::dispense("user_signup");
            $user->first_name = $this->input->post('given_name');
            $user->last_name = $this->input->post('family_name');
            $user->birth_date = date("Y-m-d H:i:s", strtotime($this->input->post('dob')));
            $user->gender = $this->input->post('gender');
            $user->email = $this->input->post('email');
            $user->location = $this->input->post('loc');
            $user->password = md5($this->input->post('password'));
            $user->avatar = $this->input->post('user_avatar');
            $user->subscription_info = -1;
            $user->fb_id = md5($user->password);
            $user->created_date = date("Y-m-d H:i:s");
            $id = R::store($user);
            $this->session->set_userdata('temp_id', $id);
            echo json_encode(array("error_code" => 0));
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
                $user = R::dispense('users');
                $user->import($temp_user_data, 'first_name,last_name,birth_date,gender,email,location,password,avatar,subscription_info,fb_id');
                $user->created_date = date("Y-m-d H:i:s");
                $user_id = R::store($user);

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

}