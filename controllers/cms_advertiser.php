<?php
class cms_advertiser extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
        $this->load->library('mcox');
        $this->provider_image_path = $this->config->item('provider_image_gen_path');
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
        $this->bucket->set_content_id('cms/advertiser_list');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    
    function pending_ads($advertiser_id) {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/pending_ad_listing');
        $this->bucket->add_css('cms');
        $provider = $this->_get_details($advertiser_id);
        $this->bucket->set_data('provider_id', $provider['id']);
        $this->bucket->set_data('provider_name', $provider['name']);
        $this->bucket->set_data('advertiser_id', $provider['advertiser_id']);
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    
    
        function active_ads($advertiser_id) {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/active_ads_listing');
        $this->bucket->add_css('cms');
        $provider = $this->_get_details($advertiser_id);
        $this->bucket->set_data('provider_id', $provider['id']);
        $this->bucket->set_data('provider_name', $provider['name']);
        $this->bucket->set_data('advertiser_id', $provider['advertiser_id']);
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    function add_advertiser() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/add_advertiser');
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
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->provider_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".png":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->provider_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".gif":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->provider_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
        }
        
        echo $id . ".jpg";
    }
   
    function provider_list(){
        echo '{"provider_list": [{'.$this->_provider().'}]}';
    }
  
    private function _provider() {
        $sql="SELECT
          a.id
        , a.name AS provider_name
        , a.details AS provider_details
        , a.location AS provider_location
        , a.email_address AS provider_email
        , a.contact_number AS provider_contact
        , a.logo_filepath AS provider_logo
        FROM provider_profile AS a
        WHERE advertiser_id != 0
        ORDER BY a.id";
        
        $provider = R::getAll($sql);
 
        return '"provider":' . json_encode($provider);
    }
    


  
    
    private function _provider_listing() {
        $sql="SELECT
          a.id
        , a.name AS provider_listing_name
        FROM provider_listing as a
        ORDER BY a.id";
        
        $provider_listing = R::getAll($sql);

        return '"provider_listing":' . json_encode($provider_listing);

    }
  
    function provider_listing_list(){
        echo '{"provider_listing_list": [{'.$this->_provider_listing().'}]}';
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
    
    private function _get_details($id){
        
            $sql="SELECT id, name, contact_person, email_address, advertiser_id
            FROM provider_profile
            WHERE id = ".$id;

            $details = R::getRow($sql);
            
            return $details;
        }
    
    
    
     private function _ad_list($ad_id) {
        $sql="SELECT
          a.name
        , a.id
        , a.banner_id
        , a.image_url
        , a.url
        , a.width
        , a.height
        , a.status
        , b.advertiser_id
	, c.section
        FROM banner_ads as a
        INNER JOIN campaign as b ON a.campaign_id = b.campaign_id
	INNER JOIN ads_listing as c ON a.zone_id = c.zone_id
        WHERE b.advertiser_id = ".$ad_id."  
        ORDER BY a.id";
        
        $ad_listing = R::getAll($sql);
        
        foreach ($ad_listing as &$article) {
        if($article['status'] == 1){
            $article['status'] = "Published";
        } else {
            $article['status'] = "Unpublished";
        }
    }

        return '"ads":' . json_encode($ad_listing);

    }
  
    function ad_list($ad_id){
        echo '{"ad_list": [{'.$this->_ad_list($ad_id).'}]}';
    } 
    
    private function _publisher_list() {
        $sql="SELECT
          publisher_id
        , publisher_name
        FROM publisher_table   
        ORDER BY publisher_id";
        
        $pub_listing = R::getAll($sql);

        return '"publisher":' . json_encode($pub_listing);

    }
  
    function publisher_list(){
        echo '{"publisher_list": [{'.$this->_publisher_list().'}]}';
    } 
    
    
    private function _zone_list($pub_id) {
        $sql="SELECT
          zone_id
        , zone_name
        FROM zone_table
        WHERE publisher_id = ".$pub_id."
        ORDER BY zone_id";
        
        $pub_listing = R::getAll($sql);

        return '"zone":' . json_encode($pub_listing);

    }
  
    function zone_list($pub_id){
        echo '{"zone_list": [{'.$this->_zone_list($pub_id).'}]}';
    } 
    
    function link_banner(){
        $response['code'] = 1;
        $zoneId = $this->input->post('zone_id');
        $bannerId = $this->input->post('banner_id');
        
        $this->mcox->link_banner_to_zone($zoneId, $bannerId);
        
        $banner = R::load('banner_ads', $bannerId);
        $banner->status = 1;
        R::store($banner);
        
        $response['code'] = 0;
        $response['message'] = "Ad successfully linked";
    }
    
    
    
    
    private function _active_list($advertiser_id) {
        $sql="SELECT
          a.name
        , a.id
        , a.banner_id
        , a.image_url
        , a.width
        , a.height
        , b.advertiser_id
        FROM banner_ads as a
        INNER JOIN campaign as b ON a.campaign_id = b.campaign_id
        WHERE b.advertiser_id = ".$advertiser_id."
        AND status = 1    
        ORDER BY a.id";
        
        $active_listing = R::getAll($sql);

        return '"active":' . json_encode($active_listing);

    }
  
    function active_list($advertiser_id){
        echo '{"active_list": [{'.$this->_active_list($advertiser_id).'}]}';
    } 
   
  
}
?>
