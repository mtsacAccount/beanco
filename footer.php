<hr class="featurette-divider">
    </div>  <!-- /.container -->
  
<div class="row">
  <footer class='col-md-12' id='footer'>
      <div class="col-md-4 text-center">
        <h3>Come Visit Us!</h3>
        <iframe
            width="275"
            height="275"
            frameborder="0" style="border:0"
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBlrg_XmMDE6i4aZCsqd68JQ3sQ_W3MuEg
                &q=mtsac,Walnut+CA&zoom=17">
        </iframe>
             <div>
                  <ul class='text-center'>
                     <li>Address:</li>
                     <li>1100 N Grand Ave</li>
                     <li>Walnut, CA</li>
                     <li>92789</li>
                  </ul>
             </div>
       </div>
       <div class="col-md-4">
           <ul class='about_footer col-md-6'>
               <li><h3>About Us</h3></li>
               <li>History</li>
               <li>Mission Statement</li>
               <li>Our Family</li>
               <li>Careers</li>
               <li>Contact</li>
           </ul>
           <ul class='about_footer col-md-6'>
               <li><h3>Partners</h3></li>
               <li>Canabru Cafe</li>
               <li>Intelligentsia Cafe</li>
               <li>Urth Caffe</li>
               <li>Peete's Coffee</li>
               <li>Anything but Starbucks</li>
           </ul>
       </div>
       <div class="col-md-4">
           <h3>Hit Us Up On Social Media!</h3>
               <ul id='social-media'>
                   <li><a href='http://www.facebook.com' target='_blank'><i class="fa fa-facebook-square fa-2x" aria-hidden="true">&nbsp;&nbsp;Facebook</i></a></li>
                   <li><a href='http://www.google.com' target='_blank'><i class="fa fa-google-plus-official fa-2x" aria-hidden="true">&nbsp;&nbsp;Google+</i></a></li>
                   <li><a href='http://www.twitter.com' target='_blank'><i class="fa fa-twitter-square fa-2x" aria-hidden="true">&nbsp;&nbsp;Twitter</i></a></li>
                   <li><a href='http://www.instagram.com' target='_blank'><i class="fa fa-instagram fa-2x" aria-hidden="true">&nbsp;&nbsp;Instagram</i></a></li>
                </ul>
           <p id='copyright'>&copy; 2016 Bean Co. &middot; <a href="#">Privacy &amp; Terms</a> &middot; <a href="admin_login.php">Admin Login</a> </p>
       </div>
    </footer>
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script>
     $(document).ready(function() {
  
        $(window).on('resize', function() {
            var width = $(window).width();
            if (width <= 990) {
                $('#footer').addClass('text-center');
            }else{
                $('#footer').removeClass('text-center');
            }
        })
    });
    </script>
  </body>
</html>