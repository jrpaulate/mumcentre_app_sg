<?php

class Mailchimp extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('mcapi');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
    }
    
    function index(){
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
    
    function subscribe(){
        $emailaddress = $this->input->post('email');
        $listID = "2e3861cf16"; // obtained by calling lists();
        $retval = $this->MCAPI->listSubscribe($listID, $emailaddress);  

        if ($this->MCAPI->errorCode){  

            echo "Unable to subscribe email using listSubscribe()!";  
            echo "\n\tCode=".$this->MCAPI->errorCode;  
            echo "\n\tMsg=".$this->MCAPI->errorMessage."\n";  

        }else{  

            echo $emailaddress." added successfully\n";  

        }  
        
    }
    
    function subscriber_list(){
        $listID = "2e3861cf16"; // obtained by calling lists();
        $status = "subscribed";
        $retval = $this->MCAPI->listMembers($listID); 
        
        if ($this->MCAPI->errorCode){  

            echo "Unable to load lists()!";  
            echo "\n\tCode=".$this->MCAPI->errorCode;  
            echo "\n\tMsg=".$this->MCAPI->errorMessage."\n";  

        }else{  

            foreach ($retval['data'] as $list){  
                echo "[Email add = ".$list['email']."] "; 
            }  
        }  
    }
    
    function send_now(){
        $campaignId = '1583bf5e2f';
        $retval = $this->MCAPI->campaignSendNow($campaignId);
 
        if ($this->MCAPI->errorCode){
                echo "Unable to Send Campaign!";
                echo "\n\tCode=".$this->MCAPI->errorCode;
                echo "\n\tMsg=".$this->MCAPI->errorMessage."\n";
        } else {
                echo "Campaign Sent!\n";
        }
    }
    
    function campaigns(){
        $retval = $this->MCAPI->campaigns();  
  
        if ($this->MCAPI->errorCode){  

            echo "Unable to load lists()!";  
            echo "\n\tCode=".$this->MCAPI->errorCode;  
            echo "\n\tMsg=".$this->MCAPI->errorMessage."\n";  

        }else{  

            echo "Lists of campaigns that matched:".$retval['total']."\n";  
            echo "Lists of campaigns returned:".sizeof($retval['data'])."\n";  

            foreach ($retval['data'] as $list){  
                echo "[Campaign Id = ".$list['id']." |";  
                echo "Web_id = ".$list['web_id']." |";  
                echo "Title = ".$list['title']." |";
                echo "Subject = ".$list['subject']." |";
                echo "Status = ".$list['status']." |";
                echo "Emails sent = ".$list['emails_sent']." |";
                echo "Send time = ".$list['send_time']."] ";
            }  
        }  
    }
    
    function create_campaign(){
        
//        $type = 'regular';
        $type = 'trans';
 
        $opts['list_id'] = '2e3861cf16';
        $opts['subject'] = 'Trans Newsletter Test';
        $opts['from_email'] = 'seishunheiki@gmail.com'; 
        $opts['from_name'] = 'Mumcentre';
        $opts['template_id'] = '3261';

        $opts['tracking']=array('opens' => true, 'html_clicks' => true, 'text_clicks' => false);

        $opts['authenticate'] = true;
        $opts['title'] = 'Test Newsletter Title 2';

        $content = array('html'=>'some pretty html content *|UNSUB|* message', 
                          'text' => 'text text text *|UNSUB|*'
                        );
        
        $retval = $this->MCAPI->campaignCreate($type, $opts, $content);
 
        if ($this->MCAPI->errorCode){
                echo "Unable to Create New Campaign!";
                echo "\n\tCode=".$this->MCAPI->errorCode;
                echo "\n\tMsg=".$this->MCAPI->errorMessage."\n";
        } else {
                echo "New Campaign ID: ".$retval."\n";
        }
    }
    
    function templates(){
        
        $types = array('user'=>true, 'gallery'=>true);
        $retval = $this->MCAPI->templates($types);

        if ($this->MCAPI->errorCode){
                echo "Unable to Load Templates!";
                echo "\n\tCode=".$this->MCAPI->errorCode;
                echo "\n\tMsg=".$this->MCAPI->errorMessage."\n";
        } else {
//        var_dump($retval);
                echo "Your templates:\n";
                foreach($retval['user'] as $tmpl){
                    echo $tmpl['id']." | ".$tmpl['name']." | ".$tmpl['layout']."\n";
                }
        }
    }
    
    function campaign_schedule(){
        
        $campaignId = 'f02521b4ff';
        
        $schedule_for = '2011-12-08 14:05:00';
        $retval = $this->MCAPI->campaignSchedule($campaignId, $schedule_for);

        if ($this->MCAPI->errorCode){
                echo "Unable to Schedule Campaign!";
                echo "\n\tCode=".$this->MCAPI->errorCode;
                echo "\n\tMsg=".$this->MCAPI->errorMessage."\n";
        } else {
                echo "Campaign Scheduled to be delivered $schedule_for!\n";
        }
    }
    
    function unsubscribe_batch(){
        $address1 = 'seishunheiki@gmail.com';
        $address2 = 'ladypaine2000@gmail.com';
        $listId = '2e3861cf16';
        $emails = array($address1,$address2);
        $delete = false; //don't completely remove the emails
        $bye = true; // yes, send a goodbye email
        $notify = false; // no, don't tell me I did this
        
        $vals = $this->MCAPI->listBatchUnsubscribe($listId, $emails, $delete, $bye, $notify);
        
        if ($this->MCAPI->errorCode){
	// an api error occurred
                echo "code:".$this->MCAPI->errorCode."\n";
                echo "msg :".$this->MCAPI->errorMessage."\n";
        } else {
                echo "success:".$vals['success_count']."\n";
                echo "errors:".$vals['error_count']."\n";
                foreach($vals['errors'] as $val){
                        echo "\t*".$val['email']. " failed\n";
                        echo "\tcode:".$val['code']."\n";
                        echo "\tmsg :".$val['message']."\n\n";
                }
        }
    }
    
    function subscribe_batch(){
        $batch[] = array('EMAIL'=>'seishunheiki@gmail.com', 'FNAME'=>'Jan Rei', 'LNAME'=>'Paulate');
//        $batch[] = array('EMAIL'=>'ladypaine2000@gmail.com', 'FNAME'=>'Cie', 'LNAME'=>'Armillos');
        $listId = '2e3861cf16';
        $optin = true; //yes, send optin emails
        $up_exist = true; // yes, update currently subscribed users
        $replace_int = false; // no, add interest, don't replace

        $vals = $this->MCAPI->listBatchSubscribe($listId,$batch,$optin, $up_exist, $replace_int);

        if ($this->MCAPI->errorCode){
            echo "Batch Subscribe failed!\n";
                echo "code:".$this->MCAPI->errorCode."\n";
                echo "msg :".$this->MCAPI->errorMessage."\n";
        } else {
                echo "added:   ".$vals['add_count']."\n";
                echo "updated: ".$vals['update_count']."\n";
                echo "errors:  ".$vals['error_count']."\n";
                foreach($vals['errors'] as $val){
                        echo $val['email_address']. " failed\n";
                        echo "code:".$val['code']."\n";
                        echo "msg :".$val['message']."\n";
                }}
    }
    
    
}
?>
