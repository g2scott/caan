<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Upload Videos</title>

    <!-- Bootstrap core CSS -->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="../../assets/css/signin.css" rel="stylesheet">

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
                    
        <li><a href=" <?php echo base_url() ?>/index.php">Log out</a>  
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>



<!-- <?php //echo form_open_multipart('upload/do_upload');?>  -->

<form class="form-signin" role="form" action="<?=site_url("upload/upload_profile"); ?>" method="post" enctype="multipart/form-data">
        <h4 class="form-signin-heading"><?php echo $error;?></h4>
        <h2 class="form-signin-heading">Settings</h2>


<input type="text" class="form-control" value="<?php echo $user->first ?>" name="first" required autofocus>
<input type="text" class="form-control" value="<?php echo $user->last ?>" name="last" required autofocus>
<input type="text" class="form-control" value="<?php echo $user->user_name ?>" name="username" required autofocus>
<input type="email" class="form-control" value="<?php echo $user->email ?>" name="email" required autofocus>
<input type="password" class="form-control" value="<?php echo $user->password ?>" name="password" required>
<!-- <textarea> creates a multiline textbox -->
<input type ="text" class="form-control" value="<?php echo $user->about_me_text ?>" name = "about_me_text" rows = "4" cols = "36" autofocus></input>

<label>select personal picture</label>
<input type="file" class="form-control" name="userfile" size="20" />

<br /><br />
<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>

</form>


<script src="../../assets/js/jquery-1.10.2.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
</body>
</html>