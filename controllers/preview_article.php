<?php

class preview_article extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
      
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        
        $this->article_image_path = $this->config->item('article_image_gen_path');
    
    }

    function index() {
        $message_403 = "Direct access is forbidden.";
        show_error($message_403 , 403 );
        
    }
    
    function read($id){
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/preview_article');
  
 
        $this->bucket->add_css('mums');
        $this->bucket->add_css('RC');
        $this->bucket->add_css('cms');
   

        $this->bucket->set_data('id', $id);
//      $this->bucket->set_data('id_get', $response['id_get']);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
        
        
    }
    
    

    function error() {
        $message_404 = "Either your requested article is removed, or your url is wrong...";
        show_error($message_404 , 404 );
    }
    
    private function _article($article_id) {
    $article = R::getAll("SELECT
          a.id
        , a.title AS article_title
        , a.author AS article_author
        , a.image_filepath AS article_image
        , a.status
        , a.summary as summary
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , age.name AS age_group_name
        FROM article AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        WHERE a.id = ".$article_id
    );

    
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
?>