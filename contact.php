<?php 
require 'config/config.php';
// require 'config/common.php';

error_reporting(1);
// define variables and set to empty values
$nameErr = $emailErr = "";
$name = $email = $descriptionErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }


  if (empty($_POST["comment"])) {
    $descriptionError = "Description is required";
  } 

  if ($nameErr || $emailErr || $descriptionErr) {
    
  } else {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $subject = $_POST['subject'];
      $description = $_POST['description'];
      $stmt = $pdo->prepare("INSERT INTO user_contact(name,email,subject,description) VALUES (:name,:email,:subject,:description) ");
      $result = $stmt->execute(
        array(':name'=>$name, ':email'=>$email ,':subject'=>$subject ,':description'=>$description)
      );

      if ($result) {
        echo "<script>alert('Received Your message!! Thank You')</script>";
      }
  }

}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  // $data = xattr_get(filename, name)($data);
  return $data;
}



?>
<?php include('header.html') ?>
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
                  <li class="nav-item">
                    <a class="nav-link" href="news.php">News</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="video.php">Video</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="contact.php">Contact</a>
                  </li>
              </ul>
            </div>
        </nav>
      </div>
  </section>
  <!-- End header -->

	<section id="aboutus">
	<!--Main layout-->
    <main class="mt-3 mb-3" >
        <!--Main container-->
        <div class="container">

            <!--Contact Row-->
            <div class="row">
                <div class="col-lg-12 col-md-12 mb-12">
                    <div style="height: 60px;"></div>
                    <h5 class="h5-responsive font-weight-bold text-center my-4">Contact Us</h5>
                </div>
                <!--Section: Contact-->
				    
				    <!--Section description-->
				    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
				        a matter of hours to help you.</p>

				        <!--Grid column-->
				        <div class="col-md-12 mb-md-0 mb-5">
                   <div class="card">
                      <h5 class="card-header bg-dark white-text text-center py-2">
                          <strong>Contact Form</strong>
                      </h5>
                      <div class="card-body px-lg-5 pt-0">
                      <form id="contact-form" name="contact-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                      <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">

                      <!--Grid row-->
                      <div class="row">

                          <!--Grid column-->
                          <div class="col-md-6">
                              <div class="md-form mb-0">
                                  <input type="text" id="name" name="name" class="form-control">
                                  <label for="name" class="">Your name <span style="color:red;" class="error"> <?php echo "*".$nameErr;?></span></label>
                                 
                              </div>
                          </div>
                          <!--Grid column-->

                          <!--Grid column-->
                          <div class="col-md-6">
                              <div class="md-form mb-0">
                                  <input type="text" id="email" name="email" class="form-control">
                                  <label for="email" class="">Your email<span style="color:red;" class="error"><?php echo "*".$emailErr;?></span></label>
                              </div>
                          </div>
                          <!--Grid column-->

                      </div>
                      <!--Grid row-->

                      <!--Grid row-->
                      <div class="row">
                          <div class="col-md-12">
                              <div class="md-form mb-0">
                                  <input type="text" id="subject" name="subject" class="form-control">
                                  <label for="subject" class="">Subject</label>
                              </div>
                          </div>
                      </div>
                      <!--Grid row-->

                      <!--Grid row-->
                      <div class="row">

                          <!--Grid column-->
                          <div class="col-md-12">

                              <div class="md-form">
                                  <textarea type="text" id="message" name="description" rows="2" class="form-control md-textarea"></textarea>
                                  <label for="message">Your message<span style="color:red;" class="error"> <?php echo $nameErr;?></span></label>
                              </div>
                              <div class="text-center text-md-left">
                                  <input type="submit" class="btn btn-dark btn-md" value="send">
                              </div>
                          </div>
                      </div>
                      <!--Grid row-->	
                  </form>
                      </div>
                  </div>
				        </div>

				        <!--Grid column-->
                	

                	
          </div>
         <!--End Contact Row-->
				
			   <div class="container mt-5 mb-5">
            	<div class="row">
            		<!-- <div class="clol-md-12 mt-4"> -->
            		<div class="col-md-12">
            			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12957.92584054503!2d139.712121!3d35.714376!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188d160506a0c3%3A0xf5373a6d5e6cd8f8!2z44CSMTY5LTAwNTEg5p2x5Lqs6YO95paw5a6_5Yy66KW_5pep56iy55Sw77yT5LiB55uu77yT77yR4oiS77yR77yR!5e0!3m2!1sja!2sjp!4v1621627864774!5m2!1sja!2sjp" style="border:0; width: 100%; height: 500px;" allowfullscreen="" loading="lazy"></iframe>
            		</div>
					<!-- </div> -->
			            	
		        </div>
          </div>
		        <!--Grid row-->
          <div class="row">		

            <!--Grid column-->
                
              <div class="col-md-4 text-center">
                  <div>
		            		<i class="fas fa-map-marker-alt fa-2x"></i>
		                    <p>New Life Bld; 4F, Nishi-Waseda 3-31-11<br>
			        				Shinjuku-ku,Tokyo
			        			169-0051 Japan<br>
			        				03-1234-5632</p>
                    </div>
              </div>

              <!--Grid column-->
                
              <div class="col-md-4 text-center">
			           <i class="fas fa-phone mt-4 fa-2x"></i>
			             <p>+ 01 234 567 88</p>
		          </div>	
              <!--Grid column-->
                
              <div class="col-md-4 text-center">
			          <i class="fas fa-envelope mt-4 fa-2x"></i>
			            <p>enquiry@kmdcomputer.com</p>
              </div>

        </div>
        <!--Grid row-->	

      </div>
        <!--End Main Container-->
    </main>
<?php include('footer.php') ?>