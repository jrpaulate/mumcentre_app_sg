<?php
class Pow_Model extends CI_Model {

  function Pow_model() {
    parent::__construct();
    $this -> load -> database();
    $this -> load -> helper('miscfuncs_helper');

    define('CC_CODE', 'SG');

    $this -> options = $this -> __pow_default_options();

    $opts_key = array();
    $opts_key['message_novoting_contest'] = "Text content if no Active Contest for Voting";
    $opts_key['message_nosubmission_contest'] = "Text content if no Active Contest for Entry Submission";
    $opts_key['message_noconcluded_contest'] = "Text content if no concluded entries";
    $opts_key['message_duplicate_entry'] = "Text content if user uploaded more than once on a category";
    $opts_key['message_successful_submit'] = "Text content for successful submit";
    $opts_key['message_successful_vote'] = "Text content for successful vote";

    $opts_key['upload_image_aspect_ratio'] = 'Upload photo image aspect ratio';
    $opts_key['upload_max_kb'] = 'Max upload photo (in bytes)';
    $opts_key['upload_max_height'] = 'Max upload height';
    $opts_key['upload_max_width'] = 'Max Upload width';
    $opts_key['adminemail'] = 'Admin Email';
    $opts_key['allowed_imagetypes'] = 'Allowed Imagetypes';
    $opts_key['email_from_name'] = 'Admin Email Name';
    $opts_key['email_from_address'] = 'Admin Email Address';
    $opts_key['upload_path'] = 'POW photo upload path';
    $opts_key['new-entry_admin_alert'] = '';
    $opts_key['use_ajax_uploader'] = '';
    $this -> options_key = $opts_key;

    $tbls = array();

    $tbls['agegroup'] = 'age_group';
    $tbls['options'] = 'pow_option';
    $tbls['contest'] = 'pow_contest';
    $tbls['entries'] = 'pow_entry';
    $tbls['votes'] = 'pow_vote';
    $tbls['results'] = 'pow_result';
    $tbls['users'] = 'user';
    $tbls['category'] = 'pow_contest_category';
    $tbls['country'] = 'pow_contest_country';
    $this -> _tbls = $tbls;

    define('INACTIVE_CONTEST', 0);
    define('ACTIVESUBMIT_CONTEST', 1);
    define('ACTIVEVOTING_CONTEST', 2);
    define('CONCLUDED_CONTEST', 3);
    define('PUBLISHED_CONTEST', 4);
    define('ARCHIVED_CONTEST', 5);
    $this -> label_contest_status = array("Pending Contest", "Active for Submission", "Active for Voting", "Concluded Contest", "Published Contest");

    define('PENDING_ENTRY', 0);
    define('APPROVED_ENTRY', 1);
    define('REJECTED_ENTRY', 2);
    $this -> label_entry_status = array("Unapproved", "Approved", "Rejected");

    define('UNVERIFIED_VOTE', 0);
    define('VERIFIED_VOTE', 1);
    $this -> label_vote_status = array("Unverified", "Verified");

    $this -> awards = array("Voter's Pick", "Editor's Pick", "Lucky Pick");

    $this -> secret_word = "p1ck0fth3w33kc0nt3st";
    $this -> _EMAIL_FIELDS = array();

    $this -> __load_options();

    return $this;
  }

  /////////////////////////////////
  /// POW OPTIONS

  /**
   * Set the options
   *
   * @param string  optionItem
   * @param string  optionValue
   */
  function options_set($item = false, $value = false) {
    if (!isset($item) || !isset($value))
      return false;

    // update our localvar
    $this -> options[$item] = $value;

    // update our db
    $data = array("item" => $item, "value" => json_encode($value));

    // update the database
    $qry = $this -> db -> get_where($this -> _tbls['options'], array("item" => $item));
    if ($qry -> num_rows() > 0) {
      $this -> db -> where("item", $item);
      $this -> db -> update($this -> _tbls['options'], $data);
    } else {
      $this -> db -> insert($this -> _tbls['options'], $data);
    }

    return array('code' => 0, 'message' => 'Option was updated succesfully');
  }

  /**
   * Get the option values
   *
   * @param string optionItem
   */
  function options_get($item = false) {
    return @issetVal($this -> options[$item], false);
  }

  /**
   * Get all the option values
   *
   * @param string optionItem
   */
  function options_getall($getall = false) {

    if (!$getall) {
      $this -> db -> where("item not like", "notify_%");
      $this -> db -> where("item not like", "content_%");
    }
    $this -> db -> order_by('item', 'asc');

    $qry = $this -> db -> get($this -> _tbls['options']);
    return $qry -> result_array();
  }

  function status_get($type = false) {
    if ($type) {
      $this -> db -> where(array('type' => $type));
    }
    $this -> db -> order_by('id', 'ASC');

    $qry = $this -> db -> get("status");
    return $qry -> result_array();
  }

  function user_get($user_id = false) {
    if (!$user_id)
      return false;

    $this -> db -> where('id', $user_id);
    $qry = $this -> db -> get('user');

    return $qry -> row_array();
  }

  function country_list() {
    $qry = $this -> db -> get('country');

    return $qry -> result_array();
  }

  function country_info() {
    $this -> db -> where('code', CC_CODE);
    $qry = $this -> db -> get('country');
    return $qry -> row_array();
  }

  /////////////////////////////////
  /// POW CONTEST

  /**
   * __private
   * data preparation for contest table
   */
  private function __contest_prepdata($postdata = false) {

    $prepdata = array();
    $_contest_fields = qw('name description status submission_start_date submission_end_date voting_start_date voting_end_date');
    $_date_fields = qw('voting_start_date voting_end_date submission_start_date submission_end_date created_date modified_date');

    foreach ($_contest_fields as $fld) {
      if (@issetNE($postdata[$fld]) || @issetNE($_REQUEST[$fld]))
        $prepdata[$fld] = @issetVal($postdata[$fld], @issetVal($_REQUEST[$fld]));

      if (in_array($fld, $_date_fields, true))
        $prepdata[$fld] = input_datetime($prepdata[$fld]);
    }
    return $prepdata;
  }

  private function __prepdata($postdata = false, $_fields = array()) {
    if (!@issetNE($postdata) || !@issetNE($_fields))
      return false;

    $prepdata = array();
    foreach ($_fields as $fld) {
      if (@issetNE($postdata[$fld]) || @issetNE($_REQUEST[$fld]))
        $prepdata[$fld] = @issetVal($postdata[$fld], @issetVal($_REQUEST[$fld]));
    }
    return $prepdata;
  }

  /**
   * Fetch all contest
   *
   * @param void
   * @return  array database result
   */
  function contest_getall($filter = array(), $sort = array()) {
    if ($filter) {
      foreach ($filter as $key => $value) {
        $this -> db -> where($key, $value);
      }
    }
    $sort = @issetVal($sort, array('status' => 'asc'));
    foreach ($sort as $fld => $ordr) {
      $this -> db -> order_by($fld, $ordr);
    }

    $tbl_entry = $this -> _tbls['entries'];
    $tbl_contest = $this -> _tbls['contest'];

    $flds = implode(',', array("{$this->_tbls['contest']}.*", "country.id as cc_id", "country.url as cc_url", "country.code as cc_code", "country.name as cc_name", "status.name as status_name"));
    $this -> db -> select($flds);
    $this -> db -> from($this -> _tbls['contest']);
    $this -> db -> join($this -> _tbls['country'], "{$this->_tbls['contest']}.id={$this->_tbls['country']}.contest_id");
    $this -> db -> join("country", "country.id={$this->_tbls['country']}.country_id");

    //$this -> db -> join($this -> _tbls['category'], "{$this->_tbls['contest']}.id={$this->_tbls['category']}.pow_contest_id");
    $this -> db -> join('status', "{$this->_tbls['contest']}.status=status.id AND status.type='pow_contest'");

    $qry = $this -> db -> get();

    return $qry -> result_array();
  }

  function contest_list($filter = array(), $sort = array()) {
    if ($filter) {
      foreach ($filter as $key => $value) {
        $this -> db -> where($key, $value);
      }
    }
    $sort = @issetVal($sort, array('status' => 'asc'));
    foreach ($sort as $fld => $ordr) {
      $this -> db -> order_by($fld, $ordr);
    }

    $tbl_entry = $this -> _tbls['entries'];
    $tbl_contest = $this -> _tbls['contest'];

    $flds = implode(',', array("{$this->_tbls['contest']}.*", "{$this -> _tbls['country']}.country_id", "country.code as country_code",
    //              "approved_entries.cnt as approved_entries",
    //              "pending_entries.cnt as pending_entries",
      "status.name as status_name"));

    $this -> db -> select($flds);
    $this -> db -> from($this -> _tbls['contest']);
    $this -> db -> join('status', "{$this->_tbls['contest']}.status=status.id AND status.type='pow_contest'", "LEFT");
    $this -> db -> join($this -> _tbls['country'], "{$this->_tbls['contest']}.id={$this->_tbls['country']}.contest_id", "LEFT");
    $this -> db -> join('country', "country.id={$this->_tbls['country']}.country_id", "LEFT");
    /*
     $join_approved_entries = "
     (SELECT  {$this->_tbls['category']}.pow_contest_id, {$this->_tbls['entries']}.pow_category_id, count(*) as cnt
     FROM {$this->_tbls['entries']}
     LEFT JOIN {$this->_tbls['category']} ON {$this->_tbls['category']}.id={$this->_tbls['entries']}.pow_category_id
     WHERE {$this->_tbls['entries']}.status=".APPROVED_ENTRY."
     GROUP BY {$this->_tbls['entries']}.pow_category_id ) approved_entries";

     $this->db->join ($join_approved_entries,"{$this->_tbls['contest']}.id=approved_entries.pow_contest_id", "LEFT");

     $join_pending_entries = "
     (SELECT  {$this->_tbls['category']}.pow_contest_id, {$this->_tbls['entries']}.pow_category_id, count(*) as cnt
     FROM {$this->_tbls['entries']}
     LEFT JOIN {$this->_tbls['category']} ON {$this->_tbls['category']}.id={$this->_tbls['entries']}.pow_category_id
     WHERE {$this->_tbls['entries']}.status=".PENDING_ENTRY."
     GROUP BY {$this->_tbls['entries']}.pow_category_id ) pending_entries";

     $this->db->join ($join_pending_entries,"{$this->_tbls['contest']}.id=pending_entries.pow_contest_id", "LEFT");
     */

    $qry = $this -> db -> get();
    return $qry -> result_array();
  }

  /**
   * Fetch a contest by id
   *
   * @param int contest id
   * @return  array database row array
   */
  function contest_get($id = 0) {

    $flds = implode(',', array("{$this->_tbls['contest']}.*", "country.id as cc_id", "country.url as cc_url", "country.code as cc_code", "country.name as cc_name", "{$this -> _tbls['country']}.country_id", "status.name as status_name"));

    $this -> db -> select($flds);
    $this -> db -> from($this -> _tbls['contest']);
    $this -> db -> join($this -> _tbls['country'], "{$this->_tbls['contest']}.id={$this->_tbls['country']}.contest_id");
    $this -> db -> join('status', "{$this->_tbls['contest']}.status=status.id AND status.type='pow_contest'");
    $this -> db -> join("country", "country.id={$this->_tbls['country']}.country_id");

    $this -> db -> where("{$this->_tbls['contest']}.id", $id);
    $qry = $this -> db -> get();
    return $qry -> num_rows() > 0 ? $qry -> row_array() : false;
  }

  /**
   * Creates a new contest
   *
   * @param array/hash  $postdatat
   * @return  mixed
   */
  function contest_create($postdata = false) {
    $response = array('code' => 0, 'message' => "");
    if (!$postdata) {
      return array('code' => -1, 'message' => "Data is required");
    }

    // cleanup the data
    $data = $this -> __contest_prepdata($postdata);
    $data['created_date'] = @issetVal($postdata['created_date'], input_datetime('now'));
    $data['modified_date'] = @issetVal($postdata['modified_date'], input_datetime('now'));

    $this -> db -> insert($this -> _tbls['contest'], $data);
    $contest_id = $this -> db -> insert_id();

    // add categories to $contentid
    $this -> contest_categories_add($contest_id, $postdata);

    // add country to content id
    $this -> contest_country_add($contest_id, $postdata);

    return array('code' => 0, 'message' => 'Contest was added succesfully');
  }

  function contest_duplicate_many($contestids = false, $ccid = false) {
    $response = array('code' => 0, 'message' => "");
    if (!$contestids) {
      return array('code' => -1, 'message' => "Contest ID is required");
    }

    foreach ($contestids as $contest_id) {
      $this -> contest_duplicate($contest_id, $ccid);
    }

    return array('code' => 0, 'message' => 'Contest was added succesfully');
  }

  function contest_duplicate($contest_id = false, $ccid = false) {
    $response = array('code' => 0, 'message' => "");
    if (!$contest_id) {
      return array('code' => -1, 'message' => "Contest ID is required");
    }

    // get the contest
    $contestdata = $this -> contest_get($contest_id);
    //$qry->row_array();
    if ($ccid) {
      $contestdata['country_id'] = $ccid;
    }

    // cleanup the data
    $data = $this -> __contest_prepdata($contestdata);
    $data['created_date'] = input_datetime('now');
    $data['modified_date'] = input_datetime('now');
    $data['status'] = INACTIVE_CONTEST;

    $this -> db -> insert($this -> _tbls['contest'], $data);
    $contest_id = $this -> db -> insert_id();

    // add categories to $contentid
    $this -> contest_categories_add($contest_id, $contestdata);

    // add country to content id
    $this -> contest_country_add($contest_id, $contestdata);

    return array('code' => 0, 'message' => 'Contest was added succesfully');
  }

  function contest_activate_submission($id) {
    $info = array_shift($this -> contest_getall(array("{$this->_tbls['contest']}.id" => $id)));

    // active forsubmission
    $search = $this -> contest_active_get(ACTIVESUBMIT_CONTEST, $info['cc_code']);

    if (!$search) {
      $this -> contest_activate($info['id'], ACTIVESUBMIT_CONTEST);
      return array('code' => '0', 'message' => 'Succesfully activated the Contest Week for Submission');
    } else {
      return array('code' => -1, 'message' => "Unable to activate for submission, There's an existing contest for submission in progress");
    }
  }

  function contest_activate_voting($id) {
    $info = array_shift($this -> contest_getall(array("{$this->_tbls['contest']}.id" => $id)));
    // active forsubmission
    $search = $this -> contest_active_get(ACTIVEVOTING_CONTEST, $info['cc_code']);

    if (!$search) {
      $this -> contest_activate($info['id'], ACTIVEVOTING_CONTEST);
      return array('code' => '0', 'message' => 'Succesfully activated the Contest Week for Voting');
    } else {
      return array('code' => -1, 'message' => "Unable to activate for voting, There's an existing contest for Voting in progress");
    }
  }

  function contest_active_get($status = false, $cc_code = false) {
    $fltr = array();
    $fltr['country.code'] = $cc_code ? $cc_code : CC_CODE;
    $fltr["{$this->_tbls['contest']}.status"] = $status;

    $search = $this -> contest_getall($fltr);
    return !empty($search) ? $search : false;
  }

  function contest_categories_add($contest_id = false) {
    if (!$contest_id)
      return false;
    $flds = qw('pow_contest_id name order');
    $agegroup = $this -> agegroup_getall();
    $cnt = 0;

    foreach ($agegroup as $ag) {
      $data = $this -> __prepdata($ag, $flds);
      $data['pow_contest_id'] = $contest_id;
      $data['order'] = ++$cnt;

      $this -> db -> insert($this -> _tbls['category'], $data);
    }

    return array('code' => 0, 'message' => 'Categories added succesfullly');
  }

  function category_add($contest_id = false, $postdata = false) {
    if (!$contest_id)
      return false;
    $flds = qw('pow_contest_id name order');

    // get the last order num
    $this -> db -> where('pow_contest_id', $contest_id);
    $this -> db -> order_by("order", "DESC");
    $qry = $this -> db -> get($this -> _tbls['category']);
    $last = array_shift($qry -> result_array());

    $data = $this -> __prepdata($postdata, $flds);
    $data['pow_contest_id'] = $contest_id;
    $data['order'] = $last['order'] + 1;

    $this -> db -> insert($this -> _tbls['category'], $data);

    return array('code' => 0, 'message' => 'Category added succesfullly');
  }

  function category_edit($id = false, $postdata = false) {
    if (!$id || !$postdata)
      return array('code' => 0, "message" => "Missing parameters");
    $flds = qw('pow_contest_id name description order');

    $data = $this -> __prepdata($postdata, $flds);

    $this -> db -> where('id', $id);
    $this -> db -> update($this -> _tbls['category'], $data);

    return array('code' => 0, 'message' => 'Category updated succesfullly');
  }

  function category_moveup($id = 0) {
    if (!$id)
      return array('code' => 0, "message" => "Missing parameters");
    $flds = qw('pow_contest_id name description order');

    $categ = $this -> category_get($id);
    $fltr = array('pow_contest_id' => $categ['pow_contest_id'], 'order' => $categ['order'] - 1);
    $this -> db -> where($fltr);
    $qry = $this -> db -> get($this -> _tbls['category'], $fltr);
    $categ2 = $qry -> row_array();

    $this -> category_edit($categ2['id'], array('order' => $categ['order']));
    $this -> category_edit($categ['id'], array('order' => $categ2['order']));

    return array('code' => 0, 'message' => 'Category moved up');
  }

  function category_movedown($id = 0) {
    if (!$id)
      return array('code' => 0, "message" => "Missing parameters");
    $flds = qw('pow_contest_id name description order');

    $categ = $this -> category_get($id);
    $fltr = array('pow_contest_id' => $categ['pow_contest_id'], 'order' => $categ['order'] + 1);
    $this -> db -> where($fltr);
    $qry = $this -> db -> get($this -> _tbls['category'], $fltr);
    $categ2 = $qry -> row_array();

    $this -> category_edit($categ2['id'], array('order' => $categ['order']));
    $this -> category_edit($categ['id'], array('order' => $categ2['order']));

    return array('code' => 0, 'message' => 'Category moved up');
  }

  function category_get($id) {
    if (!$id)
      return false;
    $this -> db -> where('id', $id);
    $qry = $this -> db -> get($this -> _tbls['category']);
    return $qry -> row_array();
  }

  function category_getbyname($name, $contest_id = 0) {
    if (!$name || !$contest_id)
      return false;
    $this -> db -> where('name', $name);
    $this -> db -> where('pow_contest_id', $contest_id);
    $qry = $this -> db -> get($this -> _tbls['category']);
    return $qry -> row_array();
  }

  function category_getbyurlname($urlname, $contest_id = 0) {
    if (!$urlname || !$contest_id)
      return false;
    //$this -> db -> where('name', $name);
    $this -> db -> where('pow_contest_id', $contest_id);
    $qry = $this -> db -> get($this -> _tbls['category']);
    $all = $qry -> result_array();
    foreach ($all as $row) {
      $rowurlname = url_title($row['name'], "dash", true);
      if ($rowurlname == $urlname)
        return $row;
    }
  }

  function category_activecontest($status = false) {
    // active forsubmission
    $search = array_shift($this -> contest_active_get($status));
    $categs = $this -> contest_categories_list($search['id'], array('order' => 'ASC'));

    return $categs;
  }

  function category_entries($category_id, $status = false) {
    if (!$category_id)
      return false;

    if (isset($status)) {
      $this -> db -> where('status', $status);
    }

    $qry = $this -> db -> get($this -> _tbls['entries']);

    return $qry -> result_array();
  }

  function contest_categories_list($contest_id = false, $sort = array('order' => 'ASC')) {
    if (!$contest_id)
      return false;

    $this -> db -> where('pow_contest_id', $contest_id);

    foreach ($sort as $fld => $ordr) {
      $this -> db -> order_by($fld, $ordr);
    }
    $qry = $this -> db -> get($this -> _tbls['category']);

    return $qry -> result_array();
  }

  function contest_userentries_list($userid = false, $contest_id = false) {
    if (!$userid)
      return false;

    $this -> db -> select("{$this -> _tbls['entries']}.*");
    $this -> db -> join($this -> _tbls['category'], "{$this -> _tbls['category']}.id={$this -> _tbls['entries']}.pow_category_id", "LEFT");
    $this -> db -> where("{$this -> _tbls['category']}.pow_contest_id", $contest_id);
    $this -> db -> where("{$this -> _tbls['entries']}.user_id", $userid);

    $qry = $this -> db -> get($this -> _tbls['entries']);

    return $qry -> result_array();
  }

  function contest_info($category_id = 0) {

    $flds = array();
    $flds[] = "country.url as cc_url";
    $flds[] = "country.code as cc_code";
    $flds[] = "country.name as cc_name";
    $flds[] = "{$this->_tbls['contest']}.*";
    $flds[] = "status.name as status_name";
    $flds[] = "{$this->_tbls['category']}.name as category_name";
    $flds[] = "{$this->_tbls['category']}.id as pow_category_id";

    $this -> db -> select(implode(", ", $flds));
    $this -> db -> from($this -> _tbls['contest']);
    $this -> db -> join($this -> _tbls['country'], "{$this->_tbls['contest']}.id={$this->_tbls['country']}.contest_id");
    $this -> db -> join("country", "country.id={$this->_tbls['country']}.country_id");
    $this -> db -> join($this -> _tbls['category'], "{$this->_tbls['contest']}.id={$this->_tbls['category']}.pow_contest_id AND {$this->_tbls['category']}.id={$category_id}");
    $this -> db -> join("status", "status.id={$this->_tbls['contest']}.status AND status.type='pow_contest'");

    $qry = $this -> db -> get();
    return $qry -> row_array();
  }

  function contest_winners($contest_id) {
    $this -> db -> where('pow_contest_id', $contest_id);
    $qry = $this -> db -> get($this -> _tbls['results']);

    return $qry -> result_array();
  }

  function contest_latest_winners($category_id = 0) {
    $contest = $this -> contest_getall(array("{$this->_tbls['contest']}.status" => PUBLISHED_CONTEST), array("{$this->_tbls['contest']}.modified_date" => "DESC"));
    if (!empty($contest)) {
      $contest = array_shift($contest);
      $contest_id = $contest['id'];
    }

    $flds = array();
    $flds[] = "{$this->_tbls['category']}.name as category_name";
    $flds[] = "{$this->_tbls['category']}.id as category_id";
    $flds[] = "{$this->_tbls['contest']}.name as contest_name";
    $flds[] = "{$this->_tbls['contest']}.id as contest_id";
    $flds[] = "{$this->_tbls['contest']}.status as contest_status";
    $flds[] = "{$this->_tbls['contest']}.modified_date as contest_modified_date";
    $flds[] = "{$this->_tbls['users']}.email_address";
    $flds[] = "{$this->_tbls['users']}.first_name";
    $flds[] = "{$this->_tbls['users']}.last_name";
    $flds[] = "{$this->_tbls['entries']}.id as entry_id";
    $flds[] = "{$this->_tbls['entries']}.*";
    $flds[] = "{$this->_tbls['results']}.*";
    $sql = " SELECT  " . implode(", ", $flds);
    $sql .= "
FROM {$this -> _tbls['results']}
LEFT JOIN {$this->_tbls['entries']} ON {$this->_tbls['entries']}.id = {$this -> _tbls['results']}.pow_entry_id
LEFT JOIN {$this -> _tbls['contest']} ON {$this->_tbls['contest']}.id={$this->_tbls['results']}.pow_contest_id
LEFT JOIN {$this -> _tbls['category']} ON {$this->_tbls['category']}.id={$this->_tbls['entries']}.pow_category_id
LEFT JOIN {$this -> _tbls['users']} ON {$this->_tbls['users']}.id={$this->_tbls['entries']}.user_id
WHERE 1 ";
    $values = array();
    if (@issetNE($contest_id)) {
      $sql .= " AND {$this->_tbls['contest']}.id=?";
      $values[] = $contest_id;
    }
    if (@issetNE($category_id)) {
      $sql .= " AND {$this->_tbls['category']}.id=?";
      $values[] = $category_id;
    }
    $sql .= " ORDER BY {$this -> _tbls['results']}.total_vote DESC";

    $qry = $this -> db -> query($sql, $values);

    return $qry -> result_array();
  }

  function contest_winnersall($contest_id = 0, $category_id = 0) {
    $flds = array();
    $flds[] = "{$this->_tbls['category']}.name as category_name";
    $flds[] = "{$this->_tbls['category']}.id as category_id";
    $flds[] = "{$this->_tbls['contest']}.name as contest_name";
    $flds[] = "{$this->_tbls['contest']}.id as contest_id";
    $flds[] = "{$this->_tbls['contest']}.status as contest_status";
    $flds[] = "{$this->_tbls['contest']}.modified_date as contest_modified_date";
    $flds[] = "{$this->_tbls['users']}.email_address";
    $flds[] = "{$this->_tbls['users']}.first_name";
    $flds[] = "{$this->_tbls['users']}.last_name";
    $flds[] = "{$this->_tbls['entries']}.id as entry_id";
    $flds[] = "{$this->_tbls['entries']}.*";
    $flds[] = "{$this->_tbls['results']}.*";
    $sql = " SELECT  " . implode(", ", $flds);
    $sql .= "
FROM {$this -> _tbls['results']}
LEFT JOIN {$this->_tbls['entries']} ON {$this->_tbls['entries']}.id = {$this -> _tbls['results']}.pow_entry_id
LEFT JOIN {$this -> _tbls['contest']} ON {$this->_tbls['contest']}.id={$this->_tbls['results']}.pow_contest_id
LEFT JOIN {$this -> _tbls['category']} ON {$this->_tbls['category']}.id={$this->_tbls['entries']}.pow_category_id
LEFT JOIN {$this -> _tbls['users']} ON {$this->_tbls['users']}.id={$this->_tbls['entries']}.user_id
WHERE 1 ";
    $values = array();
    if (@issetNE($contest_id)) {
      $sql .= " AND {$this->_tbls['contest']}.id=?";
      $values[] = $contest_id;
    }
    if (@issetNE($category_id)) {
      $sql .= " AND {$this->_tbls['category']}.id=?";
      $values[] = $category_id;
    }
    $sql .= " AND {$this->_tbls['contest']}.status=?";
    $values[] = PUBLISHED_CONTEST;
    $sql .= " ORDER BY contest_modified_date DESC";

    $qry = $this -> db -> query($sql, $values);
    return $qry -> result_array();
  }

  function contest_entriesall($contest_id, $category_id = 0, $status = false) {

    $flds = array();
    $flds[] = "{$this->_tbls['category']}.name as category_name";
    $flds[] = "{$this->_tbls['category']}.id as category_id";
    $flds[] = "{$this->_tbls['contest']}.name as contest_name";
    $flds[] = "{$this->_tbls['contest']}.id as contest_id";
    $flds[] = "{$this->_tbls['users']}.email_address";
    $flds[] = "{$this->_tbls['users']}.first_name";
    $flds[] = "{$this->_tbls['users']}.last_name";
    $flds[] = "status.name as status_name";
    $flds[] = " IFNULL( x.cnt,0 ) as points ";
    $flds[] = "{$this->_tbls['entries']}.*";
    $sql = " SELECT  " . implode(", ", $flds);
    $sql .= "
FROM {$this -> _tbls['entries']}
LEFT JOIN
( SELECT {$this->_tbls['votes']}.pow_entry_id, count(*) as cnt
FROM {$this->_tbls['votes']}
WHERE {$this->_tbls['votes']}.status=?
GROUP BY {$this->_tbls['votes']}.pow_entry_id ) x
ON {$this -> _tbls['entries']}.id = x.pow_entry_id
LEFT JOIN {$this -> _tbls['category']} ON {$this->_tbls['category']}.id={$this->_tbls['entries']}.pow_category_id
LEFT JOIN {$this -> _tbls['contest']} ON {$this->_tbls['contest']}.id={$this->_tbls['category']}.pow_contest_id
LEFT JOIN {$this -> _tbls['users']} ON {$this->_tbls['users']}.id={$this->_tbls['entries']}.user_id
LEFT JOIN status ON status.id={$this->_tbls['entries']}.status AND status.type=?
WHERE 1 ";
    $values = array(VERIFIED_VOTE, 'pow_entry');
    if (@issetNE($contest_id)) {
      $sql .= " AND {$this->_tbls['contest']}.id=?";
      $values[] = $contest_id;
    }
    if (@issetNE($category_id)) {
      $sql .= " AND {$this->_tbls['category']}.id=?";
      $values[] = $category_id;
    }
    if ($status !== false) {
      $sql .= " AND {$this->_tbls['entries']}.status=?";
      $values[] = $status;
    }
    $sql .= " ORDER BY created_date DESC";

    $qry = $this -> db -> query($sql, $values);
    return $qry -> result_array();
  }

  function contest_entry_bytokenid($token_id = false) {

    $flds = array();
    $flds[] = "{$this->_tbls['category']}.name as category_name";
    $flds[] = "{$this->_tbls['category']}.id as category_id";
    $flds[] = "{$this->_tbls['contest']}.name as contest_name";
    $flds[] = "{$this->_tbls['contest']}.id as contest_id";
    $flds[] = "{$this->_tbls['contest']}.status as contest_status";
    $flds[] = "{$this->_tbls['users']}.email_address";
    $flds[] = "{$this->_tbls['users']}.first_name";
    $flds[] = "{$this->_tbls['users']}.last_name";
    $flds[] = "status.name as status_name";
    $flds[] = "{$this->_tbls['entries']}.*";

    $this -> db -> select(implode(", ", $flds));
    $this -> db -> from($this -> _tbls['entries']);
    $this -> db -> join($this -> _tbls['category'], "{$this->_tbls['category']}.id={$this->_tbls['entries']}.pow_category_id");
    $this -> db -> join($this -> _tbls['contest'], "{$this->_tbls['contest']}.id={$this->_tbls['category']}.pow_contest_id");
    $this -> db -> join($this -> _tbls['users'], "{$this->_tbls['users']}.id={$this->_tbls['entries']}.user_id");
    $this -> db -> join("status", "status.id={$this->_tbls['entries']}.status AND status.type='pow_entry'");

    $this -> db -> where("{$this->_tbls['entries']}.token_id", $token_id);

    $qry = $this -> db -> get();
    return $qry -> row_array();
  }

  function contest_country_add($contest_id = false, $postdata = false) {
    if (!$contest_id)
      return false;
    $flds = qw('contest_id country_id');
    $data = $this -> __prepdata($postdata, $flds);
    $data['contest_id'] = $contest_id;

    $this -> db -> insert($this -> _tbls['country'], $data);

    return true;
  }

  /**
   *
   *
   */
  function contest_edit($id = 0, $postdata) {
    /**
     * TODO: check user session here
     */
    $response = array('code' => 0, 'message' => "");
    if (!$postdata) {
      return array('code' => -1, 'message' => "Data is required");
    }
    if (!$id) {
      return array('code' => -1, 'message' => "ID is required");
    }

    // cleanup the data
    $postdata['modified_date'] = @issetVal($postdata['modified_date'], 'now');

    $postdata = $this -> __contest_prepdata($postdata);
    $this -> db -> where('id', $id);
    $postdata['modified_date'] = input_datetime('now');
    $this -> db -> update($this -> _tbls['contest'], $postdata);

    return array('code' => 0, 'message' => 'Contest was updated succesfully');
  }

  function category_delete($id = false) {
    if (!$id) {
      return array('code' => -1, 'message' => "ID is required");
    }

    // cleanup the data
    $this -> db -> where('id', $id);
    $this -> db -> delete($this -> _tbls['category']);

    return array('code' => 0, 'message' => 'Category was deleted');
  }

  function contest_delete($id = false) {
    /**
     * TODO: check user session here
     */
    $response = array('code' => 0, 'message' => "");
    if (!$id) {
      return array('code' => -1, 'message' => "ID is required");
    }

    // cleanup the data
    $this -> db -> where('id', $id);
    $this -> db -> delete($this -> _tbls['contest']);

    return array('code' => 0, 'message' => 'Contest was deleted');
  }
  
  function entry_vote_delete($id=false){
    /**
     * TODO: check user session here
     */
    $response = array('code' => 0, 'message' => "");
    if (!$id) {
      return array('code' => -1, 'message' => "ID is required");
    }

    // cleanup the data
    $this -> db -> where('id', $id);
    $this -> db -> delete($this -> _tbls['votes']);

    return array('code' => 0, 'message' => 'Vote was deleted');
  }

  private function __pending_submission($cc = false) {
    $fltr = array("{$this->_tbls['contest']}.status" => INACTIVE_CONTEST, "submission_start_date like " => input_date('now') . '%');
    $sort = array('created_date' => 'ASC', 'submission_start_date' => 'ASC');

    $fltr["country.code"] = @issetVal($cc, CC_CODE);

    $contests = $this -> contest_getall($fltr, $sort);
    if (!empty($contests)) {
      $contest = array_shift($contests);
      // activate for voting
      $resp = $this -> contest_activate_submission($contest['id']);

      if ($resp['code'] > -1) {
        $subject = "[POW {$contest['cc_code']}] Activating Voting Period for {$contest['name']}";
        $message = $resp['message'];
        $message .= print_r($contest, true);

        @$this -> notify_admin_custom($subject, $message);
        return true;
      } else {
        $resp['message'] = "[POW {$contest['cc_code']}] " . $resp['message'];
        return $resp;
      }
    }
    return true;
  }

  private function __pending_voting($cc = false) {
    $fltr = array("{$this->_tbls['contest']}.status" => ACTIVESUBMIT_CONTEST, "voting_start_date like " => input_date('now') . '%');
    $sort = array('created_date' => 'ASC', 'submission_start_date' => 'ASC');
    $fltr["country.code"] = @issetVal($cc, CC_CODE);

    $contests = $this -> contest_getall($fltr, $sort);
    if (!empty($contests)) {

      $contest = array_shift($contests);
      // activate for voting
      $resp = $this -> contest_activate_voting($contest['id']);

      if ($resp['code'] > -1) {
        $subject = "[MUM {$contest['cc_code']}] Activating Voting Period for {$contest['name']}";
        $message = $resp['message'];
        $message .= print_r($contest, true);

        @$this -> notify_admin_custom($subject, $message);
      } else {
        $resp['message'] = "[POW {$contest['cc_code']}]" . $resp['message'];
        return $resp;
      }
    }
    return true;
  }

  function contest_getpending() {
    $this -> __pending_voting();
    $this -> __pending_submission();
  }

  function contest_activate($id = false, $status = false) {
    /**
     * TODO: check user session here
     */
    $response = array('code' => 0, 'message' => "");
    if (!$id) {
      return array('code' => -1, 'message' => "ID is required");
    }
    if (!$status) {
      return array('code' => -1, 'message' => "Status is required");
    }

    // cleanup the data
    $this -> db -> where('id', $id);
    $data = array('status' => $status, 'modified_date' => input_datetime('now'));
    $this -> db -> update($this -> _tbls['contest'], $data);

    return array('code' => 0, 'message' => 'Contest was activated ');
  }

  function contest_haswinners($id = false) {
    $response = array('code' => 0, 'message' => "");
    if (!$id) {
      return array('code' => -1, 'message' => "ID is required");
    }

    // cleanup the data
    $this -> db -> where('pow_contest_id', $id);
    $qry = $this -> db -> get($this -> _tbls['results']);
    $results = $qry -> result_array();

    return !empty($results);
  }

  function contest_conclude($id = false) {
    /**
     * TODO: check user session here
     */
    $response = array('code' => 0, 'message' => "");
    if (!$id) {
      return array('code' => -1, 'message' => "ID is required");
    }

    // check if has winners
    $has_winners = $this -> contest_haswinners($id);

    if ($has_winners) {
      // cleanup the data
      $this -> db -> where('id', $id);
      $data = array('status' => CONCLUDED_CONTEST, 'modified_date' => input_datetime('now'));
      $this -> db -> update($this -> _tbls['contest'], $data);

      // get all participants
      $_allentries = $this -> contest_entriesall($id, 0, APPROVED_ENTRY);
      $_emails = array();
      foreach ($_allentries as $item) {
        $_emails[] = $item['email_address'];
      }
      $emaildata = array('contest_id' => $id);
      $this -> notify_batch('notify-results-out', $emaildata, implode(", ", $_emails));

      return array('code' => 0, 'message' => 'Contest was concluded');
    } else {
      return array('code' => -1, 'message' => 'Unable to conclude contest because there are no declared winners yet.');
    }
  }

  function contest_published($id = false) {
    $response = array('code' => 0, 'message' => "");
    if (!$id) {
      return array('code' => -1, 'message' => "ID is required");
    }

    // cleanup the data
    $this -> db -> where('id', $id);
    $data = array('status' => PUBLISHED_CONTEST, 'modified_date' => input_datetime('now'));
    $this -> db -> update($this -> _tbls['contest'], $data);

    return array('code' => 0, 'message' => 'Contest was published');
  }

  /////////////////////////////////
  ///   AGE GROUP

  function agegroup_getall($filter = array(), $sort = array()) {
    if ($filter) {
      foreach ($filter as $key => $value) {
        $this -> db -> where($key, $value);
      }
    }
    $sort = @issetVal($sort, array('id' => 'asc'));

    foreach ($sort as $fld => $ordr) {
      $this -> db -> order_by($fld, $ordr);
    }

    $qry = $this -> db -> get($this -> _tbls['agegroup']);
    return $qry -> result_array();
  }

  function agegroup_get($id = 0) {
    $this -> db -> where('id', $id);
    $qry = $this -> db -> get($this -> _tbls['agegroup']);
    return $qry -> num_rows() > 0 ? $qry -> row_array() : false;
  }

  /////////////////////////////////
  ///   POW CONTEST ENTRIES

  function entries_get($contest_id = 0, $status = false, $sortby = false) {
    if (!$contest_id) {
      return array('code' => 0, 'message' => "Contest ID is required");
    }

    $tbl_entries = $this -> _tbls['entries'];
    $tbl_votes = $this -> _tbls['votes'];
    $tbl_users = $this -> _tbls['users'];
    $tbl_contest = $this -> _tbls['contest'];
    $tbl_categ = $this -> _tbls['category'];
    $tbl_status = 'status';

    $sql = "
SELECT {$tbl_entries}.*,
{$tbl_users}.first_name,
{$tbl_users}.last_name,
{$tbl_users}.email_address,
{$tbl_status}.name as status_name,
{$tbl_contest}.name as contest_name,
{$tbl_contest}.status as contest_status,
ifnull(x.cnt, 0) as points
FROM {$tbl_entries}
LEFT JOIN
( SELECT {$tbl_votes}.pow_entry_id, count(*) as cnt
FROM {$tbl_votes}
WHERE {$tbl_votes}.status=?
GROUP BY {$tbl_votes}.pow_entry_id ) x
ON {$tbl_entries}.id = x.pow_entry_id
LEFT JOIN {$tbl_categ} ON {$tbl_entries}.pow_category_id={$tbl_categ}.id
LEFT JOIN {$tbl_contest} ON {$tbl_categ}.pow_contest_id={$tbl_contest}.id
LEFT JOIN {$tbl_users} ON {$tbl_users}.id={$tbl_entries}.user_id
LEFT JOIN {$tbl_status} ON {$tbl_entries}.status={$tbl_status}.id AND {$tbl_status}.type=?
WHERE pow_contest_id=? AND {$tbl_entries}.status=?
ORDER BY points DESC";

    $qry = $this -> db -> query($sql, array(VERIFIED_VOTE, 'pow_entry', $contest_id, $status));

    return $qry -> result_array();
  }

  function entries_getall($status = false, $fltr = array(), $orderby = array('points'=>'ASC')) {

    $tbl_entries = $this -> _tbls['entries'];
    $tbl_contest = $this -> _tbls['contest'];
    $tbl_votes = $this -> _tbls['votes'];
    $tbl_users = $this -> _tbls['users'];
    $tbl_categ = $this -> _tbls['category'];
    $tbl_status = 'status';

    $values = array(VERIFIED_VOTE, 'pow_entry', $status);
    $fltr_sql = array();
    $ordby_sql = array();

    if (is_array($fltr)) {
      foreach ($fltr as $fld => $val) {
        $fltr_sql[] = "{$fld}=?";
        $values[] = $val;
      }
    }

    foreach ($orderby as $fld => $srt) {
      $ordby_sql[] = " $fld $srt ";
    }

    $sql = "
SELECT {$tbl_entries}.*, {$tbl_users}.first_name,  {$tbl_users}.last_name,  {$tbl_users}.email_address,
{$tbl_status}.name as status_name, ifnull(x.cnt, 0) as points,
{$tbl_contest}.name as contest_name, {$tbl_contest}.status as contest_status, {$tbl_contest}.id as contest_id 
FROM {$tbl_entries}
LEFT JOIN
( SELECT {$tbl_votes}.pow_entry_id, count(*) as cnt
FROM {$tbl_votes}
WHERE {$tbl_votes}.status=?
GROUP BY {$tbl_votes}.pow_entry_id ) x
ON {$tbl_entries}.id = x.pow_entry_id
LEFT JOIN {$tbl_categ} ON {$tbl_entries}.pow_category_id={$tbl_categ}.id
LEFT JOIN {$tbl_contest} ON {$tbl_categ}.pow_contest_id={$tbl_contest}.id
LEFT JOIN {$tbl_users} ON {$tbl_users}.id={$tbl_entries}.user_id
LEFT JOIN {$tbl_status} ON {$tbl_entries}.status={$tbl_status}.id AND {$tbl_status}.type=?
WHERE {$tbl_entries}.status=? " . (@issetNE($fltr_sql) ? " AND " . implode(" AND ", $fltr_sql) : "") . " ORDER BY " . implode(", ", $ordby_sql);

    $qry = $this -> db -> query($sql, $values);

    return $qry -> result_array();
  }

  function entries_get_activevoting($category_id = 0) {
    $tbl_contest = $this -> _tbls['contest'];
    $fltr = array("{$tbl_contest}.status" => ACTIVEVOTING_CONTEST);
    if ($category_id) {
      $fltr["{$tbl_contest}.category_id"] = $agegroup_id;
    }
    return $this -> entries_getall(APPROVED_ENTRY, $fltr);
  }

  /////////////////////////////////
  ///   POW ENTRIES

  /**
   * entry_add
   */
  function entry_add($pow_category_id = 0, $postdata = false, $addphoto = false) {
    /**
     * TODO: check user authentication here
     *       also need userid of authenticated user here
     */
    if (!$pow_category_id) {
      return array('code' => -1, 'message' => "Category ID is missing");
    }

    if (!$postdata) {
      return array('code' => -1, 'message' => "Data is missing!");
    }

    if (!@issetNE($postdata['user_id'])) {
      return array('code' => -1, 'message' => "User ID is missing!");
    }

    $postdata['pow_category_id'] = $pow_category_id;
    $postdata = $this -> __entry_prepdata($postdata);

    // handle the photo upload
    if ($addphoto && @issetNE($_FILES)) {
      $postdata = $this -> entry_photo_store($postdata);
    }

    $this -> db -> insert($this -> _tbls['entries'], $postdata);

    // alert the admin
    $this -> notify_admin('notify-admin-new-entry', $postdata);

    // alert the admin
    $this -> notify_user('notify-user-new-entry', $postdata);

    // alert the user
    return array('code' => 0, 'message' => 'Entry was added succesfully', 'data' => $postdata);
  }

  function entry_edit($entry_id, $postdata = false) {
    /**
     * TODO: check user authentication here
     *       also need userid of authenticated user here
     */
    if (!$entry_id) {
      return array('code' => -1, 'message' => "Entry ID is missing");
    }

    if (!$postdata) {
      return array('code' => -1, 'message' => "Data is missing!");
    }
    $postdata = $this -> __entry_prepdata($postdata);
    $this -> db -> where('id', $entry_id);
    $this -> db -> update($this -> _tbls['entries'], $postdata);
    // alert the user
    return array('code' => 0, 'message' => 'Entry was updated succesfully', 'data' => $postdata);
  }

  function entry_addimage($postdata, $imagepath = false) {
    if (!$postdata)
      return array('code' => -1, 'message' => "Post data is missing");

    if (!$imagepath)
      return array('code' => -1, 'message' => "Image Path is missing");

    $target_path = $this -> pow -> __entry_photopath($postdata);
    if (!is_dir($target_path)) {
      if (mkdir($target_path, 0777, true) === FALSE) {// try to create the dir
        $json['status'] = 'error';
        $json['issue'] = "Unable to create directory $target_path";
        echo json_encode($json);
        exit ;
      }
    }
    $filename = basename($imagepath);
    //copy first
    copy($imagepath, "$target_path/$filename");
    $this -> entry_photo_createthumbnails('image/jpg', $target_path, $filename);

    return $filename;
  }

  /**
   *
   */
  private function __entry_prepdata($postdata) {
    $prepdata = array();
    $_fields = qw('pow_category_id email_list birth_date token_id name caption total_vote misc_data photo_filename image_type user_id created_date modified_date status');

    foreach ($_fields as $fld) {
      if (@issetNE($postdata[$fld]) || @issetNE($_REQUEST[$fld]))
        $prepdata[$fld] = @issetVal($postdata[$fld], @issetVal($_REQUEST[$fld]));
    }
    if (@issetNE($postdata['birth_date'])) {
      $prepdata['birth_date'] = input_datetime($postdata['birth_date']);
    }

    if (!isset($postdata['token_id'])) {
      // this is a new entry
      $prepdata['created_date'] = input_datetime('now');
      $prepdata['token_id'] = $this -> __entry_generate_token_id($prepdata);
    }

    return $prepdata;
  }

  /**
   *
   */
  private function __entry_generate_token_id($postdata = false) {
    $str = implode("#", array($postdata['pow_contest_id'], $postdata['name'], $postdata['caption'], $postdata['created_date']));
    return md5($str);
  }

  /**
   *
   */
  function entry_get_bytoken($token_id = false) {
    if (!$token_id)
      return false;

    $tbl_contest = $this -> _tbls['contest'];
    $tbl_entry = $this -> _tbls['entries'];
    $tbl_category = $this -> _tbls['category'];

    $sql = "
SELECT
{$tbl_category}.name as category_name,{$tbl_category}.id as category_id,
{$tbl_contest}.status as contest_status,{$tbl_contest}.id as contest_id,
{$tbl_entry}.*
FROM {$tbl_entry}
LEFT JOIN {$tbl_category} ON {$tbl_entry}.pow_category_id={$tbl_category}.id
LEFT JOIN {$tbl_contest} ON {$tbl_category}.pow_contest_id={$tbl_contest}.id
WHERE {$tbl_entry}.token_id= ?";
    $values = array($token_id);

    $qry = $this -> db -> query($sql, $values);
    //$this->db->get( $this->_tbls['results'] );
    return $qry -> num_rows() ? $qry -> row_array() : false;
  }

  /**
   *
   */
  function entry_get($id) {
    if (!$id)
      return false;

    $this -> db -> where('id', $id);
    $qry = $this -> db -> get($this -> _tbls['entries']);

    return $qry -> num_rows() ? $qry -> row_array() : false;
  }

  function entry_get_complete($token_id = false) {

    $tbl_entry = $this -> _tbls['entries'];
    $tbl_contest = $this -> _tbls['contest'];

    $fltr = array("{$tbl_entry}.token_id" => $token_id);
    $data = $this -> entries_getall(APPROVED_ENTRY, $fltr);

    return array_shift($data);
  }

  function entry_get_complete_byid($id = false) {

    $tbl_entry = $this -> _tbls['entries'];
    $tbl_contest = $this -> _tbls['contest'];

    $fltr = array("{$tbl_entry}.id" => $id);
    $data = $this -> entries_getall(APPROVED_ENTRY, $fltr);

    return array_shift($data);
  }

  function entry_get_topscorer($contest_id = 0) {
    if (!$contest_id)
      return false;

    $tbl_entry = $this -> _tbls['entries'];
    $tbl_contest = $this -> _tbls['contest'];

    $fltr = array("{$tbl_entry}.pow_contest_id" => $contest_id);
    $data = $this -> contest_entriesall($contest_id);
    //entries_getall(APPROVED_ENTRY, $fltr, array('points' => 'DESC'));

    $winner = array_shift($data);

    return $winner;
  }

  private function __results_prepdata($postdata = false) {

    $prepdata = array();
    $_contest_fields = qw('pow_contest_id pow_entry_id total_vote misc_data award_type_id concluded_date concluded_by_id');

    $_date_fields = qw('');

    foreach ($_contest_fields as $fld) {
      if (@issetNE($postdata[$fld]) || @issetNE($_REQUEST[$fld]))
        $prepdata[$fld] = @issetVal($postdata[$fld], @issetVal($_REQUEST[$fld]));

      if (in_array($fld, $_date_fields, true))
        $prepdata[$fld] = input_datetime($prepdata[$fld]);
    }
    return $prepdata;
  }

  function results_add($contest_id, $data = array()) {
    if (!$contest_id)
      return false;

    $postdata = $this -> __results_prepdata($data);
    $postdata['concluded_date'] = input_datetime('now');
    $postdata['concluded_by_id'] = $this -> session -> userdata('user_id');
    $postdata['award_type_id'] = @issetVal($postdata['award_type_id'], 0);
    // ? $postdata['award_type_id'] : 0;

    $this -> db -> where("pow_contest_id", $contest_id);
    $this -> db -> where("pow_entry_id", $postdata['pow_entry_id']);
    $qry = $this -> db -> get($this -> _tbls['results']);
    $result = $qry -> result_array();

    if (!empty($result))
      return array('code' => -1, 'message' => 'Duplicate entry');

    $this -> db -> insert($this -> _tbls['results'], $postdata);

    // send the notification messages
    $entry = $this -> entry_get_complete_byid($postdata['pow_entry_id']);
    $emaildata = array('token_id' => $entry['token_id'], 'award_name' => $this -> awards[$postdata['award_type_id']], 'user_id' => $entry['user_id'], 'pow_category_id' => $entry['pow_category_id']);
    $msg = $this -> notify_user('notify-winner', $emaildata);
    return array('code' => 0, 'message' => 'Result was added succesfully. ' . $msg);
  }

  /**
   *
   */
  function entry_getvotes($id = 0, $status = false) {
    if (!$id)
      return false;
    $this -> db -> where('pow_entry_id', $id);
    if ($status !== false)
      $this -> db -> where('status', $status);

    $this -> db -> select("status.name as status_name, pow_vote.*");
    $this -> db -> join('status', "status.id=status AND status.type='pow_vote'", 'left');

    $this -> db -> order_by('status', 'DESC');

    $qry = $this -> db -> get($this -> _tbls['votes']);

    return $qry -> num_rows() ? $qry -> result_array() : false;
  }

  /**
   *
   */
  function entry_photo_store($postdata = false) {
    /**
     * TODO: moderate the file uploaded
     */
    $path = $this -> __entry_photopath($postdata);
    $imgtype = $_FILES['filephoto']['type'];

    // lets modify the filename
    //$photofilename = filename_safe( )

    $photo = moveUploadedFile('filephoto', $path);

    $postdata['photo_filename'] = $photo;
    $postdata['image_type'] = $imgtype;

    $this -> entry_photo_createthumbnails($imgtype, $path, $photo);

    return $postdata;
  }

  /**
   *
   */
  function entry_photo_createthumbnails($imgtype, $path, $photo) {
    createThumbnail($imgtype, $path, $photo, 320);
    createThumbnail($imgtype, $path, $photo, 100);

    return true;
  }

  function entry_photo_rotate($path, $photo, $angle) {
    $image_file = realpath("{$path}/{$photo}");
    if (!$image_file)
      return false;

    $image_src = imagecreatefromjpeg($image_file);
    $image_rot = imagerotate($image_src, $angle, 0);
    //save it
    imagejpeg($image_rot, $image_file);
    createThumbnail("image/jpg", $path, $photo, 320);
    createThumbnail("image/jpg", $path, $photo, 100);

    return true;
  }

  /**
   *
   */
  function entryphoto_get($token_id = false, $size = false) {
    if (!$token_id)
      return false;

    $entry = $this -> entry_get_bytoken($token_id);
    if (!$entry)
      return false;

    $path = $this -> __entry_photopath($entry);
    $photofile = $entry['photo_filename'];
    $image_type = $entry['image_type'];

    if ($size) {
      $thumbfile = "thumb.{$size}.{$photofile}";
      if (realpath("{$path}/{$thumbfile}")) {
        $photofile = $thumbfile;
      }
    }

    return array($photofile, $image_type, $path);
  }

  function entryphoto_url($token_id = false, $size = false) {
    if (!$token_id)
      return false;

    $entry = $this -> entry_get_bytoken($token_id);
    if (!$entry)
      return false;

    $path = $this -> __entry_photopath($entry);
    $photofile = $entry['photo_filename'];
    $image_type = $entry['image_type'];

    if ($size) {
      $thumbfile = "thumb.{$size}.{$photofile}";
      if (realpath("{$path}/{$thumbfile}")) {
        $photofile = $thumbfile;
      }
    }

    return array($photofile, $image_type, $path);
  }

  function __entry_photopath($postdata = false) {
    $root_path = realpath($this -> config -> config['root_path']);
    $entry_path = $this -> options['upload_path'];
    if (!$entry_path) {
      $this -> options_set('upload_path', '/pow-entries');
    }
    $entry_path = $root_path . "/" . $this -> options['upload_path'];

    return sprintf("%s/%s", realpath($entry_path), filename_safe($postdata['token_id']));
  }

  /**
   *
   */
  function entry_approve($entry_id = 0) {
    if (!$entry_id)
      return array('code' => -1, 'message' => "Entry ID is required");

    // cleanup the data
    $this -> db -> where('id', $entry_id);
    $this -> db -> where('status', APPROVED_ENTRY);
    $qry = $this -> db -> get($this -> _tbls['entries']);
    $row = $qry -> row_array();

    //if (!empty($row)) return array('code' => 0, 'message' => "Entry is already approved");

    $this -> db -> where('id', $entry_id);
    $this -> db -> update($this -> _tbls['entries'], array('status' => APPROVED_ENTRY));

    $entry = $this -> entry_get($entry_id);
    $emaildata = array('token_id' => $entry['token_id'], 'user_id' => $entry['user_id'], 'pow_category_id' => $entry['pow_category_id']);

    // notify the user
    $this -> notify_user('notify-user-approved', $emaildata);

    $__emails = preg_split("/,|\n|\r\n/ims", $entry['email_list']);
    $__email_list = array();
    foreach ($__emails as $_eml) {
      $_eml = trim($_eml);
      if ($_eml && validEmail($_eml)) {
        $__email_list[] = $_eml;
      }
    }
    // also email the email list
    $this -> notify_batch('notify-email-contacts', $emaildata, implode(",", $__email_list));

    return array('code' => 0, 'message' => 'Entry was approved' . $msg);
  }

  function entry_reject($entry_id = 0) {
    if (!$entry_id)
      return array('code' => -1, 'message' => "Entry ID is required");

    // cleanup the data
    $this -> db -> where('id', $entry_id);
    $this -> db -> update($this -> _tbls['entries'], array('status' => REJECTED_ENTRY));

    $entry = $this -> entry_get($entry_id);
    $emaildata = array('token_id' => $entry['token_id'], 'user_id' => $entry['user_id'], 'pow_contest_id' => $entry['pow_contest_id']);

    $msg = $this -> notify_user('notify-user-rejected', $emaildata);

    return array('code' => 0, 'message' => 'Entry was rejected.' . $msg);
  }

  function entry_delete($entry_id = 0) {
    if (!$entry_id)
      return array('code' => -1, 'message' => "Entry ID is required");

    // cleanup the data
    $this -> db -> where('id', $entry_id);
    $this -> db -> delete($this -> _tbls['entries']);
    //, array('status' => REJECTED_ENTRY));

    return array('code' => 0, 'message' => 'Entry was deleted.');
  }

  function entry_votes_get() {
  }

  function entry_votes_getall($entry_id = 0, $status = false) {
    if (!$entry_id)
      return array('code' => -1, 'message' => "Entry ID is required");

    $this->db->select("status.name as status_name, {$this->_tbls['votes']}.*");
    $this->db->where('pow_entry_id', $entry_id);
    if ($status !== false){
      $this->db->where('status', $status);      
    }
    $this -> db -> join('status', "{$this->_tbls['votes']}.status=status.id AND status.type='pow_vote'");    
    $qry = $this->db->get($this->_tbls['votes']);
    
    return $qry->result_array();

  }

  function vote_entry($token_id = '', $validEmail = false) {
    if (!$token_id)
      return array('code' => -1, 'message' => "Token ID is required");
    $entry = $this -> entry_get_bytoken($token_id);
    if (!$entry)
      return array('code' => -1, 'message' => "Invalid Token ID ");

    if (!validEmail($validEmail)) {
      return array('code' => -1, 'message' => "Email is not valid.");
    }

    $vote = array();
    $vote['pow_entry_id'] = $entry['id'];
    $vote['ip_address'] = $_SERVER['REMOTE_ADDR'];
    $vote['email_address'] = $validEmail;
    $vote['status'] = UNVERIFIED_VOTE;
    $vote['date_voted'] = input_datetime('now');
    $vote['vote_code'] = generate_random(10, 'ALPHANUM');
    $vote['vote_hash'] = $this -> __vote_generatecode($vote);
    $vote['category_id'] = $entry['category_id'];

    // check if logged in
    if ($this -> session -> userdata('logged_in') == true) {
      $vote['status'] = VERIFIED_VOTE;
    }

    $vote['misc_data'] = json_encode($vote);

    // check for duplicacy of pow_entry_id and email_address
    $this -> db -> where("pow_entry_id", $entry['id']);
    $this -> db -> where("email_address", $validEmail);
    $qry = $this -> db -> get($this -> _tbls['votes']);
    if ($qry -> num_rows())
      return array('code' => -1, 'message' => "Email already used to vote.");

    //$this -> db -> where("pow_entry_id", $entry['id']);
    //$this -> db -> where("email_address", $validEmail);

    $this -> db -> join($this -> _tbls['votes'], "{$this -> _tbls['votes']}.pow_entry_id={$this -> _tbls['entries']}.id");
    $this -> db -> where("{$this -> _tbls['votes']}.email_address", $validEmail);
    $this -> db -> where("{$this -> _tbls['votes']}.category_id", $entry['category_id']);
    $qry = $this -> db -> get($this -> _tbls['entries']);
    if ($qry -> num_rows())
      return array('code' => -1, 'message' => "Email already used to vote in this category.");

    $this -> db -> insert($this -> _tbls['votes'], $vote);
    // inform the voter!
    if ($this -> session -> userdata('logged_in') != true) {
      $emaildata = array('token_id' => $entry['token_id'], 'email_address' => $validEmail, 'pow_category_id' => $entry['pow_category_id'], '%%VOTE_CODE%%' => $vote['vote_code'], '%%VOTE_CONFIRM_LINK%%' => site_url('pow/verifyvote/' . $entry['token_id']));
      $this -> notify_user('notify-voter-code', $emaildata);
    }

    return array('code' => 0, 'message' => $vote['vote_code']);
  }

  function vote_code_verify($vote_code = false) {
    if (!$vote_code)
      return array('code' => -1, 'message' => "Vote verification code is required");

    $this -> db -> where('vote_code', $vote_code);
    $this -> db -> where('status', UNVERIFIED_VOTE);
    $qry = $this -> db -> get($this -> _tbls['votes']);

    if (!$qry -> num_rows())
      return array('code' => -1, 'message' => "Invalid vote verification code.");

    $votedata = $qry -> row_array();
    $vote_hash = $this -> __vote_generatecode($votedata);

    if ($vote_hash !== $votedata['vote_hash']) {
      return array('code' => -1, 'message' => "Invalid vote verification code.");
    }

    $this -> db -> where('vote_code', $vote_code);
    $this -> db -> where('status', UNVERIFIED_VOTE);
    $this -> db -> update($this -> _tbls['votes'], array("status" => VERIFIED_VOTE));

    // verified vote? email the voter
    $entry = $this -> entry_get_complete_byid($votedata['pow_entry_id']);
    $emaildata = array('token_id' => $entry['token_id'], 'email_address' => $votedata['email_address'], 'user_id' => $entry['user_id'], 'pow_category_id' => $entry['pow_category_id']);
    $this -> notify_user('notify-voter-okvote', $emaildata);

    return true;
  }

  private function __vote_generatecode($votedata) {

    $flds = qw('vote_code pow_entry_id pow_contest_id ip_address email_address');
    $votekey = array($this -> secret_word);
    foreach ($flds as $fld) {
      $votekey[] = @issetVal($votedata[$fld], false);
    }

    // $votekey[] = strtotime($votedata['date_voted']);
    $vote_code = implode("-", $votekey);

    //printr( $vote_code );

    return md5($vote_code);
  }

  /**
   * Fetch contact from openinviter
   *
   */
  function fetch_contact($provider, $username, $password) {
    include_once ("OpenInviter/openinviter.php");

    $inviter = new OpenInviter();
    $inviter -> startPlugin($provider);

    if (!$inviter -> login($username, $password))
      return array('code' => -1, 'message' => "Login failed.");

    if (false === ($contacts = $inviter -> getMyContacts()))
      return array('code' => -1, 'message' => "Unable to fetch contacts.");

    return array('code' => 0, 'message' => $contacts);
  }

  // results
  function results_get($contest_id = 0) {
    if (!$contest_id)
      return false;
    /*
     $tbls['agegroup'] = 'age_group';
     $tbls['options'] = 'pow_option';
     $tbls['contest'] = 'pow_contest';
     $tbls['entries'] = 'pow_entry';
     $tbls['votes'] = 'pow_vote';
     $tbls['results'] = 'pow_result';
     $tbls['users'] = 'user';
     */
    $tbl_agegrp = $this -> _tbls['agegroup'];
    $tbl_entry = $this -> _tbls['entries'];
    $tbl_contest = $this -> _tbls['contest'];
    $tbl_entry = $this -> _tbls['entries'];
    $tbl_result = $this -> _tbls['results'];
    $tbl_user = 'user';

    $flds = implode(',', array("{$tbl_user}.*, {$tbl_contest}.name as contest_name", "{$tbl_entry}.*", "{$tbl_result}.*", ));
    $this -> db -> select($flds);
    $this -> db -> from($tbl_result);
    $this -> db -> join($tbl_contest, "{$tbl_contest}.id={$tbl_result}.pow_contest_id");
    $this -> db -> join($tbl_entry, "{$tbl_entry}.id={$tbl_result}.pow_entry_id");
    $this -> db -> join($tbl_user, "{$tbl_user}.id={$tbl_entry}.user_id");
    $this -> db -> where("{$tbl_result}.pow_contest_id", $contest_id);
    $qry = $this -> db -> get();

    return $qry -> result_array();
  }

  ////////////////////////////////////////////
  /// DEFAULT EMAIL MSGS

  /**
   * (1)  Notify admin for new entry [notify-admin-new-entry]
   * (2)  Notify user for new entry [notify-user-new-entry]
   * (3)  Notify user for approved entry [notify-user-approved]
   * (4)  Notify user for rejected entry [notify-user-rejected]
   * (5)  Notify voter for VOTECODE [notify-voter-code]
   * (6)  Email contacts of POW entry [notify-email-contacts]
   * (7)  Notify voter for succesful vote [notify-voter-okvote]
   * (8)  Notify admin for start of voting period * requires cron
   * (9)  Notify admin for end of voting period * requires cron
   * (10) Notify user for winning entry [notify-winner]
   */

  function email_log($from, $to, $subj, $msg, $result) {
    $data = array();
    $data['email_from'] = $from;
    $data['email_rcpt'] = $to;
    $data['email_subject'] = $subj;
    $data['email_message'] = $msg;
    $data['email_date'] = input_datetime('now');
    $data['email_result'] = $result;

    $this -> db -> insert('pow_email_log', $data);
    return true;
  }

  function email_log_view() {
    $this -> db -> order_by('email_date', 'DESC');
    $qry = $this -> db -> get('pow_email_log');
    return $qry -> result_array();
  }

  private function notify_admin_custom($subject = false, $message = false) {
    if (!$subject || !$message)
      return false;

    $this -> notify($subject, $message, $this -> options['adminemail']);
  }

  function notify($subject, $message, $rcpt, $isbatch = false) {
    $cfg = array();
    $cfg['protocol'] = 'smtp';
    $cfg['smtp_port'] = 587;
    $cfg['smtp_host'] = 'smtp.mailgun.org';
    $cfg['smtp_user'] = 'postmaster@atraxia.mailgun.org';
    $cfg['smtp_pass'] = '5nz2d4hka1n3';
    $cfg['email_from_address'] = 'noreply@mumcentre.com';
    $cfg['email_from_name'] = 'Mumcentre™ Administrator';
    $cfg['bcc_batch_mode'] = TRUE;

    $cfg['mailtype'] = 'html';
    $cfg['charset'] = 'iso-8859-1';
    // $cfg['wordwrap'] = TRUE;

    $this -> load -> library('email');
    $this -> email -> initialize($cfg);
    $this -> email -> set_newline("\r\n");

    $this -> email -> from($this -> options['email_from_address'], $this -> options['email_from_name']);
    $this -> email -> subject($subject);
    $this -> email -> message($message);

    if ($isbatch) {
      $this -> email -> bcc($rcpt);
    } else {
      $this -> email -> to($rcpt);
    }

    $emailstatus = @$this -> email -> send() ? "EMAIL SENT!<br/>" : "UNABLE TO SEND<br/>";
    $this -> email_log(" {$this -> options['email_from_address']}, {$this -> options['email_from_name']} ", $rcpt, $subject, $message, $emailstatus . $this -> email -> print_debugger());

    return true;
  }

  private function notify_admin($emailtype = false, $data = array()) {
    if (!$emailtype)
      return false;

    $subj = $this -> options_get("{$emailtype}_subject");
    $msg = $this -> options_get("{$emailtype}_message");

    if (!$subj || !$msg) {
      return false;
    }
    $values = $this -> emailfields_values($data);
    foreach ($data as $key => $val) {
      $values[$key] = $val;
    }

    $subj = strtr($subj, $values);
    $msg = strtr($msg, $values);

    return $this -> notify($subj, $msg, $this -> options['adminemail']);
  }

  private function notify_user($emailtype = false, $data = array()) {
    if (!$emailtype)
      return false;

    $subj = $this -> options_get("{$emailtype}_subject");
    $msg = $this -> options_get("{$emailtype}_message");
    $values = $this -> emailfields_values($data);

    foreach ($data as $key => $val) {
      $values[$key] = $val;
    }
    if (!$subj || !$msg || !@issetNE($values['email_address'])) {
      return false;
    }
    $subj = strtr($subj, $values);
    $msg = strtr($msg, $values);

    return $this -> notify($subj, $msg, $values['email_address']);
  }

  private function notify_batch($emailtype = false, $data = array(), $emaillist = "") {
    if (!$emailtype)
      return false;

    $subj = $this -> options_get("{$emailtype}_subject");
    $msg = $this -> options_get("{$emailtype}_message");

    $values = $this -> emailfields_values($data);
    foreach ($data as $key => $val) {
      $values[$key] = $val;
    }

    if (!$subj || !$msg) {
      return false;
    }
    $subj = strtr($subj, $values);
    $msg = strtr($msg, $values);

    return $this -> notify($subj, $msg, $emaillist, true);
  }

  function contest_country($contest_id = false) {
    if (!$contest_id)
      return false;

    $tblcccontest = $this -> _tbls['country'];
    $sql = "SELECT country.* FROM country LEFT JOIN {$tblcccontest} ON country.id={$tblcccontest}.country_id WHERE contest_id=?";
    $qry = $this -> db -> query($sql, array($contest_id));

    return $qry -> row_array();
  }

  function emailfields_values($data = false, $content = false) {
    $flds = array();
    //$this -> __default_emailfields();
    // things to check
    // user_id

    if (@issetNE($data['user_id'])) {
      $this -> db -> where('id', $data['user_id']);
      $qry = $this -> db -> get('user');
      $userdata = $qry -> row_array();

      $flds['%%USER_FIRSTNAME%%'] = $userdata['first_name'];
      $flds['%%USER_LASTNAME%%'] = $userdata['last_name'];
      $flds['%%USER_EMAILADDR%%'] = $userdata['email_address'];
      $flds['email_address'] = @issetVal($data['email_address'], $userdata['email_address']);
      $flds['userdata'] = $userdata;
    }

    // pow_contest_id
    if (@issetNE($data['pow_category_id'])) {
      $contestdata = $this -> contest_info($data['pow_category_id']);
      //      $this -> contest_get($data['pow_contest_id']);
      $flds['%%CONTEST_NAME%%'] = $contestdata['name'];
      $flds['%%CONTEST_VOTING_END%%'] = out_date($contestdata['voting_end_date']);
      $flds['%%CONTEST_SUBMIT_END%%'] = out_date($contestdata['submission_end_date']);
      $flds['%%CONTEST_VOTING_START%%'] = out_date($contestdata['voting_end_date']);
      $flds['%%CONTEST_SUBMIT_START%%'] = out_date($contestdata['submission_end_date']);
      $flds['%%CONTEST_WINNERS_LINK%%'] = site_url('pow/winners');

      $flds['%%CMS_CONTEST_LINK%%'] = site_url('cms_pow/contest/');

      $flds['contestdata'] = $contestdata;
    }

    // token_id
    $contest_id = @issetVal($data['contest_id']);
    if (@issetNE($data['token_id'])) {
      $entrydata = $this -> entry_get_bytoken($data['token_id']);
      $contest_id = $entrydata['contest_id'];
      $flds['%%ENTRY_NAME%%'] = $entrydata['name'];
      $flds['%%ENTRY_TOKEN%%'] = $entrydata['token_id'];
      $flds['%%ENTRY_CAPTION%%'] = $entrydata['caption'];
      $flds['%%ENTRY_LINK%%'] = site_url('pow/entry/' . $entrydata['token_id']);
      $flds['%%ENTRY_PHOTO%%'] = get_entry_photo($entrydata['token_id'], $entrydata['photo_filename'], 240);
      $flds['%%ENTRY_PHOTO_FULL%%'] = get_entry_photo($entrydata['token_id'], $entrydata['photo_filename']);
      $flds['%%ENTRY_PHOTO_MED%%'] = get_entry_photo($entrydata['token_id'], $entrydata['photo_filename'], 320);
      $flds['%%ENTRY_CATEGORY%%'] = $entrydata['category_name'];
      $flds['%%ENTRY_VOTE%%'] = site_url('pow/vote/' . $entrydata['token_id']);
      $flds['%%CMS_ENTRY_LINK%%'] = site_url('/cms_pow/contest/');
      $flds['entrydata'] = $entrydata;
    }

    // get MUMCEnTRE_LINKS

    if ($contest_id) {
      $ccinfo = $this -> contest_country($contest_id);
    } else {
      $ccinfo = $this -> country_info();
    }

    $flds['%%MUMCENTRE_LINK%%'] = $ccinfo['url'];
    $flds['%%MUMCENTRE_SITE%%'] = str_replace('http://', '', $ccinfo['url']);
    $flds['%%MUMCENTRE_COUNTRY%%'] = $ccinfo['name'];
    $flds['%%MUMCENTRE_COUNTRY_CODE%%'] = $ccinfo['code'];
    $flds['%%MUMCENTRE_COUNTRY_LINK%%'] = $ccinfo['url'];
    $flds['%%MUMCENTRE_SUPPORT_EMAIL%%'] = $this -> options_get('adminemail');

    if (@issetNE($data['vote_code']))
      $flds['%%VOTE_CODE%%'] = $data['vote_code'];
    if (@issetNE($data['vote_confirm_link']))
      $flds['%%VOTE_CONFIRM_LINK%%'] = $data['vote_confirm_link'];
    if (@issetNE($data['award_name']))
      $flds['%%AWARD%%'] = $data['award_name'];

    return $flds;
  }

  function email_notifications() {
    $list = $this -> __default_notifications();

    foreach ($list as $eml => $emlvals) {
      foreach ($emlvals as $key => $val) {
        $optionvalue = $this -> options_get("{$eml}_{$key}");
        if ($optionvalue) {
          $list[$eml][$key] = $optionvalue;
        }
      }
    }

    return $list;
  }

  function email_fields() {
    return $this -> __default_emailfields();
  }

  private function __default_emailfields() {
    $flds = array();

    $flds['%%CMS_ENTRY_LINK%%'] = "CMS PendingEntry Link";
    $flds['%%CMS_CONTEST_LINK%%'] = "CMS Manage contest Link";

    $flds['%%USER_FIRSTNAME%%'] = "Participant Firstname";
    $flds['%%USER_LASTNAME%%'] = "Participant Lastname";

    $flds['%%CONTEST_NAME%%'] = "POW Contest Name";
    $flds['%%CONTEST_WINNERS_LINK%%'] = "Contest Winners Link";
    $flds['%%CONTEST_VOTING_END%%'] = "Contest Voting End date";
    $flds['%%CONTEST_SUBMIT_END%%'] = "Contest Submission End date";
    $flds['%%CONTEST_VOTING_START%%'] = "Contest Voting start date";
    $flds['%%CONTEST_VOTING_END%%'] = "Contest Voting end date";
    $flds['%%CONTEST_SUBMIT_START%%'] = "Contest Submission start date";
    $flds['%%CONTEST_SUBMIT_END%%'] = "Contest Submission end date";

    $flds['%%ENTRY_LINK%%'] = 'Entry Link';
    $flds['%%ENTRY_NAME%%'] = 'Entry Name';
    $flds['%%ENTRY_CAPTION%%'] = 'Entry Caption';
    $flds['%%ENTRY_PHOTO%%'] = 'Entry Photo URL';
    $flds['%%ENTRY_PHOTO_FULL%%'] = 'Entry Photo URL (full size)';
    $flds['%%ENTRY_PHOTO_MED%%'] = 'Entry Photo URL (medium size)';
    $flds['%%ENTRY_CATEGORY%%'] = "Entry Category Name";

    $flds['%%VOTE_CODE%%'] = "Vote Code";
    $flds['%%VOTE_CONFIRM_LINK%%'] = "Vote confirmation link";
    $flds['%%AWARD_NAME%%'] = "Award Name (Refer to POW_MODEL::Award)";

    $flds['%%MUMCENTRE_LINK%%'] = "Mumcentre Site URL";
    $flds['%%MUMCENTRE_SITE%%'] = "Mumcentre Site";
    $flds['%%MUMCENTRE_COUNTRY%%'] = "Mumcentre Country";
    $flds['%%MUMCENTRE_COUNTRY_CODE%%'] = "Mumcentre Country Code";
    $flds['%%MUMCENTRE_COUNTRY_LINK%%'] = "Mumcentre Country Link";
    $flds['%%MUMCENTRE_SUPPORT_EMAIL%%'] = "Mumcentre Support Email";

    return $flds;
  }

  private function __default_notifications($subject = false) {
    $defmsg = array();
    /*
     $defmsg[''] = array('subject'=>'');
     $defmsg['']['message'] = "";
     */

    $defmsg['notify-email-contacts'] = array('subject' => 'Pick of the Week invitation');
    $defmsg['notify-email-contacts']['description'] = 'Email to be sent to the participants email list';
    $defmsg['notify-email-contacts']['message'] = '
<p>Hi, you`ve been invited<span class="Apple-converted-space">&nbsp;</span></p>
<div style="font-size: 12px; padding: 5px 0;">
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="color: #8dad0e; font-family: Arial,Helvetica,sans-serif; font-size: small;"><strong>by %%USER_FIRSTNAME%% to vote for<br />%%ENTRY_NAME%% in<span class="Apple-converted-space">&nbsp;</span><br />Pic of the Week Contest.</strong></span><span class="Apple-converted-space">&nbsp;</span></p>
<div><a href="%%ENTRY_LINK%%"><img src="%%ENTRY_PHOTO%%" alt="Photo Name" /></a></div>
<div style="font-size: 12px; padding: 5px 0;"><a href="%%ENTRY_LINK%%"><strong>%%ENTRY_NAME%%</strong><br /><span style="font-size: x-small;">%%ENTRY_CAPTION%% </span></a></div>
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><br /><span style="color: #4c4c4c; font-family: Arial,Helvetica,sans-serif; font-size: small;"><strong>&nbsp;</strong>Simply visit <a href="%%MUMCENTRE_LINK%%">%%MUMCENTRE_SITE%%</a> or click on the pho to vote. You may submit your votes from now till %%compEnd%% am. Results of the Contest will be posted the same Monday at 2pm.<br /></span></p>
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="color: #4c4c4c; font-family: Arial,Helvetica,sans-serif; font-size: small;">Thank you.</span></p>
</div>';

    $defmsg['notify-admin-new-entry'] = array('subject' => '[%%CONTEST_NAME%%] New entry from %%USER_FIRSTNAME%% %%USER_LASTNAME%%');
    $defmsg['notify-admin-new-entry']['description'] = "Email notification to admin for new entries";
    $defmsg['notify-admin-new-entry']['message'] = "
New entry waiting for approval.

Go to %%CMS_ENTRY_LINK%% to manage pending link";

    $defmsg['notify-user-new-entry'] = array('subject' => 'Thank you for joining our Pick of the Week');
    $defmsg['notify-user-new-entry']['description'] = "Email notification to the participant upon joining a competition";
    $defmsg['notify-user-new-entry']['message'] = '
<p><span style="font-size: 9pt;">Dear %%USER_FIRSTNAME%%,</span></p>
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><strong><span style="font-size: 10.5pt;">Thank you for participating in the MomCenter %%MUMCENTRE_COUNTRY%% Pic Of The Week Contest.</span></strong></p>
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><strong><span style="font-size: 10.5pt;">Your submission in the %%ENTRY_CATEGORY%% category is being processed.</span></strong></p>
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">Kindly ensure that your member particulars are up to date so that we may contact you. You may log on to<span class="Apple-converted-space"> <a href="%%MUMCENTRE_LINK%%">%%MUMCENTRE_SITE%%</a> </span>to edit your profile anytime.</span></p>
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">Your submission will be posted this coming %%CONTEST_VOTING_START%%, subject to the editor`s approval. Results of the contest will be posted the following Monday.</span></p>
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><strong><span style="font-size: 10.5pt;">Good Luck!</span></strong></p>
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">&nbsp;</span></p>
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">Kind Regards,<span class="Apple-converted-space">&nbsp;</span><br />The MomCenter %%MUMCENTRE_COUNTRY%% Team</span></p>';

    $defmsg['notify-user-approved'] = array('subject' => 'Pick of the Week - Entry approved');
    $defmsg['notify-user-approved']['description'] = "Email notification to the participant upon approval of entry";
    $defmsg['notify-user-approved']['message'] = '
<p><span style="font-size: 9pt;">Dear %%USER_FIRSTNAME%%,</span></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><strong><span style="font-size: 10.5pt;">Thank you for participating in the MumCentre %%MUMCENTRE_COUNTRY%% Pic Of The Week Contest.</span></strong></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><strong><span style="font-size: 10.5pt;">Congratulations! Your submission for %%ENTRY_CATEGORY%% category has been approved.</span></strong></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">Kindly ensure that your member particulars are up to date so that we may contact you. You may log on to<span class="Apple-converted-space"> <a href="%%MUMCENTRE_LINK%%">%%MUMCENTRE_SITE%%</a> </span><a href="http://www.mumcentre.com.sg/" target="_blank"><span style="color: #52beef;">&nbsp;</span></a>to edit your profile anytime.</span></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><strong><span style="font-size: 9pt;">Your entry will be published and open for voting on %%CONTEST_VOTING_START%%, from 2pm onwards.<span class="Apple-converted-space">&nbsp;</span></span></strong><span style="font-size: 9pt;">&nbsp;</span></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">If you have invited your friends to vote during your submission, an email with your submitted entry will be sent to them. You may also invite more friends to vote for your entry by going to the voting page after the competition launch and using the "Invite more friends and family to vote" option.</span></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">Results of the contest will be posted the following Monday at 2pm.</span></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><strong><span style="font-size: 10.5pt;">Good Luck!</span></strong></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">&nbsp;</span></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">Kind Regards,<span class="Apple-converted-space">&nbsp;</span><br />The MumCentre %%MUMCENTRE_COUNTRY%% Team</span></p>';

    $defmsg['notify-user-rejected'] = array('subject' => 'Pick of the Week - Entry rejection');
    $defmsg['notify-user-rejected']['description'] = "Email notification to the participant upon rejection of entry";
    $defmsg['notify-user-rejected']['message'] = '
<p><span style="font-size: 9pt;">Dear %%USER_FIRSTNAME%%,</span></p>
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><strong><span style="font-size: 10.5pt;">Thank you for participating in the MomCenter %%MUMCENTRE_COUNTRY%% Pic Of The Week Contest.</span></strong></p>
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><strong><span style="font-size: 10.5pt;">We are sorry, your submission for </span></strong><strong><span style="font-size: 10.5pt;">%%ENTRY_CATEGORY%%</span></strong><strong><span style="font-size: 10.5pt;"> category has been rejected.</span></strong></p>
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">You may like to submit another for the upcoming MumCentre </span><span style="font-size: 9pt;">%%MUMCENTRE_COUNTRY%% </span><span style="font-size: 9pt;">Pic Of The Week Contest. For further enquiries or clarifications, kindly email %%MUMCENTRE_SUPPORT_EMAIL%% or visit MumCentre Singapore.</span></p>
<p><strong><span style="font-size: 10.5pt;">Good Luck!</span></strong></p>
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">&nbsp;</span></p>
<p style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">Kind Regards,<span class="Apple-converted-space">&nbsp;</span><br />The MomCenter %%MUMCENTRE_COUNTRY%% Team</span></p>';

    $defmsg['notify-voter-code'] = array('subject' => 'Pick of the Week - Vote confirmation code');
    $defmsg['notify-voter-code']['description'] = "Email notification to the voter with the VOTE CODE";
    $defmsg['notify-voter-code']['message'] = '
<p><strong><span style="font-size: 10.5pt;">Thank you for voting in the MumCentre %%MUMCENTRE_COUNTRY%% Pic Of The Week Contest.</span></strong></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: small;">To make your vote count for <strong>%%ENTRY_NAME%%</strong> in the <strong>%%ENTRY_CATEGORY%% </strong>category, please </span><span style="font-size: small;">enter this vote confirmation code to the following link.</span><span style="font-size: small;"><br /></span></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: small;">VOTE CONFIRMATION CODE: <strong>%%VOTE_CODE%%</strong></span></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: small;">Proceed to <a href="%%VOTE_CONFIRM_LINK%%"><strong>%%VOTE_CONFIRM_LINK%%</strong></a><br /></span></p>
<p>&nbsp;</p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">Kind Regards,<span class="Apple-converted-space">&nbsp;</span><br />The MumCentre %%MUMCENTRE_COUNTRY%% Team</span></p>';

    $defmsg['notify-voter-okvote'] = array('subject' => 'Thank you for voting for %%ENTRY_NAME%%');
    $defmsg['notify-voter-okvote']['description'] = "Email notification to the voter when vote is verified";
    $defmsg['notify-voter-okvote']['message'] = '
<p><strong><span style="font-size: 10.5pt;">Thank you for voting in the MumCentre %%MUMCENTRE_COUNTRY%% Pic Of The Week Contest.</span></strong></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: small;">Your vote for %%ENTRY_NAME%% in the %ENTRY_CATEGORY%% category has been verified.</span></p>
<p><span style="font-size: 9pt;">Results of the contest will be posted the following Monday at 2pm.</span></p>
<p><span style="font-size: 9pt;">&nbsp;</span></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">Kind Regards,<span class="Apple-converted-space">&nbsp;</span><br />The MumCentre %%MUMCENTRE_COUNTRY%% Team</span></p>';

    /*
     $defmsg['notify-admin-submit-end'] = array('subject' => '[%%CONTEST_NAME%%] Submission Period ending on %%CONTEST_SUBMIT_END%%');
     $defmsg['notify-admin-submit-end']['description'] = "Email notification to the voter when vote is verified";
     $defmsg['notify-admin-submit-end']['message'] = "
     Submission period is about to end on %%CONTEST_SUBMIT_END%%

     Go to %%CMS_CONTEST_LINK%% to manage the contest week";

     $defmsg['notify-admin-voting-end'] = array('subject' => '[%%CONTEST_NAME%%] Voting Period ending on %%CONTEST_VOTING_END%%');
     $defmsg['notify-admin-voting-end']['message'] = "
     Voting period is about to end on %%CONTEST_VOTING_END%%

     Go to %%CMS_CONTEST_LINK%% to manage the contest week";
     */
    $defmsg['notify-winner'] = array('subject' => 'Congratulations! You won the Pick Of the Week!');
    $defmsg['notify-winner']['description'] = "Email notification to the participant winning the contest";
    $defmsg['notify-winner']['message'] = '
<div style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="color: #339966; font-size: x-large;">Congratulations! Your entry won the<br /></span></div>
<div style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="color: #339966; font-size: x-large;">Pic of the Week Contest.</span></div>
<div style="color: #000000; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: medium; color: #993300;">The results for last week`s Contest are out and your entry&nbsp; %%ENTRY_NAME%% under %%ENTRY_CATEGORY%% Category got the most votes!</span></div>
<div style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: medium; color: #993300;"><br /></span></div>
<div style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: medium;"><a href="%%CONTEST_WINNERS_LINK%%">Click here</a><span class="Apple-converted-space">&nbsp;</span>now to find out who are the winning entries or visit <a href="%%MUMCENTRE_LINK%%">%%MUMCENTRE_SITE%%</a>. You may like to participate in this week`s Contest too! <br /></span></div>
<p><span style="font-size: 9pt;">&nbsp;</span></p>
<p style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: -webkit-auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;"><span style="font-size: 9pt;">Kind Regards,<span class="Apple-converted-space">&nbsp;</span><br />The MumCentre %%MUMCENTRE_COUNTRY%% Team</span></p>';

    $defmsg['notify-results-out'] = array('subject' => 'Congratulations! You won the Pick Of the Week!');
    $defmsg['notify-results-out']['description'] = "Email notification to all the participants after a concluded contest";
    $defmsg['notify-results-out']['message'] = '
<div><span style="color: #339966; font-size: x-large;">Thank you for participating in&nbsp;</span></div>
<div><span style="color: #339966; font-size: x-large;">Pic of the Week Contest.</span></div>
<div><span style="color: #339966; font-size: x-large;"><br /></span></div>
<div><span style="font-size: medium; color: #993300;">The results for last week`s Contest are out!</span></div>
<div><span style="font-size: medium; color: #993300;"><br /></span></div>
<div><span style="font-size: medium;"><a href="%%CONTEST_WINNERS_LINK%%">Click here</a> now to find out who are the winning entries or visit <a href="%%MUMCENTRE_LINK%%">%%MUMCENTRE_SITE%%</a>. You may like to participate in this week`s Contest too!&nbsp;</span></div>';

    return @issetVal($defmsg[$subject], $defmsg);
  }

  /*************************************************************************************/
  /**
   * Fetch the POW options and make it available on memory
   *
   * @param void
   */
  private function __load_options() {
    // check if pow is already setup, and go set it up!
    if (!$this -> __is_already_setup())
      return $this -> __setup();

    // fetch the options data then save it $this->options;
    $query = $this -> db -> get($this -> _tbls['options']);

    foreach ($query->result_array() as $row) {
      $this -> options[$row['item']] = json_decode($row['value']);
    }

    return true;
  }

  /**
   * checks if POW is already setup
   *
   */
  private function __is_already_setup() {
    /** TODO: find more interesting way to check if pow is already setup
     *        make it small and make it quick
     */
    $isokay = true;
    foreach (array_values($this->_tbls) as $tbl) {
      if (!$this -> db -> table_exists($tbl)) {
        $isokay = false;
        break;
      }
    }

    // check options if empty
    $qry = $this -> db -> get($this -> _tbls['options']);
    $options = $qry -> result_array();
    if (empty($options)) {
      $isokay = false;
    }

    return $isokay;
  }

  /**
   * Sets up the the POW tables
   *
   * @param void
   * @return  boolean true for success
   */
  private function __setup() {
    $powtables = $this -> __pow_tables_def();

    foreach ($powtables as $tbl => $tbldef) {
      $this -> db -> query($tbldef);
    }

    // update the options
    $defoptions = $this -> __pow_default_options();

    foreach ($defoptions as $item => $value) {
      $this -> options_set($item, $value);
    }

    return true;
  }

  /**
   * Returns the pow table definitions
   *
   * @param void
   * @return  hash  POW db table definitions
   */
  private function __pow_tables_def() {
    $powtbls = array();
    $powtbls['options'] = '
CREATE TABLE IF NOT EXISTS `pow_option` (
`id` tinyint(4) NOT NULL AUTO_INCREMENT,
`item` varchar(255) NOT NULL,
`value` TEXT DEFAULT NULL,
`description` text,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;';

    $powtbls['contest'] = '
CREATE TABLE IF NOT EXISTS `pow_contest` (
`id` bigint(20) NOT NULL AUTO_INCREMENT,
`name` varchar(100) NOT NULL,
`description` text DEFAULT NULL,
`submission_start_date` datetime DEFAULT NULL,
`submission_end_date` datetime DEFAULT NULL,
`voting_start_date` datetime DEFAULT NULL,
`voting_end_date` datetime DEFAULT NULL,
`created_by_id` bigint(20) DEFAULT NULL,
`created_date` datetime DEFAULT NULL,
`modified_by_id` bigint(20) DEFAULT NULL,
`modified_date` datetime DEFAULT NULL,
`status` tinyint(4) DEFAULT \'0\',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1';

    $powtbls['entries'] = '
CREATE TABLE IF NOT EXISTS `pow_entry` (
`id` bigint(20) NOT NULL AUTO_INCREMENT,
`pow_category_id` bigint(20) NOT NULL,
`token_id` varchar(40) NOT NULL,
`name` varchar(100) NOT NULL,
`caption` text,
`total_vote` int(11) NOT NULL,
`misc_data` text,
`photo_filename` varchar(100) NOT NULL,
`image_type` varchar(50) NOT NULL,
`user_id` bigint(20) NOT NULL,
`birth_date` datetime DEFAULT NULL,
`created_date` datetime DEFAULT NULL,
`modified_date` datetime DEFAULT NULL,
`status` tinyint(4) DEFAULT \'0\',
`email_list` TEXT DEFAULT null,
PRIMARY KEY (`id`),
KEY `idx_pow_entry_category` (`pow_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;';

    $powtbls['votes'] = '
CREATE TABLE IF NOT EXISTS `pow_vote` (
`id` bigint(20) NOT NULL AUTO_INCREMENT,
`pow_entry_id` bigint(20) NOT NULL,
`ip_address` varchar(15) NOT NULL,
`misc_data` text,
`email_address` varchar(325) NOT NULL,
`vote_hash` varchar(40) NOT NULL,
`vote_code` varchar(10) NOT NULL,
`date_voted` datetime NOT NULL,
`status` tinyint(4) DEFAULT \'0\',
PRIMARY KEY (`id`),
KEY `idx_pow_vote_entry` (`pow_entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;';

    $powtbls['results'] = '
CREATE TABLE IF NOT EXISTS `pow_result` (
`id` bigint(20) NOT NULL AUTO_INCREMENT,
`pow_contest_id` bigint(20) NOT NULL,
`pow_entry_id` bigint(20) NOT NULL,
`total_vote` int(11) NOT NULL,
`misc_data` text,
`award_type_id` tinyint(4) DEFAULT \'0\',
`concluded_date` datetime DEFAULT NULL,
`concluded_by_id` bigint(20) DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `idx_pow_entry_contest` (`pow_contest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;';

    $powtbls['category'] = '
CREATE TABLE IF NOT EXISTS `pow_contest_category` (
`id` bigint(20) NOT NULL AUTO_INCREMENT,
`pow_contest_id` bigint(20) NOT NULL,
`name` varchar(100) NOT NULL,
`description` varchar(500) DEFAULT NULL,
`order` int(4) DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `idx_pow_contest_id` (`pow_contest_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;';

    $powtbls['countest_country'] = "
CREATE TABLE IF NOT EXISTS `pow_contest_country` (
  `contest_id` bigint(20) unsigned NOT NULL,
  `country_id` bigint(20) NOT NULL,
  `total_views` bigint(20) DEFAULT '0',
  `last_viewed_week` int(11) DEFAULT '0',
  `last_viewed` datetime DEFAULT NULL,
  KEY `idx_pow_contest_country_contest` (`contest_id`),
  KEY `idx_pow_contest_country_country` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

    $powtbls['email_log'] = "
CREATE TABLE IF NOT EXISTS `pow_email_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email_from` varchar(200) NOT NULL, 
  `email_rcpt` varchar(500) NOT NULL, 
  `email_subject` varchar(500) NOT NULL, 
  `email_message` text NOT NULL, 
  `email_date` datetime DEFAULT NULL,
  `email_result` varchar(500),
   PRIMARY KEY (`id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

    return $powtbls;
  }

  /**
   * Returns default pow options
   */
  private function __pow_default_options() {
    $defoptions = array();

    $defoptions['adminemail'] = "brian.feliciano@gmail.com";
    $defoptions['upload_path'] = realpath(BASEPATH . '/../powentries');
    $defoptions['upload_max_kb'] = 2000000;

    $defmsgs = $this -> __default_notifications();
    foreach ($defmsgs as $msgtype => $msginfo) {
      $defoptions["{$msgtype}_subject"] = $msginfo['subject'];
      $defoptions["{$msgtype}_message"] = $msginfo['message'];
    }

    $defoptions['email_from_address'] = 'noreply@mumcentre.com';
    $defoptions['email_from_name'] = 'Mumcentre™ Administrator';
    $defoptions['use_ajax_uploader'] = 'true';
    $defoptions['allowed_imagetypes'] = 'jpg|jpeg|png';
    $defoptions['upload_path'] = 'pow-entries';
    $defoptions['upload_max_kb'] = '2000000';
    $defoptions['upload_max_width'] = '1024000000';
    $defoptions['upload_max_height'] = '768000000';
    $defoptions['upload_image_aspect_ratio'] = '282:328';
    
    $defoptions['message_successful_submit'] = '
<p>Thank You! You have successfully submitted an entry for the Pic of the week!</p> 
<p>Please wait for the administrator to approve it.</p>         
    ';

    return $defoptions;
  }

  function __checklist() {
    // check for contests!
    $errors = array();

    $contests = $this -> contest_getall();
    if (empty($contests)) {
      $errors[] = "There are no defined contest! Please fix this by going to Manage Contest and click <strong>Create New</strong> button";
    }

    $root_path = realpath($this -> config -> config['root_path']);
    $entry_path = $this -> options['upload_path'];
    if (!$entry_path) {
      $this -> options_set('upload_path', '/pow-entries');
    }
    $entry_path = $root_path . "/" . $this -> options['upload_path'];

    if (!realpath($entry_path)) {
      $errors[] = "Entries Photo folder '<code>
  {$entry_path}</code>' {$root_path} doesn't exists! " . "Please fix this by setting up 'upload_path' from " . anchor('cms_pow/options', 'this link');
    } else {
      if (!is_writable($entry_path)) {
        $errors[] = "Entries Photo folder '<code>
  {$entry_path}</code>' is not writable! " . "Please fix this by setting up 'upload_path' from " . anchor('cms_pow/options', 'this link');
      }
    }

    // check for active for submission contest
    $search = $this -> contest_active_get(ACTIVESUBMIT_CONTEST);
    if (!$search) {
      $errors[] = "There is no currently active contest for submission! Please fix this by going to Manage Contest and select a '<em>Pending Contest</em>' and click <strong>Activate for Submission</strong>!";
    }

    // check for active for voting contest
    $search = $this -> contest_active_get(ACTIVEVOTING_CONTEST);
    if (!$search) {
      $errors[] = "There is no currently active contest for voting! Please fix this by going to Manage Contest and select an '<em>Active for Submission</em>' contest and click <strong>Activate for Voting</strong>!";
    }

    // check for pending contest votes
    $cclist = $this -> country_list();
    foreach ($cclist as $cc) {
      $pendings = $this -> __pending_voting($cc['code']);
      if (is_array($pendings) && ($pendings['code'] < 0)) {
        $errors[] = $pendings['message'];
      }
      $submits = $this -> __pending_submission($cc['code']);
      if (is_array($submits) && ($submits['code'] < 0)) {
        $errors[] = $submits['message'];
      }
    }

    return @issetNE($errors) ? $errors : false;
  }

  function __check_for_upgrades() {
    // check the version
    if ($this -> options_get('__current_version') !== $this -> __current_version()) {
      // do some upgrades first!
      $this -> __upgrade_to_version($this -> __current_version());
      exit ;
    }
  }

  private function __upgrade_to_version($version_str = false) {
    switch ( $version_str ) {
      case '2.2.0216' :
      /*
       $this -> db -> query('DROP TABLE IF EXISTS pow_contest_category');
       $this -> db -> query('DROP TABLE IF EXISTS pow_entry');
       $this -> db -> query('DROP TABLE IF EXISTS pow_contest');
       $this -> db -> query('DROP TABLE IF EXISTS pow_result');
       $this -> db -> query('DROP TABLE IF EXISTS pow_vote');
       $this -> db -> query('DROP TABLE IF EXISTS pow_email_log');
       $this -> db -> query('TRUNCATE TABLE pow_option');
       // reset!
       $this -> __setup();
       $powtables = $this -> __pow_tables_def();
       $this -> db -> query($powtables['countest_country']);

       $powtables = $this -> __pow_tables_def();
       $this -> db -> query($powtables['email_log']);
       //printr($powtables['email_log']);
       *        *
       */
        $status_tbl = 'status';
        $this -> db -> query("DELETE FROM {$status_tbl} WHERE type like 'pow%'");
        $status_list = array();
        $status_list['pow_contest'] = qw('inactive activesubmit activevoting concluded published archived');
        $status_list['pow_entry'] = qw('pending approved rejected');
        $status_list['pow_vote'] = qw('unverified verified');

        foreach ($status_list as $tbl => $statdata) {
          for ($i = 0, $j = sizeof($statdata); $i < $j; $i++) {
            $this -> db -> insert($status_tbl, array('type' => $tbl, 'id' => $i, 'name' => $statdata[$i]));
          }
        }

        // add new options
        $this -> options_set('new-entry_admin_alert', 'true');

        // update the options table
        $this -> db -> query("ALTER TABLE {$this->_tbls['options']} MODIFY `value` TEXT");

        // remove this unneeded options
        $this -> db -> where('item', 'winner_default_mail_msg');
        $this -> db -> delete($this -> _tbls['options']);
        $this -> db -> where('item', 'winner_default_mail_subject');
        $this -> db -> delete($this -> _tbls['options']);

        $defmsgs = $this -> __default_notifications();
        foreach ($defmsgs as $msgtype => $msginfo) {
          $this -> options_set("{$msgtype}_subject", $msginfo['subject']);
          $this -> options_set("{$msgtype}_message", $msginfo['message']);
        }

        if ($this -> db -> field_exists('sponsor', 'pow_contest')) {
          $this -> db -> query("ALTER TABLE `pow_contest` DROP `sponsor`");
        }
        if (!$this -> db -> field_exists('email_list', 'pow_entry')) {
          $this -> db -> query("ALTER TABLE `pow_entry` ADD `email_list` TEXT DEFAULT null");
        }

        $defoptions = $this -> __pow_default_options();
        foreach ($defoptions as $item => $value) {
          $this -> options_set($item, $value);
        }

        //remove all that don't have any contest
        $qry = $this -> db -> query("
SELECT pow_contest_country.*, pow_contest.name  FROM `pow_contest_country` 
LEFT JOIN pow_contest ON pow_contest.id=pow_contest_country.contest_id
WHERE name is NULL");
        $result = $qry -> result_array();
        foreach ($result as $row) {
          $this -> db -> delete('pow_contest_country', array('contest_id' => $row['contest_id'], 'country_id' => $row['country_id']));
        }

        // get all pow_contest_category with multiple entries
        $qry = $this -> db -> query("SELECT *, count(contest_id) as cnt FROM pow_contest_country GROUP BY contest_id ORDER BY cnt DESC");
        $result = $qry -> result_array();
        foreach ($result as $row) {
          $this -> db -> delete('pow_contest_country', array('contest_id' => $row['contest_id'], 'country_id' => $row['country_id']));
          $this -> db -> insert('pow_contest_country', array('contest_id' => $row['contest_id'], 'country_id' => $row['country_id']));
        }

        // pow about content
        $pow_about_content = "
<p><strong>Be featured, win prizes!</strong><br /><strong>Join our Pic of the Week competition!</strong></p>
<p>MumCentre members can submit photos online (scroll to the end of this page for submission links) starting at 12 PM of Friday each week, with submissions closing one week later at midday the following Friday. The editor approves photos over the weekend, and the voting goes live at 2 PM the following Monday, staying open for one week, closing at 10 AM the following Monday. Each week's results will be posted four hours later at 2 PM on the same Monday that voting closes.</p>
<p>The Pic of the Week winner will be the photo with the most number of votes. And as if being featured on our site is not enough, the winner will receive a very special prize from the featured sponsor of the week!<br /><br /><strong>How pics are selected</strong></p>
<p><strong>&nbsp;</strong>Criteria for judging:</p>
<ul>
<li>10% Originality</li>
<li>10% Relevance</li>
<li>80% Votes</li>
</ul>
<p>As you can see, majority of the score will come from the votes. This online voting process is open to the general public. The photo with the highest total score will be declared the Pic of the Week winner at the end of each week.</p>
<p>Once you have submitted your photo entry for the week, you can share and invite your family and friends to vote! The more people you invite, the more chances you will have in winning the Pic of the Week competition!</p>
<p>Keen to participate but not a member yet? <a href=\"http://www.mumcentre.com/index.php?option=com_user&amp;task=register\">Sign up now - membership is free!</a></p>
<p><a href=\"http://www.mumcentre.com/index.php?option=com_user&amp;task=register\"></a>What are you waiting for?&nbsp;</p>
<p>The submission process will not take more than five minutes if your photos are prepared.&nbsp;</p>
<p>Should you require customer support with Pic of the Week matters or photo uploads during office hours, email us at <a href=\"mailto:aljunied@mumcentre.com\" target=\"_blank\">info@mumcentre.com</a>.&nbsp;</p>
<p>&nbsp;</p>
<p><a href=\"http://www.mumcentre.com/images/config_files/privacy-policy-template.pdf\">Terms and Privacy</a></p>";

        $this -> options_set('content_aboutpow', $pow_about_content);

        $duplicate_entry_content = "
<p>You are not allowed to upload pictures in the same category</p>
<p>You may choose to upload to a different category or a different MUMCentre Page</p>";

        $this -> options_set('message_duplicate_entry', $duplicate_entry_content);

        $content = "
<p>Sorry, there are no active Pick of the Week contests right now.</p>
<p>Please come back later</p>";
        $this -> options_set('message_nosubmission_contest', $content);

        $content = "
<p>Sorry, there are no active contest or no entrys for voting yet. </p>
<p>Please come back later or Join the current Pick of the Week contest by clicking Enter the Contest link</p>";
        $this -> options_set('message_novoting_contest', $content);

        $content = "
<p>Sorry, there are no conclude Pick of the Contests yet, and no declared winners at this moment. </p>
<p>Please come back later or Join the current Pick of the Week contest by clicking Enter the Contest link</p>";
        $this -> options_set('message_noconcluded_contest', $content);

        printr("upgraded to version 2.2.0216");
        $this -> options_set('__current_version', '2.2.0216');
        break;
      case '2.2.0220c' :
      
        $defoptions = $this -> __pow_default_options();
        foreach ($defoptions as $item => $value) {
          $this -> options_set($item, $value);
        }
      
        $content = "
<p>Thank You! You have successfully submitted an entry for the Pic of the week!</p> 
<p>Please wait for the administrator to approve it.</p>        
";
        $this -> options_set('message_successful_submit', $content);

        $content = "
<p>Your vote has been counted for this entry</p>         
";
        $this -> options_set('message_successful_vote', $content);

        printr("upgraded to version 2.2.0220c");
        $this -> options_set('__current_version', '2.2.0220c');
        break;
      default :
        break;
    }

    printr("Please hit refresh");
    return true;
  }
  
  function __current_version() {
    $current_version = "2.2.0220c";
    return $current_version;
  }

}
