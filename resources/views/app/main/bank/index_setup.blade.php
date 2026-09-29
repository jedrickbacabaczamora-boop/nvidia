@extends('app.layout.app')
@section('header_content')
    <link rel="stylesheet" href="{{asset('app/')}}/assets/select2.min.css">
    <link rel="stylesheet" href="{{asset('app/')}}/assets/style.css">
    <style>
        .search-button {
            width: unset;
        }
        .modal-backdrop.show {
            display: none;
        }
        .navi-menu-button {
            width: unset;
        }
        header.no-background {
            background-color: #fff !important;
        }
        footer {
            margin-bottom: 0px;
        }
        .bank_form {
            background: #ffa009 !important;
        }
        .selector {
            color: #fff !important;
        }
        label {
            color: #fff !important;
        }
        span#method {
            color: #fff !important;
        }
    </style>
@endsection
@section('app_content')
    {{--    --}}
    <link rel="stylesheet" href="{{asset('app/css/bank.css')}}">
    <main class="margin" style="margin-top: 0">
        <section class="container">
            <div class="bank_header">
                <h4>{{translator('Bank Card Management')}}</h4>
            </div>
            <div class="bank_form">
                <form action="{{route('user.bank_setup_confirm')}}" method="POST">@csrf
                    <label for="name">{{translator('Name')}}: <input type="text" class="form-input" id="name" name="name"></label>

                    <div class="method d-flex justify-content-between" onclick="show_method()">
                        <div class="selector">{{translator('Payment Channel')}}:</div>
                        <div class="mr-2"> <span id="method">{{translator('Please select')}}</span> <i class="fa fa-arrow-right"></i> </div>
                        <input type="hidden" name="method_name" value="">
                    </div>

                    <label for="payment_number">{{translator('Payment Number')}}: <input type="text" class="form-input" id="payment_number" name="payment_number"></label>

                    <label for="password">{{translator('Payment password')}}: <input type="text" class="form-input" id="password" name="password"></label>
                    <div class="c_btn">
                        <button type="submit">{{translator('Confirmation')}}</button>
                    </div>
                </form>
            </div>
        </section>
        <div class="bank_container" onclick="hideMethod(this)">
            <div class="show_bank">
                <ul>
                    <li onclick="getMethod('bkash')">bKash</li>
                    <li onclick="getMethod('nagad')">Nagad</li>
                </ul>
            </div>
        </div>
    </main>

    <script>
        function show_method()
        {
            document.querySelector('.bank_container').style.visibility ='visible';
            document.querySelector('.bank_container').style.zIndex ='1';
            document.querySelector('.show_bank').style.bottom = 0+'%';
        }

        function hideMethod(_this)
        {
            document.querySelector('.show_bank').style.bottom = -100+'%';
            document.querySelector('.bank_container').style.visibility ='hidden';
            document.querySelector('.bank_container').style.zIndex ='0';
        }

        function getMethod(method)
        {
            document.getElementById('method').innerText = method
            document.querySelector('input[name="method_name"]').value = method
        }
    </script>
@endsection
