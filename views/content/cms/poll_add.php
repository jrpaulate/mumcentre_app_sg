

<div id="content">
    <div class="tableholder">
    	<form id="frmPollAdd" name="frmPollAdd" method="post" action="cms/poll_save" style="margin:0px;padding:0px">
    	<table class="datatable" width="600" cellpadding="5" cellspacing="0" border="0">
        	<tr>
            	<td width="250">Poll Question</td>
            	<td><input type="text" id="txtQuestion" name="txtQuestion" value="" style="width:98%" /></td>
           	</tr>
            <tr valign="top">
            	<td><a href="javascript:void(0);" onclick="addPollOptionList();" style="line-height:24px;">Add more Options</a><br />
                <a href="javascript:void(0);" onclick="removePollOptionList();" style="line-height:24px;">Remove last Option</a>
                </td>
                <td style="background-color:#CCCCCC">
                    <ul id="polloptionlist" style="padding:0px;margin:0px;list-style:none;">
                    	<li><label for="txtOption1">Option 1</label> <input type="text" id="txtOption1" name="txtOption[]" value="" style="width:98%" /></li>
                        <li><label for="txtOption2">Option 2</label> <input type="text" id="txtOption2" name="txtOption[]" value="" style="width:98%" /></li>
                    </ul>
                </td>
            </tr>
        	<tr valign="top">
        	  <td>Countries</td>
        	  <td><?= $countryhtml; ?></td>
      	  </tr>
        	<tr>
        	  <td>&nbsp;</td>
        	  <td align="right"><input type="submit" id="btnSavePoll" name="btnSavePoll" value="Save" /></td>
      	  </tr>
		</table>
        </form>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
    });
	
	function addPollOptionList() {
		var count = ($("#polloptionlist li").length) + 1;
		
		li = $("<li>");
		li.append('<label for="txtOption'+count+'">Option '+count+'</label> <input type="text" id="txtOption'+count+'" name="txtOption'+count+'[]" value="" style="width:98%" />');
		
		$("#polloptionlist").append(li);
	}
	
	function removePollOptionList() {
		var count = ($("#polloptionlist li").length);
		
		if (count > 2) {
		$('#polloptionlist li:last-child').remove();
		} else {
			alert("Must have at least 2 options");
		}
	}
	
	function submitPost() {
	}
</script>