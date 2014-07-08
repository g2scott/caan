function generateVideoTags(data)
{
	var outputVideo = '';
	// outputVideo += "<div class=\"col-sm-6 col-lg-6 col-md-6\"><div class=\"thumbnail\"><div class=\"span6\"><div class=\"flex-video widescreen\"><iframe src=\'";
	outputVideo += "<div class=\"col-sm-6 col-lg-6 col-md-6\"><div class=\"thumbnail\"><div class=\"span6\"><div class=\"flex-video widescreen\">";
	var replace = /<iframe class='sproutvideo-player' src='/gi;
	var link = data.link.replace(replace, "<iframe class='sproutvideo-player' src='http:");
	outputVideo += link;
	// outputVideo += "\' allowfullscreen></iframe></div><div class=\"caption\"><h4 class=\"pull-right\"></h4><h4><a href=\"#\">" + data.name + "</a></h4><p>" + data.description +  "</p></div><div class=\"ratings\"><p class=\"pull-right\">15 reviews</p><span class=\"glyphicon glyphicon-star\"></span><span class=\"glyphicon glyphicon-star\"></span><span class=\"glyphicon glyphicon-star\"></span><span class=\"glyphicon glyphicon-star\"></span></p></div></div></div></div>";
	outputVideo += "</div><div class=\"caption\"><h4 class=\"pull-right\"></h4><h4><a href=\"#\">" + data.name + "</a></h4><p>" + data.description +  "</p></div>";
	
	outputVideo += "<div class=\"ratings\"><p class=\"pull-right\">15 reviews</p><span class=\"glyphicon glyphicon-star\"></span><span class=\"glyphicon glyphicon-star\"></span><span class=\"glyphicon glyphicon-star\"></span><span class=\"glyphicon glyphicon-star\"></span></p></div></div></div></div>";
	return outputVideo;
}

function load (url, userId) 
{
	$.ajaxSetup({
		timeout: 6000
	});
	//console.log(url);
	$.getJSON(url + '/public_profile_page/build_public_profile/' + userId, function(data){
		var userName = data[0].first + " " + data[0].last;
		var aboutMe = data[0].about_me_text;
		//console.log(userName);
		//console.log(aboutMe);
		$('#user_name').html(userName);
		$('#about_me').html(aboutMe);
	});
	
	$.getJSON(url + '/public_profile_page/build_public_video_list/' + userId, function(data){
		//console.log(data);
		var outputVideo = '';
		for (var i=0; i < data.length; i++) {
			outputVideo += generateVideoTags(data[i]);
		}
		$('#list_video').html(outputVideo);
	});

	$.getJSON(url + '/public_profile_page/build_follow_button/' + userId, function(data){
		var output = '';
		var tester = data.data;
		console.log(data.data);
		if (tester != null) {	
		// build output by adding variable data(data is the text of follow or unfollow)
			if (tester == true) {
				output = "<a class=\"btn btn-primary\" href=\"" + url + "/public_profile_page/unfollow/" + userId + "\">unfollow</a>";
			} else {
				output = "<a class=\"btn btn-primary\" href=\"" + url + "/public_profile_page/follow/" + userId +"\">follow</a>";
			} 
		}
		console.log(output);
		console.log("output");
		$('#follow').html(output);
		
		
	});

}