<?php 
include('includes/db.php');
if (isset($_COOKIE['userLoggedin']) && isset($_SESSION['email'])) {
    echo '<script>
            window.location = "home";
        </script>';
}else{
    
}
?>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="language" content="English">
<meta name="author" content="Mutale Mulenga">

<!-- Primary Meta Tags -->
<title>Osabox.co - Keep track of your payroll and projects with one tool</title>
<meta name="title" content="Osabox.co - Keep track of your payroll and projects with one tool">
<meta name="description" content="The simplest payroll and project management system that helps you stay connected with your clients and team members.">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://osabox.co/">
<meta property="og:title" content="Osabox.co - Keep track of your payroll and projects with one tool">
<meta property="og:description" content="The simplest payroll and project management system that helps you stay connected with your clients and team members.">
<meta property="og:image" content="https://osabox.co/images/Osabox.png">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://osabox.co/">
<meta property="twitter:title" content="Osabox.co - Keep track of your payroll and projects with one tool">
<meta property="twitter:description" content="The simplest payroll and project management system that helps you stay connected with your clients and team members.">
<meta property="twitter:image" content="https://osabox.co/images/Osabox.png">
<link rel="icon" type="icon" href="dist/images/icon_new.png">
<link rel="canonical" type="text/css" href="https://osabox.co/">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap-icons/font/bootstrap-icons.css">
<link rel="icon" type="text/css" href="images/icon2.png">
<link rel="stylesheet" type="text/css" href="css/link.css">
<link rel="stylesheet" type="text/css" href="css/buttons.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<!-- <link rel="stylesheet" href="toastr/toastr.min.css"> -->
<link rel="stylesheet" href="intl.17/build/css/intlTelInput.css">
<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
    <style>
    html {
        scroll-behavior: smooth;
    }
    body {
        font-family: proxima-nova,Sans-serif; 
    }
    .navbar {
        background-color: #fff;
    }
    
    a:active, a:link {
        text-decoration: none;
    }
    .first_section {
        margin: 10em auto;
    }
    .fourth_section {
        margin: 10em auto;
        background-color: #6499cd;
        padding: 5em;
    }
    .front {
        margin: 8em auto;
    }
    .front h1 {
        /*font-size: 4em;*/
        color: #6499cd;
        /*text-align: center;*/
    }
    .fs-6{
        font-size: 18px !important;
        line-height: 30px;
    }
    img.project { border: 1px solid #eee;
        /*-webkit-box-shadow: 4px 4px 4px rgba(0,0,0,0.2);
        -moz-box-shadow: 4px 4px 4px rgba(0,0,0,0.2); box-shadow: 4px 4px 4px rgba(0,0,0,0.2);*/
        -webkit-transition: all 0.5s ease-out;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        border-radius: .5em;
    }

    img.project:hover {
        -webkit-transform: rotate(-7deg);
        -moz-transform: rotate(-7deg);
        -o-transform: rotate(-7deg);
        transform: scale(1.2);
    }

    img.payroll {
        position:relative;
        -webkit-animation:glide 2s ease-in-out alternate infinite;
        border-radius: .3em;
        box-shadow: transparent 0px 0px 0px 2px inset, rgb(255, 255, 255) 10px -10px 0px -3px, rgb(31, 193, 27) 10px -10px, rgb(255, 255, 255) 20px -20px 0px -3px, rgb(255, 217, 19) 20px -20px, rgb(255, 255, 255) 30px -30px 0px -3px, rgb(255, 156, 85) 30px -30px;
        /*box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;*/
    }

    @-webkit-keyframes glide  {
       from {
          left:0px;
          top:0px;
       }
       
       to {
          left:0px;
          top:20px;
       }
    }
    .w-100 {
        min-height: 12.5em;
    }
    img.todolist {
       -webkit-transition: all 0.5s ease-out;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        -webkit-transform: rotate(-7deg);
        -moz-transform: rotate(-7deg);
        -o-transform: rotate(-7deg); 
        margin-top: -4em;
        width: 100%;
        margin-bottom: 5em;
        margin-left: 8em;
        border:5px solid #6499cd;
    }
    img.todolist:hover {
        /*-webkit-transform: rotate(7deg);
        -moz-transform: rotate(7deg);
        -o-transform: rotate(7deg);*/
    }
    @media screen and (max-width: 992px) {
        .first_section {
            margin: 5em auto;
        }
        .fourth_section {
            padding: 1em;
            margin-bottom: 5em;
        }
        img.todolist {
           -webkit-transition: all 0.5s ease-out;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -o-transform: rotate(0deg); 
            margin-top: 1em;
            width: 100%;
            margin-bottom: 1em;
            margin-left: 0em;
            border:1px solid #6499cd;
        }
    }

    /* DARK MODE*/
    .body_ {
        background-color: #26272b;
        color: #6499cd; 
    }
    .navbar_ {
        background-color: #26272b;
    }
    .navbar_link {
        color: #fff;
    }
            
</style>
<script>
    function successNow(msg){
        toastr.success(msg);
        toastr.options.progressBar = true;
        toastr.options.positionClass = "toast-top-center";
        toastr.options.showDuration = 1000;
    }

    function errorNow(msg){
        toastr.error(msg);
        toastr.options.progressBar = true;
        toastr.options.positionClass = "toast-top-center";
        toastr.options.showDuration = 1000;
    }
</script>