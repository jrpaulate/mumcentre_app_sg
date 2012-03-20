<?php

class provider_event_edit extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
      
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        
        $this->event_image_path = $this->config->item('event_image_gen_path');
    
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
        $this->bucket->set_content_id('cms/provider_event_edit');
        $this->bucket->add_css('cms');
   

        $this->bucket->set_data('id', $id);
//      $this->bucket->set_data('id_get', $response['id_get']);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
        
        
    }
    
    
     function edit_event() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/edit_event');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    
    function update_event($id) {
        $event = R::load('provider_event',$id);
        $event->title = $this->input->post('event_title');
        $event->image_filepath = $this->input->post('avatar');
        $event->summary = $this->input->post('event_summary');
        $event->body = $this->input->post('event_body');
        $event->venue = $this->input->post('event_venue');
        $events->cost = $this->input->post('event_cost');
        $event->contact_person = $this->input->post('event_contact');
        $event->start_date = $this->input->post('start_date');
        $event->end_date = $this->input->post('end_date');
        $event->time = $this->input->post('event_time');        
        $event->provider_id = $this->input->post('provider');
 //       $event->age_group_id = $this->input->post('age_group');
        $events->seo_url = $this->input->post('seo_url');
        $events->seo_summary = $this->input->post('seo_summary');
        $events->seo_keywords = $this->input->post('seo_keywords');
        $events->publish_date = $this->input->post('publish_date');
        $events->send_date = $this->input->post('send_date');
        $event->status = 1;
        $event->created_date = date("Y-m-d H:i:s");
        $id = R::store($event);
        
        $response['code'] = 0;
        $response['message'] = "Event successfully updated.";

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
                        $this->event_image_path . $id . ".jpg", false, false);
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
    
    function error() {
        $message_404 = "Either your requested article is removed, or your url is wrong...";
        show_error($message_404 , 404 );
    }
    
    private function _event($event_id) {
    $event = R::getAll("SELECT a.id, 
    a.title AS event_title, 
    a.summary AS event_summary,
    a.body AS event_body,
    a.image_filepath AS event_image, 
    a.start_date, a.end_date, 
    a.send_date,
    a.publish_date,
    a.time, 
    a.venue, a.status AS event_status, 
    a.seo_url, a.seo_summary, 
    a.seo_keywords, age.name AS age_group_name,  
    p.name AS provider_name,
    p.id AS provider_id,
    
    age.name as age_group_name,
    age.id as age_group_id
    FROM provider_event as a 
    INNER JOIN age_group AS age
    ON a.age_group_id = age.id
    INNER JOIN provider_profile as p
    ON p.id = a.provider_id
    WHERE a.id = ".$event_id
    );


    return '"event":' . json_encode($event);
  }
    
  
     function event_data($event_id){
      echo '{"event_data": [{'.$this->_event($event_id).'}]}';
  }
  
  
   private function _providers() {
    $providers = R::getAll("SELECT p.id, p.provider_name
    FROM provider_profile as p
    ORDER BY p.id");
    
    return '"providers":' . json_encode($providers);
 
  }
  
  function provider_list(){
      echo '{"provider_list": [{'.$this->_providers().'}]}';
    }
  
  
  private function _age_groups() {
    $age_groups = R::getAll("SELECT a.id, a.age_group_name
    FROM age_group as a
    ORDER BY a.id");

//    foreach ($highlights as &$highlight) {
//      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
//    }

    return '"age_groups":' . json_encode($age_groups);
    //echo $this->_json_response('featured_event', $event);
  }

  function age_group_list(){
      echo '{"age_group_list": [{'.$this->_age_groups().'}]}';
    }

}