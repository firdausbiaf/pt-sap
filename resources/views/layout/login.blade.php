<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"> --}}
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="path/to/your-custom-js-file.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
{{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}

<link rel="preload" href="images/bg-login3.png" as="image">

    <style>
        @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
        .login-block{
            background: #DE6262;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to bottom, #FFB88C, #DE6262); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            float:left;
            width:100%;
            padding : 50px 0;
        }
        .banner-sec{background:url("images/sap.jpg")  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 10px 10px 10px 10px; padding:0;}
        .container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
        .carousel-inner{border-radius:10px 10px 10px 10px;}
        .carousel-caption{text-align:left; left:5%;}
        .login-sec{padding: 50px 30px; position:relative;}
        .login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
        .login-sec .copy-text i{color:#FEB58A;}
        .login-sec .copy-text a{color:#ac2828;}
        .login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #1F3C78;}
        .login-sec h2:after{content:" "; width:100px; height:5px; background:#1F3C78; display:block; margin-top:20px; border-radius:10px; margin-left:auto;margin-right:auto}
        .btn-login{background: #ffffff; color:#791111; font-weight:600;}
        .banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
        .banner-text h2{color:#fff; font-weight:600;}
        .banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:10px;}
        .banner-text p{color:#fff;}

        .login-block {
            background: url("images/bg-login3.png");
            background-size: cover; /* Adjust the background size */

            float: left;
            width: 100%;
            height: 100vh; /* Set minimum height to cover the viewport */
            display: flex;
            justify-content: center;
            align-items: center;
            
        }
        .carousel-item.active img {
            width: 100%;
            height: 500px; /* Set the desired height */
            object-fit: cover; /* This ensures the image maintains its aspect ratio */
        }

        @media (max-width: 768px) {
            .login-block {
                        padding: 30px 0;
            }
        }
        .carousel-caption {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .carousel-caption h1 {
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 10px; /* Set the desired font size for h1 */
        }

        .carousel-caption h3 {
            font-size: 25px; /* Set the desired font size for h3 */
        }

        .carousel-item::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3); /* Blue color with 0.5 opacity */
        }

        .modal-dialog {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        /* Center the modal content */
        .modal-content {
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        
        .login-form {
            background-color: #1F3C78; /* Set your desired background color here */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        

        .red-input {
            background-color: rgba(185, 17, 17, 0.856); /* Set your desired background color here */
        }
</style>

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="css/login.css"> --}}
    <title>Login</title>
</head>
<body>
    @yield('content')
    <!-- Your custom JavaScript file -->
    <script src="path/to/your-custom-js-file.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
</body>
</html>
