<?php
include "../includes/session.php";
include_once "../classes/blogcontr.class.php";
$blog = new BlogContr;

$view = $_SESSION['view'];

$row = $blog->viewBlogById($view);

$comments = $blog->countComments($view);

if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    $result = $blog->deleteComment($id);

    if ($result) {
        $msg = "comment deleted!";
    } else {
        $msg2 = "couldn't delete comment!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Mahala M. Mkwepu" />
    <link rel="icon" href="../img/black.png">
    <title>View Blog</title>
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
    <style>
        .widget .panel-body {
            padding: 0px;
        }

        .widget .list-group {
            margin-bottom: 0;
        }

        .widget .panel-title {
            display: inline
        }

        .widget .label-info {
            float: right;
        }

        .widget li.list-group-item {
            border-radius: 0;
            border: 0;
            border-top: 1px solid #ddd;
        }

        .widget li.list-group-item:hover {
            background-color: rgba(86, 61, 124, .1);
        }

        .widget .mic-info {
            color: #666666;
            font-size: 11px;
        }

        .widget .action {
            margin-top: 5px;
        }

        .widget .comment-text {
            font-size: 12px;
        }

        .widget .btn-block {
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
        }
    </style>
</head>

<body class="vertical light">
    <div class="wrapper">
        <?php include "./nav-side.php"; ?>
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="card">
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
                        <div class="col-lg-12">
                            <div class="single-post">
                                <div class="blog_details">
                                    <img class="float-left mr-3 img-thumbnail img-responsive" style="max-height: 200px;" src="../img/blog/<?php echo $row['image']; ?>" alt="image">
                                    <h3>
                                        <?php echo $row['title']; ?>
                                    </h3>
                                    <ul class="list-unstyled d-flex mt-3 mb-4">
                                        <li> <i class="fe fe-user fe-16"></i> By <b><?php echo $row['author']; ?></b></li>
                                        <li> <i class="fe fe-layers fe-16"></i> <?php echo $row['category_name']; ?></li>
                                        <li> <i class="fe fe-file-text fe-16"></i> <?php echo $comments ?> Comments</li>
                                    </ul>
                                    <p>
                                        <?php echo $row['content']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="panel panel-default widget">
                                <div class="panel-heading">
                                    <span class="glyphicon glyphicon-comment"></span>
                                    <h6 class="panel-title">
                                        Recent Comments</h6>
                                    <span class="label label-info">
                                        <?php echo $comments ?></span>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group">
                                        <?php
                                        //displaying the data ---------------------------------------------------------------------------------------->
                                        @$page = $_GET["page"];

                                        if ($page == "" || $page == "1") {

                                            $page1 = 0;
                                        } else {

                                            $page1 = ($page * 4) - 4;
                                        }
                                        $com = $blog->viewComments($view, $page1, 4);
                                        foreach ($com as $rw) {
                                            $date = strtotime($rw['date']);
                                        ?>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-xs-2 col-md-1">
                                                    </div>
                                                    <div class="col-xs-10 col-md-11">
                                                        <div>
                                                            <div class="mic-info">
                                                                By: <?php echo $rw['name'] ?> ~
                                                                <a href="mailto:<?php echo $rw['email'] ?>">
                                                                    <span class="fe fe-mail fe-14"></span> Email
                                                                </a> ~
                                                                on <?php echo date("d F Y", $date) ?>
                                                            </div>
                                                        </div>
                                                        <div class="comment-text">
                                                            <?php echo $rw['comment'] ?>
                                                        </div>
                                                        <div class="action">
                                                            <a href="view_blog?del_id=<?php echo $rw['comment_id'] ?>" type="button" class="btn btn-danger btn-sm" title="Delete">
                                                                <span class="fe fe-trash-2 fe-14"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php }
                                        $cout = $blog->countComments($view);

                                        $a = $cout / 4;

                                        $a = ceil($a);
                                        ?>
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                            <?php for ($b = 1; $b <= $a; $b++) {  ?>
                                                <a href="view_blog.php?page=<?php echo $b; ?>" class="btn mb-2 btn-secondary"><?php echo $b; ?></a>
                                            <?php } ?>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- .container-fluid -->
        </main>
        <!-- main -->
    </div>
    <!-- .wrapper -->
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