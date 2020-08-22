//collapsing menu left
$('.menu-collapse').click( function(){
   let collapseElement = $('.collapseElement');
   let side = $('.side');
   let main = $('.main');
   let navigationMenu = $('.navigation-menu');
   let sideMenu = $('.side-menu');
   let sideMenuItem = $('.side-menu-item');
   let button = $(this);
   let userIcon = $('.fa-user');
      if(!button.hasClass('collapsed')){
      //open menu

      side.css("flex","10%");
      navigationMenu.css("padding-left", "10px");
      main.css("flex","85%");
      //remove class and show elements
      collapseElement.show();
      sideMenu.addClass('j-c-between');
      sideMenu.removeClass('justify-content-center');
      sideMenuItem.removeClass('center-centered');
      userIcon.removeClass('ml-2');
      button.addClass('collapsed');

   }
   else{
      //close menu
      collapseElement.hide();
      button.removeClass('collapsed');
      sideMenu.removeClass('j-c-between');
      sideMenu.addClass('justify-content-center');
      sideMenuItem.addClass('center-centered')
      userIcon.addClass('ml-2');
   //resize div
      side.css("flex","1%");
      navigationMenu.css("padding-left", "5px");
      main.css("flex","92%");
   }
});
// mobile menu
$('.mobile-menu-button').click(function()
{
   let button = $(this);
   let mobileMenu = $('.mobile-menu');
   if(button.hasClass('collapsed')){

   button.removeClass('collapsed');
   mobileMenu.animate({"left":"0px"}, 1000);

   }
   else{

      button.addClass('collapsed');
      mobileMenu.animate({"left":"-150px"}, 1000);

   }
 });
