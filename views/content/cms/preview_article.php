<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
  
        var article_id = $('#article_id').val();
        var article_title = $('#article_title').val();
        var article_body = $('#article').val();

        
        $.get("preview_article/article_data/"+ article_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.article_listing_tpl(data);
            $('#articleinfo').html('');
            $('#articleinfo').append(template);
            return false;
            $('#articlecontain').html('');
            $('#articlecontain').append(article_body);
        });
 
       
});
</script>


<input type="hidden" id="article_id" value="<?php echo $id; ?>" />
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/html" id="article_listing_tpl">
 
<!--    {{#article_data}}

            {{#article}}
         
     
    <div style="width: 680px; height: 280px; margin: 0 auto;">
          {{article_title}}
         {{article_author}}
        </div> end of Title
        
        <div  style="float:left;">
        <img src="uploaded/article/image/{{article_image}}"  style="border:none; padding-left: 15px;">
        </div> end of Picture
        
        <div id="articlecontain" style="float:left; padding-left: 20px; width: 414px;" align="justify">
        {{article_body}}
        </div>end of Content
</div>
{{/article}}
{{/article_data}}-->
</script>

    <div id="content">
        <ul class="ulsubnav">
      
        </ul>
        <div id="content-box">

               
                <div id="articleinfo">
               
                        <input type="hidden" id="hidden_avatar"/>
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
<!--                <div class="cssanchor"><a href="#" id="update_article" class="cssanchor">SUBMIT</a></div>
                <div class="cssanchor"><a href="<?php echo base_url(); ?>cms" class="cssanchor">BACK</a></div>-->
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
    	Mumcentre CMS.
        </div>
    </div>
</form>