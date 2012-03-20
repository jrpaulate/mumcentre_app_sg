<?php

    class cms_provider_content extends CI_Controller {
        
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->library('rb');
        $this->load->library('session');
        $this->load->library('mcapi');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('miscfuncs');
        
    }


     function content(){
            $this->load->library('bucket');
            $this->bucket->set_layout_id('mumcentre/cms_layout');
            $this->bucket->set_content_id('cms/provider_content');
            $this->bucket->add_css('cms');
            $this->bucket->add_css('partner_style');
            $this->bucket->set_data('title', "Mumcentre CMS");
            $this->bucket->render_layout();
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
    
    
    
    
     private function _review($provider_id) {
         $sql="SELECT
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
        Where r.provider_id = $provider_id";
        
        $review= R::getAll($sql);
       
        
        foreach ($review as &$a) {
          if($a['review_status'] == 0) {
              $a['review_status'] = 'unpublished';
          } else {
              $a['review_status'] = 'published';
          } 
       
        }
        

        return '"review":' . json_encode($review);
    }
  
    function review_data($provider_id){
        echo '{"review_data": [{'.$this->_review($provider_id).'}]}';
    }
    
    
    
    
    private function _provider($provider_id) {
        $sql="SELECT
          a.id AS id
        , a.name AS provider_name
        , a.details AS provider_details
        , a.location AS provider_location
        , a.email_address AS provider_email
        , a.contact_number AS provider_contact
        , a.logo_filepath AS provider_logo
        , a.image_filepath AS provider_image
        , a.ticker AS provider_ticker
        , a.url AS provider_link
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , age.name AS age_group_name
        , p.name AS provider_listing_name
        FROM provider_profile AS a
        INNER JOIN age_group as age
        ON a.age_group_id = age.id
        INNER JOIN provider_listing as p
        ON a.provider_listing_id = p.id
        Where a.id = $provider_id
        ORDER BY a.name ASC";

        $provider = R::getAll($sql);

        return '"provider":' . json_encode($provider);
    }
  
    function provider_data($provider_id){
        echo '{"provider_data": [{'.$this->_provider($provider_id).'}]}';
    }
    
    
    
    
    }
    
?>
