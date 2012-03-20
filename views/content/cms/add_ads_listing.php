<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        

           

        $('#create_ads_listing').click(function(e) {
            
                    var name = $('#name').val();
                    name = name.replace("'", "`");
                    
                    var section = $('#section').val();
                    section = section.replace("'", "`");
                    
                    var width = $('#width').val();
                    //alert(name);
                    
                    var price = $('#price').val();
                   

                    var duration = $('#duration').val();
                  


                    var ads_type = $('#ads_type').val();

                    if(name.length == 0) {
                        alert("Ads Name cannot be empty!");
                    } else if(section.length == 0) {
                        alert("Section cannot be empty!");
                    } else if(size.length == 0) {
                        alert("Size cannot be empty!");
                    } else if(price.length == 0) {
                        alert("Price cannot be empty!");
                    } else {
                        $.post("cms_ads_listing/create_ads_listing", {
                            name: name,
                            section: section,
                            width: width,
                            price: price,
                            duration: duration,
                            ads_type: ads_type
                        },
                        function(data){
                            var rurl = data.split(":");
                            var code = rurl[0];
                            var msg = rurl[1];
                            if (code < 0) {
                              alert(msg);
                            } else {
                              alert(msg);
                              window.location = 'cms_ads_listing';
                            }
                        });
                    }
                    e.preventDefault();
                });
                
                


      $.get("cms_ads_listing/type_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.type_listing_tpl(data);
            $('#type-listing').html('');
            $('#type-listing').append(template);
            return false;
        });
          
        
       
});
</script>

<script type="text/html" id="type_listing_tpl">
    {{#type_list}}
    <dd><select name="ads_type" id="ads_type">
            {{#type}}
            <option value="{{id}}">{{type_name}}</option>
            {{/type}}
        </select></dd>
    {{/type_list}}
</script>



<form id="frmMain" name="frmMain">

    <div id="content">
        <ul class="ulsubnav">
            <li>Ads Listing CMS</li>
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Add New Ads Listing</h2>

                <div id="ads_listing_info">
           
                    <dl>

                       <p><i><font color="red">*Ads Details</font> </i></p>
                         
                        <dt><label for="ads_type">Ad Type:</label></dt>
                        <div id="type-listing"></div>

                        <dt><label for="name">Ad Name:</label></dt>
                        <dd><input type="text" id="name" name="name" /> <font color="red">*</font></dd>

                        <dt><label for="section">Ad Section:</label></dt>
                        <dd><input type="text" id="section" name="section" /> <font color="red">*</font></dd>

                        <dt><label for="size">Size:</label></dt>
                        <dd><input type="text" name="size" id="width"/> <font color="red">*</font></dd>

                        <dt><label for="price">Price:</label></dt>
                        <dd><input type="text" name="price" id="price"/> <font color="red">*</font></dd>
                  

                        <dt><label for="duration">Duration:</label></dt>
                        <dd><input type="text" name="duration" id="duration"/> <font color="red">*</font></dd>
  
                    </dl>
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="#" id="create_ads_listing" class="cssanchor">SUBMIT</a></div>
                <div class="cssanchor"><a href="<?php echo base_url(); ?>cms_ads_listing" class="cssanchor">BACK</a></div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
    	Mumcentre CMS.
        </div>
    </div>
</form>