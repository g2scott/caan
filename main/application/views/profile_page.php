<?php include 'include/header.php';?>
    <div class="container">

        <div class="row">

            <div class="col-md-5">
					                	
		                <div class="list-group">
							<div id="profile_img"><img src="<?php echo base_url() ?>/assets/img/missing.jpg" class="center-block img-circle img-responsive" style="text-align: center"></div>
						<p class="lead" id="user_name"></p>
						
	                    <div  id="about_me"></div>
						
	                	</div>
						
                <a class="btn btn-default" href="<?php echo site_url() ?>/profile_page/profile_upload"><i class="fa fa-cog"></i>Settings </a>
				<a class="btn btn-default" href="<?php echo site_url() ?>/video_controller/video_upload">Upload Video</a>
            </div>

            <div class="col-md-7">

                <div class="row" id="list_video">
	
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->


    <!-- JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>assets/js/profilepage.js"></script>
    <script src="<?php echo base_url() ?>assets/js/openFB.js"></script>
	<script type="text/javascript">
	
	var url = "<?php echo site_url() ?>";
	
	window.onload = load(url);
	
	</script>

	<script>
	    function share(url, thumbnail, source, name, description) {
        openFB.api({
            method: 'POST',
            path: '/me/feed',
            params: {
                message: 'Posted by CAAN',
                picture: thumbnail,
                description: description,
                name: name,
                height: 360,
                width: 640,
                //title: "TITLE",
                caption: "For full HD please install the CAAN App, or visit the Web App.",
                link: url,
                //source: source
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
	    
<div id="loading" style="position: fixed; left: 0; right: 0; bottom: 0; top: 0; background: url(../assets/img/loadingBar.gif) rgba(0,0,0,0.3); 
z-index: 1000;   background-position: center center; background-repeat: no-repeat;"></div>


	<div class="container">
        <hr>
        <footer>
        </footer>
    </div>
    
</body>

</html>
