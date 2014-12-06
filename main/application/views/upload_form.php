<?php include 'include/header.php';?>

<?php //echo form_open_multipart('upload/do_upload');?>

<form class="form-signin" role="form" action="<?=site_url("videos/do_upload"); ?>" method="post" enctype="multipart/form-data">
        <h4 class="form-signin-heading"><?php echo $error;?></h4>
        <h2 class="form-signin-heading">Upload Video</h2>

<input type="text" class="form-control" placeholder="Video Name" name="video_name" required autofocus>
<input type="text" class="form-control" placeholder="Video Description" name="video_description" required>
<select name = "type" class="form-control">

                  <!-- <option selected = "selected">Amazing</option> -->
                  <option>Football</option>
                  <option>Lacrosse</option>
                  <option>Swimming</option>
                  <option>Tennis</option>
                  <option>Baseball</option>
                  <option>Basketball</option>
                  <option>Hockey</option>
                  <option>Other</option>
                  
</select>
Max Filesize 64M
<input type="file" class="form-control" name="userfile" size="20" />

<br />

<input type="submit" class="btn btn-lg btn-default btn-block" value="Upload Video" />


<a href="<?=site_url("profile_page"); ?>" style='text-decoration:none;'>
  <input type="button" class="btn btn-lg btn-default btn-block" value="Cancel" />
</a>

</form>


<script src="../../assets/js/jquery-1.10.2.js"></script>
<script src="../../assets/js/bootstrap.js"></script>

<script>
function loadMenubar (url) {
	$.getJSON( url + '/main_page/check_login', function(data){
		// console.log(data);
		if (data.login != false) {
			var profile = "<a href=\"";
			profile += url + 'profile_page';
			profile += "\"><span class=\"glyphicon glyphicon-user\">Profile</a>";
			var logout = "<a href=\"";
			logout += url + 'account/logout_user';
			logout += "\" onclick=\"logout()\"><span class=\"glyphicon glyphicon-user\">Log-out</a>";
			$('#signin').html(profile);
			$('#signup').html(logout);
		} else {
			var signin = "<a href=\"";
			signin += url + 'account/load_login';
			signin += "\"><span class=\"glyphicon glyphicon-user\">Login</a>";
			var signup = "<a href=\"";
			signup += url + 'account/register_user';
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
