<div id="content">
	<ul class="ulsubnav">
    	<li><a href="cms_user_account/add_user_account">Add New User Account</a></li>
    </ul>

  <form id="frmMain" name="frmMain">
                <div class="searchbar">
                    <ul>
                        <li><label for="search_key">Search by name:</label>
                        <input type="text" id="search_key" name="search_key" /></li>
                        <li><a href="#" id="search_member"><input type="image" src="assets/img/system/img_search.png" /></a></li>
                    </ul>
                </div>
                </form>
    <div class="tableholder">
<!--    <div class='pager'>
                      <span class='pageNumbers'></span>
                      Page <span class='currentPage'></span> of <span class='totalPages'></span>
                    </div>-->
    	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0">
        	<tr>
            	<td width="5%">ID</td>
                <td width="10%">Avatar</td>
                <td width="25%">User Account Name</td>
                <td width="20%">Email</td>
                <td width="10%">Permission</td>
                <td width="30%">Command</td>
        	</tr>
		</table>
        <div id="user_account_list"></div>
<!--        <div class='pager'>
                      <span class='pageNumbers'></span>
                      Page <span class='currentPage'></span> of <span class='totalPages'></span>
                    </div>-->
    </div>
</div>

<script type="text/html" id="user_account_list_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
            {{#user_account_list}}
            {{#user_account}}
        	<tr>

        	  <td width="5%">{{id}}</td>
        	  <td width="10%"><img src="uploaded/avatar/{{avatar_filepath}}" width="65" height="65" /></td>
        	  <td width="25%">{{username}}</td>
                  <td width="20%">{{email}}</td>
        	  <td width="10%">{{permission}}</td>
        	  <td width="15%"></br><a class="actionbtn" href="">Preview</a> | <a class="actionbtn" href="">Edit</a> </br> </br> <a class="actionbtn" href="">Deactivate </a>  |  <a class="actionbtn" href="">Upgrade </a></br></br></td>

      	  </tr>
          {{/user_account}}
          {{/user_account_list}}
        </table>
</script>

<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $.get("cms_user_account/user_account_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.user_account_list_tpl(data);
            $('#user_account_list').html('');
            $('#user_account_list').append(template);
            return false;
        });
    });
</script>