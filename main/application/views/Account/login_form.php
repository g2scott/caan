<?php include './application/views/include/header.php';?>
    <div class="container">



      <form id="login_form" class="form-signin" role="form" action="<?=site_url("account/login"); ?>" method="post">
      
      <h2 class="form-signin-heading">Login</h2>
      <h4 id="error" class="form-signin-heading"></h4>
        
        
        <?php echo "<p>" . anchor('account/recoverPasswordForm','Recover Password') . "</p>"; ?>
        <input type="text" class="form-control" placeholder="Email" name="email" required autofocus>
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-default btn-block" type="submit">Login</button>

<button type='button' class="btn btn-lg" onclick="login()"><img style="width: 90%; height: 90%; margin-top: -5px; vertical-align: middle;"
             src="<?php echo base_url() ?>assets/img/facebook-connect-button.png"></button>


	

    </div> <!-- /container -->
    <script>
  
</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<!-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button> -->

<div id="status">
</div>

    <script src="../../assets/js/jquery-1.10.2.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>
        <script src="../../assets/js/openFB.js"></script>
    
    <script type="text/javascript">
    var frm = $('#login_form');
    frm.submit(function (ev) {
        $.ajax({
           	async: false,
        	dataType: 'json',
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                if (data.status == 'success'){
					//alert(data.message);
            		window.location.href = '<?=site_url();?>' + data.message;
                }if (data.status == 'error'){
					//alert("Incorrect username or password!");
					
            		//window.location.href = '<?=site_url();?>' + data.message;
            		document.getElementById("error").innerHTML = data.message;
                }
            },
        });

        ev.preventDefault();
    });
	</script>
	
<script>

     // Defaults to sessionStorage for storing the Facebook token
     openFB.init({appId: '129704493787021'});

    //  Uncomment the line below to store the Facebook token in localStorage instead of sessionStorage
    //  openFB.init({appId: 'YOUR_FB_APP_ID', tokenStore: window.localStorage});

    function login() {
        openFB.login(
                function(response) {
                    if(response.status === 'connected') {
						//alert('Facebook login succeeded, got access token: ' + response.authResponse.token);
                        this.getInfo();
                    } else {
                        alert('Facebook login failed: ' + response.error);
                    }
                }, {scope: 'email,read_stream,publish_stream'});
    }

    function getInfo() {
        openFB.api({
            path: '/me',
            success: function(response) {
                console.log(JSON.stringify(response));
                //document.getElementById("userName").innerHTML = data.name;
                //document.getElementById("userPic").src = 'http://graph.facebook.com/' + data.id + '/picture?type=small';
             // document.getElementById('status').innerHTML =
             // 'Thanks for logging in, ' + response.name + '!';
                   
                   var f = document.createElement("form");
                   f.setAttribute('method',"post");
                   f.setAttribute('action',"login_user");
                   f.setAttribute('id',"fb_form");

                   var name = document.createElement("input"); //input element, text
                   name.setAttribute('type',"hidden");
                   name.setAttribute('name',"user_name");
                   name.setAttribute('value',response.name);
                   
                   var email = document.createElement("input"); //input element, text
                   email.setAttribute('type',"hidden");
                   email.setAttribute('name',"email");
                   email.setAttribute('value',response.email);
                   
                   var id = document.createElement("input"); //input element, text
                   id.setAttribute('type',"hidden");
                   id.setAttribute('name',"id");
                   id.setAttribute('value',response.id);

                   var pic = document.createElement("input"); //input element, text
                   pic.setAttribute('type',"hidden");
                   pic.setAttribute('name',"userPic");
                   pic.setAttribute('value','http://graph.facebook.com/' + response.id + '/picture?type=normal');

                   f.appendChild(name);
                   f.appendChild(email);
                   f.appendChild(id);
                   f.appendChild(pic);


                   document.getElementsByTagName('body')[0].appendChild(f);
                   
                   var frm = $('#fb_form');
                   
                     $.ajax({
                         async: false,
                      dataType: 'json',
                         type: frm.attr('method'),
                         url: "login_user",
                         data: frm.serialize(),
                         success: function (data) {
                             if (data.status == "success"){
                             	//alert(data.message);
                             	window.location.href = "../" + data.message;
                             }
                             if (data.status == "error"){
                                 //alert(data.message);
                            	 document.getElementById("error").innerHTML = data.message;
                             }
                         }
                     });
                     
            },
            error: errorHandler});
    }

    function share() {
        openFB.api({
            method: 'POST',
            path: '/me/feed',
            params: {
                message: document.getElementById('Message').value || 'Testing Facebook APIs',
            },
            success: function() {
                alert('the item was posted on Facebook');
            },
            error: errorHandler});
    }

    function revoke() {
        openFB.revokePermissions(
                function() {
                    alert('Permissions revoked');
                },
                errorHandler);
    }

    function logout() {
        openFB.logout(
                function() {
                    alert('Logout successful');
                },
                errorHandler);
    }

    function errorHandler(error) {
        alert(error.message);
    }
    
	//
</script>

	<script>
function loadMenubar (url) {
	$.getJSON( url + '/main_page/check_login', function(data){
		// console.log(data);
		if (data.login != false) {
			var profile = "<a href=\"";
			profile += url + 'profile_page';
			profile += "\"><span class=\"glyphicon glyphicon-user\">Profile</a>";
			var logout = "<a href=\"";
			logout += url + 'account/logout_user';
			logout += "\" onclick=\"logout()\"><span class=\"glyphicon glyphicon-user\">Log-out</a>";
			$('#signin').html(profile);
			$('#signup').html(logout);
		} else {
			var signin = "<a href=\"";
			signin += url + 'account/load_login';
			signin += "\"><span class=\"glyphicon glyphicon-user\">Login</a>";
			var signup = "<a href=\"";
			signup += url + 'account/register_user';
			signup += "\"><span class=\"glyphicon glyphicon-user\">Register</a>";
			$('#signin').html(signin);
			$('#signup').html(signup);

		}
	}) // getJSON end
}
loadMenubar('<?php echo site_url();?>');
</script>
	

<div id="status">
</div>
    
    <div class="container">
        <hr>
        <footer>
        </footer>
    </div>
    
  </body>
</html>