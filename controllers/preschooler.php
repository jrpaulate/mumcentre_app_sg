<?php

class Preschooler extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
        $this->load->library('mcox');
        $this->meta_description = $this->config->item('description');
        
        $this->mrec1 = $this->_generateTags(45);
        $this->mrec2 = $this->_generateTags(46);
        $this->mrec3 = $this->_generateTags(63);
        $this->mrec4 = $this->_generateTags(112);
        $this->mrec5 = $this->_generateTags(113);
        $this->mrec6 = $this->_generateTags(114);
        
        $this->mini_ad1 = $this->_generateTags(41);
        $this->mini_ad2 = $this->_generateTags(42);
        $this->mini_ad3 = $this->_generateTags(43);

        $this->featban = $this->_generateTags(27);
        
        $this->reshome_rec1 = $this->_generateTags(66);
        $this->reshome_rec2 = $this->_generateTags(67);
        $this->reshome_rec3 = $this->_generateTags(68);
        
        $this->reshome_miniad1 = $this->_generateTags(69);
        $this->reshome_miniad2 = $this->_generateTags(70);
        $this->reshome_miniad3 = $this->_generateTags(71);
        $this->reshome_miniad4 = $this->_generateTags(72);
        
        $this->reshome_mumad1 = $this->_generateTags(73);
        $this->reshome_mumad2 = $this->_generateTags(74);
        $this->reshome_mumad3 = $this->_generateTags(75);
        
        $this->res_mumad1 = $this->_generateTags(76);
        $this->res_mumad2 = $this->_generateTags(77);
        $this->res_mumad3 = $this->_generateTags(78);
        $this->res_mumad4 = $this->_generateTags(79);
        $this->res_mumad5 = $this->_generateTags(80);
        
        $this->res_miniad1 = $this->_generateTags(81);
        $this->res_miniad2 = $this->_generateTags(82);
        $this->res_miniad3 = $this->_generateTags(83);
        $this->res_miniad4 = $this->_generateTags(84);
    }
    
    function index(){
        $base = base_url();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop_fb');
        $this->bucket->set_content_id('mumcentre/rc_home');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('RC3');
        $this->bucket->set_data('age_group', 4);
        $this->bucket->set_data('age_group_title', 'Pre-schooler');
        $this->bucket->set_data('age_group_link', 'preschooler');
        
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        
        $this->bucket->set_data('reshome_rec1', $this->reshome_rec1);
        $this->bucket->set_data('reshome_rec2', $this->reshome_rec2);
        $this->bucket->set_data('reshome_rec3', $this->reshome_rec3);
        
        $this->bucket->set_data('reshome_miniad1', $this->reshome_miniad1);
        $this->bucket->set_data('reshome_miniad2', $this->reshome_miniad2);
        $this->bucket->set_data('reshome_miniad3', $this->reshome_miniad3);
        $this->bucket->set_data('reshome_miniad4', $this->reshome_miniad4);
        
        $this->bucket->set_data('reshome_mumad1', $this->reshome_mumad1);
        $this->bucket->set_data('reshome_mumad2', $this->reshome_mumad2);
        $this->bucket->set_data('reshome_mumad3', $this->reshome_mumad3);
        
        $this->bucket->set_data('description', $this->meta_description);
        $this->bucket->set_data('title', 'Mumcentre - Pre-schooler articles');
        $this->bucket->set_data('forum_group', 131);
        $this->bucket->set_data('og_image', '');
        $this->bucket->set_data('og_title', 'Mumcentre - Pre-schooler articles');
        $this->bucket->set_data('og_type', 'article');
        $this->bucket->set_data('og_url', $base."preschooler");
        
        $this->bucket->render_layout();
    }
    
    function read($url_title){
        $article = array();
        $article = $this->_find_id($url_title);
        if($article <= 0) {
            $this->error();
        }
        $base = base_url();
        $title = $article['title'];
        $image = $article['image_filepath'];
        $article_title = $this->_trimTitle($article['title']);
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/athan');
        if($article['template_status']==2){
        $this->bucket->set_content_id('mumcentre/blank_res');
        }
        else{
        $this->bucket->set_content_id('mumcentre/res');    
        }
        $this->bucket->add_css('mums');
        $this->bucket->add_css('article');
        $this->bucket->add_css('style');
        $this->bucket->set_data('age_group', "Preschooler");
        $this->bucket->set_data('article_title', $article_title);
        $this->bucket->set_data('id',$article['id']);
        
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        
        $this->bucket->set_data('res_mumad1', $this->res_mumad1);
        $this->bucket->set_data('res_mumad2', $this->res_mumad2);
        $this->bucket->set_data('res_mumad3', $this->res_mumad3);
        $this->bucket->set_data('res_mumad4', $this->res_mumad4);
        $this->bucket->set_data('res_mumad5', $this->res_mumad5);
        
        $this->bucket->set_data('res_miniad1', $this->res_miniad1);
        $this->bucket->set_data('res_miniad2', $this->res_miniad2);
        $this->bucket->set_data('res_miniad3', $this->res_miniad3);
        $this->bucket->set_data('res_miniad4', $this->res_miniad4);
        
        $this->bucket->set_data('description',$article['seo_summary']);
        $this->bucket->set_data('title', 'Mumcentre - '.$title);
        $this->bucket->set_data('forum_group', 131);
        $this->bucket->set_data('og_image', $base."uploaded/article/image/".$image);
        $this->bucket->set_data('og_title', 'Mumcentre - '.$title);
        $this->bucket->set_data('og_type', 'article');
        $this->bucket->set_data('og_url', $base."preschooler/".$url_title);
        $this->bucket->render_layout();
    }
    
     function all(){
        $base = base_url();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop_fb');
        $this->bucket->set_content_id('mumcentre/rc_all');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('RC2');
        $this->bucket->set_data('age_group', 4);
        $this->bucket->set_data('age_group_title', 'Pre-schooler');
        $this->bucket->set_data('age_group_link', 'preschooler');
        
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);
        
        $this->bucket->set_data('featban', $this->featban);
        
        $this->bucket->set_data('reshome_rec1', $this->reshome_rec1);
        $this->bucket->set_data('reshome_rec2', $this->reshome_rec2);
        
        $this->bucket->set_data('reshome_mumad1', $this->reshome_mumad1);
        $this->bucket->set_data('reshome_mumad2', $this->reshome_mumad2);
        $this->bucket->set_data('reshome_mumad3', $this->reshome_mumad3);
        
        $this->bucket->set_data('reshome_miniad1', $this->reshome_miniad1);
        $this->bucket->set_data('reshome_miniad2', $this->reshome_miniad2);
        
        $this->bucket->set_data('description', $this->meta_description);
        $this->bucket->set_data('title', 'Mumcentre - Pre-schooler articles');
        $this->bucket->set_data('og_image', '');
        $this->bucket->set_data('og_title', 'Mumcentre - Pre-schooler articles');
        $this->bucket->set_data('og_type', 'article');
        $this->bucket->set_data('og_url', $base."preschooler/all");
        
        $this->bucket->render_layout();
    }
    
    private function _latest_article() {
    $article = R::getAll("SELECT a.article_title, a.article_summary, a.article_image, a.id
    FROM article AS a
    ORDER BY a.created_date DESC LIMIT 1");

    //$article[0]['article_body'] = $this->_getArticleIntro($article[0]['article_body']);
    $article[0]['article_link'] = $this->_getArticleLink($article[0]['article_title']);

    return '"latest":' . json_encode($article);
  }

  private function _featured_articles() {
    $articles = R::getAll("SELECT a.article_title, a.article_summary, a.id
    FROM article AS a
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
  
  private function _trimTitle($article_summary){
      $trimmed_summary = strlen($article_summary) > 35 ? substr($article_summary, 0, 35) . "..." : $article_summary;
//      $dashed_summary = str_replace(' ', '-', $trimmed_summary);
//      return $dashed_summary;
      return $trimmed_summary;
  }
    
    function preschooler_data() {
    echo '{"preschooler_data": [{'.$this->_latest_article().','.$this->_featured_articles().'}]}';
  }
  
  private function _find_id($url_title){
       $article_id = R::getRow("SELECT a.id, a.title, a.seo_summary, a.image_filepath, a.template_status
            FROM article as a
            WHERE a.seo_url = '".$url_title."'"
          );
//       echo $article_id['id'];
       return $article_id;
  }
  
  
   private function _image_finder($id){
        $image_id = R::getRow("SELECT a.image_filepath as article_image
            FROM article as a
            WHERE a.id = ".$id
          );
//        echo $image_id['article_image'];
        return $image_id['article_image'];
    }
    
    private function _generateTags($zoneId) {
        $ajs = "http://50.19.248.24/openx/www/delivery/ajs.php";
        $loc = urlencode(current_url());
        $cb = rand(0, 99999999999);
        return '<script type="text/javascript" src="' . $ajs . '?zoneid=' . $zoneId .
                '&amp;cb=' . $cb . '&amp;charset=ISO-8859-1&amp;loc=' . $loc . '"></script>';
    }
  
   
}
?>
