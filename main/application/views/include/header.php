<!DOCTYPE html>
<html lang="en">
<!--  manifest="<?php echo base_url() ?>cache.appcache"  -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="1">
    <meta name="keywords" content="2">
    <meta name="author" content="3">
    
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/favicon.png"> 
    
    <?php if (isset($title)){
    	echo $title;
    } ?>
    
    <?php if (isset($type)){
    	echo $type;
    } ?>
    <?php if (isset($uri)){
    	echo $uri;
    } ?>
    
    <?php if (isset($thumbnail)){
    	echo $thumbnail;
    } ?>
    
    <?php if (isset($description)){
    	echo $description;
    } ?>
    
    <?php if (isset($admins)){
    	echo $admins;
    } ?>
    
    <?php if (isset($app_id)){
    	echo $app_id;
    } ?>
   	<?php if (isset($video)){
    	echo $video;
    } ?>
    
    <title>CAAN</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
    
    <!-- Add custom CSS here -->
    <link href="<?php echo base_url() ?>assets/css/shop-homepage.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/responsive_video.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/signin.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/profile_page.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
	    <link href="<?php echo base_url() ?>assets/css/custom.css" rel="stylesheet">
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
                 <img style="max-width:100px; margin-top: -5px;"
             src="<?php echo base_url() ?>assets/img/home.png"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li id="stream"><a href="#"><span class="glyphicon glyphicon-film">Stream</a>
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
                    <li id="signin"><a href="#"></a>
                    </li>
                    <li id="signup"><a href="#"></a>
                    </li>  
                    
					<a style="color:#00E;">beta</a>
                    
                </ul>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    