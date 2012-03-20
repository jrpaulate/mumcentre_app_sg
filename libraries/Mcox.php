<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mcox
 *
 * @author Mico
 */
class Mcox {

    function __construct() {
        $this->_CI = &get_instance();
        $this->_CI->load->library('openx');
    }

    public function add_advertiser($name, $contact, $email) {
        $params = array(
            "advertiserName" => $name,
            "contactName" => $contact,
            "emailAddress" => $email
        );

        return $this->_CI->openx->addAdvertiser($params);
    }

    public function delete_advertiser($id) {
        return $this->_CI->openx->deleteAdvertiser($id);
    }

    public function get_advertiser($id) {
        return $this->_CI->openx->getAdvertiser($id);
    }

    public function add_campaign($advertiser_id, $name, $start_date, $end_date, $impressions=-1, $clicks=-1, $priority=0, $weight=1) {
        $params = array(
            "advertiserId" => $advertiser_id,
            "campaignName" => $name,
            "startDate" => $start_date,
            "endDate" => $end_date,
            "impressions" => $impressions,
            "clicks" => $clicks,
            "priority" => $priority,
            "weight" => $weight
        );

        return $this->_CI->openx->addCampaign($params);
    }
    
    
    
    
    
    
    
    public function delete_campaign($id) {
        return $this->_CI->openx->deleteCampaign($id);
    }
    
    public function get_campaign($id) {
        return $this->_CI->openx->getCampaign($id);
    }
    
    //Start Banner Functions
    //storage type - html,txt,sql,web,url
    public function add_banner($campaignId, $bannerName, $storageType, $imageURL, $width, $height, $url=NULL, $htmlTemplate=NULL,  $weight=1, $fileName=NULL) { 
        $params = array(
            "campaignId" => $campaignId,
            "bannerName" => $bannerName,
            "storageType" => $storageType,
            "fileName" => $fileName,
            "imageURL" => $imageURL,
            "htmlTemplate" => $htmlTemplate,
            "width" => $width,
            "height" => $height,
            "weight" => $weight,
            "url" => $url
        );

        return $this->_CI->openx->addBanner($params);        
    }
    /**
     * get_ad_daily_stats - returns daily statistics for a banner
     * for a specified period.
     */    
    public function get_ad_daily_stats($id, $start_date, $end_date) {
        return $this->_CI->openx->bannerDailyStatistics($id, $start_date, $end_date);        
    }
    /**
     * get_ad_publisher_stats - returns publisher statistics for a banner
     * for a specified period.
     */    
    public function get_ad_publisher_stats($id, $start_date, $end_date) {
        return $this->_CI->openx->bannerPublisherStatistics($id, $start_date, $end_date);        
    }
    /**
     * get_ad_zone_stats - returns zone statistics for a banner
     * for a specified period.
     */    
    public function get_ad_zone_stats($id, $start_date, $end_date) {
        return $this->_CI->openx->bannerZoneStatistics($id, $start_date, $end_date);        
    }    
    //End Banner Funtions
    
    //Website (Publisher) Functions
    public function add_publisher($name, $contact, $email) {
        $params = array(
            "publisherName" => $name,
            "contactName" => $contact,
            "emailAddress" => $email
        );

        return $this->_CI->openx->addPublisher($params);
    }
    
    //Zone Functions
    public function add_zone($publisherId, $zoneName, $type, $width = 0, $height = 0) {
        $params = array(
            "publisherId" => $publisherId,
            "zoneName" => $zoneName,
            "type" => $type,
            "width" => $width,
            "height" => $height
        );

        return $this->_CI->openx->addZone($params);
    }    
    
    public function link_banner_to_zone($zoneId, $bannerId) {
        $this->_CI->openx->linkBanner($zoneId, $bannerId);
    }
    //codeType - invocation code type - 'adframe', 'adjs', 'adlayer', 'adview', 'adviewnocookies', 'local', 'popup', 'xmlrpc'
    //block - Don't show the banner again on the same page (0 or 1)
    //thirdparty - '0', 'generic', '3rdPartyServers:ox3rdPartyServers:doubleclick', '3rdPartyServers:ox3rdPartyServers:max'
    //comments
    public function get_zone_invocation_code($zoneId, $codeType, $thirdparty = "0", $block = 0, $comments = 0) {
        $params = array(
            "block" => $block,
            "thirdpartytrack" => $thirdparty,
            "comments" => $block
        );        
        return $this->_CI->openx->generateTags($zoneId, $codeType, $params);
    } 
    
    
    
     


public function updateBannerTarget($banner_id, $url) { 
        $params = array(
            "bannerId" => $banner_id,
            "url" => $url
        );

        return $this->_CI->openx->modifyBanner($params);        
    }






 public function updateCampaign($campaign_id,$name,$advertiser_id,$start_date,$end_date) {
        $params = array(
            "campaignId" => $campaign_id,
            "campaignName" => $name,
            "advertiserId" => $advertiser_id,
            "startDate" => $start_date,
            "endDate" => $end_date,
        );
        
        return $this->_CI->openx->modifyCampaign($params); 
    }
    
    
    
}

?>
