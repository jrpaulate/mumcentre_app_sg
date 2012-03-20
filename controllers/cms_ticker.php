<?php
class cms_ticker extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->helper(array('form', 'url'));
        $this->load->library('rb');
        $this->provider_ticker_path = $this->config->item('provider_ticker_gen_path');
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
                $this->media->smart_resize_image($json->{'file_path'}, 77, 34, false,
                        $this->provider_ticker_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".png":
                $this->media->smart_resize_image($json->{'file_path'}, 77, 34, false,
                        $this->provider_ticker_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".gif":
                $this->media->smart_resize_image($json->{'file_path'}, 77, 34, false,
                        $this->provider_ticker_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
        }
        
        echo $id . ".jpg";
    }
   
    
  
  
  

 
  
}
?>
