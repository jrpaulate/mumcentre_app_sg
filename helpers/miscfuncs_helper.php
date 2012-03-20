<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

function word_limit($str, $max = 50) {

  if (strlen($str) > $max) {
    $str1 = substr($str, 0, $max);
    $str2 = substr($str, $max);
    echo $str1;
    echo '<span onclick="$(this).next().show();$(this).hide();" style="cursor:pointer;font-weight: bold;"> [...] </span>';
    echo '<span style="display:none;">' . $str2 . '</span>';

  } else {
    echo $str;
  }
}

/**
 * Misc Functions
 *  - collection of generic functions
 *
 *   by: Brian Feliciano
 */
function get_entry_photo($token_id, $photofile = false, $size = false) {
  if (!$token_id || !$photofile)
    return false;
  $CI = &get_instance();
  $CI -> load -> model('pow');
  switch($size){
    case 640:
      $size=false;
      break;
    case 240:
      $size=100;
      break;
    default:
      $size=false;
      break;    
  }
  
  return site_url(sprintf("/%s/%s/%s", $CI -> pow -> options['upload_path'], $token_id, ($size ? "thumb.{$size}." : '') . $photofile));
  /*  $entry = $this -> entry_get_bytoken($token_id);
   if (!$entry)
   return false;

   $path = $this -> __entry_photopath($entry);
   $photofile = $entry['photo_filepath'];
   $image_type = $entry['image_type'];

   if ($size) {
   $thumbfile = "thumb.{$size}.{$photofile}";
   if (realpath("{$path}/{$thumbfile}")) {
   $photofile = $thumbfile;
   }
   }

   return array($photofile, $image_type, $path);
   */
}

/**
 * extracts only the required values from a larger set
 *
 * @param array required values
 * @param array larger set
 *
 * @return array required set
 */
function getvalidvalues($flds, $data) {
  $tmpdata = array();
  foreach ($flds as $fld) {
    if (isset($data[$fld]) && !empty($data[$fld])) {
      $tmpdata[$fld] = $data[$fld];
    }
  }

  return $tmpdata;
}

/**
 * Extracts assoc array of required flds from a given set
 *
 * @param array required fields
 * @param array (optional) postdata
 *
 * @return array required set
 */
function postvalues($flds = array(), $post = array()) {
  $flds = is_assoc($flds) ? array_keys($flds) : $flds;
  $data = array();
  foreach ($flds as $fld) {
    if (@issetNE($post[$fld]) || @issetNE($_REQUEST[$fld]))
      $data[$fld] = @issetVal($post[$fld], @issetVal($_REQUEST[$fld]));
  }
  return $data;
}

/**
 * recurcsively delete a file or directory
 */
function recursiveDelete($str) {
  if (is_file($str)) {
    return @unlink($str);
  } elseif (is_dir($str)) {
    $scan = glob(rtrim($str, '/') . '/*');
    foreach ($scan as $index => $path) {
      recursiveDelete($path);
    }
    return @rmdir($str);
  }
}

/**
 * returns text with a given no of words
 *
 * @param string string of words
 * @param int (optional) number of words to return, defaults to 40
 * @return string
 */

function out_numwords($str, $count = 40) {
  $arr_words = qw($str);
  $output = array();
  $hasbreak = false;

  for ($i = 0; $i < $count; $i++) {
    if (@issetNE($arr_words[$i])) {
      $output[] = $arr_words[$i];
    } else {
      $hasbreak = true;
      break;
    }

  }

  return implode(' ', $output) . ($hasbreak ? '' : '...');
}

/**
 * generates a random alphanum code
 *
 * @param integer string length
 * @param string (optional) options, ALPHA (default) | NUM
 * @param string (optional) string suffix
 *
 * @return string generated code
 */

function generate_random($len = 10, $opts = 'ALPHA', $adders = '') {
  $pat_alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $pat_num = "123456789";
  $pattern = '';
  $opts = strtoupper($opts);
  $newkey = '';

  $pattern = ($opts === 'NUM') ? $pat_num : (($opts === 'ALPHA') ? $pat_alpha : $pat_num . $pat_alpha);
  $pattern .= $adders;

  for ($i = 0; $i < $len; $i++) {
    $newkey = (($newkey) ? $newkey : '') . $pattern{rand(0, strlen($pattern) - 1)};
  }

  return strtoupper($newkey);
}

/**
 * get random item from an array
 */
function randomize($choices = array()) {
  return $choices[rand(0, sizeof($choices) - 1)];
}

/**
 * php-to-js variable converter, via json
 *
 * @param mixed data to convert
 * @param string evaluated php var to js
 */
function phptojs_json($data) {
  $str = json_encode($data);
  return strtr($str, array("'" => "&#039;"));
}

/**
 * verifies if an array is an associative array
 *
 * @param array array to test
 * @return boolean TRUE if it's an associative array; FALSE if not
 */
function is_assoc($array) {
  return (is_array($array) && 0 !== count(array_diff_key($array, array_keys(array_keys($array)))));
}

/**
 * outputs date-time from the database table DATETIME field
 *
 * @param string datetime from db table field
 * @param format (optional) refer to php date format
 *
 * @return string formatted date
 */
function out_datetime($date, $format = "F d, Y g:i:s A") {
  date_default_timezone_set('Asia/Manila');

  if (!isValidDateTime($date) && !strtotime($date))
    return "--";
  else
    return date($format, strtotime($date));
}

/**
 * outputs date from the database table DATE field
 *
 * @param string date from db table field
 * @param format (optional) refer to php date format
 *
 * @return string formatted date
 */
function out_date($date, $format = 'F d, Y') {
  date_default_timezone_set('Asia/Manila');
  if (!isValidDateTime($date))
    return "--";
  else
    return date($format, strtotime($date));
}

/**
 * helper function for CI's setrules for batch settings
 * @param array fields to set rules to
 * @param array labels of fields
 * @param string rules to set for each field
 */

function set_rule($fld, $label, $rule = '') {
  $defrules = 'trim|xss_clean';
  $rule = (($rule) ? "$rule|" : '') . $defrules;

  return array('field' => $fld, 'label' => $label, 'rules' => $rule);
}

/**
 * returns an array of the months
 * @param void
 * @return array list of months
 */

function out_months() {
  return qw('January February March April May June July August September October November December');
}

/**
 * returns a formatted monetary string
 * @param number
 * @return string
 */
function out_price($price) {
  return number_format($price, 2, '.', ',');
}

/**
 * parses the HTTP Cookie
 * @return array
 */

function parse_cookies() {
  $arr = array();
  if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
      $parts = explode('=', $cookie);
      $name = trim($parts[0]);
      $arr[$name] = trim($parts[1]);
    }
  }
  return $arr;
}

/**
 * shortcut for print_r wrapped in a <pre> tag
 * @param mixed
 */
function printr($val) {
  echo "<pre>" . print_r($val, true) . "</pre>";
  return true;
}

/**
 * shortcut for split-words / implementation of the perl function qw
 * @param string string to split
 * @return array
 */

function qw($str = '') {
  return preg_split("/\s+/", $str);
}

/**
 * shortcut - tests if present, then returns it, else return false
 * @param mixed variable to test
 * @return mixed returns the variable if isset; FALSE if doesn't
 */

function issetVal($var, $def = '') {
  return isset($var) ? $var : $def;
}

/**
 * shortcut for isset and !empty
 * @param mixed variable to test
 * @return boolean
 */

function issetNE($var) {
  return isset($var) && !empty($var);
}

/**
 * prepares to set the input string to db date field
 * @param string date string
 * @return string date-string format in YYYY-MM-DD
 */
function input_date($date) {
  date_default_timezone_set('Asia/Manila');
  return date('Y-m-d', strtotime($date));
}

/**
 * prepares to set the input string to db datetime field
 * @param string datetime string
 * @return string datetime-string format in YYYY-MM-DD HH:MM:SS
 */
function input_datetime($date) {
  date_default_timezone_set('Asia/Manila');
  return date('Y-m-d G:i:s', strtotime($date));
}

/**
 * creates a thumbnail for JPG/PNG
 */
function createThumbnail($imgtype, $imageDirectory, $imageName, $thumbWidth) {
  switch ($imgtype) {
    case "image/pjpeg" :
    case "image/jpeg" :
    case "image/jpg" :
      return createThumbnail_JPG($imageDirectory, $imageName, $thumbWidth);
      break;
    case "image/png" :
    case "image/x-png" :
      return createThumbnail_PNG($imageDirectory, $imageName, $thumbWidth);
      break;
    default :
      return false;
  }
}

/**
 * creates a thumbnail for PNG
 */
function createThumbnail_PNG($imageDirectory, $imageName, $thumbWidth) {
  $srcImg = imagecreatefrompng("$imageDirectory/$imageName");
  $origWidth = imagesx($srcImg);
  $origHeight = imagesy($srcImg);

  $thumbHeight = floor($origHeight * ($thumbWidth / $origWidth));

  // create a new temporary image
  $tmp_img = imagecreatetruecolor($thumbWidth, $thumbHeight);

  // copy and resize old image into new image
  imagecopyresized($tmp_img, $srcImg, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $origWidth, $origHeight);

  // save thumbnail into a file
  imagepng($tmp_img, "{$imageDirectory}/thumb.{$thumbWidth}.{$imageName}");

  return "thumb.{$thumbWidth}.{$imageName}";
}

/**
 * creates a thumbnail for JPG
 */
function createThumbnail_JPG($imageDirectory, $imageName, $thumbWidth) {
  $srcImg = imagecreatefromjpeg("$imageDirectory/$imageName");
  $origWidth = imagesx($srcImg);
  $origHeight = imagesy($srcImg);

  $thumbHeight = floor($origHeight * ($thumbWidth / $origWidth));

  // create a new temporary image
  $tmp_img = imagecreatetruecolor($thumbWidth, $thumbHeight);

  // copy and resize old image into new image
  imagecopyresized($tmp_img, $srcImg, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $origWidth, $origHeight);

  // save thumbnail into a file
  imagejpeg($tmp_img, "{$imageDirectory}/thumb.{$thumbWidth}.{$imageName}");

  return "thumb.{$thumbWidth}.{$imageName}";
}

function cropImage($original_imagename, $cropped_imagename, $width, $height, $start_width, $start_height) {
  list($imagewidth, $imageheight, $imageType) = getimagesize($original_imagename);
  $imageType = image_type_to_mime_type($imageType);

  $newImageWidth = $width;
  //ceil($width * $scale);
  $newImageHeight = $height;
  //ceil($height * $scale);
  $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
  switch($imageType) {
    case "image/gif" :
      $source = imagecreatefromgif($original_imagename);
      break;
    case "image/pjpeg" :
    case "image/jpeg" :
    case "image/jpg" :
      $source = imagecreatefromjpeg($original_imagename);
      break;
    case "image/png" :
    case "image/x-png" :
      $source = imagecreatefrompng($original_imagename);
      break;
  }
  imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);
  switch($imageType) {
    case "image/gif" :
      imagegif($newImage, $cropped_imagename);
      break;
    case "image/pjpeg" :
    case "image/jpeg" :
    case "image/jpg" :
      imagejpeg($newImage, $cropped_imagename, 90);
      break;
    case "image/png" :
    case "image/x-png" :
      imagepng($newImage, $cropped_imagename);
      break;
  }
  // chmod($cropped_imagename, 0777);
  return $cropped_imagename;
}

/**
 * returns the fileextension of a file
 * @param string filename
 * @return string file extension
 */
function get_fileext($filename = '') {
  $arr = array_reverse(explode(".", $filename));
  return $arr[0];
}

/**
 * extract data from the POST data
 * @param array list of fields to extract
 * @param array extracted data
 */
function transfer_postdata($flds = array()) {
  if (empty($flds)) {
    return false;
  }
  $data = array();

  foreach ($flds as $fld) {
    if (isset($_POST[$fld])) {
      $data[$fld] = $_POST[$fld];
    }
  }
  return $data;
}

/**
 * extract data from a larger set
 * @param array list of fields to extract
 * @param array extracted data
 */
function transfer_data($flds = array(), $post = false) {
  if (empty($flds)) {
    return false;
  }
  $post = $post ? $post : $_POST;

  $data = array();
  foreach ($flds as $fld) {
    if (isset($post[$fld])) {
      $data[$fld] = $post[$fld];
    }
  }
  return $data;
}

/**
 * get file list from a directory
 *
 * @param string directory path
 * @param string (optional) pattern of filename to return
 * @return array list of files
 */
function getfilesFromDir($dirname, $pattern = '') {
  $pattern = $pattern ? $pattern : '{.*}';
  $files = array();
  $path = realpath($dirname);
  if (!$path) {
    return false;
  }
  $dirh = opendir($path);

  while (($txt = readdir($dirh)) !== false) {
    $info = pathinfo($txt);
    preg_match($pattern, $info['basename'], $m);
    if (!empty($m)) {
      $files[$info['basename']] = $info['filename'];
    }
  }
  closedir($dirh);
  ksort($files);
  return $files;
}

/**
 * Javascript alert
 *
 * @param string message to alert
 */
function jsalert($msg) {
  echo "<script type='text/javascript'>alert('{$msg}');</script>";
}

/**
 * fetch images from a given directory
 *
 * @param string directory path
 * @return array list of images
 */
function fetchImagesFromDir($dirname) {
  $imagespath = realpath($_SERVER['DOCUMENT_ROOT'] . "/{$dirname}/");
  $imglist = array();
  $dirh = opendir($imagespath);
  while (($txt = readdir($dirh)) !== false) {
    $info = pathinfo($txt);
    switch ( @strtolower($info['extension']) ) {
      case 'jpg' :
      case 'png' :
      case 'gif' :
        $imglist[] = array('path' => "/{$dirname}/" . $info['basename'], 'name' => $info['filename']);
        break;
    }
  }
  closedir($dirh);
  return $imglist;
}

/**
 * move uploaded file
 */
function moveUploadedFile($fld, $target_path, $filename = false, $appendfilename = false) {
  if (!is_dir($target_path)) {
    // try to create the dir
    if (mkdir($target_path, 0777, true) === FALSE) {
      die("Unable to create directory $target_path");
    }
  }

  if ($filename) {
    if ($appendfilename) {
      $filename .= "-" . basename($_FILES[$fld]['name']);
    }
    $filename = filename_safe($filename);
  } else {
    $filename = filename_safe(basename($_FILES[$fld]['name']));
  }
  $filetype = $_FILES[$fld]['type'];
  $filename = substr($filename, 0, 20);
  // limit the filenamne to 50charactrs

  $filepath = "{$target_path}/" . $filename;

  if (!$_FILES[$fld]['size'])
    return false;
  if (move_uploaded_file($_FILES[$fld]['tmp_name'], $filepath) === false) {
    die("Unable to write the file $filename to $filepath, please check the permissions");
  }

  return $filename;

  //return array($filename,$filetype);
}

/**
 * returns a safe filename
 */
function filename_safe($filename) {
  $temp = $filename;
  $temp = str_replace(" ", "_", $temp);
  $result = '';
  for ($i = 0; $i < strlen($temp); $i++) {
    if (preg_match('([0-9]|[A-Z]|[a-z]|_|.|-)', $temp[$i])) {
      $result = $result . $temp[$i];
    }
  }
  return $result;
}

/**
 * checks if the datetime string is valid
 */
function isValidDateTime($dateTime) {
  if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $dateTime, $matches)) {
    if (checkdate($matches[2], $matches[3], $matches[1])) {
      return true;
    }
  }
  return false;
}

/**
 Validate an email address.
 Provide email address (raw input)
 Returns true if the email address has the email
 address format and the domain exists.
 *
 * taken from: http://www.linuxjournal.com/article/9585?page=0,3
 */
function validEmail($email) {
  $isValid = true;
  $atIndex = strrpos($email, "@");
  if (is_bool($atIndex) && !$atIndex) {
    $isValid = false;
  } else {
    $domain = substr($email, $atIndex + 1);
    $local = substr($email, 0, $atIndex);
    $localLen = strlen($local);
    $domainLen = strlen($domain);
    if ($localLen < 1 || $localLen > 64) {
      // local part length exceeded
      $isValid = false;
    } else if ($domainLen < 1 || $domainLen > 255) {
      // domain part length exceeded
      $isValid = false;
    } else if ($local[0] == '.' || $local[$localLen - 1] == '.') {
      // local part starts or ends with '.'
      $isValid = false;
    } else if (preg_match('/\\.\\./', $local)) {
      // local part has two consecutive dots
      $isValid = false;
    } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
      // character not valid in domain part
      $isValid = false;
    } else if (preg_match('/\\.\\./', $domain)) {
      // domain part has two consecutive dots
      $isValid = false;
    } else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\", "", $local))) {
      // character not valid in local part unless
      // local part is quoted
      if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\", "", $local))) {
        $isValid = false;
      }
    }
    if ($isValid && !(checkdnsrr($domain, "MX") || checkdnsrr($domain, "A"))) {
      // domain not found in DNS
      $isValid = false;
    }
  }
  return $isValid;
}

/**
 * Helper function - form field
 */

function addfield($name, $size = '30', $class = 'regfield') {
  return array('name' => $name, 'id' => $name, 'size' => $size, 'value' => set_value($name), 'class' => $class);
}

/**
 * form field helper
 */

function input_filter() {
  $args = func_get_args();
  $_args_def = qw('name label value type isreqd options class attr');

  if (!is_array($args[0])) {
    $newargs = array('isreqd' => false);
    for ($i = 0, $j = sizeof($_args_def); $i < $j; $i++) {
      if (isset($args[$i]) && !empty($args[$i])) {
        $newargs[$_args_def[$i]] = $args[$i];
      }
    }
    return input_filter($newargs);
  }
  $html = input_field($args[0]);
  return '<span class="inputfltr">' . $html . '</span>';
  exit();

}

/**
 * form field helper
 */

function input_field() {
  $args = func_get_args();
  $_args_def = qw('name label value type isreqd options class attr');

  if (!is_array($args[0])) {
    $newargs = array('isreqd' => false);
    for ($i = 0, $j = sizeof($_args_def); $i < $j; $i++) {
      if (isset($args[$i]) && !empty($args[$i])) {
        $newargs[$_args_def[$i]] = $args[$i];
      }
    }
    return input_field($newargs);
  }

  $opts = $args[0];
  $html = '';
  $isreqd = @issetNE($opts['isreqd']) ? $opts['isreqd'] : false;
  $label = @issetNE($opts['label']) ? $opts['label'] . ($isreqd ? ' * ' : '') : false;
  $value = @issetVal($_REQUEST[$opts['name']], $opts['value']);
  $type = @issetVal($opts['type'], 'text');
  $attr = @issetVal($opts['attr']);
  $opts['class'] = (@issetNE($opts['class']) ? $opts['class'] . ' ' : '') . 'regfield' . ($isreqd ? ' isrequired' : '');

  switch ($type) {
    case 'dropdown' :
      if (is_assoc($opts['options'])) {
        $opts['options'] = array('' => '') + $opts['options'];
      } else {
        $_opts = array('' => '');
        for ($i = 0, $j = sizeof($opts['options']); $i < $j; $i++) {
          $_opts[$opts['options'][$i]] = $opts['options'][$i];
        }
        $opts['options'] = $_opts;
      }

      $value = set_value($opts['name'], $value);

      if ($value && !in_array($value, array_keys($opts['options']))) {
        $opts['options'][$value] = $value;
      }

      $html = form_dropdown($opts['name'], @issetVal($opts['options']), set_value($opts['name'], $value), $attr);
      break;
    case 'date' :
      $opts['class'] .= ' datepicker';
      $html = form_input($opts, set_value($opts['name'], $value), $attr);
      break;
    case 'textarea_rte' :
      $opts['type'] = 'textarea';
      $opts['class'] .= ' mceEditor';
      $html = form_textarea($opts, set_value($opts['name'], $value), $attr);
      break;
    case 'inputtext_rte' :
      $opts['type'] = 'textarea';
      $opts['class'] .= ' mceShortEditor';
      $html = form_textarea($opts, set_value($opts['name'], $value), $attr);
      break;
    case 'textarea_source' :
    case 'textarea_editsource' :
      $opts['type'] = 'textarea';
      $opts['class'] .= ' sourceEditor';
      $html = form_textarea($opts, set_value($opts['name'], $value), $attr);
      break;
    case 'textarea' :
      $html = form_textarea($opts, set_value($opts['name'], $value), $attr);
      break;
    case 'semilongtext' :
      $opts['type'] = 'text';
      $opts['style'] = 'width:400px;';
      $html = form_input($opts, set_value($opts['name'], $value), $attr);
      break;
    case 'longtext' :
      $opts['type'] = 'text';
      $opts['style'] = 'width:800px;';
      $html = form_input($opts, set_value($opts['name'], $value), $attr);
      break;
    /*
     case 'checkbox':
     $value = set_value($opts['name'],$value);
     $html  = form_label($label, $opts['name'], ($isreqd?array('class'=>'isrequired'):NULL) )
     . form_checkbox( $opts );

     ;
     $label = false;

     printr( array($label, $value, $opts) );
     //       $html = form_input($opts, set_value($opts['name'],$value), $attr);
     $data = array(
     'name'        => 'newsletter',
     'id'          => 'newsletter',
     'value'       => 'accept',
     'checked'     => TRUE,
     'style'       => 'margin:10px',
     );

     form_checkbox()
     break;
     */
    case 'longtext_rte' :
      $opts['type'] = 'textarea';
      $opts['class'] .= ' mceShortEditor';
      $html = form_textarea($opts, set_value($opts['name'], $value), $attr);
      break;
    case 'imageselect' :
      if (@issetNE($opts['options'])) {
        $imgs = fetchImagesFromDir($opts['options']);
        $imgopts = array();
        $imgopts['zznewzz'] = ' >> Upload new image...  ';
        foreach ($imgs as $img) {
          $imgopts[$img['path']] = $img['name'];
        }

        ksort($imgopts);
        $html = input_field($opts['name'], false, $value, 'dropdown', NULL, $imgopts, NULL, 'class="imgpreview"');
        $html .= '<div id="' . $opts['name'] . '-imgupload" style="display:none;">' . input_field($opts['name'] . '-imguploadfile', false, false, 'file') . input_hidden($opts['name'] . '-imguploaddir', $opts['options']) . '</div>';
        $html .= '<div id="' . $opts['name'] . '-imgpreview"><img ' . ($attr ? $attr : '') . ' src="' . $value . '"></div>';
      } else {
        $html = form_input($opts, set_value($opts['name'], $value), $attr);
      }
      break;
    case 'text' :
    case 'file' :
    default :
      $html = form_input($opts, set_value($opts['name'], $value), $attr);
      break;
  }

  return ($label ? form_label($label, $opts['name'], ($isreqd ? array('class' => 'isrequired') : NULL)) : '') . $html . form_error($opts['name'], '<span class="error">', '</span>');
}

function input_hidden() {
  $content = '';
  $args = func_get_args();

  if (!is_array($args[0])) {
    return field_hidden(array($args[0] => $args[1]));
  }
  foreach ($args[0] as $key => $value) {
    $content .= form_hidden($key, $value);
  }
  return $content;
}

function field_dropdown($label, $fld, $data = array(), $def = '', $isreqd = false, $class = 'regfield') {
  $opts = array();

  if (is_assoc($data)) {
    $opts = array('' => '') + $data;
  } else {
    $opts = array('' => '');
    for ($i = 0, $j = sizeof($data); $i < $j; $i++) {
      $opts[$data[$i]] = $data[$i];
    }
  }

  return form_label($label . ($isreqd ? ' * ' : ''), $fld, ($isreqd ? array('class' => 'isrequired') : NULL)) . form_dropdown($fld, $opts, $def, 'class="' . $class . '' . ($isreqd ? ' isrequired' : '') . '"') . form_error($fld);
}

function field_hidden() {
  $content = '';
  $args = func_get_args();

  if (!is_array($args[0])) {
    return field_hidden(array($args[0] => $args[1]));
  }
  foreach ($args[0] as $key => $value) {
    $content .= form_hidden($key, $value);
  }
  return $content;
}

function field_text() {
  $args = func_get_args();
  $_args_def = qw('label name value type class isreqd');

  // check if $label is array
  if (!is_array($args[0])) {
    $newargs = array('label' => $args[0], 'isreqd' => false);
    for ($i = 0, $j = sizeof($_args_def); $i < $j; $i++) {
      if (isset($args[$i]) && !empty($args[$i])) {
        $newargs[$_args_def[$i]] = $args[$i];
      }
    }

    return field_text($newargs);
  }

  extract($args[0]);

  $input = '';
  $label = ($label) ? $label . ($isreqd ? ' * ' : '') : '&nbsp;';
  $type = ( isset($type)) ? $type : 'text';
  $class = "regfield " . (isset($class) ? $class : '') . ($isreqd ? ' isrequired' : '');

  switch ($type) {
    case 'password' :
      $input = form_password(addfield($name, NULL, $class));
      break;
    case 'date' :
      $input = form_input(addfield($name, NULL, $class . ' datepicker'));
      break;
    case 'textarea' :
      $input = form_textarea(addfield($name, NULL, $class));
      break;
    default :
      $input = form_input(addfield($name, NULL, $class));
      break;
  }

  return form_label($label, $name, ($isreqd ? array('class' => 'isrequired') : NULL)) . $input . form_error($name);
}

function out_contentmedia($mediasrc = '', $cls = '') {
  if (!$mediasrc) {
    return false;
  }

  if (strtolower(get_fileext($mediasrc)) === 'swf') {
    // flash tihii
    return '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ' . 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" ' . 'style="margin: 0;">' . '<param name="movie" value="/resources/images/' . $mediasrc . '" />' . '<param name="quality" value="high" />' . '<param name="wmode" value="transparent" />' . '<embed src="/resources/images/' . $mediasrc . '" quality="high" ' . 'pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" ' . 'type="application/x-shockwave-flash"  ' . 'wmode="transparent" menu=false></embed></object>';
  } else {
    return '<img class="' . $cls . '" src="' . out_image($mediasrc) . '" />';
  }
}

function setadmintoolbar($conf = array()) {
  $arr = array();
  foreach ($conf as $cfeat) {
    $arr[$cfeat] = true;
  }
  return $arr;
}

/* Handles the error output. This error message will be sent to the uploadSuccess event handler.  The event handler
 will have to check for any error messages and react as needed. */
function HandleError($message) {
  echo $message;
}
?>
