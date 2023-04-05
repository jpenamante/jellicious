<div class="col-md-4">
    <div class="checkout-progress-sidebar ">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="unicase-checkout-title">Payment/ Other Information</h4>
                </div>
                <div class="panel-body">
                    <center>
                        <h3 id=estimated>...</h3>
                        <p>estimated time of delivery</p>
                        <br>

                        <form name="payment" method="post"
                            onsubmit="return confirm('Are you sure you all of your orders are final?');">
                            <input id=estimation_seconds type="hidden" name="estimation" value="">
                            <input id="COD" type="radio" name="paymethod" value="COD" checked="checked">
                            <label for="COD">COD</label> &nbsp; &nbsp; &nbsp;
                            <input id=GCash type="radio" name="paymethod" value="GCash">
                            <label for="GCash">GCash</label><br /><br />
                            <i id="gcashpayment" style="display:none">
                                <p>Please scan the QR Code to proceed payment</p>
                                <img src="/img/gcash.png" width="300" />
                                
                                <br />
                                <br />
                                <div class="form-group">
                                    <label class="info-title" for="transaction_code ">Transaction Code/ Reference Number
                                        <span>*</span></label>
                                    <input type="text" class="form-control unicase-form-control text-input" id="transaction_code" name="transaction_code" value="" >
                                </div>
                            </i>
                            <br />
                            <input class="btn-upper btn btn-primary checkout-page-button" type="submit"
                                value="Proceed" name="submit-payment">

                        </form>
                    </center>

                    <br />
                    <p> <i>Given time above is just an estimated delivery time - based on your Delivery Address
                            provided.</i> </p>
                </div>
            </div>
        </div>
    </div>
</div>