<?php

class cms_purchased extends CI_Controller {
   
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
    
       
    
      function add_purchased($listing_id) {
        $this->_check_logged();
//        $provider = $this->_get_details($id);
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/add_purchased');
        $this->bucket->add_css('cms');
//        $this->bucket->set_data('name', $provider['name']);
//        $this->bucket->set_data('advertiser_id', $provider['advertiser_id']);
        $this->bucket->set_data('listing_id', $listing_id);
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
            case ".swf":
                echo $id . $json->{'file_ext'};
                break;
            case ".jpg":
            case ".jpeg":
                $this->media->smart_resize_image($json->{'file_path'}, 0, 0, false,
                        $this->ads_image_gen_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";
                echo $id . ".jpg";
                break;
            case ".png":
                $this->media->smart_resize_image($json->{'file_path'}, 0, 0, false,
                        $this->ads_image_gen_path . $id . ".png", false, false);
                $data['media'] = "media/thumb/" . $id . ".png";
                $data['media_type'] = "image";
                echo $id . ".png";
                break;
            case ".gif":
                $this->media->smart_resize_image($json->{'file_path'}, 0, 0, false,
                        $this->ads_image_gen_path . $id . ".gif", false, false);
                $data['media'] = "media/thumb/" . $id . ".gif";
                $data['media_type'] = "image";
                echo $id . ".gif";
                break;
        }
        
        
    }
    
    
    function purchased_list(){
        echo '{"purchased_list": [{'.$this->_purchased().'}]}';
    }
  
    private function _purchased() {
          $sql="SELECT
          a.id
         ,a.title
         ,a.avatar_filepath
         ,a.duration
         ,a.start_date
         ,a.end_date
         ,b.name AS ads_name
         ,b.section AS section
         ,p.name AS provider_name
        FROM ads_purchased_list AS a
        INNER JOIN ads_listing AS b
        ON b.id = a.ads_id
        INNER JOIN provider_profile AS p
        ON p.id = a.provider_id
        ORDER BY a.id";

        $purchased = R::getAll($sql);

        return '"purchased":' . json_encode($purchased);

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
    
    function create_ad(){
        $response['code'] = 1;
        
        $advertiser_id = $this->input->post('advertiser_id');
        $name = $this->input->post('campaign_name');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $bannerName = $this->input->post('ad_title');
        $imageURL = $this->input->post('image_url');
        $url = $this->input->post('url');
        $width = $this->input->post('width');
        $height = $this->input->post('height');
        $storageType = 'url';
        $listing_id = $this->input->post('listing_id');
        
        $campaignId = $this->mcox->add_campaign($advertiser_id, $name, $start_date, $end_date);
        
        if($campaignId){
            $camp = R::dispense("campaign");
            $camp->name = $name;
            $camp->advertiser_id = $advertiser_id;
            $camp->start_date = $start_date;
            $camp->end_date = $end_date;
            $camp->created_date = date("Y-m-d H:i:s");
            $camp->campaign_id = $campaignId;
            R::store($camp);
            
            $banner_id = $this->mcox->add_banner($campaignId, $bannerName, $storageType, $imageURL, $width, $height, $url);
            
            if($banner_id){
                
                $this->mcox->link_banner_to_zone($listing_id, $banner_id);
                
                $banner = R::dispense("banner_ads");
                $banner->banner_id = $banner_id;
                $banner->name = $bannerName;
                $banner->advertiser_id = $advertiser_id;
                $banner->campaign_id = $campaignId; 
                $banner->storage_type = $storageType;
                $banner->image_url = $imageURL;
                $banner->url = $url;
                $banner->width = $width;
                $banner->height = $height;
                $banner->created_date = date("Y-m-d H:i:s");
                $banner->status = 1;
                $banner->zone_id = $listing_id;
                R::store($banner);
                
                
                $response['code'] = 0;
                $response['message'] = "Ad successfully made";
            }
        }
        
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
