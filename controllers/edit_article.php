<?php

class edit_article extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
      
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        
        $this->article_image_path = $this->config->item('article_image_gen_path');
    
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
        $this->bucket->set_content_id('cms/edit_article');
        $this->bucket->add_css('cms');
   

        $this->bucket->set_data('id', $id);
//      $this->bucket->set_data('id_get', $response['id_get']);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
        
        
    }
    
    function edit_article() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/edit_article');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
        
    function update_article($id) {
        $article = R::load('article',$id);
        $article->title = $this->input->post('article_title');
        $article->author = $this->input->post('article_author');
        $article->image_filepath = $this->input->post('avatar');
        $article->summary = $this->input->post('article_summary');
        $article->publish_date = $this->input->post('publish_date');
        $article->body = $this->input->post('article_body');
        $article->seo_url = $this->input->post('seo_url');
        $article->seo_summary = $this->input->post('seo_summary');
        $article->seo_keywords = $this->input->post('seo_keywords');
        
        $article->modified_by_id = 0;
        $article->modified_date = date("Y-m-d H:i:s");
        $id = R::store($article);
        
        $response['code'] = 0;
        $response['message'] = "Article Successfully Updated.";

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
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->article_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".png":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->article_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".gif":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->article_image_path . $id . ".jpg", false, false);
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
    
    private function _article($article_id) {
        $sql="SELECT
          a.title AS article_title
        , a.author AS article_author
        , a.summary AS article_summary
        , a.body AS article_body
        , a.image_filepath AS article_image
        , a.seo_url AS seo_url
        , a.seo_summary AS seo_summary
        , a.seo_keywords AS seo_keywords
        , a.id
        , a.age_group_id AS age_group_id
        , a.publish_date
        , al.send_date
        FROM article AS a
        INNER JOIN age_group as age
        ON a.age_group_id = age.id
        LEFT OUTER JOIN alert AS al
        ON al.content_type='Article'
        AND al.content_id=a.id
        WHERE a.id = ".$article_id;

        $article = R::getAll($sql);

        //    $article[0]['article_body'] = json_decode($article[0]['article_body']);
        //    $article[0]['article_link'] = $this->_getArticleLink($article[0]['article_title']);

        return '"article":' . json_encode($article);
    }
      
    function article_data($article_id){
        echo '{"article_data": [{'.$this->_article($article_id).'}]}';
    }
  
//  private function _getArticleBody($article_body){
//      echo $article_body;
//      return $article_body;
//  }
}