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
                <h3>Detail Pengaduan</h3>
                <p>Berikut Detail Data Pengaduan yang tersimpan di Database.</p>
            </div>
            @if(url()->previous() == 'https://masa-depan.website/pengaduan-aduan/selesai')
            <div class="col-md-5 text-right">
                <a href="{{route('pengaduan.selsai')}}" class="btn btn-md btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            @else
            <div class="col-md-5 text-right">
                <a href="{{route('pengaduan.index')}}" class="btn btn-md btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            @endif
            <div class="col-1 text-right">
                                @include('epanel.mobile.pengaduan.top', [
                                          'judul' => '',
                                          'subjudul' => '',
                                          'cetak' => request()->fullUrl() . (request()->has('bulan') ? '&' : '?') . 'purpose=cetak'
                                      ])  
                            </div>
        </div>
    </div>
    <br>
    <div class="card body" style="padding: 10px;">
        @foreach($data as $temp)
            <input type="hidden" name="_method" value="PUT">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h3>Identitas Pelapor</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label">Pelapor</label>
                                <input type="text" class="form-control" name="" readonly="" value="{{optional($temp->member)->nama}}">
                            </div>
                            <div class="form-group">
                                <label class="label">Nik</label>
                                <input type="text" class="form-control" name="" readonly="" value="{{optional($temp->member)->nik}}">
                            </div>
                            <div class="form-group">
                                <label class="label">Nomor Handphone</label>
                                <input type="text" class="form-control" name="" readonly="" value="{{optional($temp->member)->phone}}">
                            </div>
                            <div class="form-group">
                                <label class="label">Alamat Pelapor</label>
                                <input type="text" class="form-control" name="" readonly="" value="{{optional($temp->member)->alamat}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label">Foto</label>
                                <div class="fileinput-new thumbnail" style="width: 300px; height: 200px;">
                                    <a href="{{asset(optional($temp->member)->foto)}}" data-lity><img id="blah" src="{{asset(optional($temp->member)->foto)}}" alt="....." style="width: 290px; height: 190px;" /></a>
                                </div>      
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3>Data Pengaduan</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label">Kategori Pelaporan</label>
                                <input type="text"  class="form-control" readonly="" value="{{optional($temp->kategori)->label}}">
                            </div>
                             <div class="form-group">
                                <label class="label">Informasi Tambahan (Bila Ada)</label>
                                <input value="{{$temp->info}}" class="form-control" readonly="">
                            </div>
                            <!--<div class="form-group">-->
                            <!--    <label class="label">Bentuk Perbuatan</label>-->
                            <!--    <input value="{{$temp->bentuk}}" class="form-control" readonly="">-->
                            <!--</div>-->
                            <!--<div class="form-group">-->
                            <!--    <label class="label">Saksi Kejadian</label>-->
                            <!--    <input class="form-control" value="{{$temp->saksi}}" readonly="">-->
                            <!--</div>-->
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label">Lokasi Kejadian</label>
                                <input type="text" readonly="" value="{{$temp->alamat}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="label">Tanggal Kejadian</label>
                                <input value="{{$temp->hari}}" class="form-control" readonly="">
                            </div>

                            <!--<div class="form-group">-->
                            <!--    <label class="label">Kerugian yang di Alami</label>-->
                            <!--    <input value="{{$temp->kerugian}}" class="form-control" readonly="">-->
                            <!--</div>-->
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label">Lampiran Foto</label>
                                <div class="fileinput-new thumbnail" style="width: 500px; height: 295px;">
                                    <a href="{{asset($temp->foto)}}" data-lity><img id="blah" src="{{asset($temp->foto)}}" alt="....." style="width: 490px; height: 285px;" /></a>
                                </div> 
                            </div>
                        </div>
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