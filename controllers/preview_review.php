<?php

class preview_review extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
      
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        
        $this->review_image_path = $this->config->item('review_image_gen_path');
    
    }

    function index() {
        $message_403 = "Direct access is forbidden.";
        show_error($message_403 , 403 );
        
    }
    
    function read($id){
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/preview_review');
  
 
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
    
    private function _review($review_id) {
    $review = R::getAll("SELECT
          r.id
        , r.title AS review_title
        , r.image_filepath AS review_image
        , r.status AS review_status
        , r.seo_url AS seo_link
        , r.seo_summary AS se_summary
        , r.seo_keywords AS se_keywords
        , p.name AS provider_name
        , age.name AS age_group_name
        FROM provider_review AS r
        INNER JOIN age_group as age
        ON r.age_group_id = age.id
        INNER JOIN provider_profile as p
        ON p.id = r.provider_id
        WHERE r.id = ".$review_id
    );


    return '"review":' . json_encode($review);
  }
    
  
     function review_data($review_id){
      echo '{"review_data": [{'.$this->_review($review_id).'}]}';
  }
  

 }
