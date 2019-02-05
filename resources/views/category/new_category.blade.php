@extends('layouts.master_admin') 

{{-- thay đổi nội dung phần content --}}
@section('content')
<div class="container box box-body pad">
	<div class="row">
		<div class="col-xs-9">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Create a new category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					
					<div class="form-group">

						<input name="name" type="text" class="form-control" id="getName" placeholder="Name"><br>

						<input name="parent_id" type="text" class="form-control" id="getParentId" placeholder="Parent Id"><br>

						<input name="image" type="file" class="form-control" id="image" placeholder="Image"><br>
						
						<textarea name="description" type="text" class="form-control" id="getDescription" placeholder="Description" rows="10" cols="80"></textarea><br>

							{{-- <script>
								CKEDITOR.replace('description');
							</script> --}}

							<button type="button" class="btn btn-success btn-save" >Save</button>
							
							<a href="/admin/category" class="btn btn-danger">Back</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-3">
		</div>
	</div>
	
	
	<script type="text/javascript">
		$('.btn-save').click(function(){
			
			var form_data = new FormData();
			form_data.append("_token", '{{csrf_token()}}');
			form_data.append("name", $('#getName').val());
			form_data.append("parent_id", $('#getParentId').val());
			form_data.append('thumbnail', $('input[type=file]')[0].files[0]); 
			form_data.append("description", $('#getDescription').val());
			
			$.ajax({
				type : 'post',
				url : '/admin/category',
				data : form_data,
				contentType: false,
				processData: false,
				success : function(response){
					tosatr.success("Insert Successfully!");
				}
			});

			setTimeout(function () {
				window.location.href="/admin/category";
			},800);
		});
	</script>
	@endsection