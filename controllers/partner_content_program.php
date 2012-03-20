<?php


class partner_content_program extends CI_Controller {
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
    
    
        function add_program($id){
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/partner_add_program');
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
        $this->bucket->set_content_id('partner_portal/manage_listing_program');
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
    
    
   
     private function _program($provider_id) {
         $sql="SELECT
         a.id
        , a.title AS program_title
        , a.summary AS program_summary
        , a.body AS program_body
        , a.image_filepath AS program_image
        , a.status AS program_status
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_summary AS se_keywords
        , age.name AS age_group_name
        , p.name AS provider_name
        FROM provider_program AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_profile AS p
        ON p.id = a.provider_id
        Where a.provider_id = $provider_id";
        
        $program = R::getAll($sql);
       
        
        foreach ($program as &$a) {
          if($a['program_status'] == 0) {
              $a['program_status'] = 'unpublished';
          } else {
              $a['program_status'] = 'published';
          } 
       
        }
        

        return '"program":' . json_encode($program);
    }
  
    function program_data($provider_id){
        echo '{"program_data": [{'.$this->_program($provider_id).'}]}';
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
    
    
    
   function create_program() {
       
        $program = R::dispense("provider_program");
        $alert = R::dispense("alert");

        $program->title = $this->input->post('title');
        $program->image_filepath = $this->input->post('avatar');
        $program->summary = $this->input->post('summary');
        $program->body = $this->input->post('program');
        $program->seo_url = $this->input->post('seo_link');
        $program->seo_summary = $this->input->post('se_summary');
        $program->seo_keywords = $this->input->post('se_keywords');
        $program->age_group_id = $this->input->post('age_group');
        $program->provider_id = $this->input->post('provider');
        $program->gmap = $this->input->post('gmap');
        $program->publish_date = $this->input->post('publish_date');
        $program->created_by_id = 0; 
        $program->created_date = date("Y-m-d H:i:s");
        if($this->input->post('publish_date') <= date("Y-m-d")) {
            $program->status = 1;
        } else {
            $program->status = 0;
        }          
        $program_id = R::store($program);

        $alert->content_type = 'Program';
        $alert->content_id = $program_id;
        $alert->title = $this->input->post('title');
        $alert->summary = $this->input->post('summary');
        $alert->send_date = $this->input->post('sending_date');
        $alert->age_group_id = $this->input->post('age_group');
        $alert->url = $this->input->post('seo_link');        
        $alert->status = 0;
        $alert->created_by_id = 0;
        $alert->created_date = date("Y-m-d H:i:s");

        $article_id = R::store($alert);
        

        $response['code'] = 0;
        $response['message'] = "Program successfully created.";

        echo $response['code'] . ":" . $response['message'] ;  
    }

    function program_list(){
        echo '{"program_list": [{'.$this->_program().'}]}';
    }
    
     
    
     
}