<?php

class preview_event extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
      
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        
        $this->event_image_path = $this->config->item('event_image_gen_path');
    
    }

    function index() {
        $message_403 = "Direct access is forbidden.";
        show_error($message_403 , 403 );
        
    }
    
    function read($id){
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/preview_event');
  
 
        $this->bucket->add_css('mums');
        $this->bucket->add_css('RC');
        $this->bucket->add_css('cms');
   

        $this->bucket->set_data('id', $id);
//      $this->bucket->set_data('id_get', $response['id_get']);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
        
        
    }
    
    

    function error() {
        $message_404 = "Either your requested article is removed, or your url is wrong...";
        show_error($message_404 , 404 );
    }
    
    private function _event($event_id) {
    $event = R::getAll("SELECT
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
        , age.name AS age_group_name
        , p.name AS provider_name
        FROM provider_event AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_profile AS p
        ON p.id = a.provider_id
        WHERE a.id = ".$event_id
    );


    return '"event":' . json_encode($event);
  }
    
  
     function event_data($event_id){
      echo '{"event_data": [{'.$this->_event($event_id).'}]}';
  }
  

 }
