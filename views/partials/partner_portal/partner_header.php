<div style="width:917px; margin:0 auto;">

    <!--------------------------------------------------------------------------------------------->
    <div style="float:left; padding-bottom: 10px; "><img src="images/logo.jpg"></div>

    <div style="float:right; padding-top: 90px;">Welcome <span class="fontblue" style="font-size: 16px;"><?php echo $this->session->userdata('name'); ?> </span> &nbsp;&nbsp;&nbsp; Customer Support | <a href="#" id="out">Logout</a></div>
    <!--------------------------------------------------------------------------------------------->
    <br />

    <script type="text/javascript">
        $(document).ready(function(){
            $('#out').click(function(e){
                $.post("partner/logout/", {
                    fb_name : '',
                    fb_id : ''
                },

                function(){
                    window.location.reload();
                });
                e.preventDefault(); 
            });
        });
    </script>