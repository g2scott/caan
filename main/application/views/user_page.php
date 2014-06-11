
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link href="../assets/css/main.css" rel="stylesheet">

	<style>
	
/*	#footer {border-style: red 10px solid;}*/
	#user_infor, #video_list {border-style: dotted; border-color: red;}
	

	#footer_text ul {
		font-size:small; 
		margin-top:10px;
		float:left;
	}
	#footer_text ul li {
		display: inline;
		margin-left: 2px;
		margin-right: 2px;
	}	

	#footer_text p {
		float:right; 
		font-size:small;
		margin-left:60px; 
		padding-top:5px; 
		margin-top:10px;
	}
	.iframe {
		float:left;
	}
	.video_row {
		clear:both;
	}
	
	</style>
</head>

<body>



<div class="container">
  <div class="header">
	
	
		<a href="#"><img src="" alt="CAAN_Logo" name="CAAN_Logo" width="20%" height="90" id="Insert_logo" style="background: #8090AB; display:block; float:left" /></a>
	

<div><p>vincent signin</p> </div>	

<div style="clear:both"></div>
	
    <!-- end .header --></div>
  
  <div class="content">
	<div id="user_infor"style="margin-left:60px;">
	<div id="user_pic" style="float:left;">
		<img src="../assets/imgs/vincent_small.jpg" alt="CAAN_Logo" name="CAAN_Logo" width="150%" height="150%" id="Insert_logo" style="background: #8090AB; display:block; float:left" />
	</div>
	<div id="about_me" style="float:right;">
		<p>USER NAME (get from database) <br/>
		<h3><?php echo $user_name; ?></h3>
		</p>
		<div id="profile">
			
			<h3><?php echo $about_me;?></h3>
			<br/>
			<p>
				above information came from backend of<br /> user table about_me_text field
			</p>	
				
			
		</div>
	</div>
	<div style="float:right">
		<h5>Add new video</h5>
		<form action="" method="get">
		  <input type="submit" value="Add new video">
		</form>
		
	</div>
	
	<div style="clear:both"></div>
	<!-- end #user_infor --></div>
	
	
	
	
	<div id="video_list" style="margin-left:30px;">
    <h1>Videos list</h1>
   
       <div class="video_row">
 		<div class="iframe">
            <iframe class='sproutvideo-player' src='//videos.sproutvideo.com/embed/1c9bd9b01d18e7cf94/ea7ab276cb220754?type=sd' width='100' height='100' frameborder='0' allowfullscreen></iframe>
        <!-- end #iframe --></div>
   		<div class="video_describe" style="float:right"><p>this video is about the football player.</p></div>
		<!-- end .video_row --></div>
		
	

	       <div class="video_row">
	 		<div class="iframe">
	            <iframe class='sproutvideo-player' src='//videos.sproutvideo.com/embed/1c9bd9b01d18e7cf94/ea7ab276cb220754?type=sd' width='100' height='100' frameborder='0' allowfullscreen></iframe>
	        <!-- end #iframe --></div>
	   		<div class="video_describe" style="float:right"><p>this video is about the football player.</p></div>
			<!-- end .video_row --></div>
			
	
		       <div class="video_row">
		 		<div class="iframe">
		            <iframe class='sproutvideo-player' src='//videos.sproutvideo.com/embed/1c9bd9b01d18e7cf94/ea7ab276cb220754?type=sd' width='100' height='100' frameborder='0' allowfullscreen></iframe>
		        <!-- end #iframe --></div>
		   		<div class="video_describe" style="float:right"><p>this video is about the football player.</p></div>
				<!-- end .video_row --></div>
				<div style="clear:both"></div>
		
    <!-- end #video_list --></div>
    



    <!-- end .content --></div>
  <div id="footer" style="clear:both; display:block;">
    	<div id="footer_text">
			<ul>
				<li>Contact us |</li>
				<li>Privacy |</li>
				<li>About CAAN |</li>
				<li> Terms and Condition</li>
			</ul>

			<p>Copyright caan 2014</p>
		</div>
		<div style="clear:both"></div>
    <!-- end #footer --></div>
  <!-- end .container --></div>
</body>
</html>