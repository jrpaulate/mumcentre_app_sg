<?php
class cms_ads_listing extends CI_Controller {
   
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
        $this->bucket->set_content_id('cms/ads_listing');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
        
         
    }
    
    
    
    function add_listing() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/add_ads_listing');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    function purchased_ads($listing_id){
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/purchased_ads_listing');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->set_data('listing_id', $listing_id);
        $this->bucket->render_layout();
    }
    
    
    
    function create_ads_listing() {
        $ads = R::dispense("ads_listing");
        $ads->name = $this->input->post('name');
        $ads->section = $this->input->post('section');
        $ads->size = $this->input->post('width');
        $ads->price = $this->input->post('price');
        $ads->duration = $this->input->post('duration');
        $ads->type_id = $this->input->post('ads_type');
        $ads->created_date = date("Y-m-d H:i:s");
        
        
        $ads_id = R::store($ads);
      

        $response['code'] = 0;
        $response['message'] = "Ads successfully created.";

       echo $response['code'] . ":" . $response['message'] ; 
    }

     
    function ads_list(){
        echo '{"ads_list": [{'.$this->_ads().'}]}';
    }
  
    private function _ads() {
          $sql="SELECT
          a.id
        , a.name
        , a.section
        , a.width
        , a.height
        , a.price
        , a.duration
        , a.zone_id
     
        FROM ads_listing AS a
        ORDER BY a.id";
          
        $ads = R::getAll($sql);

        return '"ads":' . json_encode($ads);

    }
    
    
    private function _type() {
        $sql="SELECT
          a.id
        , a.name AS type_name
        FROM ads_type as a
        ORDER BY a.id";

        $type = R::getAll($sql);

        return '"type":' . json_encode($type);
     
    }

    function type_list(){
        echo '{"type_list": [{'.$this->_type().'}]}';
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
    
    function purchased_list(){
        echo '{"ads_list": [{'.$this->_purchased_list().'}]}';
    }
  
    private function _purchased_list() {
          $sql="SELECT
          a.id
        , a.name
        , a.section
        , a.width
        , a.height
        , a.price
        , a.duration
     
        FROM ads_listing AS a
        ORDER BY a.id";
          
        $ads = R::getAll($sql);

        return '"ads":' . json_encode($ads);

    }
    
    function purchased_list_by_type($listing_id){
        echo '{"ads_list": [{'.$this->_purchased_list_by_type($listing_id).'}]}';
    }
  
    private function _purchased_list_by_type($listing_id) {
          $sql="SELECT
          a.id
        , a.name as ads_name
        , b.section
        , b.duration
        , c.start_date
        , c.end_date
        , d.name as provider_name
        FROM banner_ads AS a
        INNER JOIN ads_listing AS b ON a.zone_id = b.zone_id
        INNER JOIN campaign AS c ON a.campaign_id = c.campaign_id
        INNER JOIN provider_profile AS d ON c.advertiser_id = d.advertiser_id
        WHERE a.zone_id = ".$listing_id."
        ORDER BY a.id";
          
        $ads = R::getAll($sql);

        return '"ads":' . json_encode($ads);

    }
    
    
    
    
        
}
?>
