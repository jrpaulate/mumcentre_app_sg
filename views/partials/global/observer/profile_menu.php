<div class="menu">
    <table width="242" border="0">
        <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'" bgcolor="#f0ecef">
            <td valign="middle" height="25">


                <a href="user/profile" style="border:none; text-decoration:none;">
                    <span class="menu-font">Profile</span>
                </a>
            </td>
        </tr>
        <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">

            <td valign="middle" height="25">
                <a href="user/profile_alerts" style="border:none; text-decoration:none;">
                    <span class="menu-font">My Alerts and Subscriptions</span>
            </td>
        </tr>
        <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
            <td valign="middle" height="25">
                <a href="user/profile_pow" style="border:none; text-decoration:none;">       
                    <span class="menu-font">Pic of the Week Activity</span>
            </td>
        </tr>
        <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'" >
            <td valign="middle" height="25">
                <a href="user/profile_forums" style="border:none; text-decoration:none;">
                    <span class="menu-font">Forum Threads and Replies</span>
                </a>
            </td>
        </tr>
        <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
            <td valign="middle" height="25">
                <a href="Subscriptions.html" style="border:none; text-decoration:none;">
                    <span class="menu-font">Groups</span>
                </a>
            </td>
        </tr>
        <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
            <td valign="middle" height="25">
                <a href="user/profile_children" style="border:none; text-decoration:none;"> 
                    <span class="menu-font">My Children</span>
            </td>
        </tr>
        <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
            <td valign="middle" height="25">

                <a href="#" id="change" name="change" style="border:none; text-decoration:none;">    
                <span class="menu-font">Change Password</span>
                </a>
            </td>
        </tr>
    </table>
</div>
<div id="change_pass_modal" style="display: none">
    <table width="100%" cellpadding="5">
        <tr>
            <td width="100">New Password : </td>
            <td><input type="password" id="new_pass" name="new_pass" style="width:100%;border:1px solid #abadb3;line-height:18px;" /></td>
        </tr>
        <tr>
            <td>Confirm New Password : </td>
            <td><input type="password" id="confirm_new_pass" name="confirm_new_pass" style="width:100%;border:1px solid #abadb3;line-height:18px;" /></td>
        </tr>
        <tr>
            <td colspan="2"><a href="javascript:void(0);" id="submit_pass" class="btn-rnd fright view-link"><small>SUBMIT</small></a></td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#change_pass_modal').dialog({
            autoOpen: false,
            width: 400,
            title: 'Change Password'
        });
        var user_id = $('#user_id').val();
        $('#change').click(function(e){
            $('#change_pass_modal').dialog('open');
            e.preventDefault();  
        });
            
        $('#submit_pass').click(function(e){
            var new_pass = $('#new_pass').val();
            var confirm_new_pass = $('#confirm_new_pass').val();
            if (new_pass.length == 0){
                alert('Please enter new password');
            } 
            else if (confirm_new_pass != new_pass){
                alert('Passwords don\'t match!');
            }
            else {
                //                         alert('Password changed.');
                $.post('user/change_pass',
                {
                    new_pass: new_pass,
                    user_id: user_id
                },
                function(data){
                    alert(data);
                });
            }
            e.preventDefault(); 
        });
        
    });     
</script>