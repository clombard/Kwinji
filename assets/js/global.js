
// HTML5 placeholder plugin version 0.3
// Enables cross-browser* html5 placeholder for inputs, by first testing
// for a native implementation before building one.
//
// USAGE: 
//$('input[placeholder]').placeholder();

(function($){
  
  $.fn.placeholder = function(options) {
    return this.each(function() {
      if ( !("placeholder"  in document.createElement(this.tagName.toLowerCase()))) {
        var $this = $(this);
        var placeholder = $this.attr('placeholder');
        $this.val(placeholder).data('color', $this.css('color')).css('color', '#aaa');
        $this
          .focus(function(){ if ($.trim($this.val())===placeholder){ $this.val('').css('color', $this.data('color')); } })
          .blur(function(){ if (!$.trim($this.val())){ $this.val(placeholder).data('color', $this.css('color')).css('color', '#aaa'); } });
      }
    });
  };
}(jQuery));


var menuYloc = null;
var previewYloc = null;

// perform JavaScript after the document is scriptable.
$(document).ready(function() {

    /**
     * Setup Tooltips
     */
    // this set's up the sidebar tooltip for the recent contacts
    $('.recent .contact').tooltip({
        position: 'center right', // position it to the right
        effect: 'slide', // add a slide effect
        offset: [30,15], // adjust the position 30 pixels to the top and 19 pixels to the left
        onBeforeShow: function() {
            this.getTip().appendTo('body');
        }
    });

    $('[title]').tooltip({effect: 'slide', offset: [-14, 0]});

    // html element for the help popup
    $('body').append('<div class="apple_overlay black" id="overlay"><iframe class="contentWrap" style="width: 100%; height: 500px"></iframe></div>');

    // this is the help popup
    $("a.help[rel]").overlay({

        effect: 'apple',

        onBeforeLoad: function() {

            // grab wrapper element inside content
            var wrap = this.getOverlay().find(".contentWrap");

            // load the page specified in the trigger
            wrap.attr('src', this.getTrigger().attr("href"));
        }

    });

    /**
     * Setup Tabs
     */
    $("ul.tabs").tabs("div.panes > section");
    
    /**
     * Setup placeholder for text input
     */
    $('input[placeholder]').placeholder();

    // add close buttons to closeable message boxes
    $(".message.closeable").prepend('<span class="message-close"></span>')
        .find('.message-close')
        .click(function(){
            $(this).parent().fadeOut(function(){$(this).remove();});
        });

    // setup popup balloons (add contact / add task)
    $('.has-popupballoon').click(function(){
        // close all open popup balloons
        $('.popupballoon').fadeOut();
        $(this).next().fadeIn();
        return false;
    });

    $('.popupballoon .close').click(function(){
        $(this).parents('.popupballoon').fadeOut();
    });

    // preview pane setup
    $('.list-view > li').click(function(){
        var url = $(this).find('.more').attr('href');
        if (!$(this).hasClass('current')) {
            $('.preview-pane .preview').animate({left: "-375px"}, 300, function(){
                $(this).animate({left: "-22px"}, 500).html('<img class="ajax-loader" src="http://www.kwinji.com/assets/images/ajax-loader.gif" />').load(url);
            });
        } else {
            $('.preview-pane .preview').animate({left: "-375px"}, 300);
        }
        $(this).toggleClass('current').siblings().removeClass('current');
        return false;
    });
    
    $('.list-view > li a:not(.more)').click(function(e){ e.stopPropagation(); });

    $('.preview-pane .preview .close').live('click', function(){
        $('.preview-pane .preview').animate({left: "-375px"}, 300);
        $('.list-view li').removeClass('current');
        return false;
    });
    // preview pane setup end

    // floating menu and preview pane
    if ($('#wrapper > header').length>0) { menuYloc = parseInt($('#wrapper > header').css("top").substring(0,$('#wrapper > header').css("top").indexOf("px")), 10); }
    if ($('.preview-pane .preview').length>0) { previewYloc = parseInt($('.preview-pane .preview').css("top").substring(0,$('.preview').css("top").indexOf("px")), 10); }
    $(window).scroll(function () {
        var offset = 0;
        if ($('#wrapper > header').length>0) {
            offset = menuYloc+$(document).scrollTop();
            if (!$.browser.msie) { $('#wrapper > header').animate({opacity: ($(document).scrollTop()<=10? 1 : 0.8)}); }
        }
        if ($('.preview-pane .preview').length>0) {
            offset = previewYloc+$(document).scrollTop()+400>=$('.main-section').height()? offset=$('.main-section').height()-400 : previewYloc+$(document).scrollTop();
            $('.preview-pane .preview').animate({top:offset},{duration:500,queue:false});
        }
    });

    if (!$.browser.msie) {
        $('#wrapper > header').hover(
            function(){$(this).animate({opacity: 1});},
            function(){$(this).animate({opacity: ($(document).scrollTop()<=10? 1 : 0.8)});}
        );
    }

    // setup the view switcher
    $('.main-content > header .view-switcher > h2 > a').click(function(){
        $(this).focus().parent().next().fadeIn();
        return false;
    }).blur(function(){
        $(this).parent().next().fadeOut();
        return false;
    });

    // promo closer
    $('#promo .close').click(function(){
        $('#promo').slideUp();
        $('body').removeClass('has-promo');
    });
    
    // ACCORDION VERTICAL
    
    $(".accordion header:not(.add)").click(function() {
    	var options = {};
	    $(this).next('section').toggle('blind', options, 500);
    });

    
    // COMMENT
    $("comment_link").click(function(e) {
    	e.preventDefault();
    	$(this).parent('.newsfeed li').find('.sub_comment_content').toggle();
    });

    
    // NAVIGATION BACK TO TOP
	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});