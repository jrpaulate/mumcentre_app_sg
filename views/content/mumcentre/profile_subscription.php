<div id="body2com"><!-- end Head-cont -->
    <div id="profile"></div>
    <input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id');?>"/>
</div><!-- end body2com -->
<div id="sidebar2">
    <div id="c3spacer"></div>
    <?= render_partial('global/observer/sidebar'); ?>
    <!-- end .container --></div>
<?= render_partial('global/default_footer'); ?>

<script type="text/html" id="profile_listing_tpl">
{{#profile_data}}
{{#profile}}
    <div style="border-bottom: 2px solid #2490ce; width: 663px;">
        <span style="font-family:Comfortaa; font-size: 48px; color: #2490ce;">My Profile</span>
    </div> <!--border-->
    <div style="float:left; width:200px;">
        <table width="200" border="0">
            <tr>
                <td valign="top" style="border-bottom: 1px solid #bfbfbf;"><img src="uploaded/user/avatar/{{avatar_filepath}}"></td>
            </tr>
            <tr>
                <td>
                    <table width="200" border="0">
                       <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
                            <td valign="middle" height="25">
                                <a href="user/profile_alerts" style="border:none; text-decoration:none;">
                                    <span style="font-family:Comfortaa; font-size:14px; color:#2490ce; font-weight:bold;">My Alerts</span>
                                </a>
                            </td>
                        </tr>
                        <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
                            <td valign="middle" height="25">
                                <a href="">
                                <span style="font-family:Comfortaa; font-size:14px; color:#2490ce; font-weight:bold;">My Favorites</span>
                            </td>
                        </tr>
                        <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
                            <td valign="middle" height="25">
                                <a href="">
                                <span style="font-family:Comfortaa; font-size:14px; color:#2490ce; font-weight:bold;">Pic of the Week Activity</span>
                            </td>
                        </tr>
                        <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
                            <td valign="middle" height="25">
                                <a href="mumcentre/forum" style="border:none; text-decoration:none;">
                                    <span style="font-family:Comfortaa; font-size:14px; color:#2490ce; font-weight:bold;">Forum Threads and Replies</span>
                                </a>
                            </td>
                        </tr>
                        <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
                            <td valign="middle" height="25">
                                <a href="user/profile_subscription" style="border:none; text-decoration:none;">
                                <span style="font-family:Comfortaa; font-size:14px; color:#2490ce; font-weight:bold;">My Subscriptions</span>
                            </td>
                        </tr>
                        <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
                            <td valign="middle" height="25">
                                <span style="font-family:Comfortaa; font-size:14px; color:#2490ce; font-weight:bold;">Groups</span>
                            </td>
                        </tr>
                        <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'" bgcolor="#f0ecef">
                            <td valign="middle" height="25">
                                <a href="user/profile" style="border:none; text-decoration:none;">
                                    <span style="font-family:Comfortaa; font-size:14px; color:#2490ce; font-weight:bold;">My Profile</span>
                                </a>
                            </td>
                        </tr>
                        <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'" >
                            <td valign="middle" height="25">
                                <a href="user/profile_children" style="border:none; text-decoration:none;">
                                    <span style="font-family:Comfortaa; font-size:14px; color:#2490ce; font-weight:bold;">My Children</span>
                                </a>
                            </td>
                        </tr>
                    </table></td>
            </tr>
        </table>

    </div> 
    <div style="float:left; width:438px; border-left: 1px solid #bfbfbf;">
        <span style="font-family:Comfortaa; font-size: 28px; font-weight:bold; color:#642e6a; margin-left: 16px;">{{first_name}} {{last_name}}</span>
        <br /><br />
         <div style="border-top: 2px dotted #c3c3c3; border-bottom: 2px dotted #c3c3c3; margin-left:16px;">
      <div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color: #2490CE; font-weight:bold;">
        <ul style=" line-height: 28px;">
      <li><table width="314" border="0"><tr>
      <td width="211">&nbsp;</td>
      <td width="93" align="right"><span style="color: #2490CE;">YES</span></td>
      </tr></table>
      </li>
      <li><table width="314" border="0"><tr>
      <td width="211">Articles</td>
      <td width="93" align="right"><form>
        <input type="checkbox" name="12" />
      </form></td>
      </tr></table>
      </li>
      <li>
      <table width="314" border="0"><tr>
      <td>Reviews</td>
      <td align="right"><form><input type="checkbox" name="1"></form></td>
      </tr></table>
      </li>
      <li>
      <table width="314" border="0"><tr>
      <td width="211">Forums</td>
      <td width="93" align="right"><form><input type="checkbox" name="1"></form></td>
      </tr></table>
      </li>
      <li>
      <table width="314" border="0"><tr>
      <td width="211">Forums</td>
      <td width="93" align="right"><form><input type="checkbox" name="1"></form></td>
      </tr></table>
      </li>
      <li>
      <table width="314" border="0"><tr>
      <td width="212">Curriculum</td>
      <td width="92" align="right"><form><input type="checkbox" name="1"></form></td>
      </tr></table>
      </li>
      <li>
      <table width="314" border="0"><tr>
      <td width="215">Events</td>
      <td width="89" align="right"><form><input type="checkbox" name="1"></form></td>
      </tr></table>
      </li>
      <li>
      <table width="314" border="0"><tr>
      <td width="214">Product and Service Providers</td>
      <td width="90" align="right"><form><input type="checkbox" name="1"></form></td>
      </tr></table>
      </li>
        <li><table width="423" border="0"><tr>
      <td width="67" align="left"><form><input type="button" value="Check all"></form></td>
      <td width="10" align="left">&nbsp;</td>
      <td width="116" align="left"><form><input type="button" value="Uncheck all"></form></td>
      <td width="212" align="left">&nbsp;</td>
      </tr></table></li>
      </ul>
{{/profile}} 
{{/profile_data}} 
      </div></div> 
</script>
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var user_id = $('#user_id').val();
        $.get("user/profile_data/"+user_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.profile_listing_tpl(data);
            $('#profile').html('');
            $('#profile').append(template);
            return false;
        });
    });
</script>

