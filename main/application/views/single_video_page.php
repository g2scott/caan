<?php include 'include/header.php';?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=129704493787021&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <div class="container">

        <div class="row">

            <?php echo $output; ?>
            

        </div>
        <div class="fb-like" data-href="<?php echo current_url() ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>

    </div>
    <!-- /.container -->

    <!-- JavaScript -->
    <script src="<?php echo base_url() ?>assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>assets/js/profilepage.js"></script>
	<script>

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
