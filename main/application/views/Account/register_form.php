<!DOCTYPE html>
<html lang="en" manifest="/cache.appcache">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="shortcut icon" href="../../assets/ico/favicon.ico"> -->

    <title>Register</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>/assets/css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="<?php echo site_url() ?>">
<img style="max-width:100px; margin-top: -3px;"
             src="<?php echo base_url() ?>assets/img/home.png">
             </a>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
<ul class="nav navbar-nav">
                    <li id="stream"><a href="<?php echo site_url() ?>"><span class="glyphicon glyphicon-film">Stream</a>
                    </li>
                    <li>
                        
             <div class="input-group input-group-sm">
         <form class="navbar-form" role="search">
         <div class="input-group">
             <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
             <div class="input-group-btn">
                 <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
             </div>
         </div>
         </form>
         </div>
        
                    </li>
<li><a href="<?php echo site_url('account/login') ?>"><i class="glyphicon glyphicon-user"></i>Login</a>
</li>

</ul>
</div>
<!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>

<div class="container">

<form class="form-signin" role="form" action="<?=site_url("account/createNew"); ?>" method="post">
<h2 class="form-signin-heading">Register</h2>
   
<!-- <input type="text" class="form-control" placeholder="First Name" name="first" required autofocus> -->
<!-- <input type="text" class="form-control" placeholder="Last Name" name="last" required autofocus> -->

<input type="email" class="form-control" placeholder="Email" name="email" required autofocus>
<input type="text" class="form-control" placeholder="User Name" name="username" required autofocus>
<input type="password" class="form-control" placeholder="Password (4-8 characters)" name="password" required>
<!-- <textarea> creates a multiline textbox -->
<textarea class="form-control" placeholder="Description (optional)" name = "about_me_text" rows = "4" cols = "36" autofocus></textarea>
<button class="btn btn-lg btn-default btn-block" type="submit">Connect Using Email</button>
<button class="btn btn-lg" onclick="login()"><img style="width: 90%; height: 90%;  margin-top: -5px;"
             src="<?php echo base_url() ?>assets/img/facebook-connect-button.png"></button>
</form>

</div> <!-- /container -->
<div class="container">

<hr>

<footer>
<div class="row">
<div class="col-lg-12">
<!-- <p>Copyright &copy; Company 2013 - Template by <a href="http://maxoffsky.com/">Maks</a> -->
</p>
</div>
</div>
</footer>

</div>


<script src="<?php echo base_url(); ?>/assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/bootstrap.js"></script>
        <script src="../../assets/js/openFB.js"></script>
        
<script>
     // Defaults to sessionStorage for storing the Facebook token
     openFB.init({appId: '129704493787021'});

    //  Uncomment the line below to store the Facebook token in localStorage instead of sessionStorage
    //  openFB.init({appId: 'YOUR_FB_APP_ID', tokenStore: window.localStorage});

    function login() {
        openFB.login(
                function(response) {
                    if(response.status === 'connected') {
                        alert('Facebook login succeeded, got access token: ' + response.authResponse.token);
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

                   //and some more input elements here
                   //and dont forget to add a submit button

                   document.getElementsByTagName('body')[0].appendChild(f);
                   
                   var frm = $('#fb_form');
                   
                     $.ajax({
                         async: false,
                      dataType: 'json',
                         type: frm.attr('method'),
                         url: "login_user",
                         data: frm.serialize(),
                         success: function (data) {
                             alert(data.message);
                             window.location.href = "../" + data.message;
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
                message: document.getElementById('Message').value || 'Testing Facebook APIs'
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



</body>
</html>