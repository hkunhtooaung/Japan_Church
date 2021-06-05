<?php 
require 'config/config.php';
// require 'config/common.php';


$lStmt = $pdo->prepare("SELECT * FROM videos ORDER BY id DESC LIMIT 0,1");
$lStmt->execute();
$lResult = $lStmt->fetchAll();


if (!empty($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}

$numOfrecs = 1;
$offset = ($pageno - 1) * $numOfrecs;

if (empty($_POST['search'])) {

        $stmt = $pdo->prepare("SELECT * FROM videos ORDER BY id DESC");
        $stmt->execute();
        $rawresult = $stmt->fetchAll();
        $total_pages = ceil(count($rawresult)/ $numOfrecs);

        $stmt = $pdo->prepare("SELECT * FROM videos ORDER BY id DESC LIMIT $offset,$numOfrecs");
        $stmt->execute();
        $result = $stmt->fetchAll();

      } else {

        $searchKey = $_POST['search'];
        $stmt = $pdo->prepare("SELECT * FROM videos WHERE title LIKE '%$searchKey%' ORDER BY id DESC");
        $stmt->execute();
        $rawresult = $stmt->fetchAll();
        $total_pages = ceil(count($rawresult)/ $numOfrecs);

        $stmt = $pdo->prepare("SELECT * FROM videos WHERE title LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numOfrecs");
        $stmt->execute();
        $result = $stmt->fetchAll();

      }


?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  
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
    .seach-form {
      display: flex;
      justify-content: flex-end;
    }
    #search-form {
      width: 300px;
      float: right;
    }
    #contact-from label span{
      font-size: 30px!important;
    }
    .row{
      clear: both;
    }
    .img {
      margin: auto;
      position: relative;
      border-radius: 6px;
      width: 100%;
      overflow: hidden; 
      /*width: 90%;*/
      transition: width 0.5s;
    }
    .img:hover .play-btn {
     width: 70px;
    }
    .img:hover {
     /*width: 99%;*/
     /*height: 98%;*/
    }
    .play-btn {
      width: 60px;
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      cursor: pointer;
      transition-duration: 0.5s;
    }
    .play-btn:hover {
      width: 70px;
    }
    video{
      display: none;  
      position: relative;
    }


    .close-btn {
      position: absolute;
      z-index: 99;
      top: 25%;
      left: 2%;
      width: 40px;
      cursor: pointer;
      /*box-shadow: 0 4px 10px 0 rgb(0 0 0 / 16%), 0 4px 20px 0 rgb(0 0 0 / 12%);*/
    }
    .small-img img{
      border-radius: 10px;
      padding: 10px;
    }
    .shadow {
      box-shadow: 0 4px 10px 0 rgb(0 0 0 / 16%), 0 4px 20px 0 rgb(0 0 0 / 12%);
      /*min-height: 450px;*/
      padding: 10px;
    }
    .s-shadow {
      box-shadow: 0 4px 10px 0 rgb(0 0 0 / 16%), 0 4px 20px 0 rgb(0 0 0 / 12%);
      /*min-height: 450px;*/
      padding: 1px;
    }
    body {
      text-align: justify;
    }
  </style>
</head>
<body>
<!-- header start -->
  <section>
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
                  <li class="nav-item ">
                    <a class="nav-link" href="news.php">News</a>
                  </li>
                  <li class="nav-item active">
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


	<!--Main layout-->
    <main class="mb-5" style="margin-top: 200px;">
      <!--Main container-->
      <div class="container mt-5">
        <div class="search-form">
           <form id="search-form" action="" method="post">
              <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
              <div class="form-group md-form">
                   <label for="name" class=""><span style="float: right;"><i class="fa fa-search">Search</i></span></label>
                  <input type="text" name="search" class="form-control">
              </div>
            </form>
        </div>
       
        <div class="row shadow">
          <?php 
          foreach ($lResult as $value) {
          ?>
          <div class="col-md-12">
                
              <div class="img">

                <a href="<?php echo $value['video_link']; ?>" target="_blank">
                  <img src="admin/videos/<?php echo $value['image'] ?>" width="100%" height="400">
                  <img src="video/play-button.png" class="play-btn" width="100">
                  
                </a>

                </div>
                <h3><i class="fas fa-video"></i>&nbsp;&nbsp;<?php echo $value['title']; ?></h3>             
                <p>
                  <?php echo $value['description']; ?>
                </p>
           </div>
        </div>
          <?php
          }
          ?>
        <div class="row mt-5 shadow">

          <?php foreach ($result as $value) {
          ?>
          <div class="col-md-4">
              <div class="img">

                <a href="<?php echo $value['video_link']; ?>" target="_blank">
                  <img src="admin/videos/<?php echo $value['image']; ?>" width="100%" height="300">
                  <img src="video/play-button.png" class="play-btn" width="100">
                </a>

                </div>
                <h5 class="blod"><i class="fas fa-video"></i>&nbsp;&nbsp;<?php echo $value['title'] ?></h5 >
           </div>
          <?php
          } ?>


        </div>
        
        
          <!-- Pagination -->
            <div class="row mt-5 mb-5">
                <!--Grid column-->
                <div class="col-lg-12 col-md-12 mb-12">

                    <nav>
                      <ul class="pagination pg-dark d-flex justify-content-center">
                        <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
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
                        <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
                      </ul>
                    </nav>

                </div>
                <!--Grid column-->

                </div>
                <!--End Pagination -->
          
          


     </div>
      <!--End Main Container-->
    </main>
    <!--Main layout-->

	

<?php include('footer.php') ?>