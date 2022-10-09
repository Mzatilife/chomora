<?php
include "../includes/session.php";
include_once "../classes/manageusercontr.class.php";
include_once "../classes/profilecontr.class.php";
include_once "../classes/blogcontr.class.php";
include_once "../classes/projectcontr.class.php";
$project = new ProjectContr;
$blog = new BlogContr;
$profile = new ProfileContr;
$user = new ManageUserContr();

if (isset($_GET['del_id'])) {
  $id = $_GET['del_id'];
  $result = $blog->deleteBlog($id);

  if ($result) {
    $msg = "Blog deleted!";
  } else {
    $msg2 = "couldn't delete blog!";
  }
} elseif (isset($_GET['edit_id'])) {
  $_SESSION['edit'] = $_GET['edit_id'];
  header('location:edit_blog.php');
} elseif (isset($_GET['view_id'])) {
  $_SESSION['view'] = $_GET['view_id'];
  header('location:view_blog.php');
} else { # code...
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mahala M. mkwepu">
  <link rel="icon" href="../img/black.png">
  <title>Admin Dashboard</title>
  <!-- Simple bar CSS -->
  <link rel="stylesheet" href="css/simplebar.css">
  <!-- Fonts CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Icons CSS -->
  <link rel="stylesheet" href="css/feather.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap4.css">
  <!-- Date Range Picker CSS -->
  <link rel="stylesheet" href="css/daterangepicker.css">
  <!-- App CSS -->
  <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
  <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
</head>

<body class="vertical  light  ">
  <div class="wrapper">
    <?php include "./nav-side.php"; ?>
    <main role="main" class="main-content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="row align-items-center mb-2">
              <div class="col">
                <h2 class="h5 page-title">Welcome!</h2>
              </div>
            </div>
            <!-- widgets -->
            <div class="row my-4">
              <div class="col-md-3">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <small class="text-muted mb-1">Blog Categories</small>
                        <?php
                        $cats = $blog->countCategory();
                        ?>
                        <h3 class="card-title mb-0">
                          <?php echo $cats ?>
                        </h3>
                        <p class="small text-muted mb-0"><a href="./categories.php"><span class="fe fe-grid fe-12 text-warning"></span> <span class="text-secondary">view categories</span></a></p>
                      </div>
                      <div class="col-4 text-right">
                        <span class="fe fe-grid fe-24"></span>
                      </div>
                    </div> <!-- /. row -->
                  </div> <!-- /. card-body -->
                </div> <!-- /. card -->
              </div> <!-- /. col -->
              <div class="col-md-3">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <small class="text-muted mb-1">Blogs</small>
                        <?php
                        $blogs = $blog->countBlog();
                        ?>
                        <h3 class="card-title mb-0"><?php echo $blogs ?></h3>
                        <p class="small text-muted mb-0"><a href="./blogs.php"><span class="fe fe-book-open fe-12 text-danger"></span> <span class="text-secondary">view blogs</span></a></p>
                      </div>
                      <div class="col-4 text-right">
                        <span class="fe fe-book-open fe-24"></span>
                      </div>
                    </div> <!-- /. row -->
                  </div> <!-- /. card-body -->
                </div> <!-- /. card -->
              </div> <!-- /. col -->
              <div class="col-md-3">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <small class="text-muted mb-1">Project Categories</small>
                        <?php
                        $pcats = $project->countCategory();
                        ?>
                        <h3 class="card-title mb-0">
                          <?php echo $pcats ?>
                        </h3>
                        <p class="small text-muted mb-0"><a href="./project_categories.php"><span class="fe fe-grid fe-12 text-warning"></span> <span class="text-secondary">view categories</span></a></p>
                      </div>
                      <div class="col-4 text-right">
                        <span class="fe fe-grid fe-24"></span>
                      </div>
                    </div> <!-- /. row -->
                  </div> <!-- /. card-body -->
                </div> <!-- /. card -->
              </div> <!-- /. col -->
              <div class="col-md-3">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <small class="text-muted mb-1">Projects</small>
                        <?php
                        $projects = $project->countproject();
                        ?>
                        <h3 class="card-title mb-0"><?php echo $projects ?></h3>
                        <p class="small text-muted mb-0"><a href="./projects.php"><span class="fe fe-book fe-12 text-danger"></span> <span class="text-secondary">view projects</span></a></p>
                      </div>
                      <div class="col-4 text-right">
                        <span class="fe fe-book fe-24"></span>
                      </div>
                    </div> <!-- /. row -->
                  </div> <!-- /. card-body -->
                </div> <!-- /. card -->
              </div> <!-- /. col -->
            </div> <!-- end section -->
            <div class="row">
              <div class="col-12">
                <div class="row">
                  <!-- Small table -->
                  <div class="col-md-6">
                    <div class="card shadow">
                      <div class="card-header">
                        <h6>
                          <span class="fe fe-book-open fe-16"></span>Blogs
                        </h6>
                      </div>
                      <div class="card-body">
                        <?php
                        if (isset($msg)) { ?>
                          <div class="alert alert-success text-center fade show mt-3" role="alert">
                            <?php echo $msg; ?>
                          </div>
                        <?php
                        } elseif (isset($msg2)) { ?>
                          <div class="alert alert-danger text-center fade show mt-3" role="alert">
                            <?php echo $msg2; ?>
                          </div>
                        <?php } else {
                        } ?>
                        <!-- table -->
                        <table class="table datatables" id="dataTable-1">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Author</th>
                              <th>Title</th>
                              <th>Comments</th>
                              <th>Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $row = $blog->viewBlog();
                            $index = 1;
                            foreach ($row as $rw) {
                              $date = strtotime($rw['date']);
                              $comments = $blog->countComments($rw['blog_id']);
                            ?>
                              <tr>
                                <td><?php echo $index; ?></td>
                                <td scope="col" style="text-transform:capitalize;"><?php echo $rw['author']; ?></td>
                                <td><?php echo $rw['title']; ?></td>
                                <td>
                                  <span class="badge badge-pill badge-info"><?php echo $comments; ?></span>
                                </td>
                                <td><?php echo date("d M Y", $date); ?></td>
                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted sr-only">Action</span>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="dashboard.php?view_id=<?php echo $rw['blog_id'] ?>">View</a>
                                    <a class="dropdown-item" href="dashboard.php?edit_id=<?php echo $rw['blog_id'] ?>">Edit</a>
                                    <a class="dropdown-item text-danger" href="dashboard.php?del_id=<?php echo $rw['blog_id'] ?>">Remove</a>
                                  </div>
                                </td>
                              </tr>
                            <?php
                              $index++;
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div> <!-- simple table -->
                  <div class="col-md-6">
                    <div class="card shadow">
                      <div class="card-header">
                        <h6>
                          <span class="fe fe-book fe-16"></span>Projects
                        </h6>
                      </div>
                      <div class="card-body">
                        <?php
                        if (isset($msg)) { ?>
                          <div class="alert alert-success text-center fade show mt-3" role="alert">
                            <?php echo $msg; ?>
                          </div>
                        <?php
                        } elseif (isset($msg2)) { ?>
                          <div class="alert alert-danger text-center fade show mt-3" role="alert">
                            <?php echo $msg2; ?>
                          </div>
                        <?php } else {
                        } ?>
                        <!-- table -->
                        <table class="table datatables" id="dataTable-2">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Author</th>
                              <th>Title</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $row = $project->viewproject();
                            $index = 1;
                            foreach ($row as $rw) {
                              $sdate = strtotime($rw['start_date']);
                              $edate = strtotime($rw['end_date']);
                              // $comments = $blog->countComments($rw['blog_id']);
                            ?>
                              <tr>
                                <td><?php echo $index; ?></td>
                                <td scope="col" style="text-transform:capitalize;"><?php echo $rw['author']; ?></td>
                                <td><?php echo $rw['title']; ?></td>
                                <td><?php echo date("d M Y", $sdate); ?></td>
                                <td><?php echo date("d M Y", $edate); ?></td>
                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted sr-only">Action</span>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="./projects.php?view_id=<?php echo $rw['project_id'] ?>">View</a>
                                    <a class="dropdown-item" href="./projects.php?edit_id=<?php echo $rw['project_id'] ?>">Edit</a>
                                    <a class="dropdown-item text-danger" href="./projects.php?del_id=<?php echo $rw['project_id'] ?>">Remove</a>
                                  </div>
                                </td>
                              </tr>
                            <?php
                              $index++;
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div> <!-- simple table -->
                </div> <!-- end section -->
              </div>
            </div> <!-- .row -->
          </div> <!-- /.col -->
        </div> <!-- .row -->
      </div> <!-- .container-fluid -->
      <div class="modal fade modal-full" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <button aria-label="" type="button" class="close px-2" data-dismiss="modal" aria-hidden="true">
          <span aria-hidden="true">×</span>
        </button>
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center">
              <h3> Are you sure you want to log out?</h3>
              <button aria-label="" type="button" class="btn btn-primary btn-lg mb-2 my-2 my-sm-0" data-dismiss="modal">cancel</button>
              <a href="logout.php" class="btn btn-danger btn-lg mb-2 my-2 my-sm-0" type="submit">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </main> <!-- main -->
  </div> <!-- .wrapper -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/moment.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/simplebar.min.js"></script>
  <script src='js/daterangepicker.js'></script>
  <script src='js/jquery.stickOnScroll.js'></script>
  <script src="js/tinycolor-min.js"></script>
  <script src="js/config.js"></script>
  <script src='js/jquery.dataTables.min.js'></script>
  <script src='js/dataTables.bootstrap4.min.js'></script>
  <script>
    $('#dataTable-1').DataTable({
      autoWidth: true,
      "lengthMenu": [
        [16, 32, 64, -1],
        [16, 32, 64, "All"]
      ]
    });
  </script>
  <script>
    $('#dataTable-2').DataTable({
      autoWidth: true,
      "lengthMenu": [
        [16, 32, 64, -1],
        [16, 32, 64, "All"]
      ]
    });
  </script>
  <script src="js/apps.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
  </script>
</body>

</html>