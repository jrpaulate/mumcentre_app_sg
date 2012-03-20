<div id="body2com">
	<div id="cse" style="width: 100%;">Loading</div>
	<script src="http://www.google.com/jsapi" type="text/javascript"></script>
	<script type="text/javascript">
	  function parseQueryFromUrl () {
		var queryParamName = "q";
		var search = window.location.search.substr(1);
		var parts = search.split('&');
		for (var i = 0; i < parts.length; i++) {
		  var keyvaluepair = parts[i].split('=');
		  if (decodeURIComponent(keyvaluepair[0]) == queryParamName) {
			return decodeURIComponent(keyvaluepair[1].replace(/\+/g, ' '));
		  }
		}
		return '';
	  }
	 
	  google.load('search', '1', {language : 'en'});
	  google.setOnLoadCallback(function() {
		var customSearchOptions = {};
		var imageSearchOptions = {};
		imageSearchOptions['layout'] = google.search.ImageSearch.LAYOUT_POPUP;
		customSearchOptions['enableImageSearch'] = true;
		customSearchOptions['imageSearchOptions'] = imageSearchOptions;
		var googleAnalyticsOptions = {};
		googleAnalyticsOptions['queryParameter'] = 'baby';
		googleAnalyticsOptions['categoryParameter'] = 'Family';
		customSearchOptions['googleAnalyticsOptions'] = googleAnalyticsOptions;  var customSearchControl = new google.search.CustomSearchControl(
		  '013356316026673226255:rpcp-dy16k4', customSearchOptions);
		customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
		var options = new google.search.DrawOptions();
		options.enableSearchResultsOnly();
		customSearchControl.draw('cse', options);
		var queryFromUrl = parseQueryFromUrl();
		if (queryFromUrl) {
		  customSearchControl.execute(queryFromUrl);
		}
	  }, true);
	</script>
	<link rel="stylesheet" href="http://www.google.com/cse/style/look/default.css" type="text/css" />
</div> <!-- end body2com -->
<div id="sidebar2">
    <div id="c3spacer"></div>
    <?= render_partial('global/observer/sidebar'); ?>
    <!-- end .container --></div>
<?= render_partial('global/default_footer'); ?>
