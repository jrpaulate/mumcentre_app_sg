<?php

class cms_edit_ads extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->library('session');
        $this->load->library('mcox');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
        $this->ads_image_gen_path = $this->config->item('ads_image_gen_path');
    
    
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
            $this->bucket->set_content_id('cms/cms_dashboard');
            $this->bucket->add_css('cms');
            $this->bucket->set_data('title', "Mumcentre CMS");
            $this->bucket->render_layout();

    }
    
       
    
      function edit($id) {
        $this->_check_logged();

        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/edit_ads');
        $this->bucket->add_css('cms');

        $this->bucket->set_data('id', $id);      
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    
    
    
    
    
    
    private function _banner($id) {
        $sql="SELECT
          a.campaign_id
        , a.id as a_id
        , a.banner_id  
        , a.image_url
        , a.url
        , a.advertiser_id
        , b.name AS campaign_name
        , b.start_date
        , b.end_date
        , b.id as c_id
      
        FROM banner_ads AS a
        INNER JOIN campaign as b
        ON a.campaign_id = b.campaign_id
        WHERE a.id = ".$id;

        $banner = R::getAll($sql);

 
        return '"banner":' . json_encode($banner);
    }
      
    function banner_data($id){
        echo '{"banner_data": [{'.$this->_banner($id).'}]}';
    }
    
    
    

  
     private function _ads() {
        $sql="SELECT
          a.id
        , a.name 
        , a.section 
        FROM ads_listing as a
        ORDER BY a.id";

        $ads = R::getAll($sql);

        return '"ads":' . json_encode($ads);
     
    }

    function ads_list(){
        echo '{"ads_list": [{'.$this->_ads().'}]}';
    }
    
    
    
    private function _ads1($id) {
        $sql="SELECT
          a.id
        , a.name 
        , a.section 
        , a.width
        , a.height
        , a.price
        , a.duration
        FROM ads_listing as a
        WHERE a.zone_id = ".$id;
        

        $ads1 = R::getAll($sql);

        return '"ads1":' . json_encode($ads1);
     
    }

    function ads1_list($id){
        echo '{"ads1_list": [{'.$this->_ads1($id).'}]}';
    }
 
    
    
    private function _get_details($id){
        
            $sql="SELECT name, contact_person, email_address, advertiser_id
            FROM provider_profile
            WHERE id = ".$id;

            $details = R::getRow($sql);
            
            return $details;
        }
    
    function update_ad(){
      
        $campaign_id = $this->input->post('campaign_id');
        $advertiser_id = $this->input->post('advertiser_id');
        $banner_id = $this->input->post('banner_id');
        $a_id = $this->input->post('a_id');
        $c_id = $this->input->post('c_id');
        $name = $this->input->post('campaign_name');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');              
        $url = $this->input->post('url');
      
        
      
        
     
            $camp = R::load('campaign', $c_id);
            $camp->name = $name;
            $camp->advertiser_id = $advertiser_id;
            $camp->start_date = $start_date;
            $camp->end_date = $end_date;
            $camp->created_date = date("Y-m-d H:i:s");
            $camp->campaign_id = $campaign_id;
            $id = R::store($camp);
            
           $campaign_id = $this->mcox->updateCampaign($campaign_id,$name,$advertiser_id,$start_date,$end_date);
            
           $campaign_id = $this->input->post('campaign_id');
            
           
                               
                $banner = R::load('banner_ads', $a_id);
                $banner->banner_id = $banner_id;
                $banner->campaign_id = $campaign_id;       
                $banner->advertiser_id = $advertiser_id;              
                $banner->url = $url;               
                $banner->created_date = date("Y-m-d H:i:s");
                            
                $id = R::store($banner);
                
                
                $banner_id = $this->mcox->updateBannerTarget($banner_id, $url);
                
                
                $response['code'] = 0;
                $response['message'] = "Ad successfully Updated";
            
       
        
        echo $response['code'] . ":" . $response['message'] ;
            
    }
    
    
    private function _provider_list() {
        $sql="SELECT
          a.id
        , a.name
        FROM provider_profile as a
        ORDER by a.name";
        

        $ads1 = R::getAll($sql);

        return '"provider":' . json_encode($ads1);
     
    }

    function provider_list(){
        echo '{"provider_list": [{'.$this->_provider_list().'}]}';
    }
    
    function get_advertiser_id(){
        $provider_id = $this->input->post('id');
        
        $sql="SELECT
          advertiser_id
        FROM provider_profile
        WHERE id = ".$provider_id;
        
        $ad_id = R::getRow($sql);
        
        echo $ad_id['advertiser_id'];
    }
    
} 
   
  

?>
