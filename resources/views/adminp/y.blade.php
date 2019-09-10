<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta style="font-family: 'B Nazanin'; font-size: medium;">
{{---------------------------------------------------------------------------------------------------------------------------}}
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/bootadmin.min.css">

    <title>pathology</title>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle mr-3" href="#"></a>
    <a class="navbar-brand" href="#">کاربر گرامی خوش آمدید</a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            {{--<li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-envelope"></i> 5</a></li>--}}
            {{--<li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-bell"></i> 3</a></li>--}}
            {{---------------/////////------///////////////////////////////////////////////////////////////////////////--}}
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        {{-----------comentesh kardam k gozine register az safhe log in bre------------------ --}}
                        {{--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                        {{-----------comentesh kardam k gozine register az safhe log in bre------------------ --}}

                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
            {{---------------/////////------///////////////////////////////////////////////////////////////////////////--}}

        </ul>
    </div>
</nav>

<div class="d-flex">
    <div class="sidebar sidebar-dark bg-dark">
        <ul class="list-unstyled">

            <li><a href="/adminhome" onclick="hs('user');"> بازگشت به صفحه مدیریت </a></li>
        </ul>
    </div>

    @yield('ss')
    </div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootadmin.min.js"></script>

</body>
</html>