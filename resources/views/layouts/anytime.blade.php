<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }} | {{ config('app.name') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Avant">
    <meta name="author" content="The Red Team">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <link href="assets/less/styles.less" rel="stylesheet/less" media="all">  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/styles.css">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" href="/assets/css/b4grid.css">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="/assets/css/custom.css?={{ rand(1, 100000)}}">
    {{-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'> --}}
    <link rel="stylesheet" type="text/css" href="/assets/fonts/glyphicons/css/glyphicons.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    @yield('css')
    @stack('css')
    <!--
    <link href='assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='styleswitcher'>
    <link href='assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher'> -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
    <!--[if lt IE 9]>
        <link rel="stylesheet" href="assets/css/ie8.css">
		<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
        <script type="text/javascript" src="assets/plugins/charts-flot/excanvas.min.js"></script>
	<![endif]-->

    <!-- The following CSS are included as plugins and can be removed if unused-->

    <style type='text/css'>

    </style>
    <!-- <script type="text/javascript" src="assets/js/less.js"></script> -->
</head>

<body class="collapse-leftbar">
    <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
        <a id="leftmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="right" title="Toggle Sidebar"></a>
        {{-- <a id="rightmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="left" title="Toggle Infobar"></a>
        --}}

        <div class="navbar-header pull-left">
            <a class="navbar-brand" href="/">Anytime Fitness</a>
        </div>

        <ul class="nav navbar-nav pull-right toolbar">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle username" data-toggle="dropdown"><span class="hidden-xs">Logged in:
                        <strong>{{Auth::user()->name}}</strong> &nbsp;<i class="fa fa-caret-down"></i></span></a>
                <ul class="dropdown-menu userinfo arrow">
                    <li class="username">
                        <a href="#">
                            <div class="pull-right">
                                <h5>Howdy, {{Auth::user()->name}}!</h5><small>Logged in as <span>{{Auth::user()->email}}</span></small>
                            </div>
                        </a>
                    </li>
                    <li class="userlinks">
                        <ul class="dropdown-menu">
                        <li><a href="{{route("user.password")}}">Change Password <i class="pull-right fa fa-lock"></i></a></li>
        					<!-- <li><a href="#">Account <i class="pull-right fa fa-cog"></i></a></li>
        					<li><a href="#">Help <i class="pull-right fa fa-question-circle"></i></a></li> -->
                            <!-- <li class="divider"></li> -->
                            <li><a href="{{ route('logout') }}" class="text-right" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </header>

    <div id="page-container">
        <!-- BEGIN SIDEBAR -->
        <nav id="page-leftbar" role="navigation">
            <!-- BEGIN SIDEBAR MENU -->
            <ul class="acc-menu" id="sidebar">
                {{-- @unless (!Auth::user()->isAdmin())
                <li><a href="javascript:;"><i class="fas fa-user-tie"></i> <span>Administration</span></a>
                    <ul class="acc-menu">
                        <li><a href="{{route('admin.dash')}}">Dashboard</a></li>
                        <li><a href="{{route('admin.users')}}">User Management</a></li>
                    </ul>
                </li>
                <li class="divider"></li>
                @endunless --}}

                @unless (!Auth::user()->isAdmin())
                <li><a href="{{route('dash')}}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
                @endunless
                {{-- @unless (Auth::user()->isAdmin())
                <li><a href="{{route('home')}}"><i class="fas fa-home"></i> <span>Home</span></a></li>
                @endunless --}}

                @unless (!Auth::user()->isAdmin())
                <li class="divider"></li>
                <li><a href="javascript:;"><i class="fas fa-dumbbell"></i> <span>Gyms</span></a>
                    <ul class="acc-menu">
                        <li><a href="{{route('gyms.list')}}">View All</a></li>
                        <li><a href="{{route('gyms.new')}}">Add Gym</a></li>
                    </ul>
                </li>
                {{-- <li class="divider"></li>
                <li><a href="{{route('members.list')}}"><i class="fas fa-users"></i> <span>Members</span></a></li> --}}
                @endunless
                {{-- <li><a href="javascript:;"><i class="fas fa-bicycle"></i> <span>Trainers</span></a>
                    <ul class="acc-menu">
                    </ul>
                </li> --}}
        </nav>
        <div id="page-content">
            <div id='wrap'>
                <div id="page-heading">
                    {{-- <ol class="breadcrumb">
                        <!-- <li><a href="index.htm">Dashboard</a></li> -->
                        <!-- <li>/</li> -->
                    </ol> --}}

                    {{ Breadcrumbs::render() }}


                    <h1>{{ $title }}</h1>
                    
                    <div class="options">
                        @yield('options')
                    </div> 
                </div>
                <div class="container-fluid">
                    @yield('content')

                    <!-- <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4>Bar Graph</h4>
                            <div class="options">
                            </div>
                        </div>
                        <div class="panel-body">
                          <div id="bar-example"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4>Line Graph</h4>
                            <div class="options">
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="line-example"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4>Donut Graph</h4>
                            <div class="options">
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="donut-example"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4>Area Graph</h4>
                            <div class="options">
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="area-example"></div>
                        </div>
                    </div>
                </div>
            </div> -->


                </div>
            </div>
            <!--wrap -->
        </div> <!-- page-content -->

        <footer role="contentinfo">
            <div class="clearfix">
                <ul class="list-unstyled list-inline">
                    <li>Volution &copy; 2019</li>
                    <button class="pull-right btn btn-inverse-alt btn-xs hidden-print" id="back-to-top"><i class="fa fa-arrow-up"></i></button>
                </ul>
            </div>
        </footer>

    </div> <!-- page-container -->

    <!--
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script>!window.jQuery && document.write(unescape('%3Cscript src="assets/js/jquery-1.10.2.min.js"%3E%3C/script%3E'))</script>
<script type="text/javascript">!window.jQuery.ui && document.write(unescape('%3Cscript src="assets/js/jqueryui-1.10.3.min.js'))</script>
-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    {{-- <script type='text/javascript' src='/assets/js/jqueryui-1.10.3.min.js'></script> --}}
    <script type='text/javascript' src='/assets/js/bootstrap.min.js'></script>
    <script type='text/javascript' src='/assets/js/enquire.js'></script>
    <script type='text/javascript' src='/assets/js/jquery.cookie.js'></script>
    <script type='text/javascript' src='/assets/js/jquery.nicescroll.min.js'></script>
    {{-- <script type='text/javascript' src='assets/plugins/form-toggle/toggle.min.js'></script> --}}
    <script type='text/javascript' src='/assets/js/placeholdr.js'></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script type='text/javascript' src='/assets/js/application.js?g=12'></script>
    @yield('js')
    @stack('js')

</body>

</html>