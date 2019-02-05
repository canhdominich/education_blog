@extends('layouts.master_layout') 
{{-- thay đổi nội dung phần danh sach bai viet --}}
@section('post_list')
@if(isset($posts)) 
<div class="row">
	@foreach($posts as $value)
	<div class="col-md-6">
		<a href="/{{$value->slug}}" class="blog-entry element-animate" data-animate-effect="fadeIn">
			<img src="{{'/storage/uploads/'.$value->thumbnail}}" alt="Image placeholder" style="min-height: 250px;">
			<div class="blog-content-body">
				<div class="post-meta">
					<span class="category">{{$value->categories->name}}</span>
					<span class="mr-2">{{Carbon\Carbon::parse($value->created_at)->toFormattedDateString()}} </span> &bullet;
					<span class="ml-2"><span class="fa fa-eye"></span> {{$value->view_count}}</span>
				</div>
				<h2>{{$value->title}}</h2>
			</div>
		</a>
	</div>
	@endforeach
</div>
<div>
	{!! $posts->links('vendor.pagination.default'); !!}
</div>
@endif
@endsection

