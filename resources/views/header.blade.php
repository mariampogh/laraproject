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
          <div class="container-fluid container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/">laraProject</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                     @foreach($categories as $cat)
                    <li><a href="/getProducts/{{$cat->id}}">{{$cat->name}}</a></li>
                    @endforeach
                  </ul>
                </li>
              </ul>
              <form class="navbar-form navbar-left" action="/searchProduct "method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="text" class="form-control" placeholder="Search" name="search" >
                </div>
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </form>

              <ul class="nav navbar-nav navbar-right">
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
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
</div>
