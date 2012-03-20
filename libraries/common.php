<?php
class Common {
    function show_months($selected_month) {
        $obj =& get_instance();
        $months = "";
        for ( $i = 1; $i <= 12; $i+=1) {
            $timestamp=mktime(0, 0, 0, $i, 1, 2000);
            $month=date("m", $timestamp);
            $selected="";
            if($i==$selected_month)
                $selected="selected";
            $months .= "<option ".$selected." value=\"".$month."\" set_select('birth_month', '".$month."');>".date("F", $timestamp)."</option>";
        }

        return $months;
    }

    function show_days($selected_day) {
        $obj =& get_instance();
        $days = "";
        for ( $i = 1; $i <= 31; $i+=1) {
            $day=str_pad($i,2,"0",STR_PAD_LEFT);
            $selected="";
            if($i==$selected_day)
                $selected="selected";
            $days .= "<option ".$selected." value=\"".$day."\" set_select('birth_day', '".$day."');>".$i."</option>";
        }

        return $days;
    }

    function show_years($selected_year) {
        $obj =& get_instance();
        $years = "";
        $curr_year=date("Y");
        for ( $i = $curr_year; $i >= ($curr_year-100); $i-=1) {
            $timestamp=mktime(0, 0, 0, 1, 1, $i);
            $year=date("Y", $timestamp);
            $selected="";
            if($i==$selected_year)
                $selected="selected";
            $years .= "<option ".$selected." value=\"".$year."\" set_select('birth_year', '".$year."');>".$year."</option>";
        }

        return $years;
    }

    function sms_activation_key() {
        $key="";
        for ($i=0; $i<6; $i++) {
            $d=rand(1,30)%2;
            $key.=$d ? chr(rand(65,90)) : chr(rand(48,57));
        }
        return $key;
    }

    function email_activation_key($email_address) {
        return md5($email_address).uniqid();
    }

    function create_thumb_element($media_type, $media) {
        $element = sprintf("<li><div id='gallery_item'><img id='%s' class='preview' src='%s' /></div></li>",
                $media_type, $media);

        return $element;
    }



    function create_slide_element($event_id, $event_cover, $event_title, $event_date) {
        $date = explode(",", $event_date);
        $element = sprintf('<div class="item" href="event/view/%s"><img class="content" src="%s"/>
            <div id="event_caption" class="caption">%s</div><div class="label"><span class="month_date">%s
            </span><span class="year">%s</span></div></div>',
                $event_id, $event_cover, $event_title, $date[0], trim($date[1]));
//                $event_id, $event_cover, $event_title, date("M d", strtotime($event_date)), date("Y", strtotime($event_date)));

        return $element;
    }

    function create_search_result_element($document, $thumbnail_image) {
        $event_link = base64_encode($document->id.':'.$document->user_id);
        $element = sprintf('<div class="resultentry">
            <p class="imgholder1"><img src="%s" width="123" height="118" /></p>
            <p class="featurestitle"><a href="event/view/%s">%s</a></p>
            <p class="featuresdate">%s</p><p class="featuresauthor">%s</p>
            <p class="featuresdesc">%s</p></div>',
                $thumbnail_image, $event_link, substr($document->title, 0, 20)."...",
                $document->date, $document->user_name, substr($document->story, 0, 100)."...");
//        $element = sprintf('<div class="resultentry">
//            <p class="imgholder1"><img src="%s" width="123" height="118" /></p>
//            <p class="featurestitle"><a href="event/view/%s">%s</a></p>
//            <p class="featuresdate">%s</p><p class="featuresauthor">%s</p>
//            <p class="featuresdesc">%s</p></div>',
//                $thumbnail_image, $event_link, $document->title,
//                $document->date, $document->user_name, substr($document->story, 0, 120)."...");
//        $element = sprintf('<div class="resultentry">
//            <p class="imgholder1"><img src="%s" width="123" height="118" /></p>
//            <p class="featurestitle"><a href="event/view/%s">%s</a></p>
//            <p class="featuresdate">%s</p><p class="featuresauthor">%s</p>
//            <p class="featuresdesc">%s</p></div>',
//                $thumbnail_image, $document->id, $document->title,
//                $document->date, $document->user_name, substr($document->story, 0, 120)."...");

        return $element;
    }
	
	function generate_password(){
	$pwd="";
    for ($i=0; $i<6; $i++) {
		$d=rand(1,30)%2;
        $pwd.=$d ? chr(rand(65,90)) : chr(rand(48,57));
    }
    $pwd=strtolower($pwd);
    
    return $pwd;
}

function generate_random(){
	$pwd="";
    for ($i=0; $i<16; $i++) {
		$d=rand(1,30)%2;
        $pwd.=$d ? chr(rand(65,90)) : chr(rand(48,57));
    }
    $pwd=strtolower($pwd);
    
    return $pwd;
}
}
?>