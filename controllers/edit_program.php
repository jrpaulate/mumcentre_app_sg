<?php

class edit_program extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
      
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        
        $this->program_image_path = $this->config->item('program_image_gen_path');
    
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
        $this->bucket->set_content_id('cms/edit_program');
        $this->bucket->add_css('cms');
   

        $this->bucket->set_data('id', $id);
//      $this->bucket->set_data('id_get', $response['id_get']);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
        
        
    }
    
    
     function edit_program() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/edit_program');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    
    function update_program($id) {
        $program = R::load('provider_program',$id);
        $program->title = $this->input->post('program_title');
        $program->image_filepath = $this->input->post('avatar');
        $program->summary = $this->input->post('program_summary');
        $program->body = $this->input->post('program_body');
        $program->seo_url = $this->input->post('seo_url');
        $program->publish_date = $this->input->post('publish_date');
        $program->sending_date = $this->input->post('scheduled_date');
        $program->start_date = $this->input->post('start_date');
        $program->expiry_date = $this->input->post('expiry_date');
        $program->end_date = $this->input->post('end_date');
        $program->seo_summary = $this->input->post('seo_summary');
        $program->seo_keywords = $this->input->post('seo_keywords');
        $program->provider_id = $this->input->post('provider');
        $program->age_group_id = $this->input->post('age_group');
        $program->modified_by_id = 0;
        $program->modified_date = date("Y-m-d H:i:s");
        $id = R::store($program);
        
        $response['code'] = 0;
        $response['message'] = "Program Successfully Updated.";

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
                        $this->program_image_path . $id . ".jpg", false, false);
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
    
    private function _program($program_id) {
        $sql="SELECT
          a.id
        , a.title AS program_title
        , a.summary AS program_summary
        , a.body AS program_body
        , a.image_filepath AS program_image
        , a.status AS program_status
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , age.name AS age_group_name
        , a.start_date
        , a.end_date
        , a.publish_date
        , a.sending_date
        , a.expiry_date
        , a.contact_number
        , age.id AS age_group_id
        , p.name AS provider_name
        , p.id AS provider_id
        FROM provider_program AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN provider_profile AS p
        ON p.id = a.provider_id
        WHERE a.id = ".$program_id;
        
        $program = R::getAll($sql);

    //    $article[0]['article_body'] = json_decode($article[0]['article_body']);
    //    $article[0]['article_link'] = $this->_getArticleLink($article[0]['article_title']);

        return '"program":' . json_encode($program);
        
    }
      
    function program_data($program_id){
        echo '{"program_data": [{'.$this->_program($program_id).'}]}';
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
