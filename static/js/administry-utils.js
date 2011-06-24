$(document).ready(
		function() {

			/* setup navigation, content boxes, etc... */
			Administry.setup();

			/* progress bar animations - setting initial values */
			Administry.progress("#progress1", 1, 5);
			Administry.progress("#progress2", 2, 5);
			Administry.progress("#progress3", 2, 5);

			/* flot graphs */
			var sales = [
					{
						label : 'Total Paid',
						data : [ [ 1, 0 ], [ 2, 0 ], [ 3, 0 ], [ 4, 0 ],
								[ 5, 0 ], [ 6, 0 ], [ 7, 900 ], [ 8, 0 ],
								[ 9, 0 ], [ 10, 0 ], [ 11, 0 ], [ 12, 0 ] ]
					},
					{
						label : 'Total Due',
						data : [ [ 1, 0 ], [ 2, 0 ], [ 3, 0 ], [ 4, 0 ],
								[ 5, 0 ], [ 6, 422.10 ], [ 7, 0 ], [ 8, 0 ],
								[ 9, 0 ], [ 10, 0 ], [ 11, 0 ], [ 12, 0 ] ]
					} ];

			/*
			 * var plot = $.plot($("#placeholder"), sales, { bars: { show: true,
			 * lineWidth: 1 }, legend: { position: "nw" }, xaxis: { ticks: [[1,
			 * "Jan"], [2, "Feb"], [3, "Mar"], [4, "Apr"], [5, "May"], [6,
			 * "Jun"], [7, "Jul"], [8, "Aug"], [9, "Sep"], [10, "Oct"], [11,
			 * "Nov"], [12, "Dec"]] }, yaxis: { min: 0, max: 1000 }, grid: {
			 * color: "#666" }, colors: ["#0a0", "#f00"] });
			 */
			$("#tabs, #tabs2").tabs();

			// propose username by combining first- and lastname
			$("#username").focus(function() {
				var firstname = $("#firstname").val();
				var lastname = $("#lastname").val();
				if (firstname && lastname && !this.value) {
					this.value = firstname + "." + lastname;
				}
			});

			// html textbox editor
			$('.wysiwyg').wysiwyg({
				controls : {
					strikeThrough : {
						visible : true
					},
					underline : {
						visible : true
					},

					justifyLeft : {
						visible : true
					},
					justifyCenter : {
						visible : true
					},
					justifyRight : {
						visible : true
					},
					justifyFull : {
						visible : true
					},

					indent : {
						visible : true
					},
					outdent : {
						visible : true
					},

					subscript : {
						visible : true
					},
					superscript : {
						visible : true
					},

					undo : {
						visible : true
					},
					redo : {
						visible : true
					},

					insertOrderedList : {
						visible : true
					},
					insertUnorderedList : {
						visible : true
					},
					insertHorizontalRule : {
						visible : true
					},

					h4 : {
						visible : true,
						className : 'h4',
						command : $.browser.msie ? 'formatBlock' : 'heading',
						arguments : [ $.browser.msie ? '<h4>' : 'h4' ],
						tags : [ 'h4' ],
						tooltip : 'Header 4'
					},
					h5 : {
						visible : true,
						className : 'h5',
						command : $.browser.msie ? 'formatBlock' : 'heading',
						arguments : [ $.browser.msie ? '<h5>' : 'h5' ],
						tags : [ 'h5' ],
						tooltip : 'Header 5'
					},
					h6 : {
						visible : true,
						className : 'h6',
						command : $.browser.msie ? 'formatBlock' : 'heading',
						arguments : [ $.browser.msie ? '<h6>' : 'h6' ],
						tags : [ 'h6' ],
						tooltip : 'Header 6'
					},

					cut : {
						visible : true
					},
					copy : {
						visible : true
					},
					paste : {
						visible : true
					},
					html : {
						visible : true
					}
				}
			});

			// date input fallback check
			Administry.dateInput('.datepick');

			var user_card = $(".card, .card *").mouseover(function() {
				$(this).find("#box-icon-toolbar").show();
			}).mouseout(function() {
				$(this).find("#box-icon-toolbar").hide();
			});
			
			// EDIT / VISUALIZE RESUME
			var edit_resume = $("#edit-resume").click(function() {
				$("a.nyroModal").show();
				$(this).parent().find("a#visu-resume").css('background', '#eee');
				$('data-resume-*').attr('contenteditable', true);
			});
			var visu_resume = $("#visu-resume").click(function() {
				$("a.nyroModal").hide();
				$('data-resume-*').removeAttr('contenteditable');
			});
			
			// SHOW / HIDE ELEMENT
			$(".showHide").toggle(function() {
				$(this).parent().find(".showHideArea").show('fade');
			}, function() {
				$(this).parent().find(".showHideArea").hide('fade');
			});
			
			// SHOW / HIDE SETTINGS
			$(".setting-link").toggle(function() {
				$(this).parents(".setting").find(".show").hide('fade');
				$(this).parents(".setting").find(".form").show('fade');
				
			}, function() {
				$(this).parents(".setting").find(".form").hide('fade');
				$(this).parents(".setting").find(".show").show('fade');
				
			});
			
			$(".ui-slider").slider();
			
			
		});

// toggle disable input named 'disable-elem'
$(function() {
	enable_cb();
	$(".disabled").click(enable_cb);
});

function enable_cb() {
	if (this.checked) {
		$("input.disable-elem").attr("disabled", true);
	} else {
		$("input.disable-elem").removeAttr("disabled");
	}
}

// validate form on keyup and submit
function formValidator() {
	$(".form-validator")
			.validate(
					{
						invalidHandler : function(form, validator) {
							var errors = validator.numberOfInvalids();
							if (errors) {
								var message = errors == 1 ? 'You missed 1 field. It has been highlighted'
										: 'You missed '
												+ errors
												+ ' fields. They have been highlighted';
								$("div.error span").html(message);
								$("div.error").show();
							} else {
								$("div.error").hide();
							}
						},
						rules : {
							titlenews : {
								required : true,
								minlength : 5
							},
							title : "required",
							industry : "required",
							job_title : "required",
							job : "required",
							country : "required",
							firm_name : "required",
							firstname : "required",
							lastname : "required",
							begin_date : "required",
							username : {
								required : true,
								minlength : 2
							},
							password : {
								required : true,
								minlength : 5
							},
							password_confirm : {
								required : true,
								minlength : 5,
								equalTo : "#password"
							},
							email : {
								required : true,
								email : true
							},
							dateformat : "required",
							terms : "required"
						},
						messages : {
							titlenews : {
								required : "Enter a title",
								minlength : jQuery
										.format("Enter at least {0} characters")
							},
							begin_date : "Select a begin date",
							firm_name : "Provide a Firm name",
							job_title : "Write a job title",
							title : "You must provide a title",
							country : "Select your country",
							job : "Select your job",
							description : "Provide a description",
							industry : "Write an industry",
							description : "Provide a description",
							firstname : "Enter your firstname",
							lastname : "Enter your lastname",
							username : {
								required : "Enter a username",
								minlength : jQuery
										.format("Enter at least {0} characters")
							},
							password : {
								required : "Provide a password",
								rangelength : jQuery
										.format("Enter at least {0} characters")
							},
							password_confirm : {
								required : "Repeat your password",
								minlength : jQuery
										.format("Enter at least {0} characters"),
								equalTo : "Enter the same password as above"
							},
							email : {
								required : "Please enter a valid email address",
								minlength : "Please enter a valid email address"
							},
							dateformat : "Choose your preferred dateformat",
							terms : " "
						},
						// the errorPlacement has to take the
						// layout into account
						errorPlacement : function(error, element) {
							error.insertAfter(element.parent().find(
									'label:first'));
						},
						// specifying a submitHandler prevents
						// the default submit, good for the demo
						submitHandler : function() {
							alert("Data submitted!");
						},
						// set new class to error-labels to
						// indicate valid fields
						success : function(label) {
							// set &nbsp; as text for IE
							label.html("&nbsp;").addClass("ok");
						}
					});
}
