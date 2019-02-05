<!doctype html>
<html lang="en">
<head>
	{{-- thay đổi nội dung phần title --}}
	<title>
		@if(isset($title))
		{{$title}}
		@else
		Hoàng Ngọc Ánh
		@endif
	</title>
	<link rel="shortcut icon" type="image" href="{{asset('blog/images/admin-hoang-ngoc-anh.jpg')}}" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700" rel="stylesheet">

	<link rel="stylesheet" href="{{asset('blog/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('blog/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('blog/css/owl.carousel.min.css')}}">

	<link rel="stylesheet" href="{{asset('blog/fonts/ionicons/css/ionicons.min.css')}}">
	<link rel="stylesheet" href="{{asset('blog/fonts/fontawesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('blog/fonts/flaticon/font/flaticon.css')}}">

	<!-- Theme Style -->
	<link rel="stylesheet" href="{{asset('blog/css/style.css')}}">
</head>
<body>
	<header role="banner">
		<div class="top-bar">
			<div class="container">
				<div class="row">
					<div class="col-9">
						<a href="{{asset('/')}}">
							<img style="max-width: 150px; max-height: 50px;" src="{{asset('blog/images/logo.png')}}" alt="Image Placeholder" class="img-fluid">
						</a>
					</div>
					<div class="col-3 search-top">
						
					</div>
				</div>
			</div>
		</div>

		<div class="container logo-wrap">
			<div class="row pt-2">
				<div class="col-12 text-center">
					<a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
				</div>
			</div>
		</div>

		<nav class="navbar navbar-expand-md  navbar-light bg-light">
			<div class="container">
				<div class="collapse navbar-collapse" id="navbarMenu" style="margin-top: 10px;">
					<ul class="navbar-nav mx-auto">
						<li class="nav-item">
							<a class="nav-link active" href="{{asset('/')}}">Trang chủ</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="contact.html">Tin tức</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="category.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Môn học</a>
							<div class="dropdown-menu" aria-labelledby="dropdown04">
								@if(isset($categories))
								@foreach($categories as $value)
								<a class="dropdown-item" href="/categories/{{$value->slug}}">{{$value->name}}</a>
								@endforeach
								@endif
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="category.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Đề cương ôn tập</a>
							<div class="dropdown-menu" aria-labelledby="dropdown04">
								<a class="dropdown-item" href="category.html">Asia</a>
								<a class="dropdown-item" href="category.html">Europe</a>
								<a class="dropdown-item" href="category.html">Dubai</a>
								<a class="dropdown-item" href="category.html">Africa</a>
								<a class="dropdown-item" href="category.html">South America</a>
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="category.html" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Đề thi</a>
							<div class="dropdown-menu" aria-labelledby="dropdown05">
								<a class="dropdown-item" href="category.html">Lifestyle</a>
								<a class="dropdown-item" href="category.html">Food</a>
							</div>

						</li>
						<li class="nav-item">
							<a class="nav-link" href="/about/details">Về tôi</a>
						</li>
					</ul>

				</div>
				</div
			</nav>
		</header>
		<!-- END header -->

		<section class="pt-5">
			<div class="container">
				<div class="row">
					@yield('slides')
				</div>
				<div class="row">
					@yield('new_posts')
				</div>
			</div>
		</section>
		<!-- END section -->

		<section class="site-section py-sm">
			<div class="container">
				<div class="row blog-entries">
					<div class="col-md-12 col-lg-8 main-content">
						@yield('post_list')
					</div>
					<div class="col-md-12 col-lg-4 sidebar">
						<div class="sidebar-box search-form-wrap">
							<form id="form-search" action="" method="" class="search-form">
								<div class="form-group">
									<span class="icon fa fa-search"></span>
									<input name="key" type="search" class="form-control" id="key" placeholder="Tìm kiếm ...">
								</div>
							</form>
						</div>

						<!-- END sidebar-box -->
						<div class="sidebar-box">
							<div class="bio text-center">
								<img src="{{asset('blog/images/admin-hoang-ngoc-anh.jpg')}}" alt="Image Placeholder" class="img-fluid">
								<div class="bio-body">
									<h2>Ánh Hoàng</h2>
									<h3>PTIT</h3>
									<p></p>
									<p><a href="https://www.facebook.com/HoangNgocAnh.HUST" class="btn btn-primary btn-sm">Facebook</a></p>
									<p class="social">
										<a target="_blank" href="https://www.facebook.com/HoangNgocAnh.HUST" class="p-2"><span class="fa fa-facebook"></span></a>
										<a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
										<a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
										<a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
									</p>
								</div>
							</div>
						</div>
						<!-- END sidebar-box -->  
						<div class="sidebar-box">
							<h3 class="heading">Bài viết nổi bật</h3>
							<div class="post-entry-sidebar">
								<ul>
									@if(isset($popular_posts))
									@foreach($popular_posts as $value)
									<li>
										<a href="/{{$value->slug}}" title="{{$value->title}}">
											<img src="{{url('storage/uploads/'.$value->thumbnail)}}" alt="Image placeholder" class="mr-3">
											<div class="text">
												<h4>{{$value->title}}</h4>
												<div class="post-meta">
													<span class="mr-2">{{Carbon\Carbon::parse($value->created_at)->toFormattedDateString()}}</span> &bullet;
													<span class="ml-2"><span class="fa fa-eye"></span> {{$value->view_count}}</span>
												</div>
											</div>
										</a>
									</li>
									@endforeach
									@endif
								</ul>
							</div>
						</div>
						<!-- END sidebar-box -->

						<div class="sidebar-box">
							<h3 class="heading">Môn học</h3>
							<ul class="categories">
								@if(isset($categories))
								@foreach($categories as $value)
								<li><a href="/categories/{{$value->slug}}">{{$value->name}} <span>({{$value->countPost()}})</span></a></li>
								@endforeach
								@endif
							</ul>
						</div>
						<!-- END sidebar-box -->

						<div class="sidebar-box">
							<h3 class="heading">Tags</h3>
							<ul class="tags">
								@if(isset($popular_tags))
								@foreach($popular_tags as $value)
								<li><a href="/tags/{{$value->slug}}">{{$value->name}}</a></li>
								@endforeach
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>

		<footer class="site-footer">
			<div class="container">
				<div class="row mb-5">
					<div class="col-md-4">
						<h3>Liên hệ chúng tôi</h3>
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.6776562923856!2d105.84127411432367!3d21.00555458601095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac76ccab6dd7%3A0x55e92a5b07a97d03!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBCw6FjaCBraG9hIEjDoCBO4buZaQ!5e0!3m2!1svi!2s!4v1547388484149" frameborder="0" style="border:0" allowfullscreen></iframe>

						<p style="font-size: 13px; margin-top: 10px;">Số 1 Đại Cồ Việt, Trường Đại học Bách Khoa, Hai Bà Trưng, Hà Nội, Việt Nam</p>
						<p style="font-size: 13px;">Hotline: 0981 248 920 </p>
						<p style="font-size: 13px;">Hỗ trợ: gieomamsusong@gmail.com</p>
					</div>
					<div class="col-md-6 ml-auto">
						<div class="row">
							<div class="col-md-7">
								<h3>Bài viết gần đây</h3>
								<div class="post-entry-sidebar">
									<ul>
										@if(isset($new_posts))
										@foreach($new_posts as $value)
										<li>
											<a href="/{{$value->slug}}" title="{{$value->title}}">
												<img src="{{'/storage/uploads/'.$value->thumbnail}}" alt="Image placeholder" class="mr-4">
												<div class="text">
													<h4>{{$value->title}}</h4>
													<div class="post-meta">
														<span class="mr-2">{{Carbon\Carbon::parse($value->created_at)->toFormattedDateString()}}</span> &bullet;
														<span class="ml-2"><span class="fa fa-eye"></span> {{$value->view_count}}</span>
													</div>
												</div>
											</a>
										</li>										
										@endforeach
										@endif
									</ul>
								</div>
							</div>
							<div class="col-md-1"></div>

							<div class="col-md-4">

								<div class="mb-5">
									<h3>Liên kết</h3>
									<ul class="list-unstyled">
										<li><a href="#">ShareVideo5s</a></li>
										<li><a href="#">Top</a></li>
										<li><a href="#">Code Win</a></li>
										<li><a href="#">Quà tặng cuộc sống</a></li>
									</ul>
								</div>

								<div class="mb-5">
									<h3>Kết nối</h3>
									<ul class="list-unstyled footer-social">
										<li><a href="https://www.facebook.com/HoangNgocAnh.HUST" target="_blank"><span class="fa fa-facebook"></span> Facebook</a></li>
										<li><a href="#"><span class="fa fa-instagram"></span> Instagram</a></li>
										<li><a href="#"><span class="fa fa-youtube-play"></span> Youtube</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="" target="">Ánh Hoàng</a> <i class="fa fa-heart-o" aria-hidden="true"></i><a href="" target=""> Hoàng Ánh</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</div>
				</div>
			</div>
		</footer>
		<!-- END footer -->

		<!-- loader -->
		<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

		<script src="{{asset('blog/js/jquery-3.2.1.min.js')}}"></script>
		<script src="{{asset('blog/js/jquery-migrate-3.0.0.js')}}"></script>
		<script src="{{asset('blog/js/popper.min.js')}}"></script>
		<script src="{{asset('blog/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('blog/js/owl.carousel.min.js')}}"></script>
		<script src="{{asset('blog/js/jquery.waypoints.min.js')}}"></script>
		<script src="{{asset('blog/js/jquery.stellar.min.js')}}"></script>


		<script src="{{asset('blog/js/main.js')}}"></script>

		<script type="text/javascript">
			$('#form-search').submit(function(e){
				e.preventDefault();
				var str = $('#key').val();
				if(str.length > 1){
					// Gộp nhiều dấu space thành 1 space
					str = str.replace(/\s+/g, ' ');
					// loại bỏ toàn bộ dấu space (nếu có) ở 2 đầu của xâu
					str.trim();
					str = str.replace(/ /g, '+');
					key = str.replace(/[!@#$%^&*()_\-=\[\]{};':"\\|,.<>\/?]/ig, "+"); 

					setTimeout(function () {
						window.location.href="/search/"+key;
					},500);
				}
			})
		</script>
	</body>
	</html>