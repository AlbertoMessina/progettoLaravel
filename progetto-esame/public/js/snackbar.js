function operationSuccessShow(){
      let snackbar = $('.snackbar');
      snackbar.addClass("operationSuccess");
      $('.snackbar i').addClass('fas fa-check mr-1');
      $('.snackbar span').text('Operation Success')
      setTimeout(function(){snackbar.removeClass("operationSuccess")}, 2500);
}

function operationFailedShow(){
      let snackbar = $('.snackbar');
      snackbar.addClass("operationFailed");
      $('.snackbar i').addClass('fas fa-exclamation-triangle mr-1');
      $('.snackbar span').text('Operation Failed');
      setTimeout(function(){snackbar.removeClass("operationFailed")}, 2500);
}
