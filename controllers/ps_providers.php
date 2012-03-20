<?php

class Ps_Providers extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
        $this->load->library('mcox');
        $this->meta_description = $this->config->item('description');
        $this->base = base_url();
        
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
    }

    function index() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/ps_providers');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('PSP-Directory');
        $this->bucket->set_data('title', "Mumcentre");
        
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
        
        $this->bucket->render_layout();
    }

    function curriculums($provider_id, $part_id=0) {
        $this->load->library('bucket');
        $provider_meta = $this->_provider_meta($provider_id);
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/ps_curriculum');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('PSP-Curriculum');
        $this->bucket->set_data('part_id', $part_id);
        $this->bucket->set_data('provider_id', $provider_id);
        
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
        
        $this->bucket->set_data('description', $this->meta_description);
        $this->bucket->set_data('title', 'Mumcentre - Curriculums by '.$provider_meta['provider_name']);
        $this->bucket->set_data('og_image', $this->base."uploads/provider/logo/".$provider_meta['provider_logo']);
        $this->bucket->set_data('og_type', 'product');
        $this->bucket->set_data('og_url', $this->base."ps_providers/curriculums/".$provider_id);
        
        $this->bucket->render_layout();
    }

    function events($provider_id, $part_id=0) {
        $this->load->library('bucket');
        $provider_meta = $this->_provider_meta($provider_id);
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/ps_event');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('PSP-Event');
        $this->bucket->set_data('part_id', $part_id);
        $this->bucket->set_data('provider_id', $provider_id);
        
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
        
        $this->bucket->set_data('description', $this->meta_description);
        $this->bucket->set_data('title', 'Mumcentre - Events by '.$provider_meta['provider_name']);
        $this->bucket->set_data('og_image', $this->base."uploads/provider/logo/".$provider_meta['provider_logo']);
        $this->bucket->set_data('og_type', 'product');
        $this->bucket->set_data('og_url', $this->base."ps_providers/events/".$provider_id);
        
        $this->bucket->render_layout();
    }

    function location($provider_id) {
        $this->load->library('bucket');
        $provider_meta = $this->_provider_meta($provider_id);
        $this->bucket->set_layout_id('mumcentre/desktop_fb');
        $this->bucket->set_content_id('mumcentre/ps_location');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('PSP-Location');
        $this->bucket->set_data('provider_id', $provider_id);
        
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
        
        $this->bucket->set_data('description', $this->meta_description);
        $this->bucket->set_data('title', 'Mumcentre - Location of '.$provider_meta['provider_name']);
        $this->bucket->set_data('og_image', $this->base."uploads/provider/logo/".$provider_meta['provider_logo']);
        $this->bucket->set_data('og_type', 'product');
        $this->bucket->set_data('og_url', $this->base."ps_providers/location/".$provider_id);
        
        $this->bucket->render_layout();
    }

    function profile($provider_id) {
        $this->load->library('bucket');
        $provider_meta = $this->_provider_meta($provider_id);
        $this->bucket->set_layout_id('mumcentre/desktop_fb');
        $this->bucket->set_content_id('mumcentre/ps_profile');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('PSP-Profile');
        $this->bucket->set_data('provider_id', $provider_id);
        
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
        
        $this->bucket->set_data('description', $this->meta_description);
        $this->bucket->set_data('title', 'Mumcentre - '.$provider_meta['provider_name']);
        $this->bucket->set_data('og_image', $this->base."uploads/provider/logo/".$provider_meta['provider_logo']);
        $this->bucket->set_data('og_type', 'product');
        $this->bucket->set_data('og_url', $this->base."ps_providers/profile/".$provider_id);
        
        $this->bucket->render_layout();
    }
    
    private function _provider_meta($provider_id){
        $meta = R::getRow("SELECT name as provider_name, details as provider_details, logo_filepath as provider_logo
            FROM provider_profile
            WHERE id = ".$provider_id
          );
        return $meta;
    }
    
    function category($category_id) {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/ps_categories');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('PSP-Directory');
        $this->bucket->set_data('category_id', $category_id);
        $this->bucket->set_data('title', "Mumcentre");
        
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
        
        $this->bucket->render_layout();
    }

    function programs($provider_id, $part_id=0) {
        $this->load->library('bucket');
        $provider_meta = $this->_provider_meta($provider_id);
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/ps_programs');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('PSP-Programs');
        $this->bucket->set_data('part_id', $part_id);
        $this->bucket->set_data('provider_id', $provider_id);
        
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
        
        $this->bucket->set_data('description', $this->meta_description);
        $this->bucket->set_data('title', 'Mumcentre - Programs by '.$provider_meta['provider_name']);
        $this->bucket->set_data('og_image', $this->base."uploads/provider/logo/".$provider_meta['provider_logo']);
        $this->bucket->set_data('og_type', 'product');
        $this->bucket->set_data('og_url', $this->base."ps_providers/programs/".$provider_id);
        
        $this->bucket->render_layout();
    }

    function reviews($provider_id, $part_id=0) {
        $this->load->library('bucket');
        $provider_meta = $this->_provider_meta($provider_id);
        $this->bucket->set_layout_id('mumcentre/desktop_fb');
        $this->bucket->set_content_id('mumcentre/ps_reviews');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('PSP-Review');
        $this->bucket->set_data('part_id', $part_id);
        $this->bucket->set_data('provider_id', $provider_id);
        
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
        
        $this->bucket->set_data('description', $this->meta_description);
        $this->bucket->set_data('title', 'Mumcentre - Reviews by '.$provider_meta['provider_name']);
        $this->bucket->set_data('og_image', $this->base."uploads/provider/logo/".$provider_meta['provider_logo']);
        $this->bucket->set_data('og_type', 'product');
        $this->bucket->set_data('og_url', $this->base."ps_providers/reviews/".$provider_id);
        
        $this->bucket->render_layout();
    }

    private function _provider_list() {
        $providers = R::getAll("SELECT p.id, p.name as provider_name, p.location as provider_location, p.email_address as provider_email, p.contact_number as provider_contact, p.url as provider_link, p.logo_filepath as provider_logo
    FROM provider_profile AS p
    INNER JOIN provider_country as a ON p.id = a.provider_id
    WHERE a.country_id = ".$this->config->item('country_id')."
    AND p.status = 1
    ORDER BY p.name
    ");

        return '"providers":' . json_encode($providers);
    }

    private function _provider_detail($provider_id) {
        $providers = R::getAll("SELECT p.name as provider_name, p.details as provider_details, p.location as provider_location, p.email_address as provider_email, p.contact_number as provider_contact, p.url as provider_link, p.logo_filepath as provider_logo, p.image_filepath as provider_image, p.gmap, c.name as category_name
    FROM provider_profile AS p INNER JOIN category as c
    ON p.category_id = c.id
    WHERE p.id = " . $provider_id
        );

//    foreach ($providers as &$provider) {
//        $provider['provider_details'] = trim($provider['provider_details'],"\"");
//    }

        return '"providers":' . json_encode($providers);
    }

    private function _crumbs($provider_id) {
        $crumbs = R::getAll("SELECT p.name as provider_name, p.category_id, c.name as category_name
    FROM provider_profile AS p INNER JOIN category as c
    ON p.category_id = c.id
    WHERE p.id = " . $provider_id
        );
        
        foreach ($crumbs as &$c){
            $c['provider_name'] = $this->_trimProviderName($c['provider_name']);
        }
        
        return '"crumbs":' . json_encode($crumbs);
    }

    private function _categories($category_id) {
        $providers = R::getAll("SELECT p.id, p.name as provider_name, p.details as provider_details, p.location as provider_location, p.email_address as provider_email, p.contact_number as provider_contact, p.url as provider_link, p.logo_filepath as provider_logo, p.image_filepath as provider_image, c.name as category_name
    FROM provider_profile AS p INNER JOIN category as c
    ON p.category_id = c.id
    INNER JOIN provider_country as a ON p.id = a.provider_id
    WHERE a.country_id = ".$this->config->item('country_id')."
    AND p.category_id = " . $category_id
        );



        return '"providers":' . json_encode($providers);
    }

    private function _search_provider($keyword) {
    $keyword = $this->input->get("keyword");    
        $providers = R::getAll("SELECT p.id, p.name as provider_name, p.details as provider_details, p.location as provider_location, p.email_address as provider_email, p.contact_number as provider_contact, p.url as provider_link, p.logo_filepath as provider_logo, p.image_filepath as provider_image, c.name as category_name
    FROM provider_profile AS p INNER JOIN category as c
    ON p.category_id = c.id
    INNER JOIN provider_country as a ON p.id = a.provider_id
    WHERE a.country_id = ".$this->config->item('country_id')."	
    AND p.status = 1
    AND p.name LIKE '%" . $keyword . "%' 
    ORDER BY p.name     
    ");

       
        return '"providers":' . json_encode($providers);
    }

    private function _search_provider_letter($letter) {
        $providers = R::getAll("SELECT p.id, p.name as provider_name, p.details as provider_details, p.location as provider_location, p.email_address as provider_email, p.contact_number as provider_contact, p.url as provider_link, p.logo_filepath as provider_logo, p.image_filepath as provider_image, c.name as category_name
    FROM provider_profile AS p INNER JOIN category as c
    ON p.category_id = c.id
    INNER JOIN provider_country as a ON p.id = a.provider_id
    WHERE a.country_id = ".$this->config->item('country_id')."
    AND p.status = 1
    AND p.name LIKE '" . $letter . "%' 
    ORDER BY p.name     
    ");

//    foreach ($providers as &$provider) {
//        $provider['provider_details'] = trim($provider['provider_details'],"\"");
//    }

        return '"providers":' . json_encode($providers);
    }

    private function _category_list() {
        $categories = R::getAll("SELECT c.id, c.name as category_name
    FROM category as c"
        );

//    foreach ($providers as &$provider) {
//        $provider['provider_details'] = trim($provider['provider_details'],"\"");
//    }

        return '"categories":' . json_encode($categories);
    }

    function provider_data() {
        echo '{"provider_data": [{' . $this->_provider_list() . '}]}';
    }

    function provider_profile($provider_id) {
        echo '{"provider_profile": [{' . $this->_provider_detail($provider_id) . '}]}';
    }

    function provider_crumbs($provider_id) {
        echo '{"provider_crumbs": [{' . $this->_crumbs($provider_id) . '}]}';
    }

    function provider_categories($category_id) {
        if ($category_id > 0) {
            echo '{"provider_categories": [{' . $this->_categories($category_id) . '}]}';
        } else {
            echo '{"provider_categories": [{' . $this->_provider_list() . '}]}';
        }
    }

    function category_list() {
        echo '{"category_list": [{' . $this->_category_list() . '}]}';
    }

    function search_provider() {
        $keyword = $this->input->get("keyword");
        echo '{"provider_categories": [{' . $this->_search_provider($keyword) . '}]}';
    }

    function provider_letter($letter) {
        echo '{"provider_categories": [{' . $this->_search_provider_letter($letter) . '}]}';
    }

    private function _reviews($provider_id) {
        $reviews = R::getAll("SELECT r.id, r.title as review_title, r.image_filepath as review_image, r.status as review_status, r.summary as review_summary, r.body as review_body, r.gmap
    FROM provider_review as r
    WHERE r.provider_id = " . $provider_id . "
    AND r.status = 1    
    ORDER BY r.id");

        foreach ($reviews as &$r) {
            $r['review_link'] = $this->_getLink($r['review_title']);
        }
//    foreach ($highlights as &$highlight) {
//      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
//    }

        return '"reviews":' . json_encode($reviews);
        //echo $this->_json_response('featured_articles', $articles);
    }

    function review_list($provider_id) {
        echo '{"review_list": [{' . $this->_reviews($provider_id) . '}]}';
    }

    private function _programs($provider_id) {
        $programs = R::getAll("SELECT p.id, p.title as program_title, p.image_filepath as program_image, p.summary as program_summary, p.gmap
    FROM provider_program as p
    WHERE p.provider_id = " . $provider_id . "

    AND p.status = 1    
    ORDER BY p.id");

//    foreach ($highlights as &$highlight) {
//      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
//    }

        return '"programs":' . json_encode($programs);
        //echo $this->_json_response('featured_articles', $articles);
    }

    function program_list($provider_id) {
        echo '{"program_list": [{' . $this->_programs($provider_id) . '}]}';
    }

    private function _events($provider_id) {
        $events = R::getAll("SELECT e.id, e.title as event_title, e.image_filepath as event_image, e.summary as event_summary, e.venue as event_venue, e.contact_number as event_contact, e.time as event_time, e.cost as event_cost, e.gmap, DATE_FORMAT(start_date, '%D %b %Y') as start_date, DATE_FORMAT(end_date, '%D %b %Y') as end_date
    FROM provider_event as e
    WHERE e.provider_id = " . $provider_id . "
    AND e.status = 1    
    ORDER BY e.id");

//    foreach ($highlights as &$highlight) {
//      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
//    }

        return '"events":' . json_encode($events);
        //echo $this->_json_response('featured_articles', $articles);
    }

    function event_list($provider_id) {
        echo '{"event_list": [{' . $this->_events($provider_id) . '}]}';
    }

    private function _curriculums($provider_id) {
        $curriculums = R::getAll("SELECT c.id, c.title as curriculum_title, c.image_filepath as curriculum_image, c.summary as curriculum_summary, c.gmap
    FROM provider_curriculum as c
    WHERE c.provider_id = " . $provider_id . "
    AND c.status = 1    
    ORDER BY c.id");

//    foreach ($highlights as &$highlight) {
//      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
//    }

        return '"curriculums":' . json_encode($curriculums);
        //echo $this->_json_response('featured_articles', $articles);
    }

    function curriculum_list($provider_id) {
        echo '{"curriculum_list": [{' . $this->_curriculums($provider_id) . '}]}';
    }

    function event_data($event_id) {
        echo '{"event_data": [{' . $this->_event_profile($event_id) . '}]}';
    }

    private function _event_profile($event_id) {
        $sql="UPDATE provider_event
                SET total_views = total_views + 1,
                    last_viewed_week = YEARWEEK(NOW()),
                    last_viewed = NOW()
            WHERE id = ".$event_id;            
        R::exec($sql);
        
        $event = R::getAll("SELECT e.id, e.provider_id, e.title as event_title, e.body as event_body, e.image_filepath as event_image, e.summary as event_summary, e.venue as event_venue, e.contact_number as event_contact, e.time as event_time, e.cost as event_cost, e.gmap, DATE_FORMAT(start_date, '%D %b %Y') as start_date, DATE_FORMAT(end_date, '%D %b %Y') as end_date
    FROM provider_event as e
    WHERE e.id = " . $event_id . "
    AND e.status = 1    
    ORDER BY e.id");

        foreach ($event as &$r) {
            $r['event_link'] = $this->_getLink($r['event_title']);
        }
//    foreach ($highlights as &$highlight) {
//      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
//    }

        return '"event":' . json_encode($event);
        //echo $this->_json_response('featured_articles', $articles);
    }

    function program_data($program_id) {
        echo '{"program_data": [{' . $this->_program_profile($program_id) . '}]}';
    }

    private function _program_profile($program_id) {
        $sql="UPDATE provider_program
                SET total_views = total_views + 1,
                    last_viewed_week = YEARWEEK(NOW()),
                    last_viewed = NOW()
            WHERE id = ".$program_id;            
        R::exec($sql);
        
        $program = R::getAll("SELECT p.id, p.title as program_title, p.image_filepath as program_image, p.summary as program_summary, p.body as program_body, p.gmap, p.provider_id
    FROM provider_program as p
    WHERE p.id = " . $program_id . "
    AND p.status = 1    
    ORDER BY p.id");

        foreach ($program as &$r) {
            $r['program_link'] = $this->_getLink($r['program_title']);
        }
//    foreach ($highlights as &$highlight) {
//      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
//    }

        return '"program":' . json_encode($program);
        //echo $this->_json_response('featured_articles', $articles);
    }

    function curriculum_data($curriculum_id) {
        echo '{"curriculum_data": [{' . $this->_curriculum_profile($curriculum_id) . '}]}';
    }

    private function _curriculum_profile($curriculum_id) {
        $sql="UPDATE provider_curriculum
                SET total_views = total_views + 1,
                    last_viewed_week = YEARWEEK(NOW()),
                    last_viewed = NOW()
            WHERE id = ".$curriculum_id;            
        R::exec($sql);
        
        $curriculum = R::getAll("SELECT c.id, c.title as curriculum_title, c.image_filepath as curriculum_image, c.summary as curriculum_summary, c.body as curriculum_body, c.gmap
    FROM provider_curriculum as c
    WHERE c.id = " . $curriculum_id . "
    AND c.status = 1    
    ORDER BY c.id");

        foreach ($curriculum as &$r) {
            $r['curriculum_link'] = $this->_getLink($r['curriculum_title']);
        }
//    foreach ($highlights as &$highlight) {
//      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
//    }

        return '"curriculum":' . json_encode($curriculum);
        //echo $this->_json_response('featured_articles', $articles);
    }

    function review_data($review_id) {
        echo '{"review_data": [{' . $this->_review_profile($review_id) . '}]}';
    }

    private function _review_profile($review_id) {
        $sql="UPDATE provider_review
                SET total_views = total_views + 1,
                    last_viewed_week = YEARWEEK(NOW()),
                    last_viewed = NOW()
            WHERE id = ".$review_id;            
        R::exec($sql);
        
        $review = R::getAll("SELECT r.id, r.title as review_title, r.image_filepath as review_image, r.summary as review_summary, r.body as review_body, r.gmap, r.provider_id
    FROM provider_review as r
    WHERE r.id = " . $review_id . "
    AND r.status = 1    
    ORDER BY r.id");

        foreach ($review as &$r) {
            $r['review_link'] = $this->_getLink($r['review_title']);
        }

//    foreach ($highlights as &$highlight) {
//      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
//    }

        return '"review":' . json_encode($review);
        //echo $this->_json_response('featured_articles', $articles);
    }

    private function _getLink($title) {
        $link = str_replace(' ', '-', $title);
        return $link;
    }
    
    function getmap(){
        $provider_id = $this->input->post('profile_id');
        
        $gmap = R::getAll("SELECT gmap
        FROM provider_profile
        WHERE id = " . $provider_id . "
        ");
        echo json_encode($gmap);
        
    }
    
    function get_program_map(){
        $program_id = $this->input->post('program_id');
        
        $gmap = R::getAll("SELECT gmap
        FROM provider_program
        WHERE id = " . $program_id . "
        ");
        echo json_encode($gmap);
        
    }
    
    function events_time($date1, $date2) {
        echo '{"events": [{' . $this->_events_time($date1, $date2) . '}]}';
    }
    
    
    private function _events_time($date1, $date2) {
    
    $sql="
	SELECT 'events' as type, id, provider_id, title, DATE_FORMAT(start_date, '%D %b %Y') as start_date, DATE_FORMAT(end_date, '%D %b %Y') as end_date, image_filepath, seo_url, cost, time, venue, contact_number
    	FROM provider_event
	WHERE status = 1
	AND (start_date BETWEEN '".$date1."' AND '".$date2."' 
	OR end_date BETWEEN '".$date1."' AND '".$date2."')    	
	
    ORDER BY start_date DESC";
    
    $entries = R::getAll($sql);
    
    return '"event":' . json_encode($entries);
  }
  
  function programs_time($date1, $date2) {
        echo '{"programs": [{' . $this->_programs_time($date1, $date2) . '}]}';
    }
    
    
    private function _programs_time($date1, $date2) {
    
    $sql="
	SELECT 'programs' as type, title, image_filepath, seo_url, gmap, summary 
    	FROM provider_program
	WHERE status = 1
	AND publish_date BETWEEN '".$date1."' AND '".$date2."'   	
	
    ORDER BY publish_date DESC";
    
    $entries = R::getAll($sql);
    
    return '"program":' . json_encode($entries);
  }
  
  function reviews_time($date1, $date2) {
        echo '{"reviews": [{' . $this->_reviews_time($date1, $date2) . '}]}';
    }
    
    
    private function _reviews_time($date1, $date2) {
    
    $sql="
	SELECT 'review' as type, title, image_filepath, seo_url, gmap, summary 
    	FROM provider_review
	WHERE status = 1
	AND publish_date BETWEEN '".$date1."' AND '".$date2."'   	
	
    ORDER BY publish_date DESC";
    
    $entries = R::getAll($sql);
    
    return '"review":' . json_encode($entries);
  }
  
  function menu_items($provider_id,$item_id) {
      $country_id = $this->config->item('country_id');
      
      switch ($item_id) {
                    case 1:
                        $item_table = 'provider_review'; //Singapore Newsletter
                        break;
                    case 2:
                        $item_table = 'provider_program'; //Singapore Newsletter
                        break;
                    case 3:
                        $item_table = 'provider_event'; //Singapore Newsletter
                        break;
                    case 4:
                        $item_table = 'provider_curriculum'; //Singapore Newsletter
                        break;
                }
      
      
        $item = R::getAll("SELECT a.id, b.country_id 
    FROM ".$item_table." as a
    INNER JOIN provider_country as b ON b.provider_id = a.provider_id    
    WHERE a.provider_id = ".$provider_id."
    AND b.country_id = " . $country_id . "
    AND a.status = 1");

//        SELECT a.id, b.country_id
//FROM provider_review AS a
//INNER JOIN provider_country AS b ON b.provider_id = a.provider_id
//WHERE a.provider_id =2
//AND b.country_id =4
//AND a.status =1
//LIMIT 0 , 30
//    foreach ($highlights as &$highlight) {
//      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
//    }
        if(!$item){
        echo 0;}
        else {
        echo 1;    
        }
//        echo '"menu_items":' . json_encode($item);
//        echo $country_id;
        //echo $this->_json_response('featured_articles', $articles);
    }
    
    private function _trimProviderName($article_summary){
      $trimmed_summary = strlen($article_summary) > 37 ? substr($article_summary, 0, 34) . "..." : $article_summary;
//      $dashed_summary = str_replace(' ', '-', $trimmed_summary);
//      return $dashed_summary;
      return $trimmed_summary;
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
