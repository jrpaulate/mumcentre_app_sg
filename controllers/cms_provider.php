<?php
class cms_provider extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
        $this->load->library('mcox');
        $this->provider_image_path = $this->config->item('provider_image_gen_path');
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
        $this->bucket->set_content_id('cms/provider');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    
    function add_provider() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/add_provider');
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
                        $this->provider_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".png":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->provider_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".gif":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->provider_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
        }
        
        echo $id . ".jpg";
    }
   
    function create_provider() {
        $provider = R::dispense("provider_profile");

		$exist = reset(R::find('provider_profile', ' name = ? ', array(url_title($this->input->post('provider_name')))));
        
        if($exist){
            $response['code'] = -1;
            $response['message'] = "Provider name already exists.";
        } else {        
		    $provider->name = $this->input->post('provider_name');
		    $provider->details = $this->input->post('provider_details');
		    $provider->image_filepath = $this->input->post('avatar');
		    $provider->logo_filepath = $this->input->post('avatar1');
		    $provider->ticker = $this->input->post('avatar2');
		    $provider->email_address = $this->input->post('provider_email');
		    $provider->location = $this->input->post('provider_location');
		    $provider->contact_number = $this->input->post('provider_contact');
		    $provider->url = $this->input->post('provider_link');
		    $provider->provider_listing_id = $this->input->post('provider_listing');
		    $provider->seo_url = $this->input->post('seo_link');
		    $provider->seo_summary = $this->input->post('se_summary');
		    $provider->seo_keywords = $this->input->post('se_keywords');
		    $provider->age_group_id = $this->input->post('age_group');
		    $provider->gmap = $this->input->post('gmap');
		    $provider->category_id = $this->input->post('category');
                    
                    $provider->publish_date = $this->input->post('publish_date');
                    $provider->sending_date = $this->input->post('sending_date');
                    $provider->expiry_date = $this->input->post('expiry_date');
                    
		    $provider->status = 1;
		    $provider->created_by_id = 0;
		    $provider->created_date = date("Y-m-d H:i:s");
		            
		    $provider_id = R::store($provider);
		    
			// save selected countries to provider_country
			$countries=explode("|", $this->input->post('countries'));
			$country_count = count($countries);
			for ($i = 0; $i < $country_count; $i++) {

				$sql="INSERT INTO provider_country (provider_id, country_id) VALUES (";
		        $sql.=$provider_id;
				$sql.=",".$countries[$i];
				$sql.=")";
		    	R::exec($sql);
			}
                        
                $age_group=explode("|", $this->input->post('age_group'));
                $age_group_count = count($age_group);
                
		for ($i = 0; $i < $age_group_count; $i++) {
                    
                       // save selected age_group to article_age_group
			$sql="INSERT INTO provider_age_group (provider_id, age_group_id) VALUES (";
                        $sql.=$provider_id;
			$sql.=",$age_group[$i])";
        	R::exec($sql);
          }

		    $response['code'] = 0;
		    $response['message'] = "Provider successfully created.";
		}
        echo $response['code'] . ":" . $response['message'] ;  
    }
    
    function providerAll_list(){
        echo '{"providerAll_list": [{'.$this->_providerAll().'}]}';
    }
  
    private function _providerAll() {
        $sql="SELECT
          a.id
        , a.name AS provider_name
        , a.details AS provider_details
        , a.location AS provider_location
        , a.email_address AS provider_email
        , a.contact_number AS provider_contact
        , a.logo_filepath AS provider_logo
        , a.image_filepath AS provider_image
        , a.ticker AS provider_ticker
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , a.status AS provider_status
        , age.name AS age_group_name
        , a.created_date
        , cr.name AS country
       
        FROM provider_profile AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_country as p
        ON p.provider_id = a.id
        INNER JOIN country as cr
        ON cr.id = p.country_id
        ORDER BY a.created_date DESC";
        
        $providerAll = R::getAll($sql);
        
        
         foreach ($providerAll as &$a) {
          if($a['provider_status'] == 0) {
              $a['provider_status'] = 'Deactivated';
          } else {
              $a['provider_status'] = 'Activated';
          } 
       
        }

        return '"providerAll":' . json_encode($providerAll);
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
    
  
    private function _categories() {
        $sql="SELECT
          id
        , name AS category_name
        FROM category
        ORDER BY id";
        
        $categories = R::getAll($sql);
   
        return '"categories":' . json_encode($categories);

    }
  
    function category_list(){
        echo '{"category_list": [{'.$this->_categories().'}]}';
    }
    
    
    private function _provider_listing() {
        $sql="SELECT
          a.id
        , a.name AS provider_listing_name
        FROM provider_listing as a
        ORDER BY a.id";
        
        $provider_listing = R::getAll($sql);

        return '"provider_listing":' . json_encode($provider_listing);

    }
  
    function provider_listing_list(){
        echo '{"provider_listing_list": [{'.$this->_provider_listing().'}]}';
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
    
    
     function get_provider_link(){
        $id = $this->input->post('provider_id');
        
        $provider = R::getRow("SELECT a.name, a.id
            FROM provider_profile as a
            WHERE a.id = ".$id
          );
        
 
        $base = base_url();
        $provider['link'] = 'ps_providers/profile/'.$provider['id'];
       

          echo $provider['link'];

    }
    
    
    
        function make_advertiser($id){
        $response['code'] = 1;
        $provider = $this->_get_details($id);
        
        $advertiser_id = $this->mcox->add_advertiser($provider['name'], $provider['name'], $provider['email_address']);
        
        $pro = R::load('provider_profile',$id);
      
        $pro->advertiser_id = $advertiser_id;

        $id = R::store($pro);
        
        $response['code'] = 0;
        $response['message'] = "Advertised";

        echo $response['code'] . ":" . $response['message'] ;  //echo "Band creation successful!";
    }
    
        private function _get_details($id){
        
            $sql="SELECT name, contact_number, email_address
            FROM provider_profile

            WHERE id = ".$id;

            $details = R::getRow($sql);
            
            return $details;
        }
        
        
        
    function force_delete($id){
        
        $provider = R::load('provider_profile',$id);
   
        
        $id = R::trash($provider);
        
        $response['code'] = 0;
        $response['message'] = "Status Successfully Updated.";

        echo $response['code'] . ":" . $response['message'] ;  
    }    
    
    
    
    
    private function _search_provider($keyword) {
        $keyword = $this->input->get("keyword");
        $provider = R::getAll("SELECT
          a.id
        , a.name AS provider_name
        , a.details AS provider_details
        , a.location AS provider_location
        , a.email_address AS provider_email
        , a.contact_person AS provider_contact
        , a.logo_filepath AS provider_logo
        , a.image_filepath AS provider_image
        , a.ticker AS provider_ticker
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , a.status AS provider_status
        , a.created_date
        , age.name AS age_group_name
        , p.name AS provider_listing_name
        FROM provider_profile AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_listing AS p
        ON a.provider_listing_id = p.id
       
        WHERE a.name LIKE '%" . $keyword . "%' 
        ORDER BY a.created_date  DESC  
        ");

        
        foreach ($provider as &$a) {
          if($a['provider_status'] == 0) {
              $a['provider_status'] = 'Deactivated';
          } else {
              $a['provider_status'] = 'Activated';
          } 
       
        }
        
         
        
   
        return '"provider":' . json_encode($provider);
    
        
        
    }    
    
    
      function search_provider() {
        $keyword = $this->input->get("keyword");
        echo '{"provider_list": [{' . $this->_search_provider($keyword) . '}]}';
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
        
        
        
        
     function provider_list($country_id, $age_group_id, $status,$date){
        echo '{"provider_list": [{'.$this->_provider($country_id, $age_group_id, $status,$date).'}]}';
    }
  
    
    private function _provider($country_id, $age_group_id, $status, $date) {
        
        if ($country_id == 0){
            
        $sql="SELECT
          a.id
        , a.name AS provider_name
        , a.details AS provider_details
        , a.location AS provider_location
        , a.email_address AS provider_email
        , a.contact_number AS provider_contact
        , a.logo_filepath AS provider_logo
        , a.image_filepath AS provider_image
        , a.ticker AS provider_ticker
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , a.status AS provider_status
        , age.name AS age_group_name
        , a.created_date
        , cr.name AS country
       
        FROM provider_profile AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_country as p
        ON p.provider_id = a.id
        INNER JOIN country as cr
        ON cr.id = p.country_id
        ORDER BY a.created_date DESC";
        
        $provider = R::getAll($sql);

        foreach ($provider as &$a) {
          if($a['provider_status'] == 0) {
              $a['provider_status'] = 'Deactivated';
          } else {
              $a['provider_status'] = 'Activated';
          } 
       
        }
              

        return '"provider":' . json_encode($provider);
      
        }else{
            
        $sql="SELECT
          a.id
        , a.name AS provider_name
        , a.details AS provider_details
        , a.location AS provider_location
        , a.email_address AS provider_email
        , a.contact_number AS provider_contact
        , a.logo_filepath AS provider_logo
        , a.image_filepath AS provider_image
        , a.ticker AS provider_ticker
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , a.status AS provider_status
        , age.name AS age_group_name
        , a.created_date
        , cr.name AS country
       
        FROM provider_profile AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_country as p
        ON p.provider_id = a.id
        INNER JOIN country as cr
        ON cr.id = p.country_id       
        WHERE p.country_id = '" . $country_id . "' 
        ORDER BY a.created_date DESC";
        
         $provider = R::getAll($sql);

        foreach ($provider as &$a) {
          if($a['provider_status'] == 0) {
              $a['provider_status'] = 'Deactivated';
          } else {
              $a['provider_status'] = 'Activated';
          } 
       
        }
              

        return '"provider":' . json_encode($provider);
         
            
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
        , a.name AS provider_name
        , a.details AS provider_details
        , a.location AS provider_location
        , a.email_address AS provider_email
        , a.contact_number AS provider_contact
        , a.logo_filepath AS provider_logo
        , a.image_filepath AS provider_image
        , a.ticker AS provider_ticker
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , a.status AS provider_status
        , age.name AS age_group_name
        , a.created_date
        , cr.name AS country
       
        FROM provider_profile AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_country as p
        ON p.provider_id = a.id
        INNER JOIN country as cr
        ON cr.id = p.country_id
       
        
        WHERE p.country_id = '" . $country_id . "' AND
        a.age_group_id = '" . $age_group_id . "' AND   
        a.status = '" . $status . "'".$extra . "'";
        
        $provider = R::getAll($sql);

       foreach ($provider as &$a) {
          if($a['provider_status'] == 0) {
              $a['provider_status'] = 'Deactivated';
          } else {
              $a['provider_status'] = 'Activated';
          } 
       
        }
  
        return '"reviews":' . json_encode($reviews);
      
    }         
     
    
    
    function deactivated($id){
        
        $provider = R::load('provider_profile',$id);
      
        $provider->status = 0;

        $id = R::store($provider);
        
        $response['code'] = 0;
        $response['message'] = "Status Successfully Updated.";

        echo $response['code'] . ":" . $response['message'] ;  //echo "Band creation successful!";
    }
    
    
    
    function activated($id){
        
        $provider = R::load('provider_profile',$id);
      
        $provider->status = 1;

        $id = R::store($provider);
        
        $response['code'] = 0;
        $response['message'] = "Status Successfully Updated.";

        echo $response['code'] . ":" . $response['message'] ;  //echo "Band creation successful!";
    }
        
     
  
}
?>
