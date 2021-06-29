<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Erreur :/</title>
    <link rel="icon" href="/favicon.ico" type="image/png">

    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <style>
        .bg-gradient-primary {
            background: linear-gradient(240deg, #0061ff 50%, #60efff 100%) !important;
        }
    </style>
</head>

<body>
<div class="min-vh-100 h-100vh py-5 d-flex align-items-center bg-gradient-primary">

    <div class="container position-relative zindex-100">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 px-5 px-lg-0">
                <h6 class="display-1 mb-3 font-weight-600 text-white">Erreur</h6>
                <p class="lead text-lg text-white mb-5">
                    Une erreur est survenue, veuillez contactez notre support.
                </p>
                <a href="https://discord.lunafy.fr" class="btn btn-white btn-icon rounded-pill hover-translate-y-n3">
                    <span class="btn-inner--icon"><i class="fab fa-discord"></i></span>
                    <span class="btn-inner--text">Rejoindre le discord</span>
                </a>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <figure class="w-100">
                    <img alt="Image placeholder" src="/img/svg/illustrations/server-down.svg"
                         class="svg-inject opacity-8 img-fluid" style="height: 500px;">
                </figure>
            </div>
        </div>
    </div>
</div>
<!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
<script src="{{ asset('js/purpose.core.js')}}"></script>
<!-- Purpose JS -->
<script src="{{ asset('js/purpose.js')}}"></script>
<!-- Demo JS - remove it when starting your project -->
<script src="{{ asset('js/demo.js')}}"></script>
</body>

</html>
