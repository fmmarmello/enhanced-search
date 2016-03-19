$(document).ready(function($) {
	
	$(window).scroll(function(event) {
		var screenWidth = screen.width;
		var screenHeight = screen.height;
		var scrollposition = $(window).scrollTop();
		console.log(screenWidth);
		if (screenWidth > 1024) {

			if (scrollposition < 150) {
			 	$("#sidebar").css(
			 		{
				      "position": "absolute",
				      "top": "0px",
				      "width": "360px",
				      "margin-top": "0px"

				    }
				); 
			}
			if (scrollposition > 150) {
			 	$("#sidebar").css(
			 		{
				      "position": "fixed",
				      "top": "65px",
				      "width": "360px",
				      "margin-top": "0px"

				    }
				); 
			}

			if($(".galeria").length > 0) {
				if (scrollposition > $(".galeria").offset().top) {
					$("#sidebar").css(
						{
							"position": "absolute",
							"top": $(".galeria").offset().top,
							"width": "360px",
							"margin-top": "0px"

						}
					);
				}
			}
		}
	});
});