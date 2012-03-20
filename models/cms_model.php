<?php

class Cms_Model extends CI_Model {

  function Cms_model() {
    parent::__construct();
    $this->load->database();
  }

  function add_article($title, $author, $avatar, $summary, $article) {

    $response = array('code' => 0, 'message' => "");

    //check if article title already exists
    $sql = "
        SELECT
          id
        FROM
          article
        WHERE
          article_title = '" . $title . "'
        ";
    $query = $this->db->query($sql);

    if ($query->num_rows() > 0) {
      $query->free_result();

      //user name aleady exist
      $response["code"] = -1;
      $response["message"] = "Article title already exists.";
    } else {

      //insert data to artist table first
      $current_date = date('Y-m-d H:i:s');
      $data = array(
          'article_title' => $title,
          'article_author' => $author,
          'article_image' => $avatar,
          'article_summary' => $summary,
          'article_body' => $article,
          'status' => 0,
          'created_date' => $current_date
      );

      $this->db->insert('article', $data);

      $response["code"] = 0;
      $response["message"] = "Article creation successful!";
    }

    return $response;
  }

  function retrieve_articles() {
    $response = array('code' => 0, 'message' => "");

    $sql = "
    	SELECT
          id
      	, article_title
    	, article_author
        , article_body
    	, article_image
        , created_date
    	FROM
     	  article
        ORDER BY created_date DESC";

    $query = $this->db->query($sql);

    $response["query"] = $query;

    return $response;
  }

  function retrieve_article_only() {
    $response = array('code' => 0, 'message' => "");

    $sql = "
    	SELECT
          id
      	, title as article_title 
    	, author as article_author
        , body article_body
    	, image_filepath as article_image
        , created_date
    	FROM
     	  article
        ORDER BY created_date DESC
        LIMIT 1";

    $query = $this->db->query($sql);

    $response["query"] = $query;

    return $response;
  }

  function get_articles() {
    $response = array('code' => 0, 'message' => "");

    $sql = "
    	SELECT
          id
      	, title as article_title 
    	, author as article_author
        , body article_body
    	, image_filepath as article_image
        , created_date
    	FROM
     	  article
        ORDER BY created_date DESC
        LIMIT 1, 4";

    $query = $this->db->query($sql);

    $response["query"] = $query;

    return $response;
  }
  
  function get_tickers(){
      $response = array('code' => 0, 'message' => "");
      
     $sql = "
      SELECT 
      p.id,
      p.ticker as provider_ticker
    FROM 
    provider_profile AS p
    WHERE status = 1
    ORDER BY RAND()   
    ";
     
     $query = $this->db->query($sql);

    $response["query"] = $query;

    return $response;
  }

}

?>
