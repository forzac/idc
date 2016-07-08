$( document ).ready(function() {
    $('.new').click(function() {
        $('.form').append('<input type="text" name="email" class="form-control newinput"/>');
    });
    $('.send').click(function() {
        var data = jQuery.param($('.form').serializeArray());
        var result = data.replace(/%40/g,"@");
        var final = result.replace(/email=/g,"");
        console.log(final);
        var arr = final.split('&');
        console.log(arr);
        $.ajax({
            url:"/ajax",
            method: "POST",
            data: {name: arr},
            dataType: 'json',
            success:function(data){
                console.log(data);
                window.location.reload();
                //window.location.href = "/admin/products"
            }
        });
    });
});