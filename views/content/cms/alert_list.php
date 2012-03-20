<div id="content">
	<ul class="ulsubnav">
    	<li><a href="cms/add_article">Add New Article</a></li>
    </ul>
  
  <form id="frmMain" name="frmMain">
                <div class="searchbar">
                    <ul>
                        <li><label for="search_key">Search by title:</label>
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
            	<td width="3%">ID</td>
                <td width="5%">Image</td>
                <td width="22%">Title</td>
                <td width="13%">Author</td>
                <td width="7%">Age Group</td>
                <td width="14%">SEO URL</td>
                <td width="12%">SEO Keywords</td>
                <td width="5%">Status</td>
                <td width="10%">Command</td>
        	</tr>
		</table>
        <div id="article-listing"></div>
<!--        <div class='pager'>
                      <span class='pageNumbers'></span>
                      Page <span class='currentPage'></span> of <span class='totalPages'></span>
                    </div>-->
    </div>
</div>

<script type="text/html" id="article_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
            {{#article_list}}
            {{#articles}}
        	<tr>
                    
        	  <td width="3%">{{id}}</td>
        	  <td width="5%"><img src="uploaded/article/image/{{article_image}}" width="65" height="65" /></td>
        	  <td width="25%">{{article_title}}</td>
        	  <td width="15%">{{article_author}}</td>
                  <td width="8%">{{age_group_name}}</td>
                  <td width="15%">{{seo_link}}</td>
                  <td width="13%">{{se_keywords}}</td>
                  <td width="5%">{{status}}</td>
        	  <td width="17%"></br><a class="actionbtn" href="" id ="">Preview</a> | <a class="actionbtn" href="edit_article/read/{{id}}" id ="">Edit</a></br> </br><a class="actionbtn" href="#">Publish</a> | <a class="actionbtn" href="#">Unpublish </a> </br> </br></td>
                  
      	  </tr>
          {{/articles}}
          {{/article_list}}
        </table>
</script>

<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $.get("cms/article_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.article_listing_tpl(data);
            $('#article-listing').html('');
            $('#article-listing').append(template);
            return false;
        });
    });
</script>