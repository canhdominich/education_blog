@extends('layouts.master_detail') 
{{-- thay đổi nội dung phần title --}}
@section('title')
@if(isset($post))
{{$post->title}}
@endif
@endsection
{{-- thay đổi nội dung phần content --}}
@section('content')

@if(isset($post))
<h1 class="mb-4">{{$post->title}}</h1>
<div class="post-meta">
	<span class="category">{{$post->categories->name}}</span>
	<span class="mr-2">{{Carbon\Carbon::parse($post->created_at)->toFormattedDateString()}}</span> &bullet;
	<span class="ml-2"><span class="fa fa-eye"></span> {{$post->view_count}}</span>
</div>

<div class="post-content-body" style="text-align: justify; color: black;">
	<p style="font-weight: bold; color: black; font-size: 13px;"> Đăng bởi : {!! $post->users->name !!} </p>
	{!! $post->content !!}
	<style>
	img{
		width: 100%;
	}
</style>
</div>
@endif
@endsection

@section('suggest_tags')
<div class="sidebar-box">
	@if(isset($tags))
	<h3 class="mb-3">Tags liên quan</h3>
	<ul class="tags">
		@for($i = 0; $i < count($tags); $i++)
		<li>
			<a href="tags/{{$tags[$i][0]['slug']}}">{{$tags[$i][0]['name']}}</a>
		</li>
		@endfor
		@else
		@if(isset($popular_tags))
		<h3 class="mb-3">Tags</h3>
		<ul class="tags">
			@foreach($popular_tags as $value)
			<li>
				<a href="tags/{{$value->slug}}">{{$value->name}}</a>
			</li>
			@endforeach
			@endif
			@endif
		</ul>
	</div>
	<!-- END sidebar -->
	@endsection

	@section('suggest_posts')
	@if(!empty($suggest_posts))
	<div class="row">
		<div class="col-md-12">
			<h3 class="mb-3">Bài viết liên quan</h3>
		</div>
	</div>
	<div class="row">
		@foreach($suggest_posts as $value)
		<div class="col-md-6 col-lg-4">
			<a href="/{{$value->slug}}" class="a-block d-flex align-items-center height-md" style="background-image: url({{'storage/uploads/'.$value->thumbnail}});">
				<div class="text">
					<div class="post-meta">
						<span class="category">{{$value->categories->name}}</span>
						<span class="mr-2">{{Carbon\Carbon::parse($value->created_at)->toFormattedDateString()}}</span> &bullet;
						<span class="ml-2"><span class="fa fa-eye"></span> {{$value->view_count}}</span>
					</div>
					<h3>{{$value->title}}</h3>
				</div>
			</a>
		</div>
		@endforeach
	</div>
	@endif
	@endsection