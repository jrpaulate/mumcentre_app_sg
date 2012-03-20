<!--<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
  
        var program_id = $('#program_id').val();
        var program_title = $('#program_title').val();
        var program_body = $('#program').val();

        
        $.get("preview_program/program_data/"+ program_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.program_tpl(data);
            $('#programinfo').html('');
            $('#programinfo').append(template);
            return false;
            $('#programcontain').html('');
            $('#programcontain').append(program_body);
        });
 
       
});
</script>


<input type="hidden" id="program_id" value="<?php echo $id; ?>" />
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/html" id="program_tpl">
 
    {{#program_data}}

            {{#program}}
         
  <div id ="content">
          <div id="RC-body">
                 <h2>{{program_title}}</h2>
           
                <div class="RC-text-cont">
                        <div id="RC-img-cont">
                                 <img src="uploaded/provider/program/image/{{program_image}}" width="212" height="235" />
                </div>
                        </div> end RC-img-cont 
                <div>{{program_body}}</div>
               
                </div>
          </div>
                             

    </div>
{{/program}}
{{/program_data}}
</script>

    <div id="content">
        <ul class="ulsubnav">
      
        </ul>
        <div id="content-box">

               
                <div id="programinfo">
               
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
</form>-->