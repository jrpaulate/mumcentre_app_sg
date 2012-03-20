<?php
//require_once('C:/xampp/htdocs/mumcentre/forum/smf_2_api.php');
//require_once('/var/www/mumcentre/forum/smf_2_api.php');

class partner_content_profile extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->library('rb');
        $this->load->library('session');
        $this->load->library('mcapi');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('miscfuncs');
        $this->company_id = 0;
    }
    
    private function _check_logged(){
        if($this->session->userdata('partner_logged_in') != TRUE){
            redirect('partner', 'refresh');
        }
    }
    
    function index() {
        $message_403 = "Direct access is forbidden.";
        show_error($message_403 , 403 );
    }
    
    
    
        function read($id){
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/manage_listing_profile');
        $this->bucket->add_css('partner_style');
   

        $this->bucket->set_data('id', $id);
//      $this->bucket->set_data('id_get', $response['id_get']);
       $this->bucket->set_data('title', "Mumcentre - Partner Portal");
        $this->bucket->render_layout();
      
    }
    
    
   
     private function _provider($provider_id) {
        $sql="SELECT
          a.id
        , a.name AS provider_name
        , a.details AS provider_details
        , a.location AS provider_location
        , a.email_address AS provider_email
        , a.contact_person AS provider_contact
        , a.logo_filepath AS provider_logo
        , a.image_filepath AS provider_image
        , a.ticker AS provider_ticker
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , age.name AS age_group_name
        , p.name AS provider_listing_name
        FROM provider_profile AS a
        INNER JOIN age_group as age
        ON a.age_group_id = age.id
        INNER JOIN provider_listing as p
        ON a.provider_listing_id = p.id
        Where a.id = $provider_id";

        $provider = R::getAll($sql);

        return '"provider":' . json_encode($provider);
    }
  
    function provider_data($provider_id){
        echo '{"provider_data": [{'.$this->_provider($provider_id).'}]}';
    }

    
    
    
     
}