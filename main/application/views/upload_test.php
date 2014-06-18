<?php






?>



<html>
<head>
</head>	
<bod>
	this is sprout video test page
	<div id="return">
	</div>
	
	
	<form action="" method="post"
	enctype="multipart/form-data" id="target">
	<label for="file">Filename:</label>
	<input type="file" name="file" id="file"><br>
	<input type="submit" name="submit" value="Submit" id="submit">
	</form>
	
		
	<script src="assets/js/jquery-1.10.2.js"></script>
</body>	
</html>

<script>
	$("#target").submit(function(event){ event.preventDefault(); });
	$("#file").change(function( event ) {
		//event.preventDefault();
		//var value = $("#file").innerHTML;
		console.log(this.files[0].mozFullPath);
		
	});
	
	var request;
	if (window.XMLHttpRequest) {
		request = new XMLHttpRequest();
	}else {
		request = new ActiveXObject("Microsoft.XMLHTTP");
		// this compatible with old browser
	}
	request.open('GET', 'data.txt');
	request.onreadystatechange = function() {
		if ((request.readyState ===4) && (request.status ===200)) {
			
			var modify = document.getElementsByTagName("li");
				for(var i = 0; i < modify.length; i++){
					modify[i].innerHTML = request.responseText;
			}

			}
		}	
	request.send();
	
	
	// $('#submit').click(function(){
	// 		var value = $this.value;
	// 		console.log(value);
	// 	});
	
	// var return_result = <?php //echo $return; ?>;
	// 	console.log(return_result);
	// 	// var embed_code = return_result.embed_code;
	// 	var embed_code = return_result.videos[0].id;
	// 	console.log(embed_code);
	// 	
	// 	$('#return').html(embed_code);
	
	

</script>