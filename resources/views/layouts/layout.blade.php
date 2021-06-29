<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="Purpose Application UI is the following chapter we've finished in order to create a complete and robust solution next to the already known Purpose Website UI.">
    <meta name="author" content="Sumonil">
    <title>{{config('app.name')}} | Votre hébergeur à petits prix</title>
    <link rel="icon" href="/favicon.ico" type="image/png">
    <link rel="stylesheet" href="{{ asset('/libs/fullcalendar/dist/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
</head>

<body class="application application-offset">

<!-- Application container -->
<div class="container-fluid container-application">
    <!-- Sidenav -->
    <div class="sidenav" id="sidenav-main">
        <!-- Sidenav header -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="/dashboard">
                <img src="/img/lunafy.svg" class="navbar-brand-img" alt="...">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin"
                     data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- User mini profile -->
        <div class="sidenav-user d-flex flex-column align-items-center justify-content-between text-center">
            <!-- Avatar -->
            <div>
                <a href="#" class="avatar rounded-circle avatar-xl">
                    <img alt="Image placeholder" src="{{ Auth::user()->profile_photo_url }}"
                         alt="{{ Auth::user()->first_name }}" class="">
                </a>
                <div class="mt-4">
                    <h5 class="mb-0 text-white">{{ Auth::user()->first_name}} {{Auth::user()->last_name}}</h5>
                    <span class="d-block text-sm text-white opacity-8 mb-3">{{ Auth::user()->email }}</span>
                    <a href="/add-balance"
                       class="btn btn-sm btn-white btn-icon rounded-pill shadow hover-translate-y-n3">
                        <span class="btn-inner--icon"><i class="far fa-coins"></i></span>
                        <span class="btn-inner--text">{{Auth::user()->balance}}€</span>
                    </a>
                </div>
            </div>
            <!-- User info -->
            <!-- Actions -->
            <div class="w-100 mt-4 actions d-flex justify-content-between">
                <a href="/profile" class="action-item action-item-lg text-white pl-0">
                    <i class="far fa-user"></i>
                </a>
                @if(Auth::user()->group == "admin")
                <a href="/admin/services" class="action-item action-item-lg text-white" >
                    <i class="fas fa-tools"></i>
                </a>
                @endif
                <a href="/invoices" class="action-item action-item-lg text-white pr-0">
                    <i class="far fa-receipt"></i>
                </a>
            </div>
        </div>
        <!-- Application nav -->
        @include('components.sidebar')
        <!-- Misc area -->
        <div class="card bg-gradient-warning">
            <div class="card-body">
                <h5 class="text-white">Coucou, {{ Auth::user()->first_name}}!</h5>
                <p class="text-white mb-4">
                    Bienvenue sur {{config('app.name')}} prêt à commencer chez nous ?
                </p>
                <a href="/order"
                   class="btn btn-sm btn-block btn-white rounded-pill">C'est parti !</a>
            </div>
        </div>
    </div>
    <!-- Content -->
    <div class="main-content position-relative">
        <!-- Main nav -->
        <nav class="navbar navbar-main navbar-expand-lg navbar-dark bg-primary navbar-border" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand + Toggler (for mobile devices) -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse"
                        aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- User's navbar -->
                <div class="navbar-user d-lg-none ml-auto">
                    <ul class="navbar-nav flex-row align-items-center">
                        <li class="nav-item">
                            <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin"
                               data-target="#sidenav-main"><i class="far fa-bars"></i></a>
                        </li>

                        <!--<li class="nav-item dropdown dropdown-animate">
                            <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"><i class="far fa-bell"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                                <div class="py-3 px-3">
                                    <h5 class="heading h6 mb-0">Notifications</h5>
                                </div>
                                <div class="list-group list-group-flush">
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex align-items-center" data-toggle="tooltip"
                                             data-placement="right" data-title="2 hrs ago">
                                            <div>
                                                <span class="avatar bg-primary text-white rounded-circle">AM</span>
                                            </div>
                                            <div class="flex-fill ml-3">
                                                <div class="h6 text-sm mb-0">Alex Michael <small
                                                        class="float-right text-muted">2 hrs ago</small></div>
                                                <p class="text-sm lh-140 mb-0">
                                                    Some quick example text to build on the card title.
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                                <div class="py-3 text-center">
                                    <a href="#" class="link link-sm link--style-3">View all notifications</a>
                                </div>
                            </div>
                        </li>-->
                        <li class="nav-item dropdown dropdown-animate">
                            <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="{{ Auth::user()->profile_photo_url }}">
                  </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                                <h6 class="dropdown-header px-0">Coucou, {{ Auth::user()->first_name}}!</h6>
                                <a href="/profile" class="dropdown-item">
                                    <i class="far fa-user"></i>
                                    <span>Mon profil</span>
                                </a>
                                <a href="/profile" class="dropdown-item">
                                    <i class="far fa-cog"></i>
                                    <span>Paramètres</span>
                                </a>
                                <a href="account/billing.html" class="dropdown-item">
                                    <i class="far fa-credit-card"></i>
                                    <span>Support</span>
                                </a>
                                <a href="shop/orders.html" class="dropdown-item">
                                    <i class="far fa-shopping-basket"></i>
                                    <span>Commandes</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<? session_destroy(); ?>" class="dropdown-item">
                                    <i class="far fa-sign-out-alt"></i>
                                    <span>Déconnexion</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">
                    <ul class="navbar-nav align-items-lg-center">
                        <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                            <a class="nav-link pl-lg-0" href="/dashboard">
                                Accueil
                            </a>
                        </li>
                        <li class="border-top opacity-2 my-2"></li>
                        <li class="nav-item {{ request()->is('add-balance') ? 'active' : '' }}">
                            <a class="nav-link pl-lg-0" href="/add-balance">
                                Ajouter du solde
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-lg-0" target="_blank" href="https://status.lunafy.fr">
                                Statuts des serveurs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-lg-0" target="_blank" href="https://discord.lunafy.fr">
                                Discord
                            </a>
                        </li>


                        <li class="border-top opacity-2 my-2"></li>

                    </ul><!-- Right menu -->
                    <ul class="navbar-nav ml-lg-auto align-items-center d-none d-lg-flex">
                        <li class="nav-item">
                            <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin"
                               data-target="#sidenav-main"><i class="far fa-bars"></i></a>
                        </li>


                       <!-- <li class="nav-item dropdown dropdown-animate">
                            <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"><i class="far fa-bell"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                                <div class="py-3 px-3">
                                    <h5 class="heading h6 mb-0">Notifications</h5>
                                </div>
                                <div class="list-group list-group-flush">
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex align-items-center" data-toggle="tooltip"
                                             data-placement="right" data-title="2 hrs ago">
                                            <div>
                                                <span class="avatar bg-primary text-white rounded-circle">AM</span>
                                            </div>
                                            <div class="flex-fill ml-3">
                                                <div class="h6 text-sm mb-0">Alex Michael <small
                                                        class="float-right text-muted">2 hrs ago</small></div>
                                                <p class="text-sm lh-140 mb-0">
                                                    Some quick example text to build on the card title.
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                                <div class="py-3 text-center">
                                    <a href="#" class="link link-sm link--style-3">View all notifications</a>
                                </div>
                            </div>
                        </li>
                        -->
                        <li class="nav-item dropdown dropdown-animate">
                            <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <div class="media media-pill align-items-center">
                    <span class="avatar rounded-circle">
                      <img alt="Image placeholder" src="{{ Auth::user()->profile_photo_url }}"
                           alt="{{ Auth::user()->first_name }}">
                    </span>
                                    <div class="ml-2 d-none d-lg-block">
                                        <span
                                            class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                                <a href="#!" class="dropdown-item">
                                    <i class="far fa-user"></i>
                                    <span>Mon Compte</span>
                                </a>
                                <a href="#!" class="dropdown-item">
                                    <i class="far fa-cog"></i>
                                    <span>Préférences</span>
                                </a>
                                <a href="/invoices" class="dropdown-item">
                                    <i class="far fa-credit-card"></i>
                                    <span>Factures</span>
                                </a>
                                <a href="#!" class="dropdown-item">
                                    <i class="far fa-tasks"></i>
                                    <span>Activité de connexion</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="/logout" class="dropdown-item">
                                    <i class="far fa-sign-out-alt"></i>
                                    <span>Déconnexion</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
        <div class="footer pt-5 pb-4 footer-light" id="footer-main">
            <div class="row text-center text-sm-left align-items-sm-center">
                <div class="col-sm-6">
                    <p class="text-sm mb-0">© {{\Carbon\Carbon::now()->year}} Lunafy. Tous droits réservés.</p>
                </div>
                <div class="col-sm-6 mb-md-0">
                    <ul class="nav justify-content-center justify-content-md-end">

                        <li class="nav-item">
                            <a class="nav-link" href="https://discord.lunafy.fr">Support</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://lunafy.fr/legal">Mentions Légales</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module" src="https://cdn.freshstatus.io/widget/index.js"></script>
<script src="{{ asset('/js/purpose.core.js')}}"></script>
<script src="{{ asset('/libs/progressbar.js/dist/progressbar.min.js')}}"></script>
<script src="{{ asset('/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{ asset('/libs/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('/libs/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{ asset('/js/purpose.js')}}"></script>
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/6059f5eff7ce182709330f6e/1f1fmhcan';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>

@yield("scripts")
</body>

</html>
