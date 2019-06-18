$( document ).ready(function() {
    changeLanguage();
});

function changeLanguage(){
    $('li.lang').on('click', function(){
        var locale = $(this).attr('data-lang');
        $.ajax({
            url: BASE_URL + '/language',
            type: 'POST',
            data: {locales: locale},
            dataType: 'json',
            success: function(data){

            },
            error: function(data){

            },
            beforeSend: function(){

            },
            complete: function(data){
                window.location.reload(true);
            }
        });
    });
}



//xác nhận xóa dữ liệu
function confirm_delete (msg){
    if(window.confirm(msg)){
        return true;
    }
    return false;
}