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
                <h3>Buat Pengaduan</h3>
                <p>Lengkapi Form di bawah untuk Menambah Data Pengaduan</p>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{route('pengaduan.index')}}" class="btn btn-md btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <br>
    <div class="card body" style="padding: 10px;">
        <form method="post" action="{{route('pengaduan.store')}}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-12">
                        <div class="form-group">
                            <label class="label">Member</label>
                            <select name="member_id" class="form-control">
                                @php $member = App\Member::all(); @endphp
                                @foreach($member as $temp)
                                <option value="{{$temp->id}}">{{$temp->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label">Kategori Pelaporan</label>
                            <select name="kategori_id" class="form-control">
                                @php $kategori = App\Kategori::all(); @endphp
                                @foreach($kategori as $temp)
                                <option value="{{$temp->id}}">{{$temp->label}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label">Nama Terlapor</label>
                            <input type="text" name="nama" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Lokasi Kejadian</label>
                            <input type="text" name="alamat" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Tanggal Kejadian</label>
                            <input id="input"  name="hari" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Bentuk Perbuatan</label>
                            <input id="input"  name="bentuk" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Saksi Kejadian</label>
                            <input id="input"  name="saksi" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Kerugian yang di Alami</label>
                            <input id="input"  name="kerugian" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Informasi Tambahan (Bila Ada)</label>
                            <input id="input"  name="info" class="form-control">
                        </div>
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