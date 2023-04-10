@extends('layouts.app')
@section('content')

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-md-6 text-left">
				<h3>Buat Berita</h3>
				<p>Lengkapi Form di bawah untuk membuat Berita</p>
			</div>
			<div class="col-md-6 text-right">
				<a href="{{route('berita.index')}}" class="btn btn-md btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
			</div>
		</div>
	</div>
	<br>
	<div class="card body" style="padding: 10px;">
		@foreach($data as $temp)
		<form method="post" action="{{route('berita.update', $temp->id)}}" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{$temp->id}}">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6">
						<div class="form-group">
							<label class="label">Judul</label>
							<input type="text" value="{{$temp->judul}}" name="judul" class="form-control">
						</div>
						<div class="form-group">
							<label class="label">Preview</label>
							<input type="text" name="preview" value="{{$temp->preview}}" { class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="label">Foto</label>
							<div class="row">
								<div class="col-md-4">
									<div class="fileinput-new thumbnail" style="width: 170px; height: 130px;">
										<img id="blah" src="{{asset($temp->foto)}}" alt="....." style="width: 190px; height: 120px;" />
									</div>		
								</div>
								<div class="col-md-8">
										<input type="file" onchange="readURL(this);"  name="foto" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<textarea id="summernote" name="detail">
					{!! $temp->kontent !!}
				</textarea>
			</div>

			<div class="col-md-6">
				<button type="submit" class="btn btn-md btn-warning">Simpan Data</button>
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