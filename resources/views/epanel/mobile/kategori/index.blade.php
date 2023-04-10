@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8 text-left">
                <h3>List Kategori</h3>
                <p>Berikut adalah data List Kategori yang tersimpan di dalam Database.</p>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{route('kategori.create')}}" class="btn btn-md btn-warning"><i class="fa fa-plus"></i> Tambah</a>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-borderless table-striped" id="table">
                <thead>
                        <th>Label</th>
                        <th>Nilai Bobot</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach($data as $temp)
                <tr>
                <td>{{$temp->label}}</td>
                <td><code>{{$temp->nilai}}</code></td>
                     <td style="white-space: nowrap; width: 1%;">
                                    <div class="btn-toolbar">
                                        <div class="btn-group btn-group-sm">
                                             <a href="{{route('kategori.edit', $temp->id)}}" style="float: none;" class="btn btn-primary">
                                                        <i class="fa fa-pencil"> </i>
                                                        </a>
                                               &nbsp;
                                               <form action="{{ route('kategori.destroy' , $temp->id)}}" method="POST">
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Anda Yakin ?')"><i class="fa fa-trash"></i></button>
                                                            
                                                </form>  
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
} );
});
</script>
@endsection