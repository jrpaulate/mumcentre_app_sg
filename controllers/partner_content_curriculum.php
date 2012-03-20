<?php


class partner_content_curriculum extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->library('rb');
        $this->load->library('session');
        $this->load->library('mcapi');
        $this->load->helper(array('form', 'url'));
        $this->event_image_path = $this->config->item('event_image_gen_path');
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
    
    
        function add_curriculum($id){
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/partner_add_curriculum');
        $this->bucket->add_css('cms');
        $this->bucket->add_css('partner_style');
        
        $this->bucket->set_data('id', $id);
        $this->bucket->set_data('title', "Mumcentre - Partner Portal");
        $this->bucket->render_layout();
    }
    
    
    
        function read($id){
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/manage_listing_curriculum');
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
                        $this->event_image_path. $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".png":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->event_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".gif":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->event_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
        }
        
        echo $id . ".jpg";
    }
    
    
   
     private function _curriculum($provider_id) {
         $sql="SELECT
         a.id
        , a.title As curriculum_title
        , a.author AS curriculum_author
        , a.summary AS curriculum_summary
        , a.body AS curriculum_body
        , a.image_filepath AS curriculum_image
        , a.status AS curriculum_status
        , age.name AS age_group_name
        , p.name AS provider_name
        FROM provider_curriculum AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_profile as p
        ON p.id = a.provider_id
        Where a.provider_id = $provider_id";
        
        $curriculum = R::getAll($sql);
       
        
        foreach ($curriculum as &$a) {
          if($a['curriculum_status'] == 0) {
              $a['curriculum_status'] = 'unpublished';
          } else {
              $a['curriculum_status'] = 'published';
          } 
       
        }
        

        return '"curriculum":' . json_encode($curriculum);
    }
  
    function curriculum_data($provider_id){
        echo '{"curriculum_data": [{'.$this->_curriculum($provider_id).'}]}';
    }

    
    
    private function _provider($provider_id) {
        $sql="SELECT
          p.id
        , p.name AS provider_name
        FROM provider_profile as p
        Where p.id = $provider_id";

        $provider = R::getAll($sql);


        return '"provider":' . json_encode($provider);
       
    }

     function provider_data($provider_id){
        echo '{"provider_data": [{'.$this->_provider($provider_id).'}]}';
    }
    
    
    
  function create_curriculum() {
        $curriculum = R::dispense("provider_curriculum");
        $alert = R::dispense("alert");
         
        $curriculum->title = $this->input->post('title');
        $curriculum->image_filepath = $this->input->post('avatar');
        $curriculum->summary = $this->input->post('summary');
        $curriculum->body = $this->input->post('curriculum');
        $curriculum->age_group_id = $this->input->post('age_group');
        $curriculum->provider_id = $this->input->post('provider');
        $curriculum->seo_url = $this->input->post('seo_link');
        $curriculum->seo_summary = $this->input->post('se_summary');
        $curriculum->seo_keywords = $this->input->post('se_keywords');
        $curriculum->sending_date = $this->input->post('sending_date');
        $curriculum->publish_date = $this->input->post('publish_date');
        $curriculum->gmap = $this->input->post('gmap');
        $curriculum->created_by_id = 0;
        $curriculum->created_date = date("Y-m-d H:i:s");
        if($this->input->post('publish_date') <= date("Y-m-d")) {
            $curriculum->status = 1;
        } else {
            $curriculum->status = 0;
        }
        
        $curriculum_id = R::store($curriculum);
        
        $alert->content_type = 'Curriculum';
        $alert->content_id = $curriculum_id;
        $alert->title = $this->input->post('title');
        $alert->summary = $this->input->post('summary');
        $alert->send_date = $this->input->post('sending_date');
        $alert->age_group_id = $this->input->post('age_group');
        $alert->url = $this->input->post('seo_link');        
        $alert->status = 0;
        $alert->created_by_id = 0;
        $alert->created_date = date("Y-m-d H:i:s");
                
        $id = R::store($alert);

        $response['code'] = 0;
        $response['message'] = "Curriculum & Alerts successfully created.";

        echo $response['code'] . ":" . $response['message'] ;
    }

    function curriculum_list(){
        echo '{"curriculum_list": [{'.$this->_curriculum().'}]}';
    }
    
     
    
     
}