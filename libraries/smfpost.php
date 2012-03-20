<?php

class Smfpost {
	function create_post($subject, $body, $poster_email = "", $poster_id = 0, $board_id = 1, $msg_id = 0, $topic_id = NULL, $poster_name = "") {
		// Change when necessary'
		$smf_base_url = '/var/www/mumcentre_sg/forum';
		
		require_once($smf_base_url.'/SSI.php');
		
		$id = (int) $id;
		$poster_id = (int) $poster_id;
		
		$subject = htmlspecialchars(stripslashes($subject), ENT_QUOTES);
		$body = htmlspecialchars(stripslashes($body), ENT_QUOTES);
		
		$msgOptions = array(
			'id' => $msg_id,
			'subject' => $subject, // Required
			'body' => $body, // Required
			'icon' => 'xx',
			'time' => time(),
			'smileys_enabled' => true,
		);
		$topicOptions = array(
			'id' => $topic_id, // If no topic id is input then a new topic will be started.
			'board' => $board_id, //Required
			'mark_as_read' => true,
		);
		$posterOptions = array( 
			'id' => $poster_id,
			'name' => $poster_name,
			'email' => $poster_email,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'update_post_count' => true,
		);
		
		$sourcedir = $smf_base_url."/Sources";
		
		include_once($sourcedir . '/Subs-Post.php');
		$return = createPost($msgOptions, $topicOptions, $posterOptions);
		
		return $return;
	}
}


?>
