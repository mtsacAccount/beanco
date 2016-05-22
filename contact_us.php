<?php
    include('contact_header.php');
    include('navbar.php');
?>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p> <!--spacing for content to show below nav -->

<div class="row">
  
  <div class="col-lg-offset-1 col-lg-5 col-md-offset-2 col-md-7 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10" id='form-container'>
    <h3 class='text-center'><strong>Send Us a Message!</strong></h3>  
    <hr>
    <form id="contactForm" method="POST" role="form" action="process_email.php">
        <div class="row">
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <label for="name" class="h4">Name</label>
            <input id="name" type="text" name="name" minlength=5 maxlength=40 
            placeholder="Enter Name" required class="form-control"/>
          </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <label for="name" class="h4">Email</label>
            <input id="email" type="email" name="email" placeholder="Enter Email" required class="form-control"/>
          </div>
          <div style="padding: 15px" class="form-group">
            <label for="message" class="h4">Message</label>
            <textarea id="message" rows="8" name="message" placeholder="Enter your message" required class="form-control"></textarea>
          </div>
          <button id="form-submit" type="submit" class="btn btn-lg co-bean-theme pull-left">Send</button>
          <button id="form-reset" type="reset" class="btn btn-lg co-bean-theme pull-left">Clear</button>
        </div>
      </form>
  </div>

</div>



    