<?php
class cms_ads_type extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
        $this->load->library('MCAPI');
        $this->load->library('session');
  
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
        $this->bucket->set_content_id('cms/ads_type');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
        
         
    }
    

  
    function type_list(){
        echo '{"type_list": [{'.$this->_type().'}]}';
    }
  
    private function _type() {
          $sql="SELECT
          a.id
         ,a.name
        FROM ads_type AS a
        ORDER BY a.id";
          
        $type = R::getAll($sql);

        return '"type":' . json_encode($type);

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
    
    
    
    
        
}
?>
