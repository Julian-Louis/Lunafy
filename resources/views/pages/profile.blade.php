@extends('layouts.layout')

@section('content')
    <div class="page-content">
        <!-- Page title -->
        <div class="page-title">
            <div class="row justify-content-between align-items-center">
                <div
                    class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                    <!-- Page title + Go Back button -->
                    <div class="d-inline-block">
                        <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Paramètres de mon compte</h5>
                    </div>
                    <!-- Additional info -->
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
                </div>
            </div>
        </div>
        <div class="row">
            <!--<div class="col-lg-4 order-lg-2">
                <div class="card">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item active">
                            <div class="media">
                                <i class="far fa-user"></i>
                                <div class="media-body ml-3">
                                    <a href="settings.html" class="stretched-link h6 mb-1">Settings</a>
                                    <p class="mb-0 text-sm">Details about your personal information</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="media">
                                <i class="far fa-map-marker-alt"></i>
                                <div class="media-body ml-3">
                                    <a href="addresses.html" class="stretched-link h6 mb-1">Addresses</a>
                                    <p class="mb-0 text-sm">Faster checkout with saved addresses</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="media">
                                <i class="far fa-credit-card"></i>
                                <div class="media-body ml-3">
                                    <a href="billing.html" class="stretched-link h6 mb-1">Billing</a>
                                    <p class="mb-0 text-sm">Speed up your shopping experience</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="media">
                                <i class="far fa-file-invoice"></i>
                                <div class="media-body ml-3">
                                    <a href="payment-history.html" class="stretched-link h6 mb-1">Payment history</a>
                                    <p class="mb-0 text-sm">See previous orders and invoices</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="media">
                                <i class="far fa-bell"></i>
                                <div class="media-body ml-3">
                                    <a href="notifications.html" class="stretched-link h6 mb-1">Notifications</a>
                                    <p class="mb-0 text-sm">Choose what notification you will receive</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="col-lg-8 order-lg-1">


                <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0">Changer mon mot de passe</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('change.password')}}">
                            @csrf
                            @foreach($errors->all() as $error)
                                {{$error}}
                            @endforeach
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Ancien mot de passe</label>
                                        <input class="form-control" name="current_password"
                                               autocomplete="current-password" type="password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Nouveau mot de passe</label>
                                        <input class="form-control" name="new_password" autocomplete="new-password"
                                               type="password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Confirmer le mot de passe</label>
                                        <input class="form-control" name="new_confirm_password"
                                               autocomplete="new-password" type="password">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-sm btn-primary rounded-pill">Mettre à jour</button>
                            </div>
                        </form>
                    </div>
                </div>

               <!-- <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0">Zone de danger</h5>
                    </div>
                    <div class="card-body">

                        <button type="button" class="btn btn-sm btn-danger rounded-pill" data-toggle="modal"
                                data-target="#modal-delete-account">Supprimer mon compte
                        </button>
                        <div class="modal modal-danger fade" id="modal-delete-account" tabindex="-1" role="dialog"
                             aria-labelledby="modal-delete-account" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form class="form-danger">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <i class="far fa-exclamation-circle fa-3x opacity-8"></i>
                                                <h5 class="text-white mt-4">Êtes vous sûr?</h5>
                                                <p class="text-sm text-sm">Toutes vos données seront effacées. Vous ne
                                                    serez plus facturé, aucune sauvegarde ne sera disponible.</p>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label text-white">Votre adresse
                                                    e-mail</label>
                                                <input class="form-control" type="email">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label text-white">Pour confirmer, écrivez
                                                    <span class="font-italic">supprimer mon compte</span> en
                                                    dessous</label>
                                                <input class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label text-white">Votre mot de passe</label>
                                                <input class="form-control" type="password">
                                            </div>
                                            <div class="mt-4">
                                                <button type="button"
                                                        class="btn btn-block btn-sm btn-white text-danger rounded-pill">
                                                    Supprimer mon compte
                                                </button>
                                                <button type="button"
                                                        class="btn btn-block btn-sm btn-link text-light mt-4"
                                                        data-dismiss="modal">Annuler
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>

@stop
