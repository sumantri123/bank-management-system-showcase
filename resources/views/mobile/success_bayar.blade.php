<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Transfer</title>
	<link href="{{asset('html/assets/css/style_bukti_tf.css') }}" rel="stylesheet" id="style">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {            
			line-height:1.5;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
		.heading {
			font-family: Arial, sans-serif;
			font-size: 1.3em;
			margin:0;			
			font-weight:bold;
		}
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 150px;
        }
        .header h1 {
            margin: 10px 0;
            font-size: 24px;
        }
        .details {
            margin-bottom: 10px;
        }
        .details p {
            margin: 5px 0;
        }
        .details p span {
            font-weight: bold;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
        }
		
        .styled-table {
			border-collapse: collapse;
			margin: 10px 0 25px;;
			font-size: 0.9em;			
			font-family: sans-serif;
			min-width: 100%;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);			
		}

		.styled-table thead tr {
			background-color: #009efb;
			color: #ffffff;
			text-align: left;
		}

		.styled-table th
		.styled-table td {
			padding: 12px 15px;
			text-align: left;			
		}

		.styled-table tbody tr {
			border-bottom: 1px solid #dddddd;
		}

		.styled-table tbody tr:nth-of-type(even) {
			background-color: #f3f3f3;
		}

		.styled-table tbody tr:last-of-type {
			border-bottom: 2px solid #009efb;
		}

		.styled-table tbody tr.active-row {
			font-weight: bold;
			color: #009efb;
		}
    </style>
</head>
<body>
	
    <div class="container">		
        <div class="header">
            <img src="{{ asset(Session::get('logoUHW')) }}" style="height:90px; width:auto;" alt="">
            <br><span class="heading">{{$data['header_title']}}</span><br>
            <small>{{$data['transaksi'][0]->dt_record}} <br>No. Transaksi. {{$data['transaksi'][0]->jurnal_no}}</small>
        </div>
        <div class="details">
            {!!$data['data1']!!}           
			<span class="heading"><u>Detail Transaksi</u></span>
            {!!$data['html']!!}
			
			@if(isset($data['data2']))
				{!!$data['data2']!!} 
			@endif
			<span class="heading"><u>Keterangan Transaksi</u></span><br>
            <small>{{Str::title($data['transaksi'][0]->jurnal_keterangan)}}</small>
        </div>
        <div class="footer">            
			<a href="{{Route('homeMobile')}}" target="_self" class="btn btn-default btn-lg">Beranda</a>
			<p>Terima kasih telah menggunakan layanan {{Session::get('nama_bank')}}</p>
        </div>
    </div>
</body>
</html>
