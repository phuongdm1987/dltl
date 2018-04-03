$(function() {
	// Check event to scroll window is top > 1500 to display
   $(window).scroll(function(){
      if ($(this).scrollTop() > 800) {
         $('.scrollToTop').fadeIn();
      } else {
         $('.scrollToTop').fadeOut();
      }
   });

   //Click event to scroll to top
   $('.scrollToTop').click(function(){
      $('html, body').animate({ scrollTop : 0 }, 500);
      return false;
   });
});