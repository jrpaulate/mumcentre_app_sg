<?php

class provider_profile_edit extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
      
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        
         $this->provider_image_path = $this->config->item('provider_image_gen_path');
    
    }
    
    private function _check_logged(){
        if($this->session->userdata('cms_logged_in') != TRUE){
            redirect('cms/login', 'refresh');
        }
    }

    function index() {
        $message_403 = "Direct access is forbidden.";
        show_error($message_403 , 403 );
    }
    
    function read($id){
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/provider_profile_edit');
        $this->bucket->add_css('cms');
   

        $this->bucket->set_data('id', $id);
//      $this->bucket->set_data('id_get', $response['id_get']);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
        
        
    }
    
    
     function edit_provider() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/edit_provider');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    
     function update_provider($id) {
        $provider = R::load('provider_profile',$id);
        $provider->name = $this->input->post('provider_name');
        $provider->details = $this->input->post('provider_details');
        $provider->image_filepath = $this->input->post('avatar');
        $provider->logo_filepath = $this->input->post('avatar1');
        $provider->ticker = $this->input->post('avatar2');
        $provider->email_address = $this->input->post('provider_email');
        $provider->location = $this->input->post('provider_location');
        $provider->contact_number = $this->input->post('provider_contact');
        $provider->url = $this->input->post('provider_link');      
        $provider->gmap = $this->input->post('gmap');       
        $provider->seo_url = $this->input->post('seo_url');
        $provider->seo_summary = $this->input->post('seo_summary');
        $provider->seo_keywords = $this->input->post('seo_keyword');        
        $provider->publish_date = $this->input->post('publish_date');
        $provider->sending_date = $this->input->post('sending_date');
        $provider->expiry_date = $this->input->post('expiry_date');
        $provider->created_by_id = 0;
        $provider->created_date = date("Y-m-d H:i:s");
        
        $id = R::store($provider);
        
        $response['code'] = 0;
        $response['message'] = "Provider successfully created.";

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
    
    function error() {
        $message_404 = "Either your requested article is removed, or your url is wrong...";
        show_error($message_404 , 404 );
    }
    
    private function _provider($provider_id) {
        $sql="SELECT
          a.id
        , a.name AS provider_name
        , a.details AS provider_details
        , a.location AS provider_location
        , a.email_address AS provider_email
        , a.contact_number AS provider_contact
        , a.logo_filepath AS provider_logo
        , a.image_filepath AS provider_image
        , a.ticker AS provider_ticker
        , a.url AS provider_link
        , a.seo_url AS seo_url
        , a.seo_summary AS seo_summary
        , a.seo_keywords AS seo_keywords
        , a.publish_date
        , a.sending_date
        , a.expiry_date
        , a.gmap
        , age.name AS age_group_name
        , p.name AS provider_listing_name
        FROM provider_profile AS a
        INNER JOIN age_group as age
        ON a.age_group_id = age.id
        INNER JOIN provider_listing as p
        ON a.provider_listing_id = p.id
        WHERE a.id = ". $provider_id;

        $provider = R::getAll($sql);

        return '"provider":' . json_encode($provider);
    }
  
    function provider_data($provider_id){
        echo '{"provider_data": [{'.$this->_provider($provider_id).'}]}';
    }
  
    private function _age_groups() {
        $sql="SELECT
          a.id
        , a.name AS age_group_name
        FROM age_group as a
        ORDER BY a.id";
        
        $age_groups = R::getAll($sql);

        return '"age_groups":' . json_encode($age_groups);

    }
  
    function age_group_list(){
        echo '{"age_group_list": [{'.$this->_age_groups().'}]}';
    }
    
    private function _provider_listing() {
        $sql="SELECT
          a.id
        , a.name provider_listing_name
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

}
