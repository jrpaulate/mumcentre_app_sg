<?php
class partner_my_alerts extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
        $this->load->library('mcox');
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
        $this->bucket->set_content_id('partner_portal/manage_my_alerts');
        $this->bucket->add_css('partner_style');
   

        $this->bucket->set_data('id', $id);
//      $this->bucket->set_data('id_get', $response['id_get']);
       $this->bucket->set_data('title', "Mumcentre - Partner Portal");
        $this->bucket->render_layout();
      
    }
    
  
    
   
    
    
    function alert_list($provider_id){
        echo '{"alert_list": [{'.$this->_alert($provider_id).'}]}';
    }
  
    private function _alert($provider_id) {
        $sql="SELECT u.id, 
            u.message,
            u.sent_date,
            u.sent_by,     
            p.id
            FROM alert_partner AS u    
            INNER JOIN provider_profile AS p ON u.provider_id = p.id
            WHERE provider_id = $provider_id
            ORDER BY u.id";
        
        $alert = R::getAll($sql);

        return '"alert":' . json_encode($alert);
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
