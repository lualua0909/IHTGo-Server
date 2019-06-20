<!DOCTYPE html>
<html lang="">
<body>
<table>
    <thead>
    <tr>
        <td colspan="13" style="text-align: center"><h1 style="color: yellow">BÁO CÁO THEO DÕI THU TIỀN CÔNG TY</h1></td>
    </tr>
    </thead>
</table>
<table>
    <tr>
        <th>Từ Ngày: </th>
        <td>{{ $start }}</td>
    </tr>
    <tr>
        <th>Đến Ngày: </th>
        <td>{{ $end }}</td>
    </tr>
</table>
<table>
    <thead>
    <tr style="background-color: #0B90C4">
        <th>STT</th>
        <th>Tên Công Ty</th>
        <th>Địa Chỉ</th>
        <th>Quận - Huyện</th>
        <th>Tỉnh - Thành Phố</th>
        <th>Phí</th>
    </tr>
    </thead>
    <tbody>
    @foreach($listResult as $k => $value)
        <tr>
            <td>{{ $k + 1 }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->address }}</td>
            <td>{{ $value->district }}</td>
            <td>{{ $value->province }}</td>
            <td>{{ $value->money }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>