    <!--Main layout-->
    <div style="background-color: #676d74;">
            <div class="container">
                <!--Grid row-->
                <div class="row py-4 d-flex align-items-center">

                    <!--Grid column-->
                    <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
                        <h6 class="mb-0 white-text">Get connected with us on social networks!</h6>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6 col-lg-7 text-center text-md-right">
                        <!--Facebook-->
                        <a class="fb-ic ml-0">
                            <i class="fab fa-facebook white-text mr-4"> </i>
                        </a>
                        <!--Twitter-->
                        <a class="tw-ic">
                            <i class="fab fa-twitter white-text mr-4"> </i>
                        </a>
                        <!--Google +-->
                        <a class="gplus-ic">
                            <i class="fab fa-google-plus white-text mr-4"> </i>
                        </a>
                        <!--Linkedin-->
                        <a class="li-ic">
                            <i class="fab fa-linkedin white-text mr-4"> </i>
                        </a>
                        <!--Instagram-->
                        <a class="ins-ic">
                            <i class="fab fa-instagram white-text mr-lg-4"> </i>
                        </a>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->
            </div>
        </div>
<section id="footer">

	<div class="container-fluid">
		<div class="footer">
			<p> &copy; copyright Tokyo Kachin Baptist Church</p>

		</div>
	</div>
</section>

	


<!-- jQuery -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- Your custom scripts (optional) -->

<script src="dist/aos.js"></script>
<script>
  AOS.init({
    easing: 'ease-in-out-sine'
  });
</script>

<!-- script -->
<script>
//Get the button
var mybutton = document.querySelector("#myBtn");
// When the user scrolls down 50px from the top of the document, resize the header's font size
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    document.getElementById("header").style.fontSize = "17px";
    document.getElementById("header").style.paddingTop = "0px";
    document.getElementById("header").style.paddingBottom = "0px";
    document.getElementById("header").style.transition = "0.5s";
    
    // document.getElementById("header").style.fontSize = "20px";
  } else {
    document.getElementById("header").style.fontSize = "17px";
    document.getElementById("header").style.paddingTop = "15px";
    document.getElementById("header").style.paddingBottom = "15px";
  }

  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
    mybutton.style.opacity = "100%";

  } else {
    mybutton.style.opacity = "0%";
  }


}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
</body>
</html>