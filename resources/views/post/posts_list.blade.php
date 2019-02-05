@extends('layouts.master_admin') 

{{-- thay đổi nội dung phần content --}}
@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Data Table With Post</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<a href="/admin/new/post" data-toggle="modal" class="btn btn-success btn-add">New Post</a>
					<table id="example1" class="table table-bordered table-striped" style="margin-top : 10px;">
						<thead>
							<tr>
								<th class="col-sm-1">#</th>
								<th class="col-sm-1">Title</th>
								<th class="col-sm-2">Thumbnail</th>
								<th class="col-sm-1">Category</th>
								<th class="col-sm-2">Poster</th>
								<th class="col-sm-1">View</th>
								<th class="col-sm-4">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($posts as $value)
							<tr>
								<td class="col-sm-1">{{$value->id}}</td>
								<td class="col-sm-1">{{$value->title}}</td>
								<td class="col-sm-2">
									<div style="text-align: center;">
										<img style="width: 100%; height: 100px;" src="{{url('/storage/uploads/'.$value->thumbnail)}}" alt="">
									</div>
								</td>
								<td class="col-sm-1">{{$value->category_id}}</td>
								<td class="col-sm-2">{{$value->user_id}}</td>
								<td class="col-sm-1">{{$value->view_count}}</td>
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
								<th class="col-sm-1">#</th>
								<th class="col-sm-1">Title</th>
								<th class="col-sm-2">Thumbnail</th>
								<th class="col-sm-1">Category</th>
								<th class="col-sm-2">Poster</th>
								<th class="col-sm-1">View</th>
								<th class="col-sm-4">Action</th>
							</tr>
						</tfoot>
					</table>

					{{$posts->links()}}
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
		<div class="modal fade" id="showPost" tabindex="-1" role="dialog" aria-labelledby="formPost" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Information : </h4>
					</div>
					<form action="" id="">
						@csrf
						<div class="modal-body">
							<input name="id" type="text" class="form-control" id="showId" placeholder="Id" disabled><br>

							<input name="title" type="text" class="form-control" id="showTitle" placeholder="title" disabled><br>

							<input name="slug" type="text" class="form-control" id="showSlug" placeholder="Slug" disabled><br>

							<input name="created_at" type="text" class="form-control" id="showCreatedAt" placeholder="Created At" disabled><br>

							<input name="updated_at" type="text" class="form-control" id="showUpdatedAt" placeholder="Updated At" disabled><br>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-success btn-single" data-dismiss="modal">Single Blog</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- modal edit -->
	<div class="col-xs-12">
		<div class="modal fade" id="editTag" tabindex="-1" role="dialog" aria-labelledby="formPost" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Update Information : </h4>
					</div>
					<form action="" id="formEditPost">
						@csrf
						<div class="modal-body">
							<input name="id" type="text" class="form-control" id="editID" placeholder="ID"><br>

							<input name="title" type="text" class="form-control" id="editTitle" placeholder="Title"><br>

							<input name="slug" type="text" class="form-control" id="editSlug" placeholder="Slug"><br>
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-success btn-update" data-dismiss="modal">Update</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</form>
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
				url : "/admin/post/" + id,
				data : {
					_token :$('[name="_token"]').val(),
				},
				success : function(response){
					$('#showId').val(response.id),
					$('#showTitle').val(response.title),
					$('#showSlug').val(response.slug),
					$('#showCreatedAt').val(response.created_at),
					$('#showUpdatedAt').val(response.updated_at)
				}
			});

			$('#showPost').modal('show');
		});

		// btn-single
		$('.btn-single').click(function(){
			var slug = $('#showSlug').val();
			$.ajax({
				type : "get",
				url : "/detail/" + slug,
				data : {
					_token :$('[name="_token"]').val(),
				},
				success : function(response){
					
				}
			});

			$('#showPost').modal('show');
		});

		$('.btn-edit').click(function(){
			var id = $(this).attr('data-id');
			$.ajax({
				type : "get",
				url : "/admin/post/" + id,
				data : {
					_token :$('[name="_token"]').val(),
				},
				success : function(response){
					$('#editID').val(response.id),
					$('#editTitle').val(response.title),
					$('#editSlug').val(response.slug)
				}
			});

			$('#editTag').modal('show');
		});
		
		$('.btn-update').click(function(){
			var id = $(this).attr('data-id');
			$.ajax({
				type: 'put',
				url: '/admin/post/' + id,
				data:{
					_token :$('[name="_token"]').val(),
					id : $('#editID').val(),
					title : $('#editTitle').val(),
					slug : $('#editSlug').val()
				},
				success: function(response){
					toastr.success('Update Successfully!');
				}
			});

			$('#editPost').modal('hide');

			setTimeout(function () {
				window.location.href="/admin/post/";
			},500);
		});

		// delete
		$('.btn-delete').click(function(){
			if(confirm('Bạn có muốn xóa không?')){
				var _this = $(this);
				var id = $(this).attr('data-id');
				$.ajax({
					type: 'delete',
					url: '/admin/post/' + id,
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