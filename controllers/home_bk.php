<?php

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
        $this->load->library('mcox');
	$this->load->helper('cookie');
        $this->load->library('session');
        if (!$this->session->userdata('country_id')) {
            $this->session->set_userdata('country_id', $this->config->item('country_id'));
        }
    }

    function set_country($country_id) {
       $this->session->set_userdata('country_id', $country_id);
    }

    function index() {
       $mrec1 = $this->_generateTags(45);

        $mrec2 = $this->_generateTags(46);

        $mrec3 = $this->_generateTags(63);

        $mrec4 = $this->_generateTags(112);

        $mrec5 = $this->_generateTags(113);

        $mrec6 = $this->_generateTags(114);;

        $mumad1 = $this->_generateTags(37);

        $mumad2 = $this->_generateTags(38);

        $rec1 = $this->_generateTags(33);

        $rec2 = $this->_generateTags(34);

        $rec3 = $this->_generateTags(35);

        $rec4 = $this->_generateTags(36);

        $hotboxcontentarray = array();
        $hotboximgarray = array();
        $hotboxtitlearray = array();
        $this->load_hotbox($hotboxcontentarray, $hotboximgarray, $hotboxtitlearray);

        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/home');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('index-style');
        $this->bucket->set_data('mrec1', $mrec1);
        $this->bucket->set_data('mrec2', $mrec2);
        $this->bucket->set_data('mrec3', $mrec3);
        $this->bucket->set_data('mrec4', $mrec4);
        $this->bucket->set_data('mrec5', $mrec5);
        $this->bucket->set_data('mrec6', $mrec6);
        $this->bucket->set_data('mumad1', $mumad1);
        $this->bucket->set_data('mumad2', $mumad2);
        $this->bucket->set_data('rec1', $rec1);
        $this->bucket->set_data('rec2', $rec2);
        $this->bucket->set_data('rec3', $rec3);
        $this->bucket->set_data('rec4', $rec4);

        $this->bucket->set_data('hotboxcontent1', $hotboxcontentarray[0]);
        $this->bucket->set_data('hotboxcontent2', $hotboxcontentarray[1]);
        $this->bucket->set_data('hotboxcontent3', $hotboxcontentarray[2]);
        $this->bucket->set_data('hotboxcontent4', $hotboxcontentarray[3]);

        $this->bucket->set_data('hotboximg1', $hotboximgarray[0]);
        $this->bucket->set_data('hotboximg2', $hotboximgarray[1]);
        $this->bucket->set_data('hotboximg3', $hotboximgarray[2]);
        $this->bucket->set_data('hotboximg4', $hotboximgarray[3]);

        $this->bucket->set_data('hotboxtitle1', $hotboxtitlearray[0]);
        $this->bucket->set_data('hotboxtitle2', $hotboxtitlearray[1]);
        $this->bucket->set_data('hotboxtitle3', $hotboxtitlearray[2]);
        $this->bucket->set_data('hotboxtitle4', $hotboxtitlearray[3]);

	$poll = $this->load_poll();
//	$cookie = (($_COOKIE['the_poll_cookie'] != '') ? $_COOKIE['the_poll_cookie'] : 'false');

	$this->bucket->set_data('pollcookie', $cookie);
	$this->bucket->set_data('poll', $poll);

	$sql = "";

        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
    }

    function load_poll() {
	  
	$country_id = $this->config->item('country_id');
	  
	$sql="SELECT po.poll_option_id, po.poll_id, po.option, po.votes, p.question, po2.TotalVotes
	FROM poll_options po
	INNER JOIN poll p
	ON p.id = po.poll_id
	INNER JOIN (
	  SELECT SUM(po2.votes) AS TotalVotes, po2.poll_id
	  FROM poll_options po2
	  INNER JOIN poll p
	  ON p.id = po2.poll_id
	  WHERE p.country_id = $country_id
	  GROUP BY po2.poll_id) po2
	  ON po2.poll_id = po.poll_id
	WHERE p.country_id = $country_id
	AND p.isdefault = 1";
	
	$poll = R::getAll($sql);
	
	return $poll;
    }

	function load_poll_ajax() {

        $country_id = $this->config->item('country_id');

        $sql="SELECT po.poll_option_id, po.poll_id, po.option, po.votes, p.question, po2.TotalVotes
        FROM poll_options po
        INNER JOIN poll p
        ON p.id = po.poll_id
        INNER JOIN (
          SELECT SUM(po2.votes) AS TotalVotes, po2.poll_id
          FROM poll_options po2
          INNER JOIN poll p
          ON p.id = po2.poll_id
          WHERE p.country_id = $country_id
          GROUP BY po2.poll_id) po2
          ON po2.poll_id = po.poll_id
        WHERE p.country_id = $country_id
	AND p.isdefault = 1";

        $poll = R::getAll($sql);

        echo json_encode($poll);
    }

    function submit_vote() {
	  
	$option_id = $this->input->post('option_id');
	
	$sql="UPDATE poll_options 
			SET votes = votes + 1 
			WHERE poll_option_id = $option_id";
	
	R::exec($sql);

	$sql = "SELECT poll_id FROM poll_options WHERE poll_option_id = $option_id";

	$poll_id = R::getRow($sql);

	setcookie('the_poll_cookie', $poll_id['poll_id'],time() + (86400 * 30), '/', '.xhiber-dynamic.com');
	return true;
    }

    function load_hotbox(&$hotboxcontentarray, &$hotboximgarray, &$hotboxtitlearray) {

        $sql = "SELECT id, title, summary, image_filepath, url, status
			FROM hotbox
			WHERE status = 1
                        AND country_id = ".$this->config->item('country_id')."
			ORDER BY modified_date, created_date
			LIMIT 0,4";

        $hotbox = R::getAll($sql);

        $contentstring = "";
        $imagestring = "";
        $counter = 1;

        foreach ($hotbox as $entry) {
            $imagestring = "";
            $contentstring = "";

            $hotboxentry['title'] = $this->_trimHotboxTitle($entry['title']);
            $hotboxentry['image_filepath'] = $entry['image_filepath'];
            $hotboxentry['summary'] = $this->_trimHotbox($entry['summary']);
            $hotboxentry['url'] = $entry['url'];
            $hotboxentry['status'] = $entry['status'];

            $countertext = ($counter == 1) ? "" : (string) $counter;
            $hidelems = ($counter == 1) ? "" : "class=\"hideElems\"";

            $imagestring .= "<div id=\"featured_img$countertext\" $hidelems><img src=\"" . base_url() . "/" . $hotboxentry['image_filepath'] . "\" width=\"203\" height=\"179\" border=\"0\" /></div>";

            $contentstring .= "<div id=\"featured_art$countertext\">";
            $contentstring .= "<p class=\"feature_art\"> <span class=\"featured_winner\">" . $hotboxentry['title'] . "</span><br />";
            $contentstring .= "<span class=\"body_art\">" . $hotboxentry['summary'] . "</span><br /><br />";
            $contentstring .= "<a class=\"blue\" href=\"" . $hotboxentry['url'] . "\">READ MORE</a></p>";
            $contentstring .= "</div>";

            array_push($hotboxcontentarray, $contentstring);
            array_push($hotboximgarray, $imagestring);
            array_push($hotboxtitlearray, $hotboxentry['title']);

            $counter++;
        }
    }

    function mostpop_articles() {
        echo '{"articles": [{' . $this->_mostpop_articles() . '}]}';
    }

    private function _mostpop_articles() {

        $sql = "SELECT a.title as article_title, a.summary as article_summary,
			a.image_filepath as article_image, a.id, a.seo_url as seo_url, 
			b.name as age_group_name
        FROM article AS a
        INNER JOIN age_group as b ON a.age_group_id = b.id
        WHERE a.status = 1";

        if ($this->session->userdata('country_id')) {
            $sql.=" AND a.id IN (SELECT article_id FROM article_country 
							WHERE country_id=" . $this->session->userdata('country_id') . ")";
        }
        $sql.=" ORDER BY a.publish_date DESC LIMIT 4";

        $articles = R::getAll($sql);

        foreach ($articles as &$article) {
            $article['article_link'] = $article['seo_url'];
            $article['article_title'] = $this->_trimTitle($article['article_title']);
            $article['article_summary'] = $this->_trimArticles($article['article_summary']);
            $article['age_group_name_link'] = url_title($article['age_group_name'], 'dash', TRUE);
            $article['age_group_name_link'] = str_replace("-", "", $article['age_group_name_link']);
        }

        return '"article":' . json_encode($articles);
    }

    function mostpop_week() {
        echo '{"articles": [{' . $this->_mostpop_week() . '}]}';
    }

    private function _mostpop_week() {

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
			ORDER BY ac.total_views DESC LIMIT 4";
        } else {
            $sql = "SELECT a.title as article_title, a.summary as article_summary
			, a.image_filepath as article_image, a.seo_url as seo_url,a.id
			, b.name as age_group_name
			FROM article AS a
			INNER JOIN age_group as b ON a.age_group_id = b.id
			WHERE a.status = 1
			AND a.last_viewed_week = YEARWEEK(NOW()) 
			ORDER BY total_views DESC LIMIT 4";
        }
        $articles = R::getAll($sql);

        foreach ($articles as &$article) {
            $article['article_title'] = $this->_trimTitle($article['article_title']);
            $article['article_link'] = $article['seo_url'];
            $article['article_summary'] = $this->_trimArticles($article['article_summary']);
            $article['age_group_name_link'] = url_title($article['age_group_name'], 'dash', TRUE);
            $article['age_group_name_link'] = str_replace("-", "", $article['age_group_name_link']);
        }

        return '"article":' . json_encode($articles);
    }

    function mostpop_month() {
        echo '{"articles": [{' . $this->_mostpop_month() . '}]}';
    }

    private function _mostpop_month() {

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
			ORDER BY ac.last_viewed_week DESC, ac.total_views DESC LIMIT 4";
        } else {
            $sql = "SELECT a.title as article_title, a.summary as article_summary, a.image_filepath as article_image, a.id, a.seo_url as seo_url,b.name as age_group_name
				FROM article AS a
				INNER JOIN age_group as b ON a.age_group_id = b.id
				WHERE a.status = 1
				AND MONTH(a.last_viewed) = MONTH(NOW())
				AND YEAR(a.last_viewed) = YEAR(NOW())
				ORDER BY last_viewed_week DESC, total_views DESC LIMIT 4";
        }
        $articles = R::getAll($sql);

        foreach ($articles as &$article) {
            $article['article_title'] = $this->_trimTitle($article['article_title']);
            $article['article_link'] = $article['seo_url'];
            $article['article_summary'] = $this->_trimArticles($article['article_summary']);
            $article['age_group_name_link'] = url_title($article['age_group_name'], 'dash', TRUE);
            $article['age_group_name_link'] = str_replace("-", "", $article['age_group_name_link']);
        }

        return '"article":' . json_encode($articles);
    }

    function mostpop_all() {
        echo '{"articles": [{' . $this->_mostpop_all() . '}]}';
    }

    private function _mostpop_all() {

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
			ORDER BY ac.total_views DESC
			LIMIT 4";
        } else {
            $sql = "SELECT a.title as article_title, a.summary as article_summary
				,a.image_filepath as article_image, a.id, a.seo_url as seo_url
				, b.name as age_group_name
			FROM article AS a
			INNER JOIN age_group as b ON a.age_group_id = b.id
			WHERE a.status = 1
			ORDER BY total_views DESC
			LIMIT 4";
        }
        $articles = R::getAll($sql);

        foreach ($articles as &$article) {
            $article['article_title'] = $this->_trimTitle($article['article_title']);
            $article['article_link'] = $article['seo_url'];
            $article['article_summary'] = $this->_trimArticles($article['article_summary']);
            $article['age_group_name_link'] = url_title($article['age_group_name'], 'dash', TRUE);
            $article['age_group_name_link'] = str_replace("-", "", $article['age_group_name_link']);
        }

        return '"article":' . json_encode($articles);
    }

    function latest_articles() {
        echo '{"articles": [{' . $this->_latest_articles() . '}]}';
    }

    private function _latest_articles() {

        $sql = "SELECT a.title as article_title, a.summary as article_summary, a.image_filepath as article_image, a.id, a.seo_url as seo_url, b.name as age_group_name
    FROM article AS a
    INNER JOIN age_group as b ON a.age_group_id = b.id
    INNER JOIN article_country as c ON c.article_id = a.id
    WHERE a.status = 1
    AND c.country_id = ".$this->config->item('country_id')."
    ORDER BY a.publish_date DESC
    LIMIT 4";

        $articles = R::getAll($sql);

        foreach ($articles as &$article) {
            $article['article_link'] = $article['seo_url'];
            $article['article_summary'] = $this->_trimArticles($article['article_summary']);
            $article['age_group_name_link'] = url_title($article['age_group_name'], 'dash', TRUE);
        }

        return '"article":' . json_encode($articles);
    }

    function latest_pow() {
        echo '{"entries": [{' . $this->_latest_pow() . '}]}';
    }

    private function _latest_pow() {

        $sql = "SELECT 
  a.token_id
, a.photo_filename
, b.pow_contest_id
, c.country_id
FROM pow_entry as a
INNER JOIN pow_contest_category as b ON b.id = a.pow_category_id
INNER JOIN pow_contest_country as c ON c.contest_id = b.pow_contest_id
WHERE c.country_id = ".$this->config->item('country_id')."
AND a.status = 1
ORDER BY a.created_date DESC
LIMIT 6
";

        $entries = R::getAll($sql);

        return '"entry":' . json_encode($entries);
    }

    function latest_upcoming_events_programs() {
        echo '{"events_programs": [{' . $this->_latest_upcoming_events_programs() . '}]}';
    }

    private function _latest_upcoming_events_programs() {

        $sql = "SELECT * FROM
     (
	SELECT 'events' as type, a.id, a.provider_id, a.title, a.summary, DATE_FORMAT(a.start_date, '%D %b') as display_date, a.start_date as sort_date, a.seo_url
            FROM provider_event as a
            INNER JOIN provider_country as b
            ON b.provider_id = a.provider_id
            WHERE a.status = 1
            AND b.country_id = ".$this->config->item('country_id')."
	AND a.start_date > NOW()

	UNION

	SELECT 'programs' as type, c.id, c.provider_id, c.title, c.summary, DATE_FORMAT(c.publish_date, '%D %b') as display_date, c.publish_date as sort_date, c.seo_url
            FROM provider_program as c
            INNER JOIN provider_country as d
            ON d.provider_id = c.provider_id
            WHERE c.status = 1
            AND d.country_id = ".$this->config->item('country_id')."
	AND c.publish_date > NOW()
    ) AS t
    ORDER BY sort_date ASC
    LIMIT 5";

        $events = R::getAll($sql);
        
        foreach ($events as &$entry) {
            $entry['summary'] = $this->_trimEveProBody($entry['summary']);
            $entry['title'] = $this->_trimEveProTitle($entry['title']);
        }

        return '"event_program":' . json_encode($events);
    }

    private function _trimArticles($article_summary) {
        $trimmed_summary = strlen($article_summary) > 73 ? substr($article_summary, 0, 70) . "..." : $article_summary;
        return $trimmed_summary;
    }

    private function _trimTitle($article_title) {
        $trimmed_title = strlen($article_title) > 43 ? substr($article_title, 0, 40) . "..." : $article_title;
        return $trimmed_title;
    }

    private function _trimReview($article_title) {
        $trimmed_title = strlen($article_title) > 95 ? substr($article_title, 0, 92) . "..." : $article_title;
        return $trimmed_title;
    }
    
    private function _trimReviewTitle($article_title) {
        $trimmed_title = strlen($article_title) > 56 ? substr($article_title, 0, 53) . "..." : $article_title;
        return $trimmed_title;
    }

    private function _trimForumBody($forum_body) {
        $trimmed_title = strlen($forum_body) > 12 ? substr($forum_body, 0, 12) . "..." : $forum_body;
        return $trimmed_title;
    }

    private function _trimForumTitle($forum_title) {
        $trimmed_title = strlen($forum_title) > 15 ? substr($forum_title, 0, 15) . "..." : $forum_title;
        return $trimmed_title;
    }
    
    private function _trimHotbox($forum_title) {
        $trimmed_title = strlen($forum_title) > 154 ? substr($forum_title, 0, 151) . "..." : $forum_title;
        return $trimmed_title;
    }

    private function _trimHotboxTitle($forum_title) {
        $trimmed_title = strlen($forum_title) > 26 ? substr($forum_title, 0, 23) . "..." : $forum_title;
        return $trimmed_title;
    }
    
    private function _trimEveProTitle($forum_title) {
        $trimmed_title = strlen($forum_title) > 58 ? substr($forum_title, 0, 55) . "..." : $forum_title;
        return $trimmed_title;
    }
    
    private function _trimEveProBody($forum_title) {
        $trimmed_title = strlen($forum_title) > 73 ? substr($forum_title, 0, 70) . "..." : $forum_title;
        return $trimmed_title;
    }

    function members() {
        echo '{"members": [{' . $this->_members() . '}]}';
    }

    private function _members() {

        $sql = "SELECT id, avatar_filepath
    FROM user
    WHERE avatar_filepath != 'avatar_woman.jpg'
    AND avatar_filepath != 'avatar_man.jpg' 
    AND avatar_filepath != 'reg-profile.jpg'
    AND avatar_filepath != ''
    ORDER BY created_date DESC
    LIMIT 12";

        $entries = R::getAll($sql);

        return '"member":' . json_encode($entries);
    }

    function events_programs_time($date1, $date2) {
        echo '{"events_programs": [{' . $this->_events_programs_time($date1, $date2) . '}]}';
    }

    private function _events_programs_time($date1, $date2) {

        $sql = "SELECT * 
     FROM ( 
	SELECT 'events' as type, a.id, a.provider_id, a.title, a.summary, DATE_FORMAT(a.start_date, '%D %b') as display_date, a.start_date as sort_date, a.seo_url
            FROM provider_event as a
            INNER JOIN provider_country as b
            ON b.provider_id = a.provider_id
            WHERE a.status = 1
            AND b.country_id = ".$this->config->item('country_id')."
	AND (a.start_date BETWEEN '" . $date1 . "' AND '" . $date2 . "' 
	OR a.end_date BETWEEN '" . $date1 . "' AND '" . $date2 . "')    	
	
	UNION 

	SELECT 'programs' as type, c.id, c.provider_id, c.title, c.summary, DATE_FORMAT(c.publish_date, '%D %b') as display_date, c.publish_date as sort_date, c.seo_url
            FROM provider_program as c
            INNER JOIN provider_country as d
            ON d.provider_id = c.provider_id
            WHERE c.status = 1
            AND d.country_id = ".$this->config->item('country_id')."
	AND c.publish_date BETWEEN '" . $date1 . "' AND '" . $date2 . "' 
    ) AS t 
    ORDER BY sort_date DESC
    LIMIT 5";

        $entries = R::getAll($sql);
        
        foreach ($entries as &$entry) {
            $entry['summary'] = $this->_trimEveProBody($entry['summary']);
            $entry['title'] = $this->_trimEveProTitle($entry['title']);
        }

        return '"event_program":' . json_encode($entries);
    }

    function upcoming_events() {
        echo '{"events_programs": [{' . $this->_upcoming_events() . '}]}';
    }

    private function _upcoming_events() {

        $sql = "SELECT 'events' as type,a.id, a.provider_id, a.title, a.summary, DATE_FORMAT(a.start_date, '%D %b') as display_date, a.start_date as sort_date, a.seo_url
            FROM provider_event as a
            INNER JOIN provider_country as b
            ON b.provider_id = a.provider_id
            WHERE a.status = 1
            AND b.country_id = ".$this->config->item('country_id')."
	AND a.start_date > NOW()
	ORDER BY sort_date ASC
	LIMIT 5";

        $entries = R::getAll($sql);
        
        foreach ($entries as &$entry) {
            $entry['summary'] = $this->_trimEveProBody($entry['summary']);
            $entry['title'] = $this->_trimEveProTitle($entry['title']);
        }

        return '"event_program":' . json_encode($entries);
    }

    function upcoming_programs() {
        echo '{"events_programs": [{' . $this->_upcoming_programs() . '}]}';
    }

    private function _upcoming_programs() {

        $sql = "SELECT 'programs' as type, c.id, c.provider_id, c.title, c.summary, DATE_FORMAT(c.publish_date, '%D %b') as display_date, c.publish_date as sort_date, c.seo_url
            FROM provider_program as c
            INNER JOIN provider_country as d
            ON d.provider_id = c.provider_id
            WHERE c.status = 1
            AND d.country_id = ".$this->config->item('country_id')."
	AND publish_date > NOW()
	ORDER BY publish_date ASC
	LIMIT 5";

        $entries = R::getAll($sql);
        
        foreach ($entries as &$entry) {
            $entry['summary'] = $this->_trimEveProBody($entry['summary']);
            $entry['title'] = $this->_trimEveProTitle($entry['title']);
        }

        return '"event_program":' . json_encode($entries);
    }

    function events_programs_date($date) {
        echo '{"events_programs": [{' . $this->_events_programs_date($date) . '}]}';
    }

    private function _events_programs_date($date) {

        $sql = "SELECT * 
         FROM ( 
            SELECT 'events' as type, a.id, a.provider_id, a.title, a.summary, DATE_FORMAT(a.start_date, '%D %b') as display_date, a.start_date as sort_date, a.seo_url
            FROM provider_event as a
            INNER JOIN provider_country as b
            ON b.provider_id = a.provider_id
            WHERE a.status = 1
            AND b.country_id = ".$this->config->item('country_id')."
            AND (a.start_date = '" . $date . "' 
            OR a.end_date = '" . $date . "')    	

            UNION 

            SELECT 'programs' as type, c.id, c.provider_id, c.title, c.summary, DATE_FORMAT(c.publish_date, '%D %b') as display_date, c.publish_date as sort_date, c.seo_url
            FROM provider_program as c
            INNER JOIN provider_country as d
            ON d.provider_id = c.provider_id
            WHERE c.status = 1
            AND d.country_id = ".$this->config->item('country_id')."
            AND c.publish_date = '" . $date . "'
        ) AS t 
        ORDER BY sort_date DESC
        LIMIT 5";

        $entries = R::getAll($sql);
        
        foreach ($entries as &$entry) {
            $entry['summary'] = $this->_trimEveProBody($entry['summary']);
            $entry['title'] = $this->_trimEveProTitle($entry['title']);
        }

        return '"event_program":' . json_encode($entries);

    }

    function latest_reviews() {
        echo '{"reviews": [{' . $this->_latest_reviews() . '}]}';
    }

    private function _latest_reviews() {

        $sql = "SELECT a.title as review_title, a.summary as review_summary,
	  a.image_filepath as review_image, a.id, a.seo_url, b.name as age_group_name
	FROM provider_review AS a
	INNER JOIN age_group as b ON a.age_group_id = b.id
	INNER JOIN provider_country as c ON a.provider_id = c.provider_id
	WHERE a.status = 1
        AND c.country_id = ".$this->config->item('country_id')."
    ORDER BY a.last_viewed_week DESC, a.total_views DESC
    LIMIT 4";

        $entries = R::getAll($sql);

        foreach ($entries as &$entry) {
            $entry['review_summary'] = $this->_trimReview($entry['review_summary']);
            $entry['review_title'] = $this->_trimReviewTitle($entry['review_title']);
        }

        return '"review":' . json_encode($entries);
    }

    function reviews_week() {
        echo '{"reviews": [{' . $this->_reviews_week() . '}]}';
    }

    private function _reviews_week() {

        $sql = "SELECT a.title as review_title, a.summary as review_summary, 
	  	  a.image_filepath as review_image, a.id, a.seo_url, b.name as age_group_name
		FROM provider_review AS a
    	INNER JOIN age_group as b ON a.age_group_id = b.id
    	WHERE a.status = 1
    	AND a.last_viewed_week = YEARWEEK(NOW())
    	ORDER BY total_views DESC
    	LIMIT 4";

        $entries = R::getAll($sql);

        foreach ($entries as &$entry) {
            $entry['review_summary'] = $this->_trimReview($entry['review_summary']);
        }

        return '"review":' . json_encode($entries);
    }

    function pow_winners_current() {
        echo '{"winners": [{' . $this->_pow_winners_current() . '}]}';
    }

    private function _pow_winners_current() {

//        $sql = "SELECT
//          pr.pow_contest_id
//        , pr.total_vote
//        , pr.concluded_date
//        , pc.name AS contest_name
//        , pc.description AS contest_description
//        , pc.age_group_id
//        , a.name AS age_group_name
//        , pr.pow_entry_id
//        , pe.name AS entry_name
//        , pe.photo_filepath AS entry_photo_filepath
//        , pe.image_type AS entry_photo_imagetype
//        FROM pow_result AS pr
//        INNER JOIN pow_contest pc
//        ON pc.id = pr.pow_contest_id
//        INNER JOIN pow_entry AS pe
//        ON pe.id = pr.pow_entry_id 
//        INNER JOIN age_group AS a
//        ON a.id = pc.age_group_id
//        WHERE YEARWEEK(pc.voting_start_date) = YEARWEEK(NOW()) 
//        LIMIT 5;";
	$sql= "SELECT 
          a.name as category_name
        , a.id as category_id
        , b.name as contest_name
        , b.id as contest_id
        , b.status as contest_id
        , b.modified_date as contest_modified_date
        , c.email_address
        , c.first_name
        , c.last_name
        , d.id as entry_id
        , d.*
        , e.*
        , f.country_id
        FROM pow_result as e
        LEFT JOIN pow_entry as d ON d.id = e.pow_entry_id
        LEFT JOIN pow_contest as b ON b.id  = e.pow_contest_id
        LEFT JOIN pow_contest_category as a ON a.id = d.pow_category_id
        LEFT JOIN user as c ON c.id = d.user_id
        LEFT JOIN pow_contest_country as f ON f.contest_id = e.pow_contest_id 
        WHERE f.country_id = ".$this->config->item('country_id')."
        ORDER BY e.concluded_date DESC
        LIMIT 2, 6    
        ";

        $entries = R::getAll($sql);

//    foreach ($entries as &$entry) {
//        $entry['review_summary'] = $this->_trimReview($entry['review_summary']);
//    }

        return '"winner":' . json_encode($entries);
    }

    function pow_winners_last() {
        echo '{"winners": [{' . $this->_pow_winners_last() . '}]}';
    }

    private function _pow_winners_last() {

        $sql = "SELECT
          pr.pow_contest_id
        , pr.total_vote
        , pr.concluded_date
        , pc.name AS contest_name
        , pc.description AS contest_description
        , pc.age_group_id
        , a.name AS age_group_name
        , pr.pow_entry_id
        , pe.name AS entry_name
        , pe.photo_filepath AS entry_photo_filepath
        , pe.image_type AS entry_photo_imagetype
        FROM pow_result AS pr
        INNER JOIN pow_contest pc
        ON pc.id = pr.pow_contest_id
        INNER JOIN pow_entry AS pe
        ON pe.id = pr.pow_entry_id 
        INNER JOIN age_group AS a
        ON a.id = pc.age_group_id
        WHERE YEARWEEK(pc.voting_start_date) = YEARWEEK(DATE_ADD(NOW(), INTERVAL -1 WEEK))  
        LIMIT 5;";

        $entries = R::getAll($sql);

//    foreach ($entries as &$entry) {
//        $entry['review_summary'] = $this->_trimReview($entry['review_summary']);
//    }

        return '"winner":' . json_encode($entries);
    }

    function pow_winners_all() {
        echo '{"winners": [{' . $this->_pow_winners_all() . '}]}';
    }

    private function _pow_winners_all() {

        $sql = "SELECT
          pr.pow_contest_id
        , pr.total_vote
        , pr.concluded_date
        , pc.name AS contest_name
        , pc.description AS contest_description
        , pc.age_group_id
        , a.name AS age_group_name
        , pr.pow_entry_id
        , pe.name AS entry_name
        , pe.photo_filepath AS entry_photo_filepath
        , pe.image_type AS entry_photo_imagetype
        FROM pow_result AS pr
        INNER JOIN pow_contest pc
        ON pc.id = pr.pow_contest_id
        INNER JOIN pow_entry AS pe
        ON pe.id = pr.pow_entry_id 
        INNER JOIN age_group AS a
        ON a.id = pc.age_group_id
        WHERE pc.status = 4
        ORDER BY pc.voting_start_date DESC  
        LIMIT 5;";

        $entries = R::getAll($sql);

//    foreach ($entries as &$entry) {
//        $entry['review_summary'] = $this->_trimReview($entry['review_summary']);
//    }

        return '"winner":' . json_encode($entries);
    }

    function forum_list() {
        echo '{"forum_list": [{' . $this->_forum_list() . '}]}';
    }

    private function _forum_list() {
        $smfdbname = "mumcentre_forum_sg";
        $sql = "SELECT msg.id_msg, msg.id_topic, msg.id_board, msg.subject, msg.poster_name, msg.body, DATE_FORMAT(FROM_UNIXTIME(msg.poster_time), '%e-%d-%y %r') as time_posted, a.num_replies, a.num_views
	FROM $smfdbname.smf_messages msg
        INNER JOIN $smfdbname.smf_topics AS a
        ON msg.id_topic = a.id_topic
        ORDER by msg.poster_time DESC
        LIMIT 12;";

        $entries = R::getAll($sql);

        foreach ($entries as &$entry) {
            $entry['subject'] = $this->_trimForumTitle($entry['subject']);
            $entry['body'] = $this->_trimForumBody($entry['body']);
        }

        return '"forum":' . json_encode($entries);
    }

    function board_list() {
        echo '{"board_list": [{' . $this->_board_list() . '}]}';
    }

    private function _board_list() {
        $smfdbname = "mumcentre_forum";
        $sql = "SELECT msg.id_board, msg.name
	FROM $smfdbname.smf_boards msg
        ORDER by msg.id_board";

        $entries = R::getAll($sql);

        return '"board":' . json_encode($entries);
    }

    function latest_pow_winner() {
        echo '{"latest": [{' . $this->_latest_pow_winner() . '}]}';
    }

    private function _latest_pow_winner() {

        $sql = "SELECT a.name as category_name
, a.id as category_id
, b.name as contest_name
, b.id as contest_id
, b.status as contest_id
, b.modified_date as contest_modified_date
, c.email_address
, c.first_name
, c.last_name
, d.id as entry_id
, d.*
, e.*
, f.country_id
FROM pow_result as e
LEFT JOIN pow_entry as d ON d.id = e.pow_entry_id
LEFT JOIN pow_contest as b ON b.id  = e.pow_contest_id
LEFT JOIN pow_contest_category as a ON a.id = d.pow_category_id
LEFT JOIN user as c ON c.id = d.user_id
LEFT JOIN pow_contest_country as f ON f.contest_id = e.pow_contest_id 
WHERE f.country_id = 3
ORDER BY e.concluded_date DESC
LIMIT 1";

        $entries = R::getAll($sql);

        return '"winner":' . json_encode($entries);
    }
    
    private function _generateTags($zoneId) {
        $count = 1;
        $invocation_code = $this->mcox->get_zone_invocation_code($zoneId, "adjs", "3rdPartyServers:ox3rdPartyServers:max");
        $invocation_code = preg_replace("/\[removed\]/", "<script type='text/javascript'>", $invocation_code, $count);
        $invocation_code = str_replace("escape([removed])", "escape(window.location)", $invocation_code);
        $invocation_code = str_replace("[removed]<noscript>", "</script><noscript>", $invocation_code);
        $invocation_code = str_replace("[removed]", "document.write", $invocation_code);
        $invocation_code = str_replace("INSERT_RANDOM_NUMBER_HERE", rand(0, 99999999999), $invocation_code);
        $invocation_code = html_entity_decode($invocation_code);
                
        return $invocation_code;        
    }

}

?>
