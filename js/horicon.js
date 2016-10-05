// Copyright 2016: Bissen


	// This function loops through a set of DIVs and displays their contents by sliding them on and off screen.  
	// Edge case 1:  User chooses a slide, keep timer from changing it right away.
	// Edge case 2:  User chooses a slide in the middle of an animation.
	//
	// Another solution is via margins:  http://csscience.com/responsiveslidercss3/
	function nextSlide(index) 
	{
		// Grab the slide that's currently in the center of the screen
		var $active = $('#slides .slideIntoView');
	   
		var $next;
	    if (index == null)
		{
			// Find the next slide, check that we're not at the end of the list, if we are, go back to the first element.	  
			$next = ($active.next().length > 0) ? $active.next() : $('#slides .slide').first();	 

			// Update the quick links
			pos = $next.parent().children().index($next);
			$('#links a').removeClass('current').eq(pos).addClass('current');
			
	   	} 
		else
		{			
			$next = $('#slides .slide').eq(index);
			
			// Update the quick links
			$('#links a').removeClass('current').eq(index).addClass('current');
						
			//Stop the timer and Start it back again.
			clearInterval(timer);
			timer = setInterval( function() { nextSlide(); }, slide_interval );	
			
		}
		
		// Update the css
	    $active.removeClass('slideIntoView').addClass('slideOutOfView'); 		   
		$next.addClass('slideIntoView'); 				
	}
	
		
	/* THE FOLLOWING CODE USES GSAP FOR SEQUENCING ANIMATIONS */
	
	// Animate the first slide of Testimonials.
	function AnimateTestimonialsOne() {
		var review1 = $("#testimonial_1"),
			review2 = $("#testimonial_2"),
			review3 = $("#testimonial_3");
				
		var ts1 = new TimelineMax();
		
		// Slide the first set of testimonials onto the screen from Left to Right.
		ts1.from(review1, 1.5, {x: "-1100px", autoAlpha: 0}, "TS1")
		.from(review2, 1.5, {x: "-1000px", autoAlpha: 0}, "TS1")
		.from(review3, 1.5, {x: "-1200px", autoAlpha: 0}, "TS1");
		
		// Slowly scroll the testimonials across the screen at differing speeds.
		ts1.to(review1, 6, {ease: Power0.easeNone, x: "40px"}, "TS2")
		.to(review2, 6, {ease: Power0.easeNone, x: "20px"}, "TS2")
		.to(review3, 6, {ease: Power0.easeNone, x: "60px"}, "TS2");
		
		// Whisk the testimonials off the screen. 
		ts1.to(review1, 1.5, {x: "-1000px", autoAlpha: 0}, "TS3")
		.to(review2, 1.5, {x: "1000px", autoAlpha: 0}, "TS3")
		.to(review3, 1.5, {x: "-1000px", autoAlpha: 0}, "TS3");
		return ts1;
	}	
	
	// Animate the second set of testimonials.
	function AnimateTestimonialsTwo() {
		var review4 = $("#testimonial_4");		
		
		var ts2 = new TimelineMax();
		ts2.from(review4, 0.5, {ease: Power0.easeNone, autoAlpha:0})
		.to(review4, 1.5, {ease: SlowMo.ease.config(0.7, 0.7, false), autoAlpha:1.0})
		.to(review4, 15, {autoAlpha:1.0})
		.to(review4, 3, {ease: Power0.easeNone, x: "2000px", autoAlpha:0.0});
		return ts2;
	}		
		
	
	
	
	
	
	