<?php 
require 'config/config.php';
require 'config/common.php';
$i = 0;
$x = 3;
$newStmt = $pdo->prepare("SELECT * FROM news ORDER BY id DESC LIMIT $i,$x");
$newStmt->execute();
$newResult = $newStmt->fetchAll();


$vStmt = $pdo->prepare("SELECT * FROM videos ORDER BY id DESC LIMIT $i,$x");
$vStmt->execute();
$vResult = $vStmt->fetchAll();

?>
<?php include('header.html') ?>
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
				      		<li class="nav-item active">
				        		<a class="nav-link" href="index.php">Home</a>
				      		</li>
				      		<li class="nav-item">
				        		<a class="nav-link" href="aboutus.php">About us</a>
				      		</li>
				      		<li class="nav-item">
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
		  <img src="images/churchbg1.jpg" alt="Snow" style="width:100%;">
		  <div class="centered">
		  	<h2><i>Welcome to our church!</i></h2>
		  	<p><font size="10"><b>It's nice to meet you!</b></font></p>

		  </div>
		</div>
	</section>
	<!-- End Background Image -->

     <!-- News Row -->
    <div class="container mt-5">
      	<div class="row" style="margin: 0px;">
            <div class="col-lg-12 col-md-12 mb-12">
                <h2 class="h2-responsive font-weight-bold" align="center" style="margin-top: 100px; margin-bottom: 100px;">Latest News</h2>
            </div>


            <?php foreach ($newResult as $value) {
            ?>
            <!-- Grid column -->
            <div class="col-lg-4 col-md-12 mb-lg-0 mb-4"  data-aos="fade-up" data-aos-duration="500">

              <!-- Featured image -->
              <div class="view overlay zoom rounded z-depth-2 mb-4">
                <img class="img-fluid" src="admin/images/<?php echo $value['image'] ?>" alt="News" style="height: 300px; width: 100%;">
                <a href="newdetail.php?id=<?php echo $value['id']?>">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>

              <!-- Category -->
              <a href="#!" class="" style="color: black;">
                <h6 class="font-weight-bold mb-3"><i class="far fa-newspaper pr-2"></i>News</h6>
              </a>
              <!-- Post title -->
              <h5 class="font-weight-bold mb-3">
                <a href="new.html" style="color: black;">
                    <strong><?php echo escape($value['title']); ?></strong>
                </a>
            </h5>
              <!-- Post data -->
              <!-- Excerpt -->
              <p class="dark-grey-text">
                  <?php echo substr(escape($value['description']), 0,40); ?>
              </p>
              <!-- Read more button -->
              <a href="newdetail.php?id=<?php echo $value['id'] ?>" class="btn btn-dark btn-rounded btn-md" href="new.html">Read more</a>

            </div>
            <!-- Grid column -->
            <?php } ?>
      	</div>
    </div>
    <!-- End News Row -->





	<div id="table" class="container">
	<h2>Church worship service time table</h2>
	
	<table class="table" >
		<thead class="thead-dark"> 
			<tr>
				<th>Worship Service</th>
				<th>Time</th>
				<th>Location</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Kachin Worship Service(every Sunday)</td>
				<td>11am - 1pm</td>
				<td>TKBC Church</td>
			</tr>
			<tr>
				<td>Burmese Worship Service(last wek of the month)</td>
				<td>3am - 5pm</td>
				<td>TKBC Church</td>
			</tr>
			<tr>
				<td>Women Worship Service(Second week of the month</td>
				<td>11am - 1pm</td>
				<td>TKBC Church</td>
			</tr>
			<tr>
				<td>Men Worship Service(thrid week of the month)</td>
				<td>11am - 1pm</td>
				<td>TKBC Church</td>
			</tr>
			<tr>
				<td>Youth Worship Service(Second week of the month)</td>
				<td>11am - 1pm</td>
				<td>TKBC Church</td>
			</tr>
			<tr>
				<td>Sunday School(every Sunday)</td>
				<td>11am - 1pm</td>
				<td>TKBC Church</td>
			</tr>
		</tbody>
	</table>
	</div>
	
<?php include('footer.php'); ?>