<?php

class provider_curriculum_edit extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
      
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        
        $this->curriculum_image_path = $this->config->item('curriculum_image_gen_path');
    
    }
    
    private function _check_logged(){
        if($this->session->userdata('cms_logged_in') != TRUE){
            redirect('cms/login', 'refresh');
        }
    }
    
    function index() {
        $message_403 = "Direct access is forbidden.";
        show_error($message_403 , 403 );
    }
    
    function read($id){
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/provider_curriculum_edit');
        $this->bucket->add_css('cms');
   

        $this->bucket->set_data('id', $id);
//      $this->bucket->set_data('id_get', $response['id_get']);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
                
    }
    
    function edit_curriculum() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/edit_curriculum');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    
    function update_curriculum($id) {
        $curriculum = R::load('provider_curriculum',$id);
        $curriculum->title = $this->input->post('curriculum_title');
        $curriculum->image_filepath = $this->input->post('avatar');
        $curriculum->summary = $this->input->post('curriculum_summary');
        $curriculum->body = $this->input->post('curriculum_body');
        $curriculum->publish_date = $this->input->post('publish_date');
        $curriculum->provider_id = $this->input->post('provider');
        $curriculum->age_group_id = $this->input->post('age_group');
        $curriculum->modified_by_id = 0;
        $curriculum->modified_date = date("Y-m-d H:i:s");
        $id = R::store($curriculum);

        $response['code'] = 0;
        $response['message'] = "Curriculum successfully Updated.";

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
                $this->media->smart_thumb_image($json->{'file_path'}, 145, 145, 150, 150, true,
                        $this->curriculum_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
        }
        
        echo $id . ".jpg";
    }
    
    function error() {
        $message_404 = "Either your requested article is removed, or your url is wrong...";
        show_error($message_404 , 404 );
    }
    
    private function _curriculum($curriculum_id) {
        $sql="SELECT
          a.id
        , a.title As curriculum_title
        , a.author AS curriculum_author
        , a.summary As curriculum_summary
        , a.body AS curriculum_body
        , a.image_filepath AS curriculum_image
        , a.status AS curriculum_status
        , a.seo_url AS seo_url
        , a.seo_summary AS seo_summary
        , a.seo_keywords AS seo_keywords
        , a.sending_date AS sending_date
        , a.publish_date AS publish_date
        , a.contact_number
        , p.name AS provider_name
        , a.age_group_id as age_group_id
        , p.id AS provider_id
        , GROUP_CONCAT(age.name) as age_group_name
        FROM provider_curriculum AS a
        INNER JOIN curriculum_age_group AS agg
        ON agg.curriculum_id = a.id
        INNER JOIN age_group AS age
        ON age.id = agg.age_group_id
        INNER JOIN provider_profile as p
        ON p.id = a.provider_id
        WHERE a.id = ".$curriculum_id;
        
        $curriculum = R::getAll($sql);

//    $article[0]['article_body'] = json_decode($article[0]['article_body']);
//    $article[0]['article_link'] = $this->_getArticleLink($article[0]['article_title']);

        return '"curriculum":' . json_encode($curriculum);
  }
    
  
    function curriculum_data($curriculum_id){
        echo '{"curriculum_data": [{'.$this->_curriculum($curriculum_id).'}]}';
    }
  
    private function _providers() {
        $sql="SELECT
          p.id
        , p.name AS provider_name
        FROM provider_profile as p
        ORDER BY p.id";
        
        $providers = R::getAll($sql);

        return '"providers":' . json_encode($providers);

    }
  
    function provider_list(){
        echo '{"provider_list": [{'.$this->_providers().'}]}';
    }
    
    private function _age_groups() {
        $sql="SELECT
          a.id
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
   
}