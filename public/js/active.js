var loc = window.location.pathname;
   $('#nav-menu').find('a').each(function() {
     $(this).toggleClass('page-active', $(this).attr('href') == loc);
  });

// $(function() {
//     $('#nav-menu a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
//   });