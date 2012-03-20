<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '261024107269619', // App ID
      channelURL : '//localhost/mumcentre/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      oauth      : true, // enable OAuth 2.0
      xfbml      : true  // parse XFBML
    });

    // Additional initialization code here
  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     d.getElementsByTagName('head')[0].appendChild(js);
   }(document));
</script>
<div>
    <a id="click" href="#">FB Login</a>
</div>
<div>
    <img src="" id="avatar"/>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#click').click(function(e){
       FB.getLoginStatus(function(response) {
          if (response.authResponse) {
            // logged in and connected user, someone you know
//            alert('logged in and connected');
//              alert('Welcome!  Fetching your information.... ');
                 FB.api('/me', function(response) {
                  alert('Good to see you, ' + response.name + '!');
////                        $('#avatar').attr('src', '/'+response.id+'/picture');
                 });
          } else {
            // no user session available, someone you dont know
//            alert('logged out or not connected');
            FB.login(function(response) {
               if (response.authResponse) {
                 alert('Welcome!  Fetching your information.... ');
                 FB.api('/me', function(response) {
                  alert('Good to see you, ' + response.name + '!\n\
                        Here are your info:\n\
                        ' + response);
                  $('#avatar').attr('src', 'http://graph.facebook.com/'+response.id+'/picture');
                 });
               } else {
                 alert('User cancelled login or did not fully authorize.');
               }
             }, {scope: 'email'});
          }
       });
       e.preventDefault();
    });
});
</script>