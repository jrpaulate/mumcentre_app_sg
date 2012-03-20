<?php
class partner_content_listing extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
        $this->load->library('mcox');
        $this->provider_image_path = $this->config->item('provider_image_gen_path');
        $this->load->library('session');
        $this->load->library('mcapi');
        $this->load->helper('miscfuncs');
     
        $this->company_id = 0;
    }
    
   

     function index() {
        $message_403 = "Direct access is forbidden.";
        show_error($message_403 , 403 );
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
		    $provider->contact_person = $this->input->post('provider_contact');
		    $provider->url = $this->input->post('provider_link');
		    $provider->provider_listing_id = $this->input->post('provider_listing');
		    $provider->seo_url = $this->input->post('seo_link');
		    $provider->seo_summary = $this->input->post('se_summary');
		    $provider->seo_keywords = $this->input->post('se_keywords');
		    $provider->age_group_id = $this->input->post('age_group');
		    $provider->gmap = $this->input->post('gmap');
		    $provider->category_id = $this->input->post('category');
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

		    $response['code'] = 0;
		    $response['message'] = "Provider successfully created.";
		}
        echo $response['code'] . ":" . $response['message'] ;  
    }
    
    function provider_list($user_id){
        echo '{"provider_list": [{'.$this->_provider($user_id).'}]}';
    }
  
    private function _provider($user_id) {
        $sql="SELECT
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
        , a.publish_date AS publish_date
        , a.created_date AS created_date
        , a.status AS provider_status
        , age.name AS age_group_name
        , p.name AS provider_listing_name
        , u.user_id
        FROM provider_profile AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_listing AS p
        ON a.provider_listing_id = p.id
        INNER JOIN provider_user AS u
        ON a.id = u.provider_id
        WHERE user_id = $user_id
        ORDER BY a.id";
        
        $provider = R::getAll($sql);
        
        
         foreach ($provider as &$a) {
          if($a['provider_status'] == 0) {
              $a['provider_status'] = 'unpublished';
          } else {
              $a['provider_status'] = 'published';
          } 
       
        }

        return '"provider":' . json_encode($provider);
    }
    
    
    
    
    
    
    
    
    
    function branch_list($provider_id){
        echo '{"branch_list": [{'.$this->_branch($provider_id).'}]}';
    }
  
    private function _branch($provider_id) {
        $sql="SELECT
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
        , a.publish_date AS publish_date
        , a.created_date AS created_date
        , a.status AS provider_status
        , age.name AS age_group_name
        , p.name AS provider_listing_name
        , u.user_id
        FROM provider_profile AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_listing AS p
        ON a.provider_listing_id = p.id
        INNER JOIN provider_user AS u
        ON a.id = u.provider_id
        WHERE user_id = $user_id
        ORDER BY a.id";
        
        $provider = R::getAll($sql);
        
        
         foreach ($provider as &$a) {
          if($a['provider_status'] == 0) {
              $a['provider_status'] = 'unpublished';
          } else {
              $a['provider_status'] = 'published';
          } 
       
        }

        return '"provider":' . json_encode($provider);
    }
    
    private function _age_groups() {
        $sql="SELECT
          a.id
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
//        echo $base;
        
    }
 
        private function _get_details($id){
        
            $sql="SELECT name, contact_person, email_address
            FROM provider_profile
            WHERE id = ".$id;

            $details = R::getRow($sql);
            
            return $details;
        }
        
        
    function provider_content_list($provider_id){
        echo '{"provider_content_list": [{'.$this->_provider_content($provider_id).'}]}';
    }
  
    private function _provider_content($provider_id) {
    $sql="(SELECT 'events' as type, e.title, e.provider_id, e.id, a.name as age_group_name
    FROM provider_event as e
    INNER JOIN age_group as a ON e.age_group_id = a.id
    WHERE provider_id = ". $provider_id . ")
    UNION (SELECT  'program' as type, p.title, p.provider_id, p.id, a.name as age_group_name
    FROM provider_program as p
    INNER JOIN age_group as a ON p.age_group_id = a.id
     WHERE provider_id = ". $provider_id . ")
    UNION (SELECT  'review' as type, r.title, r.provider_id, r.id, a.name as    age_group_name
    FROM provider_review as r
    INNER JOIN age_group as a ON r.age_group_id = a.id
    WHERE provider_id = ". $provider_id.")
    UNION (SELECT  'curriculum' as type, c.title, c.provider_id, c.id, a.name as age_group_name
    FROM provider_review as c
    INNER JOIN age_group as a ON c.age_group_id = a.id
    WHERE provider_id = ". $provider_id.")";

    
        
        $provider_content = R::getAll($sql);
        
        
        

        return '"provider_content":' . json_encode($provider_content);
    }
        
    
    
    
    function provider_ads_list($provider_id){
        echo '{"provider_ads_list": [{'.$this->_provider_ads($provider_id).'}]}';
    }
    
    
    
    private function _provider_ads($provider_id) {
    $sql="(SELECT e.name, e.banner_id
    FROM banner_ads as e
    WHERE advertiser_id = ". $provider_id.")";

    
        
        $provider_ads = R::getAll($sql);
        
        
        

        return '"provider_ads":' . json_encode($provider_ads);    
        
        
        
    }
    
    
    
    
    private function _providers($provider_id) {
        $sql="(SELECT a.id,
          a.advertiser_id
       
        FROM provider_profile AS a        
        Where a.id = ". $provider_id .")";

        $providers = R::getAll($sql);

        return '"providers":' . json_encode($providers);
    }
  
    function provider_data($provider_id){
        echo '{"provider_data": [{'.$this->_providers($provider_id).'}]}';
    }
    
    
    
    
    private function _ads($advertiser_id) {
        $sql="(SELECT a.name,
        a.banner_id
        , c.start_date
        , c.end_date
        FROM banner_ads AS a  
        INNER JOIN campaign AS c
        ON a.campaign_id = c.campaign_id
        Where a.advertiser_id = ". $advertiser_id .")";
      
    
        $ads = R::getAll($sql);

        return '"ads":' . json_encode($ads);
    }
  
    function ads_data($advertiser_id){
        echo '{"ads_data": [{'.$this->_ads($advertiser_id).'}]}';
    }
    
    
    
    private function _banner($banner_id) {
        $sql="(SELECT a.id,
          c.start_date
        , c.end_date
        FROM banner_ads AS a  
        INNER JOIN campaign AS c
        ON a.campaign_id = c.campaign_id
        Where a.banner_id = ". $banner_id .")";
      
    
        $banner = R::getAll($sql);

        return '"banner":' . json_encode($banner);
    }
  
    function banner_data($banner_id){
        echo '{"banner_data": [{'.$this->_banner($banner_id).'}]}';
    }
    
    
  
}
?>
