<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
  
        var review_id = $('#review_id').val();
        var review_title = $('#review_title').val();
        var review_body = $('#review').val();

        
        $.get("preview_review/review_data/"+ review_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.review_tpl(data);
            $('#reviewinfo').html('');
            $('#reviewinfo').append(template);
            return false;
            $('#reviewcontain').html('');
            $('#reviewcontain').append(review_body);
        });
 
       
});
</script>


<input type="hidden" id="review_id" value="<?php echo $id; ?>" />
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/html" id="review_tpl">
 
    {{#review_data}}

            {{#review}}
         
  <div id ="content">
          <div id="RC-body">
                 <h2>{{review_title}}</h2>
           
                <div class="RC-text-cont">
                        <div id="RC-img-cont">
                                 <img src="uploaded/provider/review/image/{{review_image}}" width="212" height="235" />
                </div>
                        </div><!-- end RC-img-cont -->
                <div>{{review_body}}</div>
               
                </div>
          </div>
                             

    </div>
{{/review}}
{{/review_data}}
</script>

    <div id="content">
        <ul class="ulsubnav">
      
        </ul>
        <div id="content-box">

               
                <div id="reviewinfo">
               
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