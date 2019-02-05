@extends('layouts.master_layout') 

{{-- thay đổi nội dung phần danh sach bai viet --}}
@section('post_list')

@if(count($posts) > 0) 

<div class="row mb-5 mt-5">
	<div class="col-md-12">
		@if(isset($posts))
		@foreach($posts as $value)
		<div class="col-md-12 post-entry-horzontal">
			<a href="/{{$value->slug}}">
				<div class="image element-animate"  data-animate-effect="fadeIn" style="background-image: url({{'/storage/uploads/'.$value->thumbnail}});">
					
				</div>
				<span class="text">
					<div class="post-meta">
						<span class="category">{{$value->categories->name}}</span>
						<span class="mr-2">{{Carbon\Carbon::parse($value->created_at)->toFormattedDateString()}}</span> &bullet;
						<span class="ml-2"><span class="fa fa-eye"></span> {{$value->view_count}}</span>
					</div>
					<h2>{{$value->title}}</h2>
				</span>
			</a>
		</div>
		<!-- END post -->
		@endforeach
		@endif
	</div>
	<div class="col-md-12">
		{!! $posts->links('vendor.pagination.default'); !!}
	</div>
</div>
@else
<div class="row mb-5 mt-5">
	<div class="col-md-12">
		<h2 class="mb-4">Không có bài viết nào được tìm thấy</h2>
	</div>
</div>
@endif
@endsection
