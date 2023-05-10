<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('/images/apple-icon-57x57.png') }}">


    <style type="text/css">
    @keyframes slideInFromLeft {
  0% {
    transform: translateY(+100%);
  }
  100% {
    transform: translateY(0);
  }
}
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic);

    html,
    body{ height: 100%;min-height: 100%;background: url('/images/blue_email_background.jpg')}
    body:before {
        background: #00afe1;
        height: 100%;
        width: 100%;
        float: left;
        clear: both;
        opacity: 0.95;
        content: "";
    }
    .container{
        position: absolute;
        width: 100%;
        text-align: center;
        height:100%;
        display: flex;
        align-items: center;
    }
    .row{
        display: contents;
    }
    .logo{
        width: 350px;
        margin-left: auto;
        margin-right: auto;
        background: #2341ad;
    }
    .bi{
        font-weight: 300;
        color:#4c4c4c;
        font-family: Open Sans Light,Open Sans,Arial;
        mso-font-alt: Arial;
        display: block;
    }
    .btn-custom{
        background-color:#c54040;
        border-color:#c54040;
        color:#fff;
    }
    a {
        -webkit-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
        -moz-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
        -ms-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
        -o-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
        transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
        display: block;
        margin: 20px auto;
        max-width: 180px;
        text-decoration: none;
        border-radius: 4px;
        padding: 20px 30px;
    }
    a.btn-animated {
       box-shadow: rgba(30, 22, 54, 0.4) 0 0px 0px 2px inset;
    }

    a.btn-animated:hover {
        border-color:rgb(76, 76, 76);
        box-shadow: rgb(76, 76, 76) 0 0px 0px 40px inset;
    }
    .btn-custom:hover,
    .btn-custom:visited{color:#fff;background-color: #8c2d2d;}
    .main_dv{
     animation: 0.5s ease-out 0s 1 slideInFromLeft;
     border: 2px solid #ececec;
     background: white;
     border-radius: 5px;
     margin-left: auto;
     margin-right: auto;
     width: 30%;
     box-shadow: 0 0 13px #7b7b7b;
     padding: 50px 0px;
    }
    .copyright{
        width: 100%;
        position: absolute;
        left: 0;
        bottom: 20px;
    }
    .copyright a,
    .copyright p{color:#fff; font-weight: 400;}


    </style>

</head>
<body>

@yield('content')

</body>
</html>