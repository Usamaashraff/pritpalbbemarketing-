
jQuery(document).ready(function($){
  $('.datepicker').datepicker();
  $('.generate_code').on('click',function(){
    $code = makegenerate(4);
    $(this).closest('td').find('#coupon_code').val($code)
   
  })

})
function makegenerate(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * 
 charactersLength));
   }
   return result;
}