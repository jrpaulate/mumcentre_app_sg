<?php

class Ads extends CI_Controller {

    function __construct() {
        parent::__construct();
//        $this->load->library('session');
        $this->load->library('bucket');
        $this->load->library('rb');
        $this->load->library('mcox');
    }

    function index() {
//        $advertiser_id = $this->mcox->add_advertiser("Moonfang", 
//                "Nicole LunarStrike", "me@moonfang.com");
//        echo $advertiser_id;
//        $this->mcox->delete_advertiser(2);
//        $advertiser = $this->mcox->get_advertiser(3);
//        echo json_encode($advertiser);
//        $start_date = new DateTime();
//        $end_date = new DateTime();
//        $end_date->modify("+1 month");
//        $campaign_id = $this->mcox->add_campaign(3, "Booze To The Max 2", 
//                $start_date, $end_date);
//        
//        echo $campaign_id;
//        $banner_id = $this->mcox->add_banner(3, "Wee Wee Dry Campaign", "url", 
//                "http://mc.xhiber-dynamic.com/img/ads/feature_banner.jpg", "728", "90");        
//        echo $banner_id;
//        $publisher_id = $this->mcox->add_publisher("X-Dynamics", 
//                "Xian Xian", "xian@x-dynamics.com");
//        echo $publisher_id;        
//        $zone_id = $this->mcox->add_zone(2, 
//                "Leaderboard", 1, 728, 90);
//        echo $zone_id;        
//        $this->mcox->link_banner_to_zone(5, 9);
//        $invocation_code = $this->mcox->get_zone_invocation_code(5, "adjs");
//        $invocation_code = str_replace("[removed]", "", $invocation_code);
//        echo $invocation_code;

//        $start_date = new DateTime("2012-01-25");
//        $end_date = new DateTime("2012-01-26");
//        $stats = $this->mcox->get_ad_daily_stats(242, $start_date, $end_date);
//        $response = array("stats" => array());
//        foreach ($stats as $s) {
//            $date = new DateTime($s["day"]);
//            $s["day"] = $date->format("Y-m-d h:gA");
//            array_push($response["stats"], $s);
//        }
//        echo json_encode($response);
//        echo "Daily Stats: " . json_encode($stats) . "<br/>";
//        $stats = $this->mcox->get_ad_publisher_stats(9, $start_date, $end_date);
//        echo "Publisher Stats: " . json_encode($stats) . "<br/>";
//        $stats = $this->mcox->get_ad_zone_stats(9, $start_date, $end_date);
//        echo "Zone Stats: " . json_encode($stats) . "<br/>";
    }

    function daily_stats($banner_id,$start_date,$end_date) {
        $start_date = new DateTime("$start_date");
        $end_date = new DateTime("$end_date");      
        
        $stats = $this->mcox->get_ad_daily_stats($banner_id, $start_date, $end_date);
//        $response = array("stats" => array());
        $response = array();
        foreach ($stats as $s) {
            $date = new DateTime($s["day"]);
            $s["day"] = $date->format("Y-m-d h:gA");
            array_push($response, $s);
        }
        echo json_encode($response);        
    }
    
    function show_stats() {
        $this->bucket->set_layout_id('mumcentre/blank');
        $this->bucket->set_content_id('mumcentre/ad_stats');
        $this->bucket->set_data('title', "Mumcentre | Ad Stats");
        $this->bucket->render_layout();
    }

}