<?php

class Home_Old extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->library('common');
    $this->load->helper('url');
    $this->load->library('rb');
    $this->load->library('session');
  }

  function index() {
    $this->load->library('bucket');
    $this->bucket->set_layout_id('mumcentre/desktop');
    $this->bucket->set_content_id('mumcentre/home_old');
    $this->bucket->add_css('mums');
    $this->bucket->add_css('home');
    $this->load->model('cms_model');
    $response = $this->cms_model->retrieve_article_only();
    $response2 = $this->cms_model->get_articles();
    $response3 = $this->cms_model->get_tickers();
    $this->bucket->set_data('article_info', $response['query']);
    $this->bucket->set_data('article_list', $response2['query']);
    $this->bucket->set_data('ticker_list', $response3['query']);
    $this->bucket->set_data('title', "Mumcentre");
    $this->bucket->render_layout();
  }

  function create_user() {
    $user = R::dispense("user");
    $user->first_name = "anon";
    $user->last_name = "user";
    $user->birth_date = "1980-01-01";
    $user->gender = 1;
    $user->email = "mum@yahoo.com";
    $user->location = "Manila";
    $user->age = 28;
    $user->avatar_filepath = "790cd58832a1200e16a6cf2ced28d351.jpg";
    $user->password = "5f4dcc3b5aa765d61d8327deb882cf99";
    $user->created_date = date("Y-m-d H:i:s");
    $id = R::store($user);
    echo $id;
  }
  
  function create_review() {
    $review = R::dispense("provider_review");
    $review->review_title = "Review Title";
    $review->review_image = "image";
    $review->review_summary = "Review Summary";
    $review->review_body = "Review Body";
    $review->review_status = 1;
    $review->provider_id = 1;
    $review->created_date = date("Y-m-d H:i:s");
    $id = R::store($review);
    echo $id;
  }
  
  function create_hotbox() {
    $hotbox = R::dispense("hotbox");
    $hotbox->hotbox_title = "Hotbox Title";
    $hotbox->hotbox_image = "Hotbox image";
    $hotbox->hotbox_link = "Hotbox link";
    $hotbox->hotbox_status = 1;
    $id = R::store($hotbox);
    echo $id;
  }
  
  function create_event() {
    $event = R::dispense("provider_event");
    $event->event_title = "Event Title";
    $event->event_image = "image";
    $event->event_summary = "Event Summary";
    $event->event_venue = "Venue";
    $event->event_contact = "Contact Number";
    $event->event_time = "Event time";
    $event->event_cost = "Event cost";
    $event->event_status = 1;
    $event->provider_id = 1;
    $event->created_date = date("Y-m-d H:i:s");
    $id = R::store($event);
    echo $id;
  }
  
  function create_program() {
    $program = R::dispense("provider_program");
    $program->program_title = "Program Title";
    $program->program_image = "image";
    $program->program_summary = "Program Summary";
    $program->program_body = "Program Body";
    $program->program_status = 1;
    $program->provider_id = 1;
    $program->created_date = date("Y-m-d H:i:s");
    $id = R::store($program);
    echo $id;
  }
  
  function create_curriculum() {
    $curriculum = R::dispense("provider_curriculum");
    $curriculum->curriculum_title = "Curriculum Title";
    $curriculum->curriculum_image = "image";
    $curriculum->curriculum_summary = "Curriculum Summary";
    $curriculum->curriculum_body = "Curriculum Body";
    $curriculum->curriculum_status = 1;
    $curriculum->provider_id = 1;
    $curriculum->created_date = date("Y-m-d H:i:s");
    $id = R::store($curriculum);
    echo $id;
  }
  
  function create_article() {
    $article = R::dispense("article");
    $article->article_title = "Parenting Article";
    $article->article_summary = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";
    $article->article_author = "Test Author";
    $article->article_body = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";
    $article->article_image = "78004b05756d95611a1b27714d4e5330.jpg";
    $article->status = 0;
    $article->age_group = 5;
    $article->created_date = date("Y-m-d H:i:s");
    $id = R::store($article);
    echo $id;
  }
  
  
  function create_photoblog(){
    $photoblog = R::dispense("photo_blog");
    $photoblog->name = "Anon";
    $photoblog->photo_caption = "lols";
    $photoblog->photo_file = "99983f03ed54b073bf679c6631c9dc9e.jpg";
    $photoblog->status = 0;
    $photoblog->created_date = date("Y-m-d H:i:s");
    $id = R::store($photoblog);
    echo $id;
  }
  

  function create_provider(){
    $provider = R::dispense("provider_profile");
    $provider->provider_name = "name";
    $provider->provider_details = "details";
    $provider->provider_location = "location";
    $provider->provider_email = "email";
    $provider->provider_contact = "contact";
    $provider->provider_logo = "logo";
    $provider->provider_image = "image";
    $provider->provider_ticker = "ticker";
    $provider->provider_link = "link";
    $provider->status = 1;
    $provider->created_date = date("Y-m-d H:i:s");
    $id = R::store($provider);
    echo $id;
  }

  private function _baby_latest_article() {
    $article = R::getAll("SELECT a.title AS article_title, a.summary AS article_summary, a.image_filepath AS article_image, a.id, a.age_group_id AS age_group
    FROM article AS a INNER JOIN age_group AS age
    ON a.age_group_id = age.id
    WHERE a.age_group_id = 2
    AND a.status = 1
    ORDER BY a.created_date DESC LIMIT 1");

    //$article[0]['article_body'] = $this->_getArticleIntro($article[0]['article_body']);
    $article[0]['article_link'] = $this->_getArticleLink($article[0]['article_title']);

    return '"latest":' . json_encode($article);
  }

  private function _baby_featured_articles() {
    $articles = R::getAll("SELECT a.title AS article_title, a.summary AS article_summary, a.image_filepath AS article_image, a.id, a.age_group_id AS age_group
    FROM article AS a INNER JOIN age_group AS age
    ON a.age_group_id = age.id
    WHERE a.age_group_id = 2
    AND a.status = 1
    ORDER BY a.created_date DESC LIMIT 1, 4");
//    foreach ($articles AS $article) {
//      $article['article_body'] = $this->_getArticleIntro($article['article_body']);
//    }
    foreach ($articles AS &$article) {
        $article['article_link'] = $this->_getArticleLink($article['article_title']);
        $article['article_summary'] = $this->_trimArticles($article['article_summary']);
    }
    
    return '"featured":' . json_encode($articles);
    //echo $this->_json_response('featured_articles', $articles);
  }
  
   private function _pregnancy_latest_article() {
    $article = R::getAll("SELECT a.title AS article_title, a.summary AS article_summary, a.image_filepath AS article_image, a.id, a.age_group_id AS age_group
    FROM article AS a INNER JOIN age_group AS age
    ON a.age_group_id = age.id
    WHERE a.age_group_id = 1
    AND a.status = 1
    ORDER BY a.created_date DESC LIMIT 1");

    //$article[0]['article_body'] = $this->_getArticleIntro($article[0]['article_body']);
    $article[0]['article_link'] = url_title($article[0]['article_title']);
    $article[0]['article_summary'] = $this->_trimArticles($article[0]['article_summary']);
    
    return '"latest":' . json_encode($article);
  }

  private function _pregnancy_featured_articles() {
    $articles = R::getAll("SELECT a.title AS article_title, a.summary AS article_summary, a.image_filepath AS article_image, a.id, a.age_group_id AS age_group
    FROM article AS a INNER JOIN age_group AS age
    ON a.age_group_id = age.id
    WHERE a.age_group_id = 1
    AND a.status = 1
    ORDER BY a.created_date DESC LIMIT 1, 4");
//    foreach ($articles AS $article) {
//      $article['article_body'] = $this->_getArticleIntro($article['article_body']);
//    }
    foreach ($articles AS &$article) {
        $article['article_link'] = url_title($article['article_title']);
        $article['article_summary'] = $this->_trimArticles($article['article_summary']);
    }
    
    return '"featured":' . json_encode($articles);
    //echo $this->_json_response('featured_articles', $articles);
  }
  
   private function _toddler_latest_article() {
    $article = R::getAll("SELECT a.title AS article_title, a.summary AS article_summary, a.image_filepath AS article_image, a.id, a.age_group_id AS age_group
    FROM article AS a INNER JOIN age_group AS age
    ON a.age_group_id = age.id
    WHERE a.age_group_id = 3
    AND a.status = 1
    ORDER BY a.created_date DESC LIMIT 1");

    //$article[0]['article_body'] = $this->_getArticleIntro($article[0]['article_body']);
    $article[0]['article_link'] = url_title($article[0]['article_title']);
    $article[0]['article_summary'] = $this->_trimArticles($article[0]['article_summary']);

    return '"latest":' . json_encode($article);
  }

  private function _toddler_featured_articles() {
    $articles = R::getAll("SELECT a.title AS article_title, a.summary AS article_summary, a.image_filepath AS article_image, a.id, a.age_group_id AS age_group
    FROM article AS a INNER JOIN age_group AS age
    ON a.age_group_id = age.id
    WHERE a.age_group_id = 3
    AND a.status = 1
    ORDER BY a.created_date DESC LIMIT 1, 4");
//    foreach ($articles AS $article) {
//      $article['article_body'] = $this->_getArticleIntro($article['article_body']);
//    }
    foreach ($articles AS &$article) {
        $article['article_link'] = url_title($article['article_title']);
        $article['article_summary'] = $this->_trimArticles($article['article_summary']);
    }
    
    return '"featured":' . json_encode($articles);
    //echo $this->_json_response('featured_articles', $articles);
  }
  
   private function _preschool_latest_article() {
    $article = R::getAll("SELECT a.title AS article_title, a.summary AS article_summary, a.image_filepath AS article_image, a.id, a.age_group_id AS age_group
    FROM article AS a INNER JOIN age_group AS age
    ON a.age_group_id = age.id
    WHERE a.age_group_id = 4
    AND a.status = 1
    ORDER BY a.created_date DESC LIMIT 1");

    //$article[0]['article_body'] = $this->_getArticleIntro($article[0]['article_body']);
    $article[0]['article_link'] = url_title($article[0]['article_title']);
    $article[0]['article_summary'] = $this->_trimArticles($article[0]['article_summary']);

    return '"latest":' . json_encode($article);
  }

  private function _preschool_featured_articles() {
    $articles = R::getAll("SELECT a.title AS article_title, a.summary AS article_summary, a.image_filepath AS article_image, a.id, a.age_group_id AS age_group
    FROM article AS a INNER JOIN age_group AS age
    ON a.age_group_id = age.id
    WHERE a.age_group_id = 4
    AND a.status = 1
    ORDER BY a.created_date DESC LIMIT 1, 4");
//    foreach ($articles AS $article) {
//      $article['article_body'] = $this->_getArticleIntro($article['article_body']);
//    }
    foreach ($articles AS &$article) {
        $article['article_link'] = url_title($article['article_title']);
        $article['article_summary'] = $this->_trimArticles($article['article_summary']);
    }
    
    return '"featured":' . json_encode($articles);
    //echo $this->_json_response('featured_articles', $articles);
  }
  
   private function _parent_latest_article() {
    $article = R::getAll("SELECT a.title AS article_title, a.summary AS article_summary, a.image_filepath AS article_image, a.id, a.age_group_id AS age_group
    FROM article AS a INNER JOIN age_group AS age
    ON a.age_group_id = age.id
    WHERE a.age_group_id = 5
    AND a.status = 1
    ORDER BY a.created_date DESC LIMIT 1");

    //$article[0]['article_body'] = $this->_getArticleIntro($article[0]['article_body']);
    $article[0]['article_link'] = url_title($article[0]['article_title']);
    $article[0]['article_summary'] = $this->_trimArticles($article[0]['article_summary']);

    return '"latest":' . json_encode($article);
  }

  private function _parent_featured_articles() {
    $articles = R::getAll("SELECT a.title AS article_title, a.summary AS article_summary, a.image_filepath AS article_image, a.id, a.age_group_id AS age_group
    FROM article AS a INNER JOIN age_group AS age
    ON a.age_group_id = age.id
    WHERE a.age_group_id = 5
    AND a.status = 1
    ORDER BY a.created_date DESC LIMIT 1, 4");
//    foreach ($articles AS $article) {
//      $article['article_body'] = $this->_getArticleIntro($article['article_body']);
//    }
    foreach ($articles AS &$article) {
        $article['article_link'] = url_title($article['article_title']);
        $article['article_summary'] = $this->_trimArticles($article['article_summary']);
    }
    
    return '"featured":' . json_encode($articles);
    //echo $this->_json_response('featured_articles', $articles);
  }
  
  private function _reviews() {
    $highlights = R::getAll("SELECT r.title AS review_title, r.summary AS review_summary, r.image_filepath AS review_image  
    FROM provider_review AS r
    WHERE r.status = 1
    ORDER BY r.created_date DESC LIMIT 3");
    
    foreach ($highlights AS &$highlight) {
      $highlight['review_summary'] = $this->_trimHighlights($highlight['review_summary']);
    }

    return '"highlights":' . json_encode($highlights);
    //echo $this->_json_response('featured_articles', $articles);
  }
  
  private function _programs() {
    $highlights = R::getAll("SELECT p.title as program_title, p.summary as program_summary, p.file_imagepath as program_image  
    FROM provider_program AS p
    WHERE p.status = 1
    ORDER BY p.created_date DESC LIMIT 3");
    
    foreach ($highlights AS &$highlight) {
      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
    }

    return '"highlights":' . json_encode($highlights);
    //echo $this->_json_response('featured_articles', $articles);
  }
  
  private function _recent_photoblog() {
    $photoblog = R::getAll("SELECT p.caption as photo_caption, p.photo_filepath as photo_file, p.name
    FROM photo_blog AS p
    WHERE p.status = 1
    ORDER BY p.created_date DESC LIMIT 8");

    return '"photoblog":' . json_encode($photoblog);
    //echo $this->_json_response('featured_articles', $articles);
  }
  
  private function _activemums() {
    $activemums = R::getAll("SELECT u.first_name, u.avatar_filepath
    FROM user AS u
    WHERE gender = 1
    ORDER BY u.created_date DESC LIMIT 7");

    return '"activemums":' . json_encode($activemums);
    //echo $this->_json_response('featured_articles', $articles);
  }
  
  private function _tickers() {
    $tickers = R::getAll("SELECT p.ticker
    FROM provider_profile AS p
    WHERE status = 1
    ORDER BY RAND()");

    return '"tickers":' . json_encode($tickers);
    //echo $this->_json_response('featured_articles', $articles);
  }
  
  function ticker_data(){
    echo '{"ticker_data": [{'.$this->_tickers().'}]}';
  }

  function baby_article_data() {
    echo '{"baby_article_data": [{'.$this->_baby_latest_article().','.$this->_baby_featured_articles().'}]}';
  }
  
  function pregnancy_article_data() {
    echo '{"pregnancy_article_data": [{'.$this->_pregnancy_latest_article().','.$this->_pregnancy_featured_articles().'}]}';
  }
  
  function toddler_article_data() {
    echo '{"toddler_article_data": [{'.$this->_toddler_latest_article().','.$this->_toddler_featured_articles().'}]}';
  }
  
  function preschool_article_data() {
    echo '{"preschool_article_data": [{'.$this->_preschool_latest_article().','.$this->_preschool_featured_articles().'}]}';
  }
  
  function parent_article_data() {
    echo '{"parent_article_data": [{'.$this->_parent_latest_article().','.$this->_parent_featured_articles().'}]}';
  }
  
  function review_data(){
      echo '{"review_data": [{'.$this->_reviews().'}]}';
  }
  
  function program_data(){
      echo '{"program_data": [{'.$this->_programs().'}]}';
  }
  
  function photoblog_data(){
      echo '{"photoblog_data": [{'.$this->_recent_photoblog().'}]}';
  }
  
  function activemums_data(){
      echo '{"activemums_data": [{'.$this->_activemums().'}]}';
  }
  
  private function _trimHighlights($article_summary){
      $trimmed_summary = strlen($article_summary) > 121 ? substr($article_summary, 0, 121) . "" : $article_summary;
//      $dashed_summary = str_replace(' ', '-', $trimmed_summary);
//      return $dashed_summary;
      return $trimmed_summary;
  }
  
  private function _trimArticles($article_summary){
      $trimmed_summary = strlen($article_summary) > 221 ? substr($article_summary, 0, 221) . "" : $article_summary;
//      $dashed_summary = str_replace(' ', '-', $trimmed_summary);
//      return $dashed_summary;
      return $trimmed_summary;
  }
  
  private function _getArticleLink($article_title){
      $link = str_replace(' ', '-', $article_title);
      return $link;
  }

  private function _getArticleIntro($article_body) {
    $intro = "";
    preg_match("/<p>(.*)<\/p>/", $article_body, $matches);
    if($matches) {
      $intro = strip_tags($matches[1]);
    } else {
      preg_match("/<div>(.*)<\/div>/", $article_body, $matches);
      if($matches) {
        $intro = strip_tags($matches[1]);
      } else {
        $intro = $article_body;
      }      
    }    
    return $intro;
  }

  private function _json_response($name, $array_data) {
    if (count($array_data) > 0) {
      return '{"' . $name . '":' . json_encode($array_data) . '}';
    } else {
      return '{"' . $name . '":[]}';
    }
  }

  private function _stringSummarize($data, $isHTML = true) {

    $result = $data;

    if ($isHTML) {

      // convert line breaks/paragraphs
      $result = str_replace("
        ", "", $result); // remove extra
      $result = str_replace("<br>", "", $result);
      $result = str_replace("<br/>", "", $result);
      $result = str_replace("<br />", "", $result);
      $result = str_replace("</p>", "", $result);

      // strip all remaining tags
      $result = strip_tags($result);
    }

    // try and return the first paragraph, if I can't, return all of it
    $paragraphs = explode("
      ", trim($result));

    if (count($paragraphs) > 1) {
      return nl2br(trim($paragraphs[0]));
    } else {
      return $data;
    }
  }
}