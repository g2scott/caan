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
					<li><a href=" <?php echo site_url() ?>/account/logout_user" onclick='logout()' ><span class="glyphicon glyphicon-user">Log-out</a>
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
					                	
		                <div class="list-group">
							<div id="profile_img"><img src="<?php echo base_url() ?>/assets/img/missing.jpg" class="center-block img-circle img-responsive" style="text-align: center"></div>
						<p class="lead" id="user_name"></p>
						
	                    <div  id="about_me"></div>
						
	                	</div>
						
                <a class="btn btn-default" href="<?php echo site_url() ?>/profile_page/profile_upload"> Edit Profile </a>
				<a class="btn btn-default" href="<?php echo site_url() ?>/video_controller/video_upload">Upload Video</a>
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
    <script src="<?php echo base_url() ?>assets/js/openFB.js"></script>
	<script>
	
	var url = "<?php echo site_url() ?>";
	
	window.onload = load(url);
	
	</script>
	
	<script>
	    function share(url, thumbnail) {
        openFB.api({
            method: 'POST',
            path: '/me/feed',
            params: {
                message: 'Testing Facebook API',
                picture: thumbnail,
                link: url
            },
            success: function() {
                alert('the item was posted on Facebook');
            },
            error: errorHandler});
    }
	    function logout(){
	    	//alert("logout");
	    	tokenStore = window.sessionStorage;
	    	tokenStore.removeItem('fbtoken');
	    }
	    function errorHandler(error) {
	        alert(error.message);
	    }
	    $(document).ajaxStart(function(){
	        $('#loading').show();
	     }).ajaxStop(function(){
	        $('#loading').hide();
	     });
	    
	    
	    </script>
<div id="loading" style="position: fixed; left: 0; right: 0; bottom: 0; top: 0; background: url(../assets/img/loadingBar.gif) rgba(0,0,0,0.3); 
z-index: 1000;   background-position: center center; background-repeat: no-repeat;"></div>

</body>

</html>
