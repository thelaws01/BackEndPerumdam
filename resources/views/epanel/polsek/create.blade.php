@extends('layouts.app')
@section('content')
 <link data-require="leaflet@0.7.3" data-semver="0.7.3" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 text-left">
                <h3>Buat Polsek</h3>
                <p>Lengkapi Form di bawah untuk Menambah Data Polsek</p>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{route('polsek.index')}}" class="btn btn-md btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <br>
    <div class="card body" style="padding: 10px;">
        <form method="post" action="{{route('polsek.store')}}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <input type="hidden" id="longitude" name="longitude" class="form-control" required="">
            <input type="hidden" id="latitude" name="latitude" class="form-control" required="">
            <div class="row justify-content-center">
                <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Nama</label>
                            <input type="text" name="nama" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Phone</label>
                            <input type="number" name="phone" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Photo</label>
                            <input type="file" name="photo" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Admin Polsek</label>
                            <select name="user_id" class="form-control">
                                @php $user = App\User::where('akses_id', 2)->get(); @endphp
                                @foreach($user as $temp)
                                <option value="{{$temp->id}}">{{$temp->name}}</option>
                                @endforeach
                            </select>
                        </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div id="leaflet"></div>
                    </div>
                    <script data-require="leaflet@0.7.3" data-semver="0.7.3" src="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>
<style>
    #leaflet { 
        height: 415px; 
        
    }
</style>

<script>
    var map = L.map('leaflet').setView([-0.4851843544086842, 117.139309309423], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    
    }).addTo(map);

    var customPopup = "<br/>";
    
    // specify popup options 
    var customOptions =
        {
        'maxWidth': '500',
        'className' : 'custom'
        }

    var marker = L.marker([-0.4851843544086842, 117.139309309423],{
        draggable: true
    }).addTo(map);

    marker.on('dragend', function (e) {
          document.getElementById('latitude').value = marker.getLatLng().lat;
          document.getElementById('longitude').value = marker.getLatLng().lng;
    });


</script>
                    <div class="form-group">
                            <button type="submit" class="btn btn-md btn-warning">Simpan Data</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection