<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $metas; ?>
<title><?php echo $title; ?></title>
<?php echo $css; ?>
<?php echo $js; ?>
<script> 
$(document).ready(function(){
    $.tools.validator.fn("#username", function(input, value) {
        return value!='Username' ? true : {     
            en: "Please complete this mandatory field"
        };
    });
    
    $.tools.validator.fn("#password", function(input, value) {
        return value!='Password' ? true : {     
            en: "Please complete this mandatory field"
        };
    });

    $("#form").validator({ 
    	position: 'top', 
    	offset: [25, 10],
    	messageClass:'form-error',
    	message: '<div><em/></div>' // em element is the arrow
    }).attr('novalidate', 'novalidate');
});
</script> 


</head>
<body class="login">
    <?php echo $content; ?>
    <?php echo $widgets; ?>
</body>
</html>