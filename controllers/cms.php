<?php
//require_once('C:/xampp/htdocs/mumcentre/forum/smf_2_api.php');
require_once('/var/www/mumcentre/forum/smf_2_api.php');


class Cms extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
        $this->article_image_path = $this->config->item('article_image_gen_path');
    }
    
    

    private function _check_logged(){
        if($this->session->userdata('cms_logged_in') != TRUE){
            redirect('cms/login', 'refresh');
        }
    }
    
    function index() {
//        if($this->session->userdata('cms_logged_in') == TRUE){
            $this->_check_logged();
            $this->load->library('bucket');
            $this->bucket->set_layout_id('mumcentre/cms_layout');
            $this->bucket->set_content_id('cms/cms_dashboard');
            $this->bucket->add_css('cms');
            $this->bucket->set_data('title', "Mumcentre CMS");
            $this->bucket->render_layout();
//        } else {
//             redirect('cms/login', 'refresh');
//        }
    }
    
       
    function article() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/article');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    
    
    function add_article() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/add_article');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
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
                $this->media->smart_resize_image($json->{'file_path'}, 212, 235, false,
                        $this->article_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".png":
                $this->media->smart_resize_image($json->{'file_path'}, 212, 235, false,
                        $this->article_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".gif":
                $this->media->smart_resize_image($json->{'file_path'}, 212, 235, false,
                        $this->article_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
        }
        




        echo $id . ".jpg";
    }
   
    function create() {
        $article = R::dispense("article");        
        $alert = R::dispense("alert");
        
        $title_check = reset(R::find('article', ' seo_url = ? ', array(url_title($this->input->post('seo_link')))));
        
        if($title_check){
            $response['code'] = -1;
            $response['message'] = "Article title already exists.";
        } else {
                
        $article->title = $this->input->post('title');
        $article->type = $this->input->post('type');
        $article->blog_url = $this->input->post('blog_url');
        $article->author = $this->input->post('author');
        $article->image_filepath = $this->input->post('avatar');
        $article->summary = $this->input->post('summary');
        $article->body = $this->input->post('article');
        $article->seo_url = url_title($this->input->post('seo_link'));
        $article->seo_summary = $this->input->post('se_summary');
        $article->seo_keywords = $this->input->post('se_keywords');
        $article->age_group_id = $this->input->post('age_group');
        $article->publish_date = $this->input->post('publish_date');
        $article->provider_id = $this->input->post('provider');
        $article->created_by_id = 0;
        $article->template_status = $this->input->post('template');
        $article->created_date = date("Y-m-d H:i:s");
        if($this->input->post('publish_date') <= date("Y-m-d")) {
            $article->status = 1;
        } else {
            $article->status = 0;
        }        
        $article_id = R::store($article);
        
        $alert->content_type = 'Article';
        $alert->content_id = $article_id;
        $alert->title = $this->input->post('title');
        $alert->summary = $this->input->post('summary');
        $alert->send_date = $this->input->post('sending_date');
        $alert->age_group_id = $this->input->post('age_group');
        $alert->url = $this->input->post('seo_link');        
        $alert->status = 0;
        $alert->created_by_id = 0;
        $alert->created_date = date("Y-m-d H:i:s");
                
        $alert_id = R::store($alert);
        
		// save selected countries to article_country
		$countries=explode("|", $this->input->post('countries'));
		$country_count = count($countries);
           
                
		for ($i = 0; $i < $country_count; $i++) {

			// save selected countries to article_country
			$sql="INSERT INTO article_country (article_id, country_id, total_views) VALUES (";
            $sql.=$article_id;
			$sql.=",".$countries[$i];
			$sql.=",0)";
        	R::exec($sql);

			// save selected countries to alert_country
			$sql="INSERT INTO alert_country (alert_id, country_id, total_views) VALUES (";
            $sql.=$alert_id;
			$sql.=",".$countries[$i];
			$sql.=",0)";
        	R::exec($sql);
		
		
		}
                
                
                $age_group=explode("|", $this->input->post('age_group'));
		$age_group_count = count($age_group);
                
		for ($i = 0; $i < $age_group_count; $i++) {
                    
                       // save selected age_group to article_age_group
			$sql="INSERT INTO article_age_group (article_id, age_group_id) VALUES (";
                        $sql.=$article_id;
			$sql.=",$age_group[$i])";
        	R::exec($sql);
                }

        $response['code'] = 0;
        $response['message'] = "Article successfully created.";
        }
        echo $response['code'] . ":" . $response['message'] ;  
    }
    

     function alerts_list(){
      echo '{"alerts_list": [{'.$this->_alerts().'}]}';
    }

    

  
    private function _age_groups() {
        $sql="SELECT
          a.id AS age_group_id
        , a.name AS age_group_name
        FROM age_group AS a
        ORDER BY a.id";
        
        $age_groups = R::getAll($sql);

        //    foreach ($highlights as &$highlight) {
        //      $highlight['program_summary'] = $this->_trimHighlights($highlight['program_summary']);
        //    }

        return '"age_groups":' . json_encode($age_groups);
        //echo $this->_json_response('featured_articles', $articles);
    }
  
    function age_group_list(){
        echo '{"age_group_list": [{'.$this->_age_groups().'}]}';
    }
    
	private function _countries() {
        $sql="SELECT
          id AS country_id
		, code AS country_code
        , name AS country_name
        FROM country 
		WHERE status = 1
        ORDER BY country_id";
        
        $countries = R::getAll($sql);


        return '"countries":' . json_encode($countries);
    }

    function country_list(){
        echo '{"country_list": [{'.$this->_countries().'}]}';
	}
        
        
       
        

    function publish() {
        
        $current_date=date("Y-m-d");
        
        //publish article
        $sql="UPDATE article SET status = 1 WHERE publish_date <= '".$current_date."' AND status = 0";            
        R::exec($sql);

        //publish programs
        $sql="UPDATE provider_program SET status = 1 WHERE publish_date <= '".$current_date."' AND status = 0";            
        R::exec($sql);
        
        //publish curriculum
        $sql="UPDATE provider_curriculum SET status = 1 WHERE publish_date <= '".$current_date."' AND status = 0";            
        R::exec($sql);
        
        //publish reviews
        $sql="UPDATE provider_review SET status = 1 WHERE publish_date <= '".$current_date."' AND status = 0";            
        R::exec($sql);
        
        //publish events
        $sql="UPDATE provider_event SET status = 1 WHERE publish_date <= '".$current_date."' AND status = 0";            
        R::exec($sql);
        
        echo "published";
    }
    
    function auth(){
        $email_address = $this->input->post('email');
        $password = $this->input->post('password');

        $sql="SELECT
          u.id
        , u.first_name
        , u.avatar_filepath
        FROM user AS u
        WHERE email_address='".$email_address."'
        AND u.password = '".md5($password)."'";

        $account = R::getAll($sql);
    }
    
    function campaign(){
        
        $type = 'regular';
//            $type = 'trans';

            $opts['list_id'] = '2e3861cf16';
            $opts['subject'] = 'Article Alerts';
            $opts['from_email'] = 'seishunheiki@gmail.com'; 
            $opts['from_name'] = 'Mumcentre';
            $opts['template_id'] = '3261';

            $opts['tracking']=array('opens' => true, 'html_clicks' => true, 'text_clicks' => false);

            $opts['authenticate'] = true;
            $opts['title'] = 'Article Alerts';
            
            $age_group = $this->_get_agegroup($this->input->post('age_group'));
            $title = url_title($this->input->post('title'),'dash',TRUE);
            
            $html = "<a href='".$base_url()."/".$age_group['name']."/".$title."'>".$this->input->post('title')."</a><br/> 
                    <span>".$this->input->post('summary')."</span>

                    ";

            $content = array('html'=> $html, 
                              'text' => 'text text text *|UNSUB|*'
                            );

            $retval = $this->mcapi->campaignCreate($type, $opts, $content);

            if ($this->mcapi->errorCode){
                    echo "Unable to Create New Campaign!";
                    echo "\n\tCode=".$this->mcapi->errorCode;
                    echo "\n\tMsg=".$this->mcapi->errorMessage."\n";
            } else {
//                    echo "New Campaign ID: ".$retval."\n";
                    $campaignId = $retval;
                    $retval = $this->mcapi->campaignSendNow($campaignId);
                    
                     if ($this->mcapi->errorCode){
                            echo "Unable to Send Campaign!";
                            echo "\n\tCode=".$this->mcapi->errorCode;
                            echo "\n\tMsg=".$this->mcapi->errorMessage."\n";
                    } else {
                            return "Campaign Sent!\n";
                    }
            }
        }
        
      private function _get_agegroup($age_group_id) {
        $age = R::getRow("SELECT name
        FROM age_group
        WHERE id = ".$age_group_id." 
        ");
        
        $age['name'] = url_title($age['name'],'dash',TRUE);
        
        return $age;
      }
      
      function login(){
        if($this->session->userdata('cms_logged_in') == TRUE){
            redirect('cms/cms_dashboard', 'refresh');
        }  
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/blank');
        $this->bucket->set_content_id('cms/cms_login');
        $this->bucket->add_css('modal_orig');
        $this->bucket->add_css('pow');
        $this->bucket->add_css('style');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
      }
      
      function set_session_2() {
        $email_address = $this->input->post('email');
        $pword = $this->input->post('password');
        $user_info = $this->_user_info($email_address);
        
//        $authenicated = smfapi_authenticate($email_address, $pword);
//			if ($authenicated) {
//				smfapi_login($email_address);
//			}
        
        $data = array(
            'name' => $user_info['first_name'],
            'avatar' => $user_info['avatar_filepath'],
            'user_id' => $user_info['id'],
            'smf_email' => $email_address,
            'logged_in' => TRUE,
            'cms_logged_in' => TRUE
        );
        $this->session->set_userdata($data);
    }
    
    private function _user_info($email_address){
        $meta = R::getRow("SELECT id, first_name, last_name, avatar_filepath
            FROM user
            WHERE email_address = '".$email_address."'"
          );
        return $meta;
    }
    
    function logout() {
//		$smfemail = $this->session->userdata('smf_email');
		
//		smfapi_logout($smfemail);
		
        $this->session->sess_destroy();
    }
    
    function log() {
        $email_address = $this->input->post('email_address');
        $password = $this->input->post('password');
        $user_salt = R::getRow("SELECT salt from user WHERE email_address = '".$email_address."'");
        $encrypted_password = $this->_encrypt_password($password, $user_salt['salt']);
        
        $user = reset(R::find('user', ' email_address = ? and password = ?', array($email_address, $encrypted_password)));
        if ($user) {
            $response['code'] = 1;
            $response['message'] = 'Logging in...';
        } else {
            $response['code'] = -1;
            $response['message'] = 'Invalid email address / password.';
        }
        
        echo $response['code'] . ":" . $response['message'];
    }
    
    
    function unpublish($id){
        
        $article = R::load('article',$id);
      
        $article->status = 0;

        $id = R::store($article);
        
        $response['code'] = 0;
        $response['message'] = "Status Successfully Updated.";

        echo $response['code'] . ":" . $response['message'] ;  //echo "Band creation successful!";
    }
    
    
       function force_publish($id){
        
        $article = R::load('article',$id);
      
        $article->status = 1;

        $id = R::store($article);
        
        $response['code'] = 0;
        $response['message'] = "Status Successfully Updated.";

        echo $response['code'] . ":" . $response['message'] ;  //echo "Band creation successful!";
    }
    
    function get_article_link(){
        $id = $this->input->post('article_id');
        
        $article = R::getRow("SELECT a.title, b.name
            FROM article as a
            INNER JOIN age_group as B ON a.age_group_id = b.id
            WHERE a.id = ".$id
          );
        
        $age_group = url_title($article['name'],'dash',TRUE);
        $title = url_title($article['title']);
        $base = base_url();
        $article['link'] = $base.url_title($article['name'],'dash',TRUE).'/'.url_title($article['title']);
        
        echo $article['link'];
//        echo $base;
        
    }
    
    
    
    
    
    
    private function _get_article($article_id) {
        $sql="SELECT
          a.title AS article_title
        , a.author AS article_author
        , a.summary AS article_summary
        , a.body AS article_body
        , a.image_filepath AS article_image
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , a.id
        , a.age_group_id AS age_group
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

    
        return '"article":' . json_encode($article);
    }
      
    function get_article_data($article_id){
        echo '{"get_article_data": [{'.$this->_article($article_id).'}]}';
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
    
    
    private function _article($article_id) {
        $sql="SELECT
          a.title AS article_title
        , a.author AS article_author
        , a.summary AS article_summary
        , a.body AS article_body
        , a.image_filepath AS article_image
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , a.id
        , a.age_group_id AS age_group
        , a.publish_date
        , al.send_date
        , age.name as age_group_name
        , c.country_id
        FROM article AS a
        INNER JOIN age_group as age
        ON a.age_group_id = age.id
        INNER JOIN article_country as c
        ON a.id = c.article_id
        LEFT OUTER JOIN alert AS al
        ON al.content_type='Article'
        AND al.content_id=a.id
        WHERE a.id = ".$article_id;

        $article = R::getAll($sql);

    
        return '"article":' . json_encode($article);
    }
      
    function article_data($article_id){
        echo '{"article_data": [{'.$this->_article($article_id).'}]}';
    }
    
    
    
    
    
    function create_hotbox() {
        $age_group = url_title($this->input->post('age_group'),'dash',TRUE);
        
        $hotbox = R::dispense("hotbox");              
        $hotbox->title = $this->input->post('title');
        $hotbox->url = $age_group."/".$this->input->post('seo_url');
        $hotbox->image_filepath = $this->input->post('avatar');
        $hotbox->summary = $this->input->post('summary');
        $hotbox->country_id = $this->input->post('country_id');
		$hotbox->article_id = $this->input->post('article_id');
        $hotbox->created_by_id = 0;     
        $hotbox->created_date = date("Y-m-d H:i:s");
           
        $id = R::store($hotbox);
        
       
  
        $response['code'] = 0;
        $response['message'] = "Hotbox successfully created.";
       
        echo $response['code'] . ":" . $response['message'] ;  
    }
    
    function poll($country_id = 0) {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/poll_listing');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
		
		$pollhtml = $this->load_poll($country_id);
		$countrieshtml = $this->get_countries_ddl($country_id);
		$this->bucket->set_data('pollhtml', $pollhtml);
		$this->bucket->set_data('countrieshtml', $countrieshtml);
		
        $this->bucket->render_layout();
    }
	
	function load_poll($country_id) {
		$country_id = ($country_id == 0)?3:$country_id;
		$pollhtml = "";
		
		$sql="SELECT id, question, isdefault, country_id
			FROM poll
			WHERE country_id = $country_id";
		
		$poll = R::getAll($sql);
		
		foreach ($poll as $pollentry) {
			$pollhtml .= "<tr>";
			$pollhtml .= "<td style=\"background-color:#CCCCCC;color:#333333\" width=\"100\">".$pollentry['id']."</td>";
			$pollhtml .= "<td style=\"background-color:#CCCCCC;color:#333333\">".$pollentry['question']."</td>";
			$pollhtml .= "<td style=\"background-color:#CCCCCC;color:#333333\" width=\"70\">".$pollentry['isdefault']."</td>";
			
			$checked = ($pollentry['isdefault'] == 1)?"checked=checked":"";
			$pollhtml .= "<td style=\"background-color:#CCCCCC;color:#333333\" width=\"50\"><input type=\"radio\" name=\"pollradio\" value=\"".$pollentry['id']."\" $checked /></td>";
			$pollhtml .= "</tr>";
		}
		
		return $pollhtml;
	}
	
	function poll_addnew() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/poll_add');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
		
		$countryhtml = $this->get_countries();
		$this->bucket->set_data('countryhtml', $countryhtml);
		
        $this->bucket->render_layout();
    }
	
	function get_countries_ddl($queryid = 0) {
		$sql="SELECT id, code, name, url
			FROM country";
		
		$countries = R::getAll($sql);
		$countryhtml = "";
		
		foreach ($countries as $country) {
			$selected = ((int) $queryid == (int) $country['id'])?"selected":"";
			$countryhtml .= "<option $selected value=\"".$country['id']."\" />".$country['name']."</option>";
		}
		
		return $countryhtml;
	}
	
	function get_countries() {
		$sql="SELECT id, code, name, url
			FROM country";
		
		$countries = R::getAll($sql);
		$countryhtml = "";
		
		foreach ($countries as $country) {
			
			$countryhtml .= "<input type=\"checkbox\" name=\"chkCountry[]\" value=\"".$country['id']."\" />";
			$countryhtml .= " ".$country['name']."<br />";
		}
		
		return $countryhtml;
	}
	
	function set_poll_default() {
		
		$poll_id = $this->input->post('poll_id');
		$country_id = $this->input->post('country_id');
		$sql="UPDATE poll SET isdefault = 0 WHERE country_id = $country_id";
		
		R::exec($sql);

		$sql="UPDATE poll SET isdefault = 1 WHERE id = $poll_id";
		
		R::exec($sql);
		
		return true;
	}
	
	function delete_poll() {
		
		$poll_id = $this->input->post('poll_id');
		$sql="DELETE FROM poll WHERE id = $poll_id";
		
		R::exec($sql);
		
		$sql="DELETE FROM poll_options WHERE poll_id = $poll_id";
		
		R::exec($sql);
		
		return true;
	}
	
	function poll_save() {
        $this->_check_logged();
		$this->load->helper('url');
        $this->load->library('bucket');
        $this->bucket->set_data('title', "Mumcentre CMS");
		
		$question = $this->input->post('txtQuestion');
		$options = $this->input->post('txtOption');
		$countries = $this->input->post('chkCountry');
		
		
		for ($x = 0; $x < count($countries); $x++) {
			$poll = R::dispense("poll"); 
			$poll->question = $question;
			$poll->isdefault = 0;
			$poll->country_id = $countries[$x];
			$poll_id = R::store($poll);
			
			for ($y = 0; $y < count($options); $y++) {
				
				$sql = "INSERT INTO poll_options (poll_id, poll_options.option, votes)
					VALUES ($poll_id, '$options[$y]', 0)";

				R::exec($sql);
			}
		}
		
		redirect('/cms/poll', 'refresh');
    }
    
    
    
    
     function article_list($country_id, $age_group_id, $type, $status,$date){
        echo '{"article_list": [{'.$this->_articles($country_id, $age_group_id, $type, $status,$date).'}]}';
    }
  
    
    private function _articles($country_id, $age_group_id, $type, $status, $date) {
        
        if ($country_id == 0){
            
        $sql="SELECT
          a.id
        , a.blog_url AS blog_url
        , a.type AS article_type
        , a.title AS article_title
        , a.summary AS article_summary
        , a.author AS article_author
        , a.image_filepath AS article_image
        , a.status
        , a.created_date
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , age.name AS age_group_name
        , cr.name AS country
        , cr.url
        FROM article AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN article_country as country
        ON a.id = country.article_id
        INNER JOIN country as cr
        on country.country_id = cr.id
        ORDER BY a.created_date DESC";
        
        $articles = R::getAll($sql);

        foreach ($articles as &$a) {
          if($a['status'] == 0) {
              $a['status'] = 'unpublished';
          } else {
              $a['status'] = 'published';
          } 
       
        }
        
          foreach ($articles as &$a) {
          if($a['article_type'] == 1) {
              $a['article_type'] = 'Mum Article';
          } elseif ($a['article_type'] == 2) {
              $a['article_type'] = 'Blogger Article';
          } elseif ($a['article_type'] == 3) {
              $a['article_type'] = 'Advertorials';
          }
        }

        return '"articles":' . json_encode($articles);
      
        }else{
            
        $sql="SELECT 
          a.id
        , a.blog_url AS blog_url
        , a.type AS article_type
        , a.title AS article_title
        , a.summary AS article_summary
        , a.author AS article_author
        , a.image_filepath AS article_image
        , a.status
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , a.created_date
        , age.name AS age_group_name
        , cr.name AS country
        FROM article AS a
        INNER JOIN article_age_group AS agg
        ON a.id = agg.article_id
        INNER JOIN age_group AS age
        ON age.id = agg.age_group_id
        INNER JOIN article_country as country
        ON a.id = country.article_id
        INNER JOIN country as cr
        on country.country_id = cr.id
        WHERE cr.id = '" . $country_id . "' 
        ORDER BY a.created_date DESC";
        
        $articles = R::getAll($sql);

        foreach ($articles as &$a) {
          if($a['status'] == 0) {
              $a['status'] = 'unpublished';
          } else {
              $a['status'] = 'published';
          } 
       
        }
        
          foreach ($articles as &$a) {
          if($a['article_type'] == 1) {
              $a['article_type'] = 'Mum Article';
          } elseif ($a['article_type'] == 2) {
              $a['article_type'] = 'Blogger Article';
          } elseif ($a['article_type'] == 3) {
              $a['article_type'] = 'Advertorials';
          }
        }

        return '"articles":' . json_encode($articles);  
            
            
        }  
       
        
        
        
       if($date != 0){
            $extra = "AND a.created_date = '". $date . "'";
        } else {
            $extra = "";
        }
        
        
         if($type != 0){
              $typ = "AND a.type = '". $type . "'";
        } else {
            $typ = "";
        }
        
        
        if($status != 0){
              $stats = "AND a.status = '". $status . "'";
        } else {
            $stats = "";
        }
        
        
        
        $sql="SELECT
          a.id
        , a.blog_url AS blog_url
        , a.type AS article_type
        , a.title AS article_title
        , a.summary AS article_summary
        , a.author AS article_author
        , a.image_filepath AS article_image
        , a.status
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , a.created_date
        , age.name AS age_group_name
        , cr.name AS country
        FROM article AS a
        INNER JOIN article_age_group AS agg
        ON a.id = agg.article_id
        INNER JOIN age_group AS age
        ON age.id = agg.age_group_id
        INNER JOIN article_country as country
        ON a.id = country.article_id
        INNER JOIN country as cr
        ON country.country_id = cr.id
        WHERE country.country_id = '" . $country_id . "' AND
        agg.age_group_id = '" . $age_group_id . "' AND   
        a.status = '" . $status . "'".$extra . $typ;
        
        $articles = R::getAll($sql);

        foreach ($articles as &$a) {
          if($a['status'] == 0) {
              $a['status'] = 'unpublished';
          } else {
              $a['status'] = 'published';
          } 
       
        }
        
          foreach ($articles as &$a) {
          if($a['article_type'] == 1) {
              $a['article_type'] = 'Mum Article';
          } elseif ($a['article_type'] == 2) {
              $a['article_type'] = 'Blogger Article';
          } elseif ($a['article_type'] == 3) {
              $a['article_type'] = 'Advertorials';
          }
        }

        return '"articles":' . json_encode($articles);
      
    }
    
    
    
    
    
     function all_list(){
        echo '{"all_list": [{'.$this->_articleAll().'}]}';
    }
  
    
    private function _articleAll() {
        
        $sql="SELECT
          a.id
        , a.blog_url AS blog_url
        , a.type AS article_type
        , a.title AS article_title
        , a.summary AS article_summary
        , a.author AS article_author
        , a.image_filepath AS article_image
        , a.status
        , a.created_date
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , age.name AS age_group_name
        , cr.name AS country
        , cr.url
        FROM article AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN article_country as country
        ON a.id = country.article_id
        INNER JOIN country as cr
        on country.country_id = cr.id
        ORDER BY a.created_date DESC";
        
        $articleAll = R::getAll($sql);

        foreach ($articleAll as &$a) {
          if($a['status'] == 0) {
              $a['status'] = 'unpublished';
          } else {
              $a['status'] = 'published';
          } 
       
        }
        
          foreach ($articleAll as &$a) {
          if($a['article_type'] == 1) {
              $a['article_type'] = 'Mum Article';
          } elseif ($a['article_type'] == 2) {
              $a['article_type'] = 'Blogger Article';
          } elseif ($a['article_type'] == 3) {
              $a['article_type'] = 'Advertorials';
          }
        }

        return '"articleAll":' . json_encode($articleAll);
      
    }
    
    
    function force_delete($id){
		
		$article_check = reset(R::find('hotbox', ' article_id = ? ', array($id)));
		
		if ($article_check){
			echo "This article is in the hotbox as well. Please delete article in the hotbox";
			
		}else{
						
			$article = R::load('article',$id);
	   
			
			$id = R::trash($article);
			
			$response['code'] = 0;
			$response['message'] = "Status Successfully Updated.";

			echo "Article Removed";
			//echo $response['code'] . ":" . $response['message'] ;  //echo "Band creation successful!";
		}
    }
    
    
    
    private function _search_article($keyword) {
        $keyword = $this->input->get("keyword");
        $article = R::getAll("SELECT 
          a.id
        , a.blog_url AS blog_url
        , a.type AS article_type
        , a.title AS article_title
        , a.summary AS article_summary
        , a.author AS article_author
        , a.image_filepath AS article_image
        , a.status
        , a.seo_url AS seo_link
        , a.seo_summary AS se_summary
        , a.seo_keywords AS se_keywords
        , a.created_date
        , age.name AS age_group_name 
        , cr.name AS country
        , cr.url
        FROM article AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        INNER JOIN article_country as c
        ON c.article_id = a.id
        INNER JOIN country as cr
        ON cr.id = c.country_id
       
        WHERE a.title LIKE '%" . $keyword . "%' 
        ORDER BY a.created_date DESC   
        ");

        
        foreach ($article as &$a) {
          if($a['status'] == 0) {
              $a['status'] = 'unpublished';
          } else {
              $a['status'] = 'published';
          } 
       
        }
        
          foreach ($article as &$a) {
          if($a['article_type'] == 1) {
              $a['article_type'] = 'Mum Article';
          } elseif ($a['article_type'] == 2) {
              $a['article_type'] = 'Blogger Article';
          } elseif ($a['article_type'] == 3) {
              $a['article_type'] = 'Advertorials';
          }
        }
         
        
   
        return '"article":' . json_encode($article);
    
        
        
    }    
    
    
     
    
    
     function search_article() {
        $keyword = $this->input->get("keyword");
        echo '{"article_list": [{' . $this->_search_article($keyword) . '}]}';
    }
    
    
    private function _encrypt_password($password, $salt){
        return md5(md5($password).$salt);
    }
    
    
}  
    

?>
