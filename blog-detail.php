<?php
session_start();
include_once "classes/profilecontr.class.php";
include_once "classes/blogcontr.class.php";
$blog = new BlogContr;
$profile = new ProfileContr;
$blog_id = $_SESSION['blog_id'];

$row = $blog->viewBlogById($blog_id);
$date = strtotime($row['date']);

$comments = $blog->countComments($blog_id);

if (isset($_POST['comment'])) {
	//********************** */ Validating the data and sanitising it ******************************
	function TestInput($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = strip_tags($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$name = TestInput($_POST['name']);
	$email = TestInput($_POST['email']);
	$comment = TestInput($_POST['details']);

	$result = $blog->commentBlog($blog_id, $name, $email, $comment);

	if ($result) {
		$msg = "Comment submitted";
	} else {
		$msg2 = "Error, couldn't submit comment";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Post detail</title>
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
</head>

<body>
	<div class="page-wrap" id="root">

		<?php include "./includes/header.php"; ?>

		<!-- Content-->
		<div class="wil-content">

			<!-- Section -->
			<section class="awe-section">
				<div class="container">

					<!-- page-title -->
					<div class="page-title pb-40">
						<span class="post-detail__cat"><?php echo $row['category_name'] ?></span>
						<h2 class="page-title__title"><?php echo $row['title'] ?></h2>
						<div class="post-detail__meta"><span class="date"><?php echo date("M d, Y", $date) ?></span><span class="author"><a href="#">by <?php echo $row['author'] ?></a></span></div>
						<div class="page-title__divider"></div>
					</div><!-- End / page-title -->

				</div>
			</section>
			<!-- End / Section -->


			<!-- Section -->
			<section class="awe-section bg-gray">
				<div class="container">

					<!--  -->
					<div>
						<div class="post-detail__media"><img src="img/blog/<?php echo $row['image'] ?>" alt="" /></div>
						<div class="post-detail__entry row">
							<div class="col-md-8">
								<?php echo $row['content'] ?>
							</div>
						</div>
						<!-- <div class="sharebox__module">
							<p class="social-text">share this article</p>

							social-icon -->
							<a class="social-icon" href="#"><i class="social-icon__icon fa fa-facebook"></i>
							</a><!-- End / social-icon -->


							<!-- social-icon -->
							<a class="social-icon" href="#"><i class="social-icon__icon fa fa-twitter"></i>
							</a><!-- End / social-icon -->


							<!-- social-icon -->
							<a class="social-icon" href="#"><i class="social-icon__icon fa fa-linkedin"></i>
							</a><!-- End / social-icon -->


							<!-- social-icon -->
							<a class="social-icon" href="#"><i class="social-icon__icon fa fa-instagram"></i>
							</a><!-- End / social-icon -->

						</div> 
					</div><!-- End /  -->

					<div class="awe-text-center mt-50">
						<a class="md-btn md-btn--outline-primary " href="blog.php">All blog content
						</a>
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