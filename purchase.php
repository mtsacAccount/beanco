<?php
    
    include('header.php');
    include('navbar.php');
    include('cart.php');
    
?>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><!--spacing for content to show below nav -->
<div class="container marketing">
    <h1>Payment Details</h1>

<?php
    // Final Cart - code is in cart.php
    showFinalCart($_SESSION['cart']);
?>
<div class="container">
    <form action='confirmation.php'  role="form" method='POST' class="form-horizontal">
    <div class="row" id='info-section'>
         <!--Customer Information -->
                <div class="col-md-6">
                    <div class="page-header text-center">
                       <h2>Billing Information</h2>
                   </div>
                    <div class="form-group">
                        <label for="name" class='col-md-2 control-label'>Name</label>
                        <div class='col-md-10'>
                            <input type="text" class="form-control" id="name" name='name'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class='col-md-2 control-label'>Street Address</label>
                        <div class='col-md-10'>
                            <input type="text" class="form-control" id="address" name='address'>
                        </div> 
                        
                    </div>
                    <div class="form-group">
                        <label for="city" class='col-md-2 control-label'>City</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="city" name='city'/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="state" class='col-md-2 control-label'>State</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="state" name='state' />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zip" class='col-md-2 control-label'>ZipCode</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="zip" name='zip'/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="country" class='col-md-2 control-label'>Country</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="country" name='country' />
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <label class="checkbox-inline">
                              <input type="checkbox" value='true' id='ship-same-check' name='checkbox' checked/>
                              <strong>Shipping Info same as Billing</strong>
                        </label>
                    </div>
                </div>
                <!-- End of Customer Information -->
                <!--Optional Shipping Information-->
                <div class="col-md-6 hidden" id='ship-info-container'>
                       <div class="page-header text-center">
                           <h2>Shipping Information</h2>
                       </div>
                        <div class="form-group">
                            <label for="ship_name" class='col-md-2 control-label'>Name</label>
                            <div class='col-md-10'>
                                <input type="text" class="form-control" id="ship_name" name='ship_name'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ship_address" class='col-md-2 control-label'>Street Address</label>
                            <div class='col-md-10'>
                                <input type="text" class="form-control" id="ship_address" name='ship_address'>
                            </div> 
                            
                        </div>
                        <div class="form-group">
                            <label for="ship_city" class='col-md-2 control-label'>City</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="ship_city" name='ship_city'/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ship_state" class='col-md-2 control-label'>State</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="ship_state" name='ship_state' />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ship_zip" class='col-md-2 control-label'>ZipCode</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="ship_zip" name='ship_zip'/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ship_country" class='col-md-2 control-label'>Country</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="ship_country" name='ship_country' />
                            </div>
                        </div>
                </div>
                <!--End of Billing and Shipping Info-->
            
  
    </div> <!-- End of Info section row -->
    <div class="row" id='credit-card-info'>
         <!--Credit Cart Start-->
        <div class="col-md-offset-3 col-md-6">
             <h2 class='text-center'>Credit Card Details</h2>
                <div class="form-group">
                    <label for="card_name" class='col-md-3'>Name on Card</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="card_name" value="" placeholder="Name" id="card_name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="card_type" class='col-md-3'>Type</label>
                    <div class="col-md-5">
                        <select class="form-control" name="card_type" id="card_type">
                            <option>VISA</option>
                            <option>MasterCard</option>
                            <option>Discover</option>
                            <option>American Express</option>
                        </select>
                    </div>    
                </div>
                <div class="form-group">
                    <label for="card_number" class='col-md-3'>Card Number</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="card_number" value="" placeholder="Number" id="card_name"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for='expiration_date' class='col-md-3'>Expiration</label>
                    <div class="col-md-9">
                          <select class="form-control col-md-6" name="expiry-month" id="expiry-month">
                                <option>Month</option>
                                <option value="01">Jan </option>
                                <option value="02">Feb</option>
                                <option value="03">Mar</option>
                                <option value="04">Apr</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">Aug</option>
                                <option value="09">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                          </select>
                          <select class='form-control col-md-6' name="expiry-year" id='expiry-year'>
                                <option value="17">2017</option>
                                <option value="18">2018</option>
                                <option value="19">2019</option>
                                <option value="20">2020</option>
                                <option value="21">2021</option>
                                <option value="22">2022</option>
                                <option value="23">2023</option>
                          </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class='col-md-3'>CVC</label>
                    <div class="col-md-4">
                        <input type='text' class='form-control'  placeholder='Security Code'>
                    </div>
                </div>
            
   
            
            </div><!-- End of Credit card container -->
                <div id='pmt-submit'>
                       
                           <button type='submit' class='btn co-bean-theme'>Complete Purchase</button>
    
                </div>
            </div>
    </form>
    <script type="text/javascript">
        var check = document.querySelector('#ship-same-check');
        var container = document.querySelector('#ship-info-container');
        check.addEventListener('change', function(e) {
            if(check.checked) {
                container.classList.add('hidden');
            } else {
                container.classList.remove('hidden');
            }
        });
    </script>
</div>
