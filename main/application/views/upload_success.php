<html>
<head>
<title>Upload Form</title>
</head>
<body>

<h3>Your file was successfully uploaded!</h3>

<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>

<?php  echo $path; ?>

<?php var_dump ($json) ?>

</ul>

<p><?php echo anchor('upload', 'Upload Another File!'); ?></p>
<p><?php echo anchor('main_page', 'HOME'); ?></p>

</body>
</html>