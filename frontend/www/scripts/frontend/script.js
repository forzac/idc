$(function() {
	//$("#slide").ulslide({
	//statusbar: true,
	//effect: {
	//	type: "crossfade" // slide or fade
	//},
	//    duration: 600,
	//autoslide: 3000
	//});

	//

	$("ul#drop-accont-menu > li > a").on('click', (function(e) {
		e.preventDefault();
		var account_menu_id = $(this).attr('id');
		var accord = $("dl.accordion-tabs > dt");

		$.each(accord, function(i, val){
			var dt_id = $(this).attr('id') ;
			if(dt_id == account_menu_id){
				$(this).attr('class','accordion__title active');
				var dd = $(this).next('dd');
				$(this).next('dd').attr('class', 'accordion__content active').attr('style','display:block');
				$(this).siblings('dt').attr('class', 'accordion__title');
				dd.siblings('dd').attr('style','display:none');
				var form = $('form');
				$.each(form, function(i, val){
					val.reset();
				});
			}
		});

	}));

	if($(window).width() > 768){

		// Hide all but first tab content on larger viewports
		$('.accordion__content:not(:first)').hide();

		// Activate first tab
		$('.accordion__title:first-child').addClass('active');

	} else {

		// Hide all content items on narrow viewports
		$('.accordion__content').hide();
	};

	// Wrap a div around content to create a scrolling container which we're going to use on narrow viewports
	$( ".accordion__content" ).wrapInner( "<div class='overflow-scrolling'></div>" );

	// The clicking action
	$('.accordion__title').on('click', function() {
		$('.accordion__content').hide();
		$(this).next().show().prev().addClass('active').siblings().removeClass('active');
	});

	// accordion
	var allPanels = $('.accordion > dd').hide();

	$('.accordion > dt > a').click(function() {
		allPanels.slideUp();
		$(this).parent().next().slideDown();

		return false;
	});

	// hide flash alert
	$('div.alert').fadeOut(3000);

	var emailOptions = $("#emailnotif > input[type='checkbox']");
	chekedInput(emailOptions);
	var confidentiality = $("#confidentiality > input[type='checkbox']");
	chekedInput(confidentiality);

	// mask for phone number
	if ($('#phone').length) {
		$('#phone').mask('+38 (099) 999-99-99');
	}
	//$('#social a' ).click(function(e){
	//	e.preventDefault();
	//	window.open($(this).attr('href'), 'a', "width=800,height=400");
	//});
});

function chekedInput($obj)
{
	$.each($obj, function(i, val){
		var attrData = ($(this).attr('data'));
		if(attrData == 1)
		{
			$(this).attr('checked', 'checked');
		}
	});
}
			function alertHide(){
				$('.alert').hide(300);
			}
			setTimeout(alertHide, 2000);

			function windowRef(url)
			{
				window.location = url;
			}






