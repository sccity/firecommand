@extends('layouts.default', [
	'paceTop' => true,
	'appSidebarHide' => true,
	'appHeaderHide' => true,
	'appContentClass' => 'p-0'
])

@section('title', 'Landing Page')

@push('css')
	<link href="/assets/plugins/lity/dist/lity.min.css" rel="stylesheet" />
@endpush

@push('scripts')
	<script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
	<script src="/assets/plugins/lity/dist/lity.min.js"></script>
@endpush

@section('content')
	<!-- BEGIN #header -->
	<div id="header" class="app-header navbar navbar-expand-lg p-0">
		<div class="container-xxl px-3 px-lg-5 d-flex align-items-center flex-1">
			<button type="button" class="navbar-mobile-toggler px-0 me-3" data-bs-toggle="collapse" data-bs-target="#navbarContent">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="/" class="navbar-brand px-0 ms-0 justify-content-start">
				<span class="navbar-logo d-md-block d-none"></span> <b class="me-3px">Color</b> Admin
			</a>
			<div class="collapse navbar-collapse ms-auto d-md-flex align-items-center" id="navbarContent">
				<div class="navbar-nav ms-auto fw-500 d-md-flex justify-content-end">
					<div class="nav-item me-md-3 me-lg-2">
						<a href="#home" class="nav-link text-body">Home</a>
					</div>
					<div class="nav-item me-md-3 me-lg-2">
						<a href="#about" class="nav-link text-body">About</a>
					</div>
					<div class="nav-item me-md-3 me-lg-2">
						<a href="#features" class="nav-link text-body">Features</a>
					</div>
					<div class="nav-item me-md-3 me-lg-2">
						<a href="#pricing" class="nav-link text-body">Pricing</a>
					</div>
					<div class="nav-item me-md-3 me-lg-2">
						<a href="#testimonials" class="nav-link text-body">Testimonials</a>
					</div>
					<div class="nav-item me-md-3 me-lg-2">
						<a href="#blog" class="nav-link text-body">Blog</a>
					</div>
					<div class="nav-item me-md-3 me-lg-2">
						<a href="#contact" class="nav-link text-body">Contact</a>
					</div>
				</div>
			</div>
			<div class="ms-3">
				<a href="/" class="btn btn-theme fw-bold rounded-pill px-3 py-2 text-nowrap">Get started <i class="fa fa-arrow-right ms-2 opacity-5"></i></a>
			</div>
		</div>
	</div>
	<!-- END #header -->
	
	<!-- BEGIN #home -->
	<div id="home" class="py-5 position-relative bg-black bg-size-cover" data-bs-theme="dark">
		<!-- BEGIN container -->
		<div class="container-xxl p-3 p-lg-5">
			<!-- BEGIN div-hero-content -->
			<div class="div-hero-content z-3 position-relative">
				<!-- BEGIN row -->
				<div class="row">
					<!-- BEGIN col-8 -->
					<div class="col-lg-6">
						<!-- BEGIN hero-title-desc -->
						<h1 class="display-6 fw-light mb-2 mt-4 text-white">
							Built with <span class="fw-bold border-bottom">Color Admin</span> Template
						</h1>
						<div class="fs-18px text-body text-opacity-75 mb-4">
							Join thousands of users worldwide who rely on Color Admin Template <span class="d-xl-inline d-none"><br></span>
							to kickstart their startups, enhance company projects, hone creative skills, <span class="d-xl-inline d-none"><br></span>
							or tackle freelance tasks.
						</div>
						<!-- END hero-title-desc -->
						
						<div class="text-body text-opacity-35 h5 mb-4">
							<i class="fab fa-bootstrap fa-2x fa-fw"></i>
							<i class="fab fa-node-js fa-2x fa-fw"></i>
							<i class="fab fa-vuejs fa-2x fa-fw"></i>
							<i class="fab fa-angular fa-2x fa-fw"></i>
							<i class="fab fa-react fa-2x fa-fw"></i>
							<i class="fab fa-laravel fa-2x fa-fw"></i>
							<i class="fab fa-npm fa-2x fa-fw"></i>
						</div>
						
						<div class="mb-2">
							<a href="/" class="btn btn-lg btn-theme px-3">Discover Our Template <i class="fa fa-arrow-right ms-2 opacity-5"></i></a>
						</div>
						
						<hr class="my-4" />
						
						<!-- BEGIN row -->
						<div class="row text-body mt-4 mb-4">
							<!-- BEGIN col-4 -->
							<div class="col-6 mb-3 mb-lg-0">
								<div class="d-flex align-items-center">
									<div class="h1 text-body text-opacity-25 me-3"><iconify-icon icon="bi:download"></iconify-icon></div>
									<div>
										<div class="fw-500 mb-0 h3">1.8k+</div>
										<div class="fw-500 text-body text-opacity-75">Downloads / Purchases</div>
									</div>
								</div>
							</div>
							<!-- END col-4 -->
							<!-- BEGIN col-4 -->
							<div class="col-6">
								<div class="d-flex align-items-center">
									<div class="h1 text-body text-opacity-25 me-3"><iconify-icon icon="bi:bootstrap"></iconify-icon></div>
									<div>
										<div class="fw-500 mb-0 h3">5.3.3</div>
										<div class="fw-500 text-body text-opacity-75">Bootstrap Version</div>
									</div>
								</div>
							</div>
							<!-- END col-4 -->
						</div>
						<!-- END row -->
					</div>
					<!-- END col-8 -->
				</div>
				<!-- END row -->
			</div>
			<!-- END div-hero-content -->
		</div>
		<!-- END container -->
		
			
		<div class="position-absolute top-0 bottom-0 end-0 w-50 p-5 overflow-hidden d-none d-lg-flex align-items-center z-2">
			<img class="w-100 d-block position-relative" alt="Color Admin" src="/assets/img/landing/mockup-1-default.jpg" />
		</div>
		<div class="position-absolute bg-size-cover bg-position-center bg-no-repeat top-0 start-0 w-100 h-100" style="background-image: url(/assets/css/images/coming-soon.jpg);"></div>
		<div class="position-absolute top-0 start-0 d-none2 w-100 h-100 bg-gray-900 bg-opacity-80"></div>	
	</div>
	<!-- END #home -->
	
	<!-- BEGIN #about -->
	<div id="about" class="py-5 bg-component">
		<div class="container-xxl p-3 p-lg-5 text-center">
			<h1 class="mb-3">About Color Admin</h1>
			<p class="fs-16px text-body text-opacity-50 mb-5">Color Admin Template crafts high-performance web applications for <span class="d-none d-md-inline"><br></span>developers, designers, and entrepreneurs, enabling effortless unleashing of creativity.</p>
			<div class="row text-start g-3 gx-lg-5 gy-lg-4">
				<div class="col-xl-3 col-lg-4 col-sm-6 d-flex">
					<div class="w-50px h-50px rounded-3 bg-primary bg-opacity-15 text-primary fs-32px d-flex align-items-center justify-content-center">
						<iconify-icon icon="solar:monitor-smartphone-bold-duotone"></iconify-icon>
					</div>
					<div class="flex-1 ps-3">
						<h4>Responsive Design</h4>
						<p class="mb-0">Optimized for all devices, ensuring a seamless and exceptional user experience everywhere.</p>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6 d-flex">
					<div class="w-50px h-50px rounded-3 bg-indigo bg-opacity-15 text-indigo fs-32px d-flex align-items-center justify-content-center">
						<iconify-icon icon="solar:settings-bold-duotone"></iconify-icon>
					</div>
					<div class="flex-1 ps-3">
						<h4>Highly Customizable</h4>
						<p class="mb-0">Modify layouts, colors, and more with ease. Color Admin Template offers unparalleled flexibility to adapt to your specific needs.</p>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6 d-flex">
					<div class="w-50px h-50px rounded-3 bg-warning bg-opacity-15 text-warning fs-32px d-flex align-items-center justify-content-center">
						<iconify-icon icon="solar:bolt-bold-duotone"></iconify-icon>
					</div>
					<div class="flex-1 ps-3">
						<h4>High Performance</h4>
						<p class="mb-0">Fast loading times and efficient coding practices ensure a smooth user experience, even under heavy traffic.</p>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6 d-flex">
					<div class="w-50px h-50px rounded-3 bg-info bg-opacity-15 text-info fs-32px d-flex align-items-center justify-content-center">
						<iconify-icon icon="solar:lock-keyhole-bold-duotone"></iconify-icon>
					</div>
					<div class="flex-1 ps-3">
						<h4>Secure</h4>
						<p class="mb-0">Built with security in mind, protecting your data and ensuring your complete peace of mind.</p>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6 d-flex">
					<div class="w-50px h-50px rounded-3 bg-green bg-opacity-15 text-green fs-32px d-flex align-items-center justify-content-center">
						<iconify-icon icon="solar:dialog-2-bold-duotone"></iconify-icon>
					</div>
					<div class="flex-1 ps-3">
						<h4>Community Support</h4>
						<p class="mb-0">Join our vibrant community of developers and designers, sharing insights and support.</p>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6 d-flex">
					<div class="w-50px h-50px rounded-3 bg-red bg-opacity-15 text-red fs-32px d-flex align-items-center justify-content-center">
						<iconify-icon icon="solar:help-bold-duotone"></iconify-icon>
					</div>
					<div class="flex-1 ps-3">
						<h4>24/7 Support</h4>
						<p class="mb-0">Our dedicated support team is always here to assist you with any questions or issues you encounter.</p>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6 d-flex">
					<div class="w-50px h-50px rounded-3 bg-pink bg-opacity-15 text-pink fs-32px d-flex align-items-center justify-content-center">
						<iconify-icon icon="solar:tuning-bold-duotone"></iconify-icon>
					</div>
					<div class="flex-1 ps-3">
						<h4>Scalable Infrastructure</h4>
						<p class="mb-0">Flexible and scalable infrastructure to meet diverse business needs, ensuring reliability and performance.</p>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6 d-flex">
					<div class="w-50px h-50px rounded-3 bg-gray-500 bg-opacity-15 text-gray-500 fs-32px d-flex align-items-center justify-content-center">
						<iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
					</div>
					<div class="flex-1 ps-3">
						<h4>Intuitive User Interface</h4>
						<p class="mb-0">Streamlined, intuitive interface designed for enhanced productivity and creativity.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END #about -->
	
	<!-- BEGIN #features -->
	<div id="features" class="py-5 position-relative" data-bs-theme="dark">
		<div class="container-xxl p-3 p-lg-5 z-2 position-relative">
			<div class="text-center mb-5">
				<h1 class="mb-3 text-white">Our Unique Features</h1>
				<p class="fs-16px text-body text-opacity-50 mb-5">
					Explore Color Admin Admin Template's standout features. <span class="d-none d-md-inline"><br></span>
					With advanced customization and seamless integration, create powerful and stunning <span class="d-none d-md-inline"><br></span>
					admin interfaces, enhancing productivity and user satisfaction.
				</p>
			</div>
			<div class="row g-3 g-lg-5">
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<a href="/assets/img/landing/mockup-1-default.jpg" data-lity class="shadow d-block"><img src="/assets/img/landing/mockup-1-default-thumb.jpg" alt="" class="mw-100"></a>
					<div class="text-center my-3 text-body fw-bold">Theme Dashboard</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<a href="/assets/img/landing/mockup-2-default.jpg" data-lity class="shadow d-block"><img src="/assets/img/landing/mockup-2-default-thumb.jpg" alt="" class="mw-100"></a>
					<div class="text-center my-3 text-body fw-bold">POS System UI</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<a href="/assets/img/landing/mockup-3-default.jpg" data-lity class="shadow d-block"><img src="/assets/img/landing/mockup-3-default-thumb.jpg" alt="" class="mw-100"></a>
					<div class="text-center my-3 text-body fw-bold">Color Admin Widgets</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<a href="/assets/img/landing/mockup-4-default.jpg" data-lity class="shadow d-block"><img src="/assets/img/landing/mockup-4-default-thumb.jpg" alt="" class="mw-100"></a>
					<div class="text-center my-3 text-body fw-bold">Pricing Page</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<a href="/assets/img/landing/mockup-5-default.jpg" data-lity class="shadow d-block"><img src="/assets/img/landing/mockup-5-default-thumb.jpg" alt="" class="mw-100"></a>
					<div class="text-center my-3 text-body fw-bold">Settings Page</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<a href="/assets/img/landing/mockup-6-default.jpg" data-lity class="shadow d-block"><img src="/assets/img/landing/mockup-6-default-thumb.jpg" alt="" class="mw-100"></a>
					<div class="text-center my-3 text-body fw-bold">Data Management</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<a href="/assets/img/landing/mockup-7-default.jpg" data-lity class="shadow d-block"><img src="/assets/img/landing/mockup-7-default-thumb.jpg" alt="" class="mw-100"></a>
					<div class="text-center my-3 text-body fw-bold">User Profile</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<a href="/assets/img/landing/frontend-one-page-parallax.jpg" data-lity class="shadow d-block"><img src="/assets/img/landing/frontend-one-page-parallax-thumb.jpg" alt="" class="mw-100"></a>
					<div class="text-center my-3 text-body fw-bold">Frontend - One Page Parallax</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<a href="/assets/img/landing/frontend-e-commerce.jpg" data-lity class="shadow d-block"><img src="/assets/img/landing/frontend-e-commerce-thumb.jpg" alt="" class="mw-100"></a>
					<div class="text-center my-3 text-body fw-bold">Frontend - E-Commerce</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<a href="/assets/img/landing/frontend-blog.jpg" data-lity class="shadow d-block"><img src="/assets/img/landing/frontend-blog-thumb.jpg" alt="" class="mw-100"></a>
					<div class="text-center my-3 text-body fw-bold">Frontend - Blog</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<a href="/assets/img/landing/frontend-forum.jpg" data-lity class="shadow d-block"><img src="/assets/img/landing/frontend-forum-thumb.jpg" alt="" class="mw-100"></a>
					<div class="text-center my-3 text-body fw-bold">Frontend - Forum</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<a href="/assets/img/landing/frontend-corporate.jpg" data-lity class="shadow d-block"><img src="/assets/img/landing/frontend-corporate-thumb.jpg" alt="" class="mw-100"></a>
					<div class="text-center my-3 text-body fw-bold">Frontend - Corporate</div>
				</div>
			</div>
		</div>
		<div class="position-absolute bg-size-cover bg-position-center bg-no-repeat top-0 start-0 w-100 h-100" style="background-image: url(/assets/img/gallery/gallery-1.jpg);"></div>
		<div class="position-absolute bg-gray-900 bg-opacity-80 top-0 start-0 w-100 h-100"></div>
	</div>
	<!-- END #features -->
	
	<!-- BEGIN #pricing -->
	<div id="pricing" class="py-5 bg-component">
		<div class="container-xxl p-3 p-lg-5">
			<h1 class="mb-3 text-center">Our Pricing Plans</h1>
			<p class="fs-16px text-body text-opacity-50 text-center mb-0">Choose the perfect plan that suits your needs. <span class="d-none d-md-inline"><br></span>Our pricing is designed to be flexible and affordable, providing value for businesses of all sizes. <span class="d-none d-md-inline"><br></span>Explore our plans to find the best fit for your requirements.</p>
			
			<div class="row g-3 py-3 gx-lg-5 py-lg-5" data-bs-theme="dark">
				<div class="col-xl-3 col-md-4 col-sm-6 py-xl-5">
					<div class="card border-0 rounded-4 h-100 bg-gray-900">
						<div class="card-body fs-14px p-30px d-flex flex-column">
							<div class="d-flex align-items-center">
								<div class="flex-1">
									<div class="h5 font-monospace text-body">Starter Plan</div>
									<div class="display-6 fw-bold mb-0 text-white">$5 <small class="h6 text-body">/month*</small></div>
								</div>
								<div>
									<iconify-icon icon="solar:usb-bold-duotone" class="display-4 text-gray-400 rounded-3"></iconify-icon>
								</div>
							</div>
							<hr class="my-4">
							<div class="mb-5 text-body flex-1">
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Storage:</span> <b class="text-white small">10 GB</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Bandwidth:</span> <b class="text-white small">100 GB</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Domain Names:</span> <b class="text-white small">1</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">SSL Certificate:</span> <b class="text-white small"> Shared</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Email Accounts:</span> <b class="text-white small"> 5</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">24/7 Support:</span> <b class="text-white small"> Yes</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-times fa-lg text-body text-opacity-25"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Backup:</span> <b class="text-white small"> Daily</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-times fa-lg text-body text-opacity-25"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Uptime Guarantee:</span> <b class="text-white small"> 99.9%</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-times fa-lg text-body text-opacity-25"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">FTP Access:</span> <b class="text-white small"> Yes</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-times fa-lg text-body text-opacity-25"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Control Panel:</span> <b class="text-white small"> cPanel</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-times fa-lg text-body text-opacity-25"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Free Domain:</span> <b class="text-white small"> No</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-times fa-lg text-body text-opacity-25"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Firewall:</span> <b class="text-white small"> No</b></div>
								</div>
							</div>
							<div class="mx-n2">
								<a href="#" class="btn btn-default btn-lg w-100 font-monospace">Get Started <i class="fa fa-arrow-right"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-4 col-sm-6 py-xl-5">
					<div class="card border-0 rounded-4 h-100 bg-gray-900">
						<div class="card-body fs-14px p-30px d-flex flex-column">
							<div class="d-flex align-items-center">
								<div class="flex-1">
									<div class="h5 font-monospace text-body">Booster Plan</div>
									<div class="display-6 fw-bold mb-0 text-white">$10 <small class="h6 text-body">/month*</small></div>
								</div>
								<div>
									<iconify-icon icon="solar:map-arrow-up-bold-duotone" class="display-4 text-gray-400 rounded-3"></iconify-icon>
								</div>
							</div>
							<hr class="my-4">
							<div class="mb-5 text-body flex-1">
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Storage:</span> <b class="text-white small">20 GB</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Bandwidth:</span> <b class="text-white small">200 GB</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Domain Names:</span> <b class="text-white small">2</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">SSL Certificate:</span> <b class="text-white small"> Free</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Email Accounts:</span> <b class="text-white small"> 10</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">24/7 Support:</span> <b class="text-white small"> Yes</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-times fa-lg text-body text-opacity-25"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Backup:</span> <b class="text-white small"> Daily</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-times fa-lg text-body text-opacity-25"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Uptime Guarantee:</span> <b class="text-white small"> 99.9%</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-times fa-lg text-body text-opacity-25"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">FTP Access:</span> <b class="text-white small"> Yes</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-times fa-lg text-body text-opacity-25"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Control Panel:</span> <b class="text-white small"> cPanel</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-times fa-lg text-body text-opacity-25"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Free Domain:</span> <b class="text-white small"> No</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-times fa-lg text-body text-opacity-25"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Firewall:</span> <b class="text-white small"> No</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-times fa-lg text-body text-opacity-25"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">45-Day Money-Back Guarantee</span></div>
								</div>
							</div>
							<div class="mx-n2">
								<a href="#" class="btn btn-default btn-lg w-100 font-monospace">Get Started <i class="fa fa-arrow-right"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-4 col-sm-6 py-xl-0">
					<div class="card border-0 rounded-4 shadow-lg bg-gradient-cyan-blue text-white h-100">
						<div class="card-body fs-15px p-30px h-100 d-flex flex-column">
							<div class="d-flex align-items-center">
								<div class="flex-1">
									<div class="h5 font-monospace text-white text-opacity-75">Premium Plan</div>
									<div class="display-6 fw-bold mb-0 text-white">$15 <small class="h6 text-white text-opacity-75">/month*</small></div>
								</div>
								<div>
									<iconify-icon icon="solar:cup-first-bold-duotone" class="display-3 text-black text-opacity-50 rounded-3"></iconify-icon>
								</div>
							</div>
							<hr class="my-4 border-black">
							<div class="mb-5 text-white text-opacity-75 flex-1">
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-white text-opacity-50 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Storage:</span> <b class="text-white small">50 GB</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-white text-opacity-50 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Bandwidth:</span> <b class="text-white small">500 GB</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-white text-opacity-50 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Domain Names:</span> <b class="text-white small">Unlimited</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-white text-opacity-50 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">SSL Certificate:</span> <b class="text-white small">Free</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-white text-opacity-50 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Email Accounts:</span> <b class="text-white small">Unlimited</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-white text-opacity-50 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">24/7 Support:</span> <b class="text-white small">Yes</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-white text-opacity-50 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Backup:</span> <b class="text-white small">Daily</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-white text-opacity-50 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Uptime Guarantee:</span> <b class="text-white small">99.9%</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-white text-opacity-50 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">FTP Access:</span> <b class="text-white small">Yes</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-white text-opacity-50 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Control Panel:</span> <b class="text-white small">cPanel</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-white text-opacity-50 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Free Domain:</span> <b class="text-white small">No</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-white text-opacity-50 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Firewall:</span> <b class="text-white small">Yes</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-white text-opacity-50 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">E-commerce Support</span></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-white text-opacity-50 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">45-Day Money-Back Guarantee</span></div>
								</div>
							</div>
							<a href="#" class="btn btn-outline-white btn-lg w-100 font-monospace">Get Started <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-4 col-sm-6 py-xl-5">
					<div class="card border-0 rounded-4 h-100 bg-gray-900">
						<div class="card-body fs-14px p-30px d-flex flex-column">
							<div class="d-flex align-items-center">
								<div class="flex-1">
									<div class="h5 font-monospace text-body">Business Plan</div>
									<div class="display-6 fw-bold mb-0 text-white">$99 <small class="h6 text-body">/month*</small></div>
								</div>
								<div>
									<iconify-icon icon="solar:buildings-bold-duotone" class="display-4 text-gray-400 rounded-3"></iconify-icon>
								</div>
							</div>
							<hr class="my-4">
							<div class="mb-5 text-white text-opacity-75 flex-1">
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Storage:</span> <b class="text-white small">1 TB</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Bandwidth:</span> <b class="text-white small">20 TB</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Domain Names:</span> <b class="text-white small">Unlimited</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">SSL Certificate:</span> <b class="text-white small">Free</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Email Accounts:</span> <b class="text-white small">Unlimited</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check fa-lg text-gray-400"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">24/7 Support:</span> <b class="text-white small">Yes</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-gray-400 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Backup:</span> <b class="text-white small"> Daily</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-gray-400 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Uptime Guarantee:</span> <b class="text-white small">99.9%</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-gray-400 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">FTP Access:</span> <b class="text-white small">Yes</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-gray-400 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Control Panel:</span> <b class="text-white small">cPanel</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-gray-400 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Free Domain:</span> <b class="text-white small">Yes</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-gray-400 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">Firewall:</span> <b class="text-white small">Yes</b></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-gray-400 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">E-commerce Support</span></div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<i class="fa fa-check text-gray-400 fa-lg"></i> 
									<div class="flex-1 ps-3"><span class="font-monospace small">45-Day Money-Back Guarantee</span></div>
								</div>
							</div>
							<div class="mx-n2">
								<a href="#" class="btn btn-default btn-lg w-100 font-monospace">Get Started <i class="fa fa-arrow-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END #pricing -->
	
	<!-- BEGIN #testimonials -->
	<div id="testimonials" class="py-5">
		<div class="container-xxl p-3 p-lg-5">
			<div class="text-center mb-5">
				<h1 class="mb-3 text-center">What Our Clients Say</h1>
				<p class="fs-16px text-body text-opacity-50 text-center mb-0">
					Read testimonials from our satisfied customers. <span class="d-none d-md-inline"><br></span>
					Discover how Color Admin Admin Template enhances productivity and exceeds expectations <span class="d-none d-md-inline"><br></span>
					with its ease of use, advanced features, and exceptional support.
				</p>
			</div>
			<div class="row g-3 g-lg-4 mb-4">
				<div class="col-xl-4 col-md-6">
					<div class="card p-4 border-0 h-100 rounded-5">
						<div class="d-flex align-items-center mb-3">
							<img src="/assets/img/user/user-1.jpg" class="rounded-circle me-3 w-50px" alt="Client 1">
							<div>
								<h5 class="mb-0">John Doe</h5>
								<small class="text-muted">CEO, Company</small>
							</div>
						</div>
						<div class="mb-4 d-flex">
							<i class="fa fa-quote-left fa-2x text-body text-opacity-15"></i>
							<div class="p-3 fs-5">
								<div class="text-warning d-flex mb-2">
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
								</div>
								Color Admin Admin Template transformed our workflow. 
								The customization options are unparalleled, and the support team is incredibly responsive.
							</div>
							<div class="d-flex align-items-end">
								<i class="fa fa-quote-right fa-2x text-body text-opacity-15"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-md-6">
					<div class="card p-4 border-0 h-100 rounded-5">
						<div class="d-flex align-items-center mb-3">
							<img src="/assets/img/user/user-3.jpg" class="rounded-circle me-3 w-50px" alt="Client 1">
							<div>
								<h5 class="mb-0">Michael Brown</h5>
								<small class="text-muted">CTO, Innovate Corp</small>
							</div>
						</div>
						<div class="mb-4 d-flex">
							<i class="fa fa-quote-left fa-2x text-body text-opacity-15"></i>
							<div class="p-3 fs-5">
								<div class="text-warning d-flex mb-2">
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
								</div>
								Our productivity has soared since adopting this template. 
								The features are top-notch, and the user experience is outstanding.
							</div>
							<div class="d-flex align-items-end">
								<i class="fa fa-quote-right fa-2x text-body text-opacity-15"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-md-6">
					<div class="card p-4 border-0 h-100 rounded-5">
						<div class="d-flex align-items-center mb-3">
							<img src="/assets/img/user/user-13.jpg" class="rounded-circle me-3 w-50px" alt="Client 1">
							<div>
								<h5 class="mb-0">Emily Johnson</h5>
								<small class="text-muted">Project Manager, Creative Agency</small>
							</div>
						</div>
						<div class="mb-4 d-flex">
							<i class="fa fa-quote-left fa-2x text-body text-opacity-15"></i>
							<div class="p-3 fs-5">
								<div class="text-warning d-flex mb-2">
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
								</div>
								This template is a game-changer. 
								It's intuitive, flexible, and the seamless integration 
								has made our projects run smoother than ever.
							</div>
							<div class="d-flex align-items-end">
								<i class="fa fa-quote-right fa-2x text-body text-opacity-15"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-2 d-none d-xl-block"></div>
				<div class="col-xl-4 col-md-6">
					<div class="card p-4 border-0 h-100 rounded-5">
						<div class="d-flex align-items-center mb-3">
							<img src="/assets/img/user/user-8.jpg" class="rounded-circle me-3 w-50px" alt="Client 1">
							<div>
								<h5 class="mb-0">David Lee</h5>
								<small class="text-muted">Founder, Startup Hub</small>
							</div>
						</div>
						<div class="mb-4 d-flex">
							<i class="fa fa-quote-left fa-2x text-body text-opacity-15"></i>
							<div class="p-3 fs-5">
								<div class="text-warning d-flex mb-2">
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
								</div>
								Color Admin Admin Template has exceeded all our expectations. 
								The advanced features and excellent support make it a standout choice.
							</div>
							<div class="d-flex align-items-end">
								<i class="fa fa-quote-right fa-2x text-body text-opacity-15"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-md-6">
					<div class="card p-4 border-0 h-100 rounded-5">
						<div class="d-flex align-items-center mb-3">
							<img src="/assets/img/user/user-5.jpg" class="rounded-circle me-3 w-50px" alt="Client 1">
							<div>
								<h5 class="mb-0">John Doe</h5>
								<small class="text-muted">CEO, Company</small>
							</div>
						</div>
						<div class="mb-4 d-flex">
							<i class="fa fa-quote-left fa-2x text-body text-opacity-15"></i>
							<div class="p-3 fs-5">
								<div class="text-warning d-flex mb-2">
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
									<iconify-icon icon="ic:baseline-star" class="fs-18px"></iconify-icon>
								</div>
								Color Admin Admin Template transformed our workflow. 
								The customization options are unparalleled, and the support team is incredibly responsive.
							</div>
							<div class="d-flex align-items-end">
								<i class="fa fa-quote-right fa-2x text-body text-opacity-15"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END #testimonials -->
	
	<!-- BEGIN #blog -->
	<div id="blog" class="py-5 bg-component">
		<div class="container-xxl p-3 p-lg-5">
			<div class="text-center mb-5">
				<h1 class="mb-3 text-center">Our Latest Insights</h1>
				<p class="fs-16px text-body text-opacity-50 text-center mb-0">
					Dive into our blog for the latest trends, tips, and updates <span class="d-none d-md-inline"><br></span>
					on web development, design, and industry best practices. Stay informed and inspired <span class="d-none d-md-inline"><br></span>
					with expert insights and valuable resources.
				</p>
			</div>
			<div class="row g-3 g-xl-4 mb-5">
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<div class="d-flex flex-column h-100 rounded-4 overflow-hidden shadow-lg mb-5 mb-lg-0">
						<div>
							<img src="/assets/img/landing/blog-1.jpg" alt="" class="object-fit-cover h-200px w-100 d-block">
						</div>
						<div class="flex-1 p-3 pb-0">
							<div class="mb-2">
								<span class="bg-theme bg-opacity-15 text-theme px-2 py-1 rounded small fw-bold">Web Design</span>
							</div>
							<h5>Mastering Responsive Design: A Guide for Beginners</h5>
							<p>Explore the fundamentals of responsive web design and learn essential tips to create websites that look great on any device.</p>
						</div>
						<div class="p-3 pt-0 text-body text-opacity-50">July 15, 2024</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<div class="d-flex flex-column h-100 rounded-4 overflow-hidden shadow-lg mb-5 mb-lg-0">
						<div>
							<img src="/assets/img/landing/blog-2.jpg" alt="" class="object-fit-cover h-200px w-100 d-block">
						</div>
						<div class="flex-1 p-3 pb-0">
							<div class="mb-2">
								<span class="bg-theme bg-opacity-15 text-theme px-2 py-1 rounded small fw-bold">UXUI Design</span>
							</div>
							<h5>The Future of UI/UX Trends in 2024</h5>
							<p>Discover the latest trends shaping user interface and experience design in the digital landscape this year.</p>
						</div>
						<div class="p-3 pt-0 text-body text-opacity-50">July 11, 2024</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<div class="d-flex flex-column h-100 rounded-4 overflow-hidden shadow-lg mb-5 mb-lg-0">
						<div>
							<img src="/assets/img/landing/blog-3.jpg" alt="" class="object-fit-cover h-200px w-100 d-block">
						</div>
						<div class="flex-1 p-3 pb-0">
							<div class="mb-2">
								<span class="bg-theme bg-opacity-15 text-theme px-2 py-1 rounded small fw-bold">Search Engine</span>
							</div>
							<h5>Effective SEO Strategies for 2024</h5>
							<p>Dive into actionable SEO strategies and tips to boost your website’s visibility and drive organic traffic.</p>
						</div>
						<div class="p-3 pt-0 text-body text-opacity-50">June 29, 2024</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-sm-6">
					<div class="d-flex flex-column h-100 rounded-4 overflow-hidden shadow-lg mb-5 mb-lg-0">
						<div>
							<img src="/assets/img/landing/blog-4.jpg" alt="" class="object-fit-cover h-200px w-100 d-block">
						</div>
						<div class="flex-1 p-3 pb-0">
							<div class="mb-2">
								<span class="bg-theme bg-opacity-15 text-theme px-2 py-1 rounded small fw-bold">Cyber Security</span>
							</div>
							<h5>Security Essentials: Protecting Your Website from Cyber Threats</h5>
							<p>Essential security measures and best practices to safeguard your website and user data from cyber threats.</p>
						</div>
						<div class="p-3 pt-0 text-body text-opacity-50">June 27, 2024</div>
					</div>
				</div>
			</div>
			<div class="text-center">
				<a href="#" class="text-decoration-none text-body text-opacity-50 h6">See More Company Stories <i class="fa fa-arrow-right ms-3"></i></a>
			</div>
		</div>
	</div>
	<!-- END #blog -->
	
	<!-- BEGIN #contact -->
	<div id="contact" class="py-5">
		<div class="container-xl p-3 p-lg-5">
			<div class="text-center mb-5">
				<h1 class="mb-3 text-center">Get in Touch</h1>
				<p class="fs-16px text-body text-opacity-50 text-center mb-0">
					Contact us today to explore how our team can assist you. <br>
					Whether you have inquiries, need support, or want to discuss a partnership, <br>
					we're here to help. Reach out to us and let's start a conversation!
				</p>
			</div>
			<div class="row gx-3 gx-lg-5">
				<div class="col-lg-6">
					<h4>Contact Us to Discuss Your Project</h4>
					<p>
						Do you have a project in mind? We’re eager to discuss it with you. Whether you’re looking for advice, have questions, or want to share your ideas, feel free to reach out. 
					</p>
					<p>
						<span class="fw-bolder">SeanTheme Color Admin, Inc</span><br> 
						795 Folsom Ave, Suite 600<br>
						San Francisco, CA 94107<br><br> 
						
						Monday - Friday: 9:00 AM - 6:00 PM<br> 
						Saturday - Sunday: Closed<br> <br> 
						
						Phone: <a href="#" class="text-theme">(123) 456-7890</a><br> 
						International: <a href="#" class="text-theme">+11 (0) 123 456 78</a><br> 
						Email:
						<a href="#" class="text-theme">support@seantheme.com</a>
					</p>
				</div>
				<div class="col-lg-6">
					<form action="/" method="GET" name="form_contact_us">
						<div class="row gy-3 mb-3">
							<div class="col-6">
								<label class="form-label">First Name <span class="text-theme">*</span></label>
								<input type="text" class="form-control form-control-lg fs-15px">
							</div>
							<div class="col-6">
								<label class="form-label">Last Name <span class="text-theme">*</span></label>
								<input type="text" class="form-control form-control-lg fs-15px">
							</div>
							<div class="col-6">
								<label class="form-label">Email <span class="text-theme">*</span></label>
								<input type="text" class="form-control form-control-lg fs-15px">
							</div>
							<div class="col-6">
								<label class="form-label">Phone <span class="text-theme">*</span></label>
								<input type="text" class="form-control form-control-lg fs-15px">
							</div>
							<div class="col-12">
								<label class="form-label">Message <span class="text-theme">*</span></label>
								<textarea class="form-control form-control-lg fs-15px" rows="8"></textarea>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-theme btn-lg btn-block px-4 fs-15px">Send Message</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- END #contact -->
	
	<!-- BEGIN #footer -->
	<div id="footer" class="py-5 bg-gray-800 text-body text-opacity-75" data-bs-theme="dark">
		<div class="container-xxl px-3 px-lg-5">
			<div class="row gx-lg-5 gx-3 gy-lg-4 gy-3">
				<div class="col-lg-3 col-md-6">
					<div class="mb-3 fw-800 fs-24px text-white">Color Admin</div>
					<p class="mb-4">
						Color Admin is your go-to solution for creating stunning, responsive, and high-performance web applications. Designed for developers, designers, and entrepreneurs, it provides the tools and flexibility needed to bring your creative visions to life.
					</p>
					<h5>Follow Us</h5>
					<div class="d-flex">
						<a href="#" class="me-2 text-body text-opacity-50"><i class="fab fa-lg fa-facebook fa-fw"></i></a>
						<a href="#" class="me-2 text-body text-opacity-50"><i class="fab fa-lg fa-instagram fa-fw"></i></a>
						<a href="#" class="me-2 text-body text-opacity-50"><i class="fab fa-lg fa-twitter fa-fw"></i></a>
						<a href="#" class="me-2 text-body text-opacity-50"><i class="fab fa-lg fa-youtube fa-fw"></i></a>
						<a href="#" class="me-2 text-body text-opacity-50"><i class="fab fa-lg fa-linkedin fa-fw"></i></a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<h5>Quick Links</h5>
					<ul class="list-unstyled">
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Newsroom</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Company Info</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Careers</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">For Investors</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Brand Resources</a></li>
					</ul>
					<hr class="text-body text-opacity-50">
					<h5>Services</h5>
					<ul class="list-unstyled">
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Web Development</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">App Development</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">SEO</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Marketing</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-6">
					<h5>Resources</h5>
					<ul class="list-unstyled">
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Documentation</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Support</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">FAQs</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Community</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Tutorials</a></li>
					</ul>
					<hr class="text-body text-opacity-50">
					<h5>Legal</h5>
					<ul class="list-unstyled">
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Privacy Policy</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Terms of Service</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Cookie Policy</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Compliance</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-6">
					<h5>Help Center</h5>
					<ul class="list-unstyled">
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Contact Form</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Live Chat Support</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Portal Help Center</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Email Support</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Technical Documentation</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Service Updates</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Developer API</a></li>
						<li class="mb-3px"><a href="#" class="text-decoration-none text-body text-opacity-75">Knowledge Base</a></li>
					</ul>
				</div>
			</div>
			<hr class="text-body text-opacity-50">
			<div class="row">
				<div class="col-sm-6 mb-3 mb-lg-0">
					<div class="footer-copyright-text">&copy; 2024 SeanTheme All Rights Reserved</div>
				</div>
				<div class="col-sm-6 text-sm-end">
					<div class="dropdown me-4 d-inline">
						<a href="#" class="text-decoration-none dropdown-toggle text-body text-opacity-50" data-bs-toggle="dropdown">United States (English)</a>
						<ul class="dropdown-menu">
							<li><a href="#" class="dropdown-item">United States (English)</a></li>
							<li><a href="#" class="dropdown-item">China (简体中文)</a></li>
							<li><a href="#" class="dropdown-item">Brazil (Português)</a></li>
							<li><a href="#" class="dropdown-item">Germany (Deutsch)</a></li>
							<li><a href="#" class="dropdown-item">France (Français)</a></li>
							<li><a href="#" class="dropdown-item">Japan (日本語)</a></li>
							<li><a href="#" class="dropdown-item">Korea (한국어)</a></li>
							<li><a href="#" class="dropdown-item">Latin America (Español)</a></li>
							<li><a href="#" class="dropdown-item">Spain (Español)</a></li>
						</ul>
					</div>
					<a href="#" class="text-decoration-none text-body text-opacity-50">Sitemap</a>
				</div>
			</div>
		</div>
	</div>
	<!-- END #footer -->
@endsection