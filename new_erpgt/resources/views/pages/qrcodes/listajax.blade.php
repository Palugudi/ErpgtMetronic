@foreach($qrcodes_equipments as $qrcode)
	<img src="{{$qrcode['qrcode']}}" alt="qrcode" style="width:55px;height:55px;margin-left: 35px;margin-bottom: 35px;">
@endforeach
@foreach($qrcodes_keys as $qrcode)
	<img src="{{$qrcode['qrcode']}}" alt="qrcode" style="width:55px;height:55px;margin-left: 35px;margin-bottom: 35px;">
@endforeach 
