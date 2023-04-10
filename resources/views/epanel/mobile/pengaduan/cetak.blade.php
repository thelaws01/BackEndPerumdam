<!DOCTYPE html>
<html>
<head>
	<title>Laporan Peneriamaan Pengaduan</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style type="text/css">
        @import url( 'https://fonts.googleapis.com/css?family=Arial' );
        body{
        font-family: 'Arial', cursive;
        size: cover;
        }
        tr.spaceUnder>td {
			  padding-bottom: 0.5em;
			}
    </style>

	</style>
</head>
<body>

	<div class="container">
		<div class="content">
			<div class="row">
				<div class="col-md-12 text-center">
					<h4>PERUMDAM TIRTA KENCANA SAMARINDA</h4>
					<!--<p style="margin-top: -10px;">POLSEK TENGGARONG SEBRANG</p>-->
					<p style="margin-top: -10px">Jl. Tirta Kencana No. 1, Kec. Samarinda Ulu, Kota Samarinda</p>
					<img src="https://perumdamtirtakencana.id/sites/images/logo-page.png" height="80" style="margin-top: -10px;">

					<p style="margin-top: 10px;"><b><u>SURAT TANDA PENERIMAAN LAPORAN / PENGADUAN</b></u></p>
				</div>
			</div>
    @foreach($data as $temp)
			<table>
						<tr class="spaceUnder">
							<td>
								Keterangan Pelapor di bawah ini : 
							</td>
						</tr>
						<tr class="spaceUnder">
							<td colspan="1">
								Nama 
							</td>
							<td>
								: {{optional($temp->member)->nama}}
							</td>
						</tr>
						<tr class="spaceUnder">
							<td colspan="1">
								Alamat 
							</td>
							<td>
								: {{optional($temp->member)->alamat}}
							</td>
						</tr>
						<tr class="spaceUnder">
							<td>
								No. Handphone 
							</td>
							<td>
								: {{optional($temp->member)->phone}}
							</td>
						</tr>
						<tr class="spaceUnder">
							<td>
								Tanggal Kejadian
							</td>
							<td>
								: {{date('d F Y', strtotime($temp->created_at))}}
							</td>
						</tr>
						<tr class="spaceUnder">
							<td>
								Melaporkan Tentang
							</td>
							<td>
								: {{optional($temp->kategori)->label}}
							</td>
						</tr>
						<!--<tr class="spaceUnder">-->
						<!--	<td>-->
						<!--		Bentuk Perbuatan-->
						<!--	</td>-->
						<!--	<td>-->
						<!--		: {{$temp->bentuk}}-->
						<!--	</td>-->
						<!--</tr>-->
						<tr class="spaceUnder">
							<td>
								Lokasi Kejadian
							</td>
							<td>
								: {{$temp->alamat}}
							</td>
						</tr>
						<!--<tr class="spaceUnder">-->
						<!--	<td>-->
						<!--		Saksi Di Tempat Kejadian-->
						<!--	</td>-->
						<!--	<td>-->
						<!--		: {{$temp->saksi}}-->
						<!--	</td>-->
						<!--</tr>-->
						<!--<tr class="spaceUnder">-->
						<!--	<td>-->
						<!--		Kerugian Korban-->
						<!--	</td>-->
						<!--	<td>-->
						<!--		: {{$temp->kerugian}}-->
						<!--	</td>-->
						<!--</tr>-->
						<!--<tr class="spaceUnder">-->
						<!--	<td>-->
						<!--		Identitas Lengkap Pelapor-->
						<!--	</td>-->
						<!--	<td>-->
						<!--		: <img src="{{asset(optional($temp->member)->foto)}}" width="600" height="300"/>-->
						<!--	</td>-->
						<!--</tr>-->
					</table>
    @endforeach
			<p style="margin-top: 50px;">Surata Tanda Penerimaan Laporan / Pengaduan ini di perlukan untuk : <b>Tindak Lanjut Pengaduan</b></p>
			<p>Demikian surat keterangan tanda penerimaan laporan / pengaduan ini agar dapat di pergunakan seperlunya</p>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>