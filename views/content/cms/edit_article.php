<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        
        var article_id = $('#article_id').val();
        var article_title = $('#article_title').val();
        var article_body = $('#article').val();
        
        $.get("edit_article/article_data/"+ article_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.article_listing_tpl(data);
            $('#articleinfo').html('');
            $('#articleinfo').append(template);
            
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
            'folder'        : '/uploaded/article/image',

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
                $.post('<?php echo site_url('edit_article/uploadify'); ?>',{filearray: response},function(info){
                    $('#avatar').attr('src', 'uploaded/article/image/'+info);
                    $('#hidden_avatar').val(info);
//                                            alert(info);
                });
            }
        });
            
            
            
            
            $('#publish_date').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
               
              
                });


                $('#scheduled_date').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            
                });
            
            
            return false;
            $('#articlecontain').html('');
            $('#articlecontain').append(article_body);
        });
        
        
             
 
        
        
        $('#update_article').click(function(e) {
                    var article_title = $('#article_title').val();
                    article_title = article_title.replace("'", "`");
             
                    var article_author = $('#article_author').val();
                    article_author = article_author.replace("'", "`");
                    
                    var seo_url = $('#seo_url').val();
                    seo_url = seo_url.replace("'", "`");
                    
                    var seo_keyword = $('#seo_keyword').val();
                    seo_keyword = seo_keyword.replace("'", "`");
                    
                    var seo_summary = $('#seo_summary').val();
                    seo_summary = seo_summary.replace("'", "`");
                    
                    var avatar = $('#hidden_avatar').val();
                 
                    var article_body = tinyMCE.get('tadescription').getContent();
                    
                    var publish_date = $('#publish_date').val();
                    
                    var scheduled_date = $('#scheduled_date').val();
                    
                    var article_summary = $('#txtarea').val();
                    var id = $('#article_id').val();
                    var age_group = $('#age_group').val();
                    if(article_title.length == 0) {
                        alert("Title cannot be empty!");
                    } else if(article_author.length == 0) {
                        alert("Author cannot be empty!");
                    } else if(article_body.length == 0) {
                        alert("Article cannot be empty!");
                    } else if(article_summary.length == 0) {
                        alert("Summary cannot be empty!");
                    } else {
                        $.post("edit_article/update_article/" + id, {
                            article_title: article_title,
                            article_author: article_author,
                            avatar: avatar,
                            seo_url: seo_url,
                            seo_summary: seo_summary,
                            seo_keyword: seo_keyword,
                            article_summary: article_summary,
                            article_body: article_body,
                            age_group: age_group,
                            publish_date:publish_date,
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
                              window.location = 'cms/article';
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

});
</script>





<script type="text/html" id="article_listing_tpl">
    {{#article_data}}
    {{#article}}
<p><i><font color="red">*</font> = Required Field</i></p>
        <dl>
            
        <input type="hidden" id="age_group" value="{{{age_group_id}}}"/>
            
        <dt><label for="title">Article Title:</label></dt>
        <dd><input type="text" id="article_title" name="article_title" value="{{{article_title}}}" /><font color="red">*</font></dd>
        
        <dt><label for="title">Article Author:</label></dt>
        <dd><input type="text" id="article_author" name="article_author" value="{{{article_author}}}" /><font color="red">*</font></dd>
           
                        <dt>Article Image</dt>
                        <dd><img id="avatar" src="uploaded/article/image/{{{article_image}}}" value="uploaded/article/image/{{{article_image}}}" style="width: 255px; height: 255px;"/></dd>
                        <dt class=""></dt>
                        
                        <dd><div id="uploadContainer">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
                                <a href="javascript:$('#upload').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                            </div></dd>
                        <div id="fileQueue"></div>
                        <br />
                        <input type="hidden" id="hidden_avatar" value="{{{article_image}}}"/>


                        <dt><label for="summary">Article Summary:</label></dt>
                        <dd><textarea id="txtarea"  cols="20"  rows="3"  style="width: 498px; height: 80px;"> {{{article_summary}}}</textarea></dd>
               
                       
                        <dt>Article Body </dt>
                        <dd><textarea id="tadescription" name="tadescription"  style="width: 498px; height: 100px;" >{{{article_body}}}</textarea></dd>

                      
                        <dt><label for="seo_link">SEO URL Overide:</label></dt>
                        <dd><input type="text" id="seo_url" name="seo_url" value="{{{seo_url}}}" /><font color="red">*</font></dd>
        
                                               
                        <dt><label for="seo_link">SEO Short Description:</label></dt>
                        <dd><input type="text" id="seo_summary" name="seo_summary" value="{{{seo_summary}}}" /><font color="red">*</font></dd>
        
                        <dt><label for="title">Keyword:</label></dt>
                        <dd><input type="text" id="seo_keyword" name="seo_keyword" value="{{{seo_keyword}}}" /> <font color="red">*</font></dd>
                            
                        
                        <dt><label for="publish_date">Publish Date</label></dt>
                        <dd><input type="text" name="publish_date" id="publish_date" class="text-ep-textinput" value="{{{publish_date}}}"/></dd>

                        <dt><label for="publish_date">Scheduled Date</label></dt>
                        <dd><input type="text" name="scheduled_date" id="scheduled_date" class="text-ep-textinput" value="{{{send_date}}}"/></dd>

        </dl>
{{/article}}
{{/article_data}}
</script>


<form id="frmMain" name="frmMain">
<input type="hidden" id="article_id" value="<?php echo $id;?>" />


    <div id="content">
        <ul class="ulsubnav">
            <li>Article CMS</li>
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Edit Article</h2>
               
                <div id="articleinfo">
               
                        <input type="hidden" id="hidden_avatar"/>
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="#" id="update_article" class="cssanchor">SUBMIT</a></div>
                <div class="cssanchor"><a href="<?php echo base_url(); ?>cms_article" class="cssanchor">BACK</a></div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
    	Mumcentre CMS.
        </div>
    </div>
</form>
