<html>
<head>
<title>Upload Form</title>
 	<!-- Bootstrap core CSS -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../assets/css/signin.css" rel="stylesheet">
</head>
<body>

<?php echo $error;?>

<?php //echo form_open_multipart('upload/do_upload');?>

<form class="form-signin" role="form" action="<?=site_url("upload/do_upload"); ?>" method="post" enctype="multipart/form-data">
        <h2 class="form-signin-heading">upload new video</h2>


<input type="text" class="form-control" placeholder="Video Name" name="video_name" required autofocus>
<input type="text" class="form-control" placeholder="Video Description" name="video_description" required>
<select name = "type" class="form-control">
                  <!-- <option selected = "selected">Amazing</option> -->
                  <option>football</option>
                  <option>basketball</option>
                  <option>hockey</option>
                  <!-- <option>9</option>
                  <option>8</option>
                  <option>7</option>
                  <option>6</option>
                  <option>5</option>
                  <option>4</option>
                  <option>3</option>
                  <option>2</option>
                  <option>1</option>
                  <option>Awful</option> -->
</select>
<input type="file" class="form-control" name="userfile" size="20" />

<br /><br />

<input type="submit" class="btn btn-lg btn-primary btn-block" value="Video Upload" />

</form>


<script src="../../assets/js/jquery-1.10.2.js"></script>
<script src="../../assets/js/bootstrap.js"></script>
</body>
</html>