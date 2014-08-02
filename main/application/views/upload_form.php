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
<!--  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"> -->
<!--         <div class="container"> -->
<!--             <div class="navbar-header"> -->
<!--                 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> -->
<!--                     <span class="sr-only">Toggle navigation</span> -->
<!--                     <span class="icon-bar"></span> -->
<!--                     <span class="icon-bar"></span> -->
<!--                     <span class="icon-bar"></span> -->
<!--                 </button> -->
<!--                 <a class="navbar-brand" href="#home">Start Bootstrap</a> -->
<!--             </div> -->

            <!-- Collect the nav links, forms, and other content for toggling -->
<!--             <div class="collapse navbar-collapse navbar-ex1-collapse"> -->
<!--                 <ul class="nav navbar-nav"> -->
<!--                     <li><a href="#about">About</a> -->
<!--                     </li> -->
<!--                     <li><a href="#services">Services</a> -->
<!--                     </li> -->
<!--                     <li><a href="#contact">Contact</a> -->
<!--                     </li> -->
<!--           <li><a href=" <?php echo base_url() ?>/index.php">Log out</a>  -->
<!--                     </li> -->
<!--                 </ul> -->
<!--             </div> -->
            <!-- /.navbar-collapse -->
<!--         </div> -->
        <!-- /.container -->
<!--     </nav> -->

<?php //echo form_open_multipart('upload/do_upload');?>

<form class="form-signin" role="form" action="<?=site_url("video_controller/do_upload"); ?>" method="post" enctype="multipart/form-data">
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

</body>
</html>