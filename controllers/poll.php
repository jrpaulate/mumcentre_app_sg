<?php

class Poll extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
        $this->load->library('mcox');
        $this->meta_description = $this->config->item('description');
    }
    
    function index($pollid = 0){

        $base = base_url();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop_fb');
        $this->bucket->set_content_id('mumcentre/pollresults');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('RC3');
        
        $this->bucket->set_data('description', $this->meta_description);
        $this->bucket->set_data('title', 'Mumcentre - Poll Results');
        $this->bucket->set_data('forum_group', 6);
        $this->bucket->set_data('og_image', '');
        $this->bucket->set_data('og_title', 'Mumcentre - Baby articles');
        $this->bucket->set_data('og_type', 'article');
        $this->bucket->set_data('og_url', $base."poll");

	$poll = $this->load_poll($pollid);
	$pollentries = $this->load_poll_list();
        $this->bucket->set_data('poll', $poll);
	$this->bucket->set_data('selectedpollid', $pollid);
	$this->bucket->set_data('pollentries', $pollentries);
        
        $this->bucket->render_layout();
    } 

function load_poll_list() {
	$country_id = $this->config->item('country_id');

	$sql = "SELECT * FROM poll WHERE country_id = $country_id";

	$poll = R::getAll($sql);

        return $poll;
	}

function load_poll($pollid) {
	$country_id = $this->config->item('country_id');

	if ($pollid == 0) {

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
	
	} else {

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
        AND p.id = $pollid";
	}

        $poll = R::getAll($sql);

        return $poll;
    }
}
?>
