<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Canadian Amateur</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="<?php echo base_url() ?>assets/css/shop-homepage.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/responsive_video.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/css/profile_page.css" rel="stylesheet">

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
                <!-- <a class="navbar-brand" href="<?php echo site_url() ?>">Home</a> -->
                <a class="navbar-brand" href="<?php echo site_url() ?>">Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                                       <li id="stream"><a href="<?php echo site_url() ?>">Stream</a>
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
					<li><a href=" <?php echo base_url() ?>/account/logout_user">Log out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">

        <div class="row">

            <div class="col-md-5">
				
					
	                	<p class="lead" id="user_name">User Name (getting from database)</p>
		                <div class="list-group">
							<div id="profile_img"><img src="<?php echo base_url() ?>/assets/img/missing.jpg" class="list-group-item thumbnail" style="text-align: center"></div>
					
				
						
	                    <div class="list-group-item" id="about_me">About Me</div>
						
	                	</div>
						
				
				<!-- <a class="btn btn-primary" target="_blank" href="#edit_profile"> Edit Profile </a> -->
                <a class="btn btn-primary" href="../upload/profile_upload"> Edit Profile </a>
				<!-- <a class="btn btn-primary" href="../profile_page/edit_profile"> Edit Profile </a> -->
				<!-- <a class="btn btn-primary" target="_blank" href="">Add New Video</a> -->
				<a class="btn btn-primary" href="../upload/video_upload">Add New Video</a>
            </div>

            <div class="col-md-7">

           
				
                <div class="row" id="list_video">
	
                                                

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Canadian Amateur Athletes Network</a>
                    </p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>assets/js/profilepage.js"></script>
	<script>
	var url = "<?php echo $url ?>";
	
	window.onload = load(url);
	
	</script>
	

</body>

</html>
