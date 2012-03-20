<?php
require_once('/var/www/mumcentre_sg/forum/smf_2_api.php');

class Mm extends CI_Controller {
    function __construct() {
	
	parent::__construct();
        $this->load->library('media');
        $this->load->library('rb');
        $this->load->library('session');
        $this->load->library('mcapi');
        $this->load->library('common');
        $this->load->library('mcox');
        $this->load->helper('miscfuncs');
        $this->load->helper('url');
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
		
		$country_id = $this->config->item('country_id');
                switch ($country_id) {
                        case 3:
                                $smfdbname = 'mumcentre_forum_sg';
                                break;
                        case 4:
                                $smfdbname = 'mumcentre_forum_ph';
                                break;
                        case 5:
                                $smfdbname = 'mumcentre_forum_my';
                                break;
                        case 7:
                                $smfdbname = 'mumcentre_forum_au';
                                break;
                        default:
                                $country_id = 4;
                                $smfdbname = 'mumcentre_forum';
                }
		
		$arrReturn = array();
		
		switch ($submenu) {
			case "home":
				$sql = "SELECT a.id, provider_id, title, summary, author, a.created_date, image_filepath, status, ag.name as age_group_name, a.seo_url, aag.age_group_id as alt_age_group
					FROM article a
					INNER JOIN age_group ag
					ON ag.id = a.age_group_id
					INNER JOIN article_country ac
					ON ac.article_id = a.id
					LEFT OUTER JOIN article_age_group aag
					ON a.id = aag.article_id
					WHERE (a.age_group_id = $menu_group AND aag.age_group_id = $menu_group)
					AND (type = 1 OR type = 2 OR type = 3)
					AND ac.country_id = $country_id
					AND status = 1
					ORDER BY created_date DESC
					LIMIT 0,2";
				
				$arrReturn["ab"] = R::getAll($sql);
				
				$sql = "SELECT id, name, details, logo_filepath, image_filepath, status, created_date, seo_summary
					FROM provider_profile p
					INNER JOIN provider_country pc
					ON pc.provider_id = p.id
					WHERE age_group_id = $menu_group
					AND pc.country_id = $country_id
					ORDER BY created_date DESC
					LIMIT 0,2";
				
				$arrReturn["ps"] = R::getAll($sql);
				
				$sql = "SELECT p.id, p.provider_id, title, image_filepath, summary, p.created_date, status, eag.age_group_id as alt_age_group_id, p.seo_url
					FROM provider_event p
					INNER JOIN provider_country pc
					ON pc.provider_id = p.provider_id
					LEFT OUTER JOIN event_age_group eag
					ON p.id = eag.event_id
					WHERE (p.age_group_id = $menu_group AND eag.age_group_id = $menu_group)
          			AND pc.country_id = $country_id
					ORDER BY created_date DESC
					LIMIT 0,2";
				
				$arrReturn["ep"] = R::getAll($sql);
				
				echo json_encode($arrReturn);
				break;
			case "forum":
				
				$sql = "SELECT msg.id_msg, msg.id_topic, msg.id_board,
					DATE_FORMAT(FROM_UNIXTIME(msg.poster_time), '%m.%d.%Y %H:%i:%s') AS poster_date, msg.subject, msg.poster_name, st.num_replies
					FROM $smfdbname.smf_messages msg
					INNER JOIN $smfdbname.smf_topics st
					ON msg.id_topic = st.id_topic
					WHERE msg.id_board = $menu_group
					ORDER BY msg.poster_time DESC
					LIMIT 0,4";
				
				$arrReturn["topics"] = R::getAll($sql);
				echo json_encode($arrReturn);
				break;
			case "pow":
				$sql = "SELECT id, pow_category_id, token_id, name, caption, photo_filename, image_type
                                        FROM pow_entry
                                        WHERE pow_category_id = $menu_group
                                        ORDER BY created_date DESC
                                        LIMIT 0,6";
				
				$arrReturn["ent"] = R::getAll($sql);
				
				$sql = "SELECT pe.pow_category_id, pe.token_id, pe.name, pe.caption, pe.total_vote, pe.photo_filename,
					pe.image_type, pcc.pow_contest_id, pcctr.country_id
					FROM pow_entry pe
					INNER JOIN pow_contest_category pcc
					ON pcc.id = pe.pow_category_id
					INNER JOIN pow_contest pc
					ON pc.id = pcc.pow_contest_id
					INNER JOIN pow_contest_country pcctr
					ON pcctr.contest_id = pcc.pow_contest_id
					WHERE pcctr.country_id = $country_id AND pcc.age_group_id = 0 
					LIMIT 0,8";
				
				$arrReturn["arc"] = R::getAll($sql);
				
				$sql = "SELECT pr.pow_entry_id, SUM(pr.total_vote) as votes, pe.token_id, pe.pow_category_id, photo_filename, image_type 
					FROM pow_result pr 
					INNER JOIN pow_entry pe 
					ON pe.id = pr.pow_entry_id 
					WHERE pow_contest_id = (SELECT pr1.pow_contest_id from pow_result pr1 
					INNER JOIN pow_contest_country pcctr 
					ON pcctr.contest_id = pr1.pow_contest_id 
					WHERE pcctr.country_id = $country_id 
					GROUP BY pow_contest_id 
					ORDER BY MAX(concluded_date) DESC LIMIT 1) 
					GROUP BY pow_entry_id LIMIT 1";
				
				$arrReturn["cw"] = R::getAll($sql);
				
				echo json_encode($arrReturn);
				break;
			case "ps":
				$sql = "SELECT id, name, image_filepath, age_group_id, created_date, status, details
					FROM provider_profile p
					INNER JOIN provider_country pc
					ON pc.provider_id = p.id
					WHERE status = 1
					AND pc.country_id = $country_id
					ORDER BY created_date DESC
					LIMIT 0,3";
				
				$arrReturn["ps"] = R::getAll($sql);
				
				/*
				modified to return reviews and not providers
				$sql = "SELECT count(*) as review_count, pr.provider_id, p.name, p.details, p.image_filepath, p.created_date, p.status
					FROM provider_review pr
					inner join provider_profile p
					on p.id = pr.provider_id
					INNER JOIN provider_country pc
					ON pr.provider_id = pc.provider_id
					WHERE pr.age_group_id = $menu_group
					AND pc.country_id = $country_id
					GROUP BY provider_id
					ORDER BY review_count DESC
					LIMIT 0,2";*/
				$sql = "SELECT pr.id, pr.provider_id, pr.title, pr.image_filepath, pr.summary, pr.age_group_id, pr.seo_url, pr.seo_summary
					FROM provider_review pr
					INNER JOIN provider_country pc
					ON pc.provider_id = pr.provider_id
					LEFT OUTER JOIN review_age_group rag
					ON rag.review_id = pr.id
					WHERE (pr.age_group_id = $menu_group AND rag.age_group_id = $menu_group)
					AND pc.country_id = $country_id
					order by pr.modified_date, pr.created_date DESC
					LIMIT 0,2";
				
				$arrReturn["mp"] = R::getAll($sql);
				
				echo json_encode($arrReturn);
				break;
			case "art":
				$sql = "SELECT a.id, provider_id, title, summary, author, a.created_date, image_filepath, status, ag.name as age_group_name, a.seo_url, aag.age_group_id as alt_age_group
					FROM article a
					INNER JOIN age_group ag
					ON ag.id = a.age_group_id
					INNER JOIN article_country ac
					ON ac.article_id = a.id
					LEFT OUTER JOIN article_age_group aag
					ON a.id = aag.article_id
					WHERE (a.age_group_id = $menu_group AND aag.age_group_id = $menu_group)
					AND (type = 1 OR type = 3)
					AND ac.country_id = $country_id
					AND status = 1
					ORDER BY created_date DESC
					LIMIT 0,2";

				$arrReturn["art"] = R::getAll($sql);
				
				$sql = "SELECT a.id, provider_id, title, summary, author, a.created_date, image_filepath, status, ag.name as age_group_name, 
					a.seo_url, aag.age_group_id as alt_age_group
					FROM article a
					INNER JOIN age_group ag
					ON ag.id = a.age_group_id
					INNER JOIN article_country ac
					ON ac.article_id = a.id
					LEFT OUTER JOIN article_age_group aag
					ON a.id = aag.article_id
					WHERE (a.age_group_id = $menu_group AND aag.age_group_id = $menu_group)
					AND type = 2
					AND ac.country_id = $country_id
					AND status = 1
					ORDER BY created_date DESC
					LIMIT 0,2";
				
				$arrReturn["pb"] = R::getAll($sql);
				
				echo json_encode($arrReturn);
				break;
			case "event":
				$sql = "SELECT pe.id, start_date, end_date, title, pc.country_id, pe.seo_url
					FROM provider_event pe
					INNER JOIN provider_country pc
					ON pe.provider_id = pc.provider_id
					LEFT OUTER JOIN event_age_group eag
					ON pe.id = eag.event_id
					WHERE (pe.age_group_id = $menu_group AND eag.age_group_id = $menu_group)
					AND pc.country_id = $country_id
					AND start_date >= CURDATE()
					ORDER BY start_date ASC
					LIMIT 0,4";
				
				$arrReturn["event"] = R::getAll($sql);
				
				$sql = "SELECT pe.id, start_date, end_date, title, pc.country_id, pe.seo_url, pe.summary, pe.image_filepath
					FROM provider_event pe
					INNER JOIN provider_country pc
					ON pe.provider_id = pc.provider_id
					LEFT OUTER JOIN event_age_group eag
					ON pe.id = eag.event_id
					WHERE (pe.age_group_id = $menu_group AND eag.age_group_id = $menu_group)
					AND pc.country_id = $country_id
					AND start_date >= CURDATE()
					ORDER BY RAND()
					LIMIT 0,2";
				
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
		
		$sql = "SELECT pe.start_date, pe.end_date, title, pe.seo_url
			FROM provider_event pe
			INNER JOIN provider_country pc
			ON pe.provider_id = pc.provider_id
			LEFT OUTER JOIN event_age_group eag
			ON pe.id = eag.event_id
			WHERE pe.start_date <= '$end_date'
			AND pe.end_date >= '$start_date'
			AND pc.country_id = $country_id
			AND (pe.age_group_id = $menu_group OR eag.age_group_id = $menu_group)
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

	function getDomain() {
                $forum_domain = $_SERVER['HTTP_HOST'];
		$sql = "SELECT id, code, url FROM country WHERE status = 1 AND url = " . $forum_domain;
                
                $arrCountry = R::getRow($sql);
		$country_id = $this->config->item('country_id');
		echo  $country_id;
        }

	function createThreadMMTest() {
                $subject =  "Test Post";
                $content = "Test Content";

                $poster_email = "jun_lobo@yahoo.com";
                $poster_id = "1";
                $board_id = "2";
                $msg_id = 0;
                $topic_id = 0;
                $poster_name = "Jun Lobo";

                $returnid = $this->smfpost->create_post($subject, $content, $poster_email, $poster_id, $board_id, 0, NULL, $poster_name);

                return $returnid;
        }

	function enc() {
		echo md5("password");
	}

	function registerMMUser() {
		$email = "loviron45@gmail.com";
                $password = "loviron45@gmail.com";
                //$avatar = base_url().'uploaded/user/avatar/'.$this->input->post('user_avatar');

                $regOptions = array(
                    'interface' => 'guest',
                    'member_name' => $email, //the variable from the form for the inputted username
                    'email' => $email, //likewise, the email address that was inputted in the form
                    'password' => $password, //the password that the user inputted
                    'password_check' => $password, //the second confirmation password inputted
                    'check_reserved_name' => true, //this will make sure that SMF first checks for a reserved name before writing the user to the database
                    'check_password_strength' => false,
                    'check_email_ban' => true, //checks for ban on the email address that was inputted
                    'send_welcome_email' => false, //true if you want SMF to send an email, false if you want your other software to handle it.  I'd recommend false.
                    'require' => 'nothing',
                    'extra_register_vars' => array(),
                    'theme_vars' => array(),
                    'avatar' => ''
                );

                $smf_id = smfapi_registerMember($regOptions);
	}
}
?>
