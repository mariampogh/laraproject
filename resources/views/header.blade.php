<!DOCTYPE html>
<!-- <html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> -->

    <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
<!--
    <title>{{ config('app.name', 'Laravel') }}</title>  -->

    <!-- Styles -->

    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <html lang="en">
      <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>eLearning</title>
        <meta name="description" content="Your Description Here">
        <meta name="keywords" content="free boostrap, bootstrap template, freebies, free theme, free website, free portfolio theme, portfolio, personal, cv">
        <meta name="author" content="Jenn, ThemeForces.com">

        <!-- Favicons
        ================================================== -->
        <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/img/apple-touch-icon-114x114.png">

        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css"  href="/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/font-awesome-4.2.0/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="/css/jasny-bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/css/animate.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
        <!-- Slider
        ================================================== -->
        <link href="/css/owl.carousel.css" rel="stylesheet" media="screen">
        <link href="/css/owl.theme.css" rel="stylesheet" media="screen">

        <!-- Stylesheet
        ================================================== -->

        <link rel="stylesheet" type="text/css"  href="/css/style.css">
        <link rel="stylesheet" type="text/css" href="/css/responsive.css">



        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

        <script type="text/javascript" src="/js/modernizr.custom.js"></script>


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


</head>
<!-- <body background="/img/background.png" style ="background-repeat:no-repeat";> -->
    <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top" style=" background-image: url(/img/header.jpg);background-position: 100% 100%;">
            <div class="container" >
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <nav id = "nav">
                      <div class="container-fluid">
                        <div class="navbar-header">
                          <a class="navbar-brand" href="/">eLearning</a>
                        </div>
                      </div>
                    </nav >


                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Մուտք</a></li>
                            <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Գրանցվել</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Դուրս գալ
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
