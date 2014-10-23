/*

Responsive Mobile Menu v1.0
Plugin URI: responsivemobilemenu.com

Author: Sergio Vitov
Author URI: http://xmacros.com

License: CC BY 3.0 http://creativecommons.org/licenses/by/3.0/

*/

function responsiveMobileMenu() {	
		$('.tsgmobilemenu').each(function() {
			
			
			
			$(this).children('ul').addClass('tsg-main-list');	// mark main menu list
			
			
			var $style = $(this).attr('data-menu-style');	// get menu style
				if ( typeof $style == 'undefined' ||  $style == false )
					{
						$(this).addClass('graphite'); // set graphite style if style is not defined
					}
				else {
						$(this).addClass($style);
					}
					
					
			/* 	width of menu list (non-toggled) */
			
			var $width = 0;
				$(this).find('ul li').each(function() {
					$width += $(this).outerWidth();
				});
				
			// if modern browser
			
			if ($.support.leadingWhitespace) {
				$(this).css('max-width' , $width*1.05+'px');
			}
			// 
			else {
				$(this).css('width' , $width*1.05+'px');
			}
		
	 	});
}
function getMobileMenu() {

	/* 	build toggled dropdown menu list */
	
	$('.tsgmobilemenu').each(function() {	
				var menutitle = $(this).attr("data-menu-title");
				if ( menutitle == "" ) {
					menutitle = "Menu";
				}
				else if ( menutitle == undefined ) {
					menutitle = "Menu";
				}
				var $menulist = $(this).children('.tsg-main-list').html();
				var $menucontrols ="<div class='tsg-toggled-controls'><div class='tsg-toggled-title'>" + menutitle + "</div><div class='tsg-button'><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></div></div>";
				$(this).prepend("<div class='tsg-toggled tsg-closed'>"+$menucontrols+"<ul>"+$menulist+"</ul></div>");

		});
}

function adaptMenu() {
	
	/* 	toggle menu on resize */
	
	$('.tsgmobilemenu').each(function() {
			var $width = $(this).css('max-width');
			$width = $width.replace('px', ''); 
			if ( $(this).parent().width() < $width*1.05 ) {
				$(this).children('.tsg-main-list').hide(0);
				$(this).children('.tsg-toggled').show(0);
			}
			else {
				$(this).children('.tsg-main-list').show(0);
				$(this).children('.tsg-toggled').hide(0);
			}
		});
		
}

$(function() {

	 responsiveMobileMenu();
	 getMobileMenu();
	 adaptMenu();
	 
	 /* slide down mobile menu on click */
	 
	 $('.tsg-toggled, .tsg-toggled .tsg-button').click(function(){
	 	if ( $(this).is(".tsg-closed")) {
		 	 $(this).find('ul').stop().show(300);
		 	 $(this).removeClass("tsg-closed");
	 	}
	 	else {
		 	$(this).find('ul').stop().hide(300);
		 	 $(this).addClass("tsg-closed");
	 	}
		
	});	

});
	/* 	hide mobile menu on resize */
$(window).resize(function() {
 	adaptMenu();
});