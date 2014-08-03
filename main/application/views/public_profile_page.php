<?php include 'include/header.php';?>

    <div class="container">

        <div class="row">

            <div class="col-md-5">
				
	                	
		                <div class="list-group">
							<div id="profile_img"><img src="<?php echo base_url() ?>/assets/img/missing.jpg" class="center-block img-circle img-responsive" style="text-align: center"></div>
						<p class="lead" id="user_name"></p>
						
	                    <div id="about_me"></div>
						
	                	</div>

                        <div id="follow">  
                        <!-- <a class="btn btn-primary" href="#">follow</a> -->
                        </div>
						
				
				<!-- <a class="btn btn-primary" target="_blank" href="#edit_profile"> Edit Profile </a> -->
				<!-- <a class="btn btn-primary" href="#edit_profile"> Edit Profile </a> -->
				<!-- <a class="btn btn-primary" target="_blank" href="">Add New Video</a> -->
				<!-- <a class="btn btn-primary" href="../upload/video_upload">Add New Video</a> -->
            </div>


            <div class="col-md-7">
	
                <div class="row" id="list_video">
	               <!-- ####### need using JavaScript to built below part ####### -->
                    <!-- information need for this block is: -->
                    <!-- 1. video src -->
                    <!-- 2. description -->
                    <!-- 3. rating information -->

                        <!-- <div class="col-sm-4 col-lg-4 col-md-4">
                                <div class="thumbnail">
                                    <div class="span6">
                                                    
                                    <div class="flex-video widescreen"><iframe src='//videos.sproutvideo.com/embed/1c9bd9b01d18e7cf94/ea7ab276cb220754?type=sd' allowfullscreen></iframe></div>
                                                
                                    <div class="caption">   
                                        <h4 class="pull-right">$24.99</h4>
                                        <h4><a href="#">First Product</a>
                                        </h4>
                                        <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                                    </div>

                                    <div class="ratings">
                                        <p class="pull-right">15 reviews</p>
                                        <p>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>   -->
                        
                    <!-- ####### need using JavaScript to built above part ####### -->      
                                                

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <!-- JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>assets/js/public_profilepage.js"></script>
	<script>
	var url = "<?php echo $url ?>";
    var userId = "<?php echo $user_id; ?>"
	
	window.onload = load(url, userId);
	
	</script>
	
	    <script>
function loadMenubar (url) {
	$.getJSON( url + '/main_page/check_login', function(data){
		// console.log(data);
		if (data.login != false) {
			var profile = "<a href=\"";
			profile += url + '/profile_page';
			profile += "\"><span class=\"glyphicon glyphicon-user\">Profile</a>";
			var logout = "<a href=\"";
			logout += url + '/account/logout_user';
			logout += "\" onclick=\"logout()\"><span class=\"glyphicon glyphicon-user\">Log-out</a>";
			$('#signin').html(profile);
			$('#signup').html(logout);
		} else {
			var signin = "<a href=\"";
			signin += url + '/account/load_login';
			signin += "\"><span class=\"glyphicon glyphicon-user\">Login</a>";
			var signup = "<a href=\"";
			signup += url + '/account/register_user';
			signup += "\"><span class=\"glyphicon glyphicon-user\">Register</a>";
			$('#signin').html(signin);
			$('#signup').html(signup);

		}
	}) // getJSON end
}
loadMenubar('<?php echo site_url();?>');
</script>
	
	<div class="container">
        <hr>
        <footer>
        </footer>
    </div>
        
</body>

</html>
