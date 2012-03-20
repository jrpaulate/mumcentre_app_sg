<?php

class Search extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->library('common');
    $this->load->helper('url');
    $this->load->library('rb');
    $this->load->library('session');
    $this->load->library('mcox');
    
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
  }

  function index() {
    $this->load->library('bucket');
    $this->bucket->set_layout_id('mumcentre/desktop');
    $this->bucket->set_content_id('mumcentre/search');
    $this->bucket->add_css('mums');
    $this->bucket->set_data('title', "Mumcentre Search");
    
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
  
  private function _generateTags($zoneId) {
        $ajs = "http://50.19.248.24/openx/www/delivery/ajs.php";
        $loc = urlencode(current_url());
        $cb = rand(0, 99999999999);
        return '<script type="text/javascript" src="' . $ajs . '?zoneid=' . $zoneId .
                '&amp;cb=' . $cb . '&amp;charset=ISO-8859-1&amp;loc=' . $loc . '"></script>';
    }
}
