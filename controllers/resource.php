<?php

class Resource extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
	$this->load->library('mcox');
        $this->meta_description = $this->config->item('description');
        if (!$this->session->userdata('country_id')) {
            $this->session->set_userdata('country_id', $this->config->item('country_id'));
        }
    }

    function index() {
        $message_403 = "Direct access is forbidden.";
        show_error($message_403, 403);
    }

    function read($id, $title) {
        $trim_title = str_replace('-', ' ', $title);
        $base = base_url();
        $image = $this->_image_finder($id);
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/athan');
        $this->bucket->set_content_id('mumcentre/res');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('article');
        $this->bucket->add_css('style');
        $this->bucket->set_data('description', $this->meta_description);
        $this->bucket->set_data('title', 'Mumcentre - ' . $trim_title);
        $this->bucket->set_data('og_image', $base . "uploads/article/image/" . $image);
        $this->bucket->set_data('og_title', 'Mumcentre - ' . $trim_title);
        $this->bucket->set_data('og_type', 'article');
        $this->bucket->set_data('og_url', $base . "resource/read/" . $id . "/" . $title);
        $this->bucket->set_data('id', $id);
//        $this->bucket->set_data('id_get', $response['id_get']);
//        $this->bucket->set_data('title', "");
        $this->bucket->render_layout();
    }

    function blank() {
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/blank_res');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('article');
        $this->bucket->add_css('style');
        $this->bucket->set_data('description', $this->meta_description);
        $this->bucket->set_data('title', 'Mumcentre - ');
        $this->bucket->render_layout();
    }

    private function _image_finder($id) {
        $image_id = R::getRow("SELECT a.article_image
            FROM article as a
            WHERE a.id = " . $id
        );
//        echo $image_id['article_image'];
        return $image_id['article_image'];
    }

    function error() {
        $message_404 = "Either your requested article is removed, or your url is wrong...";
        show_error($message_404, 404);
    }

    private function _article($article_id) {

        $country_id = $this->session->userdata('country_id');
        $ip_address = $this->session->userdata('ip_address');
//        R::debug(true);
        // update total view counter
        $sql = "UPDATE article 
                SET total_views = total_views + 1,
                    last_viewed_week = YEARWEEK(NOW()),
                    last_viewed = NOW()
            WHERE id = " . $article_id;
        R::exec($sql);

        // update total view counter for specific country
        if ($country_id) {
            //$exist = reset(R::find('article_country', ' article_id = ? AND country_id = ? ', array($article_id, $country_id)));
            $sql = "SELECT article_id FROM article_country WHERE article_id=" . $article_id . " AND country_id=" . $country_id;
            $exist = R::exec($sql);

            if ($exist) {
                $sql = "UPDATE article_country
						SET total_views = total_views + 1,
		                	last_viewed_week = YEARWEEK(NOW()),
		                	last_viewed = NOW()";
                $sql.=" WHERE article_id = " . $article_id;
                $sql.=" AND country_id = " . $country_id;
                R::exec($sql);
            } else {
                $sql = "INSERT INTO article_country
						(article_id, country_id, total_views, last_viewed_week, last_viewed)
						VALUES ($article_id, $country_id, 1, YEARWEEK(NOW()), NOW())";
                R::exec($sql);
            }
        }
        
        
//        R::debug(true);
//        $data_exist = reset(R::find('article_view_log', ' article_id = ? AND ip_address = ? AND country_id = ? ', array($article_id, $ip_address, $country_id)));
        $sql = "SELECT article_id FROM article_view_log WHERE article_id=".$article_id." AND country_id=".$country_id." AND ip_address='".$ip_address."'";
        $data_exist = R::exec($sql);
        
        if (!$data_exist) {
            $article_v = R::dispense("article_view_log");
            $article_v->article_id = $article_id;
            $article_v->country_id = $country_id;
            $article_v->ip_address = $ip_address;
            R::store($article_v);
        }

        $sql = "SELECT 
            a.title AS article_title
          , a.summary AS article_summary
          , a.body AS article_body
          , a.image_filepath AS article_image
          , a.id, a.age_group_id AS age_group
          , a.created_date
        FROM article AS a INNER JOIN age_group as age
        ON a.age_group_id = age.id
        WHERE a.id = " . $article_id . " 
        AND a.status = 1";

        $article = R::getAll($sql);

//    $article[0]['created_date'] = date_format($article[0]['created_date'],'Y-m-d');
//    $article[0]['article_link'] = $this->_getArticleLink($article[0]['article_title']);

        return '"article":' . json_encode($article);
    }

    function article_data($article_id) {
        echo '{"article_data": [{' . $this->_article($article_id) . '}]}';
    }

//  private function _getArticleBody($article_body){
//      echo $article_body;
//      return $article_body;
//  }

    function resource_crumbs($article_id) {
        echo '{"resource_crumbs": [{' . $this->_crumbs($article_id) . '}]}';
    }

    private function _crumbs($article_id) {
        $crumbs = R::getAll("SELECT age.name AS age_group_name
    FROM article AS a INNER JOIN age_group as age
    ON a.age_group_id = age.id
    WHERE a.id = " . $article_id . " 
    AND a.status = 1"
        );

        foreach ($crumbs as &$c) {
            $article['age_link'] = url_title($article['age_group_name'], 'dash', TRUE);
        }

        return '"crumbs":' . json_encode($crumbs);
    }

    function article_list($age_group_id) {
        echo '{"article_data": [{' . $this->_featured_articles($age_group_id) . '}]}';
    }

    function mostpop_article_list($age_group_id) {
        echo '{"article_data": [{' . $this->_latest_popular_articles($age_group_id) . ',' . $this->_featured_popular_articles($age_group_id) . '}]}';
    }

    private function _latest_popular_articles($age_group_id) {

        $sql = "SELECT a.title as article_title, a.summary as article_summary, a.image_filepath as article_image, a.id, a.seo_url as seo_url, b.name as age_group_name
    FROM article AS a
    INNER JOIN age_group as b ON a.age_group_id = b.id
    WHERE a.age_group_id = " . $age_group_id . " 
    AND a.status = 1
    ORDER BY a.last_viewed_week DESC, a.total_views DESC
    LIMIT 1";

        $article = R::getAll($sql);

        $article[0]['article_link'] = $article[0]['seo_url'];
        $article[0]['article_summary'] = $this->_trimArticles($article[0]['article_summary']);
        $article[0]['age_group_name'] = str_replace('-', '', $article[0]['age_group_name']);
        $article[0]['age_group_name'] = url_title($article[0]['age_group_name'], 'dash', TRUE);

        return '"latest":' . json_encode($article);
    }

    private function _featured_popular_articles($age_group_id) {

        $sql = "SELECT a.title as article_title, a.summary as article_summary, a.image_filepath as article_image, a.id, a.seo_url as seo_url,b.name as age_group_name
    FROM article AS a
    INNER JOIN age_group as b ON a.age_group_id = b.id
    WHERE a.age_group_id = " . $age_group_id . " 
    AND a.status = 1
    ORDER BY a.last_viewed_week DESC, a.total_views DESC
    LIMIT 1, 2";

        $articles = R::getAll($sql);

        foreach ($articles as &$article) {
            $article['article_link'] = $article['seo_url'];
            $article['article_summary'] = $this->_trimArticles($article['article_summary']);
            $article['age_group_name'] = str_replace('-', '', $article['age_group_name']);
            $article['age_group_name'] = url_title($article['age_group_name'], 'dash', TRUE);
        }

        return '"featured":' . json_encode($articles);
    }

    private function _latest_article($age_group_id) {
        $article = R::getAll("SELECT a.title as article_title, a.summary as article_summary, a.image_filepath as article_image, a.id, a.seo_url as seo_url,b.name as age_group_name
    FROM article AS a 
    INNER JOIN age_group as b ON a.age_group_id = b.id
    WHERE a.age_group_id = " . $age_group_id . " 
    AND a.status = 1 
    ORDER BY a.created_date DESC LIMIT 1");
        //$article[0]['article_body'] = $this->_getArticleIntro($article[0]['article_body']);
        $article[0]['article_link'] = $article[0]['seo_url'];
        $article[0]['article_summary'] = $this->_trimArticles($article[0]['article_summary']);
        $article[0]['age_group_name'] = str_replace('-', '', $article[0]['age_group_name']);
        $article[0]['age_group_name'] = url_title($article[0]['age_group_name'], 'dash', TRUE);
        return '"latest":' . json_encode($article);
    }

    private function _featured_articles($age_group_id) {
        $articles = R::getAll("SELECT a.title as article_title, a.summary as article_summary, a.image_filepath as article_image, a.id, a.seo_url as seo_url,b.name as age_group_name
    FROM article AS a
    INNER JOIN age_group as b ON a.age_group_id = b.id
    INNER JOIN article_country as c ON a.id = c.article_id
    WHERE a.age_group_id = " . $age_group_id . " 
    AND a.status = 1
    AND c.country_id = ".$this->config->item('country_id')."
    ORDER BY a.created_date DESC 
    LIMIT 3");
//    foreach ($articles as $article) {
//      $article['article_body'] = $this->_getArticleIntro($article['article_body']);
//    }
        foreach ($articles as &$article) {
            $article['article_link'] = $article['seo_url'];
            $article['article_title'] = $this->_trimArtTitle($article['article_title']);
            $article['article_summary'] = $this->_trimArticles($article['article_summary']);
            $article['age_group_name'] = str_replace('-', '', $article['age_group_name']);
            $article['age_group_name'] = url_title($article['age_group_name'], 'dash', TRUE);
        }

        return '"featured":' . json_encode($articles);
    }

    private function _getArticleLink($article_title) {
        $link = str_replace(' ', '-', $article_title);
        return $link;
    }

    private function _trimArtTitle($article_summary) {
        $trimmed_summary = strlen($article_summary) > 46 ? substr($article_summary, 0, 43) . "..." : $article_summary;
//      $dashed_summary = str_replace(' ', '-', $trimmed_summary);
//      return $dashed_summary;
        return $trimmed_summary;
    }
    
    private function _trimArticles($article_summary) {
        $trimmed_summary = strlen($article_summary) > 123 ? substr($article_summary, 0, 120) . "..." : $article_summary;
//      $dashed_summary = str_replace(' ', '-', $trimmed_summary);
//      return $dashed_summary;
        return $trimmed_summary;
    }
    
    private function _trimForumTitle($article_summary) {
        $trimmed_summary = strlen($article_summary) > 20 ? substr($article_summary, 0, 17) . "..." : $article_summary;
        return $trimmed_summary;
    }
    
    private function _trimForumBody($article_summary) {
        $trimmed_summary = strlen($article_summary) > 23 ? substr($article_summary, 0, 20) . "..." : $article_summary;
        return $trimmed_summary;
    }

    function review_list($age_group_id) {
        echo '{"review_data": [{' . $this->_latest_review($age_group_id) . ',' . $this->_featured_review($age_group_id) . '}]}';
    }

    private function _latest_review($age_group_id) {
        $article = R::getAll("SELECT r.title as review_title, r.summary as review_summary, r.image_filepath as review_image, r.id, r.provider_id
    FROM provider_review AS r
    WHERE r.age_group_id = " . $age_group_id . "
    AND r.status = 1 
    ORDER BY r.created_date DESC LIMIT 1");
        //$article[0]['article_body'] = $this->_getArticleIntro($article[0]['article_body']);
        $article[0]['review_summary'] = $this->_trimSummary($article[0]['review_summary']);
        $article[0]['review_title'] = $this->_trimItemTitle($article[0]['review_title']);
        return '"latest":' . json_encode($article);
    }

    private function _featured_review($age_group_id) {
        $articles = R::getAll("SELECT r.title as review_title, r.summary as review_summary, r.image_filepath as review_image, r.id, r.provider_id
    FROM provider_review AS r
    WHERE r.age_group_id = " . $age_group_id . "
    AND a.status = 1 
    ORDER BY r.created_date DESC LIMIT 1, 4");
//    foreach ($articles as $article) {
//      $article['article_body'] = $this->_getArticleIntro($article['article_body']);
//    }
        foreach ($articles as &$article) {
            $article['review_title'] = $this->_trimItemTitle($article['review_title']);
        }

        return '"featured":' . json_encode($articles);
    }

    private function _trimSummary($article_summary) {
        $trimmed_summary = strlen($article_summary) > 39 ? substr($article_summary, 0, 36) . "..." : $article_summary;
//      $dashed_summary = str_replace(' ', '-', $trimmed_summary);
//      return $dashed_summary;
        return $trimmed_summary;
    }

    private function _trimItemTitle($article_summary) {
        $trimmed_summary = strlen($article_summary) > 18 ? substr($article_summary, 0, 15) . "..." : $article_summary;
//      $dashed_summary = str_replace(' ', '-', $trimmed_summary);
//      return $dashed_summary;
        return $trimmed_summary;
    }

    function event_list($age_group_id) {
        echo '{"event_data": [{' . $this->_latest_event($age_group_id) . ',' . $this->_featured_event($age_group_id) . '}]}';
    }

    private function _latest_event($age_group_id) {
        $article = R::getAll("SELECT e.title AS event_title, e.summary AS event_summary, e.image_filepath AS event_image, e.id, e.provider_id
    FROM provider_event AS e
    WHERE e.age_group = " . $age_group_id . "
    AND e.status = 1
    ORDER BY e.created_date DESC LIMIT 1");
        //$article[0]['article_body'] = $this->_getArticleIntro($article[0]['article_body']);
        $article[0]['event_summary'] = $this->_trimSummary($article[0]['event_summary']);
        $article[0]['event_title'] = $this->_trimItemTitle($article[0]['event_title']);
        return '"latest":' . json_encode($article);
    }

    private function _featured_event($age_group_id) {
        $articles = R::getAll("SELECT e.title AS event_title, e.summary AS event_summary, e.image_filepath AS event_image, e.id, e.provider_id
    FROM provider_event AS e
    WHERE e.age_group = " . $age_group_id . " 
    AND e.status = 1
    ORDER BY e.created_date DESC LIMIT 1, 4");
//    foreach ($articles as $article) {
//      $article['article_body'] = $this->_getArticleIntro($article['article_body']);
//    }
        foreach ($articles as &$article) {
            $article['event_title'] = $this->_trimItemTitle($article['event_title']);
        }

        return '"featured":' . json_encode($articles);
    }

    function program_list($age_group_id) {
        echo '{"program_data": [{' . $this->_latest_program($age_group_id) . ',' . $this->_featured_program($age_group_id) . '}]}';
    }

    private function _latest_program($age_group_id) {
        $article = R::getAll("SELECT p.title AS program_title, p.summary AS program_summary, p.image_filepath AS program_image, p.id, p.provider_id
    FROM provider_program AS p
    WHERE p.age_group = " . $age_group_id . " 
    AND p.status = 1 
    ORDER BY p.created_date DESC LIMIT 1");
        //$article[0]['article_body'] = $this->_getArticleIntro($article[0]['article_body']);
        $article[0]['program_summary'] = $this->_trimSummary($article[0]['program_summary']);
        $article[0]['program_title'] = $this->_trimItemTitle($article[0]['program_title']);
        return '"latest":' . json_encode($article);
    }

    private function _featured_program($age_group_id) {
        $articles = R::getAll("SELECT p.title AS program_title, p.summary AS program_summary, p.image_filepath AS program_image, p.id, p.provider_id
    FROM provider_program AS p
    WHERE p.age_group = " . $age_group_id . " 
    AND p.status = 1
    ORDER BY p.created_date DESC LIMIT 1, 4");
//    foreach ($articles as $article) {
//      $article['article_body'] = $this->_getArticleIntro($article['article_body']);
//    }
        foreach ($articles as &$article) {
            $article['program_title'] = $this->_trimItemTitle($article['program_title']);
        }

        return '"featured":' . json_encode($articles);
    }

    function provider_list($age_group_id) {
        echo '{"provider_data": [{' . $this->_latest_provider($age_group_id) . ',' . $this->_featured_provider($age_group_id) . '}]}';
    }

    private function _latest_provider($age_group_id) {
        $article = R::getAll("SELECT p.name AS provider_name,p.logo_filepath AS provider_logo, p.id
    FROM provider_profile AS p
    WHERE p.age_group = " . $age_group_id . " 
    AND p.status = 1
    ORDER BY p.created_date DESC LIMIT 1");
        //$article[0]['article_body'] = $this->_getArticleIntro($article[0]['article_body']);
//    $article[0]['program_summary'] = $this->_trimSummary($article[0]['program_summary']);
        $article[0]['provider_name'] = $this->_trimItemTitle($article[0]['provider_name']);
        return '"latest":' . json_encode($article);
    }

    private function _featured_provider($age_group_id) {
        $articles = R::getAll("SELECT p.name AS provider_name,p.logo_filepath AS provider_logo, p.id
    FROM provider_profile AS p
    WHERE p.age_group = " . $age_group_id . " 
    AND p.status = 1
    ORDER BY p.created_date DESC LIMIT 1, 4");
//    foreach ($articles as $article) {
//      $article['article_body'] = $this->_getArticleIntro($article['article_body']);
//    }
        foreach ($articles as &$article) {
            $article['provider_name'] = $this->_trimItemTitle($article['provider_name']);
        }

        return '"featured":' . json_encode($articles);
    }

    private function _all_article($age_group_id) {
        $articles = R::getAll("SELECT a.title AS article_title, a.summary AS article_summary, a.image_filepath AS article_image, a.id, a.seo_url as seo_url,a.age_group_id AS age_group, b.name as age_group_name
    FROM article AS a
    INNER JOIN age_group as b ON a.age_group_id = b.id
    INNER JOIN article_country as c ON a.id = c.article_id
    WHERE a.age_group_id = " . $age_group_id . "
    AND c.country_id = ".$this->config->item('country_id')."    
    AND a.status = 1
    ORDER BY a.created_date"
        );

//    $article[0]['article_body'] = json_decode($article[0]['article_body']);
//    $article[0]['article_link'] = $this->_getArticleLink($article[0]['article_title']);
        foreach ($articles as &$article) {
            $article['article_link'] = $article['seo_url'];
            $article['article_summary'] = $this->_trimLongSummary($article['article_summary']);
            $article['article_title'] = $this->_trimLongTitle($article['article_title']);
            $article['age_group_name'] = url_title($article['age_group_name'], 'dash', TRUE);
        }

        return '"articles":' . json_encode($articles);
    }

    function all_article_data($age_group_id) {
        echo '{"article_data": [{' . $this->_all_article($age_group_id) . '}]}';
    }

    private function _trimLongSummary($article_summary) {
        $trimmed_summary = strlen($article_summary) > 249 ? substr($article_summary, 0, 246) . "..." : $article_summary;
//      $dashed_summary = str_replace(' ', '-', $trimmed_summary);
//      return $dashed_summary;
        return $trimmed_summary;
    }
    
    private function _trimLongTitle($article_summary) {
        $trimmed_summary = strlen($article_summary) > 54 ? substr($article_summary, 0, 51) . "..." : $article_summary;
//      $dashed_summary = str_replace(' ', '-', $trimmed_summary);
//      return $dashed_summary;
        return $trimmed_summary;
    }

    private function _right_side($age_group_id) {
        $articles = R::getAll("(SELECT 'events' as type, 'E' as letter, e.title, e.provider_id, e.id, a.name as age_group_name
    FROM provider_event as e
    INNER JOIN age_group as a ON e.age_group_id = a.id
    WHERE e.age_group_id = " . $age_group_id . "
    AND e.status = 1) UNION (SELECT 'programs' as type, 'P' as letter, p.title, p.provider_id, p.id, a.name as age_group_name
    FROM provider_program as p
    INNER JOIN age_group as a ON p.age_group_id = a.id
    WHERE p.age_group_id = " . $age_group_id . "
    AND p.status = 1) UNION (SELECT 'reviews' as type, 'R' as letter, r.title, r.provider_id, r.id, a.name as age_group_name
    FROM provider_review as r
    INNER JOIN age_group as a ON r.age_group_id = a.id
    WHERE r.age_group_id = " . $age_group_id . "
    AND r.status = 1)
    ORDER BY RAND()
    LIMIT 5"
        );

//    $article[0]['article_body'] = json_decode($article[0]['article_body']);
//    $article[0]['article_link'] = $this->_getArticleLink($article[0]['article_title']);
        foreach ($articles as &$article) {
//        $article['link'] = url_title($article['title']);
//        $article['article_summary'] = $this->_trimLongSummary($article['article_summary']);
        }

        return '"right_side":' . json_encode($articles);
    }

    function right_side_data($age_group_id) {
        echo '{"right_side_data": [{' . $this->_right_side($age_group_id) . '}]}';
    }

    function article_sequence($age_group_id, $date) {
        echo '{"article_data": [{' . $this->_previous_article($age_group_id, $date) . ',' . $this->_next_article($age_group_id, $date) . '}]}';
    }

    private function _previous_article($age_group_id, $date) {
        $date = urldecode($date);
        $age_groups = explode("%7C", $age_group_id);
        $new_age_group = "(";
        foreach($age_groups as $a){
            if(isset($fla)){ 
            $new_age_group.=" OR "; 
            } 
            $new_age_group .= "a.age_group_id = ".$a;
            $fla=1; 
        }
        $new_age_group .= ")";
        $articles = R::getRow("SELECT a.id, a.title AS article_title, a.seo_url as seo_url,b.name as age_group_name
        FROM article as a
        INNER JOIN age_group as b ON a.age_group_id = b.id
        INNER JOIN article_country as c ON a.id = c.article_id
        WHERE ".$new_age_group."
        AND TIMESTAMP(publish_date) < '" . $date . "'
        AND c.country_id = ".$this->config->item('country_id')." 
        LIMIT 1    
        ");
        if ($articles) {
            $articles['link'] = $articles['seo_url'];
            $articles['age_group_name'] = url_title($articles['age_group_name'], 'dash', TRUE);
        }
        return '"previous_article":' . json_encode($articles);
    }

    private function _next_article($age_group_id, $date) {
        $date = urldecode($date);
        $age_groups = explode("%7C", $age_group_id);
        $new_age_group = "(";
        foreach($age_groups as $a){
            if(isset($fla)){ 
            $new_age_group.=" OR "; 
            } 
            $new_age_group .= "a.age_group_id = ".$a;
            $fla=1; 
        }
        $new_age_group .= ")";
        $articles = R::getRow("SELECT a.id, a.title AS article_title, a.seo_url as seo_url,b.name as age_group_name
        FROM article as a
        INNER JOIN age_group as b ON a.age_group_id = b.id
        INNER JOIN article_country as c ON a.id = c.article_id
        WHERE ".$new_age_group."
        AND TIMESTAMP(publish_date) > '" . $date . "'
        AND c.country_id = ".$this->config->item('country_id')."    
        LIMIT 1    
        ");
        if ($articles) {
            $articles['link'] = $articles['seo_url'];
            $articles['age_group_name'] = url_title($articles['age_group_name'], 'dash', TRUE);
        }
        return '"next_article":' . json_encode($articles);
    }

    function forum_list($menu_group) {
        echo '{"forum_list": [{' . $this->_forum_list($menu_group) . '}]}';
    }

    private function _forum_list($menu_group) {
        $smfdbname = 'mumcentre_forum_sg';
        $forum = R::getAll("SELECT msg.id_msg, msg.id_topic, msg.id_board, msg.subject, msg.poster_name, msg.body, DATE_FORMAT(FROM_UNIXTIME(msg.poster_time), '%e-%d-%y %r') as time_posted, a.num_replies, a.num_views
	FROM $smfdbname.smf_messages msg
        INNER JOIN $smfdbname.smf_topics AS a
        ON msg.id_topic = a.id_topic        
	WHERE msg.id_board = $menu_group
        ORDER by msg.poster_time        
	LIMIT 5");
     
        foreach ($forum as &$article) {
        $article['subject'] = $this->_trimForumTitle($article['subject']);
        $article['body'] = $this->_trimForumBody($article['body']);
        }

        return '"forum":' . json_encode($forum);
    }

    function forum_list_article($menu_group) {
        echo '{"forum_list": [{' . $this->_forum_list_article($menu_group) . '}]}';
    }

    private function _forum_list_article($menu_group) {
        $smfdbname = 'mumcentre_forum_sg';
        $forum = R::getAll("SELECT msg.id_msg, msg.id_topic, msg.id_board,
	DATE_FORMAT(FROM_UNIXTIME(msg.poster_time), '%m.%d.%Y %H:%i:%s') AS poster_date, msg.subject, msg.poster_name
	FROM $smfdbname.smf_messages msg
	WHERE msg.id_board = $menu_group
        ORDER by poster_date        
	LIMIT 8");
        //$article[0]['article_body'] = $this->_getArticleIntro($article[0]['article_body']);
//    $article[0]['program_summary'] = $this->_trimSummary($article[0]['program_summary']);

        return '"forum":' . json_encode($forum);
    }

    function read_this($current_article_id) {
        echo '{"read_this": [{' . $this->_read_this($current_article_id) . '}]}';
    }

    private function _read_this($current_article_id) {
        $current_country_id = $this->session->userdata('country_id');
        $articles = R::getAll("SELECT
                              a.id AS article_id
                            , a.title AS article_title
                            , a.seo_url as link
                            , b.name as age_group_name
                            FROM article AS a
                            INNER JOIN age_group AS b ON a.age_group_id = b.id
                            WHERE a.id <> $current_article_id
                            AND a.status = 1
                            AND a.id IN (SELECT DISTINCT av1.article_id 
                                            FROM article_view_log AS av1
                                            INNER JOIN article_view_log AS av2
                                            ON av2.ip_address = av1.ip_address
                                            WHERE av1.article_id = $current_article_id
                                            AND av1.country_id = $current_country_id
                                            )
                            LIMIT 5");
        //$article[0]['article_body'] = $this->_getArticleIntro($article[0]['article_body']);
//    $article[0]['program_summary'] = $this->_trimSummary($article[0]['program_summary']);

        foreach ($articles as &$article) {
            $article['age_group_name'] = url_title($article['age_group_name'], 'dash', TRUE);
        }

        return '"read":' . json_encode($articles);
    }
    
    function mostpop_articles($age_group) {
        echo '{"articles": [{' . $this->_mostpop_articles($age_group) . '}]}';
    }

    private function _mostpop_articles($age_group) {

        $sql = "SELECT a.title as article_title, a.summary as article_summary,
			a.image_filepath as article_image, a.id, a.seo_url as seo_url, 
			b.name as age_group_name
        FROM article AS a
        INNER JOIN age_group as b ON a.age_group_id = b.id
        WHERE a.status = 1
        AND a.age_group_id = ".$age_group."
        ";

        if ($this->session->userdata('country_id')) {
            $sql.=" AND a.id IN (SELECT article_id FROM article_country 
		WHERE country_id=" . $this->session->userdata('country_id') . ")";
        }
        $sql.=" ORDER BY a.publish_date DESC LIMIT 4";

        $articles = R::getAll($sql);

        foreach ($articles as &$article) {
            $article['article_link'] = $article['seo_url'];
            $article['article_title'] = $this->_trimTitle($article['article_title']);
            $article['article_summary'] = $this->_trimArticle($article['article_summary']);
            $article['age_group_name_link'] = url_title($article['age_group_name'], 'dash', TRUE);
            $article['age_group_name_link'] = str_replace("-", "", $article['age_group_name_link']);
        }

        return '"article":' . json_encode($articles);
    }

    function mostpop_week($age_group) {
        echo '{"articles": [{' . $this->_mostpop_week($age_group) . '}]}';
    }

    private function _mostpop_week($age_group) {

        if ($this->session->userdata('country_id')) {
            $sql = "SELECT a.title as article_title, a.summary as article_summary
			, a.image_filepath as article_image, a.seo_url as seo_url,a.id
			, b.name as age_group_name
			FROM article AS a
			INNER JOIN age_group as b ON a.age_group_id = b.id
			INNER JOIN (SELECT article_id, total_views
						FROM article_country
						WHERE country_id = " . $this->session->userdata('country_id') . "
						AND last_viewed_week = YEARWEEK(NOW())
						) AS ac
			ON ac.article_id = a.id
			WHERE a.status = 1
                        AND a.age_group_id = ".$age_group."
			ORDER BY ac.total_views DESC LIMIT 4";
        } else {
            $sql = "SELECT a.title as article_title, a.summary as article_summary
			, a.image_filepath as article_image, a.seo_url as seo_url,a.id
			, b.name as age_group_name
			FROM article AS a
			INNER JOIN age_group as b ON a.age_group_id = b.id
			WHERE a.status = 1
                        AND a.age_group_id = ".$age_group."
			AND a.last_viewed_week = YEARWEEK(NOW()) 
			ORDER BY total_views DESC LIMIT 4";
        }
        $articles = R::getAll($sql);

        foreach ($articles as &$article) {
            $article['article_title'] = $this->_trimTitle($article['article_title']);
            $article['article_link'] = $article['seo_url'];
            $article['article_summary'] = $this->_trimArticle($article['article_summary']);
            $article['age_group_name_link'] = url_title($article['age_group_name'], 'dash', TRUE);
            $article['age_group_name_link'] = str_replace("-", "", $article['age_group_name_link']);
        }

        return '"article":' . json_encode($articles);
    }

    function mostpop_month($age_group) {
        echo '{"articles": [{' . $this->_mostpop_month($age_group) . '}]}';
    }

    private function _mostpop_month($age_group) {

        if ($this->session->userdata('country_id')) {
            $sql = "SELECT a.title as article_title, a.summary as article_summary
			, a.image_filepath as article_image, a.seo_url as seo_url,a.id
			, b.name as age_group_name
			FROM article AS a
			INNER JOIN age_group as b ON a.age_group_id = b.id
			INNER JOIN (SELECT article_id, total_views, last_viewed_week
						FROM article_country
						WHERE country_id = " . $this->session->userdata('country_id') . "
						AND MONTH(last_viewed) = MONTH(NOW())
						AND YEAR(last_viewed) = YEAR(NOW())
						) AS ac
			ON ac.article_id = a.id
			WHERE a.status = 1
                        AND a.age_group_id = ".$age_group."
			ORDER BY ac.last_viewed_week DESC, ac.total_views DESC LIMIT 4";
        } else {
            $sql = "SELECT a.title as article_title, a.summary as article_summary, a.image_filepath as article_image, a.id, a.seo_url as seo_url,b.name as age_group_name
				FROM article AS a
				INNER JOIN age_group as b ON a.age_group_id = b.id
				WHERE a.status = 1
                                AND a.age_group_id = ".$age_group."
				AND MONTH(a.last_viewed) = MONTH(NOW())
				AND YEAR(a.last_viewed) = YEAR(NOW())
				ORDER BY last_viewed_week DESC, total_views DESC LIMIT 4";
        }
        $articles = R::getAll($sql);

        foreach ($articles as &$article) {
            $article['article_title'] = $this->_trimTitle($article['article_title']);
            $article['article_link'] = $article['seo_url'];
            $article['article_summary'] = $this->_trimArticle($article['article_summary']);
            $article['age_group_name_link'] = url_title($article['age_group_name'], 'dash', TRUE);
            $article['age_group_name_link'] = str_replace("-", "", $article['age_group_name_link']);
        }

        return '"article":' . json_encode($articles);
    }

    function mostpop_all($age_group) {
        echo '{"articles": [{' . $this->_mostpop_all($age_group) . '}]}';
    }

    private function _mostpop_all($age_group) {

        if ($this->session->userdata('country_id')) {
            $sql = "SELECT a.title as article_title, a.summary as article_summary
				,a.image_filepath as article_image, a.id, a.seo_url as seo_url
				, b.name as age_group_name
			FROM article AS a
			INNER JOIN age_group as b ON a.age_group_id = b.id
			INNER JOIN (SELECT article_id, total_views
						FROM article_country
						WHERE country_id = " . $this->session->userdata('country_id') . " 							) AS ac
			ON ac.article_id = a.id
			WHERE a.status = 1
                        AND a.age_group_id = ".$age_group."
			ORDER BY ac.total_views DESC
			LIMIT 4";
        } else {
            $sql = "SELECT a.title as article_title, a.summary as article_summary
				,a.image_filepath as article_image, a.id, a.seo_url as seo_url
				, b.name as age_group_name
			FROM article AS a
			INNER JOIN age_group as b ON a.age_group_id = b.id
			WHERE a.status = 1
                        AND a.age_group_id = ".$age_group."
			ORDER BY total_views DESC
			LIMIT 4";
        }
        $articles = R::getAll($sql);

        foreach ($articles as &$article) {
            $article['article_title'] = $this->_trimTitle($article['article_title']);
            $article['article_link'] = $article['seo_url'];
            $article['article_summary'] = $this->_trimArticle($article['article_summary']);
            $article['age_group_name_link'] = url_title($article['age_group_name'], 'dash', TRUE);
            $article['age_group_name_link'] = str_replace("-", "", $article['age_group_name_link']);
        }

        return '"article":' . json_encode($articles);
    }

    function latest_articles($age_group) {
        echo '{"articles": [{' . $this->_latest_articles($age_group) . '}]}';
    }

    private function _latest_articles($age_group) {

        $sql = "SELECT a.title as article_title, a.summary as article_summary, a.image_filepath as article_image, a.id, a.seo_url as seo_url, b.name as age_group_name
    FROM article AS a
    INNER JOIN age_group as b ON a.age_group_id = b.id
    INNER JOIN article_country as c ON c.article_id = a.id
    WHERE a.status = 1
    AND a.age_group_id = ".$age_group."
    AND c.country_id = ".$this->config->item('country_id')."
    ORDER BY a.publish_date DESC
    LIMIT 4";

        $articles = R::getAll($sql);

        foreach ($articles as &$article) {
            $article['article_link'] = $article['seo_url'];
            $article['article_summary'] = $this->_trimArticle($article['article_summary']);
            $article['age_group_name_link'] = url_title($article['age_group_name'], 'dash', TRUE);
        }

        return '"article":' . json_encode($articles);
    }
    
    private function _trimArticle($article_summary) {
        $trimmed_summary = strlen($article_summary) > 73 ? substr($article_summary, 0, 70) . "..." : $article_summary;
        return $trimmed_summary;
    }
    
    private function _trimTitle($article_title) {
        $trimmed_title = strlen($article_title) > 43 ? substr($article_title, 0, 40) . "..." : $article_title;
        return $trimmed_title;
    }
    
    private function _trimReview($article_title) {
        $trimmed_title = strlen($article_title) > 72 ? substr($article_title, 0, 72) . "..." : $article_title;
        return $trimmed_title;
    }
    
    private function _trimReviewTitle($article_title) {
        $trimmed_title = strlen($article_title) > 52 ? substr($article_title, 0, 49) . "..." : $article_title;
        return $trimmed_title;
    }
    
    function latest_reviews($age_group) {
        echo '{"reviews": [{' . $this->_latest_reviews($age_group) . '}]}';
    }

    private function _latest_reviews($age_group) {
        
        $sql = "SELECT a.title as review_title, a.summary as review_summary,
	  a.image_filepath as review_image, a.id, a.seo_url, b.name as age_group_name
	FROM provider_review AS a
	INNER JOIN age_group as b ON a.age_group_id = b.id
        INNER JOIN provider_country as c ON a.provider_id = c.provider_id
	WHERE a.status = 1
        AND c.country_id = ".$this->config->item('country_id')."
        AND a.age_group_id = ".$age_group."    
        ORDER BY a.created_date DESC
        LIMIT 8";

        $entries = R::getAll($sql);

        foreach ($entries as &$entry) {
            $entry['review_summary'] = $this->_trimReview($entry['review_summary']);
            $entry['review_title'] = $this->_trimReviewTitle($entry['review_title']);
        }

        return '"review":' . json_encode($entries);
    }
    
    
    
    

}
