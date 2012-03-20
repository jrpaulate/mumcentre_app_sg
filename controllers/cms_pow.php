<?php

class cms_pow extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this -> load -> library('common');
    $this -> load -> model('Pow_model', 'pow');
    $this -> load -> helper('url');
    $this -> load -> library('rb');

    $this -> load -> library('bucket');
    $this -> bucket -> set_layout_id('mumcentre/cms_powlayout');
    $this -> bucket -> add_css('cms');
    $this -> bucket -> add_css('pow-v2');
    $this -> bucket -> add_css('sorter');

    $this -> data = array("error" => array());
    $this -> data['error'] = $this -> pow -> __checklist();
    $this -> data['country_list'] = $this -> pow -> country_list();

    $this -> data['__pow_version'] = $this -> pow -> options_get('__current_version');
    $this -> data['__current_version'] = $this -> pow -> __current_version();
    $this -> load -> library('mcox');
    
    $this -> _check_logged();
  }

  private function _check_logged() {
    if ($this -> session -> userdata('cms_logged_in') != TRUE) {
      redirect('cms/login', 'refresh');
    }
  }

  function upgrade_to_latest() {
    $this -> pow -> __check_for_upgrades();
  }

  function index() {
    $this -> _check_logged();
    return $this -> contest();
  }

  function dashboard() {
    $this -> bucket -> set_content_id('cmspow/dashboard');

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> set_data('title', "Mumcentre CMS Pick of the Week");

    $this -> bucket -> render_layout();

    return false;
  }

  function entry($cmd = false, $id = false) {
    switch ($cmd) {
      case 'edit' :
        return $this -> _entry_edit($id);
        break;
      case 'votes' :
        return $this -> _entry_votes($id);
        break;        
      case 'vote_delete' :
        return $this -> _entry_vote_delete();
        break;        
      case 'moveto' :
        return $this -> _move_to($id);
        break;
      default :
        break;
    }
  }

  function entry_imagerotate() {
    $entry_id = @issetVal($_POST['entry_id']);
    $angle = @issetVal($_POST['angle']);
    if (!$entry_id || !$angle)
      return false;

    $info = $this -> pow -> entry_get($entry_id);
    $root_path = realpath($this -> config -> config['root_path']);
    $entry_path = realpath($root_path . "/" . $this -> pow -> options['upload_path']);

    $this -> pow -> entry_photo_rotate("$entry_path/{$info['token_id']}", $info['photo_filename'], $angle);
  }

  private function _entry_edit($id) {
    $this -> data['entry_info'] = $this -> pow -> entry_get($id);
    if (!@issetNE($_POST)) {
      $this -> bucket -> set_content_id('cmspow/entry_edit');

      $data = $this -> data;
      $this -> bucket -> set_data('data', $data);

      $this -> bucket -> render_layout();
    } else {
      $_POST['token_id'] = $this -> data['entry_info']['token_id'];
      $resp = $this -> pow -> entry_edit($id, $_POST);
      echo json_encode($resp);
      exit();
    }
  }

  private function _move_to() {
    if (@issetNE($_POST)) {
      $id = @issetVal($_POST['id']);
      $categid = @issetVal($_POST['categid']);
      $entryinfo = $this -> pow -> entry_get($id);

      $data = array('id' => $id, 'pow_category_id' => $categid, 'token_id' => $entryinfo['token_id']);
      $resp = $this -> pow -> entry_edit($id, $data);
      echo json_encode($resp);
      exit();
    }
  }

  function contest($cmd = 'list', $id = false, $categoryid = false) {
    switch ($cmd) {
      case 'list' :
        return $this -> _contest_list($id);
        break;
      case 'create' :
        return $this -> _contest_create($id);
        break;
      case 'copy' :
        return $this -> _contest_copy();
        break;
      case 'edit' :
        return $this -> _contest_edit($id);
        break;
      case 'categories' :
        return $this -> _category_list($id);
        break;
      case 'entries' :
        return $this -> _entry_list($id, $categoryid);
        break;
      case 'forsubmission' :
        return $this -> _forsubmission($id);
      case 'forvoting' :
        return $this -> _forvoting($id);
      case 'conclude' :
        return $this -> _conclude($id, $categoryid);
      case 'publish' :
        return $this -> _publish($id, $categoryid);
      case 'winners' :
        return $this -> _winners($id, $categoryid);
      default :
        return false;
        break;
    }
  }

  function get_pending_contest() {
    $this -> pow -> contest_getpending();

  }

  private function _forsubmission($id) {
    // check for currently forsubmission contest
    $resp = $this -> pow -> contest_activate_submission($id);
    echo $resp['message'];

    echo '<p><a href="' . $_SERVER['HTTP_REFERER'] . '"> Click here to go back</a></p>';
  }

  private function _forvoting($id) {
    // check for currently forsubmission contest
    $resp = $this -> pow -> contest_activate_voting($id);
    echo $resp['message'];

    echo '<p><a href="' . $_SERVER['HTTP_REFERER'] . '"> Click here to go back</a></p>';
  }

  private function _conclude($id) {
    // check for currently forsubmission contest
    $resp = $this -> pow -> contest_conclude($id);
    echo $resp['message'];

    echo '<p><a href="' . $_SERVER['HTTP_REFERER'] . '"> Click here to go back</a></p>';
  }

  private function _publish($id) {
    // check for currently forsubmission contest
    $resp = $this -> pow -> contest_published($id);
    echo $resp['message'];

    echo '<p><a href="' . $_SERVER['HTTP_REFERER'] . '"> Click here to go back</a></p>';
  }

  private function _winners($contest_id = false, $category_id = false) {
    if (!$contest_id)
      return false;

    $this -> bucket -> set_content_id('cmspow/conclude_entries');
    $this -> data['entry_list'] = $this -> pow -> contest_winnersall($contest_id, $category_id);
    $this -> data['category_list'] = $this -> pow -> contest_categories_list($contest_id);
    $this -> data['contest_info'] = $this -> pow -> contest_get($contest_id);
    $this -> data['contest_id'] = $contest_id;
    $this -> data['category_id'] = $category_id;
    $this -> data['message'] = $this -> pow -> emailfields_values();

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> set_data('title', "Mumcentre CMS Pick of the Week");

    $this -> bucket -> render_layout();
  }

  private function _contest_list($cc = CC_CODE) {
    $cc = $cc ? $cc : CC_CODE;

    $this -> bucket -> set_content_id('cmspow/contest_list');
    $this -> data['contest_list'] = $this -> pow -> contest_list(array('country.code' => $cc), 
    array('status_name' => 'ASC', 'submission_start_date' => 'ASC', 'voting_start_date' => 'ASC'));
    $this -> data['country_list'] = $this -> pow -> country_list();
    $this -> data['CC'] = $cc;
    
    $this -> data['error'] = $this -> pow -> __checklist();

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);

    $this -> bucket -> render_layout();
  }

  private function _contest_create($id = 0) {

    if ($id) {
      $this -> data['contest_info'] = $this -> pow -> contest_get($id);
    }

    if (!@issetNE($_POST)) {
      $this -> bucket -> set_content_id('cmspow/contest_create');
      $data = $this -> data;
      $this -> bucket -> set_data('data', $data);

      $this -> bucket -> render_layout();
    } else {

      $resp = $this -> pow -> contest_create($_POST);
      echo json_encode($resp);
      exit();
    }
  }

  private function _contest_copy() {
    $ids = explode(",", $_POST['ids']);
    $ccid = @issetVal($_POST['ccid']);
    if (!$ids)
      return false;

    $resp = $this -> pow -> contest_duplicate_many($ids, $ccid);

    echo json_encode($resp);
    exit();
  }

  private function _contest_edit($id = 0) {
    if (!$id)
      redirect('cms_pow/contest_list');

    $this -> data['contest_info'] = $this -> pow -> contest_get($id);
    $this -> data['conteststatus_list'] = $this -> pow -> status_get('pow_contest');

    if (!$this -> data['contest_info'])
      redirect('cms_pow/contest');

    if (!@issetNE($_POST)) {
      $this -> bucket -> set_content_id('cmspow/contest_edit');
      $data = $this -> data;
      $this -> bucket -> set_data('data', $data);
      $this -> bucket -> render_layout();
    } else {
      $resp = $this -> pow -> contest_edit($id, $_POST);
      echo json_encode($resp);
      exit();
    }

  }

  private function _entry_list($contest_id = false, $category_id = false) {
    if (!$contest_id)
      return false;

    $this -> bucket -> set_content_id('cmspow/entry_list');
    $this -> data['entry_list'] = $this -> pow -> contest_entriesall($contest_id, $category_id);
    $winners = $this -> pow -> contest_winners($contest_id);
    $winning_ids = array();
    foreach ($winners as $ent) {
      $winning_ids[] = $ent['pow_entry_id'];
    }
    $this -> data['winning_ids'] = $winning_ids;
    $this -> data['category_list'] = $this -> pow -> contest_categories_list($contest_id);
    $this -> data['contest_info'] = $this -> pow -> contest_get($contest_id);
    $this -> data['contest_id'] = $contest_id;
    $this -> data['category_id'] = $category_id;

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);

    $this -> bucket -> render_layout();
  }
  
  private function _entry_votes($entry_id=false){
    if (! $entry_id ) return false;
    
    $this -> bucket -> set_content_id('cmspow/entryvote_list');
    $this->data['entry_info'] = $this->pow->entry_get_complete_byid($entry_id);
    $this->data['vote_list'] = $this->pow->entry_votes_getall($entry_id);

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> render_layout();
    
  }
  private function _entry_vote_delete(){
    $vote_id = @issetVal($_POST['id']);
    if (!$vote_id || !@issetNE($_POST))
      redirect('cms_pow');

    $resp = $this -> pow -> entry_vote_delete($vote_id);
    echo json_encode($resp);
    exit();
  }

  private function _category_list($id) {
    $this -> bucket -> set_content_id('cmspow/category_list');

    $this -> data['contest_info'] = $this -> pow -> contest_get($id);
    $this -> data['category_list'] = $this -> pow -> contest_categories_list($id, array('order' => 'ASC'));

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);

    $this -> bucket -> render_layout();
  }

  function category($cmd, $id = false, $id2 = false) {
    switch ($cmd) {
      case 'up' :
        return $this -> _category_up($id);
        break;
      case 'down' :
        return $this -> _category_down($id);
        break;
      case 'add' :
        return $this -> _category_add($id);
        break;
      case 'edit' :
        return $this -> _category_edit($id);
        break;
      default :
        break;
    }
  }

  private function _category_edit($id) {
    $this -> data['category_info'] = $this -> pow -> category_get($id);
    $this -> data['contest_info'] = $this -> pow -> contest_get($this -> data['category_info']["pow_contest_id"]);

    if (!@issetNE($_POST)) {
      $this -> bucket -> set_content_id('cmspow/category_edit');
      $data = $this -> data;
      $this -> bucket -> set_data('data', $data);

      $this -> bucket -> render_layout();
    } else {
      $resp = $this -> pow -> category_edit($id, $_POST);
      echo json_encode($resp);
      exit();
    }
  }

  private function _category_add($id) {
    $this -> data['contest_info'] = $this -> pow -> contest_get($id);

    if (!@issetNE($_POST)) {
      $this -> bucket -> set_content_id('cmspow/category_add');
      $data = $this -> data;
      $this -> bucket -> set_data('data', $data);

      $this -> bucket -> render_layout();
    } else {
      $resp = $this -> pow -> category_add($id, $_POST);
      echo json_encode($resp);
      exit();
    }
  }

  private function _category_up($id) {
    $this -> data['category_info'] = $this -> pow -> category_get($id);

    $this -> pow -> category_moveup($id);
    redirect('/cms_pow/contest/categories/' . $this -> data['category_info']["pow_contest_id"]);
  }

  private function _category_down($id) {
    $this -> data['category_info'] = $this -> pow -> category_get($id);

    $this -> pow -> category_movedown($id);
    redirect('/cms_pow/contest/categories/' . $this -> data['category_info']["pow_contest_id"]);
  }

  /////////////////////////////////
  /// POW CONTEST

  /**
   * Lists all POW contest
   *
   * @param void
   *
   **/
  function contests_old($status = false) {
    $this -> bucket -> set_content_id('cmspow/contest_list');

    // get the
    $sort = array('status' => 'DESC', 'submission_start_date' => 'ASC', 'age_group_id' => 'ASC', );
    $fltr = array();

    $status = issetNE($status) ? $status : 'active';

    switch ($status) {
      case 'new' :
        $fltr = array('status' => INACTIVE_CONTEST);
        $this -> data['page_title'] = "Inactive Contests";
        $this -> data['contests_list'] = $this -> pow -> contest_getall($fltr, $sort);
        break;
      case 'archived' :
        $fltr = array('status' => ARCHIVED_CONTENT);
        $this -> data['page_title'] = "Archived Contests";
        $this -> data['contests_list'] = $this -> pow -> contest_getall($fltr, $sort);
        break;
      case 'active' :
        $fltr = array('status >' => INACTIVE_CONTEST, 'status <' => CONCLUDED_CONTENT);
        $this -> data['page_title'] = "Active Contests";
        $this -> data['contests_list'] = $this -> pow -> contest_getall($fltr, $sort);
        break;
      case 'concluded' :
        $fltr = array('status >' => ACTIVEVOTING_CONTEST, 'status <' => ARCHIVED_CONTENT);
        $this -> data['page_title'] = "Concluded Contests";
        $sort['status'] = 'ASC';
        $this -> data['contests_list'] = $this -> pow -> contest_getall($fltr, $sort);
        break;
      default :
        $this -> data['page_title'] = "All Contests";
        $this -> data['contests_list'] = $this -> pow -> contest_getall($fltr, $sort);
    }

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);

    $this -> bucket -> render_layout();
  }

  function contests_json_list($sort = false, $limit = 0) {

  }

  /**
   * Creates a new contest
   */
  function contest_create() {

    if (!@issetNE($_POST)) {
      $this -> bucket -> set_content_id('cmspow/contest_add');
      $this -> bucket -> add_css('cms');

      $data = $this -> data;
      $this -> bucket -> set_data('data', $data);
      $this -> bucket -> set_data('title', "Mumcentre CMS");
      $this -> bucket -> render_layout();
    } else {
      // actually send this
      $resp = $this -> pow -> contest_create($_POST);
      echo json_encode($resp);
      exit();
    }
  }

  function contest_edit($id = 0) {
    if (!$id)
      redirect('cms_pow/contest_list');

    $this -> data['contest_info'] = $this -> pow -> contest_get($id);
    $this -> data['conteststatus_list'] = $this -> pow -> status_get('pow_contest');

    if (!$this -> data['contest_info'])
      redirect('cms_pow/contest_list');

    if (!@issetNE($_POST)) {
      $this -> bucket -> set_content_id('cmspow/contest_edit');
      $this -> bucket -> add_css('cms');

      $this -> bucket -> set_data('title', "Mumcentre CMS");
      $data = $this -> data;
      $this -> bucket -> set_data('data', $data);
      $this -> bucket -> render_layout();
    } else {
      $resp = $this -> pow -> contest_edit($id, $_POST);
      echo json_encode($resp);
      exit();
    }

  }

  function contest_delete($id = false) {
    if (!$id)
      redirect('cms_pow/contest_list');

    if (!@issetNE($_POST)) {
      redirect('cms_pow/contest_list');
    } else {
      $resp = $this -> pow -> contest_delete($id);
      echo json_encode($resp);
      exit();
    }
  }
  function test_entry(){
    $token = '9764a1fffd019fedc9563d624c47966e';
    $data = array(
      'token_id' => $token,
    );
    $values = $this -> pow->emailfields_values($data);
    
    printr(array($data, $values));
  }


  /////////////////////////////////
  /// POW OPTIONS

  function options() {

    $this -> bucket -> set_content_id('cmspow/options');
    $this -> bucket -> add_css('cms');

    $this -> data['options_all'] = $this -> pow -> options_getall(false);

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> set_data('title', "Mumcentre CMS Pick of the Week");

    $this -> bucket -> render_layout();
  }

  function options_edit($item = false) {
    if (!$item)
      redirect('cms_pow/');

    if (!@issetNE($_POST)) {

      $this -> data['item'] = $item;
      $this -> data['value'] = $this -> pow -> options_get($item);

      $this -> bucket -> set_content_id('cmspow/options_edit');
      $this -> bucket -> add_css('cms');
      $data = $this -> data;
      $this -> bucket -> set_data('data', $data);

      $this -> bucket -> set_data('title', "Mumcentre CMS");
      $this -> bucket -> render_layout();
    } else {
      $item = $this -> input -> post('item');
      $value = $this -> input -> post('value');
      $resp = $this -> pow -> options_set($item, $value);
      echo json_encode($resp);
      exit();
    }
  }

  function contest_submitstart($id = false) {
    if (!$id)
      redirect('cms_pow/contest_list');

    if (!@issetNE($_POST)) {
      redirect('cms_pow/contest_list');
    } else {
      $resp = $this -> pow -> contest_activate($id, ACTIVESUBMIT_CONTEST);
      echo json_encode($resp);
      exit();
    }
  }

  function contest_votingstart($id = false) {
    if (!$id)
      redirect('cms_pow/contest_list');

    if (!@issetNE($_POST)) {
      redirect('cms_pow/contest_list');
    } else {
      $resp = $this -> pow -> contest_activate($id, ACTIVEVOTING_CONTEST);
      echo json_encode($resp);
      exit();
    }
  }

  function contest_conclude($contest_id = 0) {
    if (!$contest_id)
      redirect('cms_pow/contest_list');

    $this -> bucket -> set_content_id('cmspow/conclude_entries');

    if (@issetNE($_POST['id'])) {
      // conclude this contest
      $resp = $this -> pow -> contest_conclude($contest_id);
      echo json_encode($resp);
      exit();
    }

    // get the
    $this -> data['contest_info'] = $this -> pow -> contest_get($contest_id);
    $this -> data['entries_list'] = $this -> pow -> entries_get($contest_id, APPROVED_ENTRY);

    $this -> data['message'] = $this -> pow -> emailfields_values();

    // get the highest scorer
    $this -> data['voters_pick'] = $this -> pow -> entry_get_topscorer($contest_id);

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> set_data('title', "Mumcentre CMS Pick of the Week");

    $this -> bucket -> render_layout();
  }

  function publish_winners($contest_id = 0) {
    if (!$contest_id)
      return false;

    $postdata = array();
    $awards = qw('voterspick_id editorspick_id luckypick_id');
    for ($i = 0, $j = sizeof($awards); $i < $j; $i++) {
      $entry_data = $this -> pow -> entry_get_complete_byid($_POST[$awards[$i]]);
      $postdata['pow_contest_id'] = $contest_id;
      $postdata['pow_entry_id'] = $_POST[$awards[$i]];
      $postdata['total_vote'] = $entry_data['points'];
      $postdata['award_type_id'] = $i;

      $resp = $this -> pow -> results_add($contest_id, $postdata);
    }

    // then publish the contest
    $resp = $this -> pow -> contest_published($contest_id);

    echo json_encode($resp);
  }

  function contest_results($id = 0) {
    if (!$id)
      redirect('cms_pow/contest_list');

    $this -> bucket -> set_layout_id('mumcentre/cms_powlayout');
    $this -> bucket -> set_content_id('pow/contest_results');
    $this -> bucket -> add_css('cms');

    $this -> data['contest_info'] = $this -> pow -> contest_get($id);
    $this -> data['contest_results'] = $this -> pow -> contest_getresults($id);

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> set_data('title', "Mumcentre CMS Pick of the Week");

    $this -> bucket -> render_layout();
  }

  /////////////////////////////////
  /// POW ENTRIES

  function entries_pending($contest_id = 0) {

    if (!$contest_id)
      redirect('cms_pow/contest_list');

    $this -> bucket -> set_content_id('cmspow/contest_entries');

    // get the
    $this -> data['contest_info'] = $this -> pow -> contest_get($contest_id);
    $this -> data['entries_list'] = $this -> pow -> entries_get($contest_id, PENDING_ENTRY);
    $this -> data['page_title'] = "Pending Entries";

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> set_data('title', "Mumcentre CMS Pick of the Week");

    $this -> bucket -> render_layout();
  }

  function entries_allpending() {
    $this -> bucket -> set_content_id('cmspow/pending_entries');

    // get the
    $this -> data['entries_list'] = $this -> pow -> entries_getall(PENDING_ENTRY, false, array("created_date" => "DESC"));
    //function entries_getall($status = false, $fltr = array(), $orderby = array('points'=>'ASC')) {

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> set_data('title', "Mumcentre CMS Pick of the Week");

    $this -> bucket -> render_layout();
  }

  function entries_allactive() {
    $this -> bucket -> set_content_id('cmspow/active_entries');

    // get the
    $this -> data['entries_list'] = $this -> pow -> entries_getall(APPROVED_ENTRY, false, array("points" => "DESC", "created_date" => "DESC"));
    //function entries_getall($status = false, $fltr = array(), $orderby = array('points'=>'ASC')) {

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> set_data('title', "Mumcentre CMS Pick of the Week");

    $this -> bucket -> render_layout();
  }

  function entries_allrejected() {
    $this -> bucket -> set_content_id('cmspow/pending_entries');

    // get the
    $this -> data['entries_list'] = $this -> pow -> entries_getall(REJECTED_ENTRY);

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> set_data('title', "Mumcentre CMS Pick of the Week");

    $this -> bucket -> render_layout();
  }

  function entries($contest_id = 0) {

    if (!$contest_id)
      redirect('cms_pow/contest_list');

    $this -> bucket -> set_content_id('cmspow/contest_entries');

    // get the
    $this -> data['contest_info'] = $this -> pow -> contest_get($contest_id);
    $this -> data['entries_list'] = $this -> pow -> entries_get($contest_id, APPROVED_ENTRY);
    $this -> data['page_title'] = "Approved Entries";

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> set_data('title', "Mumcentre CMS Pick of the Week");

    $this -> bucket -> render_layout();
  }

  function category_delete($contest_id = false, $category_id = 0) {
    if (!$category_id || !@issetNE($_POST))
      redirect('cms_pow');

    $resp = $this -> pow -> category_delete($category_id);
    echo json_encode($resp);
    exit();
  }

  function entry_approve($entry_id = 0) {
    if (!$entry_id || !@issetNE($_POST))
      redirect('cms_pow');

    $resp = $this -> pow -> entry_approve($entry_id);
    echo json_encode($resp);
    exit();
  }

  function entry_reject($entry_id = 0) {
    if (!$entry_id || !@issetNE($_POST))
      redirect('cms_pow');

    $resp = $this -> pow -> entry_reject($entry_id);
    echo json_encode($resp);
    exit();
  }

  function entry_winner($contest_id = 0) {
    if (@issetNE($_POST)) {
      $data = $_POST;
      $data['pow_contest_id'] = $contest_id;
      $data['pow_entry_id'] = $data['id'];
      $data['total_vote'] = sizeof($this -> pow -> entry_getvotes($data['id'], VERIFIED_VOTE));
      $this -> pow -> results_add($contest_id, $data);
    }
  }

  function entry_delete($entry_id = 0) {
    if (!$entry_id || !@issetNE($_POST))
      redirect('cms_pow');

    $resp = $this -> pow -> entry_delete($entry_id);
    echo json_encode($resp);
    exit();
  }

  function entry_votes($pow_entry_id) {
    if (!$pow_entry_id)
      redirect('cms_pow/contest_list');

    $this -> bucket -> set_content_id('pow/entry_votes');
    $this -> bucket -> add_css('cms');

    // get the

    $this -> data['entry_info'] = $this -> pow -> entry_get($pow_entry_id);
    $this -> data['entry_votes'] = $this -> pow -> entry_getvotes($pow_entry_id);
    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> set_data('title', "Mumcentre CMS Pick of the Week");

    $this -> bucket -> render_layout();
  }

  function results_view($contest_id = false) {
    if (!$contest_id)
      redirect('cms_pow');

    $this -> bucket -> set_content_id('cmspow/results_list');
    $this -> bucket -> add_css('cms');

    $this -> data['contest_info'] = $this -> pow -> contest_get($contest_id);
    $this -> data['conteststatus_list'] = $this -> pow -> status_get('pow_contest');
    $this -> data['results_list'] = $this -> pow -> results_get($contest_id);
    $this -> data['awards'] = $this -> pow -> awards;

    $this -> data['page_title'] = "Results";

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> set_data('title', "Mumcentre CMS Pick of the Week");

    $this -> bucket -> render_layout();
  }

  function admin($cmd = false, $id = false) {
    switch ($cmd) {
      case 'emaillog' :
        return $this -> _email_log();
        break;
      case 'aboutpow' :
        return $this -> _aboutpow();
        break;
      case 'emailtemplate' :
        return $this -> _email_template();
        break;
      case 'emailtemplate_edit' :
        return $this -> _email_template_edit($id);
        break;
      default :
        break;
    }
    return true;
  }

  private function _email_log() {
    $this -> bucket -> set_content_id('cmspow/emaillog_list');

    $this -> data['email_log'] = $this -> pow -> email_log_view();
    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> render_layout();
  }

  private function _email_template() {
    $this -> bucket -> set_content_id('cmspow/emailtemplates');
    $this -> bucket -> add_css('cms');

    $this -> data['emailnotifications'] = $this -> pow -> email_notifications();
    //$this -> pow -> options_getall(array('item like'=>'notify-%'));

    $data = $this -> data;
    $this -> bucket -> set_data('data', $data);
    $this -> bucket -> set_data('title', "Mumcentre CMS Pick of the Week");

    $this -> bucket -> render_layout();
  }

  private function _aboutpow() {
    if (!@issetNE($_POST)) {

      $this -> data['item'] = "content_aboutpow";
      $this -> data['value'] = $this -> pow -> options_get("content_aboutpow");

      $this -> bucket -> set_content_id('cmspow/aboutpow_edit');
      $this -> bucket -> add_css('cms');
      $data = $this -> data;
      $this -> bucket -> set_data('data', $data);

      $this -> bucket -> set_data('title', "Mumcentre CMS");
      $this -> bucket -> render_layout();
    } else {
      $value = $this -> input -> post('value');
      $resp = $this -> pow -> options_set("content_aboutpow", $value);
      echo json_encode($resp);
      exit();
    }
  }

  private function _email_template_edit($item = false) {
    if (!$item)
      redirect('cms_pow/');

    if (!@issetNE($_POST)) {

      $notifications = $this -> pow -> email_notifications();
      $this -> data['item'] = $item;
      $this -> data['itemdata'] = $notifications[$item];
      $this -> data['emailguide'] = $this -> pow -> email_fields();

      $this -> bucket -> set_content_id('cmspow/emailtemplate_edit');
      $this -> bucket -> add_css('cms');
      $data = $this -> data;
      $this -> bucket -> set_data('data', $data);

      $this -> bucket -> set_data('title', "Mumcentre CMS");
      $this -> bucket -> render_layout();
    } else {
      foreach ($_POST as $key => $value) {
        if ($this -> pow -> options_get($key)) {
          $resp = $this -> pow -> options_set($key, $value);
        }
      }
      echo json_encode($resp);
      exit();
    }
  }

  ///////////////////////////////////////////////////////////////

  function load_testentries() {
    $imgs = qw('default1.jpg default2.jpg default3.jpg default4.jpg');

    for ($i = 0, $j = 1; $i < $j; $i++) {
      $data = $this -> __test_entries();
      $root_path = $this -> config -> config['root_path'];

      $img = randomize($imgs);
      $imgpath = realpath(sprintf("%s/%s/default/%s", $root_path, $this -> pow -> options['upload_path'], $img));
      $data['photo_filename'] = $this -> pow -> entry_addimage($data, $imgpath);

      //  function entry_add($pow_contest_id = 0, $postdata = false, $addphoto = false) {
      printr($this -> pow -> entry_add($data['pow_contest_id'], $data));
    }
  }

  private function __test_entries() {
    $caption = qw("Lorem ipsum dolor sit amet consectetur adipiscing elit Praesent lobortis rhoncus volutpat Nullam luctus malesuada malesuada Aliquam erat 
    volutpat Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae Ut tellus justo sodales eu volutpat et 
    egestas ac ligula Nulla facilisi Donec fermentum nulla placerat erat tempor pretium Integer interdum leo a lectus mollis ac scelerisque velit rhoncus
     Morbi sed lacus in dui hendrerit ullamcorper Pellentesque neque odio bibendum eget sodales sollicitudin sodales at metus
      Nullam lectus orci vestibulum quis dapibus ac auctor nec nisl Integer fermentum ipsum eu felis adipiscing aliquet nec in urna");
    // get the entrires

    $contests = $this -> pow -> contest_list(array('pow_contest.status' => ACTIVESUBMIT_CONTEST, 'country.code' => 3));
    //$this -> pow -> contest_getall(array());

    $allactive = array();
    foreach ($contests as $row) {
      $allactive[] = $row['id'];
    }

    $age_group_id = array(1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, );
    $data = array();
    //    $_fields = qw('pow_contest_id token_id name caption total_vote misc_data ' . 'photo_filename image_type user_id created_date modified_date status');

    $dt1 = strtotime('now');
    $dt2 = strtotime('-2 weeks');
    $dt3 = mt_rand($dt1, $dt2);

    $data['token_id'] = md5(implode('#', array(generate_random(20, 'ALPHANUM'), input_datetime('now'))));
    $data['name'] = randomize($caption) . ' ' . randomize($caption);
    $data['caption'] = randomize($caption) . ' ' . randomize($caption) . ' ' . randomize($caption) . ' ' . randomize($caption) . ' ' . randomize($caption);
    $data['created_date'] = input_datetime(date("m/d/Y g:i:s", $dt3));
    //01/30/2012
    $data['pow_category_id'] = randomize($allactive);
    $data['user_id'] = $this -> session -> userdata('user_id');
    //    if ($this -> session -> userdata('cms_logged_in') != TRUE) {

    return $data;
  }

  function load_testcontests() {
    // create 50 contest
    for ($i = 0, $j = 5; $i < $j; $i++) {
      printr($this -> pow -> contest_create($this -> __test_contest()));
    }
  }

  private function __test_contest() {
    $names = qw("Romantic Cuddle Buddies French Exotic Baby Sweet Hollywood Shower Wedding Couple Birthday Season Pretty Awesome Kids February");
    $age_group_id = array(1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, 1, 2, 3, 4, 5, );
    $data = array();

    $dt1 = strtotime('now');
    $dt2 = strtotime('+2 month');
    $dt3 = mt_rand($dt1, $dt2);

    $data['name'] = randomize($names) . ' ' . randomize($names);
    $data['status'] = INACTIVE_CONTEST;
    $data['age_group_id'] = randomize($age_group_id);
    $data['country_id'] = 3;
    //''randomize($age_group_id);

    $data['submission_start_date'] = date("m/d/Y", $dt3);
    $data['submission_end_date'] = date("m/d/Y", strtotime("+2 weeks", $dt3));
    $data['voting_start_date'] = $data['submission_end_date'];
    $data['voting_end_date'] = date("m/d/Y", strtotime("+4 weeks", $dt3));

    return $data;
  }

  function load_testvotes() {
    // first get all a
    $items = $this -> pow -> entries_get_activevoting();
    $emails = qw('redbaks@gmail.com brian.feliciano@gmail.com brianfeliciano@gmail.com brian_is_my_email@yahoo.com brianff@facebook.com');
    $itemids = array();
    foreach ($items as $itm) {
      $itemids[] = $itm['id'];
    }

    for ($i = 0, $j = 150; $i < $j; $i++) {
      $data = $this -> __test_votes();
      $data['pow_entry_id'] = randomize($itemids);
      $data['email_address'] = randomize($emails);
      $data['misc_data'] = json_encode($data);
      $this -> db -> insert($this -> pow -> _tbls['votes'], $data);

      printr($data);
      // $this->pow->contest_create( $this->__test_contest()  ) );
    }

  }

  private function __test_votes() {

    $dt1 = strtotime('now');
    $dt2 = strtotime('-2 weeks');
    $dt3 = mt_rand($dt1, $dt2);

    //id  pow_entry_id  ip_address  misc_data email_address vote_hash vote_code date_voted  status
    return array('vote_hash' => md5(generate_random(20)), 'vote_code' => generate_random(15), 'date_voted' => input_datetime(date("m/d/Y g:i:s", $dt3)), 'status' => VERIFIED_VOTE);
  }

  function php_info_981() {
    phpinfo();
  }

  function email_test_985() {
    $this -> load -> library('email');
    $this -> config -> load('email');
    $this -> email -> from($this -> pow -> options['email_from_address'], $this -> pow -> options['email_from_name']);
    $this -> email -> to("brian.feliciano@gmail.com");
    $this -> email -> subject("Test subject - " . input_datetime('now'));
    $this -> email -> message("Test message - " . input_datetime('now'));
    $emailstatus = $this -> email -> send() ? "EMAIL SENT!<br/>" : "UNABLE TO SEND<br/>";

    printr(array('status' => $emailstatus, 'details' => $this -> email -> print_debugger()));
  }

  function email_test_997() {
    $this -> load -> library('email');
    $cfg = array();
    $cfg['protocol'] = 'sendmail';
    $cfg['mailpath'] = '/usr/sbin/sendmail -t -i ';
    $cfg['wordwrap'] = TRUE;
    $this -> email -> initialize($cfg);

    $this -> config -> load('email');
    $this -> email -> from($this -> pow -> options['email_from_address'], $this -> pow -> options['email_from_name']);
    $this -> email -> to("brian.feliciano@gmail.com");
    $this -> email -> subject("Test subject using config - " . input_datetime('now'));
    $this -> email -> message("Test message - " . input_datetime('now') . '  ' . print_r($cfg, true));
    $emailstatus = $this -> email -> send() ? "EMAIL SENT!<br/>" : "UNABLE TO SEND<br/>";

    printr(array('status' => $emailstatus, 'details' => $this -> email -> print_debugger()));
  }

  function email_test_1015() {
    $this -> load -> library('email');
    $cfg = array();
    $cfg['protocol'] = 'smtp';
    $cfg['smtp_port'] = '587';
    $cfg['smtp_host'] = 'smtp.mailgun.org';
    $cfg['smtp_user'] = 'postmaster@atraxia.mailgun.org';
    $cfg['smtp_pass'] = '5nz2d4hka1n3';
    $cfg['email_from_address'] = 'noreply@mumcentre.com';
    $cfg['email_from_name'] = 'Mumcentre™ Administrator';

    $cfg['mailtype'] = 'html';
    $cfg['wordwrap'] = TRUE;

    $this -> email -> initialize($cfg);

    $this -> config -> load('email');
    $this -> email -> from($this -> pow -> options['email_from_address'], $this -> pow -> options['email_from_name']);
    $this -> email -> to("brian.feliciano@gmail.com");
    $this -> email -> subject("Test subject using config - " . input_datetime('now'));
    $this -> email -> message("Test message - " . input_datetime('now') . '  ' . print_r($cfg, true));
    $emailstatus = $this -> email -> send() ? "EMAIL SENT!<br/>" : "UNABLE TO SEND<br/>";

    printr(array('status' => $emailstatus, 'details' => $this -> email -> print_debugger()));
  }

  function email_test_1041() {
    $to = "brian.feliciano@gmail.com";
    $subject = "Test subject using config - " . input_datetime('now');
    $message = "Test message - " . input_datetime('now') . '  ' . print_r($cfg, true);
    $from = sprintf("%s <%s>", $this -> pow -> options['email_from_name'], $this -> pow -> options['email_from_address']);
    $headers = "From: {$from} \r\n" . "Reply-To:{$from} \r\n" . 'X-Mailer: PHP/' . phpversion();

    $status = mail($to, $subject, $message, $headers);

    printr(array('status' => $status ? "sent!" : "not sent :("));
  }

  function email_test_1053() {
    $this -> load -> library('email');
    $cfg = array();
    $cfg['protocol'] = 'smtp';
    $cfg['smtp_port'] = 587;
    $cfg['smtp_host'] = 'smtp.mailgun.org';
    $cfg['smtp_user'] = 'postmaster@atraxia.mailgun.org';
    $cfg['smtp_pass'] = '5nz2d4hka1n3';
    $cfg['email_from_address'] = 'noreply@mumcentre.com';
    $cfg['email_from_name'] = 'Mumcentre™ Administrator';

    $cfg['mailtype'] = 'html';
    $cfg['charset'] = 'iso-8859-1';
    $cfg['wordwrap'] = TRUE;

    $this -> email -> initialize($cfg);
    $this -> email -> set_newline("\r\n");

    $this -> email -> from($this -> pow -> options['email_from_address'], $this -> pow -> options['email_from_name']);
    $this -> email -> to("brian.feliciano@gmail.com");
    $this -> email -> subject("Test subject using config - " . input_datetime('now'));
    $this -> email -> message("Test message - " . input_datetime('now') . '  ' . print_r($cfg, true));
    $emailstatus = $this -> email -> send() ? "EMAIL SENT!<br/>" : "UNABLE TO SEND<br/>";

    printr(array('status' => $emailstatus, 'details' => $this -> email -> print_debugger()));
  }

}
?>
