<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="Purpose Application UI is the following chapter we've finished in order to create a complete and robust solution next to the already known Purpose Website UI.">
    <meta name="author" content="Webpixels">
    <title>{{config('app.name')}} – Inscription</title>
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
                        <div class="col-sm-8 col-lg-5">
                            <div class="card shadow zindex-100 mb-0">
                                <div class="card-body px-md-5 py-5">
                                    <div class="mb-5">
                                        <h6 class="h3">Création de votre compte client.</h6>
                                    </div>
                                    <span class="clearfix"></span>

                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Une erreur s'est produite!</strong>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach</a>
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                    @endif

                                    <form role="form" method="POST" action="{{ route('register') }}">
                                        @csrf


                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-control-label">Prénom</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="far fa-user"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="input-name"
                                                               name="first_name" placeholder="Votre prénom"
                                                               :value="old('first_name')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-control-label">Nom de famille</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="far fa-user"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="input-name"
                                                               name="last_name" placeholder="Votre nom de famille"
                                                               :value="old('last_name')">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label">Adresse</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="input-email" name="address"
                                                       placeholder="5 rue des fauconniers">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-control-label">Ville</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-city"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="input-name"
                                                               name="city" placeholder="Paris"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-control-label">Pays</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-globe-europe"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="input-name"
                                                               name="country" placeholder="Votre Pays"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Adresse Email</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="far fa-envelope"></i></span>
                                                </div>
                                                <input type="email" class="form-control" id="input-email" name="email"
                                                       placeholder="monadresse@email.fr" :value="old('email')">
                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-control-label">Mot de passe </label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-key"></i></span>
                                                </div>
                                                <input type="password" class="form-control" name="password"
                                                       id="input-password" placeholder="********"
                                                       :value="old('password')">
                                                <div class="input-group-append">
                            <span class="input-group-text">
                              <a data-toggle="password-text" style="cursor:pointer;" data-target="#input-password">
                                <i class="far fa-eye"></i>
                              </a>
                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Confirmer votre mot de passe</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-key"></i></span>
                                                </div>
                                                <input type="password" class="form-control" name="password_confirmation"
                                                       id="input-password-confirm" placeholder="********">
                                            </div>
                                        </div>
                                        <div class="my-4">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" required
                                                       id="check-terms">
                                                <label class="custom-control-label" for="check-terms">J'ai lu et accepte
                                                    les <a href="#">termes et conditions</a></label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" required
                                                       id="check-privacy">
                                                <label class="custom-control-label" for="check-privacy">J'ai lu et
                                                    accepte les <a href="#">politiques de confidentialités</a></label>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                <span class="btn-inner--text">Crée mon compte</span>
                                                <span class="btn-inner--icon"><i
                                                        class="far fa-long-arrow-alt-right"></i></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer px-md-5"><small>Vous êtes déjà client?</small>
                                    <a href="{{ route('login') }}" class="small font-weight-bold">Se connecter</a></div>
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
