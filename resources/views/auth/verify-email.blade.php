<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Vérification | Lunafy</title>
    <link rel="icon" href="/favicon.ico" type="image/png">

    <link rel="stylesheet" href="/css/css.css" id="stylesheet">
</head>

<body class="application application-offset">

<div class="container-fluid container-application">

    <!-- Page content -->
    <div class="page-content">
        <div class="min-vh-100 py-5 d-flex align-items-center">
            <div class="w-100">
                <div class="row justify-content-center">
                    <div class="col-sm-8 col-lg-5 col-xl-4">
                        <div class="card shadow zindex-100 mb-0">
                            <div class="card-body px-md-5 py-5">
                                <div class="mb-5">
                                    <h6 class="h3">Vérification</h6>
                                    <p class="text-muted mb-0">Merci pour votre inscription! Avant de commencer,
                                        pourrait
                                        vous vérifiez votre adresse e-mail en cliquant sur le lien auquel nous
                                        venons d'envoyer un e-mail
                                        vous? Si vous n'avez pas reçu l'e-mail, nous vous en enverrons un autre avec
                                        plaisir.
                                    </p>
                                </div>

                                @if (session('status') == 'verification-link-sent')
                                    <div class="alert alert-success w-100">
                   <span class="badge badge-success mr-2">
                    Succès</span>
                                        <span class="alert-content"> Un nouveau lien de vérification a été envoyé à l'adresse e-mail que vous avez fournie lors de l'inscription.</span>
                                    </div>

                                @endif
                                <span class="clearfix"></span>


                                    <div class="mt-4">
                                        <form method="POST" action="{{ route('verification.send') }}">
                                            @csrf

                                            <button type="submit"
                                                    class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                    <span
                                                        class="btn-inner--text">Renvoyer l'e-mail de vérification</span>
                                                <span class="btn-inner--icon"><i
                                                        class="far fa-long-arrow-alt-right"></i></span>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mt-4">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" href="/logouts"
                                                    class="btn btn-sm btn-secondary btn-icon rounded-pill">
                                                <span class="btn-inner--text">Me déconnecter</span>
                                                <span class="btn-inner--icon"><i
                                                        class="far fa-door-open"></i></span>
                                            </button>
                                        </form>
                                    </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="{{config('app.url')}}/js/purpose.core.js"></script>
<script src="{{config('app.url')}}/js/purpose.js"></script>
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
