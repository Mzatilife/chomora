<?php
session_start();
include_once "classes/profilecontr.class.php";
include_once "classes/blogcontr.class.php";
$blog = new BlogContr;
$profile = new ProfileContr;
if (isset($_GET['blog_id'])) {
	$_SESSION['blog_id'] = $_GET['blog_id'];
	header("location:blog-detail.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Blog</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<!-- Fonts-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/fontawesome/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/fonts/pe-icon/pe-icon.css">
	<!-- Vendors-->
	<link rel="stylesheet" type="text/css" href="assets/vendors/bootstrap/grid.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/magnific-popup/magnific-popup.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/swiper/swiper.css">
	<!-- App & fonts-->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700|Open+Sans:400,700">
	<link rel="stylesheet" type="text/css" id="app-stylesheet" href="assets/css/main.css">
	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<![endif]-->
	<style>
		.bg-photo {
			background: url('./assets/img/bg.jpg');
		}
	</style>
</head>

<body>
	<div class="page-wrap" id="root">

		<?php include "./includes/header.php"; ?>

		<!-- Content-->
		<div class="wil-content">

			<!-- Section -->
			<section class="awe-section bg-photo">
				<div class="container">

					<!-- page-title -->
					<div class="page-title pb-40">
						<h2 class="page-title__title" style="color: #E0E1E4;">I write</h2>
						<p class="page-title__text">The historian records, but a writer creates</p>
						<div class="page-title__divider"></div>
					</div><!-- End / page-title -->

				</div>
			</section>
			<!-- End / Section -->


			<!-- Section -->
			<section class="awe-section bg-gray">
				<div class="container">
					<div class="grid-css grid-css--masonry" data-col-lg="3" data-col-md="2" data-col-sm="2" data-col-xs="1" data-gap="30">
						<div class="grid__inner">
							<div class="grid-sizer"></div>
							<?php
							//displaying the data ---------------------------------------------------------------------------------------->
							@$page = $_GET["page"];

							if ($page == "" || $page == "1") {

								$page1 = 0;
							} else {

								$page1 = ($page * 6) - 6;
							}
							if (isset($_GET['cat_id'])) {
								$category_id = $_GET['cat_id'];
								$row = $blog->viewBlogAndCategory($category_id, $page1, 6);
							} else {
								$row = $blog->viewBlogWithLimit($page1, 6);
							}
							$index = 1;
							foreach ($row as $rw) {
								$date = strtotime($rw['date']);
								$comments = $blog->countComments($rw['blog_id']);
							?>
								<div class="grid-item">
									<div class="grid-item__inner">
										<div class="grid-item__content-wrapper">

											<!-- post -->
											<div class="post">
												<div class="post__media"><a href="blog.php?blog_id=<?php echo $rw['blog_id'] ?>"><img src="./img/blog/<?php echo $rw['image'] ?>" alt="" style="height: 250px; width:100%;" /></a></div>
												<div class="post__body">
													<div class="post__meta"><span class="date"><?php echo date("M d, Y", $date) ?></span><span class="author"><a href="#">by <?php echo $rw['author'] ?></a></span></div>
													<h2 class="post__title"><a href="blog.php?blog_id=<?php echo $rw['blog_id'] ?>"><?php echo $rw['title'] ?></a></h2>
													<p class="post__text"> <?php echo substr($rw['content'], 0, 50); ?>...</p>
													<a class="md-btn md-btn--outline-primary" href="blog.php?blog_id=<?php echo $rw['blog_id'] ?>">read more
													</a>
												</div>
											</div><!-- End / post -->

										</div>
									</div>
								</div>
							<?php
							}

							if (isset($_GET['cat_id'])) {
								$category_id = $_GET['cat_id'];
								$cout = $blog->countBlogAndCategory($category_id);
							} else {
								$cout = $blog->countBlog();
							}
							$a = $cout / 6;

							$a = ceil($a);
							?>
						</div>
					</div>
					<div class="awe-text-center mt-50">

						<?php for ($b = 1; $b <= $a; $b++) {  ?>
							<a class="md-btn md-btn--outline-primary " href="blog.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?>
							</a>
						<?php } ?>
					</div>
				</div>
			</section>
			<!-- End / Section -->

		</div>
		<!-- End / Content-->

		<?php include "./includes/footer.php"; ?>

	</div>
	<!-- Vendors-->
	<script type="text/javascript" src="assets/vendors/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="assets/vendors/imagesloaded/imagesloaded.pkgd.js"></script>
	<script type="text/javascript" src="assets/vendors/isotope-layout/isotope.pkgd.js"></script>
	<script type="text/javascript" src="assets/vendors/jquery-one-page/jquery.nav.min.js"></script>
	<script type="text/javascript" src="assets/vendors/jquery.easing/jquery.easing.min.js"></script>
	<script type="text/javascript" src="assets/vendors/jquery.matchHeight/jquery.matchHeight.min.js"></script>
	<script type="text/javascript" src="assets/vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
	<script type="text/javascript" src="assets/vendors/masonry-layout/masonry.pkgd.js"></script>
	<script type="text/javascript" src="assets/vendors/jquery.waypoints/jquery.waypoints.min.js"></script>
	<script type="text/javascript" src="assets/vendors/swiper/swiper.jquery.js"></script>
	<script type="text/javascript" src="assets/vendors/menu/menu.js"></script>
	<script type="text/javascript" src="assets/vendors/typed/typed.min.js"></script>
	<!-- App-->
	<script type="text/javascript" src="assets/js/main.js"></script>
</body>

</html>