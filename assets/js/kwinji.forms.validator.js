$(document).ready(function() {
	
    // attach calendar to date inputs
    $(":date:not(.datetimepicker)").dateinput({
        format: 'mm/dd/yyyy',
        value: new Date(),
        trigger: false
    });
    
    
	$("input.datepicker").dateinput({ 
		trigger: true,
		format: 'mmmm yyyy',
		yearRange: [-70, 0],
		offset: [3, 0],
		value: ''
	});
	
	$("input.datepicker").bind("onShow onHide", function()  {
		$(this).parent().toggleClass("active"); 
	 });
	
	
	$(":range").rangeinput({ progress: true, precision: 0, step: 5 });
    
    // Regular Expression to test whether the value is valid
    $.tools.validator.fn("[type=time]", "Please supply a valid time", function(input, value) { 
        return (/^\d\d:\d\d$/).test(value);
    });

    $.tools.validator.fn("[data-equals]", "Value not equal with the $1 field", function(input) {
        var name = input.attr("data-equals"),
        field = this.getInputs().filter("[name=" + name + "]"); 
        return input.val() === field.val() ? true : [name]; 
    });
     
    $.tools.validator.fn("[minlength]", function(input, value) {
        var min = input.attr("minlength");
        
        return value.length >= min ? true : {     
            en: "Please provide at least " +min+ " character" + (min > 1 ? "s" : "")
        };
    });
        
    $.tools.validator.localizeFn("[type=time]", {
        en: 'Please supply a valid time'
    });
     
    // Regular Expression to test whether the value is valid
    $.tools.validator.fn("[type=url]", "Please supply a valid URL", function(input, value) { 
        return (/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/).test(value);
    });

	$.tools.validator.fn("[required=required]", function(input, value) {
		var required = input.attr("required");
		
		return (value.length >= 1) ? true : { en: "Please select this Mandatory field", fr: "Vous devez remplir ce champ" };
	});

    // setup the validators
    $(".form").validator({ 
        position: 'left', 
        offset: [25, 10],
        messageClass:'form-error',
        message: '<div><em/></div>' // em element is the arrow
    });

});