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
                        <div class="col-sm-8 col-lg-4">
                            <div class="card shadow zindex-100 mb-0">
                                <div class="card-body px-md-5 py-5">
                                    <div class="mb-5">
                                        <h6 class="h3">Connexion</h6>
                                        <p class="text-muted mb-0">Connecte toi à ton compte pour continuer.</p>
                                    </div>
                                    <span class="clearfix"></span>


                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Une erreur s'est produite!</strong>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach</a>
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Fermer">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                    @endif

                                    <form role="form" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        @if ($message = Session::get('success'))
                                            <div class="alert alert-modern alert-success w-100">
                   <span class="badge badge-success badge-pill">
                    Succès
                </span>
                                                <span class="alert-content">{!! $message !!}</span>
                                            </div>


                                            <?php Session::forget('success');?>
                                        @endif


                                        <div class="form-group">
                                            <label class="form-control-label">Adresse e-mail</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-user"></i></span>
                                                </div>
                                                <input type="email" class="form-control" id="input-email" name="email"
                                                       :value="old('email')" placeholder="monadresse@email.fr">
                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <label class="form-control-label">Mot de passe</label>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-key"></i></span>
                                                </div>
                                                <input type="password" class="form-control" id="input-password"
                                                       name="password" :value="old('password')"
                                                       placeholder="Mot de passe">
                                                <div class="input-group-append">
                            <span class="input-group-text">
                              <a  data-toggle="password-text" style="cursor: pointer" data-target="#input-password">
                                <i class="far fa-eye"></i>
                              </a>
                            </span>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <a href="/forgot-password"
                                                   class="small text-muted text-underline--dashed border-primary">J'ai
                                                    oublié mon mot de passe.</a>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">

                                                <span class="btn-inner--text">Se connecter</span>
                                                <span class="btn-inner--icon"><i
                                                        class="far fa-long-arrow-alt-right"></i></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer px-md-5"><small>Pas de compte?</small>
                                    <a href="/register" class="small font-weight-bold">Crée un compte !</a></div>
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


</body>

</html>
