@extends('layouts.layout')

@section('content')
    <style>
        .spoiler, .spoiler2 {
            color: black;
            background-color: black;
        }


        .spoiler2:hover {
            background-color: white;
        }
    </style>
    <div class="page-content">

        <!-- Page title -->
        <div class="page-title">
            <div class="row justify-content-between align-items-center">
                <div
                    class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                    <!-- Page title + Go Back button -->
                    <div class="d-inline-block">
                        <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">{{$service->hostname}}</h5>
                    </div>
                    <!-- Additional info -->
                </div>

            </div>
        </div>

        <div class="row">
            @if ($message = Session::get('success'))
                <div  class="alert alert-modern alert-success w-100">
                   <span class="badge badge-success badge-pill">
                    Succès
                </span>
                    <span class="alert-content">{!! $message !!}</span>
                </div>


                <?php Session::forget('success');?>
            @endif

            @if ($message = Session::get('error'))

                <div  class="alert alert-modern alert-danger w-100">
                <span class="badge badge-danger badge-pill">
                 Erreur
             </span>
                    <span class="alert-content">{!! $message !!}</span>
                </div>

                <?php Session::forget('error');?>
            @endif
            <div class="col-xl-3 col-sm-6">
                <!-- Stats card -->
                <div class="card card-stats border-0">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-muted mb-1">Serveur</h6>
                                <span class="h3 font-weight-bold mb-0 ">{{$service->nodes}}</span>
                            </div>

                        </div>
                    </div>
                </div>
                @if($service->product->price !== "0.00" & $service->status !== "suspend")
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted mb-1">Renouvellement</h6>
                                    <form method="POST" action="/renew/{{$service->id}}">
                                        @csrf

                                        <span class="h3 font-weight-bold mb-0 ">
                                        <button type="submit"
                                           class="btn btn-primary btn-sm text-white">
                                            Ajouter 1 mois ({{$service->product->price}}€)</button>
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            @endif
            <!-- Project performance -->

            </div>
            <div class="col-xl-3 col-sm-6">
                <!-- Stats card -->
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-muted mb-1">Offre</h6>
                                <span class="h3 font-weight-bold mb-0 ">{{$service->product->name}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Project perfaormance -->
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-muted mb-1">Status</h6>
                                <span class="h3 font-weight-bold mb-0 "> @if($service->status == "active")
                                        <span class="badge badge-dot mr-4">
                                <i class="bg-success"></i>
                                <span class="status">Actif
                                </span>
                            </span>


                                    @elseif($service->status == "inactive")
                                        <span class="badge badge-dot mr-4">
                                <i class="bg-warning"></i>
                                <span class="status">Inactif
                                </span>
                            </span>
                                    @elseif($service->status == "suspend")
                                        <span class="badge badge-dot mr-4">
                                <i class="bg-danger"></i>
                                <span class="status">Suspendu
                                </span>
                            </span>                                    @elseif($service->status == "unpaid")
                                        <span class="badge badge-dot mr-4">
                                <i class="bg-danger"></i>
                                <span class="status">Non payé
                                </span>
                            </span>

                                    @elseif($service->status == "inprogres")
                                        <span class="badge badge-dot mr-4">
                                <i class="bg-primary"></i>
                                <span class="status">En attente
                                </span>
                            </span>

                                    @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- Project overview -->
                <div class="card card-fluid">
                    <div class="card-header">
                        <h6 class="mb-0">Informations</h6>
                    </div>

                    <div class="card-footer py-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Utilisateur Plesk:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        {{Str::lower(Auth::user()->last_name.Auth::user()->first_name.Auth::user()->id)}}
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Mot de passe Plesk:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="spoiler2">{{Auth::user()->plesk_password}}</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Utilisateur FTP:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        {{$service->hostname}}
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Mot de passe FTP:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="spoiler2">{{$service->password}}</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">Accès plesk:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a target="_blank"
                                           href="https://storm.lunafy.fr/login_up.php?login_name={{Str::lower(Auth::user()->last_name.Auth::user()->first_name.Auth::user()->id)}}&passwd={{Auth::user()->plesk_password}}"
                                           class="btn btn-primary btn-sm text-white">
                                            Connexion Rapide
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <small>NS1:</small>
                                        <div class="h6 mb-0">{{$service->product->nameserver1}}</div>
                                    </div>
                                    <div class="col-6">
                                        <small>NS2:</small>
                                        <div class="h6 mb-0">{{$service->product->nameserver2}}</div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <small>Livré le:</small>
                                        <div class="h6 mb-0">{{current(explode(' ',$service->register_date))}}</div>
                                    </div>
                                    <div class="col-6">
                                        <small>Date d'expiration:</small>
                                        <div class="h6 mb-0">{{current(explode(' ',$service->end_date))}}</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>
@stop
