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
            <div class="col-lg-4 order-lg-2">
                <div class="card">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item active">
                            <div class="media">
                                <i class="far fa-user"></i>
                                <div class="media-body ml-3">
                                    <a href="/profile" class="stretched-link h6 mb-1">Settings</a>
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
            </div>
            <center>
                <div class="col-lg-8 order-lg-1">
                    <div class="card">
                        <div class="card-header">
                            <h5 class=" h6 mb-0">Changer mon mot de passe</h5>
                        </div>
                        <div class="card-body">
                            <a href="#" class="avatar rounded-circle avatar-xl">
                                <img alt="Image placeholder" src="{{ Auth::user()->profile_photo_url }}"
                                     alt="{{ Auth::user()->first_name }}" class="">
                            </a>
                            <div class="mt-4">
                                <h5 class="mb-0 text-black">{{ Auth::user()->first_name}} {{Auth::user()->last_name}}</h5>
                                <span class="d-block text-sm text-black opacity-8 mb-3">{{ Auth::user()->email }}</span>
                                <a href="/add-balance"
                                   class="btn btn-sm btn-black btn-icon rounded-pill shadow hover-translate-y-n3">
                                    <span class="btn-inner--icon"><i class="far fa-coins"></i></span>
                                    <span class="btn-inner--text">{{Auth::user()->balance}}€</span>
                                </a>
                            </div>
                        </div>

            </center>

        </div>
    </div>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

@stop
