<?php 
require 'config/config.php';
$stmt = $pdo->prepare("SELECT * FROM news WHERE id=".$_GET['id']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);


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

            <div class="row" style="margin-top: 200px;">
            	<!--Card-->
            	<div class="col-md-12 card mb-4  ">
                <div class="card-header">
                  <img src="admin/images/<?php echo $result['image'] ?>" class="img-fluid mx-auto d-block z-depth-1" alt="" style="height: 600px; width: 100%;">
                </div>
              	<!--Card content-->
              	<div class="card-body" x>
               		
                	<p class="h5 my-4"><?php echo $result['title']; ?></p>

                	<p>
                    <?php echo $result['description']; ?>
                	</p>

              	</div>
            </div>
           

            </div>
            <!--End Pagination -->

        </section>

    </div>
  	<!-- End Content Column-->

   



            
       </div>
        <!--End Main Container-->
    </main>
<?php include('footer.php') ?>