@extends('layouts.master_admin') 

{{-- thay đổi nội dung phần content --}}
@section('content')
<div class="container box box-body pad">
	<div class="row">
		<div class="col-xs-9">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Create a new tag</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<form>
						@csrf
						<div class="form-group">

							<input name="name" type="text" class="form-control" id="getName" placeholder="Name"><br>

							<button type="button" class="btn btn-success btn-save" >Save</button>
							
							<a href="/admin/tag" class="btn btn-danger">Back</a>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-xs-3">
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.btn-save').click(function(){
		$.ajax({
			type : 'post',
			url : '/admin/tag',
			data : {
				_token : $('[name="_token"]').val(),
				id : $('#getId').val(),
				name : $('#getName').val()
			},
			success : function(response){
				tosatr.success("Insert Successfully!");
			}
		});

		setTimeout(function () {
			window.location.href="/admin/tag";
		},500);
	});
</script>
@endsection