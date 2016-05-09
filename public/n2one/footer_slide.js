jQuery(function($) {
		var open = true;
		$('#footerSlideButton').click(function () {
			if(open === true) {
				$('#footerSlideContent').animate({ height: '0px' });
				//$(this).css('backgroundPosition', 'bottom left');
				open = false;
			} 
			else {
				$('#footerSlideContent').animate({ height: '50px'});
				//$(this).css('backgroundPosition', 'top left');
				open = true;
			}
		});		
	});