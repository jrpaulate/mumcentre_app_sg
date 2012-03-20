<?php

class preview_curriculum extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
      
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        
        $this->curriculum_image_path = $this->config->item('curriculum_image_gen_path');
    
    }

    function index() {
        $message_403 = "Direct access is forbidden.";
        show_error($message_403 , 403 );
        
    }
    
    function read($id){
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/preview_curriculum');
  
 
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
    
    private function _curriculum($curriculum_id) {
    $curriculum= R::getAll("SELECT
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
        WHERE a.id = ".$curriculum_id
    );


    return '"curriculum":' . json_encode($curriculum);
  }
    
  
     function curriculum_data($curriculum_id){
      echo '{"curriculum_data": [{'.$this->_curriculum($curriculum_id).'}]}';
  }
  

 }
