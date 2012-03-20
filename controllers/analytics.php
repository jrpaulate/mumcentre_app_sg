<?php

class Analytics extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('rb');
        $this->load->library('piwik');
        $this->load->library('bucket');
        $this->load->library('session');
    }

    function index() {        
        $this->bucket->set_layout_id('mumcentre/blank');
        $this->bucket->set_content_id('mumcentre/analytics');
        $this->bucket->set_data('title', "Mumcentre | Analytics");
        $this->bucket->render_layout();        
    }
    
    function get_page_actions($period,$count) {
        $response = $this->piwik->page_titles($period, $count);
        echo json_encode($response);
    }

    function get_url_actions($period,$count) {
        $response = $this->piwik->page_urls($period, $count);
        echo json_encode($response);
    }    
    
    function get_url_stats() {
        $response = $this->piwik->url_stats($this->input->get('url'),
                $this->input->get('period'),$this->input->get('count'));
        echo json_encode($response);        
    }
    
    function get_url_stats_range() {
        $response = $this->piwik->url_stats_range($this->input->get('url'),
                $this->input->get('from'),$this->input->get('to'));
        echo json_encode($response);        
    }
    
    function get_event_url($event_id){
//        $event_id = $this->input->get('event_id');
        $event_data = $this->_get_event_data($event_id);
        
        $url = $event_data['base_url'].'/events/'.$event_data['seo_url'];
        
//        $response = $this->piwik->url_stats($url,'day',1);
        
//        echo json_encode($response);
        echo $url;
    }
    
    private function _get_event_data($event_id){
        $sql = R::getRow("
        SELECT
        a.seo_url
        ,b.country_id
        ,c.url as base_url
        FROM provider_event as a
        INNER JOIN provider_country as b ON a.provider_id = b.provider_id
        INNER JOIN country as c ON b.country_id = c.id
        WHERE a.id = ".$event_id
        );
        
        return $sql;
    }
}