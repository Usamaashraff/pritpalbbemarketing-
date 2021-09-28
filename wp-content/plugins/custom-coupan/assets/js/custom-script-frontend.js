
jQuery(document).ready(function($){
    $('.coupon-form').on('submit',function(e){
        e.preventDefault(); 
        var form = $(this);
        valuee=form.find('.coupon-field').val();
        var url = my_ajax_object.ajax_url; 
        $.ajax({
            type: "POST",
            url: url,
            data:  {action: "coupon_check", data : valuee}, 
            success: function(data){
                console.log(data);
            }
        });
    })
  })
