<?php
class Cms_user_account extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
        $this->avatar_path = $this->config->item('user_account_image_gen_path');
    }
    
    private function _check_logged(){
        if($this->session->userdata('cms_logged_in') != TRUE){
            redirect('cms/login', 'refresh');
        }
    }

    function index() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/user_account');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
  
    }

    function add_user_account() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/add_user_account');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
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
    
    
    function create() {
        $user_account = R::dispense("user_account");
        $user_account->first_name= $this->input->post('title');
        $user_account->last_name = $this->input->post('author');
        $user_account->email = $this->input->post('email');
        $user_account->Avatar_Filepath = $this->input->post('avatar');
        $user_account->username = $this->input->post('username');
        $user_account->password = $this->input->post('password');
        $user_account->date_created = date("Y-m-d H:i:s");
    

        $id = R::store($user_account);
        
        $response['code'] = 0;
        $response['message'] = "User successfully created.";

        echo $response['code'] . ":" . $response['message'] ;  
    }
    
    
    
    

  function user_account_list(){
      echo '{"user_account_list": [{'.$this->_user_account().'}]}';
    }

    private function _user_account() {
    $user_account = R::getAll("SELECT u.id, u.username, u.password,  u.permission, u.email, u.avatar_filepath
    FROM user_account as u
    ORDER BY u.id");

//    foreach ($highlights as &$highlight) {
//      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
//    }

    return '"user_account":' . json_encode($user_account);
    //echo $this->_json_response('featured_articles', $articles);
  }
}
?>
