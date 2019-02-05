@extends('layouts.master_admin') 

{{-- thay đổi nội dung phần content --}}
@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Data Table With Category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<a href="/admin/new/category" data-toggle="modal" class="btn btn-success btn-add">New Category</a>
					<table id="example1" class="table table-bordered table-striped" style="margin-top : 10px;">
						<thead>
							<tr>
								<th class="col-sm-2">Name</th>
								<th class="col-sm-2">Slug</th>
								<th class="col-sm-2">Thumbnail</th>
								<th class="col-sm-2">Descriptions</th>
								<th class="col-sm-4">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($categories as $value)
							<tr>
								<td class="col-sm-2">{{$value->name}}</td>
								<td class="col-sm-2">{{$value->slug}}</td>
								<td class="col-sm-2">
									<img style="width: 100%; height: 100px;" src="{{url('storage/uploads/'.$value->thumbnail)}}" alt="">
								</td>
								<td class="col-sm-2">{{substr($value->description, 0, 60).' ...'}}</td>
								<td class="col-sm-4">
									<button data-id="{{$value->id}}" type="button" class="btn btn-primary btn-show">
										<i class="glyphicon glyphicon-eye-open"></i>
									</button>

									<button data-id="{{$value->id}}" type="button" class="btn btn-warning btn-edit" >
										<i class="glyphicon glyphicon-edit"></i>
									</button>

									<button data-id="{{$value->id}}" type="button" class="btn btn-danger btn-delete">
										<i class="glyphicon glyphicon-trash"></i>
									</button>
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th class="col-sm-2">Name</th>
								<th class="col-sm-2">Slug</th>
								<th class="col-sm-2">Thumbnail</th>
								<th class="col-sm-2">Descriptions</th>
								<th class="col-sm-4">Action</th>
							</tr>
						</tfoot>
					</table>

					{{$categories->links()}}
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<!-- modal view -->
	<div class="col-xs-12">
		<div class="modal fade" id="showCategory" tabindex="-1" role="dialog" aria-labelledby="formCategory" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Category Information : </h4>
					</div>
					<form action="" id="">
						@csrf
						<div class="modal-body">
							<input name="name" type="text" class="form-control" id="showName" placeholder="Name" disabled><br>

							<input name="parent_id" type="text" class="form-control" id="showParentId" placeholder="Parent Id" disabled><br>

							<div style="text-align: center;">
								<img src="" name="thumbnail" id="showThumbnail" alt="" style="width: 100px; height:100px; ">
								<br>
							</div>

							<input name="slug" type="text" class="form-control" id="showSlug" placeholder="Slug" style="margin-top: 15px;" disabled><br>

							<textarea name="description" type="text" class="form-control" id="showDescription" placeholder="Description" rows="5" cols="10" disabled></textarea><br>

							<input name="created_at" type="text" class="form-control" id="showCreatedAt" placeholder="Created At" disabled><br>

							<input name="updated_at" type="text" class="form-control" id="showUpdatedAt" placeholder="Updated At" disabled><br>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- modal edit -->
	<div class="col-xs-12">
		<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="formCategory" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Update Information : </h4>
					</div>
					
					<div class="modal-body">
						@csrf
						<input name="id" type="hidden" class="form-control" id="editID" placeholder="ID"><br>

						<input name="name" type="text" class="form-control" id="editName" placeholder="Name"><br>

						<input name="parent_id" type="text" class="form-control" id="editParentId" placeholder="Parent Id"><br>

						<div style="text-align: center;">
							<img src="" name="img_thumbnail" id="Thumbnail" alt="" style="width: 100px; height:100px; ">
							<br>
						</div>

						<input name="thumbnail" type="file" class="form-control" id="editThumbnail" placeholder="Image" style="margin-top: 15px;"><br>

						<input name="slug" type="text" class="form-control" id="editSlug" placeholder="Slug" disabled><br>

						<textarea name="description" type="text" class="form-control" id="editDescription" placeholder="Description" rows="5" cols="10"></textarea><br>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-success btn-update" data-dismiss="modal">Update</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
					
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		// show
		$('.btn-show').click(function(){
			var id = $(this).attr('data-id');
			$.ajax({
				type : "get",
				url : "/admin/category/" + id,
				data : {
					_token :$('[name="_token"]').val(),
				},
				success : function(response){
					$('#showName').val(response.name),
					$('#showParentId').val(response.parent_id),
					$('#showThumbnail').attr('src', '/storage/uploads/'+response.thumbnail),
					$('#showSlug').val(response.slug),
					$('#showDescription').val(response.description),
					$('#showCreatedAt').val(response.created_at),
					$('#showUpdatedAt').val(response.updated_at)
				}
			});

			$('#showCategory').modal('show');
		});

		$('.btn-edit').click(function(){
			var id = $(this).attr('data-id');
			$.ajax({
				type : "get",
				url : "/admin/category/" + id,
				data : {
					_token :$('[name="_token"]').val(),
				},
				success : function(response){
					$('#editID').val(response.id),
					$('#editName').val(response.name),
					$('#editParentId').val(response.parent_id),
					$('#Thumbnail').attr('src', '/storage/uploads/'+response.thumbnail),
					$('#editSlug').val(response.slug),
					$('#editDescription').val(response.description)
				}
			});

			$('#editCategory').modal('show');
		});
		
		$('.btn-update').click(function(){
			var category_id = $('#editID').val();
			var form_data = new FormData();
			form_data.append("_token", '{{csrf_token()}}');
			form_data.append("id", $('#editID').val());
			form_data.append("name", $('#editName').val());
			form_data.append("parent_id", $('#editParentId').val());
			form_data.append('thumbnail', $('input[type=file]')[0].files[0]); 
			form_data.append("description", $('#editDescription').val());

			$.ajax({
				type : 'post',
				url : '/admin/update_category',
				data : form_data,
				contentType: false,
				processData: false,
				success : function(response){
					tosatr.success("Insert Successfully!");
				}
			});

			$('#editCategory').modal('hide');

			setTimeout(function () {
				window.location.href="/admin/category/";
			},1000); 
		});

		// delete
		$('.btn-delete').click(function(){
			if(confirm('Bạn có muốn xóa không?')){
				var _this = $(this);
				var id = $(this).attr('data-id');
				$.ajax({
					type: 'delete',
					url: '/admin/category/' + id,
					data:{
						_token : $('[name="_token"]').val(),
					},
					success: function(response){
						_this.parent().parent().remove();
					}
				})
			}
		});
	</script>

</section>
<!-- /.content -->
@endsection