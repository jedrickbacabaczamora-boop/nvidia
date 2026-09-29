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

<h2 style="text-align: center">Email Verification</h2>
<hr>
<p>Hi. {{$user->name}} welcome to our {{env('APP_NAME')}}</p>
<p>Dear. Please verify your email using verification code</p>

<table>
    <tr>
        <td>Name</td>
        <td>{{$user->name}}</td>
    </tr>
    <tr>
        <td>username</td>
        <td>{{$user->username}}</td>
    </tr>
    <tr>
        <td>Verification Code</td>
        <td>{{$user->code}}</td>
    </tr>
    <tr>
        <td>Go to</td>
        <td><a href="{{$url}}" target="_blank" style="padding: 5px 10px; background: greenyellow ">Go To</a></td>
    </tr>
</table>

</body>
</html>

