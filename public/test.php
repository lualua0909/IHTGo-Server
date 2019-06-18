<?php
// khởi tạo với URL là `https://xxx/api/info`
$ch = curl_init("https://xxx/api/info");

// cấu hình kết nối
curl_setopt_array($ch, array(
    // phương thức `POST`
    CURLOPT_CUSTOMREQUEST => 'POST',
    // header
    CURLOPT_HTTPHEADER    => array(
        'Content-type: application/json; charset=utf-8',
        'XXX-key: 35036708522-6826-28-623525727927929276276222',
        'XXX-signature: gaaJLJLFJ=323r=+3252sfaHLlqajlaJ',
        'XXX-timestamp: 2015-06-28 19:07:10',
    ),
    // lấy dữ liệu trả về dạng text
    CURLOPT_RETURNTRANSFER => true,
    // dữ liệu `POST`
    CURLOPT_POSTFIELDS => '{"name":"dominhhai","pass":"xxx-xxx-xxx"}'
));

// file log `curl.log` nằm tại thư mục relative là `../tmp/`
$fp = fopen('/tmp/curl.log', 'a');

// cho phép `curl` xuất thông tin về kết nối
curl_setopt($ch, CURLOPT_VERBOSE, true);
// xuất thông tin lỗi ra file log
curl_setopt($ch, CURLOPT_STDERR, $fp);

// thực thi kết nối
$result = curl_exec($ch);

// đóng kết nối
curl_close($ch);
// đóng file log
fclose($fp);

// in thông tin kết quả trả về
var_dump($result);