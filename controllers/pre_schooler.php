<?php

class Pre_Schooler extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
    }
    
    function index(){
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/preschooler');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('RC3');
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
    }
    
    private function _latest_article() {
    $article = R::getAll("SELECT a.article_title, a.article_summary, a.article_image, a.id
    FROM article AS a
    WHERE a.age_group = 4
    ORDER BY a.created_date DESC LIMIT 1");

    //$article[0]['article_body'] = $this->_getArticleIntro($article[0]['article_body']);
    $article[0]['article_link'] = $this->_getArticleLink($article[0]['article_title']);

    return '"latest":' . json_encode($article);
  }

  private function _featured_articles() {
    $articles = R::getAll("SELECT a.article_title, a.article_summary, a.id
    FROM article AS a
    WHERE a.age_group = 4
    ORDER BY a.created_date DESC LIMIT 1, 2");
//    foreach ($articles as $article) {
//      $article['article_body'] = $this->_getArticleIntro($article['article_body']);
//    }
    foreach ($articles as &$article) {
        $article['article_link'] = $this->_getArticleLink($article['article_title']);
        $article['article_summary'] = $this->_trimArticles($article['article_summary']);
    }
   
    return '"featured":' . json_encode($articles);
  }
  
  private function _getArticleLink($article_title){
      $link = str_replace(' ', '-', $article_title);
      return $link;
  }
  
  private function _trimArticles($article_summary){
      $trimmed_summary = strlen($article_summary) > 217 ? substr($article_summary, 0, 214) . "..." : $article_summary;
//      $dashed_summary = str_replace(' ', '-', $trimmed_summary);
//      return $dashed_summary;
      return $trimmed_summary;
  }
    
    function preschooler_data() {
    echo '{"preschooler_data": [{'.$this->_latest_article().','.$this->_featured_articles().'}]}';
  }
  
   
}
?>
