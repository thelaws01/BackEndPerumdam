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
        @foreach($data as $temp)
        <form method="post" action="{{route('polsek.update', $temp->id)}}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" id="longitude" name="longitude" value="{{$temp->longitude}}" class="form-control" required="">
            <input type="hidden" id="latitude" name="latitude" value="{{$temp->latitude}}" class="form-control" required="">
            <div class="row justify-content-center">
                <div class="col-md-12">
                        <div class="form-group">
                            <label class="label">Nama</label>
                            <input type="text" value="{{$temp->nama}}" name="nama" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Alamat</label>
                            <input type="text" value="{{$temp->alamat}}" name="alamat" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Phone</label>
                            <input type="number" value="{{$temp->phone}}" name="phone" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Photo</label>
                            <input type="file" value="{{$temp->photo}}" name="photo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="label">Admin Polsek</label>
                            <select name="user_id" class="form-control">
                                <option value="{{$temp->id}}">{{optional($temp->users)->name}}</option>
                                @php $user = App\User::where('akses_id', 2)->get(); @endphp
                                @foreach($user as $temp)
                                <option value="{{$temp->id}}">{{$temp->name}}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="form-group text-right">
                            <button type="submit" class="btn btn-md btn-warning">Ubah Data</button>
                        </div>
                </div>

            </div>
        </form>
        @endforeach
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