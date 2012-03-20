<?php

class child_avatar extends CI_Controller {
    
    
   function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->library('rb');
        $this->load->library('session');
        $this->load->library('mcapi');
        $this->load->library('common');
        $this->load->library('mcox');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('miscfuncs');
        $this->avatar_path = $this->config->item('user_avatar_gen_path');

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
                        $this->avatar_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".png":
                $this->media->smart_resize_image($json->{'file_path'}, 212, 235, false,
                        $this->avatar_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
            case ".gif":
                $this->media->smart_resize_image($json->{'file_path'}, 212, 235, false,
                        $this->avatar_path . $id . ".jpg", false, false);
                $data['media'] = "media/thumb/" . $id . ".jpg";
                $data['media_type'] = "image";

                break;
        }
        


        echo $id . ".jpg";
    }
    
    
    
    
        function create_child() {

        $child = R::dispense("user_children");
       
        
        $child->name = $this->input->post('child_name');
        
        $child->birth_date = $this->input->post('birth_date');
        $child->gender = $this->input->post('gender');
        
        $child->avatar_filepath = $this->input->post('avatar');
        $child->parent_id = $this->input->post('user_id');
        
       
        $id = R::store($child);
        
     
        $response['code'] = 0;
        $response['message'] = "Child Successfully Added.";

        echo $response['code'] . ":" . $response['message'] ;  
    }
    
    
    
    
    
        function update_profile($id) {
  
        $user = R::load('user',$id);
        $user->birth_date = $this->input->post('birth_date');
        $user->gender = $this->input->post('gender');
        $user->avatar_filepath = $this->input->post('avatar');
        $user->landline = $this->input->post('landline');
        $user->celphone = $this->input->post('celphone');
        $user->country = $this->input->post('country');
        $user->biography = $this->input->post('biography');
        $user->hobbies = $this->input->post('hobbies');
        $user->occupation = $this->input->post('occupation');
        
        
        $user->modified_by_id = 0;
        $user->modified_date = date("Y-m-d H:i:s");
        $id = R::store($user);
        
        $response['code'] = 0;
        $response['message'] = "Profile Successfully Updated.";

        echo $response['code'] . ":" . $response['message'] ;  //echo "Band creation successful!";
    }   
    
        function update_child() {
        
        $id = $this->input->post('child_id');
        
        $child = R::load('user_children',$id);
        $child->name = $this->input->post('name');
        $child->gender = $this->input->post('gender');
        $child->avatar_filepath = $this->input->post('avatar');
        $child->birth_date = $this->input->post('bday');
        
        R::store($child);
        
        $response['code'] = 0;
        $response['message'] = "Child information updated.";

        echo $response['code'] . ":" . $response['message'] ;  //echo "Band creation successful!";
    }
    
    
}  
    

?>
