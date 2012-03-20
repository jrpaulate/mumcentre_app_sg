<?php
//require_once('C:/xampp/htdocs/mumcentre/forum/smf_2_api.php');
require_once('/var/www/mumcentre_sg/forum/smf_2_api.php');    

class cms_curriculum extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
        $this->load->library('session');
        $this->curriculum_image_path = $this->config->item('curriculum_image_gen_path');

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
        $this->bucket->set_content_id('cms/curriculum');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }


    function add_curriculum() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/add_curriculum');
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
                        $this->curriculum_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".png":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->curriculum_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".gif":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->curriculum_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
        }
        
        echo $id . ".jpg";
    }



   function create_curriculum() {
        $curriculum = R::dispense("provider_curriculum");
        $alert = R::dispense("alert");
         
        $curriculum->title = $this->input->post('title');
        $curriculum->image_filepath = $this->input->post('avatar');
        $curriculum->summary = $this->input->post('summary');
        $curriculum->body = $this->input->post('curriculum');
        $curriculum->age_group_id = $this->input->post('age_group');
        $curriculum->provider_id = $this->input->post('provider');
        $curriculum->seo_url = $this->input->post('seo_link');
        $curriculum->seo_summary = $this->input->post('se_summary');
        $curriculum->seo_keywords = $this->input->post('se_keywords');
        $curriculum->sending_date = $this->input->post('sending_date');
        $curriculum->expiry_date = $this->input->post('expiry_date');
        $curriculum->publish_date = $this->input->post('publish_date');
        $curriculum->gmap = $this->input->post('gmap');
        $curriculum->created_by_id = 0;
        $curriculum->created_date = date("Y-m-d H:i:s");
        if($this->input->post('publish_date') <= date("Y-m-d")) {
            $curriculum->status = 1;
        } else {
            $curriculum->status = 0;
        }
        
        $curriculum_id = R::store($curriculum);
        
        $alert->content_type = 'Curriculum';
        $alert->content_id = $curriculum_id;
        $alert->title = $this->input->post('title');
        $alert->summary = $this->input->post('summary');
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
			$sql="INSERT INTO curriculum_age_group (curriculum_id, age_group_id) VALUES (";
                        $sql.=$curriculum_id;
			$sql.=",$age_group[$i])";
        	R::exec($sql);
          }
        
        
        $response['code'] = 0;
        $response['message'] = "Curriculum & Alerts successfully created.";

        echo $response['code'] . ":" . $response['message'] ;
    }

    function curriculumAll_list(){
        echo '{"curriculumAll_list": [{'.$this->_curriculumAll().'}]}';
    }

    private function _curriculumAll() {
        $sql="SELECT
          a.id
        , a.title As curriculum_title
        , a.author AS curriculum_author
        , a.summary AS curriculum_summary
        , a.body AS curriculum_body
        , a.image_filepath AS curriculum_image
        , a.status AS curriculum_status
        , a.created_date
        , p.name AS provider_name
        , age.name As age_group_name
        , cr.name AS country
        , cr.url 
        , p.id AS provider_id
        FROM provider_curriculum AS a  
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_profile AS p
        ON p.id = a.provider_id
        INNER JOIN provider_country as pro
        ON p.id = pro.provider_id
        INNER JOIN country as cr
        ON pro.country_id = cr.id
        ORDER BY a.created_date DESC";
        
        $curriculumAll= R::getAll($sql);

        
         foreach ($curriculumAll as &$a) {
          if($a['curriculum_status'] == 0) {
              $a['curriculum_status'] = 'unpublished';
          } else {
              $a['curriculum_status'] = 'published';
          } 
       
        }

        return '"curriculumAll":' . json_encode($curriculumAll);
        //echo $this->_json_response('featured_event', $event);
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
        
        $curriculum = R::load('provider_curriculum',$id);
      
        $curriculum->status = 0;

        $id = R::store($curriculum);
        
      
    }
    
    
       function force_publish($id){
        
        $curriculum = R::load('provider_curriculum',$id);
      
        $curriculum->status = 1;

        $id = R::store($curriculum);
        
      
    }
    
    
        function get_curriculum_link(){
        $id = $this->input->post('curriculum_id');
        
        $curriculum = R::getRow("SELECT a.title, a.id, a.provider_id
            FROM provider_curriculum as a
            WHERE a.id = ".$id
          );
        
 
        $base = base_url();
        $curriculum['link'] = 'ps_providers/curriculums/'.$curriculum['provider_id'].'/'.$curriculum['id'];
       

          echo $curriculum['link'];
//        echo $base;
        
    }
    
    
    
    
    private function _curriculums($curriculum_id) {
    $sql="SELECT a.id AS curriculum_id
        , a.title AS curriculum_title
        , a.summary AS curriculum_summary
        , a.image_filepath AS curriculum_image
        , a.seo_url AS seo_link
        , a.provider_id 
        , cr.id AS country_id
        FROM provider_curriculum AS a
        INNER JOIN provider_profile as pr
        ON a.provider_id = pr.id
        INNER JOIN provider_country as p
        ON p.provider_id = pr.id
        INNER JOIN country as cr
        ON cr.id = p.country_id
        WHERE a.id = ".$curriculum_id;

        $curriculum = R::getAll($sql);

    
        return '"curriculums":' . json_encode($curriculum);
    }
      
    function curriculums_data($curriculum_id){
        echo '{"curriculums_data": [{'.$this->_curriculums($curriculum_id).'}]}';
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
    
    
    
    
    function curriculum_list($country_id, $age_group_id, $status,$date){
        echo '{"curriculum_list": [{'.$this->_curriculum($country_id, $age_group_id, $status,$date).'}]}';
    }
  
    
    private function _curriculum($country_id, $age_group_id, $status, $date) {
        
        if ($country_id == 0){
            
        $sql="SELECT
          a.id
        , a.title As curriculum_title
        , a.author AS curriculum_author
        , a.summary AS curriculum_summary
        , a.body AS curriculum_body
        , a.image_filepath AS curriculum_image
        , a.status AS curriculum_status
        , a.created_date
        , age.name AS age_group_name
        , p.name AS provider_name
        , cr.name AS country
        , cr.url 
        , p.id AS provider_id
        FROM provider_curriculum AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_profile as p
        ON p.id = a.provider_id
        INNER JOIN provider_country as pro
        ON p.id = pro.provider_id
        INNER JOIN country as cr
        ON pro.country_id = cr.id
        ORDER BY a.created_date DESC";
        
        $curriculum = R::getAll($sql);

        foreach ( $curriculum as &$a) {
          if($a['curriculum_status'] == 0) {
              $a['curriculum_status'] = 'unpublished';
          } else {
              $a['curriculum_status'] = 'published';
          } 
       
        }
              

        return '"curriculum":' . json_encode($curriculum);
      
        }else{
            
        $sql="SELECT
          a.id
        , a.title As curriculum_title
        , a.author AS curriculum_author
        , a.summary AS curriculum_summary
        , a.body AS curriculum_body
        , a.image_filepath AS curriculum_image
        , a.status AS curriculum_status
        , a.created_date
        , age.name AS age_group_name
        , p.name AS provider_name
        , c.name AS country
        FROM provider_curriculum AS a
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
        
         $curriculum = R::getAll($sql);

        foreach ($curriculum as &$a) {
          if($a['curriculum_status'] == 0) {
              $a['curriculum_status'] = 'unpublished';
          } else {
              $a['curriculum_status'] = 'published';
          } 
       
        }
              

        return '"curriculum":' . json_encode($curriculum);
         
            
        }  
       
        
        
        
       if($date != 0){
            $extra = "AND a.created_date = '". $date . "'";
        } else {
            $extra = "";
        }
        
     
        
        if($status != 0){
              $stats = "AND a.status = '". $status . "'";
        } else {
            $stats = "";
        }
        
        
        
        $sql="SELECT
          a.id
        , a.title As curriculum_title
        , a.author AS curriculum_author
        , a.summary AS curriculum_summary
        , a.body AS curriculum_body
        , a.image_filepath AS curriculum_image
        , a.status AS curriculum_status
        , a.created_date
        , age.name AS age_group_name
        , p.name AS provider_name
        , c.name AS country
        FROM provider_curriculum AS a
        INNER JOIN curriculum_age_group AS egg
        ON a.id = egg.curriculum_id
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
        a.status = '" . $status . "'".$extra . "'";
        
        $curriculum = R::getAll($sql);

        foreach ($curriculum as &$a) {
          if($a['curriculum_status'] == 0) {
              $a['curriculum_status'] = 'unpublished';
          } else {
              $a['curriculum_status'] = 'published';
          } 
       
        }
        
  
        return '"curriculum":' . json_encode($curriculum);
      
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
        
        $curriculum = R::load('provider_curriculum',$id);
   
        
        $id = R::trash($curriculum);
        
        $response['code'] = 0;
        $response['message'] = "Status Successfully Updated.";

        echo $response['code'] . ":" . $response['message'] ;  //echo "Band creation successful!";
    }    
    
    
     private function _search_curriculum($keyword) {
         $keyword = $this->input->get("keyword");
        $curriculum = R::getAll("SELECT
          a.id
        , a.title As curriculum_title
        , a.author AS curriculum_author
        , a.summary AS curriculum_summary
        , a.body AS curriculum_body
        , a.image_filepath AS curriculum_image
        , a.status AS curriculum_status
        , a.created_date
        , p.name AS provider_name
        , age.name As age_group_name
        , cr.name AS country
        , cr.url 
        , p.id AS provider_id
        FROM provider_curriculum AS a  
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_profile AS p
        ON p.id = a.provider_id
        INNER JOIN provider_country as pro
        ON p.id = pro.provider_id
        INNER JOIN country as cr
        ON pro.country_id = cr.id
       
        WHERE a.title LIKE '%" . $keyword . "%' 
        ORDER BY a.created_date DESC  
        ");

        
        foreach ($curriculum as &$a) {
          if($a['curriculum_status'] == 0) {
              $a['curriculum_status'] = 'unpublished';
          } else {
              $a['curriculum_status'] = 'published';
          } 
       
        }
        
         
        
   
        return '"curriculum":' . json_encode($curriculum);
    
        
        
    }    
    
    
      function search_curriculum() {
         $keyword = $this->input->get("keyword");
        echo '{"curriculum_list": [{' . $this->_search_curriculum($keyword) . '}]}';
    }
    
}
?>
