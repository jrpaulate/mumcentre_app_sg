<div id="ad_impressions" class="chart"></div>
<div id="ad_clicks" class="chart"></div>
<style type="text/css">
   
</style>
<link rel="stylesheet" type="text/css" href="js/jqplot/jquery.jqplot.min.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jqplot/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="js/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var iPlot_line = new Array();
        var cPlot_line = new Array();
        $.get("ads/daily_stats", function(response) {            
            var data = JSON.parse(response);
            for(var stat in data) {
                var iPoint = new Array(data[stat].day, parseInt(data[stat].impressions, 10));
                var cPoint = new Array(data[stat].day, parseInt(data[stat].clicks, 10));
                iPlot_line.push(iPoint);
                cPlot_line.push(cPoint);
            }
            var iPlot = $.jqplot('ad_impressions', [iPlot_line], {
                title:'Ad Impression Stats', 
                axes:{
                    xaxis:{
                        renderer:$.jqplot.DateAxisRenderer
                    }
                },
                series:[{lineWidth:4, markerOptions:{style:'square'}}]
            });
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
</script>