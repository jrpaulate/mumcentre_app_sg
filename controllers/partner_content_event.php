<?php


class partner_content_event extends CI_Controller {
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
    
    
        function add_event($id){
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/partner');
        $this->bucket->set_content_id('partner_portal/partner_add_event');
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
        $this->bucket->set_content_id('partner_portal/manage_listing_event');
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
    
    
   
     private function _event($provider_id) {
         $sql="SELECT
          a.id
        , a.title AS event_title
        , a.summary AS event_summary
        , a.image_filepath AS event_image
        , a.start_date
        , a.end_date
        , a.time AS event_time
        , a.venue AS event_venue
        , a.status AS event_status
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , a.publish_date AS publish_date
        , a.created_date AS created_date
        , age.name AS age_group_name
        , p.name AS provider_name
        FROM provider_event AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_profile AS p
        ON p.id = a.provider_id
        Where a.provider_id = $provider_id";
        
        $event = R::getAll($sql);
       
        
        foreach ($event as &$a) {
          if($a['event_status'] == 0) {
              $a['event_status'] = 'unpublished';
          } else {
              $a['event_status'] = 'published';
          } 
       
        }
        

        return '"event":' . json_encode($event);
    }
  
    function event_data($provider_id){
        echo '{"event_data": [{'.$this->_event($provider_id).'}]}';
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
    
    
    
    function create_event() {
        $events = R::dispense("provider_event");
        $alert = R::dispense("alert");

        $events->image_filepath = $this->input->post('avatar');
        $events->title = $this->input->post('event_title');
        $events->start_date = $this->input->post('start_date');
        $events->end_date = $this->input->post('end_date');
        $events->time = $this->input->post('event_time');
        $events->venue = $this->input->post('event_venue');
        $events->cost = $this->input->post('event_cost');
        $events->summary = $this->input->post('event_summary');
        $events->body = $this->input->post('event_body');
        $events->contact_person = $this->input->post('event_contact');
        $events->age_group_id = $this->input->post('age_group');
        $events->provider_id = $this->input->post('provider');
        $events->seo_url = $this->input->post('seo_link');
        $events->seo_summary = $this->input->post('se_summary');
        $events->seo_keywords = $this->input->post('se_keywords');
        $events->gmap = $this->input->post('gmap');
        $events->publish_date =$this->input->post('publish_date');
        $events->created_by_id = 0;
        $events->created_date = date("Y-m-d H:i:s");
        if($this->input->post('publish_date') <= date("Y-m-d")) {
            $events->status = 1;
        } else {
            $events->status = 0;
        }    
        
        $event_id = R::store($events);
        
        $alert->content_type = 'Events';
        $alert->content_id = $event_id;
        $alert->title = $this->input->post('event_title');
        $alert->summary = $this->input->post('event_summary');
        $alert->send_date = $this->input->post('sending_date');
        $alert->age_group_id = $this->input->post('age_group');
        $alert->url = $this->input->post('seo_link');        
        $alert->status = 0;
        $alert->created_by_id = 0;
        $alert->created_date = date("Y-m-d H:i:s");
         
        $id = R::store($alert);         

        $response['code'] = 0;
        $response['message'] = "Event successfully created.";

       echo $response['code'] . ":" . $response['message'] ; 
    }

    function event_list(){
        echo '{"event_list": [{'.$this->_event().'}]}';
    }
    
     
    
     
}