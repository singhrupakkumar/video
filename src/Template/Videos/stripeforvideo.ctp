
<style>
.payment-errors{ color:red;  }
</style>
   <section class="st-content">
    
    
      <section class="change-pass theme-marg">
        <div class="container">
				<div class="top-heading pt-0 pb-5 text-center">
                   	<h2 class="text-white">Payment Details</h2>
                 </div>
            <div class="row">
                 <?= $this->Flash->render() ?>
                <div class="col-md-5 mx-auto">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<div class="payment-errors"></div>
<div class="change-inner float-left w-100">
<form  method="POST" id="payment-form">
    <div class="form-group">
        <label>Card Number</label>
        <input type="text" size="20" autocomplete="off" class="card-number form-control" />
    </div>
    <div class="form-group">
        <label>CVC</label>
        <input type="text" size="4" autocomplete="off" class="card-cvc form-control" />
    </div>
    <div class="form-group">
        <label>Expiration (MM/YYYY)</label>
		<div class="form-row">
			<div class="form-group col-md-3"><input type="text" size="2" class="card-expiry-month form-control"/></div>
			<div class="form-group col-md-1"><span class="back-slash"> / </span></div>
			<div class="form-group col-md-3"><input type="text" size="4" class="card-expiry-year form-control"/></div>
		</div>
    </div>
    <button type="submit" class="submit-button theme-btn grey">Submit Payment</button>
</form>
</div>

  </div>
            </div>
        </div>
      </section>  
    
    
  </section><!--st-content-end-->

 <script type="text/javascript">
    // this identifies your website in the createToken call below
    Stripe.setPublishableKey('pk_test_Ost0pIHU1azAEl95yCdQN0pK');
    function stripeResponseHandler(status, response) {
        if (response.error) {
            // re-enable the submit button
            $('.submit-button').removeAttr("disabled");
            // show the errors on the form
            $(".payment-errors").html(response.error.message);
        } else {
            var form$ = $("#payment-form");
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            // and submit
            form$.get(0).submit();
        }
    }
    $(document).ready(function() {
        $("#payment-form").submit(function(event) {
            // disable the submit button to prevent repeated clicks
            $('.submit-button').attr("disabled", "disabled");
            // createToken returns immediately - the supplied callback submits the form if there are no errors
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
            return false; // submit from callback
        });
    });
</script>