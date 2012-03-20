<?php
//require_once('C:/xampp/htdocs/mumcentre/forum/smf_2_api.php');
require_once('/var/www/mumcentre_sg/forum/smf_2_api.php');    

class cms_event extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
        $this->event_image_path = $this->config->item('event_image_gen_path');
    }

    private function _check_logged(){
        if($this->session->userdata('cms_logged_in') != TRUE){
            redirect('cms/login', 'refresh');
        }
    }
    
    function index() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/events');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }


    function add_event() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/add_events');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
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



    function create_event() {
        $events = R::dispense("provider_event");
        $alert = R::dispense("alert");

        $title_check = reset(R::find('provider_event', ' seo_url = ? ', array(url_title($this->input->post('seo_url')))));
        
        if($title_check){
            $response['code'] = -1;
            $response['message'] = "Event title already exists.";
        } else {
        
        $events->image_filepath = $this->input->post('avatar');
        $events->title = $this->input->post('event_title');
        $events->start_date = $this->input->post('start_date');
        $events->end_date = $this->input->post('end_date');
        $events->time = $this->input->post('event_time');
        $events->venue = $this->input->post('event_venue');
        $events->cost = $this->input->post('event_cost');
        $events->summary = $this->input->post('event_summary');
        $events->body = $this->input->post('event_body');
        $events->contact_number = $this->input->post('contact_number');
        $events->age_group_id = $this->input->post('age_group');
        $events->provider_id = $this->input->post('provider');
        $events->seo_url = url_title($this->input->post('seo_url'));
        $events->seo_summary = $this->input->post('seo_summary');
        $events->seo_keywords = $this->input->post('seo_keywords');
        $events->gmap = $this->input->post('gmap');
        $events->publish_date =$this->input->post('publish_date');
        $events->sending_date =$this->input->post('sending_date');
        $events->expiry_date =$this->input->post('expiry_date');
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
        
        
                $age_group=explode("|", $this->input->post('age_group'));
		$age_group_count = count($age_group);
                
		for ($i = 0; $i < $age_group_count; $i++) {
                    
                       // save selected age_group to article_age_group
			$sql="INSERT INTO event_age_group (event_id, age_group_id) VALUES (";
                        $sql.=$event_id;
			$sql.=",$age_group[$i])";
        	R::exec($sql);
          }
        

        $response['code'] = 0;
        $response['message'] = "Event successfully created.";
        }
       echo $response['code'] . ":" . $response['message'] ; 
    }

    function eventsAll_list(){
        echo '{"eventsAll_list": [{'.$this->_eventsAll().'}]}';
    }

    private function _eventsAll() {
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
        , age.name AS age_group_name
        , a.created_date
        , p.name AS provider_name
        , cr.name AS country
        , cr.url 
        , p.id AS provider_id
        FROM provider_event AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_profile AS p
        ON p.id = a.provider_id
        INNER JOIN provider_country as pro
        ON p.id = pro.provider_id
        INNER JOIN country as cr
        ON pro.country_id = cr.id
    
        ORDER BY a.created_date DESC";
        
        $eventsAll = R::getAll($sql);

     
         foreach ($eventsAll as &$a) {
          if($a['event_status'] == 0) {
              $a['event_status'] = 'unpublished';
          } else {
              $a['event_status'] = 'published';
          } 
       
        }
        

        return '"eventsAll":' . json_encode($eventsAll);
        //echo $this->_json_response('featured_event', $event);
    }

    private function _age_groups() {
        $sql="SELECT
          a.id AS age_group_id
        , a.name AS age_group_name
        FROM age_group as a
        ORDER BY a.id";
        
        $age_groups = R::getAll($sql);

        //    foreach ($highlights as &$highlight) {
        //      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
        //    }

        return '"age_groups":' . json_encode($age_groups);
        //echo $this->_json_response('featured_event', $event);
    }

    function age_group_list(){
        echo '{"age_group_list": [{'.$this->_age_groups().'}]}';
    }

    function auth(){
        $email_address = $this->input->post('email');
        $password = $this->input->post('password');

        $sql="SELECT
          u.id
        , u.first_name
        , u.avatar_filepath
        FROM user AS u
        WHERE email_address='".$email_address."'
        AND u.password = '".md5($password)."'";

        $account = R::getAll($sql);
    }

    private function _providers() {
        $sql="SELECT
          p.id
        , p.name AS provider_name
        FROM provider_profile as p
        ORDER BY p.name";

        $providers = R::getAll($sql);

    //    foreach ($highlights as &$highlight) {
    //      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
    //    }

        return '"providers":' . json_encode($providers);
        //echo $this->_json_response('featured_articles', $articles);
    }

    function provider_list(){
        echo '{"provider_list": [{'.$this->_providers().'}]}';
    }
    
    
    
     function unpublish($id){
        
        $event = R::load('provider_event',$id);
      
        $event->status = 0;

        $id = R::store($event);
        
      
    }
    
    
       function force_publish($id){

        $event = R::load('provider_event',$id);
      
        $event->status = 1;

        $id = R::store($event);
        

    }
    
    
        function get_event_link(){
        $id = $this->input->post('event_id');
        
        $event = R::getRow("SELECT a.title, a.id, a.provider_id
            FROM provider_event as a
            WHERE a.id = ".$id
          );
        
 
        $base = base_url();
        $event['link'] = 'ps_providers/events/'.$event['provider_id'].'/'.$event['id'];
       

          echo $event['link'];
//        echo $base;
        
    }
    
    
    
    private function _events($event_id) {
    $sql="SELECT a.id AS event_id
        , a.title AS event_title
        , a.summary AS event_summary
        , a.image_filepath AS event_image
        , a.seo_url AS seo_link
        , a.provider_id
        , cr.id AS country_id
        FROM provider_event AS a
        INNER JOIN provider_profile as pr
        ON a.provider_id = pr.id
        INNER JOIN provider_country as p
        ON p.provider_id = pr.id
        INNER JOIN country as cr
        ON cr.id = p.country_id
        WHERE a.id = ".$event_id;

        $event = R::getAll($sql);

    
        return '"events":' . json_encode($event);
    }
      
    function events_data($event_id){
        echo '{"events_data": [{'.$this->_events($event_id).'}]}';
    }

  
  
   function create_hotbox() {
        $hotbox = R::dispense("hotbox");              
        $hotbox->title = $this->input->post('title');
        $hotbox->url = $this->input->post('seo_url');
        $hotbox->image_filepath = $this->input->post('avatar');
        $hotbox->summary = $this->input->post('summary');
        $hotbox->country_id = $this->input->post('country_id');
        $hotbox->created_by_id = 0;
        $hotbox->created_date = date("Y-m-d H:i:s");
           
        $id = R::store($hotbox);
        
       
  
        $response['code'] = 0;
        $response['message'] = "Hotbox successfully created.";
       
        echo $response['code'] . ":" . $response['message'] ;  
    }
    

    
    
     function event_list($country_id, $age_group_id, $type, $status,$date){
        echo '{"event_list": [{'.$this->_event($country_id, $age_group_id, $type, $status,$date).'}]}';
    }
  
    
    private function _event($country_id, $age_group_id, $type, $status, $date) {
        
        if ($country_id == 0){
            
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
        , age.name AS age_group_name
        , a.created_date
        , p.name AS provider_name
        , c.name AS country
        , c.url 
        , p.id AS provider_id
        FROM provider_event AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_profile AS p
        ON p.id = a.provider_id
        INNER JOIN provider_country as pc
        ON p.id = pc.provider_id
        INNER JOIN country as c
        ON pc.country_id = c.id
        ORDER BY a.created_date DESC";
        
        $event = R::getAll($sql);

        foreach ($event as &$a) {
          if($a['event_status'] == 0) {
              $a['event_status'] = 'unpublished';
          } else {
              $a['event_status'] = 'published';
          } 
       
        }
              

        return '"event":' . json_encode($event);
      
        }else{
            
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
        , age.name AS age_group_name
        , a.created_date
        , p.name AS provider_name
        , c.name AS country
        , c.url 
        , p.id AS provider_id
        FROM provider_event AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_profile AS p
        ON p.id = a.provider_id
        INNER JOIN provider_country as pc
        ON p.id = pc.provider_id
        INNER JOIN country as c
        ON pc.country_id = c.id
        WHERE pc.country_id = '" . $country_id . "' 
        ORDER BY a.created_date DESC";
        
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
       
        
        
        
       if($date != 0){
            $extra = "AND a.created_date = '". $date . "'";
        } else {
            $extra = "";
        }
        
        
         if($type != 0){
              $typ = "AND a.type = '". $type . "'";
        } else {
            $typ = "";
        }
        
        
        if($status != 0){
              $stats = "AND a.status = '". $status . "'";
        } else {
            $stats = "";
        }
        
        
        
        $sql="SELECT DISTINCT
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
        , a.created_date
        , p.name AS provider_name
        , c.name AS country
        , c.url 
        , p.id AS provider_id
        FROM provider_event AS a      
        INNER JOIN event_age_group AS egg
        ON a.id = egg.article_id
        INNER JOIN age_group AS age
        ON egg.age_group_id = age.id
        INNER JOIN provider_profile AS p
        ON p.id = a.provider_id
        INNER JOIN provider_country as pc
        ON p.id = pc.provider_id
        INNER JOIN country as c
        ON pc.country_id = c.id
        WHERE c.country_id = '" . $country_id . "' AND
        egg.age_group_id = '" . $age_group_id . "' AND   
        a.status = '" . $status . "'".$extra . $typ;
        
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
    
    
    
    
    
    
    
    
    
    
    
    
    private function _types() {
        $sql="SELECT
          a.id AS type_id
        , a.name AS type_name
        FROM event_type as a
        ORDER BY a.name";
        
        $types = R::getAll($sql);

     

        return '"types":' . json_encode($types);
     
    }

    function type_list(){
        echo '{"type_list": [{'.$this->_types().'}]}';
    }
    
    
    
    private function _countries() {
        $sql="SELECT
          id AS country_id
        , code AS country_code
        , name AS country_name
        FROM country 
		WHERE status = 1
        ORDER BY country_id";
        
        $countries = R::getAll($sql);


        return '"countries":' . json_encode($countries);
    }

    function country_list(){
        echo '{"country_list": [{'.$this->_countries().'}]}';
	}
    
    
        
        
     function force_delete($id){
        
        $event = R::load('provider_event',$id);
   
        
        $id = R::trash($event);
        
        $response['code'] = 0;
        $response['message'] = "Status Successfully Updated.";

        echo $response['code'] . ":" . $response['message'] ;  
    }     
    
    
    
    
    private function _search_event($keyword) {
        $keyword = $this->input->get("keyword");
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
        , a.created_date
        , p.name AS provider_name
        , cr.name AS country
        , cr.url 
        , p.id AS provider_id
        FROM provider_event AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_profile AS p
        ON p.id = a.provider_id
        INNER JOIN provider_country as pro
        ON p.id = pro.provider_id
        INNER JOIN country as cr
        ON pro.country_id = cr.id
   


        WHERE a.title LIKE '%" . $keyword . "%' 
        ORDER BY a.created_date  DESC  
        ");

        
        foreach ($event as &$a) {
          if($a['event_status'] == 0) {
              $a['event_status'] = 'unpublished';
          } else {
              $a['event_status'] = 'published';
          } 
       
        }
        
         
        
   
        return '"event":' . json_encode($event);
    
        
        
    }    
    
    
      function search_event() {
      $keyword = $this->input->get("keyword");
        echo '{"event_list": [{' . $this->_search_event($keyword) . '}]}';
    }
    
    
    
    
    
    
}  
    
    
    
?>
