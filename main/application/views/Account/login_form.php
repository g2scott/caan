<!DOCTYPE html>
<html lang="en" manifest="/cache.appcache">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="shortcut icon" href="../../assets/ico/favicon.ico"> -->

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../assets/css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  
<!--   depricated -->
    <div id="fb-root"></div>
    <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=481528471979743&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    
    
    <script src="../../assets/js/facebook.js"></script>
 
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
             src="<?php echo base_url() ?>assets/img/home.jpg">
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
                 <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-user"></i></button>
             </div>
         </div>
         </form>
         </div>
        
                    </li>

					<li><a href="<?php echo site_url('account/register_user') ?>"><i class="glyphicon glyphicon-user"></i>Register</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">



      <form id="login_form" class="form-signin" role="form" action="<?=site_url("account/login"); ?>" method="post">
        <h2 class="form-signin-heading">Login</h2>
        
        <?php echo "<p>" . anchor('account/recoverPasswordForm','Recover Password') . "</p>"; ?>
        <input type="text" class="form-control" placeholder="Email" name="email" required autofocus>
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-default btn-block" type="submit">Login</button>

    <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>
      </form>


	

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

    

    <script src="../../assets/js/jquery-1.10.2.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>
    
    
    
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
                alert(data.message);
                window.location.href = '<?=site_url();?>' + data.message;
            }
        });

        ev.preventDefault();
    });
	</script>



<div id="status">
</div>
    
    
  </body>
</html>