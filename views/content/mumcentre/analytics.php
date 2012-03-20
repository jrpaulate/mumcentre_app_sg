<div id="analytics"></div>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/ICanHandlebarz.js"></script>
<script type="text/javascript" src="js/handlebars.js"></script>
<script type="text/html" id="analytics_tpl">
    <div>{{date}}</div>
    {{#if data}}
    <ul>
        {{#data}}
        <li>
            <div>{{url}}</div>
            <ul>
                <li>Average time on page: {{avg_time_on_page}}</li>
                <li>Bounce Rate: {{bounce_rate}}</li>
                <li>Number of visits: {{nb_visits}}</li>
                <li>Number of unique visitors: {{nb_uniq_visitors}}</li>
            </ul>
        </li>
        {{/data}}
    </ul>
    {{else}}
    <div>No data.</div>
    {{/if}}
</script>
<script type="text/javascript">
    $(document).ready(function(){
//        $.get("analytics/get_url_stats/",
//        {
//            url: "http://mc.xhiber-dynamic.com",
//            period: "day",
//            count: 1
//        },
        $.get("analytics/get_url_stats_range/",
        {
            url: "http://mc.xhiber-dynamic.com/",
            from: '2012-02-08',
            to: '2012-02-10'
        },
        function(response) {            
            var data = JSON.parse(response);
            for(var a in data) {
                var b = {"data": data[a].length == 0 ? null : data[a], "date":a}
                var template = ich.analytics_tpl(b);
                $("#analytics").append(template);
            }
            return false;
        });        
    }); 
</script>