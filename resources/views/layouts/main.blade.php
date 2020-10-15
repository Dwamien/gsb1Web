<!doctype html>
<html lang="fr">
    <head>
        <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/gsb.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/bootstrap-theme.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    </head>
    <body class="body">
        <div class="container">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar+ bvn"></span>
                        </button>
                        <a class="navbar-brand" href="{{ url('/') }}" style="padding-right:135px">GSB</a>
                    </div>

                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        @auth
                        @can('compose')
                        <ul class="nav navbar-nav">
                            <li><a href="{{ route('Composition.index') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Gestion des compositions</a></li>
                        </ul>
                        @endcan
                        @endauth
                        @guest
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url('/login') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Se connecter</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __("S'inscrire") }}</a></li>
                        </ul>
                        @endguest
                        @auth
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a  data-toggle="collapse" data-target=".navbar-collapse.in" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Se déconnecter
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                        @endauth
                    </div>
                </div><!--/.container-fluid -->
            </nav>
        </div>
        <div class="container">
            @yield('content')
        </div>
        @yield('scripts')
    </body>
</html>
