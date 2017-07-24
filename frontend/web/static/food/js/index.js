$(document).ready(function() {
     $(".accordion").on('click',function() {
          $(".accordion-desc").not($(this).next()).slideUp('fast');
          $(this).next().slideToggle(400);
     });
});