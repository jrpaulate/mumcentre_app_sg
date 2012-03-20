<?php
class partner_user_account extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
        $this->load->library('mcox');
        $this->avatar_path = $this->config->item('user_avatar_gen_path');
        $this->load->library('session');
        $this->load->library('mcapi');
        $this->load->helper('miscfuncs');
     
        $this->company_id = 0;
    }
    
   

     function index() {
        $message_403 = "Direct access is forbidden.";
        show_error($message_403 , 403 );
    }
    
    

    function read($id){
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/manage_user_account');
        $this->bucket->add_css('partner_style');
   

        $this->bucket->set_data('id', $id);
//      $this->bucket->set_data('id_get', $response['id_get']);
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
        
        if($width > 640){
            $fwidth = 640;
        }
        if($height > 480){
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
   
    
    
    function user_list(){
        echo '{"user_list": [{'.$this->_user().'}]}';
    }
  
    private function _user() {
        $sql="SELECT u.id, 
            r.first_name AS first_name, 
            r.last_name AS last_name, 
            r.email_address AS email_address,
            r.avatar_filepath AS avatar,
            p.name AS provider_name
            FROM provider_user AS u
            INNER JOIN user AS r ON u.user_id = r.id
            INNER JOIN provider_profile AS p ON u.provider_id = p.id
        
            ORDER BY u.id";
        
        $user = R::getAll($sql);

        return '"user":' . json_encode($user);
    }
    
    
    
   
    
  
    
    
    
    
    function auth(){
        $email_address = $this->input->post('email');
        $password = $this->input->post('password');

        $sql="SELECT
          u.id
        , u.first_name
        , u.avatar_filepath
        FROM user AS u
        WHERE email_address='".$email_address."'
        AND u.password = '".md5($password)."'";

        $account = R::getAll($sql);
    }
    
    
     function get_provider_link(){
        $id = $this->input->post('provider_id');
        
        $provider = R::getRow("SELECT a.name, a.id
            FROM provider_profile as a
            WHERE a.id = ".$id
          );
        
 
        $base = base_url();
        $provider['link'] = 'ps_providers/profile/'.$provider['id'];
       

          echo $provider['link'];
//        echo $base;
        
    }
 
        private function _get_details($id){
        
            $sql="SELECT name, contact_person, email_address
            FROM provider_profile
            WHERE id = ".$id;

            $details = R::getRow($sql);
            
            return $details;
        }
  
}
?>
