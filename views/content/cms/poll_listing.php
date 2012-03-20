

<div id="content">
	<ul class="ulsubnav">
    	<li><a href="cms/poll_addnew">Add New Poll</a></li>
    </ul>
  	<div>
    	<select id="ddlPollCountry" name="ddlPollCountry" onchange="switchcountry();">
            <?= $countrieshtml; ?>
        </select> 
        Site
    </div>
    <div class="tableholder">
    	<table class="datatable" width="100%" cellpadding="5" cellspacing="0" border="0">
        	<tr>
            	<td width="100">Poll ID</td>
            	<td>Poll Question</td>
            	<td width="70">Is Default</td>
                <td width="50">&nbsp;</td>
           	</tr>
            <?= $pollhtml; ?>
            <tr>
            	<td colspan="4" align="right"><input type="button" onclick="delete_poll();" id="btnDeletePoll" name="btnDeletePoll" value="Delete Checked Poll" /> <input type="button" onclick="set_poll_default();" id="btnSetPollDefault" name="btnSetPollDefault" value="Set Checked as Default" /></td>
            </tr>
		</table>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
    });
	
	function set_poll_default() {
		var pollid = $('input[name=pollradio]:radio:checked').val();
		var country_id = $('#ddlPollCountry').val();
		$.post("cms/set_poll_default", {
			poll_id: pollid,
			country_id : country_id
		},

		function(){
			location.href = 'cms/poll/' + country_id;
		});
	}
	
	function delete_poll() {
		var action = confirm("Are you sure you want to delete?");
		
		if (action) {
			var pollid = $('input[name=pollradio]:radio:checked').val();
			var country_id = $('#ddlPollCountry').val();
			$.post("cms/delete_poll", {
				poll_id: pollid
			},
	
			function(){
				location.href = 'cms/poll/' + country_id;
			});
		}
	}
	
	function switchcountry() {
		var val = $("#ddlPollCountry").val();
        location.href = 'cms/poll/' + val;
	}
</script>
