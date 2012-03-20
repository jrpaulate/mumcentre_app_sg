<?php

class Events extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
        $this->load->library('session');
        $this->load->library('mcox');
        $this->meta_description = $this->config->item('description');
        
        $this->mrec1 = $this->_generateTags(45);
        $this->mrec2 = $this->_generateTags(46);
        $this->mrec3 = $this->_generateTags(63);
        $this->mrec4 = $this->_generateTags(112);
        $this->mrec5 = $this->_generateTags(113);
        $this->mrec6 = $this->_generateTags(114);
        
        $this->mini_ad1 = $this->_generateTags(41);
        $this->mini_ad2 = $this->_generateTags(42);
        $this->mini_ad3 = $this->_generateTags(43);

        $this->featban = $this->_generateTags(27);
        
        $this->event_mumad1 = $this->_generateTags(203);
        $this->event_mumad2 = $this->_generateTags(204);
        $this->event_boxad1 = $this->_generateTags(205);
        $this->event_boxad2 = $this->_generateTags(206);
    }
    
    function read($event_slug){
        $event = $this->_find_id($event_slug);
        
        $base = base_url();
        $title = $event['title'];
        $image = $event['image_filepath'];
        $event['summary'] = strip_tags($event['summary']);
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/athan');
        $this->bucket->set_content_id('mumcentre/events');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('article');
        $this->bucket->add_css('style');
        $this->bucket->add_css('events');
        $this->bucket->add_css('RC2');
        $this->bucket->add_css('PSP-Event');
        $this->bucket->add_css('index-style');
//        $this->bucket->set_data('age_group', "Pregnancy");
        $this->bucket->set_data('event_title', $title);
        $this->bucket->set_data('event_id',$event['id']);
        $this->bucket->set_data('age_group',$event['name']);
        
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        
        $this->bucket->set_data('event_mumad1', $this->event_mumad1);
        $this->bucket->set_data('event_mumad2', $this->event_mumad2);
        $this->bucket->set_data('event_boxad1', $this->event_boxad1);
        $this->bucket->set_data('event_boxad2', $this->event_boxad2);
        
        $this->bucket->set_data('description',$event['summary']);
        $this->bucket->set_data('title', 'Mumcentre | Events - '.$title);
        $this->bucket->set_data('og_image', $base."uploaded/provider/event/image/".$image);
        $this->bucket->set_data('og_title', 'Mumcentre - '.$title);
        $this->bucket->set_data('og_type', 'article');
        $this->bucket->set_data('og_url', $base."events/".$event_slug);
        $this->bucket->render_layout();
    }
    
    private function _find_id($event_slug){
       $event_details = R::getRow("SELECT a.id, a.provider_id, a.title, a.summary, a.image_filepath, b.name
            FROM provider_event as a
            INNER JOIN age_group as b ON a.age_group_id = b.id
            WHERE a.seo_url = '".$event_slug."'"
          );
       
       return $event_details;
  }
  
    function all_events_list() {
        echo '{"events": [{' . $this->_all_events_list() . '}]}';
    }
    
    
    private function _all_events_list() {
    
    $sql="SELECT a.title, a.image_filepath, a.time, a.cost, DATE_FORMAT(a.start_date, '%D %b %Y') as start_date, DATE_FORMAT(a.end_date, '%D %b %Y') as end_date, a.seo_url, a.gmap, a.venue, a.contact_person  
    	FROM provider_event as a
        INNER JOIN provider_country as b ON b.provider_id = a.provider_id
        WHERE status = 1
        AND b.country_id = ".$this->config->item('country_id')."
    	";
    
    $events = R::getAll($sql);
    
//    foreach ($articles as &$article) {
//        $article['article_title'] = $this->_trimTitle($article['article_title']);
//        $article['article_link'] = $article['seo_url'];
//        $article['article_summary'] = $this->_trimArticles($article['article_summary']);
//        $article['age_group_name_link'] = url_title($article['age_group_name'],'dash',TRUE);
//        $article['age_group_name_link'] = str_replace("-", "", $article['age_group_name_link']);
//    }
    
    return '"event":' . json_encode($events);
  }
  
  private function _generateTags($zoneId) {
        $ajs = "http://50.19.248.24/openx/www/delivery/ajs.php";
        $loc = urlencode(current_url());
        $cb = rand(0, 99999999999);
        return '<script type="text/javascript" src="' . $ajs . '?zoneid=' . $zoneId .
                '&amp;cb=' . $cb . '&amp;charset=ISO-8859-1&amp;loc=' . $loc . '"></script>';
    }

}

?>