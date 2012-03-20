<div id="links">
    <div id="link_home"><a href="<?php echo base_url(); ?>" class="ml-hbutton" <?php if (current_url() == base_url()){echo "style='background-position: 0 -54px'";}?> ></a></div>
    <div id="link_preg"><a href="pregnancy" class="ml-prbutton" <?php if ($this->uri->segment(1) == "Pregnancy"){echo "style='background-position: 0 -54px'";}?>></a></div>
    <div id="link_baby"><a href="baby" class="ml-bbutton" <?php if ($this->uri->segment(1) == "Baby"){echo "style='background-position: 0 -54px'";}?>></a></div>
    <div id="link_Todd"><a href="toddler" class="ml-tbutton" <?php if ($this->uri->segment(1) == "Toddler"){echo "style='background-position: 0 -54px'";}?>></a></div>
    <div id="link_pre-s"><a href="preschooler" class="ml-psbutton" <?php if ($this->uri->segment(1) == "Preschooler"){echo "style='background-position: 0 -54px'";}?>></a></div>
    <div id="link_parent"><a href="parents" class="ml-pabutton" <?php if ($this->uri->segment(1) == "Parents"){echo "style='background-position: 0 -54px'";}?>></a></div>
    <div id="link_forums"><a href="<?php echo base_url(); ?>forum/" class="ml-fbutton"></a></div>
    <div id="link_adver"><a href="#" class="ml-anbutton"></a></div>
    <div id="lnksearch-cont">
        <div class="lnksearch-searchbox">
            <div id="lnksearch-box">
                <form name="frm_search" id="frm_search" method="post">
                <input type="text" name="q" id="q" class="lnksearch-textinput" value="Search Mumcentre" title="Search Mumcentre"/>
                <button type="submit" id="search_submit" style="display:none"></button>
                </form>
                <script>
                $(document).ready(function(){    
                    $('#frm_search').submit(function(e){
                       var keyword = $('#q').val();
                       location.href = "search/?q="+keyword;
                       e.preventDefault();
                    });
                    $('#q').focus(function () {
                        if ($(this).val() == $(this).attr("title")) {
                            $(this).val("");
                        }
                    }).blur(function () {
                        if ($(this).val() == "") {
                            $(this).val($(this).attr("title"));
                        }
                    });
                });
                </script>
            </div>
        </div>
    </div>
</div>