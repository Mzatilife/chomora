<?php
session_start();
include_once "classes/projectcontr.class.php";
$project = new ProjectContr;
if (isset($_GET['project_id'])) {
	$_SESSION['project_id'] = $_GET['project_id'];
	header("location:work-detail.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Work</title>
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
						<h2 class="page-title__title" style="color: #E0E1E4;">See what I do</h2>
						<p class="page-title__text">Building a legacy through CHANGE. </p>
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
								$row = $project->viewprojectAndCategory($category_id, $page1, 6);
							} else {
								$row = $project->viewprojectWithLimit($page1, 6);
							}
							$index = 1;
							foreach ($row as $rw) {
							?>
								<div class="grid-item">
									<div class="grid-item__inner">
										<div class="grid-item__content-wrapper">

											<!-- work -->
											<div class="work"><a href="work.php?project_id=<?php echo $rw['project_id'] ?>">

													<!-- hoverbox ef-slide-top -->
													<div class="hoverbox ef-slide-top light">

														<!-- hb_front -->
														<div class="hb_front">
															<img src="img/project/<?php echo $rw['image'] ?>" alt="" style="height: 250px; width:100%;" />
														</div><!-- End / hb_front -->


														<!-- hb_back -->
														<div class="hb_back">
															<h2 class="work__title"><?php echo $rw['title'] ?>...</h2><a href="work.php?project_id=<?php echo $rw['project_id'] ?>"><span class="work__text">View details</span></a>
														</div><!-- End / hb_back -->

													</div><!-- End / hoverbox ef-slide-top -->
												</a>
											</div><!-- End / work -->

										</div>
									</div>
								</div>
							<?php
							}

							if (isset($_GET['cat_id'])) {
								$category_id = $_GET['cat_id'];
								$cout = $project->countprojectAndCategory($category_id);
							} else {
								$cout = $project->countproject();
							}
							$a = $cout / 6;

							$a = ceil($a);
							?>
						</div>
					</div>
					<div class="awe-text-center mt-50">
						<?php for ($b = 1; $b <= $a; $b++) {  ?>
							<a class="md-btn md-btn--outline-primary " href="work.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?>
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