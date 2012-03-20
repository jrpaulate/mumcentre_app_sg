<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        


        $('#add_advertiser').click(function(e) {
                    var first_name = $('#first_name').val();
                    first_name = first_name.replace("'", "`");
                    var last_name = $('#last_name').val();
                    last_name = last_name.replace("'", "`");
                    var password = $('#password').val();
                    password = password.replace("'", "`");
                    //alert(name);
                    var birth_date = $('#birth_date').val();
                    birth_date = birth_date.replace("'", "`");

                    var gender = $('#gender').val();
                    gender = gender.replace("'", "`");

                    var email = $('#email').val();
                    email = email.replace("'", "`");

                    var avatar = $('#hidden_avatar').val();
//                    alert(avatar);

                    var location = $('#location').val();
                    location = location.replace("'", "`");

                    if(first_name.length == 0) {
                        alert("First Name cannot be empty!");
                    } else if(last_name.length == 0) {
                        alert("Last Name cannot be empty!");
                    } else if(email.length == 0) {
                        alert("Email cannot be empty!");
                    } else if(location.length == 0) {
                        alert("Location cannot be empty!");
                    } else {
                        $.post("cms_member/create_member", {
                            first_name: first_name,
                            last_name: last_name,
                            password: password,
                            birth_date: birth_date,
                            gender: gender,
                            email: email,
                            location: location,
                            avatar: avatar
                        },
                        function(data){
                            var rurl = data.split(":");
                            var code = rurl[0];
                            var msg = rurl[1];
                            if (code < 0) {
                              alert(msg);
                            } else {
                                
                                
                                
                              alert(msg);
                              window.location = 'cms_member';
                            }
                        });
                    }
                    e.preventDefault();
                });


            $.get("cms_event/provider_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#provider-listing').html('');
            $('#provider-listing').append(template);
            return false;
            });
          
        
       
});
</script>

<script type="text/html" id="provider_listing_tpl">
    {{#provider_list}}
    <dd><select name="provider" id="provider" onchange="javascript:init_geo()">    
            {{#providers}}
            <option value="{{id}}">{{provider_name}}</option>
            {{/providers}}
        </select></dd>
    {{/provider_list}}
</script>

<form id="frmMain" name="frmMain">

    <div id="content">
        <ul class="ulsubnav">
            <li>Member CMS</li>
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Add New Member</h2>

                <div id="articleinfo">
                    <p><i><font color="red">*</font> = Required Field</i></p>
                    <dl>
                        

                        <dt><label for="provider">Provider List:</label></dt>
                        <div id="provider-listing"></div>


                        <dt><label for="first_name">First Name:</label></dt>
                        <dd><input type="text" id="first_name" name="first_name" /> <font color="red">*</font></dd>

                        <dt><label for="last_name">Last Name:</label></dt>
                        <dd><input type="text" id="last_name" name="last_name" /> <font color="red">*</font></dd>
              

                        <dt><label for="email">Email Address:</label></dt>
                        <dd><input type="text" name="email" id="email"/> <font color="red">*</font></dd>

                    </dl>
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="cms/cms_member" id="create_member" class="cssanchor">SUBMIT</a></div>
                <div class="cssanchor"><a href="<?php echo base_url(); ?>cms_member" class="cssanchor">BACK</a></div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
    	Mumcentre CMS.
        </div>
    </div>
</form>