<?php 
require 'config/config.php';

  if (!empty($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  } else {
    $pageno = 1;
  }

  $numOfrecs = 4;
  $offset = ($pageno - 1) * $numOfrecs;

if ($_POST['search']) {
    setcookie('search', $_POST['search'], time() + (86400 * 30), "/");

} else {
    if (empty($_GET['pageno'])) {
        unset($_COOKIE['search']);
        setcookie('search', null, -1, '/');
    }
}

  if (empty($_POST['search'])) {

    $stmt = $pdo->prepare("SELECT * FROM news ORDER BY id DESC");
    $stmt->execute();
    $rawresult = $stmt->fetchAll();
    $total_pages = ceil(count($rawresult)/ $numOfrecs);

    $stmt = $pdo->prepare("SELECT * FROM news ORDER BY id DESC LIMIT $offset,$numOfrecs");
    $stmt->execute();
    $result = $stmt->fetchAll();

  } else {

    $searchKey = $_POST['search'] ? $_POST['search'] : $_COOKIE['search'];
    $stmt = $pdo->prepare("SELECT * FROM news WHERE title LIKE '%$searchKey%' ORDER BY id DESC");
    $stmt->execute();
    $rawresult = $stmt->fetchAll();
    $total_pages = ceil(count($rawresult)/ $numOfrecs);

    $stmt = $pdo->prepare("SELECT * FROM news WHERE title LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numOfrecs");
    $stmt->execute();
    $result = $stmt->fetchAll();

  }



      ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="icon" href="images/fb.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="dist/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="dist/index.css">
    <link rel="stylesheet" type="text/css" href="dist/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="dist/aos.css">
    <script src="dist/jquery.min.js"></script>
    <script src="dist/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/all.css">
    <!-- Bootstrap core CSS -->
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.min.css">
    <!-- Your custom styles (optional) -->
    <style type="text/css">
        .mb-4, .my-4 {
            text-align: left !important;
        }
        .search-form {
            width: 300px;
            margin-top: 80px;
            float: right;
        }
        .row {
            clear: both;
        }
    </style>
</head>
<body>
	<!-- header start -->
	<section style="margin-top: 100px;">
		<div class="container-fluid">
		<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="arrow up"></i></button>
        
		<div>
			<div id="header">
				<nav class="navbar navbar-expand-lg navbar-light">
			  	<a class="navbar-brand" href="#">
			  		<img src="images/unnamed.jpg" style="width: 60px; height: 60px;">
			  	</a>

			  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			    	<span class="navbar-toggler-icon"></span>
			  	</button>
				  	<div class="collapse navbar-collapse" id="navbarNavDropdown">
				    	<ul class="navbar-nav ml-auto">
				      		<li class="nav-item">
				        		<a class="nav-link" href="index.php">Home</a>
				      		</li>
				      		<li class="nav-item">
				        		<a class="nav-link" href="aboutus.php">About us</a>
				      		</li>
				      		<li class="nav-item active">
				        		<a class="nav-link" href="news.php">News</a>
				      		</li>
				      		<li class="nav-item">
				        		<a class="nav-link" href="video.php">Video</a>
				      		</li>
				      		<li class="nav-item">
				        		<a class="nav-link" href="contact.php">Contact</a>
				      		</li>
				    	</ul>
				  	</div>
				</nav>
			</div>
	</section>
	<!-- End header -->
	<!-- Start Background Image -->
	<section id="bg-img">
		<div class="container-fluid">
		  
		</div>
	</section>
	<!-- End Background Image -->
	<section id="aboutus">
<!--Main layout-->
    <main class="mt-3">
        <!--Main container-->
        <div class="container">
            <div class="search-form">
                <form id="search-form" action="" method="post">
                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                    <div class="form-group md-form">
                        <label for="name" class=""><span style="float: right;"><i class="fa fa-search">Search</i></span></label>
                        <input type="text" name="search" class="form-control">
                    </div>
                </form>
            </div>
            <div class="row mb-5">
                <div class="col-lg-12 col-md-12 mb-12">
                    <h1 class="h1-responsive font-weight-bold my-4">News</h1>
                </div>
                
            </div>

            <!-- News Row-->
            <div class="row" style="text-align: left !important">

              <!-- Content column-->
              <div class="col-md-10 mb-4" style="margin: auto;">

                <section class="section extra-margins pb-3 text-center text-lg-left">

                    <!--Grid row-->
                    <div class="row">
                        <?php 
                        foreach ($result as $value) { ?>
                            <!--Grid column-->
                        <div class="col-lg-4 mb-4">
                            <!--Featured image-->
                            <div class="view overlay z-depth-1">
                                <a href="newdetail.php?id=<?php echo $value['id']; ?>"><img src="admin/images/<?php echo $value['image'] ?>" class="img-fluid" alt="News" style="height:290px; width: 100%;"></a>
                               
                            </div>
                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-lg-7 ml-xl-1 mb-4">
                            

                            <h6 class="mb-3 dark-grey-text mt-0">
                                <strong>
                                    <a href="newdetail.php?id=<?php echo $value['id']; ?>"><b><p class="dark-grey-text"><i class="far fa-newspaper pr-2"></i><?php echo $value['title']; ?></p></b></a>
                                </strong>
                            </h6>
                            <!--Grid row-->
                            <div class="row">

                                <!--Grid column-->
                                <div class="col-xl-2 col-md-6 text-sm-center text-md-right text-lg-left">
                                    <p class="red-text font-small font-weight-bold mb-1 spacing">
                                        <a>
                                            <strong>Date ::</strong>
                                        </a>
                                    </p>
                                </div>
                                <!--Grid column-->

                                <!--Grid column-->
                                <div class="col-xl-5 col-md-6 text-sm-center text-md-left">
                                    <p class="font-small grey-text">
                                        <em> <?php echo date('d-M-Y h:m:s', strtotime($value['created_at'])) ?></em>
                                    </p>
                                </div>
                                <!--Grid column-->

                            </div>
                            <!--Grid row-->
                            <p class="dark-grey-text">
                               <?php echo substr($value['description'], 0,700); ?>
                            </p>

                            <!--Deep-orange-->
                            <a href="newdetail.php?id=<?php echo $value['id']; ?>" class="btn btn-danger btn-rounded btn-sm waves-effect waves-light">Read more</a>
                        </div>
                        <!--Grid column-->
                        <?php }
                        ?>
                    </div>
                    <!--Grid row-->

                        <hr class="mb-5">

                <!-- Pagination -->
            <div class="row">
                <!--Grid column-->
                <div class="col-lg-12 col-md-12 mb-12">

                    <nav>
                      <ul class="pagination pg-dark d-flex justify-content-center">
                        <li class="page-item active"><a href="?pageno=1" class="page-link">First</a></li>
                        <li class="page-item <?php if($pageno <= 1) { echo "disabled"; } ?>">
                          <a href="<?php if($pageno <= 1) { echo '#';} else { echo "?pageno=".($pageno - 1); } ?>" class="page-link" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                        <li class="page-item <?php if($pageno <= 1) { echo "disabled"; } ?>">
                          <a href="?pageno=<?php echo ($pageno-1); ?>" class="page-link"><?php echo ($pageno - 1); ?></a>
                        </li>
                        <li class="page-item active"><a class="page-link"><?php echo $pageno; ?></a></li>
                        <li class="page-item <?php if($pageno >= $total_pages){echo "disabled"; } ?>">
                          <a href="?pageno=<?php echo $pageno+1; ?>" class="page-link"><?php echo ($pageno + 1); ?></a>
                        </li>
                        <li class="page-item <?php if($pageno >= $total_pages){ echo "disabled"; } ?>">
                          <a href="<?php if($pageno >= $total_pages) { echo '#';} else { echo "?pageno=".($pageno + 1); } ?>" class="page-link" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                          </a>
                        </li>
                        <li class="page-item active"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
                      </ul>
                    </nav>

                </div>
                <!--Grid column-->

                </div>
                <!--End Pagination -->

                </section>

              </div>
              <!-- End Content Column-->

   



            
       </div>
        <!--End Main Container-->
    </main>
    <!--Main layout-->
<?php include('footer.php') ?>