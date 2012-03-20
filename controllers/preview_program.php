<?php

class preview_program extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
      
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        
        $this->program_image_path = $this->config->item('program_image_gen_path');
    
    }

    function index() {
        $message_403 = "Direct access is forbidden.";
        show_error($message_403 , 403 );
        
    }
    
    function read($id){
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/preview_program');
  
 
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
    
    private function _program($program_id) {
    $program = R::getAll("SELECT
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
        WHERE a.id = ".$program_id
    );

//    $article[0]['article_body'] = json_decode($article[0]['article_body']);
//    $article[0]['article_link'] = $this->_getArticleLink($article[0]['article_title']);

    return '"program":' . json_encode($program);
  }
    
  
     function program_data($program_id){
      echo '{"program_data": [{'.$this->_program($program_id).'}]}';
  }
  
//  private function _getArticleBody($article_body){
//      echo $article_body;
//      return $article_body;
 }
