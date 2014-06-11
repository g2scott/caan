<html>
<head>
</head>
<body>	
<h1>Login Form</h1>

      <p>CAAN members please login</p>

      <!-- this tag starts the form, gives the   -->
      <!-- method of sending information and the -->
      <!-- location of form scripts              -->
      <form method = "post" action = "<?=site_url("login"); ?>">

         

         <!-- <input type = "text"> inserts a text box -->
         <p><label>Name:
               <input name = "name" type = "text" size = "25"
                  maxlength = "30" />
            </label></p>
			<label>Password:
	               <input name = "name" type = "password" size = "25"
	                  maxlength = "30" />
	            </label></p>
  
         <p>
            <!-- input types "submit" and "reset" insert  -->
            <!-- buttons for submitting and clearing the  -->
            <!-- form's contents                          -->
            <input type = "submit" value ="click to submit" name="login"/>
            <input type = "reset" value ="click to clear" />
         </p>   

      </form>
</body>
</html>