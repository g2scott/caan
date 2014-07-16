<!DOCTYPE html>
<html lang="en">
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
<a class="navbar-brand" href="<?php echo site_url() ?>">Home</a>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
<ul class="nav navbar-nav">
                    <li id="stream"><a href="stream">Stream</a>
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
<li><a href="<?php echo site_url('account/login_user') ?>">Sign in</a>
</li>

</ul>
</div>
<!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>

<div class="container">

<form class="form-signin" role="form" action="<?=site_url("account/createNew"); ?>" method="post">
<h2 class="form-signin-heading">sign up</h2>
<input type="text" class="form-control" placeholder="First Name" name="first" required autofocus>
<input type="text" class="form-control" placeholder="Last Name" name="last" required autofocus>
<input type="email" class="form-control" placeholder="Email" name="email" required autofocus>
<input type="text" class="form-control" placeholder="User Name" name="username" required autofocus>
<input type="password" class="form-control" placeholder="password" name="password" required>
<!-- <textarea> creates a multiline textbox -->
<textarea class="form-control" placeholder="About Me" name = "about_me_text" rows = "4" cols = "36" autofocus></textarea>
<button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
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
</body>
</html>