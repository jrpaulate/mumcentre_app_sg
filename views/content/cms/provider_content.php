
 

<div id="content">
    <ul class="ulsubnav">
        <li><a href="cms_provider">Provider List</a></li>
         <li><a href="cms_provider_content/content">Provider Content</a></li>
    </ul>

   
    
    
      <form id="frmSearch" name="frmMain">
                <div class="searchbar">
                    <ul>
                        <li> <div >Select Provider:</div> </li>
                        <li> <div id="providerSelect-listing"></div></li>
                       
                    </ul>
          
                </div>
      
             
   </form>
    
    
    
    <div class="tableholder">
        <!--    <div class='pager'>
                              <span class='pageNumbers'></span>
                              Page <span class='currentPage'></span> of <span class='totalPages'></span>
                            </div>-->

        
        
   <table class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
    <td> 
    
     <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="#"  id="profile">Profile</a></div>
    </div>    
        
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="#"  id="events">Events</a></div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="#"  id="programs">Programs</a></div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="#"  id="reviews">Reviews</a></div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="#"  id="curriculum">Curriculum</a></div>
    </div>
    
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="#"  id="curriculum">Advertorials</a></div>
    </div>
    
     <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="#"  id="branch">Branches</a></div>
    </div>
        
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="#"  id="dashboard">Dashboard</a></div>
    </div>
        
     <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="#"  id="ads">Ads</a></div>
    </div>
   
    </div>
    
    </td>
  </tr>
        </table>
        

<table width="917" border="0" cellspacing="0" cellpadding="0" >
  <tr class="bord">
 
  </tr>
  <tr class="bord2">
  <td> <div id="articleinfo"></div></td>
  <td> <div id="event-listing"></div></td>

  </tr>
  
  
  <tr>
      <td>
     
      </td>
      
      
  </tr>
  
</table>        
        
        
 </div>

    <div id="preview"><iframe id="frame" src="http://sg.mumcentre.com" width="1250" height="550"></iframe></div>
    

</div>


    
<div id="dashboard1" style="display:none">
        
<div style="display:none" id="advertiser-content"> </div>        
       
<br />
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
    <table width="917" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="42"><span class="fontcomfortaa2">From:</span></td>
    <td width="130"><input type="text" id="start_date" class="text-ep-input" name="start_date" value="<?php echo set_value('start_date'); ?>" /></td>
    <td width="24"><span class="fontcomfortaa2">To:</span></td>
    <td width="140"><input type="text" id="end_date" class="text-ep-input" name="end_date" value="<?php echo set_value('end_date'); ?>" /></td>
    <td width="100"><span class="fontcomfortaa2">Content List:</span></td>
    <td width="163"><div id="provider-content-listing"></div></td>
    <td width="67"><span class="fontcomfortaa2">Ad List:</span></td>

    <td width="153"><div id="ads-content"></div></select></td>
  </tr>
</table>

    
    
    </td>
  </tr>
</table>
<!--------------------------------------------------------------------------------------------->
 <br />
<table width="917" border="0" cellspacing="0" cellpadding="0">
   
    <tr>
  
    <td width="21" valign="top"><input name="views" id="radioviews" type="radio" class="input.week" value="0"   /></td>
    <td width="49" valign="middle" >VIEWS</td>
    <td width="20" valign="top"><input name="clicks" id="radioclicks" type="radio" class="input.week" value="0"  /></td>
    <td width="827" valign="middle">CLICKS</td>
  
    </tr>
  <tr>
    <td colspan="4" height="12">
    </td>
  </tr>
  <tr>
    <td colspan="4" height="200" bgcolor="#dfe9f4" valign="top">
    <div id="ad_impressions" class="chart"></div>
    <div id="item-stats"></div> 
    <div id="ad_clicks" class="chart"></div>
    <div id="ads-stats"></div> 
    </td>
  </tr>
</table>

<!--------------------------------------------------------------------------------------------->
<br />

<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3">
    <div style="background:url(images/nav.png) no-repeat; width:917px;; height:25px;"></div>
    </td>
  </tr>
  <tr>
    <td width="458" valign="top">
    <div>
    <table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
  
    <div id="ads-stats"></div> 

  </table>
    </div>
    </td>
    <td width="3" bgcolor="#166c97"></td>
    <td valign="top">
    <div>
        

<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
    <div id="item-stats">
        <tr class="bord2">
    <td width="356" >
    <div style="padding-left:26px;">
    <span class="fontblue">Statistics  </span>
    </div>
    </td>
    <td width="94"><span class="fontblue"></span></td>
  </tr>
   
   <tr class="bord2">
    <td width="356" >
    <div style="padding-left:26px;">
    <span class="fontblue">Average time on page:</span>
    </div>
    </td>
    <td width="94"><span id="avg_time"class="fontblue"></span></td>
  </tr>
  <tr class="bord2" bgcolor="#deedf4">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Number of visits:</span>
    </div>
    </td>
    <td><span id="nb_visits" class="fontblue"></span></td>
  </tr>
  <tr class="bord2">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Number of unique visitors:
    </span>
    </div>
    </td>
    <td><span id="nb_unique_visits" class="fontblue"></span></td>
  </tr>
  <tr class="bord2" bgcolor="#deedf4">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">
    Bounce Rate:
    </span></div>
    </td>
    <td><span id="bounce_rate" class="fontblue"></span></td>
  </tr>
  <tr class="bord2">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Date Range
    </span>
    </div>
    </td>
    <td><span id="date_range"  class="fontblue"></span></td>
  </tr>
    </div>
</table>
   </div>
    </td>
  </tr>
</table>
        
        
        
</div>


<script type="text/html" id="providerAll_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
        {{#providerAll_list}}
        {{#providerAll}}
        <tr>

            <td width="3%">{{id}}</td>
            <td width="5%"><img src="uploaded/provider/logo/{{provider_logo}}" width="65" height="65" /></td>
            <td width="20%">{{provider_name}}</td>
            <td width="10%">{{age_group_name}}</td>
            <td width="10%">{{provider_listing_name}}</td>
            <td width="5%">{{provider_status}}</td>
            <td width="15%"></br><a class="actionbtn" onclick="javascript:preview({{id}})" href="javascript:;;" >Preview</a> | <a class="actionbtn" href="edit_provider/read/{{id}}">Edit</a> </br> </br> <a class="actionbtn" onclick="javascript:advertise({{id}})" href="javascript:;;"> Add as Advertiser </a> </br> </br> <a class="actionbtn" href=""> Deactivate </a>   |   <a class="actionbtn" href="">Upgrade </a></br> </br></br> <a class="actionbtn" onclick="javascript:remove({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>

        </tr>
        {{/providerAll}}
        {{/providerAll_list}}
    </table>
</script>





<script type="text/html" id="provider_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
        {{#provider_list}}
        {{#provider}}
        <tr>

            <td width="3%">{{id}}</td>
            <td width="5%"><img src="uploaded/provider/logo/{{provider_logo}}" width="65" height="65" /></td>
            <td width="20%">{{provider_name}}</td>
            <td width="10%">{{age_group_name}}</td>
            <td width="10%">{{provider_listing_name}}</td>
            <td width="5%">{{provider_status}}</td>
            <td width="15%"></br><a class="actionbtn" onclick="javascript:preview({{id}})" href="javascript:;;" >Preview</a> | <a class="actionbtn" href="edit_provider/read/{{id}}">Edit</a> </br> </br> <a class="actionbtn" onclick="javascript:advertise({{id}})" href="javascript:;;"> Add as Advertiser </a> </br> </br> <a class="actionbtn" href=""> Deactivate </a>   |   <a class="actionbtn" href="">Upgrade </a></br> </br></br> <a class="actionbtn" onclick="javascript:remove({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>

        </tr>
        {{/provider}}
        {{/provider_list}}
    </table>
</script>


<script type="text/html" id="provider_search_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
        {{#provider_list}}
        {{#provider}}
        <tr>

            <td width="3%">{{id}}</td>
            <td width="5%"><img src="uploaded/provider/logo/{{provider_logo}}" width="65" height="65" /></td>
            <td width="20%">{{provider_name}}</td>
            <td width="10%">{{age_group_name}}</td>
            <td width="10%">{{provider_listing_name}}</td>
            <td width="5%">{{provider_status}}</td>
            <td width="15%"></br><a class="actionbtn" onclick="javascript:preview({{id}})" href="javascript:;;" >Preview</a> | <a class="actionbtn" href="edit_provider/read/{{id}}">Edit</a> </br> </br> <a class="actionbtn" onclick="javascript:advertise({{id}})" href="javascript:;;"> Add as Advertiser </a> </br> </br> <a class="actionbtn" href=""> Deactivate </a>   |   <a class="actionbtn" href="">Upgrade </a></br> </br></br> <a class="actionbtn" onclick="javascript:remove({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>

        </tr>
        {{/provider}}
        {{/provider_list}}
    </table>
</script>


<script type="text/html" id="dashboard_listing_tpl">



</script>



<input type="hidden" id="provider_id"/>
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" src="js/jqplot/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="js/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="js/handlebars.js"></script>
<link rel="stylesheet" type="text/css" href="js/jqplot/jquery.jqplot.min.css" />
<script type="text/javascript">
    $(document).ready(function(){
        
         var provider_id = $('#provider_id').val();
         var advertiser_id = $('#advertiser_id').val();
     
         var banner_id = $('#banner_id').val();
         
         
          $.get("cms_event/provider_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.providerSelect_listing_tpl(data);
            $('#providerSelect-listing').html('');
            $('#providerSelect-listing').append(template);
            
            $('#provider').click(function(e){
          
        $('#provider_id').val($(this).val());
        
        
         e.preventDefault();
        });
            return false;
        });
        
        
        $('#start_date').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'                             
		});  
                
                
         $('#end_date').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'                             
		});
         
        $('#preview').dialog({
            autoOpen: false,
            width: 1300,
            height: 600
        });
        
        
        $.get("cms_provider/providerAll_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.providerAll_listing_tpl(data);
            $('#provider-listing').html('');
            $('#provider-listing').append(template);
            return false;
        });
        
    
        $.get("cms_provider/age_group_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.age_group_listing_tpl(data);
            $('#age-group-listing').html('');
            $('#age-group-listing').append(template);
            return false;
        });
        
        
        $.get("cms_provider/country_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.country_listing_tpl(data);
            $('#country-listing').html('');
            $('#country-listing').append(template);
            return false;
        });
        
        
        
         
        
        
        
        $('#frmSearch').submit(function(e) {
            var keyword = $('#keyword').val();
            $.get("cms_provider/search_provider/"+keyword, function(response) {
                var data = JSON.parse(response);
                var template = ich.provider_search_listing_tpl(data);
                $('#provider-listing').html('');
                $('#provider-listing').append(template); 
                return false;    });
            e.preventDefault();
        });
        
        
   
         $('#programs').click(function(e){
           var provider_id = $('#provider_id').val();
           $.get("cms_provider_content/program_data/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.program_listing_tpl(data);
            $('#articleinfo').html('');
            $('#articleinfo').append(template);
            return false;
            $('#articlecontain').html('');
            $('#articlecontain').append(event_body);
            
            });
            e.preventDefault(); 
        });  
        
        
         $('#reviews').click(function(e){
           var provider_id = $('#provider_id').val();
         $.get("partner_content_review/review_data/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.review_listing_tpl(data);
            $('#articleinfo').html('');
            $('#articleinfo').append(template);
            return false;
            $('#articlecontain').html('');
            $('#articlecontain').append(event_body);
        });
        
          e.preventDefault(); 
        });  
        
        
         $('#curriculum').click(function(e){
            var provider_id = $('#provider_id').val();
        $.get("partner_content_curriculum/curriculum_data/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.curriculum_listing_tpl(data);
            $('#articleinfo').html('');
            $('#articleinfo').append(template);
            return false;
            $('#articlecontain').html('');
            $('#articlecontain').append(event_body);
        });
           e.preventDefault(); 
        }); 
        
        
        
        $('#events').click(function(e){
             $('#dashboard1').css('display','none');  
             var provider_id = $('#provider_id').val();
          $.get("cms_provider_content/event_data/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.event_listing_tpl(data);
            $('#articleinfo').html('');
            $('#articleinfo').append(template);
            
           
            return false;
            $('#articlecontain').html('');
            $('#articlecontain').append(event_body);
            

             });
            e.preventDefault(); 
        }); 
        
        
         $('#ads').click(function(e){
        $('#dashboard1').css('display','none');  
          var provider_id = $('#provider_id').val();
          var advertiser_id = $('#advertiser_id').val();
        
        
          $.get("partner_content_listing/provider_data/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.advertiser_content_tpl(data);
            $('#advertiser-content').html('');
            $('#advertiser-content').append(template);
 
            var advertiser_id = $('#advertiser_id').val();
            
             
                
            $.get("cms_advertiser/ad_list/"+advertiser_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.ad_listing_tpl(data);
             $('#articleinfo').html('');
            $('#articleinfo').append(template);
            
            
            
            
        });  
            return false;       
         });
            e.preventDefault(); 
        }); 
        
        
       
        
        $('#profile').click(function(e){
        var provider_id = $('#provider_id').val();
       
        $.get("cms_provider_content/provider_data/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.providerProfile_listing_tpl(data);
            $('#articleinfo').html('');
            $('#articleinfo').append(template);
            
            var html_data = $('#provider_details').text();
                $('#provider_details').text('');
                $('#provider_details').html(html_data);
            
            
            
             $.post("ps_providers/getmap/", {
            profile_id : 1
        },
        function(data){
            var rurl = data.split(":");
            var mapper = rurl[1];
            var mapper = mapper.replace(/[}]]+/g,'');
            var mapper = mapper.replace(/[""]+/g,'');
            
            var latlng = new google.maps.LatLng(-34.397, 150.644); //initialize google map
            var myOptions = {
                zoom: 14,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);
            var geocoder;       //start geocoding
            var marker;
            geocoder = new google.maps.Geocoder();
            var latlngStr = mapper.split(",",2);
            var lat = parseFloat(latlngStr[0]);
            var lng = parseFloat(latlngStr[1]);
            var latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({'latLng': latlng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        map.setZoom(16);
                        map.setCenter(latlng);
                        marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                    }
                    $('#geocode').val(results[0].geometry.location);
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });
            
        });
            
            
            return false;
            $('#articlecontain').html('');
            $('#articlecontain').append(provider_body);
        });
            e.preventDefault(); 
        }); 
        
        
        
        
         $('#dashboard').click(function(e){
         $('#articleinfo').html('');
         $('#dashboard1').css('display','');
         
          
          var provider_id = $('#provider_id').val();
          var advertiser_id = $('#advertiser_id').val();
         
      
      
          $.get("partner_content_listing/provider_data/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.advertiser_content_tpl(data);
            $('#advertiser-content').html('');
            $('#advertiser-content').append(template);
 
            var advertiser_id = $('#advertiser_id').val();
            
             
                
            $.get("partner_content_listing/ads_data/"+ advertiser_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.ads_content_tpl(data);
            $('#ads-content').html('');
            $('#ads-content').append(template);
            
            
            
            
        });  
            return false;       
        });
 
         
         
         $.get("partner_content_listing/provider_content_list/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_content_tpl(data);
            $('#provider-content-listing').html('');
            $('#provider-content-listing').append(template);
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            
            
            
       
            
            return false;
            
            });
         
         
      
 
        
         
       
        
        
       
            
         
            
            
        $('#radioviews').click(function(e){
        $('#radioclicks').removeAttr('checked');   
        $('#ad_impressions').css('display','');  
        $('#ad_clicks').css('display','none');   
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var provider_content = $('#provider_content').val();
         var cPlot_line = new Array();
  
         $.get("analytics/get_url_stats_range/",
        {
            url: provider_content,
            from: start_date,
            to: end_date
        },
        function(response) {
            var total_avg_time_on_page = 0;
            var total_nb_visits = 0;
            var total_nb_uniq_visitors = 0;
            var total_bounce_rate = 0;
            var data = JSON.parse(response);
            for(var a in data) {
                
            var b = {"data": data[a].length == 0 ? null : data[a], "nb_visits":a, "avg_time_on_page":a, "nb_uniq_visitors":a, "bounce_rate":a, "sum_daily_nb_uniq_visitors":a, "date":a}
            
            if(data[a].length > 0) {
               total_avg_time_on_page += data[a][0].avg_time_on_page;
               total_nb_visits += data[a][0].nb_visits;
               total_nb_uniq_visitors += data[a][0].nb_uniq_visitors;
               total_bounce_rate += parseFloat(data[a][0].bounce_rate);
            }
            
            $('#ads-stats').html('');
            var provider_content = $('#provider_content').val();    
                

                 if(data[a].length > 0) {

                    var cPoint = new Array(a, data[a][0].nb_hits);
                   
                } else {
                   
                    var cPoint = new Array(a, 0);
                    
                }
                cPlot_line.push(cPoint);
              
            }
            var template = ich.item_stats_tpl(b);
            $('#item-stats').html('');
            $('#item-stats').append(template);
          
            $('#avg_time').html('');
            $('#nb_visits').html('');
            $('#nb_unique_visits').html('');
            $('#bounce_rate').html('');
            $('#avg_time').append(total_avg_time_on_page);
            $('#nb_visits').append(total_nb_visits);
            $('#nb_unique_visits').append(total_nb_uniq_visitors);
            $('#bounce_rate').append(total_bounce_rate+'%');
	    $('#date_range').append(start_date+' to '+end_date);
            
            var cPlot = $.jqplot('ad_impressions', [cPlot_line], {
                title:'Content Views', 
                axes:{
                    xaxis:{
                        renderer:$.jqplot.DateAxisRenderer
                        }
                    },
                    series:[{lineWidth:4, markerOptions:{style:'square'}}]
                });
             $('#focus').click(function(e){
                 
                 e.preventDefault();
             })  
            return false;
        });    
    }); 
         
         
       
        
        
        
        
   $('#radioclicks').click(function(e){ 
        $('#radioviews').removeAttr('checked');
        $('#ad_clicks').css('display',''); 
        $('#ad_impressions').css('display','none'); 
        
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var banner_id = $('#banner_id').val();
        
        var iPlot_line = new Array();
        var cPlot_line = new Array();
        $.get("ads/daily_stats/"+ banner_id+ "/" + start_date+ "/" + end_date, function(response) {            
            var data = JSON.parse(response);
            for(var stat in data) {
                var iPoint = new Array(data[stat].day, parseInt(data[stat].impressions, 10));
                var cPoint = new Array(data[stat].day, parseInt(data[stat].clicks, 10));
                iPlot_line.push(iPoint);
                cPlot_line.push(cPoint);
                
            var b = {"data": data[stat].length == 0 ? null : data[stat], "day":stat, "clicks":stat, "impressions":stat}           
            var template = ich.ads_stats_tpl(b);
            $('#ads-stats').html('');
            $('#ads-stats').append(template);  
            $('#item-stats').html('');
            }
            
            

            var cPlot = $.jqplot('ad_clicks', [cPlot_line], {
                title:'Ad Click Stats', 
                axes:{
                    xaxis:{
                        renderer:$.jqplot.DateAxisRenderer
                    }
                },
                series:[{lineWidth:4, markerOptions:{style:'square'}}]
                });
            
            return false;
            
        }); 
        
           }); 
        
        
 
            
            
            
            e.preventDefault(); 
        }); 
            
      
        
        
        
      
            
        
    });
</script>



<script>

    function preview (provider_id) {
        //         echo ('Msg');
        $.post("cms_provider/get_provider_link", {
            provider_id: provider_id  
        },
        function(data) {
            //                alert(data);
            $('#frame').attr('src', data);
            $('#preview').dialog('open');
        });
        //            $('#preview').append('Msg');

    }

       

</script>


<script>

    function advertise (provider_id) {

        
            
        $.post('cms_provider/make_advertiser/'+provider_id,
        {
            provider_id: provider_id
        },
        function(data){
            var rurl = data.split(":");
            var code = rurl[0];
            var msg = rurl[1];
            if (code != 0) {
                alert('error: '+data);
            } else {
                alert(msg);
//                window.location = 'cms/cms';
                           
            }
        });
        //           window.location = 'cms_provider';   
    }
       

</script>



<script>

 function remove (provider_id) {

           $.post("cms_provider/force_delete/"+ provider_id) 
           

           alert('Provider Content Removed')             
            
           
           window.location = 'cms_provider';   
          }
       

</script>





<script>

        
     function Search(){
     var date = 0;
     var status =0;
     var country_id = $('#countries').val();
     var age_group_id = $('#age_group').val();
     var status = $('#status').val();
     if($('#search_date').val()){date = $('#search_date').val();}
     
     if($('#status').val()){type = $('#status').val();}
    
    
    
    $.get("cms_provider/provider_list/"+ country_id+"/"+ age_group_id+"/"  + status+"/" +date, function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#provider-listing').html('');
            $('#provider-listing').append(template);
            return false;
            
            
        });
        
           
 
    
}
</script>



<script type="text/html" id="age_group_listing_tpl">
    {{#age_group_list}}
    <dd><select name="age_group" id="age_group" onchange="">
            <option value="0"> All </option>
            {{#age_groups}}
            <option value="{{age_group_id}}">{{age_group_name}}</option>
            {{/age_groups}}
        </select></dd>
  
    {{/age_group_list}}
</script>


<script type="text/html" id="country_listing_tpl">
    {{#country_list}}
           
   <dd><select name="countries" id="countries" onchange="">    
             
            <option value="0"> All </option>
             {{#countries}}
           
            <option value="{{country_id}}">{{country_name}}</option>
             {{/countries}}
   </select></dd>
   
    {{/country_list}}
</script>


<script type="text/html" id="providerSelect_listing_tpl">
    {{#provider_list}}
    <dd><select name="provider" id="provider">    
            <option value="0">Select Provider</option>
            {{#providers}}
            <option value="{{id}}">{{provider_name}}</option>
            {{/providers}}
        </select></dd>
    {{/provider_list}}
</script>






<script type="text/html" id="event_listing_tpl">
    <table width="1040" border="0" cellspacing="0" cellpadding="0">
       

        </br>
        
        <tr></tr>
             
        {{#event_data}}

        <tr class="bord">
            
          
            <td width="50px"><span class="fontblue" style="font-size: 14px;">Id</td>
            <td width="150px"><span class="fontblue" style="font-size: 14px;">Image</td>
            <td width="150px"><span class="fontblue" style="font-size: 14px;">Age Group</td>
            <td width="200px"><span class="fontblue" style="font-size: 14px;">Event Title</td>
            <td width="100px"><span class="fontblue" style="font-size: 14px;">Status</td>
          
            <td width="100px"><span class="fontblue" style="font-size: 14px;">Command</td>
         
           
        </tr>
        
 
         {{#event}}
       <tr class="bord2">
            
            <td ><span style="font-size: 14px" color="#ccc;">  {{id}} </td>
            <td ><a href=""><IMG src="uploaded/provider/event/image/{{event_image}}" width="80px" height="70px"></a></td>
            <td ><span style="font-size: 14px" color="#ccc;"> {{age_group_name}}</td>
            <td ><span style="font-size: 14px" color="#ccc;"> {{event_title}} </td>
            <td ><span style="font-size: 14px" color="#ccc;"> {{event_status}} </td>
    
   
           <td width="25%"></br><a class="actionbtn" onclick="javascript:preview_event({{id}})" href="javascript:;;" id ="">Preview</a>| <a class="actionbtn"  href="provider_event_edit/read/{{id}}">Edit</a> | <a class="actionbtn" onclick="javascript:publish_event({{id}})" href="javascript:;;" >Publish</a> | <a class="actionbtn" onclick="javascript:unpublish_event({{id}})" href="javascript:;;" >Unpublish </a> </br></br> <a class="actionbtn" onclick="javascript:remove_event({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>

            
            
            
        </tr>
          {{/event}}
        {{/event_data}}
    </table>
</script>







<script type="text/html" id="program_listing_tpl">
    <table width="917" border="0" cellspacing="0" cellpadding="0">
       
        
   
        </br>
        
        <tr></tr>
       
        {{#program_data}}

        <tr class="bord">
             <td width="50px"><span class="fontblue" style="font-size: 14px;">Id</td>
            <td width="150px"><span class="fontblue" style="font-size: 14px;">Image</td>
            <td width="150px"><span class="fontblue" style="font-size: 14px;">Age Group</td>
            <td width="200px"><span class="fontblue" style="font-size: 14px;">Title</td>
            <td width="100px"><span class="fontblue" style="font-size: 14px;">Status</td>
            <td width="100px"><span class="fontblue" style="font-size: 14px;">Command</td>
           
           
        </tr>
        
 
         {{#program}}
       <tr class="bord2">
            
            <td ><span color="#ccc;"> {{id}} </td>
            <td ><a href=""><IMG src="uploaded/provider/program/image/{{program_image}}" width="80px" height="70px"></a></td>
            <td ><span style="font-size: 14px" color="#ccc;"> {{age_group_name}}</td>
            <td ><span style="font-size: 14px" color="#ccc;"> {{program_title}} </td>
            <td ><span style="font-size: 14px" color="#ccc;">{{program_status}} </td>
            
           
          <td width="30%"></br><a class="actionbtn" onclick="javascript:preview_program({{id}})" href="javascript:;;" id ="">Preview</a> | <a class="actionbtn" href="provider_program_edit/read/{{id}}">Edit</a> | <a class="actionbtn" onclick="javascript:publish_program({{id}})" href="javascript:;;" >Publish</a> | <a class="actionbtn" onclick="javascript:unpublish_program({{id}})" href="javascript:;;" >Unpublish </a> </br></br> <a class="actionbtn" onclick="javascript:remove_program({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>

 
       
        </tr>
        
  
        {{/program}}
        {{/program_data}}
    </table>
</script>




<script type="text/html" id="review_listing_tpl">
    <table width="917" border="0" cellspacing="0" cellpadding="0">
       
        
   
        </br>
        
        <tr></tr>
       
        {{#review_data}}

        <tr class="bord">
             <td width="50px"><span class="fontblue" style="font-size: 14px;">Id</td>
            <td width="150px"><span class="fontblue" style="font-size: 14px;">Image</td>
            <td width="150px"><span class="fontblue" style="font-size: 14px;">Age Group</td>
            <td width="200px"><span class="fontblue" style="font-size: 14px;">Title</td>
            <td width="100px"><span class="fontblue" style="font-size: 14px;">Status</td>
            <td width="100px"><span class="fontblue" style="font-size: 14px;">Command</td>
           
           
        </tr>
        
 
         {{#review}}
       <tr class="bord2">
            
            <td ><span color="#ccc;"> {{id}} </td>
            <td ><a href=""><IMG src="uploaded/provider/review/image/{{review_image}}" width="80px" height="70px"></a></td>
            <td ><span style="font-size: 14px" color="#ccc;"> {{age_group_name}}</td>
            <td ><span style="font-size: 14px" color="#ccc;"> {{review_title}} </td>
            <td ><span style="font-size: 14px" color="#ccc;">{{review_status}} </td>
            
           
            <td width="30%"></br><a class="actionbtn" onclick="javascript:preview_review({{id}})" href="javascript:;;" id ="">Preview</a> | <a class="actionbtn" href="provider_review_edit/read/{{id}}">Edit</a> | <a class="actionbtn" onclick="javascript:publish_review({{id}})" href="javascript:;;" >Publish</a> | <a class="actionbtn" onclick="javascript:unpublish_review({{id}})" href="javascript:;;" >Unpublish </a>  </br></br> <a class="actionbtn" onclick="javascript:remove_review({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>
                  
 
       
        </tr>
        
  
        {{/review}}
        {{/review_data}}
    </table>
</script>



<script type="text/html" id="curriculum_listing_tpl">
    <table width="917" border="0" cellspacing="0" cellpadding="0">
       
        
   
        </br>
        
        <tr></tr>
       
        {{#curriculum_data}}

        <tr class="bord">
            <td width="50px"><span class="fontblue" style="font-size: 14px;">Id</td>
            <td width="150px"><span class="fontblue" style="font-size: 14px;">Image</td>
            <td width="150px"><span class="fontblue" style="font-size: 14px;">Age Group</td>
            <td width="200px"><span class="fontblue" style="font-size: 14px;">Title</td>
            <td width="100px"><span class="fontblue" style="font-size: 14px;">Status</td>
            <td width="100px"><span class="fontblue" style="font-size: 14px;">Command</td>
            
           
        </tr>
        
 
         {{#curriculum}}
       <tr class="bord2">
            
            <td ><span color="#ccc;"> {{id}} </td>
            <td ><a href=""><IMG src="uploaded/provider/curriculum/image/{{curriculum_image}}" width="80px" height="70px"></a></td>
            <td ><span style="font-size: 14px" color="#ccc;"> {{age_group_name}}</td>
            <td ><span style="font-size: 14px" color="#ccc;">{{curriculum_title}} </td>
            <td ><span style="font-size: 14px" color="#ccc;"> {{curriculum_status}} </td>
            
            <td width="30%"></br><a class="actionbtn" onclick="javascript:preview_curriculum({{id}})" href="javascript:;;" id ="">Preview</a>| <a class="actionbtn" href="provider_curriculum_edit/read/{{id}}">Edit</a> |  <a class="actionbtn" onclick="javascript:publish_curriculum({{id}})" href="javascript:;;" >Publish</a> | <a class="actionbtn" onclick="javascript:unpublish_curriculum({{id}})" href="javascript:;;" >Unpublish </a>  </br></br> <a class="actionbtn" onclick="javascript:remove_curriculum({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>

           
       
        </tr>
        
  
        {{/curriculum}}
        {{/curriculum_data}}
    </table>
</script>






<script type="text/html" id="providerProfile_listing_tpl">
<table width="1040" border="0" cellspacing="0" cellpadding="0" align="center">
        {{#provider_data}}
        {{#provider}}
  
        
        </br>
        </br>
  <tr class="provider">
  
   <div style=""><span class="fontcomfortaa">Partner Listing</span> &nbsp;&nbsp;<img src="images/Header-Arrow.png"> 
   <span style="font-size: 25px; color: #2490ce;">Provider Profile</span>
   <span style="font-size: 25px; color: #2490ce;">
   
   </span>
   
   
  </div>
  
  
   </tr>
        
 
   </br>
   
    <tr>
    <td width="309" valign="top">
   <a href=""><img src="uploaded/provider/image/{{provider_image}}"></a>
    </td>
    <td width="18">&nbsp;</td>
    <td width="608" valign="top">
    <div style="line-height:29px;">
    <span style="font-size: 24px; color: #2490ce;"> {{provider_name}}</span>  <span style="font-size: 30px; color: #2490ce;"><a href="provider_profile_edit/read/{{id}}"> <img src="assets/img/system/edit.PNG" height="35px"></a> 
   
   </span>
    <br />
    Location: {{provider_location}} <br /> Telephone: {{{provider_contact}}}
    <br />
    <span style="color:#60296c;"> Email Address: {{provider_email}} </span>
    <br/>
    <span style="color:#60296c;">Website: {{{provider_link}}}</span>
    <br /> 
     <a href=""><img src="uploaded/provider/logo/{{provider_logo}}"></a>
    </div>
    </td>
  </tr>
</table>
<br />

<br />
<span style="font-size: 24px; color: #2490ce;">Provider Details</span>
<br />
<div id="provider_details" align="justify" style="line-height: 29px;">
<span style="color: #2490ce;"> {{provider_details}} </br> </span>
    
    

</div>

<br />
<span style="font-size: 24px; color: #2490ce;">Location</span>
<br />
<div>
<input type="hidden" name="geocoding" id="geocoding"/></dd></br>
                        <dt class="empty"></dt>
                        <div id="map_canvas" style="width:700px; height:377px"></div>
                        <dt class="empty"></dt>   </br> 
                        <dd><input type="hidden" id="geocode"/>
</div>
        
    
        {{/provider}}
        {{/provider_data}}
    </table>
</script>





<script>
    var geocoder;
    var map;
    var marker;
    
    function initialize(){
        var latlng = new google.maps.LatLng(1.352083, 103.81983600000001); //initialize google map
        var myOptions = {
            zoom: 14,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);
    }    
    
    function geo(){
        var latlng = $('#geocoding').val();
        //                alert(latlng);
        if(marker){
            marker.setMap(null);
        }
        var latlng1 = new google.maps.LatLng(-34.397, 150.644); //initialize google map
        var myOptions = {
            zoom: 14,
            center: latlng1,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);
        geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': latlng}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    draggable: true
                });
                //                            alert(results[0].geometry.location);
                $('#geocode').val(results[0].geometry.location);
                google.maps.event.addListener(marker, 'dragend', function() {
                    //                        updateMarkerStatus('Drag ended');
                    //                        alert(marker.getPosition());
                    $('#geocode').val(marker.getPosition());
                });
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        }); 
    }
    function init_geo(){
        if(marker){
            marker.setMap(null);
        }
        var id = $('#provider').val();
        $.post("ps_providers/getmap/", {
            profile_id : id
        },
        function(data){
            var rurl = data.split(":");
            var mapper = rurl[1];
            var mapper = mapper.replace(/[}]]+/g,'');
            var mapper = mapper.replace(/[""]+/g,'');
            
            var latlng = new google.maps.LatLng(-34.397, 150.644); //initialize google map
            var myOptions = {
                zoom: 14,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);
            var latlngStr = mapper.split(",",2);
            var lat = parseFloat(latlngStr[0]);
            var lng = parseFloat(latlngStr[1]);
            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'latLng': latlng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        map.setZoom(16);
                        map.setCenter(latlng);
                        marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                    }
                    $('#geocode').val(results[0].geometry.location);
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });
        });
            
    }
  
            
</script>





<script>

 function preview_event (event_id) {

            $.post("cms_event/get_event_link", {
              event_id: event_id  
            },
            function(data) {
       
                $('#frame').attr('src', data);
                $('#preview').dialog('open');
            });


}

       

</script>


<script>

 function preview_program (program_id) {

            $.post("cms_program/get_program_link", {
              program_id: program_id  
            },
            function(data) {

                $('#frame').attr('src', data);
                $('#preview').dialog('open');
            });


}

       

</script>




<script>

 function preview_curriculum (curriculum_id) {

            $.post("cms_curriculum/get_curriculum_link", {
              curriculum_id: curriculum_id  
            },
            function(data) {

                $('#frame').attr('src', data);
                $('#preview').dialog('open');
            });


}

       

</script>


<script>

 function preview_review (review_id) {

            $.post("cms_review/get_review_link", {
              review_id: review_id  
            },
            function(data) {

                $('#frame').attr('src', data);
                $('#preview').dialog('open');
            });


}
    

</script>



<script>

 function unpublish_program (program_id) {

           $.post("cms_program/unpublish/"+ program_id) 
           

           alert('Program Successfully Unpublished')             
            
           
           window.location = 'cms_provider_content/content';   
          }
       

</script>


<script>

 function publish_program (program_id) {

           $.post("cms_program/force_publish/"+ program_id) 
           

           alert('Program Successfully Published')             
            
           
           window.location = 'cms_provider_content/content';   
          }
       

</script>




<script>

 function unpublish_curriculum (curriculum_id) {

           $.post("cms_curriculum/unpublish/"+ curriculum_id) 
           

           alert('Curriculum Successfully Unpublished')             
            
           
           window.location = 'cms_provider_content/content';   
          }
       

</script>


<script>

 function publish_curriculum (curriculum_id) {

           $.post("cms_curriculum/force_publish/"+ curriculum_id) 
           

           alert('Curriculum Successfully Published')             
            
           
           window.location = 'cms_provider_content/content';   
          }
       

</script>




<script>

 function unpublish_review (review_id) {

           $.post("cms_review/unpublish/"+ review_id) 
           

           alert('Review Successfully Unpublished')             
            
           
           window.location = 'cms_provider_content/content';   
          }
       

</script>


<script>

 function publish_review (review_id) {

           $.post("cms_review/force_publish/"+ review_id) 
           

           alert('Review Successfully Published')             
            
           
           window.location = 'cms_provider_content/content';   
          }
       

</script>




<script>

 function unpublish_event (event_id) {

           $.post("cms_event/unpublish/"+ event_id) 
           

           alert('Events Successfully Unpublished')             
            
           
           window.location = 'cms_provider_content/content';   
          }
       

</script>


<script>

 function publish_event (event_id) {

           $.post("cms_event/force_publish/"+ event_id) 
           

           alert('Events Successfully  Published')             
            
           
           window.location = 'cms_provider_content/content';   
          }
       

</script>





<script>

 function remove_review (review_id) {

           $.post("cms_review/force_delete/"+ review_id) 
           

           alert('Review Removed')             
            
           
           window.location = 'cms_provider_content/content';   
          }
       

</script>



<script>

 function remove_program (program_id) {

           $.post("cms_program/force_delete/"+ program_id) 
           

           alert('Program Removed')             
            
           
           window.location = 'cms_provider_content/content';   
          }
       

</script>




<script>

 function remove_event (event_id) {

           $.post("cms_event/force_delete/"+ event_id) 
           

           alert('Events Removed')             
            
           
           window.location = 'cms_provider_content/content';   
          }
       

</script>



<script>

 function remove_curriculum (curriculum_id) {

           $.post("cms_curriculum/force_delete/"+ curriculum_id) 
           

           alert('Curriculum Removed')             
            
           
           window.location = 'cms_provider_content/content';   
          }
       

</script>






<script type="text/html" id="ads_stats_tpl">

{{day}}
{{clicks}}
{{impressions}}
{{#if data}}
{{#data}}
  
    <tr class="bord2">
    <td width="356" >
    <div style="padding-left:26px;">
    <span class="fontblue">Ads >>> First Price</span>
    </div>
    </td>
    <td width="94"><span class="fontblue"></span></td>
  </tr>
        
   <tr class="bord2">
    <td width="356" >
    <div style="padding-left:26px;">
    <span class="fontblue">Total Impressions</span>
    </div>
    </td>
    <td width="94"><span class="fontblue">{{impressions}}</span></td>
  </tr>
  <tr class="bord2" bgcolor="#deedf4">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Total Clicks</span>
    </div>
    </td>
    <td><span class="fontblue">{{clicks}}</span></td>
  </tr>
  <tr class="bord2">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Start Date of Ads
    </span>
    </div>
    </td>
    <td><span class="fontblue"><div id="banner-content">$start_date</div></span></td>
  </tr>
  <tr class="bord2" bgcolor="#deedf4">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">
    Expiry date of Ads
    </span></div>
    </td>
    <td><span class="fontblue">10-11-2011</span></td>
  </tr>
  <tr class="bord2">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">As of Date
    </span>
    </div>
    </td>
    <td><span class="fontblue">{{day}}</span></td>
  </tr>
 
{{/data}}
{{else}}

<tr class="bord2">
    <td width="356" >
    <div style="padding-left:26px;">
    <span class="fontblue">Ads >>> First Price</span>
    </div>
    </td>
    <td width="94"><span class="fontblue"></span></td>
  </tr>
        
   <tr class="bord2">
    <td width="356" >
    <div style="padding-left:26px;">
    <span class="fontblue">Total Impressions</span>
    </div>
    </td>
    <td width="94"><span class="fontblue"></span></td>
  </tr>
  <tr class="bord2" bgcolor="#deedf4">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Total Clicks</span>
    </div>
    </td>
    <td><span class="fontblue"></span></td>
  </tr>
  <tr class="bord2">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Start Date of Ads
    </span>
    </div>
    </td>
    <td><span class="fontblue"><div id="banner-content"></div></span></td>
  </tr>
  <tr class="bord2" bgcolor="#deedf4">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">
    Expiry date of Ads
    </span></div>
    </td>
    <td><span class="fontblue">10-11-2011</span></td>
  </tr>
  <tr class="bord2">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">As of Date
    </span>
    </div>
    </td>
    <td><span class="fontblue">{{day}}</span></td>
  </tr>


{{/if}}  
</script>




<script type="text/html" id="item_stats_tpl">
{{date}}
{{nb_visits}}
{{avg_time_on_page}}
{{#if data}}
{{#data}}
<tr class="bord2">
    <td width="356" >
    <div style="padding-left:26px;">
    <span class="fontblue">Statistics  </span>
    </div>
    </td>
    <td width="94"><span class="fontblue"></span></td>
  </tr>
   
   <tr class="bord2">
    <td width="356" >
    <div style="padding-left:26px;">
    <span class="fontblue">Average time on page:</span>
    </div>
    </td>
    <td width="94"><span id="avg_time"class="fontblue"></span></td>
  </tr>
  <tr class="bord2" bgcolor="#deedf4">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Number of visits:</span>
    </div>
    </td>
    <td><span id="nb_visits" class="fontblue"></span></td>
  </tr>
  <tr class="bord2">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Number of unique visitors:
    </span>
    </div>
    </td>
    <td><span id="nb_unique_visits" class="fontblue"></span></td>
  </tr>
  <tr class="bord2" bgcolor="#deedf4">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">
    Bounce Rate:
    </span></div>
    </td>
    <td><span id="bounce_rate" class="fontblue"></span></td>
  </tr>
  <tr class="bord2">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Date Range
    </span>
    </div>
    </td>
    <td><span id="date_range"  class="fontblue"></span></td>
  </tr>
 
{{/data}}
{{else}}
<tr class="bord2">
    <td width="356" >
    <div style="padding-left:26px;">
    <span class="fontblue">Statistics  </span>
    </div>
    </td>
    <td width="94"><span class="fontblue"></span></td>
  </tr>
   
   <tr class="bord2">
    <td width="356" >
    <div style="padding-left:26px;">
    <span class="fontblue">Average time on page:</span>
    </div>
    </td>
    <td width="94"><span id="avg_time"class="fontblue"></span></td>
  </tr>
  <tr class="bord2" bgcolor="#deedf4">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Number of visits:</span>
    </div>
    </td>
    <td><span id="nb_visits" class="fontblue"></span></td>
  </tr>
  <tr class="bord2">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Number of unique visitors:
    </span>
    </div>
    </td>
    <td><span id="nb_unique_visits" class="fontblue"></span></td>
  </tr>
  <tr class="bord2" bgcolor="#deedf4">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">
    Bounce Rate:
    </span></div>
    </td>
    <td><span id="bounce_rate" class="fontblue"></span></td>
  </tr>
  <tr class="bord2">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Date Range
    </span>
    </div>
    </td>
    <td><span id="date_range"  class="fontblue"></span></td>
  </tr>
{{/if}} 
</script>






<script type="text/html" id="provider_content_tpl">
    {{#provider_content_list}}
    <dd><select class="" name="provider" id="provider_content" width="200">    
            <option value="0">Select Content</option>
            {{#provider_content}}
            <option value="<?php echo base_url(); ?>ps_providers/{{type}}/{{provider_id}}/{{id}}">{{title}}</option>
             {{/provider_content}}
        </select></dd>
     {{/provider_content_list}}
</script>


<script type="text/html" id="advertiser_content_tpl">
    {{#provider_data}}
   
           
            {{#providers}}
            <input id="advertiser_id" value="{{advertiser_id}}" />
            
            {{/providers}}
     
    {{/provider_data}}
</script>
  


<script type="text/html" id="ads_content_tpl">
    {{#ads_data}}
    <dd><select class="" name="ads" id="banner_id" width="200">    
            <option value="0">Select Content</option>
            {{#ads}}
            <option value="{{banner_id}}">{{name}}</option>
            {{/ads}}
        </select></dd>
     {{/ads_data}}
</script>



<script type="text/html" id="banner_content_tpl">
    {{#banner_data}}
   
           
            {{#banner}}
            <input id="start_date" value="{{start_date}}" />
            <input id="end_date" value="{{end_date}}" />
            
            {{/banner}}
     
    {{/provider_data}}
</script>


        
        
<script type="text/html" id="ad_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
          
	<tr class="bord">
                <td width="3%">ID</td>
                <td width="5%">Ad image</td>
                <td width="15%">ad URL</td>
                <td width="15%">Ad name</td>
                <td width="5%">Width</td>
                <td width="5%">Height</td>
                <td width="15%">Placement</td>
                <td width="5%">Status</td>


                </tr>


            {{#ad_list}}
            {{#ads}}
        	
            
        	<tr class="bord2">

        	  <td width="3%">{{id}}</td>
        	  <td width="5%"><img src="{{image_url}}" width="65" height="65" /></td>
        	  <td width="15%">{{url}}</td>
                  <td width="15%">{{name}}</td>
                  <td width="5%">{{width}}</td>
                  <td width="5%">{{height}}</td>
                  <td width="15%">{{section}}</td>
                  <td width="5%">{{status}}</td>
        	          	  
                  <input id="banner_id" type="hidden" value="{{banner_id}}"/>
      	  </tr>


          {{/ads}}
          {{/ad_list}}
        </table>
</script>

