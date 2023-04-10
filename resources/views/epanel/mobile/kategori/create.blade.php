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
                <h3>Buat Kategori</h3>
                <p>Lengkapi Form di bawah untuk Menambah Data Kategori</p>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{route('kategori.index')}}" class="btn btn-md btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <br>
    <div class="card body" style="padding: 10px;">
        <form method="post" action="{{route('kategori.store')}}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-12">
                        <div class="form-group">
                            <label class="label">Label</label>
                            <input type="text" name="label" class="form-control" required="">
                        </div>
                         <div class="form-group">
                            <label class="label">Nilai Bobot</label>
                            <input type="number" name="nilai" class="form-control" required="" min="1">
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