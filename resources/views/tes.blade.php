<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

	@foreach($p as $q)
	<p>naam : {{ $q->nama }}</p>
	@if(isset($q->persyaratan['p_gaji_berkala']))
	@foreach($q->persyaratan['p_gaji_berkala'] as $s)
	<p>{{ $s }}</p>
	@endforeach
	<hr>
	@endif
	@endforeach 
</body>
</html>