<?php

class Resource_Model extends CI_Model {
    
    function Resource_model() {                                                                                                  
        parent::__construct();
        $this->load->database();
    }

    function article($id, $title){
        $response["code"]=0;
        $response["id_get"] = $id;
        $sql = "
        SELECT
          id
        , article_title
    	, article_author
        , article_body
    	, article_image
        FROM
          article
        WHERE
          id = '$id' AND
          article_title = '$title'
        ";
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            $response["query"]=$query;

            return $response;
            
        } else {
            
            $query->free_result();

            $response["code"]=-1;
            $response["message"]="Such article doesn't exist.";
            return $response;
        }
    }
}
?>
