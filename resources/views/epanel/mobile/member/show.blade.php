@extends('layouts.app')
@section('css')
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@stop
@section('js')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
@stop
@section('content')


<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 text-left">
                <h3>Detail Masyarakat</h3>
                <p>Data Lengkap Masyarakat yang tersimpan di dalama Database.</p>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{route('member.index')}}" class="btn btn-md btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <br>
    <div class="card body" style="padding: 10px;">
        @foreach($data as $temp)
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h3>Informasi Member</h3>
                        <div class="form-group">
                            <label class="label">Nama</label>
                            <input type="text" value="{{$temp->nama}}" class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                            <label class="label">Nik</label>
                            <input type="text" value="{{$temp->nik}}" class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                            <label class="label">Alamat</label>
                            <input type="text" value="{{$temp->alamat}}"class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                            <label class="label">Phone</label>
                            <input type="text" value="{{$temp->phone}}"class="form-control" readonly="">
                        </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                            <label class="label">Foto</label>
                                    <div class="fileinput-new thumbnail" style="width: 300px; height: 245px;">
                                        <a href="{{asset($temp->foto)}}" data-lity><img id="blah" src="{{asset($temp->foto)}}" alt="....." style="width: 290px; height: 244px;" /></a>
                                    </div>      
                    </div>
                    <div class="form-group">
                            <label class="label">Kelurahan</label>
                            @switch($temp->ttl)
                            @case("0")
                            <input type="text" value="Karang Mumus"class="form-control" readonly="">
                            @break
                            @case("1")
                            <input type="text" value="Bugis"class="form-control" readonly="">
                            @break
                            @case("2")
                            <input type="text" value="Pasar Pagi"class="form-control" readonly="">
                            @break
                            @case("3")
                            <input type="text" value="Pelabuhan"class="form-control" readonly="">
                            @break
                            @case("4")
                            <input type="text" value="Sungai Pinang Luar"class="form-control" readonly="">
                            @break
                            @endswitch
                        </div>
                </div>
                <div class="col-md-12">
                    <h3>Login Member</h3>
                    <div class="form-group">
                            <label class="label">Username</label>
                            <input type="text" value="{{$temp->username}}" class="form-control" readonly="">
                    </div>
                    <div class="form-group">
                            <label class="label">Password</label>
                            <input type="text" value="{{$temp->plain}}" class="form-control" readonly="">
                    </div>
                </div>
            </div>  
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