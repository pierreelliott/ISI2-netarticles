<!doctype html>
<html lang="fr">
    <head>
        {!! Html::style('assets/css/bootstrap.css') !!}
        {!! Html::style('assets/css/mangas.css') !!}
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
                        <a class="navbar-brand" href="{{ url('/') }}">Net Articles</a>
                    </div>
                    @if (Session::get('id') == 0)
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/getRecherche') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Rechercher</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">                             
                            <li><a href="{{ url('/getLogin') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Se connecter</a></li>
                        </ul> 
                    </div>
                    @endif
                    @if (Session::get('id') > 0)
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-nav">                           
                            <li><a href="{{ url('/getRecherche') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Rechercher</a></li>
                            <li><a href="{{ url('/getAchats') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Mes articles</a></li> 
                            <li><a href="{{ url('/getCompte') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Mon compte</a></li>
                            @if (Session::get('basket'))
                                <li><a href="{{ url('/getBasket') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Panier</a></li> 
                            @endif
                        </ul>  
                        <ul class="nav navbar-nav navbar-right">                             
                            <li><a href="{{ url('/signOut') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Se déconnecter</a></li>
                        </ul> 
                    </div> 
                    @endif
                </div><!--/.container-fluid -->
            </nav>
        </div> 
        <div class="container">
            @yield('content')
        </div>
            {!! Html::script('assets/js/bootstrap.min.js') !!}
            {!! Html::script('assets/js/ui-bootstrap-tpls.js') !!}
            {!! Html::script('assets/js/bootstrap.js') !!}
    </body>
</html>
