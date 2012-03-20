<?php

    class cms_dashboard extends CI_Controller {
        
    function __construct() {
        parent::__construct();
        $this->load->library('media');
        $this->load->library('rb');
        $this->load->library('session');
        $this->load->library('mcapi');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('miscfuncs');
        
    }


     function dashboard(){
            $this->load->library('bucket');
            $this->bucket->set_layout_id('mumcentre/cms_layout');
            $this->bucket->set_content_id('cms/cms_dashboard');
            $this->bucket->add_css('cms');
            $this->bucket->set_data('title', "Mumcentre CMS");
            $this->bucket->render_layout();
    }
    
    }
    
?>
