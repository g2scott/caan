<html>
<head>
	<style>
/*	* {border-style: dotted; border-color: red;};*/
	</style>
</head>
<body>
	
	<h1>Add Video</h1>

	
		<form method = "post" action = "<?=site_url("user_page/create_video"); ?>">

	         <p>
	            <input type = "hidden" name = "id"
	               value = "deitel@deitel.com" />
	            <input type = "hidden" name = "subject" 
	               value = "Feedback Form" />
	            <input type = "hidden" name = "redirect" 
	               value = "main.html" /> 
	         </p>
	<!-- $id, $link, $describe, $style -->

	        <p><label>video Name:
	            <input name = "video_name" type = "text" size = "25" />
	         </label></p>
	
			<p><label>video link:
	            <input name = "link" type = "text" size = "25" />
	         </label></p>
		

	         <!-- <textarea> creates a multiline textbox -->
	         <p><label>description:<br />
	            <textarea name = "describe" rows = "4" cols = "36"></textarea>
	         </label></p>
	
			<p><label>style: 
				<select name = "style">
	             <option selected = "selected">football</option>
                 <option>hockey</option>
                 <option>basketball</option
				</select>
	        </label>
			</p>
			<br />
			<br />
	       
	         <p>
	            <input type = "submit" name= "submit" value = "Submit Your Entries" />
	            <input type = "reset" value = "Clear Your Entries" />
	         </p>   

	      </form>

</body>	
	
	
</html>