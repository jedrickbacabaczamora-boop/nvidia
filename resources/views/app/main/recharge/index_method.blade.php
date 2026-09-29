<html data-dpr="1" style="font-size: 38px;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Payment - CheckOut</title>
    <link href="css/style.css" rel="stylesheet">
    <style>
        .upi_content {
            padding: 0.3rem !important;
        }
        .upi_content img {
            height: 36px !important;
            width: 40px;
        }
        .radio {
            margin: 0.15rem;
            margin-top: 12px;
        }
        .upi_content {
            box-shadow: 0px 5px 10px #00000036;
        }
    </style>
    <style>
        h4.tx1 {
            font-size: 15px;
            margin-bottom: 8px;
            border-bottom: 1px solid orangered;
            padding-bottom: 8px;
        }
        .modal {
            width: 91%;
        }
        .modal.modal-fixed-footer {
            padding: 0;
            height: 70%;
        }
        .tx3 {
            display: flex;
            justify-content: space-between;
            margin-top: 16px;
            background: #00000021;
            padding: 6px 7px;
            border-radius: 5px;
            align-items: center;
        }
        .modal .modal-close {
            cursor: pointer;
            background: #446293;
            color: #fff;
        }
        label {
            font-size: 16px;
        }
        input:not([type]), input[type=text]:not(.browser-default), input[type=password]:not(.browser-default), input[type=email]:not(.browser-default), input[type=url]:not(.browser-default), input[type=time]:not(.browser-default), input[type=date]:not(.browser-default), input[type=datetime]:not(.browser-default), input[type=datetime-local]:not(.browser-default), input[type=tel]:not(.browser-default), input[type=number]:not(.browser-default), input[type=search]:not(.browser-default), textarea.materialize-textarea {
            outline: none;
            height: 25px;
        }
        .pay_img img {
            width: 130px;
            height: 130px;
            border-radius: 50%;
        }

    </style>
    <link rel="stylesheet" href="css/layer.css" id="layuicss-layer">
</head>
<body class="overflow">
<div class="main" style="padding-top:0.2rem;background-color:#fff;">
    <div class="money_content">
        <span class="money_title" style="font-size:18px;">UPI CheckOut</span>
        <div class="money" style="font-size:14px">Total Amount Payable: <font id="money">
                ৳.
                <script>
                    var amount = 1200;
                    document.write(amount.toFixed(1))
                </script>
            </font>
        </div>
    </div>

    <div class="content" style="background-color:#fff0;box-shadow:none;">
        <div class="option"></div>
        <div class="top">choose payment method</div>
        <div class="upi_content" onclick="methoder(this, 'bkash')">
            <img src="img/bkash.png" style="padding:2px">
            <div style="float:right">
                <div class="radio">
                    <input id="radio-1" name="paymethod" type="radio"
                           class="methoder"
                           checked=""
                           value="">
                    <label for="radio-1" class="radio-label"></label>
                </div>
            </div>
        </div>
        <div class="upi_content" onclick="methoder(this, 'nagad')">
            <img src="img/nagad.png">
            <div style="float:right">
                <div class="radio">
                    <input id="radio-2" name="paymethod" type="radio"
                           value=""
                           class="methoder"
                    >
                    <label for="radio-2" class="radio-label"></label>
                </div>
            </div>
        </div>

        <div class="upi_content" onclick="methoder(this, 'rocket')" style="display: none !important;">
            <img src="img/rocket.png">
            <div style="float:right">
                <div class="radio">
                    <input id="radio-3" name="paymethod" type="radio"
                           class="methoder"
                           value="">
                    <label for="radio-3" class="radio-label"></label>
                </div>
            </div>
        </div>

        <div class="upi_content" onclick="methoder(this, 'qr')">
            <img src="img/upi.png">
            <div style="float:right">
                <div class="radio">
                    <b id="lb_qrcode">Click To Show QRCode</b>
                </div>
            </div>
            <div id="div_qrcode" style="width:100%;height:230px;padding-top:8px;display:none;">
                <div style="text-align:center;font-size:14px;padding-bottom:5px">Use Mobile Scan Code to Pay</div>

                <div style="text-align:center;" id="qrcode"
                     title="">
                    <canvas width="180" height="180"></canvas>
                </div>
            </div>
        </div>

        <p class="tip_content">
            <font color="red">Make sure for payment all requirement is ready.</font>
        </p>
    </div>
</div>


<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 class="tx1">Send Money 1200.00 Form</h4>
        <div class="pay_img" style="text-align: center;">
            <img class="ppImage" src="img/bkash.png">
        </div>
        <p class="tx2">
            Please upload the payment voucher within the specified time, otherwise the OTC has the right to cancel the order.
        </p>

        <div class="tx3">
            <div>
                <div>Copy this number.</div>
                <div>01933690444</div>
            </div>
            <div><img onclick="copyTextNumber('01933690444')" src="https://img.icons8.com/material-sharp/24/copy.png" alt=""></div>
        </div>

        <div class="custom-form-group">
            <label for="amount">Selected Amount:</label>
            <input type="number" name="amount" id="amount" placeholder="amount" value="1200" class="custom-form-control" readonly>
        </div>
        <div class="custom-form-group">
            <label for="number">Enter your account number:</label>
            <input type="number" name="amount" id="number" class="custom-form-control" placeholder="Account number">
        </div>
        <div class="custom-form-group">
            <label for="trx">Enter your payment transaction ID:</label>
            <input type="text" name="trx" id="trx" class="custom-form-control" placeholder="Account number">
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree & Submit</a>
    </div>
</div>


<div class="foot" style="box-shadow:none;">
    <button id="submit" href="#modal1" class="modal-trigger">Pay
        ৳.
        <script>
            var amount = 1200;
            document.write(amount.toFixed(1))
        </script></button>
</div>
<input id="paymethod" type="hidden" value="">
<input type="hidden" name="payment_operator">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    function methoder(_this, method){
        if (method == 'qr'){
            alert('Not Ready Scan')
            return 0;
        }
        if (method == 'rocket'){
            alert('Not Ready Operator')
            return 0;
        }

        let elements = document.querySelectorAll('.paymethod');
        for (let i = 0; i < elements.length; i++){
            elements[i].removeAttribute('checked');
        }

        let paymenthod = _this.querySelector('input');
        if (!paymenthod.getAttribute('checked')){
            paymenthod.setAttribute('checked', '');
        }

        document.querySelector('input[name="payment_operator"]').value = method;

        if (method == 'bkash' || method == 'nagad'){
            $('.modal').modal();
            document.querySelector('.ppImage').src = `{{asset('public/api')}}/img/${method}.png`
        }
    }

    function copyTextNumber(number){
        alert(number)
    }
</script>
</body>
</html>
