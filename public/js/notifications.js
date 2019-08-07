var timeOutId = 0;
var getNotification = function (url, count, show) {
    console.log('notification');
    var html = '';
    $.ajax({
        url: url,
        success: function (response) {
            var countResponse = response.notifications.length;

            $.each( response.notifications, function( key, value ) {
                html = html +
                    '<li onclick="readNotification(this)" data-id="' + value.id + '" data-url="' + value.url + '">' +
                    '    <a href="#">' +
                    '      <p>' + value.content + '</p>' +
                    '    </a>' +
                    '</li>';
            });
            $('.' + count).html(countResponse)
            $('#' + show).html(html);
        }
    });
}
// ajaxFn();
// //OR use BELOW line to wait 10 secs before first call
// timeOutId = setTimeout(ajaxFn, 10000);

var storeNotification = function (url, type, content, to_id = null) {
    $.ajax({
        url: '/api/v1/notification',
        type : 'POST',
        data: {url: url, content: content, type: type, to_id: to_id},
        success: function (response) {
            console.log(response);
        }
    });
}

var readNotification = function (element) {
    var id = element.getAttribute('data-id');
    $.ajax({
        url: BASE_URL + '/api/v1/notification/read/' + id,
        success: function (response) {
            console.log(response);
            if (response.status === 200){
                window.location.href = element.getAttribute('data-url');
            }
        }
    });
}