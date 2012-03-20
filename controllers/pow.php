<?php

class Pow extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('common');
        $this->load->helper('url');
        $this->load->library('rb');
        $this->load->library('mcox');

        $this->load->model('Pow_model', 'pow');
        $this->load->helper('miscfuncs');
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->add_css('mums');
        $this->bucket->add_css('athan');
        $this->bucket->add_css('pow');
        $this->bucket->add_css('pow-v2');
        $this->bucket->add_css('april_pow');

        $this->mrec1 = $this->_generateTags(45);
        $this->mrec2 = $this->_generateTags(46);
        $this->mrec3 = $this->_generateTags(63);
        $this->mrec4 = $this->_generateTags(112);
        $this->mrec5 = $this->_generateTags(113);
        $this->mrec6 = $this->_generateTags(114);

        $this->mini_ad1 = $this->_generateTags(41);
        $this->mini_ad2 = $this->_generateTags(42);
        $this->mini_ad3 = $this->_generateTags(43);

        $this->featban = $this->_generateTags(27);

        $this->data = array();
        $this->data['activenav'] = "vote";
        $this->load->library('mcox');

        //$this -> data['error'] = $this -> pow -> __checklist();
    }

    function index() {
        redirect('pow/home');
        //return $this->enter();
    }

    /* pow_home added by John Ray design by April */

    function home() {
        $this->data['activenav'] = "home";
        $this->data['results'] = $this->pow->contest_latest_winners();
            if (!$this->data['results']) {
                return $this->_no_contest_concluded();
            }
        $this->load->library('bucket');
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('pow/pow_home');

//        $this->bucket->set_data('age_group', "Pregnancy");

        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);

        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        $this->bucket->set_data('title', 'Mumcentre - Pic of the Week');
        $data = $this->data;
        $this->bucket->set_data('data', $data);
        $this->bucket->render_layout();
    }

    private function __check_session() {
        if ($this->session->userdata('logged_in') == TRUE)
            $this->data['user_id'] = $this->session->userdata('user_id');
        else
            redirect('pow');

        return true;
    }

    /////////////////////////////////
    /// POW ENTRY - JOIN

    /**
     *
     */
    function join() {
        // check the user session
        $this->__check_session();
        $this->data['activenav'] = "join";

        $contest_info = $this->pow->contest_active_get(ACTIVESUBMIT_CONTEST);

        if (!$contest_info) {
            return $this->_no_contest_forsubmit();
        }

        $contest_info = is_array($contest_info) ? array_shift($contest_info) : false;
        $category_list = ($contest_info) ? $this->pow->contest_categories_list($contest_info['id']) : false;

        if (!@issetNE($_POST)) {

            $this->data['token_id'] = md5(implode('#', array(generate_random(20, 'ALPHANUM'), input_datetime('now'))));

            if (empty($contest_info)) {
                $this->bucket->set_content_id('pow/pow_emptycontest');
            } else {
                $this->bucket->set_content_id('pow/pow_enter_ajax');
            }

            $this->data['contest_info'] = $contest_info;
            $this->data['category_list'] = $category_list;
            $this->data['upload_path'] = $this->pow->options['upload_path'];

            $data = $this->data;
            $this->bucket->set_data('data', $data);
            $this->bucket->set_data('title', "Mumcentre");
            $this->bucket->set_data('mrec1', $this->mrec1);
            $this->bucket->set_data('mrec2', $this->mrec2);
            $this->bucket->set_data('mrec3', $this->mrec3);
            $this->bucket->set_data('mrec4', $this->mrec4);
            $this->bucket->set_data('mrec5', $this->mrec5);
            $this->bucket->set_data('mrec6', $this->mrec6);

            $this->bucket->set_data('mini_ad1', $this->mini_ad1);
            $this->bucket->set_data('mini_ad2', $this->mini_ad2);
            $this->bucket->set_data('mini_ad3', $this->mini_ad3);

            $this->bucket->set_data('featban', $this->featban);
            $this->bucket->render_layout();
        } else {
            $postdata = $_POST;
            $postdata['user_id'] = $this->data['user_id'];
            $isallowed = true;

            $user_entries = $this->pow->contest_userentries_list($this->data['user_id'], $contest_info['id']);
            if (!empty($user_entries)) {
                foreach ($user_entries as $row) {
                    if ($row['pow_category_id'] == $postdata['pow_category_id'])
                        $isallowed = false;
                }
            }
            if (!$isallowed) {
                return $this->_duplicate_entry();
            }
            if ("true" == @issetVal($this->pow->options['use_ajax_uploader'])) {
                $postdata = $this->_join_ajaxupload_process($postdata);
            }

            // actually add the entry
            $resp = $this->pow->entry_add($postdata['pow_category_id'], $postdata, true);

            // notify the subscriber
            if ($resp < 0) {
                echo json_encode($resp);
                exit();
            }

            // $this->pow->email_log("system","user", "upload_image" , input_datetime('now'), "added to entries");
            $this->__add_tomy_entries($resp['data']['token_id']);

            redirect("pow/join_success/" . $resp['data']['token_id']);
        }
    }

    function join_success($token_id = false) {
        $this->data['activenav'] = "join";

        $ck_token = $this->__is_owner($token_id);
        if (!$token_id && !!$ck_token) {
            redirect("pow/entry_share/{$ck_token}");
        }

        if (!$token_id || !$ck_token || $ck_token !== $token_id)
            redirect('pow/');

        $token_id = $ck_token;

        $this->data['entry_info'] = $this->pow->entry_get_bytoken($token_id);

        $this->bucket->set_content_id('pow/pow_join_success');

        $this->bucket->add_css('mums');
        $this->bucket->add_css('athan');
        $this->bucket->add_css('pow');

        /*
          $this -> data['_list'] = $this -> pow -> categories_getall();
          $this -> data['activecontest'] = $this -> pow -> contest_getactive();
          $this -> data['entry_info'] = $this -> pow -> entry_get_bytoken($token_id);

          $this -> data['contest_entries'] = array();
          $this -> data['agegroup_list'] = $this -> pow -> agegroup_getall();
          $this -> data['agegroup_id'] = @issetVal($agegroup_id, $this -> data['agegroup_list'][0]['id']);
          $this -> data['agegroup_info'] = $this -> pow -> agegroup_get($this -> data['agegroup_id']);
         */

        $data = $this->data;
        $this->bucket->set_data('data', $data);
        $this->bucket->set_data('title', "Mumcentre");

        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);

        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        $this->bucket->render_layout();
    }

    /**
     *
     */
    private function _join_ajaxupload_process($postdata) {

        $target_path = $this->pow->__entry_photopath($postdata);
        $target_path .= '/' . $postdata['img_filename'];

        // crop the image
        $cropped_filename = 'cropped-' . $postdata['img_filename'];
        $cropped_image = $this->pow->__entry_photopath($postdata) . '/' . $cropped_filename;
        cropImage($target_path, $cropped_image, $postdata['img-wd'], $postdata['img-ht'], $postdata['img-x1'], $postdata['img-y1']);
        $postdata['img_filename'] = $cropped_filename;

        // create thumnails
        $this->pow->entry_photo_createthumbnails($postdata['img_filetype'], $this->pow->__entry_photopath($postdata), $postdata['img_filename']);

        $postdata['photo_filename'] = $postdata['img_filename'];
        $postdata['image_type'] = $postdata['img_filetype'];
        $postdata['created_date'] = input_datetime('now');

        return $postdata;
    }

    function join_ajaxupload() {
        // check the user session
        $this->__check_session();

        $postdata = array('token_id' => $this->input->post('token_id'), 'pow_category_id' => $this->input->post('pow_category_id'));
        $json = array();

        // Configure Upload class
        $target_path = $this->pow->__entry_photopath($postdata);
        if (!is_dir($target_path)) {
            if (mkdir($target_path, 0777, true) === FALSE) {// try to create the dir
                $json['status'] = 'error';
                $json['issue'] = "Unable to create directory $target_path";
                echo json_encode($json);
                exit;
            }
        }

        $config['upload_path'] = $target_path;
        $config['allowed_types'] = $this->pow->options_get('allowed_imagetypes');
        $config['max_size'] = $this->pow->options_get('upload_max_kb');
        $config['max_width'] = $this->pow->options_get('upload_max_width');
        $config['max_height'] = $this->pow->options_get('upload_max_height');

        $this->load->library('upload', $config);

        // Output json as response
        if (!$this->upload->do_upload()) {
            $json['status'] = 'error';
            $json['issue'] = $this->upload->display_errors('', '');
        } else {
            $json['status'] = 'success';
            foreach ($this->upload->data() as $k => $v) {
                $json[$k] = $v;
            }
        }
        // create a
        $thumbname640 = createThumbnail($json['file_type'], $json['file_path'], $json['file_name'], 640);

        // copy the original as orig.filename
        copy("{$json['file_path']}/{$json['file_name']}", "{$json['file_path']}/orig.{$json['file_name']}");
        copy("{$json['file_path']}/{$thumbname640}", "{$json['file_path']}/{$json['file_name']}");
        $json['file_size'] = filesize($json['full_path']);

        if (function_exists('getimagesize')) {
            list($width, $height, $type, $attr) = getimagesize($json['full_path']);
            $json['image_height'] = $height;
            $json['image_width'] = $width;
            $json['image_size_str'] = "width=\"{$width}\" height=\"{$height}\"";
        }

        echo json_encode($json);
    }

    private function __add_tomy_entries($token_id) {
        // write to cookie
        $ent = json_decode(@issetVal($_COOKIE['ent']));
        $ent = !is_array($ent) ? array() : $ent;
        $ent[] = $token_id;
        $this->session->set_userdata('userentries', json_encode($ent));
    }

    private function __is_owner($token_id = false) {
        if (!$token_id)
            return false;
        $ent = json_decode($this->session->userdata('userentries'));
        $ent = !is_array($ent) ? array() : $ent;

        return in_array($token_id, $ent) ? $token_id : false;
    }

    function myentries($contest_id = 0) {
        $this->__check_session();
        $this->data['activenav'] = "vote";

        if (!$contest_id) {
            $this->data['contest_info'] = $this->pow->contest_getactive();
            $contest_id = $this->data['contest_info']['id'];
        } else {
            $this->data['contest_info'] = $this->pow->contest_get($contest_id);
        }

        if (!$this->data['contest_info']) {
            redirect('pow');
        }

        // get all the user entries
        $this->data['contest_entries'] = $this->pow->entries_getall_byuser_countpoints($this->data['user_id']);

        $this->bucket->set_content_id('mumcentre/pow_myentries');

        $this->bucket->add_css('scrollable-horizontal');
        $this->bucket->add_css('scrollable-buttons');
        //        $this->bucket->add_css('style');

        $data = $this->data;
        $this->bucket->set_data('data', $data);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        $this->bucket->render_layout();
    }

    /**
     * gets all the entries for the pow
     */
    function entries($category_name = 0) {
        $this->bucket->set_content_id('pow/pow_entries');
        $this->data['activenav'] = "vote";
        $contest_info = $this->pow->contest_active_get(ACTIVEVOTING_CONTEST);

        $contest_info = $contest_info ? array_shift($contest_info) : false;
        if (!$contest_info) {
            return $this->_no_contest_forvote();
        }
        $category_id = false;
        if ($category_name) {
            $category = $this->pow->category_getbyurlname(urldecode($category_name), $contest_info['id']);
            $category_id = $category['id'];
        }

        $category_list = ($contest_info) ? $this->pow->contest_categories_list($contest_info['id']) : false;

        if (!$category_id) {
            $category_id = @issetVal($category_list[0]['id']);
        }
        $category_info = $category_id ? $this->pow->category_get($category_id) : false;

        $this->data['contest_info'] = $contest_info;
        $this->data['category_list'] = $category_list;
        $this->data['category_id'] = $category_id;
        $this->data['category_info'] = $category_info;

        if (@issetNE($contest_info['id'])) {
            $this->data['contest_entries'] = $this->pow->contest_entriesall($contest_info['id'], $category_id, APPROVED_ENTRY);
        } else {
            $this->data['contest_entries'] = false;
        }

        $this->bucket->add_css('scrollable-horizontal');
        $this->bucket->add_css('scrollable-buttons');

        $data = $this->data;
        $this->bucket->set_data('data', $data);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        $this->bucket->render_layout();
    }

    function entry($token_id = false) {
        $this->data['activenav'] = "vote";

        if (!$token_id)
            redirect('pow/entries');

        $this->bucket->set_content_id('pow/pow_view');
        $this->data['entry_info'] = $this->pow->contest_entry_bytokenid($token_id);

        $this->data['contest_entries'] = $this->pow->contest_entriesall($this->data['entry_info']['contest_id'], $this->data['entry_info']['category_id'], APPROVED_ENTRY);
        $this->data['category_info'] = $this->pow->category_get($this->data['entry_info']['category_id']);

        $this->data['upload_path'] = $this->pow->options['upload_path'];
        $this->data['category_id'] = $this->data['entry_info']['category_id'];
        $this->data['category_list'] = $this->pow->contest_categories_list($this->data['entry_info']['contest_id']);

        $this->bucket->add_css('scrollable-horizontal');
        $this->bucket->add_css('scrollable-buttons');
        //        $this->bucket->add_css('style');

        $data = $this->data;
        $this->bucket->set_data('data', $data);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        $this->bucket->render_layout();
    }

    function vote($token_id = false) {
        $this->data['activenav'] = "vote";
        if (!$token_id)
            redirect('pow/entries');

        $this->bucket->set_content_id('pow/pow_vote');
        $this->bucket->set_data('title', "Mumcentre");

        $this->data['entry_info'] = $this->pow->contest_entry_bytokenid($token_id);
        $this->data['contest_entries'] = $this->pow->contest_entriesall($this->data['entry_info']['contest_id']);
        $this->data['category_info'] = $this->pow->category_get($this->data['entry_info']['category_id']);

        $this->data['upload_path'] = $this->pow->options['upload_path'];

        if ($this->session->userdata('user_id')) {
            $userdata = $this->pow->user_get($this->session->userdata('user_id'));
            $this->data['email_address'] = $userdata['email_address'];
        }

        $this->data['email_address'] = @issetVal($_POST['email_address'], $this->data['email_address']);
        $resp = $this->pow->vote_entry($token_id, $this->data['email_address']);
        $this->data['has_error'] = false;

        if ($resp['code'] < 0) {
            if (!empty($this->data['email_address'])) {
                $this->data['has_error'] = true;
                $this->data['error_message'] = $resp['message'];
            }

            $data = $this->data;
            $this->bucket->set_data('data', $data);
            $this->bucket->render_layout();
        } else {
            if ($this->session->userdata('logged_in')) {
                redirect("pow/votesuccess/{$token_id}");
            } else {
                redirect("pow/verifyvote/{$token_id}");
            }
        }
    }

    function fetch_contact() {
        if (empty($_POST))
            return false;

        $provider = $this->input->post('provider');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $resp = $this->pow->fetch_contact($provider, $username, $password);

        echo json_encode($resp);
    }

    function verifyvote($token_id = false) {
        if (!$token_id)
            redirect('pow/');

        $this->data['activenav'] = "vote";
        $this->bucket->set_content_id('pow/pow_vote_verify');
        $this->bucket->set_data('title', "Mumcentre");

        $this->data['entry_info'] = $this->pow->contest_entry_bytokenid($token_id);
        $this->data['contest_entries'] = $this->pow->contest_entriesall($this->data['entry_info']['contest_id']);
        $this->data['category_info'] = $this->pow->category_get($this->data['entry_info']['category_id']);

        if (!$this->data['entry_info'])
            redirect('pow/entries');

        $this->data['vote_code'] = @issetVal($_POST['vote_code'], false);
        $resp = $this->pow->vote_code_verify($this->data['vote_code']);

        if ($resp['code'] < 0) {
            if (!empty($this->data['vote_code'])) {
                $this->data['error'][] = $resp['message'];
            }

            $data = $this->data;
            $this->bucket->set_data('data', $data);
            $this->bucket->render_layout();
        } else {
            redirect("pow/votesuccess/{$token_id}");
        }
    }

    function votesuccess($token_id) {
        $this->data['activenav'] = "vote";

        if (!$token_id)
            redirect('pow/entries');

        $this->bucket->set_content_id('pow/pow_vote_success');
        $this->bucket->set_data('title', "Mumcentre");

        $this->data['entry_info'] = $this->pow->contest_entry_bytokenid($token_id);
        $this->data['contest_entries'] = $this->pow->contest_entriesall($this->data['entry_info']['contest_id']);
        $this->data['category_info'] = $this->pow->category_get($this->data['entry_info']['category_id']);

        if (!$this->data['entry_info'])
            redirect('pow/entries');

        $data = $this->data;
        $this->bucket->set_data('data', $data);
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        $this->bucket->render_layout();
    }

    function entry_getphoto($token_id = 0, $size = false) {
        if (!$token_id)
            return false;
        list($photo, $type, $path) = $this->pow->entryphoto_get($token_id, $size);
        $imgurl = sprintf("/%s/%s/%s", $this->pow->options['upload_path'], $token_id, $photo);
        echo $imgurl;
    }

    function winners($category_name = false) {
        $this->data['activenav'] = "winners";

        if (!$category_name) {
            $this->data['results'] = $this->pow->contest_latest_winners();
            $this->data['results_all'] = $this->pow->contest_winnersall();
            if (!$this->data['results']) {
                return $this->_no_contest_concluded();
            }

            $this->bucket->set_layout_id('mumcentre/desktop');
            $this->bucket->set_content_id('pow/pow_latest_winners');
        } else {
            $category = $this->pow->category_getbyurlname(urldecode($category_name));
            $category_id = $category['id'];

            $this->data['results'] = $this->pow->contest_latest_winners($category_id);
            $this->data['results_all'] = $this->pow->contest_winnersall($category_id);

            /*
              $this -> data['results'] = array_shift($this -> pow -> results_getlatest($agegroup));
              $this -> data['entry_info'] = $this -> pow -> entry_get_bytoken($this -> data['results']['token_id']);
              $this -> data['pastwinners'] = $this -> pow -> results_getwinners_all($pow_category_id);
             */
            $this->bucket->set_layout_id('mumcentre/desktop');
            $this->bucket->set_content_id('pow/pow_category_winner');
        }

        $data = $this->data;
        $this->bucket->set_data('data', $data);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        $this->bucket->render_layout();
    }

    function about() {
        $this->data['activenav'] = "about";
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('pow/pow_about');

        $data = $this->data;
        $this->bucket->set_data('data', $data);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        $this->bucket->render_layout();
    }

    function error($errmsg) {
        echo "There are current errors: ";
    }

    private function _duplicate_entry() {
        $this->data['activenav'] = "join";
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('pow/pow_blank');
        $this->data['content'] = $this->pow->options_get('message_duplicate_entry');

        $data = $this->data;
        $this->bucket->set_data('data', $data);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        $this->bucket->render_layout();
    }

    private function _no_contest_forsubmit() {
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('pow/pow_blank');
        $this->data['content'] = $this->pow->options_get('message_nosubmission_contest');

        $data = $this->data;
        $this->bucket->set_data('data', $data);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        $this->bucket->render_layout();
    }

    private function _no_contest_forvote() {
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('pow/pow_blank');
        $this->data['content'] = $this->pow->options_get('message_novoting_contest');

        $data = $this->data;
        $this->bucket->set_data('data', $data);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->render_layout();
    }

    private function _no_contest_concluded() {
        $this->bucket->set_layout_id('mumcentre/desktop');
        $this->bucket->set_content_id('pow/pow_blank');
        $this->data['content'] = $this->pow->options_get('message_noconcluded_contest');

        $data = $this->data;
        $this->bucket->set_data('data', $data);
        $this->bucket->set_data('title', "Mumcentre");
        $this->bucket->set_data('mrec1', $this->mrec1);
        $this->bucket->set_data('mrec2', $this->mrec2);
        $this->bucket->set_data('mrec3', $this->mrec3);
        $this->bucket->set_data('mrec4', $this->mrec4);
        $this->bucket->set_data('mrec5', $this->mrec5);
        $this->bucket->set_data('mrec6', $this->mrec6);
        
        $this->bucket->set_data('mini_ad1', $this->mini_ad1);
        $this->bucket->set_data('mini_ad2', $this->mini_ad2);
        $this->bucket->set_data('mini_ad3', $this->mini_ad3);

        $this->bucket->set_data('featban', $this->featban);
        $this->bucket->render_layout();
    }

//  function description($id) {
//        echo '{"pow_categories": [{' . $this->_description($id) . '}]}';
//    }

    function description($id) {

        $sql = "SELECT
           id, description FROM pow_contest_category
        WHERE id = " . $id;

        $entries = R::getRow($sql);
//    foreach ($entries as &$entry) {
//        $entry['review_summary'] = $this->_trimReview($entry['review_summary']);
//    }
//        return '"pow_category":' . json_encode($entries);
        echo $entries['description'];
    }

    function search_contest($id, $code) {
        echo '{"results": [{' . $this->_search_contest($id, $code) . '}]}';
    }

    private function _search_contest($id, $code) {
        if ($id != 0) {
            $plus = "WHERE contest.id = " . $id;
        } else {
            $plus = "WHERE country.code = '" . $code . "' ORDER BY contest.created_date DESC";
        }
        $sql = "SELECT
          contest.*
        , pow_country.country_id
        , status.name as status_name
        FROM pow_contest AS contest
        INNER JOIN status ON contest.status = status.id AND status.type='pow_contest'
        INNER JOIN pow_contest_country as pow_country ON contest.id = pow_country.contest_id
        INNER JOIN country ON pow_country.country_id = country.id
        "
        ;
        $sql .= $plus;
        $reviews = R::getAll($sql);

        foreach ($reviews as &$r) {
            $r['submission_start_date'] = out_date($r['submission_start_date'], 'm/d/Y g:i:s A');
            $r['submission_end_date'] = out_date($r['submission_end_date'], 'm/d/Y g:i:s A');
            $r['voting_start_date'] = out_date($r['voting_start_date'], 'm/d/Y g:i:s A');
            $r['voting_end_date'] = out_date($r['voting_end_date'], 'm/d/Y g:i:s A');
            $r['created_date'] = out_date($r['created_date'], 'm/d/Y g:i:s A');
            $r['modified_date'] = out_date($r['modified_date'], 'm/d/Y g:i:s A');
            if ($r['status_name'] == "activevoting") {
                $r['active'] = true;
                $r['active_voting'] = true;
                $r['status_definition'] = "Active for Voting";
            } else if ($r['status_name'] == "activesubmit") {
                $r['less_active'] = true;
                $r['active'] = true;
                $r['active_submit'] = true;
                $r['status_definition'] = "Active for Submission";
            } else if ($r['status_name'] == "inactive") {
                $r['less_active'] = true;
                $r['inactive'] = true;
                $r['status_definition'] = "Pending Contest";
            } else if ($r['status_name'] == "published") {
                $r['published'] = true;
                $r['status_definition'] = "Published Contest";
            } else if ($r['status_name'] == "concluded") {
                $r['concluded'] = true;
            } else {
                $r['archived'] = true;
            }
        }

        return '"result":' . json_encode($reviews);
    }

    private function _generateTags($zoneId) {
        $ajs = "http://50.19.248.24/openx/www/delivery/ajs.php";
        $loc = urlencode(current_url());
        $cb = rand(0, 99999999999);
        return '<script type="text/javascript" src="' . $ajs . '?zoneid=' . $zoneId .
        '&amp;cb=' . $cb . '&amp;charset=ISO-8859-1&amp;loc=' . $loc . '"></script>';
    }

}

?>
