$(document).ready(function() {

	// There is no special integration in BS between list-group and tabs, so we add it
	 $('.list-group-item').on('click',function(e){
     	var previous = $(this).closest(".list-group").children(".active");
     	previous.removeClass('active'); // previous list-item
     	$(e.target).addClass('active'); // activated list-item
   	});


	 //FSEditor
	$(".fullscreen").fseditor({maxHeight: 500});

	//Thumbnail
	$(".profile-photos img").click(function(e) {
		e.preventDefault();
		var img = $(this).attr("src");
		var imgname = $(this).closest(".item-wrapper").attr("data-name");

		bootbox.dialog({
			message: "<img src='" + img + "' class='img-responsive' />",
			title: imgname,
			buttons: {
				close: {
					label: "Close",
					className: "btn-default"
				}
			}
		});

		$(".modal .bootbox-close-button").hide();

	});


});