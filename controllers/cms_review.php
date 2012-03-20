<?php
//require_once('C:/xampp/htdocs/mumcentre/forum/smf_2_api.php');
require_once('/var/www/mumcentre_sg/forum/smf_2_api.php');    

class Cms_Review extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
        $this->image_path = $this->config->item('review_image_gen_path');
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
        $this->bucket->set_content_id('cms/review');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    function add_review() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/add_review');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    

    function create_review() {

        $review = R::dispense("provider_review");
        $alert = R::dispense("alert");        
        
        
        
        $review->title = $this->input->post('title');
        $review->image_filepath = $this->input->post('avatar');
        $review->summary = $this->input->post('summary');
        $review->body = $this->input->post('review');
        $review->seo_url = url_title($this->input->post('seo_link'));
        $review->seo_summary = $this->input->post('se_summary');
        $review->seo_keywords = $this->input->post('se_keywords');
        $review->provider_id = $this->input->post('provider');
        $review->age_group_id = $this->input->post('age_group');
        $review->gmap = $this->input->post('gmap');
        $review->publish_date =  $this->input->post('publish_date');
        $review->created_by_id = 0;
        $review->created_date = date("Y-m-d H:i:s");
        if($this->input->post('publish_date') <= date("Y-m-d")) {
            $review->status = 1;
        } else {
            $review->status = 0;
        }   
        $review_id = R::store($review);
        
        $alert->content_type = 'Review';
        $alert->content_id = $review_id;
        $alert->title = $this->input->post('title');
        $alert->summary = $this->input->post('summary');
        $alert->send_date = $this->input->post('sending_date');
        $alert->age_group_id = $this->input->post('age_group');
        $alert->url = $this->input->post('seo_url');
        $alert->status = 0;
        $alert->created_by_id = 0;
        $alert->created_date = date("Y-m-d H:i:s");
        
        $alert_id = R::store($alert);   
        
        
        $age_group=explode("|", $this->input->post('age_group'));
        $age_group_count = count($age_group);
                
		for ($i = 0; $i < $age_group_count; $i++) {
                    
                       // save selected age_group to article_age_group
			$sql="INSERT INTO review_age_group (review_id, age_group_id) VALUES (";
                        $sql.=$review_id;
			$sql.=",$age_group[$i])";
        	R::exec($sql);
          }

        $response['code'] = 0;
        $response['message'] = "Review successfully created.";
        
        echo $response['code'] . ":" . $response['message'] ;  //echo "Band creation successful!";
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
            case ".png":
            case ".gif":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false, $this->image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
        }

        echo $id . ".jpg";
    }
    
    private function _reviewAll() {
        $sql="SELECT
          r.id
        , r.title AS review_title
        , r.image_filepath AS review_image
        , r.status AS review_status
        , r.seo_url AS seo_url
        , r.seo_summary AS se_summary
        , r.seo_keywords AS se_keywords
        , r.created_date
        , p.name AS provider_name
        , age.name AS age_group_name
        , cr.name AS country
        , cr.url 
        , p.id AS provider_id
        FROM provider_review AS r
        INNER JOIN age_group as age
        ON r.age_group_id = age.id
        INNER JOIN provider_profile as p
        ON p.id = r.provider_id
        INNER JOIN provider_country as pro
        ON p.id = pro.provider_id
        INNER JOIN country as cr
        ON pro.country_id = cr.id
        ORDER BY r.created_date DESC";
        
        $reviewAll = R::getAll($sql);

       foreach ( $reviewAll as &$a) {
          if($a['review_status'] == 0) {
              $a['review_status'] = 'unpublished';
          } else {
              $a['review_status'] = 'published';
          } 
       
        }
        
        return '"reviewAll":' . json_encode($reviewAll);
       
    }
  
    function reviewAll_list(){
        echo '{"reviewAll_list": [{'.$this->_reviewAll().'}]}';
    }
    
    private function _age_groups() {
        $sql="SELECT
          a.id AS age_group_id
        , a.name AS age_group_name
        FROM age_group as a
        ORDER BY a.id";
        
        $age_groups = R::getAll($sql);

        return '"age_groups":' . json_encode($age_groups);
    }

    function age_group_list(){
        echo '{"age_group_list": [{'.$this->_age_groups().'}]}';
    }

    private function _providers() {
        $sql="SELECT
        p.id
        , p.name AS provider_name
        FROM provider_profile as p
        ORDER BY p.id";
        
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
        
        $review = R::load('provider_review',$id);
      
        $review->status = 0;

        $id = R::store($review);
        
      
    }
    
    
    function force_publish($id){
        
        $review = R::load('provider_review',$id);
      
        $review->status = 1;

        $id = R::store($review);
        
      
    }
    
         function get_review_link(){
        $id = $this->input->post('review_id');
        
        $review = R::getRow("SELECT a.title, a.id, a.provider_id
            FROM provider_review as a
            WHERE a.id = ".$id
          );
        
 
        $base = base_url();
        $review['link'] = 'ps_providers/reviews/'.$review['provider_id'].'/'.$review['id'];
       

          echo $review['link'];
//        echo $base;
        
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
    
        
        
        
        
    function review_list($country_id, $age_group_id, $status,$date){
        echo '{"review_list": [{'.$this->_reviews($country_id, $age_group_id, $status,$date).'}]}';
    }
  
    
    private function _reviews($country_id, $age_group_id, $status, $date) {
        
        if ($country_id == 0){
            
        $sql="SELECT
          r.id
        , r.title AS review_title
        , r.image_filepath AS review_image
        , r.status AS review_status
        , r.seo_url AS seo_url
        , r.seo_summary AS se_summary
        , r.seo_keywords AS se_keywords
        , r.created_date
        , p.name AS provider_name
        , age.name AS age_group_name
        , cr.name AS country
        , cr.url 
        , p.id AS provider_id
        FROM provider_review AS r
        INNER JOIN review_age_group AS egg
        ON r.id = egg.review_id
        INNER JOIN age_group AS age
        ON egg.age_group_id = age.id
        INNER JOIN provider_profile as p
        ON p.id = r.provider_id
        INNER JOIN provider_country as pro
        ON p.id = pro.provider_id
        INNER JOIN country as cr
        ON pro.country_id = cr.id
        ORDER BY r.created_date DESC";
        
        $reviews = R::getAll($sql);

        foreach ( $reviews as &$a) {
          if($a['review_status'] == 0) {
              $a['review_status'] = 'unpublished';
          } else {
              $a['review_status'] = 'published';
          } 
       
        }
              

        return '"reviews":' . json_encode($reviews);
      
        }else{
            
        $sql="SELECT
          r.id
        , r.title AS review_title
        , r.image_filepath AS review_image
        , r.status AS review_status
        , r.seo_url AS seo_url
        , r.seo_summary AS se_summary
        , r.seo_keywords AS se_keywords
        , r.created_date
        , p.name AS provider_name
        , age.name AS age_group_name
        , cr.name AS country
        , cr.url 
        , p.id AS provider_id
        FROM provider_review AS r
        INNER JOIN review_age_group AS egg
        ON r.id = egg.review_id
        INNER JOIN age_group AS age
        ON egg.age_group_id = age.id
        INNER JOIN provider_profile as p
        ON p.id = r.provider_id
        INNER JOIN provider_country as pro
        ON p.id = pro.provider_id
        INNER JOIN country as cr
        ON pro.country_id = cr.id
        WHERE pro.country_id = $country_id 
        ORDER BY r.created_date";
        
         $reviews = R::getAll($sql);

        foreach ($reviews as &$a) {
          if($a['review_status'] == 0) {
              $a['review_status'] = 'unpublished';
          } else {
              $a['review_status'] = 'published';
          } 
       
        }
              

        return '"reviews":' . json_encode($reviews);
         
            
        }  
       
        
        
        
        if ($age_group_id == 0){
            
        $sql="SELECT
          r.id
        , r.title AS review_title
        , r.image_filepath AS review_image
        , r.status AS review_status
        , r.seo_url AS seo_url
        , r.seo_summary AS se_summary
        , r.seo_keywords AS se_keywords
        , r.created_date
        , p.name AS provider_name
        , age.name AS age_group_name
        , cr.name AS country
        , cr.url 
        , p.id AS provider_id
        FROM provider_review AS r
        INNER JOIN review_age_group AS egg
        ON r.id = egg.review_id
        INNER JOIN age_group AS age
        ON egg.age_group_id = age.id
        INNER JOIN provider_profile as p
        ON p.id = r.provider_id
        INNER JOIN provider_country as pro
        ON p.id = pro.provider_id
        INNER JOIN country as cr
        ON pro.country_id = cr.id
        ORDER BY r.created_date DESC";
        
        $reviews = R::getAll($sql);

        foreach ( $reviews as &$a) {
          if($a['review_status'] == 0) {
              $a['review_status'] = 'unpublished';
          } else {
              $a['review_status'] = 'published';
          } 
       
        }
              

        return '"reviews":' . json_encode($reviews);
      
        }else{
            
        $sql="SELECT
          r.id
        , r.title AS review_title
        , r.image_filepath AS review_image
        , r.status AS review_status
        , r.seo_url AS seo_url
        , r.seo_summary AS se_summary
        , r.seo_keywords AS se_keywords
        , r.created_date
        , p.name AS provider_name
        , age.name AS age_group_name
        , cr.name AS country
        , cr.url 
        , p.id AS provider_id
        FROM provider_review AS r
        INNER JOIN review_age_group AS egg
        ON r.id = egg.review_id
        INNER JOIN age_group AS age
        ON egg.age_group_id = age.id
        INNER JOIN provider_profile as p
        ON p.id = r.provider_id
        INNER JOIN provider_country as pro
        ON p.id = pro.provider_id
        INNER JOIN country as cr
        ON pro.country_id = cr.id
        WHERE egg.age_group_id = $age_group_id  AND
        pro.country_id = $country_id 
        ORDER BY r.created_date";
        
         $reviews = R::getAll($sql);

        foreach ($reviews as &$a) {
          if($a['review_status'] == 0) {
              $a['review_status'] = 'unpublished';
          } else {
              $a['review_status'] = 'published';
          } 
       
        }
              

        return '"reviews":' . json_encode($reviews);
         
            
        }  
        
        
        
       if($date != 0){
            $extra = "AND a.created_date = '". $date . "'";
        } else {
            $extra = "";
        }
        
        
        if($age_group_id != 0){
            $age = "AND egg.age_group_id = '". $age_group_id . "'";
        } else {
            $age = "";
        }
     
        
        if($status != 0){
              $stats = "AND a.status = '". $status . "'";
        } else {
            $stats = "";
        }
        
        
        
        $sql="SELECT
          r.id
        , r.title AS review_title
        , r.image_filepath AS review_image
        , r.status AS review_status
        , r.seo_url AS seo_url
        , r.seo_summary AS se_summary
        , r.seo_keywords AS se_keywords
        , r.created_date
        , p.name AS provider_name
        , age.name AS age_group_name
        , cr.name AS country
        , cr.url 
        , p.id AS provider_id
        FROM provider_review AS r
        INNER JOIN review_age_group AS egg
        ON r.id = egg.review_id
        INNER JOIN age_group AS age
        ON egg.age_group_id = age.id
        INNER JOIN provider_profile as p
        ON p.id = r.provider_id
        INNER JOIN provider_country as pro
        ON p.id = pro.provider_id
        INNER JOIN country as cr
        ON pro.country_id = cr.id
        WHERE pro.country_id = $country_id AND
        egg.age_group_id =  $age_group_id   
        '" . $stats . "'".$extra . "'" . "'".$age . "'";
        
        $reviews = R::getAll($sql);

        foreach ($reviews as &$a) {
          if($a['review_status'] == 0) {
              $a['review_status'] = 'unpublished';
          } else {
              $a['review_status'] = 'published';
          } 
       
        }
        
  
        return '"reviews":' . json_encode($reviews);
      
    }     
    
    
    
    function force_delete($id){
        
        $review = R::load('provider_review',$id);
   
        
        $id = R::trash($review);
        
        $response['code'] = 0;
        $response['message'] = "Status Successfully Updated.";

        echo $response['code'] . ":" . $response['message'] ;  
    }  
    
    
    
    private function _search_review($keyword) {
        $keyword = $this->input->get("keyword");
        
        $reviews = R::getAll("SELECT
          r.id
        , r.title AS review_title
        , r.image_filepath AS review_image
        , r.status AS review_status
        , r.seo_url AS seo_url
        , r.seo_summary AS se_summary
        , r.seo_keywords AS se_keywords
        , r.created_date
        , p.name AS provider_name
        , age.name AS age_group_name
        , cr.name AS country
        , cr.url 
        , p.id AS provider_id
        FROM provider_review AS r
        INNER JOIN age_group as age
        ON r.age_group_id = age.id
        INNER JOIN provider_profile as p
        ON p.id = r.provider_id
        INNER JOIN provider_country as pro
        ON p.id = pro.provider_id
        INNER JOIN country as cr
        ON pro.country_id = cr.id

        WHERE r.title LIKE '%" . $keyword . "%' 
        ORDER BY r.created_date DESC   
        ");

        
        foreach ($reviews as &$a) {
          if($a['review_status'] == 0) {
              $a['review_status'] = 'unpublished';
          } else {
              $a['review_status'] = 'published';
          } 
       
        }
        
         
        
   
        return '"reviews":' . json_encode($reviews);
    
        
        
    }    
    
    
      function search_review() {
         $keyword = $this->input->get("keyword");
        echo '{"review_list": [{' . $this->_search_review($keyword) . '}]}';
    }
    
    
    
    
    private function _review($review_id) {
    $sql="SELECT a.id AS review_id
        , a.title AS review_title
        , a.summary AS review_summary
        , a.image_filepath AS review_image
        , a.seo_url AS seo_link
        , a.provider_id
        , cr.id AS country_id
        FROM provider_review AS a
        INNER JOIN provider_profile as pr
        ON a.provider_id = pr.id
        INNER JOIN provider_country as p
        ON p.provider_id = pr.id
        INNER JOIN country as cr
        ON cr.id = p.country_id
        WHERE a.id = ".$review_id;

        $review = R::getAll($sql);

    
        return '"review":' . json_encode($review);
    }
      
    function review_data($review_id){
        echo '{"review_data": [{'.$this->_review($review_id).'}]}';
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
    
}
?>
