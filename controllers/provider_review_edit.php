<?php

class provider_review_edit extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
      
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        
        $this->review_image_path = $this->config->item('review_image_gen_path');
    
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
        $this->bucket->set_content_id('cms/provider_review_edit');
        $this->bucket->add_css('cms');
   

        $this->bucket->set_data('id', $id);
//      $this->bucket->set_data('id_get', $response['id_get']);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
        
        
    }
        
     function edit_review() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/edit_review');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    
    function update_review($id) {
        $review = R::load('provider_review',$id);
        $review->title = $this->input->post('review_title');
        $review->image_filepath = $this->input->post('avatar');
        $review->summary = $this->input->post('review_summary');
        $review->body = $this->input->post('review_body');
        $review->seo_url = $this->input->post('seo_url');
        $review->seo_summary = $this->input->post('seo_summary');
        $review->seo_keywords = $this->input->post('seo_keywords');
        $review->provider_id = $this->input->post('provider');
        $review->age_group_id = $this->input->post('age_group');
        $review->publish_date = $this->input->post('publish_date');
        $review->scheduled_date = $this->input->post('scheduled_date');
        $review->modified_by_id = 0;
        $review->modified_date = date("Y-m-d H:i:s");
        $id = R::store($review);
        
        $response['code'] = 0;
        $response['message'] = "Review successfully updated.";

        echo $response['code'] . ":" . $response['message'] ;  
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
                        $this->review_image_path . $id . ".jpg", false, false);
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
    
    private function _review($review_id) {
        $sql="SELECT
          r.title AS review_title
        , r.image_filepath AS review_image
        , r.status AS review_status
        , r.summary AS review_summary
        , r.body AS review_body
        , r.seo_url AS seo_link
        , r.seo_summary AS se_summary
        , r.seo_keywords AS se_keywords
        , r.publish_date
        , a.send_date
        , p.name AS provider_name
        , age.name AS age_group_name
        , p.id AS provider_id
        , age.id AS age_group_id
        FROM provider_review AS r
        INNER JOIN age_group AS age
        ON r.age_group_id = age.id
        INNER JOIN provider_profile as p
        ON p.id = r.provider_id
        LEFT OUTER JOIN alert AS a
        ON a.content_type='Review'
        AND a.content_id=r.id
        WHERE r.id = ".$review_id;
        
        $review = R::getAll($sql);

        return '"review":' . json_encode($review);
    }
      
    function review_data($review_id){
        echo '{"review_data": [{'.$this->_review($review_id).'}]}';
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

     

        return '"age_groups":' . json_encode($age_groups);
       
    }

    function age_group_list(){
        echo '{"age_group_list": [{'.$this->_age_groups().'}]}';
    }


}