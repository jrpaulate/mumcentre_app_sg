<?php

class Register extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->avatar_path = $this->config->item('review_image_gen_path');
    }

    function index() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/register');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('registration');
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
    }
    
    function fb() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/fb_reg');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('registration');
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
    }
    
    function fbsub() {
        $given_name = $this->input->post('first_name');
        $family_name = $this->input->post('last_name');
        $birthdate = $this->input->post('birthday');
        if ($this->input->post('gender') == "Male") {
            $gender = 2;
        } else {
            $gender = 1;
        }
        $location = $this->input->post('location');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/fb_sub');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('registration');
        $this->bucket->set_data('given_name', $given_name);
        $this->bucket->set_data('family_name', $family_name);
        $this->bucket->set_data('birthdate', $birthdate);
        $this->bucket->set_data('gender', $gender);
        $this->bucket->set_data('location', $location);
        $this->bucket->set_data('email', $email);
        $this->bucket->set_data('password', $password);
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
            case ".mp3":
            case ".wma":
                break;
            case ".3gp":
            case ".avi":
            case ".flv":
            case ".mov":
            case ".mpeg":
            case ".mp4":
            case ".wmv":
                break;
            case ".jpg":
            case ".jpeg":
            case ".png":
            case ".gif":
                $this->media->smart_thumb_image($json->{'file_path'}, 145, 145, 150, 150, true, $this->avatar_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
        }

        echo $id . ".jpg";
    }

    function submit() {
        $this->load->library('rb');
        $user = R::dispense("user");
        
        $given_name = $this->input->post('given_name');
        $family_name = $this->input->post('family_name');
        $birth_date = $this->input->post('birthdate');
        $gender = $this->input->post('gender');
        $email = $this->input->post('email_add');
        $vemail = $this->input->post('vemail');
        $location = $this->input->post('location');
        $password = $this->input->post('password');
        $vpassword = $this->input->post('vpassword');
        $avatar = $this->input->post('avatar');
        
        
        $user->first_name = $given_name;
        $user->last_name = $family_name;
        $user->birth_date = $birth_date;
        $user->gender = $gender;
        $user->email = $email;
        $user->location = $location;
        $user->password = $password;
        $user->avatar_filepath = $avatar;
        $user->created_date = date("Y-m-d H:i:s");
        $id = R::store($user);
//        echo $id;
        
        $this->load->library('email');
        $this->config->load('email');

        $this->email->from($this->config->item('email_from_address'), $this->config->item('email_from_name'));
        $this->email->to($email);
        $this->email->subject('Thank you for signing up at Mumcentre!');
        $email_message = "
                    <html>
                    <body>
                    Hi " . $given_name . ",
                    <br><br>
                    Thank you for signing up!
                    <br><br>
                    Regards,
                    <br>
                    Mumcentre Administrator
                    </body>
                    </html>
                ";

        $this->email->message($email_message);

        if (!$this->email->send()) {
            $response['code'] = -3;
            $response['message'] = "Unable to send email.";
            $data['signup_error_msg'] = "<br/>Unable to send email.";
            $success = FALSE;
        } else {
            $response['code'] = 0;
            $response['message'] = "An email has been sent to the address you provided.";
        }
        
        echo $response['code'] . ":" . $response['message']; 
    }
    
    function manual_invite(){
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
        $this->email->to($email_address,$sender_email);
        $this->email->subject($email_subject);
        $this->email->message($email_body);

        if (!$this->email->send()) {
            $response['code'] = -3;
            $response['message'] = "Unable to send email to ".$email_address.",".$sender_email;
            $data['signup_error_msg'] = "<br/>Unable to send email.";
            $success = FALSE;
        } else {
            $response['code'] = 0;
            $response['message'] = "An email has been sent to the addresses you provided.";
        }
        
        echo $response['code'] . ":" . $response['message'];
        
    }

}

?>