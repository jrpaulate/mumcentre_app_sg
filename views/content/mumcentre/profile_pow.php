<div id="body2com"><!-- end Head-cont -->
    <div id="profile"></div>
    <input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id');?>"/>
</div><!-- end body2com -->

<div id="sidebar2">
    <div id="c3spacer"></div>
    <?= render_partial('global/observer/sidebar'); ?>
    <!-- end .container --></div>

<div id="pow_show_modal" style="display:none">
</div>

<div id="pow_delete_modal" style="display:none">
    <div style="width: 294px; height: 339px; background: #ddf3fe;">

    <div style="padding-left: 20px; padding-right: 20px; padding-top: 23px;">
<!--         <div class="edit-profile"><img src="images/my profile img/close-btn.png"></div>
        <br /> <br /> <br />-->
        <table width="249" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="97" valign="top"><span style="font-size:14px; color:#59366c;">Name:</span></td>
        <td width="152" valign="top"><span id="pic-title" style="font-size:16px; color: #39c;"></span></td>
      </tr>
      <tr><td colspan="2" height="12"></td></tr>
      <tr>
        <td width="97" valign="top"><span style="font-size:14px; color:#59366c;">Description:</span></td>
        <td width="152" valign="top"><span id="pic-caption" style="font-size:16px; color: #39c;"></span></td>
      </tr>
      <tr><td colspan="2" height="12"></td></tr>
      <tr>
        <td width="97" valign="top"></td>
        <td width="152" valign="top"><img id="pic_for_del" src="images/my profile img/child-pic-3.png" width="140"></td>
      </tr>
       <tr><td colspan="2" height="12"></td></tr>
      <tr>
        <td width="97" valign="top"></td>
        <td width="152" valign="top"><div id="delete" style="font-size: 21px; font-weight:bold; color: #39c" align="center">Delete</div></td>
      </tr>
      
    </table>


     </div>

    </div>
</div>

<div class="wrap">

<div style="Title">
<span class="title-1">My Profile</span> &nbsp; <img src="images/Header-Arrow.png"> &nbsp;&nbsp;<span class="sub-title">Pic of the Week Activity</span>
<div style="border-bottom: 2px solid #3399cc; width: 660px;"></div>
<table width="660" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="242" valign="top">
    <div class="profile-image"><img src="uploaded/user/avatar/<?php echo $this->session->userdata('avatar');?>"></div>
    <div style="padding-top: 30px; border-bottom: 1px solid #cecece; width: 242px;"></div>
    
    <?= render_partial('global/observer/profile_menu'); ?>
    
    </td>
    <td width="418" style="border-left: 1px solid #cecece;" valign="top">
    <div class="side-content">
    <div class="Profile-account-name"><?php echo $this->session->userdata('name')." ".$this->session->userdata('last_name');?></div>
    <div style="border-bottom: 1px dotted #59366c; width: 406px;"></div>
  
     <div class="recent-alerts">Current Entries</div>
    <div style="border-bottom: 1px dotted #59366c; width: 406px; padding-top: 12px;"></div>
    
    <div id="pow-current" class="pow-list">
    </div>
    <br/>
    <div style="color: #212121; font-size: 14px; padding-top: 80px;">Click Image to View</div>
    <br />
    <div class="recent-alerts">Past Entries</div>
    <div style="border-bottom: 1px dotted #59366c; width: 406px; padding-top: 12px;"></div>
    
    <div id="pow-past" class="pow-list">
<!--    <div class="pow-pic"><img src="images/art-1.jpg"></div>-->
    </div>
    <div style="color: #212121; font-size: 14px; padding-top: 127px;">Click Image to Delete</div>
    
    </div>
    </td>
  </tr>
</table>

</div>

</div>  



<input type="hidden" id="pow_del_id" />

<?= render_partial('global/default_footer'); ?>
<script type="text/html" id="pow_past_tpl">
{{#pow_list}}
    {{#pow}}
    <div class="pow-pic del-pic"><img src="pow-entries/{{token_id}}/{{photo_filename}}" width="80" title="{{name}}">
    <input type="hidden" id="caption_{{token_id}}" value="{{caption}}"/>
    <input type="hidden" id="pow_id" value="{{id}}" />
    </div>
    {{/pow}}
    {{^pow}}
    <div class="recent-alerts2"><span>You have no accepted entries from the previous contests.</span></div>
    {{/pow}}
{{/pow_list}}    
</script>
<script type="text/html" id="pow_current_tpl">
{{#pow_list}}
<!--    {{#pow}}
    <div class="pow-pic show-pic"><img src="pow-entries/{{token_id}}/{{photo_filename}}" width="80" title="{{name}}"></div>
    {{/pow}}-->
    {{#pow}}
    <div class="pow-pic del-pic"><img src="pow-entries/{{token_id}}/{{photo_filename}}" width="80" title="{{name}}">
    <input type="hidden" id="caption_{{token_id}}" value="{{caption}}"/>
    <input type="hidden" id="pow_id" value="{{id}}" />
    </div>
    {{/pow}}
    {{^pow}}
    <div class="recent-alerts2"><span>You have no accepted entries for the current contest. <a href="pow/join" style="text-decoration:underline; color: #39c;">Join Now!!</a></span></div>
    {{/pow}}
{{/pow_list}}    
</script>
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
     $(document).ready(function(){
        var user_id = $('#user_id').val();
        $('#pow_show_modal').dialog({
            autoOpen: false,
            width: 'auto'
        });
        $('#pow_delete_modal').dialog({
            autoOpen: false,
            width: 360,
            height: 400
        });
        $.get("user/pow_current/"+user_id, function(response) {
                var data = JSON.parse(response);
                var template = ich.pow_current_tpl(data);
                $('#pow-current').html('');
                $('#pow-current').append(template);
//                $('.show-pic').click(function(e){
//        //            alert($(this).attr('value'));
//        //            alert($("img",this).attr('src'));
//                    var img = "<img src='"+$("img",this).attr('src')+"'/>";
//                    $('#pow_show_modal').html('');
//                    $('#pow_show_modal').append(img);
//                    $('#pow_show_modal').dialog({title: $("img",this).attr('title')})
//                    $('#pow_show_modal').dialog('open');
//                    e.preventDefault();
//                })
                $('.del-pic').click(function(e){ 
                    var img = $("img",this).attr('src');
                    $('#pic_for_del').attr('src', img)
                    $('#pic-title').html('');
                    $('#pic-caption').html('');
                    $('#pow_del_id').val($("input:nth-child(3)",this).val());
                    $('#pic-title').append($("img",this).attr('title'));
                    $('#pic-caption').append($("input:nth-child(2)", this).val());
                    
                    $('#pow_delete_modal').dialog({title: $("img",this).attr('title')})
                    $('#pow_delete_modal').dialog('open');
                    e.preventDefault();
                })
                return false;
            });
            
        $.get("user/pow_past/"+user_id, function(response) {
                var data = JSON.parse(response);
                var template = ich.pow_past_tpl(data);
                $('#pow-past').html('');
                $('#pow-past').append(template);
                $('.del-pic').click(function(e){
        //            alert($(this).attr('value'));
        //            alert($("img",this).attr('src'));
//                    var img = "<img src='"+$("img",this).attr('src')+"'/>";
//                    alert($("input:nth-child(3)",this).val());    
                    var img = $("img",this).attr('src');
                    $('#pic_for_del').attr('src', img)
                    $('#pic-title').html('');
                    $('#pic-caption').html('');
                    $('#pow_del_id').val($("input:nth-child(3)",this).val());
                    $('#pic-title').append($("img",this).attr('title'));
                    $('#pic-caption').append($("input:nth-child(2)", this).val());
                    
                    $('#pow_delete_modal').dialog({title: $("img",this).attr('title')})
                    $('#pow_delete_modal').dialog('open');
                    e.preventDefault();
                })
                
                return false;
        });    
        $('#delete').click(function(e){
                    var del = confirm('Are you sure? You can\'t undo this process.');
                    if (del) {
                        var id = $('#pow_del_id').val();
                        $.post("user/delete_pow", {
                            id: id
                        },
                        function(data){
                            //                            alert(data);
                            var rurl = data.split(":");
                            var code = rurl[0];
                            var msg = rurl[1];
                            if (code < 0) {
                                alert(msg);
                            } else {
                                alert(msg)
                                window.location.reload();
                            }

                        });
                       
                    }
                    e.preventDefault();
                });
    });
</script>
