$("#menu-toggle").click(function(e) {
   e.defaultPrevented;
  $("#sidebarMenu").toggleClass("d-none");
  // $("#main").toggleClass("col-md-9 ml-sm-auto col-lg-12");
  return false;
});
$('.sidebar-heading span.fa.fa-plus-circle').click( function(e) {
  e.defaultPrevented;
  var parent = $(this).parents('h6');
  var next = $(parent).next();
  $("#sidebarMenu .menuExpandIcon").addClass('d-none');
  $(next).toggleClass('d-none');
  return false;
});
    //  $("#menu-toggle-2").click(function(e) {
    //     e.preventDefault();
    //     $("#wrapper").toggleClass("toggled-2");
    //     $('#menu ul').hide();
    // });
 
    //  function initMenu() {
    //   $('.menuExpandIcon').children('.current').parent().show();
    //   //$('#menu ul:first').show();
    //   $('.menuExpandIcon').click(
    //     function() {
    //       var checkElement = $(this).parent();
    //       alert( checkElement );
    //       if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    //         return false;
    //         }
    //       if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    //         $('#menu ul:visible').slideUp('normal');
    //         checkElement.slideDown('normal');
    //         return false;
    //         }
    //       }
    //     );
    //   }
    // $(document).ready(function() {initMenu();});