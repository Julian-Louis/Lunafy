<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Votre hébergeur web à petit prix !">
    <meta name="author" content="Sumonil">
    <title>{{config('app.name')}} – Connexion</title>
    <link rel="icon" href="/favicon.ico" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">

</head>
<body class="application application-offset">

<div class="container-fluid container-application">
    <div class="main-content position-relative">
        <div class="page-content">
            <div class="min-vh-100 py-5 d-flex align-items-center">
                <div class="w-100">
                    <div class="row justify-content-center">
                        <div class="col-sm-8 col-lg-5 col-xl-4">
                            <div class="card shadow zindex-100 mb-0">
                                <div class="card-body px-md-5 py-5">
                                    <div class="mb-5">
                                        <h6 class="h3">Réinitialisation de votre mot de passe</h6>
                                        <p class="text-muted mb-0">Entrez votre e-mail ci-dessous pour continuer.</p>
                                    </div>
                                    <span class="clearfix"></span>

                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Une erreur s'est produite!</strong>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @if (session('status'))

                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong> {{ session('status') }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label class="form-control-label">Adresse e-mail</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-user"></i></span>
                                                </div>
                                                <input type="email" class="form-control" id="input-email" name="email"
                                                       required autofocus placeholder="monadresse@email.fr">
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                <span class="btn-inner--text">Confirmer</span>
                                                <span class="btn-inner--icon"><i
                                                        class="far fa-long-arrow-alt-right"></i></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer px-md-5"><small>Pas de compte?</small>
                                    <a href="/register" class="small font-weight-bold">Créer un compte</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/purpose.core.js')}}"></script>
<script src="{{ asset('js/purpose.js')}}"></script>

</body>

</html>
