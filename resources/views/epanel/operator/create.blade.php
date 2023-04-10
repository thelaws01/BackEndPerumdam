@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 text-left">
                <h3>Buat Jabatan</h3>
                <p>Lengkapi Form di bawah untuk Menambah Data Jabatan</p>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{route('operator.index')}}" class="btn btn-md btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <br>
    <div class="card body" style="padding: 10px;">
        <form method="post" action="{{route('operator.store')}}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-12">
                        <div class="form-group">
                            <label class="label">Nama</label>
                            <input type="text" name="name" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Username</label>
                            <input type="text" name="email" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">KTP</label>
                            <input type="file" name="foto" class="form-control" accept="image/*" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Password</label>
                            <input type="password" name="password" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="label">Confrim Password</label>
                            <input type="password" name="repassword" class="form-control" required="">
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