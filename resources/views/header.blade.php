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
        <title>laraProject</title>


        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css"  href="/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/font-awesome-4.2.0/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
        
        <!-- Stylesheet
        ================================================== -->

        <link rel="stylesheet" type="text/css"  href="/css/style.css">
        <link rel="stylesheet" type="text/css" href="/css/responsive.css">



        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>



</head>
<!-- <body background="/img/background.png" style ="background-repeat:no-repeat";> -->
    <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container" >
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>


                      <div class="container-fluid">
                        <div class="navbar-header">
                          <a class="navbar-brand" href="/">laraProject</a>
                        </div>
                      </div>



                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">


                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> LogIn</a></li>
                            <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Register</a></li>
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
                                            LogOut
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
</div>
