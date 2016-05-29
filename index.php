<?php
    include('header.php');
    include('navbar.php');
?>
        <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide img-responsive" src="images/coffee_cup.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
                <div id="light-pix">
              <h1>Our Mission</h1>
              <p>Our goal is to be the best coffee bean distributing company in the world.
    Our purpose is to enrich and serve a global audience with the finest beans found on this planet.
    We aim to deliver a superior product that is sourced responsibly and sustainably, while maximizing our shareholders as well as stakeholders value.</p>
                  </div><p>&nbsp;</p>
             <!-- <p><a class="btn btn-lg btn-primary" href="about.php" role="button">Learn More</a></p> -->
            </div>
          </div>
        </div>
        <div class="item">
		  <img class="second-slide img-responsive" src="images/coffee_banner.jpg" alt="Second slide">
		  <div class="container">
		    <div class="carousel-caption">
		    <!-- optional caption info can go here, follow format from above 'item' on previous slide-->
		       <h3>Come get to know our family!</h3>
              <p><a class="btn btn-lg btn-primary" href="about.php" role="button">Who We Are</a></p>
		    </div>
		  </div>
        </div>
        <div class="item">
          <img class="third-slide img-responsive" src="images/more_beans1.jpeg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Top Quality</h1>
              <p>Taste the difference</p>
              <p><a class="btn btn-lg btn-primary" href="#marketing" role="button">See Specials</a></p>
            <!-- optional caption info can go here, follow format from above 'item' on previous slide-->
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    <div class="container marketing">

<!-- ***********MARKET 3 FEATURED PRODUCTS**************** -->
<a name="marketing"></a>
<?php 
    include('marketing.php')
?>

      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">An international selection of beans. <span class="text-muted">Right at your fingertips.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="images/products/coffee9.jpg" width="500" height="500"  alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 col-md-push-5">
          <h2 class="featurette-heading">We source only the highest quality. <span class="text-muted">Taste for yourself.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5 col-md-pull-7">
          <img class="featurette-image img-responsive center-block" src="images/products/coffee4.jpg" width="500" height="500" alt="Generic placeholder image">
        </div>
      </div>
      <!--http://placehold.it/500x500-->
      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Wholesale or individual orders. <span class="text-muted">No order is too big or small.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="images/products/coffee7.jpg" width="500" height="500"  alt="Generic placeholder image">
        </div>
      </div>

      <!-- /END THE FEATURETTES -->

<?php   
    include('footer.php');
?>