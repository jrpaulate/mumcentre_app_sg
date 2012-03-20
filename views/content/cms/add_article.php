<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
         $('#title').bind('input',function(){
             var link = $('#title').val();
             link = link.replace(/\s/g , "-");
            $('#seo_link').val(link); 
         });
        
        
         $("#upload").uploadify({
            'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : '../js/uploadify/uploadify.php',
            'cancelImg'     : 'js/uploadify/cancel.png',
            'folder'        : '../uploaded/article/image',
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
                $.post('<?php echo site_url('cms/uploadify'); ?>',{filearray: response},function(info){
                    $('#avatar').attr('src', 'uploaded/article/image/'+info);
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
        
		$.get("cms/age_group_list", function(response) {
			var data = JSON.parse(response);
			var template = ich.age_group_listing_tpl(data);
			$('#age-group-listing').html('');
			$('#age-group-listing').append(template);
			return false;
		});
        
		$.get("cms/country_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.country_listing_tpl(data);
            $('#country-listing').html('');
            $('#country-listing').append(template);
            return false;
        });
        
        
            $.get("cms_event/provider_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#provider-listing').html('');
            $('#provider-listing').append(template);
            return false;
        });
        

        $('#create_article').click(function(e) {                    
                var title = $('#title').val();
                title = title.replace("'", "`");
         
                var author = $('#author').val();
                author = author.replace("'", "`");
                
                var seo_link = $('#seo_link').val();
                seo_link = seo_link.replace("'", "`");
                
                var se_keywords = $('#se_keywords').val();
                se_keywords = se_keywords.replace("'", "`");
                
                var se_summary = $('#se_summary').val();
                se_summary = se_summary.replace("'", "`");
                
                var provider = $('#provider').val();
                var avatar = $('#hidden_avatar').val();
                var article = tinyMCE.get('tadescription').getContent();
                var summary = $('#txtarea').val();                    
                             
                var publish_date = $('#publish_date').val();
                publish_date = publish_date.replace("'", "`");
                
                var sending_date = $('#sending_date').val();
                sending_date = sending_date.replace("'", "`");
                
                var type = $('#type').val();                    
                var blog_url = $('#blog_url').val();
                
                var template = $('#template').val();           
                
				
               var age_group="";
                var selage=$("input[name='chkage[]']:checked");
				for(var i=0; i < selage.length; i++){
					if(selage[i].checked){
						if(age_group != "")
						age_group+="|";
						age_group+=selage[i].value;
					}
				}
                                
                                
                                
                                var countries="";
				var selcountries=$("input[name='chkcountry[]']:checked");
				for(var i=0; i < selcountries.length; i++){
					if(selcountries[i].checked){
						if(countries != "")
						countries+="|";
						countries+=selcountries[i].value;
					}
				}
              
                if(selcountries.length == 0) {
                    alert("Please select a country!");  
                } else if(title.length == 0) {
                    alert("Article Title cannot be empty!");
                } else if(author.length == 0) {
                    alert("Author cannot be empty!");
                } else if(article.length == 0) {
                    alert("Article cannot be empty!");
                } else if(summary.length == 0) {
                    alert("Summary cannot be empty!");
                } else  {
                    $.post("cms/create", {
                        type: type,
                        blog_url: blog_url,
                        title: title,
                        author: author,
                        avatar: avatar,
                        summary: summary,
                        seo_link: seo_link,
                        se_summary: se_summary,
                        se_keywords: se_keywords,
                        article: article,
                        age_group: age_group,
                        sending_date: sending_date,
                        publish_date: publish_date,
			countries: countries,
                        template:template,
                        provider:provider
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
	});

</script>
<script type="text/html" id="age_group_listing_tpl">
    {{#age_group_list}}
    {{#age_groups}}
    <dd><input type="checkbox" id="chkage" name="chkage[]" id="chkage" value="{{age_group_id}}">		
			{{age_group_name}}
    </dd>
    {{/age_groups}}
    {{/age_group_list}}
</script>

<script type="text/html" id="country_listing_tpl">
	{{#country_list}}
		{{#countries}}
		<dd><input type="checkbox" id="chkcountry" name="chkcountry[]" id="chkcountry" value="{{country_id}}">		
			{{country_name}}
			</dd>
		{{/countries}}
	{{/country_list}}
</script>


<script type="text/html" id="provider_listing_tpl">
    {{#provider_list}}
    <dd><select name="provider" id="provider" >    
            
             <option value="0"> No Provider </option>
            
            {{#providers}}
            <option value="{{id}}">{{provider_name}}</option>
            {{/providers}}
        </select></dd>
    {{/provider_list}}
</script>

<form id="frmMain" name="frmMain">
    
    <div id="content">
        <ul class="ulsubnav">
          
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Add New Article</h2>

                <div id="articleinfo">          
                        
                      <dt><label for="country">Select Country:</label></dt>
                      	<div id="country-listing"></div>
 
                       </br>
                       </br>
                      
                      
                       <dt><label for="age_group">Age Group:</label></dt>
                       <div id="age-group-listing"></div>
                        
                       </br>
                       </br>
                       
                       
                       <dt><label for="type">Select Template:</label></dt>
                            <dd><div id="basic-box-type">
                                    <select name="select" class="template" id="template">
                                        <option value="1">Article Landing Template</option>
                                        <option value="2">Blank Page Template</option>
                                    </select>
                            </div></dd>  
                       </br>
                       </br>
                      <p><i><font color="red">*Article Details</font> </i></p>
                      </br>  
                       </br>
                       </br>
                       <dt><label for="type">Article Type:</label></dt>
                            <dd><div id="basic-box-type">
                                    <select name="select" class="type" id="type">
                                        <option value="1">Mum Article</option>
                                        <option value="2">Blogger Article</option>
                                        <option value="3">Advertorials</option>
                                    </select>
                            </div></dd>
                        
                         </br>  
                       </br>
                       </br>     
                       <dt><label for="provider">Select Provider for Advertorials:</label></dt>
                        <div id="provider-listing"></div>    
                          
                          </br>
                       </br>   
                        <dt><label for="title">Article Title:</label></dt>
                        <dd><input type="text" id="title" name="title" /> <font color="red">*</font></dd>
                    </br>
                    </br>
                        <dt><label for="author">Author:</label></dt>
                        <dd><input type="text" name="author" id="author"/> <font color="red">*</font></dd>
                     </br>
                     </br>    
                        <dt>Article Image</dt>
                        <dd><img id="avatar" alt="" src="assets/img/system/ArticleImageMIA.jpg" style="width: 212px; height: 235px;"/></dd>
                        <dt class="empty"></dt>
                        <dd><div id="uploadContainer">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
                                <a href="javascript:$('#upload').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                            </div></dd>
                        <div id="fileQueue"></div>
                        <br />
                        <input type="hidden" id="hidden_avatar"/>
                        
                        
                        </br>
                       </br>
                        <dt><label for="summary">Summary:</label></dt>
                        <dd><textarea id="txtarea" cols="20"  rows="3"  style="width: 800px; height: 400px;"></textarea></dd>
                        <dt class="empty"></dt><dd><span id="chars_left">231</span> characters left.</dd><br/>
                         </br>
                       </br>
                        <dt>Article Body </dt>
                        <dd><textarea id="tadescription" name="tadescription"></textarea></dd>
                         </br>
                       </br>
                        <dt><label for="keyword">Keyword:</label></dt>
                        <dd><input type="text" id="se_keywords" name="se_keywords" /> <font color="red">*</font></dd>
                        
                         </br>
                       </br>
                        <dt><label for="blog_url">Blogger Url:</label></dt>
                        <dd><input type="text" id="blog_url" name="blog_url" /> <font color="red"></font></dd>
                        
                         </br>
                       </br>
                        <dt><label for="seo_link">SEO URL Overide:</label></dt>
                        <dd><input type="text" id="seo_link" name="seo_link" /> <font color="red">*</font></dd>

                         </br>
                       </br>
                        <dt><label for="se_summary">SEO Short Description:</label></dt>
                        <dd><input type="text" id="se_summary" name="se_summary" /> <font color="red">*</font></dd>

                      
                         </br>
                       </br>  
                       <dt><label for="publish_date">Publish Date</label></dt>
                       <dd><input type="text" name="publish_date" id="publish_date" class="text-ep-textinput" value="<?php echo set_value('publish_date'); ?>"/></dd>

                        </br>
                       </br>
                       
                       <dt><label for="sending_date">Sending Date</label></dt>
                       <dd><input type="text" name="sending_date" id="sending_date" class="text-ep-textinput" value="<?php echo set_value('sending_date'); ?>"/></dd>

                        
                    </dl>
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="#" id="create_article" class="cssanchor">SUBMIT</a></div>
                <div class="cssanchor"><a href="<?php echo base_url(); ?>cms/article" class="cssanchor">BACK</a></div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
    	Mumcentre CMS.
        </div>

    </div>
</form>
