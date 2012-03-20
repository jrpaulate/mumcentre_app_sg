<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
  
        var curriculum_id = $('#curriculum_id').val();
        var title = $('#title').val();
        var body = $('#curriculum').val();

        
        $.get("preview_curriculum/curriculum_data/"+ curriculum_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.curriculum_tpl(data);
            $('#curriculuminfo').html('');
            $('#curriculuminfo').append(template);
            return false;
            $('#curriculumcontain').html('');
            $('#curriculumcontain').append(curriculum_body);
        });
 
       
});
</script>


<input type="hidden" id="curriculum_id" value="<?php echo $id; ?>" />
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/html" id="curriculum_tpl">
 
    {{#curriculum_data}}

            {{#curriculum}}
         
  <div id ="content">
          <div id="RC-body">
                 <h2>{{title}}</h2>
           
                <div class="RC-text-cont">
                        <div id="RC-img-cont">
                                 <img src="uploaded/provider/curriculum/image/{{image_filepath}}" width="212" height="235" />
                </div>
                        </div><!-- end RC-img-cont -->
                <div>{{body}}</div>
               
                </div>
          </div>
                             

    </div>
{{/curriculum}}
{{/curriculum_data}}
</script>

    <div id="content">
        <ul class="ulsubnav">
      
        </ul>
        <div id="content-box">

               
                <div id="curriculuminfo">
               
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