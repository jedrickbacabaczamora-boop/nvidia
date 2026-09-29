<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h2 style="text-align: center">Email Verification for change method bank details</h2>
<hr>
<p>Hi. {{auth()->user()->name}} welcome to our {{env('APP_NAME')}}</p>

<table>
    <tr>
        <td>Name</td>
        <td>{{auth()->user()->name}}</td>
    </tr>
    <tr>
        <td>username</td>
        <td>{{auth()->user()->username}}</td>
    </tr>
    <tr>
        <td>Bank method</td>
        <td>{{\App\Models\PaymentMethod::find($data['method'])->name}}</td>
    </tr>
    <tr>
        <td>Bank number</td>
        <td>{{$data['number']}}</td>
    </tr>
    <tr>
        <td>Verification Code</td>
        <td>{{$data['code']}}</td>
    </tr>
</table>

</body>
</html>

