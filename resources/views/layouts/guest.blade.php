<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Supply Chain Management System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        input[type="email"],
        input[type="password"],
        input[type="text"]{
            width:100%;
            padding:12px 15px;

            border:1px solid #d1d5db;

            border-radius:10px;

            background:#ffffff;

            color:#374151;

            transition:.3s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus{

            border-color:#2563eb;

            box-shadow:
            0 0 0 3px rgba(37,99,235,.15);

            outline:none;
        }

        .remember-checkbox{
            width:18px;
            height:18px;
            accent-color:#2563eb;
            cursor:pointer;
        }

        .text-gray-700{
            color:#111827 !important;
        }

        .remember-text{
            color:#111827;
            font-size:14px;
        }

        body{
            margin:0;
            font-family:'Segoe UI',sans-serif;
        }

        .login-wrapper{
            min-height:100vh;
            display:flex;
        }

        .login-left{
            width:50%;
            background:linear-gradient(
                135deg,
                #0f172a,
                #1e3a8a,
                #2563eb
            );

            color:white;

            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;

            text-align:center;
            padding:60px;
        }

        .login-right{
            width:50%;
            background:#f8fafc;

            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-card{
            width:450px;
            background:white;

            padding:40px;

            border-radius:20px;

            box-shadow:
            0 15px 40px rgba(0,0,0,.1);
        }

        .scm-logo{
            width:120px;
            margin-bottom:20px;
        }

        .warehouse-img{
            width:280px;
            margin:35px 0;
        }

        .title{
            font-size:34px;
            font-weight:700;
            line-height:1.2;
        }

        .subtitle{
            margin-top:15px;
            opacity:.9;
            font-size:18px;
        }

        .footer{
            margin-top:20px;
            opacity:.9;
        }

        @media(max-width:992px){

            .login-left{
                display:none;
            }

            .login-right{
                width:100%;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="login-left">

        <img
            src="{{ asset('assets/img/scm-logo.png') }}"
            class="scm-logo">

        <div class="title">
            SUPPLY CHAIN<br>
            MANAGEMENT SYSTEM
        </div>

        <div class="subtitle">
            Smart Inventory Control
            for Supply Chain Optimization
        </div>

        <img
            src="{{ asset('assets/img/warehouse.png') }}"
            class="warehouse-img">

        <div class="footer">
            Kelompok 4<br>
            Universitas Dian Nusantara
        </div>

    </div>

    <div class="login-right">

        <div class="login-card">

            {{ $slot }}

        </div>

    </div>

</div>

</body>
</html>