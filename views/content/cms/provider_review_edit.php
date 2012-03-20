<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        
        var review_id = $('#review_id').val();
    
        $.get("edit_review/review_data/"+ review_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.review_listing_tpl(data);
            $('#reviewinfo').html('');
            $('#reviewinfo').append(template);
            
            
            tinyMCE.init({
                // General options
                width : "900",
                height:"700",
                mode : 'exact',
                elements: 'tadescription,description',
                theme : "advanced",
                plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

                // Theme options
                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink|,forecolor,backcolor",
                theme_advanced_buttons3 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft|,table,removeformat,code",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : false

                // Example word content CSS (should be your site CSS) this one removes paragraph margins
                //                content_css : "css/word.css"
            });
            
            
            $("#upload").uploadify({
	    'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : '/js/uploadify/uploadify.php',
            'cancelImg'     : '/js/uploadify/cancel.png',
            'folder'        : '/uploaded/provider/review/image',
            'buttonImg'     : 'assets/img/system/btn_browse.png',
            'wmode'         : 'transparent',
            'width'         : 83,
            'height'        : 25,
            'queueID'       : 'fileQueue',
            'scriptAccess'  : 'always',
            'fileDesc'      : 'Image Files',
            'fileExt'       : '*.jpg;*.jpeg;*.png;*.gif',
            'onError' : function (a, b, c, d) {
                if (d.status == 404)
                    alert('Could not find upload script.');
                else if (d.type === "HTTP")
                    alert('error '+d.type+": "+d.status);
                else if (d.type ==="File Size")
                    alert(c.name+' '+d.type+' Limit: '+Math.round(d.sizeLimit/1024)+'KB');
                else
                    alert('error '+d.type+": "+d.text);
            },
            'onComplete'   : function (event, queueID, fileObj, response, data) {
                $.post('<?php echo site_url('edit_review/uploadify'); ?>',{filearray: response},function(info){
                    $('#avatar').attr('src', 'uploaded/provider/review/image/'+info);
                    $('#hidden_avatar').val(info);
                                           
                });
            }
        });
            
            
            $('#publish_date').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'

                });

            $('#sending_date').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            
                });
                
                
            $('#expiry_date').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            
                });
            
            
            return false;
        $('#reviewcontain').html('');
        $('#reviewcontain').append(review_body);
        });
 
        
         
        
        $('#update_review').click(function(e) {
                    var review_title = $('#review_title').val();
                    review_title = review_title.replace("'", "`");
                    //alert(name);

                    var avatar = $('#hidden_avatar').val();
                   
                    
                    var review_body = tinyMCE.get('tadescription').getContent();
                    
                    var seo_url = $('#seo_url').val();
                    seo_url = seo_url.replace("'", "`");
                    
                    var seo_keywords = $('#seo_keywords').val();
                    seo_keywords = seo_keywords.replace("'", "`");
                    
                    var seo_summary = $('#seo_summary').val();
                    seo_summary = seo_summary.replace("'", "`");
                    
                    var provider = $('#provider').val();
                    
                    var publish_date = $('#publish_date').val();
                    
                     var expiry_date = $('#expiry_date').val();
                    
                    var scheduled_date = $('#scheduled_date').val();
                    
                    var age_group = $('#age_group').val();
                    
                    var review_summary = $('#txtarea').val();
                    var id = $('#review_id').val();

                    if(review_title.length == 0) {
                       alert("Title cannot be empty!");
                    } else if(review_body.length == 0) {
                        alert("Article cannot be empty!");
                    } else if(review_summary.length == 0) {
                        alert("Summary cannot be empty!");
                    } else {
                        $.post("edit_review/update_review/" + id, {
                            review_title: review_title,                
                            avatar: avatar,
                            review_summary: review_summary,
                            review_body: review_body,
                            seo_url: seo_url,
                            seo_summary: seo_summary,
                            seo_keywords: seo_keywords,
                            provider: provider,
                            age_group: age_group,
                            publish_date:publish_date,
                            expiry_date:expiry_date,
                            scheduled_date:scheduled_date
                        },
                        function(data){
                            var rurl = data.split(":");
                            var code = rurl[0];
                            var msg = rurl[1];
                            if (code < 0) {
                              alert(msg);
                            } else {
                              alert(msg);
                              window.location = 'cms_provider_content/content';
                            }
                        });
                    }
                    e.preventDefault();
                });
          $('#txtarea').keydown(function() {
          var max_limit = 231;
          var chars_left;
          var txt = $('#txtarea').val();
//          alert(txt);
          if (txt.length > max_limit){
              txt = txt.substr(0, max_limit);
              $('#txtarea').val(txt);
          }
          chars_left = max_limit - txt.length;

          $('#chars_left').html('');
          $('#chars_left').append(chars_left);
//          e.preventDefault();
          });
          
           $.get("edit_review/provider_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#provider-listing').html('');
            $('#provider-listing').append(template);
            return false;
        });
          
           $.get("edit_review/age_group_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.age_group_listing_tpl(data);
            $('#age-group-listing').html('');
            $('#age-group-listing').append(template);
            return false;
        });


});
</script>

<script type="text/html" id="provider_listing_tpl">
    {{#provider_list}}
    <dd><select name="provider" id="provider">
            {{#providers}}
            <option value="{{id}}">{{provider_name}}</option>
            {{/providers}}
        </select></dd>  
    {{/provider_list}}
</script>

<script type="text/html" id="age_group_listing_tpl">
    {{#age_group_list}}
    <dd><select name="age_group" id="age_group">
            {{#age_groups}}
            <option value="{{id}}">{{age_group_name}}</option>
            {{/age_groups}}
        </select></dd>
    {{/age_group_list}}
</script>


<script type="text/html" id="review_listing_tpl">
    {{#review_data}}
    {{#review}}
<p><i><font color="red">*</font> = Required Field</i></p>
        
        <dt><label for="provider">Provider:</label></dt>
                        <dd><input type="text" id="provider_name" name="provider" value="{{{provider_name}}}" /><font color="red">*</font></dd>
        
                        
                        </br></br>
                    
                        
                        <input type="hidden" id="provider" value="{{{provider_id}}}"/>
                        <input type="hidden" id="age_group" value="{{{age_group_id}}}"/>
                         
                        
        </br></br>



        <dt><label for="title">Review Title:</label></dt>
        <dd><input type="text" id="review_title" name="review_title" value="{{review_title}}" /><font color="red">*</font></dd>
        
        </br></br>
        
        <dt>Review Image</dt>
        <dd><img id="avatar" alt="" src="uploaded/provider/review/image/{{review_image}}" value="uploaded/provider/review/image/{{{review_image}}}" style="width: 255px; height: 255px;"/></dd>
        <dt class="empty"></dt>
        <dd><div id="uploadContainer">
        <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
        <a href="javascript:$('#upload').uploadifyUpload();">
        <?= img('system/btn_upload.png'); ?>
        </a>
        </div></dd>
        <div id="fileQueue"></div>
        <br />
        
        <input type="hidden" id="hidden_avatar" value="{{review_image}}"/>
                       
                        
                    </br></br>    

                        <dt><label for="summary">Review Summary:</label></dt>
                        <dd><textarea id="txtarea"  cols="20"  rows="3"  style="width: 498px; height: 80px;"> {{review_summary}}</textarea></dd>
               
                    </br></br>    
                        
                       
                        <dt>Review Body </dt>
                        <dd><textarea id="tadescription" name="tadescription"  style="width: 498px; height: 100px;" >{{review_body}}</textarea></dd>

                    </br></br>     
                        
                        <dt><label for="seo_link">SEO URL Overide:</label></dt>
                        <dd><input type="text" id="seo_url" name="seo_link" value="{{seo_link}}" /><font color="red">*</font></dd>
        
                    </br></br>     
                                               
                        <dt><label for="seo_link">SEO Short Description:</label></dt>
                        <dd><input type="text" id="seo_summary" name="se_summary" value="{{se_summary}}" /><font color="red">*</font></dd>
        
                    </br></br>
                    
                        <dt><label for="title">Keyword:</label></dt>
                        <dd><input type="text" id="seo_keywords" name="se_keywords" value="{{se_keywords}}" /> <font color="red">*</font></dd>
                   
                    
                    <dt><label for="publish_date">Publish Date</label></dt>
                    <dd><input type="text" name="publish_date" id="publish_date" class="text-ep-textinput" value="{{{publish_date}}"/></dd>

                    <dt><label for="sending_date">Sending Date</label></dt>
                    <dd><input type="text" name="sending_date" id="sending_date" class="text-ep-textinput" value="{{{sending_date}}"/></dd>
                    
                    <dt><label for="sending_date">Expiry Date</label></dt>
                    <dd><input type="text" name="expiry_date" id="expiry_date" class="text-ep-textinput" value="{{{expiry_date}}"/></dd>
                     
                        
                        
{{/review}}
{{/review_data}}
</script>


<form id="frmMain" name="frmMain">
<input type="hidden" id="review_id" value="<?php echo $id;?>" />


    <div id="content">
        <ul class="ulsubnav">
            <li>Review CMS</li>
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Edit Review</h2>
               
                <div id="reviewinfo">
               
                        <input type="hidden" id="hidden_avatar"/>
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="#" id="update_review" class="cssanchor">SUBMIT</a></div>
                <div class="cssanchor"><a href="<?php echo base_url(); ?>cms_provider_content/content" class="cssanchor">BACK</a></div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
    	Mumcentre CMS.
        </div>
    </div>
</form>
