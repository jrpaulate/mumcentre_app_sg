<?php

class edit_member extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
      
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        
        $this->member_image_path = $this->config->item('member_image_gen_path');
    
    }
    
    private function _check_logged(){
        if($this->session->userdata('cms_logged_in') != TRUE){
            redirect('cms/login', 'refresh');
        }
    }
    
    function index() {
        $message_403 = "Direct access is forbidden.";
        show_error($message_403 , 403 );
    }
    
    function read($id){
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/edit_member');
        $this->bucket->add_css('cms');
   

        $this->bucket->set_data('id', $id);
//      $this->bucket->set_data('id_get', $response['id_get']);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
        
        
    }    
    
    function edit_member() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/edit_member');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
        
    function update_member() {
        $user = R::load('user',$id);
        $user->first_name = $this->input->post('first_name');
        $user->last_name = $this->input->post('last_name');
        $user->birth_date = $this->input->post('birth_date');
        $user->gender = $this->input->post('gender');
        $user->email_address = $this->input->post('email');
        $user->location = $this->input->post('location');
        $user->password = $this->input->post('password');
        $user->avatar_filepath = $this->input->post('avatar');
        $user->age = $this->input->post('age');
        $user->modified_by_id = 0;
        $user->modified_date = date("Y-m-d H:i:s");
        $id = R::store($user);

        $response['code'] = 0;
        $response['message'] = "Member successfully created.";

        echo $response['code'] . ":" . $response['message'] ;  
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
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->member_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".png":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->member_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".gif":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->member_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
        }
        
        echo $id . ".jpg";
    }
    
    function error() {
        $message_404 = "Either your requested article is removed, or your url is wrong...";
        show_error($message_404 , 404 );
    }
    
    private function _user($user_id) {
        $sql="SELECT
          u.id
        , u.first_name
        , u.last_name
        , u.email_address AS email
        , u.location
        , u.birth_date
        , u.password
        , u.age
        , u.avatar_filepath
        FROM user AS u
        WHERE u.id = ".$user_id;
        
        $user = R::getAll($sql);
        
        return '"user":' . json_encode($user);
  }
  
   function user_data($user_id){
      echo '{"user_data": [{'.$this->_user($user_id).'}]}';
  }

}