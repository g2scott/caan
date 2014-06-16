function generateVideoTags(data)
{
	var outputVideo = '';
	outputVideo += "<div class=\"col-sm-6 col-lg-6 col-md-6\"><div class=\"thumbnail\"><div class=\"span6\"><div class=\"flex-video widescreen\"><iframe src=\'";
	outputVideo += data.link;
	outputVideo += "\' allowfullscreen></iframe></div><div class=\"caption\"><h4 class=\"pull-right\"></h4><h4><a href=\"#\">" + data.name + "</a></h4><p>" + data.description +  "</p></div><div class=\"ratings\"><p class=\"pull-right\">15 reviews</p><span class=\"glyphicon glyphicon-star\"></span><span class=\"glyphicon glyphicon-star\"></span><span class=\"glyphicon glyphicon-star\"></span><span class=\"glyphicon glyphicon-star\"></span></p></div></div></div></div>";
	return outputVideo;
}



function load () {
	// var result = <?php echo $category_name ?>
	// triger codeigniter controller to pick return
	$.ajaxSetup({
		timeout: 6000
	});
	$.getJSON('http://localhost/~vincent/caan/main/index.php/profile_page/build_profile', function(data){
		var userName = data[0].user_name;
		var aboutMe = data[0].about_me_text;
		console.log(userName);
		console.log(aboutMe);
		$('#user_name').html(userName);
		$('#about_me').html(aboutMe);
	});
	
	$.getJSON('http://localhost/~vincent/caan/main/index.php/profile_page/build_video_list', function(data){
		console.log(data);
		var outputVideo = '';
		for (var i=0; i < data.length; i++) {
			outputVideo += generateVideoTags(data[i]);
		}
		$('#list_video').html(outputVideo);
	});

}