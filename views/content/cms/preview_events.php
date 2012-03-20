<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
  
        var event_id = $('#event_id').val();
        var event_title = $('#event_title').val();
        var event_body = $('#event').val();

        
        $.get("preview_event/event_data/"+ event_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.event_tpl(data);
            $('#eventinfo').html('');
            $('#eventinfo').append(template);
            return false;
            $('#eventcontain').html('');
            $('#eventcontain').append(event_body);
        });
 
       
});
</script>


<input type="hidden" id="event_id" value="<?php echo $id; ?>" />
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/html" id="event_tpl">
 
    {{#event_data}}

            {{#event}}
         
  <div id ="content">
          <div id="RC-body">
                 <h2>{{event_title}}</h2>
           
                <div class="RC-text-cont">
                        <div id="RC-img-cont">
                                 <img src="uploaded/provider/event/image/{{event_image}}" width="212" height="235" />
                </div>
                        </div><!-- end RC-img-cont -->
                        
                <div id="RC-boxR-cont"> </div>
       
                <div>{{event_body}}</div>
                
                 
                </div>
          </div>
                             

    </div>
{{/event}}
{{/event_data}}
</script>

    <div id="content">
        <ul class="ulsubnav">
      
        </ul>
        <div id="content-box">

               
                <div id="eventinfo">
               
                        <input type="hidden" id="hidden_avatar"/>
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
    	Mumcentre CMS.
        </div>
    </div>
</form>