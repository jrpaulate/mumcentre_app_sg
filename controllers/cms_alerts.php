<?php
class cms_alerts extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
        $this->load->library('MCAPI');
        $this->load->library('session');
  
    }
    
    private function _check_logged(){
        if($this->session->userdata('cms_logged_in') != TRUE){
            redirect('cms/login', 'refresh');
        }
    }
  
    function index() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/alerts_list');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
        
          $retval = $this->mcapi->lists();  
  
        if ($this->mcapi->errorCode){  

            echo "Unable to load lists()!";  
            echo "\n\tCode=".$this->mcapi->errorCode;  
            echo "\n\tMsg=".$this->mcapi->errorMessage."\n";  

        }else{  

            echo "Lists that matched:".$retval['total']."\n";  
            echo "Lists returned:".sizeof($retval['data'])."\n";  

            foreach ($retval['data'] as $list){  
                echo "Id = ".$list['id']." - ".$list['name']."\n";  
                echo "Web_id = ".$list['web_id']."\n";  
                echo "\tSub = ".$list['stats']['member_count'];  
                echo "\tUnsub=".$list['stats']['unsubscribe_count'];  
                echo "\tCleaned=".$list['stats']['cleaned_count']."\n";
                echo "\tRate=".$list['stats']['click_rate']."\n";
            }  
        }  
    
    }
    

  
    function alerts_list(){
        echo '{"alerts_list": [{'.$this->_alerts().'}]}';
    }
  
    private function _alerts() {
          $sql="SELECT
          a.id
        , a.content_type
        , a.content_id
        , a.title AS content_title
        , a.url AS content_link
        , a.summary AS content_summary
        , a.ads
        , a.send_date AS sending_date
        , age.name AS age_group_name
        FROM alert AS a
        INNER JOIN age_group AS age
        ON a.age_group_id = age.id
        ORDER BY a.id";
          
        $alerts = R::getAll($sql);

        return '"alerts":' . json_encode($alerts);

    }

  
    private function _age_groups() {
        $sql="SELECT
          a.id
        , a.name AS age_group_name
        FROM age_group as a
        ORDER BY a.id";
        
        $age_groups = R::getAll($sql);

        return '"age_groups":' . json_encode($age_groups);

    }
  
    function age_group_list(){
        echo '{"age_group_list": [{'.$this->_age_groups().'}]}';
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
    
    
    
     function _Contents() {
        
         $current_date= date("Y-m-d");
        
        //select alert
           $sql="SELECT c.content_type as content_type, 
               c.summary as summary, 
               c.url as url, 
               c.title as title, 
               age.name as age_group 
               from Alert as c 
               INNER JOIN age_group AS age
               ON c.age_group_id = age.id  
               where Send_date ='2012-01-03 00:00:00'";    
           
        $Contents = R::getAll($sql);

  
   
     }
     
     
     function campaign(){
       $current_date = date("Y-m-d");
       $type = 'regular';
//            $type = 'trans';

            $opts['list_id'] = '2e3861cf16';
            $opts['subject'] = 'Article Alerts';
            $opts['from_email'] = 'ladypaine2000@gmail.com'; 
            $opts['from_name'] = 'Test.Mumcentre.com';
//            $opts['template_id'] = '3261';

            $opts['tracking']=array('opens' => true, 'html_clicks' => true, 'text_clicks' => false);

            $opts['authenticate'] = true;
            $opts['title'] = 'Article Alerts';
            
//           $Contents = $this->_Contents();
                        
            $sql="SELECT c.content_type as content_type, 
               c.summary as summary, 
               c.url as url,  
               c.title as title, 
               age.name as age_group 
               from alert as c 
               INNER JOIN age_group AS age
               ON c.age_group_id = age.id  
               WHERE c.send_date BETWEEN DATE_ADD('".$current_date."', INTERVAL -6 DAY) AND '".$current_date."'
               ORDER BY c.content_type, c.send_date";    
           
            
               $Contents = R::getAll($sql);
                $html = "<H3> Mumcentre Alerts </H3>
                        </br>
                         Hi Fellow Mum,
                        </br>
                          here's your dose of Mumcentre Alerts for today...
                        </br> </br>
                        ";
                
                 foreach ($Contents as &$c) {
                 $link = url_title($c['title']);
                 $age_group = url_title($c['age_group'],'dash',TRUE);
                 $html .= "
       
                    <table width= 600px>
                    <tr>
                    <td valign=top>
                    <a href='".base_url().$age_group."/".$link."'>".$c['title']."</a> 
                    <br />
                    ".$c['summary']."
                    <br />
                     ".$c['url']."
                    <br />
                  
                    </td>
                    </tr>
                    </table>

                    ";
                 
              }   
                
                $content = array('html'=> $html, 
                              'text' => '&title text text *|UNSUB|*'
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
            }
        }
        
}
?>
