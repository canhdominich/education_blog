@extends('layouts.master_admin') 

{{-- thay đổi nội dung phần content --}}
@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Data Table With User</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<a href="/new/category" data-toggle="modal" class="btn btn-success btn-add">New Account</a>
					<table id="example1" class="table table-bordered table-striped" style="margin-top : 10px;">
						<thead>
							<tr>
								<th class="col-sm-1">#</th>
								<th class="col-sm-2">Avatar</th>
								<th class="col-sm-2">Username</th>
								<th class="col-sm-2">Email</th>
								<th class="col-sm-1">Active</th>
								<th class="col-sm-4">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $value)
							<tr>
								<td class="col-sm-1">{{$value->id}}</td>
								{{-- <td class="col-sm-2">
									<img style="width: 100%; height: 100px;" src="{{url('storage/uploads/'.$value->thumbnail)}}" alt="">
								</td> --}}
								<td class="col-sm-2">{{$value->username}}</td>
								<td class="col-sm-2">{{$value->username}}</td>
								<td class="col-sm-2">{{$value->email}}</td>
								<td class="col-sm-1">
									@if($value->active == 0)
									No
									@else
									Yes
									@endif
								</td>
								<td class="col-sm-4">
									<button data-id="{{$value->id}}" type="button" class="btn btn-primary btn-show">
										<i class="glyphicon glyphicon-eye-open"></i>
									</button>

									@if($value->active == 0)
									<button data-id="{{$value->id}}" type="button" class="btn btn-warning btn-edit" >
										<i class="fa fa-unlock"></i>
									</button>
									@else
									<button data-id="{{$value->id}}" type="button" class="btn btn-success btn-edit" >
										<i class="fa fa-stop-circle"></i>
									</button>
									@endif

									<button data-id="{{$value->id}}" type="button" class="btn btn-danger btn-delete">
										<i class="fa fa-user-times"></i>
									</button>
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th class="col-sm-1">#</th>
								<th class="col-sm-2">Avatar</th>
								<th class="col-sm-2">Username</th>
								<th class="col-sm-2">Email</th>
								<th class="col-sm-1">Active</th>
								<th class="col-sm-4">Action</th>
							</tr>
						</tfoot>
					</table>

					{{$users->links()}}
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
		<div class="modal fade" id="showUser" tabindex="-1" role="dialog" aria-labelledby="formUser" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">User Information : </h4>
					</div>
					<form action="" id="">
						@csrf
						<div class="modal-body">
							<div style="text-align: center;">
								<img src="" name="avatar" id="showAvatar" alt="" style="width: 100px; height:100px; margin-bottom: 15px;">
								<br>
							</div>

							<input name="name" type="text" class="form-control" id="showName" placeholder="Name" disabled><br>

							<input name="username" type="text" class="form-control" id="showUsername" placeholder="Username" disabled><br>

							<input name="email" type="text" class="form-control" id="showEmail" placeholder="Email" style="margin-top: 15px;" disabled><br>

							<input name="active" type="text" class="form-control" id="showActive" placeholder="Active" style="margin-top: 15px;" disabled><br>

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


	<script type="text/javascript">
		// show
		$('.btn-show').click(function(){
			var id = $(this).attr('data-id');
			$.ajax({
				type : "get",
				url : "/admin/user/" + id,
				data : {
					_token :$('[name="_token"]').val(),
				},
				success : function(response){
					$('#showAvatar').attr('src', '/storage/uploads/'+response.email),
					$('#showName').val(response.name),
					$('#showUsername').val(response.username),
					$('#showEmail').val(response.email),
					$('#showActive').val(response.active),
					$('#showCreatedAt').val(response.created_at),
					$('#showUpdatedAt').val(response.updated_at)
				}
			});

			$('#showUser').modal('show');
		});

		// block or unblock
		$('.btn-edit').click(function(){
			var user_id = $(this).attr('data-id');
			$.ajax({
				type: 'put',
				url: '/admin/user/' + user_id,
				data:{
					_token :$('[name="_token"]').val(),
					id : user_id,
				},
				success: function(response){
					
				}
			});

			// setTimeout(function () {
			// 	window.location.href="/admin/user/";
			// },500);
		});

		// delete
		$('.btn-delete').click(function(){
			if(confirm('Bạn có muốn xóa không?')){
				var _this = $(this);
				var id = $(this).attr('data-id');
				$.ajax({
					type: 'delete',
					url: '/admin/user/' + id,
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