<?php
class Mm extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
		$this->load->library('smfpost');
    }
    
    function index(){
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('mumcentre/fb_test');
        $this->bucket->add_css('mums');
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
    }
	
	function getMMData() {
		$submenu = $this->input->post('submenu');
		$menu_group = $this->input->post('menugroup');
		
		//$start_date = isset($this->input->post('start_date'))?$this->input->post('menugroup'):"now()";
		//$end_date = isset($this->input->post('end_date'))?$this->input->post('menugroup'):"now()";
		
		$smfdbname = "mumcentre_forum";
		
		/*$menu_group = "1";
		$submenu = "pow";*/
		$arrReturn = array();
		
		switch ($submenu) {
			case "home":
				$sql = "SELECT a.id, provider_id, title, summary, author, created_date, image_filepath, status, ag.name as age_group_name, a.seo_url
					FROM article a
					INNER JOIN age_group ag
					ON ag.id = a.age_group_id
					WHERE age_group_id = $menu_group
					AND type = 1
					AND status = 1
					ORDER BY created_date DESC
					LIMIT 0,2";
				
				$arrReturn["ab"] = R::getAll($sql);
				
				$sql = "SELECT id, name, details, logo_filepath, image_filepath, status, created_date, seo_summary
					FROM provider_profile p
					WHERE age_group_id = $menu_group
					ORDER BY created_date DESC
					LIMIT 0,2";
				
				$arrReturn["ps"] = R::getAll($sql);
				
				$sql = "SELECT id, provider_id, title, image_filepath, summary, created_date, status
					FROM provider_event p
					WHERE age_group_id = $menu_group
					ORDER BY created_date DESC
					LIMIT 0,2";
				
				$arrReturn["ep"] = R::getAll($sql);
				
				echo json_encode($arrReturn);
				break;
			case "forum":
				
				$sql = "SELECT msg.id_msg, msg.id_topic, msg.id_board,
					DATE_FORMAT(FROM_UNIXTIME(msg.poster_time), '%m.%d.%Y %H:%i:%s') AS poster_date, msg.subject, msg.poster_name
					FROM $smfdbname.smf_messages msg
					WHERE msg.id_board = $menu_group
					LIMIT 0,4";
				
				$arrReturn["topics"] = R::getAll($sql);
				echo json_encode($arrReturn);
				break;
			case "pow":
				$sql = "SELECT id, pow_contest_id, pow_category_id, token_id, name, caption, photo_filepath, image_type
					FROM pow_entry
					WHERE pow_category_id = $menu_group
					ORDER BY created_date DESC
					LIMIT 0,6";
				
				$arrReturn["ent"] = R::getAll($sql);
				
				$sql = "SELECT
					  pr.pow_contest_id
					, pr.total_vote
					, pc.end_date
					, pc.name AS contest_name
					, pc.description AS contest_description
					, pr.pow_category_id
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
					ON a.id = pr.pow_category_id
					WHERE pc.status = 4 
					AND pr.pow_category_id = $menu_group;
					ORDER BY pc.start_date DESC
					LIMIT 8;";
				
				$arrReturn["arc"] = R::getAll($sql);
				
				$sql = "SELECT
						  pr.pow_contest_id
						, pr.total_vote
						, pc.end_date
						, pc.name AS contest_name
						, pc.description AS contest_description
						, pr.pow_category_id
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
						ON a.id = pr.pow_category_id
						WHERE YEARWEEK(pc.start_date) = YEARWEEK(NOW())
						AND pr.pow_category_id = $menu_group;
						LIMIT 1";
				
				$arrReturn["cw"] = R::getAll($sql);
				
				echo json_encode($arrReturn);
				break;
			case "ps":
				$sql = "SELECT id, name, image_filepath, age_group_id, created_date, status, details
					FROM provider_profile
					WHERE status = 1
					ORDER BY created_date DESC
					LIMIT 0,3";
				
				$arrReturn["ps"] = R::getAll($sql);
				
				$sql = "SELECT count(*) as review_count, pr.provider_id, p.name, p.details, p.image_filepath, p.created_date, p.status
					FROM provider_review pr
					inner join provider_profile p
					on p.id = pr.provider_id
					WHERE pr.age_group_id = $menu_group
					GROUP BY provider_id
					ORDER BY review_count DESC
					LIMIT 0,2";
				
				$arrReturn["mp"] = R::getAll($sql);
				
				echo json_encode($arrReturn);
				break;
			case "art":
				$sql = "SELECT a.id, provider_id, title, summary, author, created_date, image_filepath, status, ag.name as age_group_name, a.seo_url
                                        FROM article a
                                        INNER JOIN age_group ag
                                        ON ag.id = a.age_group_id
                                        WHERE age_group_id = $menu_group
										AND type = 1
										AND status = 1
                                        ORDER BY created_date DESC
                                        LIMIT 0,2";
				
				$arrReturn["art"] = R::getAll($sql);
				
				$sql = "SELECT a.id, provider_id, title, summary, author, created_date, image_filepath, status, ag.name as age_group_name, a.seo_url
                                        FROM article a
                                        INNER JOIN age_group ag
                                        ON ag.id = a.age_group_id
                                        WHERE age_group_id = $menu_group
										AND type = 2
										AND status = 1
                                        ORDER BY created_date DESC
                                        LIMIT 0,2";
				
				$arrReturn["pb"] = R::getAll($sql);
				
				echo json_encode($arrReturn);
				break;
			case "event":
				$sql = "SELECT start_date, end_date, title
					FROM provider_event
					WHERE start_date >= now()
					AND age_group_id = 1
					ORDER BY start_date ASC
					LIMIT 0,4";
				
				$arrReturn["event"] = R::getAll($sql);
				
				$sql = "SELECT start_date, end_date, image_filepath, summary, title 
					FROM provider_event
					WHERE start_date >= now()
					AND age_group_id = $menu_group
					ORDER BY RAND() LIMIT 0,2;";
				
				$arrReturn["rnd"] = R::getAll($sql);
				
				echo json_encode($arrReturn);
				break;
			default:
			break;
		}
	}
	
	function getMMEventSearch() {
		$menu_group = $this->input->post('menugroup');	
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		
		$sql = "SELECT start_date, end_date, title
			FROM provider_event
			WHERE start_date <= '$end_date'
			AND end_date >= '$start_date'
			AND age_group_id = $menu_group
			ORDER BY start_date ASC
			LIMIT 0,4";
		
		$arrReturn["event"] = R::getAll($sql);
	
		echo json_encode($arrReturn);
	}
	
	function createThreadMM() {
		$subject = $this->input->post('subject');
		$content = $this->input->post('content');
		
		$poster_email = $this->session->userdata("email_address");
		$poster_id = $this->session->userdata("smf_id");
		$board_id = $this->input->post('agegroupid');
		$msg_id = 0;
		$topic_id = 0;
		$poster_name = $this->session->userdata("name");
		
		$returnid = $this->smfpost->create_post($subject, $content, $poster_email, $poster_id, $board_id, 0, NULL, $poster_name);
		
		return $returnid;
	}
}
?>
