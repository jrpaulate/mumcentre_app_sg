<div id="header">
    <div class="container">
        <ul>
            <li id="cms-logo" href="cms"> <img src="assets/img/system/mumcentre-logo.png" width="180" height="70">
            
             </a>
            </li>
            <li id="cms-nav">
                <ul>
                    <li class="cms-nav-dashboard"><a href="cms_dashboard/dashboard"></a></li>
                    <li class="cms-nav-blank"><a href=""></a></li>
                    <li class="cms-nav-hotbox"><a href="cms_hotbox"></a></li>
                    <li class="cms-nav-article"><a href="cms/article"></a></li>
                    <li class="cms-nav-pow"><a href="cms_pow"></a></li>
                    <li class="cms-nav-events"><a href="cms_event"></a></li>
                    <li class="cms-nav-curriculum"><a href="cms_curriculum"></a></li>
                    <li class="cms-nav-program"><a href="cms_program"></a></li>

                    <li class="cms-nav-reviews"><a href="cms_review"></a></li>

                    <li class="cms-nav-member"><a href="cms/poll"></a></li>
                    <li class="cms-nav-provider"><a href="cms_provider"></a></li>
                    <li class="cms-nav-useraccount"><a href="cms_user_account"></a></li>
                    <li class="cms-nav-alerts"><a href="cms_alerts"></a></li>
                    <li class="cms-nav-videoad"><a href="cms_ads_listing"></a></li>

                    <li class="cms-nav-logout"><a id="logout" href="cms/logout"></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<div class="clear"></div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#logout').click(function(e){
            $.post("cms/logout/", {
                fb_name : '',
                fb_id : ''
            },

            function(){
                window.location = 'cms';
            });
            e.preventDefault();
        });
    });
</script>
