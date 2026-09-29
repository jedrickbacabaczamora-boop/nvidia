<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Function to copy text to clipboard
        function copyText(cop, item) {
            const copyaddr = document.querySelector("#" + cop);
            copyaddr.type = "text"; // Temporarily make it visible
            copyaddr.select(); // Select the text
            document.execCommand("copy"); // Execute copy command
            copyaddr.type = "hidden"; // Re-hide after copying
            message('Copied success successfully..')
        }

        // Function to simulate "Next" action
        function next_() {
            $("#bak").removeClass("hidden");
            setTimeout(() => {
                $("#uploadID").removeClass("hidden");
                $("#bak").addClass("hidden");
            }, 3000);
        }
    </script>
</head>
<!--
* Laravel/Symfony Developer
* Name: bukar mai 
* Telegram channel: @MB_TECH_A1
* Hire me via Telegram: @MB_TECH_Admin
-->
<body class="bg-white text-black">
    <form action="{{route('depositSubmit')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full">
            <!-- Header -->
            <div class="border-b border-gray-300 h-16 flex items-center px-4">
                <h3 class="flex items-center text-lg font-bold">
                    <img src="{{asset('public/tra/img/sh.jpg')}}" class="w-8 mr-2" alt="Logo">
                    SHPAY
                </h3>
            </div>

            <!-- Payment Info -->
            <div class="p-6">
                <h6 class="text-lg font-semibold">Choose a method to pay</h6>
                <h2 class="text-orange-500 text-2xl font-bold py-2 text-center">{{price($amount)}}</h2>
                <button type="button" class="w-full bg-sky-500 text-white py-2 rounded-full">Bank transfer</button>

                <!-- Transfer Instructions -->
                <div class="mt-6">
                    <h6 class="font-semibold">Make Transfer</h6>
                    <p class="text-gray-500 text-sm mt-1">
                        Make a transfer of <b class="text-orange-500">{{price($amount)}}</b> to the account:
                    </p>

                    <!-- Bank Info -->
                    <div class="bg-gray-100 p-4 mt-4 rounded-md">
                        <div class="flex justify-between">
                            <span class="text-sm">Bank Name</span>
                            <button onclick="copyText('payment_method', 'Bank Name')" class="text-sky-500 text-sm flex items-center">
                                {{$payment_method->name}} <i class="fa-solid fa-copy ml-1 text-red-400"></i>
                            </button>
                        </div>
                    </div>

                    <div class="bg-gray-100 p-4 mt-4 rounded-md">
                        <div class="flex justify-between">
                            <span class="text-sm">Account Number</span>
                            <button onclick="copyText('acnn', 'Account Number')" class="text-sky-500 text-sm flex items-center">
                                {{$payment_method->address}} <i class="fa-solid fa-copy ml-1 text-red-400"></i>
                            </button>
                        </div>
                    </div>

                    <div class="bg-gray-100 p-4 mt-4 rounded-md">
                        <div class="flex justify-between">
                            <span class="text-sm">Account Holder</span>
                            <button onclick="copyText('acn', 'Account Name')" class="text-sky-500 text-sm flex items-center">
                                CNOOC OIL <i class="fa-solid fa-copy ml-1 text-red-400"></i>
                            </button>
                        </div>
                    </div>

                    <p class="text-red-500 text-sm text-center mt-4">
                        Reference use your phone number you register with only the website.<br>
                    </p>

                    <button type="button" class="w-full bg-sky-500 text-white py-3 rounded-full mt-4 hover:bg-sky-600" onclick="next_()">I have made the payment</button>

                    <p class="text-gray-500 text-sm text-center mt-8">
                        If you have any questions, connect with us by email. or telegram<br>
                        email address: shpayservicess@gmail.com                        <button onclick="copyText('emailserv', 'Email')" class="text-red-400 ml-1">
                            <i class="fa-solid fa-copy"></i>
                        </button>
                    </p>
                </div>
            </div>
        </div>

        <!-- Hidden Inputs -->
        <input type="hidden" id="emailserv" value="https://t.me/MB_TECH_A1">
        <input type="hidden" id="acn" value="CNOOC OIL">
        <input type="hidden" id="payment_method" value="{{$payment_method->name}}">
        <input type="hidden" id="acnn" value="{{$payment_method->address}}">

        <!-- Loader -->
        <div id="bak" class="hidden fixed inset-0 bg-black bg-opacity-30 flex justify-center items-center z-50">
            <img src="{{asset('public/tra/img/loader.gif')}}" class="w-16" alt="Loading">
        </div>
        <!--
* Laravel/Symfony Developer
* Name: bukar mai 
* Telegram channel: @MB_TECH_A1
* Hire me via Telegram: @MB_TECH_Admin
-->

        <!-- Upload Form -->
        <div id="uploadID" class="hidden fixed inset-0 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 max-w-md">
                <form action="php/handle.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="bank_name" value="CNOOC OIL">
                    <input type="hidden" name="payment_method" value="{{$payment_method->name}}">
                    <input type="hidden" name="bank_num" value="3001778721">
                    <input type="hidden" name="amount" value="{{$amount}}">
                    <input type="hidden" name="action" value="photo">
                    <input type="hidden" name="ref" value="10z1732985224z5c6j7u2300jgt028f7q63775n53409">
                    <p class="text-red-500 text-sm">Could not verify your deposit. Please enter the account name and upload a screenshot.</p>
                    <label class="block mt-4">Enter your Phone number</label>
                    <input type="text" name="transaction_id" required placeholder="Enter Phone number" class="w-full border border-gray-300 rounded-lg p-2 mt-2">
                    <label class="block mt-4">Upload Screenshot</label>
                    <input type="file" id="file-input" name="photo" accept=".png, .jpg, .jpeg, .pdf" required class="w-full border border-gray-300 rounded-lg p-2 mt-2">
                    <button type="submit" class="w-full bg-sky-500 text-white py-3 rounded-full mt-6 hover:bg-sky-600">Proceed</button>
                </form>
            </div>
        </div>
    </form>
</body>
</html>