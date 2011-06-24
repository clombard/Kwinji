$(document).ready(function() {
	/**
	 * Modal Dialog Boxes Setup
	 */
	var triggers = $(".modalInput").overlay({
		// some mask tweaks suitable for modal dialogs
		mask : {
			color : '#fff',
			loadSpeed : 'normal',
			top: '5%',
			effect: 'apple',
			opacity : 0.6
		},
		onBeforeLoad : function() {

			// Link url
			var url = this.getTrigger().attr("href");

			// content message insert in the modal box
			var content = this.getTrigger().attr("data-message");
			// grab wrapper element inside content
			var wrap = this.getOverlay().find(".contentWrap");
			// Set the CONFIRM button with url value
			var confirm = this.getOverlay().find("button[name=confirm]");
			// load the page specified in the trigger
			wrap.html(content);
			confirm.val(url);
		},
		closeOnClick : true,
		onClose: function() {
			$(".form-error").hide();
			$('form input, form textarea').removeClass('invalid');
		}
	});

	/* Simple Modal Box */
	var buttons1 = $("#simpledialog button").click(function(e) {
		// get user input
		var yes = buttons1.index(this) === 0;
		if (yes) {
			// do the processing here
		}
	});

	/* Yes/No Modal Box */
	var buttons2 = $("#yesno button").click(function(e) {
		// get user input
		var yes = buttons2.index(this) === 0;
		// do something with the answer
		triggers.eq(1).html("You clicked " + (yes ? "yes" : "no"));
	});

	/* User Input Prompt Modal Box */
	$("#prompt form").submit(function(e) {
		// close the overlay
		triggers.eq(2).overlay().close();
		// get user input
		var input = $("input", this).val();
		// do something with the answer
		if (input)
			triggers.eq(2).html(input);
		// do not submit the form
		return e.preventDefault();
	});

	/* User Input Prompt Modal Box */
	$("#new_message form").submit(function(e) {
		// close the overlay
		triggers.eq(2).overlay().close();
		// get user input
		var input = $("input", this).val();
		// do something with the answer
		if (input)
			triggers.eq(2).html(input);
		// do not submit the form
		return e.preventDefault();
	});

});