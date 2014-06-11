<html>
<head>
</head>
<body>
	
	<h1>Register Form</h1>

	
		<form method = "post" action = "<?=site_url("login/register"); ?>">

	         <p>
	            <input type = "hidden" name = "recipient"
	               value = "deitel@deitel.com" />
	            <input type = "hidden" name = "subject" 
	               value = "Feedback Form" />
	            <input type = "hidden" name = "redirect" 
	               value = "main.html" /> 
	         </p>

	        <p><label>First Name:
	            <input name = "first" type = "text" size = "25" />
	         </label></p>
	
			<p><label>Last Name:
	            <input name = "last" type = "text" size = "25" />
	         </label></p>
		
			<p><label>Email:
	            <input name = "email" type = "text" size = "25" />
	         </label></p>
	
			<p><label>User Name:
	            <input name = "login" type = "text" size = "25" />
	         </label></p>
	
			<p><label>Password:
	            <input name = "password" type = "password" size = "25" />
	         </label></p>
	
	         <!-- <textarea> creates a multiline textbox -->
	         <p><label>About Me:<br />
	            <textarea name = "about_me_text" rows = "4" cols = "36">
	
	            </textarea>
	         </label></p>

	        

	         

	         <p>
	            <input type = "submit" name= "submit" value = "Submit Your Entries" />
	            <input type = "reset" value = "Clear Your Entries" />
	         </p>   

	      </form>

</body>	
	
	
</html>