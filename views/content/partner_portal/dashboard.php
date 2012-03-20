<script type="text/javascript" src="js/ICanHandlebarz.js"></script>
<script type="text/javascript" src="js/handlebars.js"></script>
<link rel="stylesheet" type="text/css" href="js/jqplot/jquery.jqplot.min.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jqplot/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="js/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
        
     
       var provider_id = $('#provider_id').val();
       var advertiser_id = $('#advertiser_id').val();
       var user_id = $('#user_id').val();
       var banner_id = $('#banner_id').val();
       
       
        
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
 
        
        $.get("partner_content_listing/banner_data/"+ banner_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.banner_content_tpl(data);
            $('#banner-content').html('');
            $('#banner-content').append(template);
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
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
        
    }); 
    
</script>



<input type="hidden" id="provider_id" value="<?php echo $this->session->userdata('provider_id'); ?>" />

<input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id'); ?>" />

<div style="display:none" id="advertiser-content"> </div>

<br />
<div style="border-top: 2px dotted #b7b7b7; "></div>
<br />
<table width="917" border="0" cellspacing="0" cellpadding="0" align="center">
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
    <div id="ad_clicks" class="chart"></div>
    
    </td>
  </tr>
</table>

<!--------------------------------------------------------------------------------------------->
<br />

<table width="917" border="0" cellspacing="0" cellpadding="0">
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
    <div id="item-stats"></div>
</table>
   </div>
    </td>
  </tr>
</table>


<!--------------------------------------------------------------------------------------------->
<br />

<!--------------------------------------------------------------------------------------------->






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
    <span class="fontblue">Statistics for {{url}} </span>
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
    <td width="94"><span class="fontblue">{{avg_time_on_page}}</span></td>
  </tr>
  <tr class="bord2" bgcolor="#deedf4">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Number of visits:</span>
    </div>
    </td>
    <td><span class="fontblue">{{nb_visits}}</span></td>
  </tr>
  <tr class="bord2">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">Number of unique visitors:
    </span>
    </div>
    </td>
    <td><span class="fontblue">{{sum_daily_nb_uniq_visitors}}</span></td>
  </tr>
  <tr class="bord2" bgcolor="#deedf4">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">
    Bounce Rate:
    </span></div>
    </td>
    <td><span class="fontblue">{{bounce_rate}}</span></td>
  </tr>
  <tr class="bord2">
    <td>
    <div style="padding-left:26px;">
    <span class="fontblue">As of Date
    </span>
    </div>
    </td>
    <td><span class="fontblue">start_date - end_date</span></td>
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


        
        
       
