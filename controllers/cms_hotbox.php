<?php
class cms_hotbox extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
         $this->hotbox_image_path = $this->config->item('hotbox_image_gen_path');
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
        $this->bucket->set_content_id('cms/hotbox');
        $this->bucket->add_css('cms');
        $this->bucket->set_data('title', "Mumcentre CMS");
        $this->bucket->render_layout();
    }
    
    function add_hotbox() {
        $this->_check_logged();
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/cms_layout');
        $this->bucket->set_content_id('cms/add_hotbox');
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
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->member_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".png":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->member_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".gif":
                $this->media->smart_resize_image($json->{'file_path'}, 300, 250, false,
                        $this->member_image_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
        }
        
        echo $id . ".jpg";
    }
    
  function hotbox_list(){
      echo '{"hotbox_list": [{'.$this->_hotbox().'}]}';
    }
    
    private function _hotbox() {
        $sql="SELECT
          u.id
        , u.title
        , u.summary
        , u.status
        , u.image_filepath AS hotbox_image
        , u.country_id
        , u.created_date
        , c.name AS country_name
        FROM hotbox as u
        INNER JOIN country as c
        ON u.country_id = c.id
        WHERE u.status = '1'
        ORDER BY u.created_date DESC";
        
        $hotbox = R::getAll($sql);
        
        
        foreach ($hotbox as &$a) {
          if($a['status'] == 0) {
              $a['status'] = 'unpublished';
          } else {
              $a['status'] = 'published';
          } 
       
        }
    


    return '"hotbox":' . json_encode($hotbox);
    //echo $this->_json_response('featured_articles', $articles);
  }
  
  
  function unpublish($id){
        
        $hotbox = R::load('hotbox',$id);
      
        $hotbox->status = 0;

        $id = R::store($hotbox);
        
        $response['code'] = 0;
        $response['message'] = "Status Successfully Updated.";

        echo $response['code'] . ":" . $response['message'] ;  //echo "Band creation successful!";
    }
    
    
       function force_publish($id){
        
        $hotbox = R::load('hotbox',$id);
      
        $hotbox->status = 1;

        $id = R::store($hotbox);
        
        $response['code'] = 0;
        $response['message'] = "Status Successfully Updated.";

        echo $response['code'] . ":" . $response['message'] ;  //echo "Band creation successful!";
    }
    
    
    
     function force_delete($id){
        
        $hotbox = R::load('hotbox',$id);
   
        
        $id = R::trash($hotbox);
        
        $response['code'] = 0;
        $response['message'] = "Status Successfully Updated.";

        echo $response['code'] . ":" . $response['message'] ;  //echo "Band creation successful!";
    }
    
    
    
      
  function hotboxunpub_list(){
      echo '{"hotboxunpub_list": [{'.$this->_hotboxunpub().'}]}';
    }
    
    private function _hotboxunpub() {
        $sql="SELECT
          u.id
        , u.title
        , u.summary
        , u.status
        , u.image_filepath AS hotbox_image
        , u.country_id
        , u.created_date
        , c.name AS country_name
        FROM hotbox as u
        INNER JOIN country as c
        ON u.country_id = c.id
        WHERE u.status = '0'
        ORDER BY u.created_date DESC";
        
        $hotboxunpub = R::getAll($sql);
        
        
        foreach ($hotboxunpub as &$a) {
          if($a['status'] == 0) {
              $a['status'] = 'unpublished';
          } else {
              $a['status'] = 'published';
          } 
       
        }
    


    return '"hotboxunpub":' . json_encode($hotboxunpub);
   
  }
    
    
}
?>
