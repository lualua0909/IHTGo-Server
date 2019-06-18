<!DOCTYPE html>
<html lang="">
	<body>
		<table>
			<thead>
				<tr>
					<th rowspan="6" style="text-align: center">{{ $item->user->name }}</th>
				</tr>
				<tr>
					<th>Địa Chỉ | {{ $item->address }}</th>
				</tr>
				<tr>
					<th>Phone | {{ $item->phone_company }}</th>
				</tr>
				<tr>
					<th>Fax | {{ $item->tax }}</th>
				</tr>
				<tr>
					<th>Email | {{ $item->user->email }}</th>
				</tr>
				<tr>
					<th>PIC | {{ $item->pic }}</th>
				</tr>
			</thead>
		</table>
		<table>
			<thead>
				<tr>
					<td colspan="13" style="text-align: center"><h1 style="color: yellow">BÁO CÁO THEO DÕI THU TIỀN NỢ TỪ KHÁCH HÀNG</h1></td>
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
					<th>Mã NPP</th>
					<th>Tên NPP</th>
					<th>Mã NVGH</th>
					<th>Tên NVGH</th>
					<th>Mã Khách Hàng</th>
					<th>Tên Khách Hàng</th>
					<th>Địa Chỉ Khách Hàng</th>
					{{--<th>Quận</th>--}}
					<th>Ngày Đơn Hàng</th>
					<th>Trạng Thái</th>
					<th>Số Đơn Hàng</th>
					<th>Số Tiền Đơn Hàng</th>
					<th>Số Tiền Đã Thu</th>
				</tr>
			</thead>
			<tbody>
				@foreach($listResult as $k => $value)
					<tr>
						<td>{{ $k + 1 }}</td>
						<td>{{ $value->npp_code }}</td>
						<td>{{ $value->npp_name }}</td>
						<td>{{ $value->nvgh_code }}</td>
						<td>{{ $value->nvgh_name }}</td>
						<td>{{ $value->customer_code }}</td>
						<td>{{ $value->customer_name }}</td>
						<td>{{ $value->address }}</td>
						{{--<td>Bình Chánh</td>--}}
						<td>{{ $value->created_at }}</td>
						<td>{{ $orderStatus[$value->status] }}</td>
						<td>{{ $value->code }}</td>
						<td>{{ $value->total_price }}</td>
						<td>0</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</body>
</html>