$(document).ready(function() {
	$('.nav-trigger').click(function() {		 
		$('.main-content').toggleClass('padding')
		$('.side-nav').toggleClass('visible');
	});
		$('.main-content').click(function() {		 
		$('.main-content').removeClass('padding')
		$('.side-nav').removeClass('visible');
	});
	
$('ul li span').click(function() {
	$(this).parent().find('ul.submenu').toggle('slow');
	$(this).parent().find('i').toggleClass('rotate');
	
});
		
});

	
