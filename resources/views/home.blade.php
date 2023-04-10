@extends('layouts.app')
@section('content')

<div class="container">
<h3>Selamat Datang, <b>{{auth()->user()->name}}</b></h3>
<p>Hari ini tanggal @php echo date('d F Y')  @endphp</p>
</div>

@php
    $data = App\Pengaduan::count();
    $data1 = App\Pengaduan::where('status',1)->count();
    $data2 = App\Pengaduan::where('status',2)->count();
    $data3 = App\Pengaduan::where('status',3)->count();
@endphp


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="row">
                <div class="col-sm-3">
                    <a href="">
                        <article class="statistic-box red">
                            <div>
                                <div class="number">{{$data}}</div>
                                <div class="caption"><div><b>Total Pengaduan</b></div></div>
                            </div>
                        </article>
                    </a>
                </div><!--.col-->
                <div class="col-sm-3">
                    <a href="">
                        <article class="statistic-box purple">
                            <div>
                                <div class="number">{{$data1}}</div>
                                <div class="caption"><div><b>Menunggu Konfirmasi</b></div></div>
                            </div>
                        </article>
                    </a>
                </div><!--.col-->
                <div class="col-sm-3">
                    <a href="">
                        <article class="statistic-box yellow">
                            <div>
                                <div class="number">{{$data2}}</div>
                                <div class="caption"><div><b>Pengaduan Ditolak</b></div></div>
                            </div>
                        </article>
                    </a>
                </div><!--.col-->
                <div class="col-sm-3">
                    <a href="">
                        <article class="statistic-box green">
                            <div>
                                <div class="number">{{$data3}}</div>
                                <div class="caption"><div><b>Pengaduan Diproses</b></div></div>
                            </div>
                        </article>
                    </a>
                </div><!--.col-->
            </div>
        </div>
    </div>
</div>
@endsection
