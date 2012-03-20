<?php
class cms_member extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
         $this->member_image_path = $this->config->item('member_image_gen_path');
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
        $this->bucket->set_content_id('cms/member');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    function add_member() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/add_member');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    function create_member() {

        $member = R::dispense("user");
        $user_role = R::dispense("user_role");
        
        $member->first_name = $this->input->post('first_name');
        $member->last_name = $this->input->post('last_name');
        $member->birth_date = $this->input->post('birth_date');
        $member->gender = $this->input->post('gender');
        $member->email_address = $this->input->post('email');
        $member->location = $this->input->post('location');
        $member->password = $this->input->post('password');
        $member->avatar_filepath = $this->input->post('avatar');
        $member->status = 1;
        $member->created_by_id = 0;
        $member->created_date = date("Y-m-d H:i:s");
        $member_id = R::store($member);
        
        //automaticall assign member to Member role
        $user_role->user_id = $member_id;
        $user_role->role_id = 2;
        $user_role->created_date = date("Y-m-d H:i:s");
        $user_role_id = R::store($user_role);
        
        $response['code'] = 0;
        $response['message'] = "New Member Successfully Created.";

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
    
  function user_list(){
      echo '{"user_list": [{'.$this->_users().'}]}';
    }
    
    private function _users() {
        $sql="SELECT
          u.id
        , u.first_name
        , u.last_name
        , u.email_address AS email
        , u.age
        , u.avatar_filepath
        FROM user as u
        ORDER BY u.id";
        
        $users = R::getAll($sql);
    
//    foreach ($highlights as &$highlight) {
//      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
//    }

    return '"users":' . json_encode($users);
    //echo $this->_json_response('featured_articles', $articles);
  }
}
?>
