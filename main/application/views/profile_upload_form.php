
<?php include 'include/header.php';?>

<!-- <?php //echo form_open_multipart('upload/do_upload');?>  -->

<form class="form-signin" role="form" action="<?=site_url("profile_page/upload_profile"); ?>" method="post" enctype="multipart/form-data">
        <h4 class="form-signin-heading"><?php echo $error;?></h4>
        <h2 class="form-signin-heading">Settings</h2>

First
<input type="text" class="form-control" value="<?php echo $user->first ?>" name="first" autofocus>
Last
<input type="text" class="form-control" value="<?php echo $user->last ?>" name="last" autofocus>
Username
<input type="text" class="form-control" value="<?php echo $user->user_name ?>" name="username" required autofocus>
Email
<input type="email" class="form-control" value="<?php echo $user->email ?>" name="email" required autofocus>
New Password (4-8 Regular Characters)
<input type="password" class="form-control" value="" name="password" >
Description
<!-- <textarea> creates a multiline textbox -->
<input type ="text" class="form-control" value="<?php echo $user->about_me_text ?>" name = "about_me_text" rows = "4" cols = "36" autofocus></input>

<label>Profile Picture</label>
<input type="file" class="form-control" name="userfile" size="20" />

<br /><br />
<button class="btn btn-lg btn-default btn-block" type="submit">Submit</button>

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


</body>
</html>