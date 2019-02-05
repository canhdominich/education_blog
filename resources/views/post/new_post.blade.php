@extends('layouts.master_admin') 

{{-- thay đổi nội dung phần content --}}
@section('content')
<div class="container box box-body pad">
	<div class="row">
		<div class="col-xs-8">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Create a new post</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<legend></legend>
					<div class="form-group">

						<label for="" style="margin-top: 10px;">Title</label>
						<input type="text" class="form-control" id="getTitle" placeholder="Title">

						<label for="" style="margin-top: 10px;">Description</label>
						<textarea name="description" type="text" class="form-control" id="getDescription" placeholder="Description" rows="10" cols="50"></textarea><br>

						<label for="" style="margin-top: 10px;">Content</label>
						<textarea name="content" id="getContent" rows="20" cols="100">

						</textarea>
						<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
						<script>
							var editor = CKEDITOR.replace( 'content', {
								filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
								filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
								filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
								filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
								filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
								filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
							} );
						</script>
						
					</div>
					<button type="button" class="btn btn-primary btn-save">Submit</button>
				</div>
			</div>
		</div>
		<div class="col-xs-4"> 
			<div class="box">
				<div class="box-header">
					<label for="" style="margin-top: 10px;">Cateogry</label>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<select id="getCategoryId" class="form-control select2" style="width: 100%; margin-top: 0px;">
						@if(isset($categories))
						@foreach($categories as $value)
						<option selected="selected" value="{{$value->id}}">{{$value->name}}</option>
						@endforeach
						@endif
					</select>
				</select>
			</div>

			<div class="box" style="margin-top: 50px;">
				<div class="box-header">
					<label for="" style="margin-top: 10px;">Thumbnail</label>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<input name="thumbnail" type="file" class="form-control" id="getThumbnail" placeholder="Image"><br>
				</div>
			</div>

			<div class="box">
				<div class="box-header">
					<label for="" style="margin-top: 10px;">Tags</label>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<select name="tags[]" id="getTagId" class="form-control select2" style="width: 100%; margin-top: 0px;" multiple="multiple">
						@if(isset($tags))
						@foreach($tags as $value)
						<option selected="selected" value="{{$value->id}}">{{$value->name}}</option>
						@endforeach
						@endif
					</select>
				</select>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	$('.btn-save').click(function(){
		var form_data = new FormData();
		form_data.append("_token", '{{csrf_token()}}');
		form_data.append("title", $('#getTitle').val());
		form_data.append('thumbnail', $('input[type=file]')[0].files[0]); 
		form_data.append("description", $('#getDescription').val());
		form_data.append("content", editor.getData());
		form_data.append("category_id", $('#getCategoryId').val());

		form_data.append("tags", $('select[name="tags[]"]').val());

		$.ajax({
			type : 'post',
			url : '/admin/post',
			data : form_data,
			contentType: false,
			processData: false,
			success : function(response){
				tosatr.success("Insert Successfully!");
			}
		});

		setTimeout(function () {
			window.location.href="/admin/post";
		},1000);
	});
</script>
@endsection