jQuery(window).load(function() {
  function hidePreloader() {
    jQuery('.preloader').fadeOut(500);
    jQuery('html').css("cssText", "overflow: visible !important;");
  }
  setTimeout( hidePreloader, 1500); 
});