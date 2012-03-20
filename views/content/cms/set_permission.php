<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
  
        var user_id = $('#user_id').val();
        var first_name = $('#first_name').val();
        var last_name = $('#article_body').val();

        
        $.get("set_permission/user_data/"+ user_id, function(response) {
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


<input type="hidden" id="user_id" value="<?php echo $id; ?>" />
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/html" id="article_listing_tpl">
 
    {{#user_data}}

            {{#user}}
         
  <div id ="content">
          <div id="RC-body">
                 <h2>{{last_name}}</h2>
                  <h2>{{first_name}}</h2>
                <div class="RC-text-cont">
                        <div id="RC-img-cont">
                                 <img src="uploaded/article/image/{{article_image}}" width="212" height="235" />
                </div>
                        </div><!-- end RC-img-cont -->
                <div>{{article_body}}</div>
                
               
               
                 
              
          </div>
                             

    </div>
{{/user}}
{{/user_data}}
</script>

    <div id="content">
        <ul class="ulsubnav">
      
        </ul>
        <div id="content-box">

               
                <div id="articleinfo">
               
                        <input type="hidden" id="hidden_avatar"/>
                        
                 <table border="0">
                 <tr>
                 <td><form><input type="checkbox" name="1" id="mon_checkbox"></form></td>
                 <td>Monday</td>
                 <td><form><input type="checkbox" name="1" id="tue_checkbox"></form></td>
                 <td>Tuesday</td>
                 <td><form><input type="checkbox" name="1" id="wed_checkbox"></form></td>
                 <td>Wednesday</td>
                 <td><form><input type="checkbox" name="1" id="thur_checkbox"></form></td>
 
                </tr>
                 </table>
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