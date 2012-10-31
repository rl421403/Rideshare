//Hide the delete form initially
$(".delete-form").hide();

//when delete link clicked once show the form
$('.delete-link').click(function(ev) {
	$(".delete-form").fadeToggle("fast", "linear");

	ev.preventDefault();
	ev.stopPropagation();
});