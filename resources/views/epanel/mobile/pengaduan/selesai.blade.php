@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8 text-left">
                <h3>List Pengaduan Selesai / Di Proses</h3>
                <p>Berikut adalah data List Pengaduan Sudah di Proses / Selesai yang tersimpan di dalam Database.</p>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{route('pengaduan.index')}}" class="btn btn-md btn-warning"><i class="fa fa-list"></i> Pengaduan Belum Di Proses</a>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-borderless table-striped" id="table">
                <thead>
                        <th>Pelapor</th>
                        <th>Kategori Pelaporan</th>
                        <th>Waktu Kejadian</th>
                        <th>Waktu Di Proses</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach($data as $temp)
                <tr>
                <td>{{optional($temp->member)->nama}}</li></td>
                <td>{{optional($temp->kategori)->label}}</td>
                <td>{{$temp->created_at}}</td>
                <td>{{$temp->updated_at}}</td>
                     <td style="white-space: nowrap; width: 1%;">
                                    <div class="btn-toolbar">
                                        <div class="btn-group btn-group-sm">
                                            @if($temp['status'] == 2)
                                             <a href="#" style="float: none;" class="btn btn-danger">
                                                        <i class="fa fa-remove"></i> Pengaduan Ditolak
                                            </a>
                                            
                                            &nbsp;
                                               <form action="{{ route('pengaduan.destroy' , $temp['id'])}}" method="POST">
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Anda Yakin ?')"><i class="fa fa-trash"></i></button>
                                                            
                                                </form>  
                                            @elseif($temp['status'] == 3)
                                             <a href="{{route('pengaduan.edit', $temp['id'])}}" style="float: none;" class="btn btn-success">
                                                        <i class="fa fa-check"></i> Pengaduan Diproses
                                             </a>
                                             
                                               &nbsp;
                                               <form action="{{ route('pengaduan.destroy' , $temp['id'])}}" method="POST">
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Anda Yakin ?')"><i class="fa fa-trash"></i></button>
                                                            
                                                </form>  
                                                @elseif($temp['status'] == 4)
                                             <a href="{{route('pengaduan.show', $temp['id'])}}" style="float: none;" class="btn btn-success">
                                                        <i class="fa fa-check"></i> Pengaduan Selesai
                                             </a>
                                             
                                               &nbsp;
                                            
                                               <form action="{{ route('pengaduan.destroy' , $temp['id'])}}" method="POST">
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Anda Yakin ?')"><i class="fa fa-trash"></i></button>
                                                            
                                                </form>  
                                            @else
                                             <a href="{{route('pengaduan.edit', $temp['id'])}}" style="float: none;" class="btn btn-success">
                                                        <i class="fa fa-gear"> </i>
                                                        </a>
                                               &nbsp;
                                               <form action="{{ route('pengaduan.destroy' , $temp['id'])}}" method="POST">
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Anda Yakin ?')"><i class="fa fa-trash"></i></button>
                                                            
                                                </form>  
                                                @endif
                                        </div>
                                    </div>
                           </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

 @endsection
    @section('scripts')
<script>
jQuery(function($) {
      $('#table').DataTable( {
          "ordering": false
} );
});
</script>
@endsection