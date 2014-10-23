/************************************************************************
*************************************************************************
@Name :       	jRating - jQuery Plugin
@Revison :    	2.0
@Date : 		26/01/2011
@Author:     	 Surrel Mickael (www.myjqueryplugins.com - www.msconcept.fr) 
@License :		 Open Source - MIT License : http://www.opensource.org/licenses/mit-license.php
 
**************************************************************************
*************************************************************************/
(function($) {
	$.fn.jRating = function(op) {
		var defaults = {
			/** String vars **/
			bigStarsPath : 'js/jquery/icons/stars.png', // path of the icon stars.png
			smallStarsPath : 'js/jquery/icons/small.png', // path of the icon small.png
			
		
			type : 'big', // can be set to 'small' or 'big'
			
			/** Boolean vars **/
			step:false, // if true,  mouseover binded star by star,
			isDisabled:false,
			
			/** Integer vars **/
			length:22, // number of star to display
			decimalLength : 3, // number of decimals.. Max 3, but you can complete the function 'getNote'
			rateMax : 5, // maximal rate - integer from 0 to 9999 (or more)
			rateInfosX : -45, // relative position in X axis of the info box when mouseover
			rateInfosY : 11, // relative position in Y axis of the info box when mouseover
			
			/** Functions **/
			onSuccess : null,
			onError : null
		}; 
		
		if(this.length>0)
		return this.each(function() {
			var opts = $.extend(defaults, op),    
			newWidth = 0,
			starWidth = 0,
			starHeight = 0,
			bgPath = '';

			if($(this).hasClass('jDisabled') || opts.isDisabled)
				var jDisabled = true;
			else
				var jDisabled = false;

			getStarWidth();
			$(this).height(starHeight);

			var average = parseInt($(this).attr('data').split('_')[0]),
			idBox = parseInt($(this).attr('data').split('_')[1]), // get the id of the box
			widthRatingContainer = starWidth*opts.length, // Width of the Container
			widthColor = average/opts.rateMax*widthRatingContainer, // Width of the color Container
			
			quotient = 
			$('<div>', 
			{
				'class' : 'jRatingColor',
				css:{
					width:widthColor
				}
			}).appendTo($(this)),
			
			average = 
			$('<div>', 
			{
				'class' : 'jRatingAverage',
				css:{
					width:0,
					top:- starHeight
				}
			}).appendTo($(this)),

			 jstar =
			$('<div>', 
			{
				'class' : 'jStar',
				css:{
					width:widthRatingContainer,
					height:starHeight,
					top:- (starHeight*2),
					background: 'url('+bgPath+') repeat-x'
				}
			}).appendTo($(this));

			$(this).css({width: widthRatingContainer,overflow:'hidden',zIndex:1,position:'relative'});

			if(!jDisabled)
			$(this).bind({
				mouseenter : function(e){
					var realOffsetLeft = findRealLeft(this);
					var relativeX = e.pageX - realOffsetLeft;
					var tooltip = 
					$('<p>',{
						'class' : 'jRatingInfos',
						html : getNote(relativeX)+' <span class="maxRate">/ '+opts.rateMax+'</span>',
						css : {
							top: (e.pageY + opts.rateInfosY),
							left: (e.pageX + opts.rateInfosX)
						}
					}).appendTo('body').show();
				},
				mouseover : function(e){
					$(this).css('cursor','pointer');	
				},
				mouseout : function(){
					$(this).css('cursor','default');
					average.width(0);
				},
				mousemove : function(e){
					var realOffsetLeft = findRealLeft(this);
					var relativeX = e.pageX - realOffsetLeft;
					if(opts.step) newWidth = Math.floor(relativeX/starWidth)*starWidth + starWidth;
					else newWidth = relativeX;
					average.width(newWidth);					
					$("p.jRatingInfos")
					.css({
						left: (e.pageX + opts.rateInfosX)
					})
					.html(getNote(newWidth) +' <span class="maxRate">/ '+opts.rateMax+'</span>');
				},
				mouseleave : function(){
					$("p.jRatingInfos").remove();
				},
				click : function(e){

					$(this).unbind('mouseout').css('cursor','default').addClass('jDisabled');
					$("p.jRatingInfos").fadeOut('fast',function(){$(this).remove();});
					e.preventDefault();
					var rate = getNote(newWidth);
					average.width(newWidth);
											//get
						pet_id = $('#rate').val();
						path = $('#path').val();
						$('#rating_value').val(rate);

			///	alert(BaseURL+"site/user/feedback");
				

   		/*	$.ajax(
				{
					type: 'POST',
					url: baseURL+'site/user/feedback',
				data: {"id": pet_id,'rating': rate},
					success: function(data) 
						{
				//location.reload();
				
				//$("#popupCheckId").val('1');
						$("#popup_container").css("display","block");
				}
			
		});*/
//						$.post(BaseURL+"site/user/feedback", { 'ratetsend[]': [rate, pet_id] });
					

						
					/** ONLY FOR THE DEMO, YOU CAN REMOVE THIS CODE **/
						$('.datasSent p').html('<input type="text" value="'+idBox+'" name="rate" id="rate"  /><strong>idBox : </strong>'+idBox+'<br /><input type="text" value="'+rate+'" name="rate1" id="rate1"  /><strong>rate : </strong>'+rate+'<br /><strong>action :</strong> rating');
							//alert('Thank you for your Vote!');
							//location.reload();
												$("#rating_value_Err").html('');

						$('.serverResponse p').html('<strong>Loading...</strong>');
					/** END ONLY FOR THE DEMO **/
						
					$.post(opts.phpPath,{
							idBox : idBox,
							rate : rate,
							action : 'rating'
						},
							'json'
					);
					
				}
			});

			function getNote(relativeX) {
				var noteBrut = parseInt((relativeX*105/widthRatingContainer)*opts.rateMax/100);
				switch(opts.decimalLength) {
					case 1 :
						var note = Math.round(noteBrut*10)/10;
						break;
					case 2 :
						var note = Math.round(noteBrut*100)/100;
						break;
					case 3 :
						var note = Math.round(noteBrut*1000)/1000;
						break;
					default :
						var note = Math.round(noteBrut*1)/1;
				}
				return note;
			};

			function getStarWidth(){
			
				switch(opts.type) {
					case 'small' :
						starWidth = 12; // width of the picture small.png
						starHeight = 10; // height of the picture small.png
						bgPath = opts.smallStarsPath;
					break;
					default :
						starWidth = 25; // width of the picture stars.png
						starHeight = 22; // height of the picture stars.png
						bgPath = opts.bigStarsPath;
				}
				
			};
			
			function findRealLeft(obj) {
			  if( !obj ) return 0;
			  return obj.offsetLeft + findRealLeft( obj.offsetParent );
			};
			
		});

	}
})(jQuery);