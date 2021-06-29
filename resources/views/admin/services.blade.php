@extends('layouts.layout')

@section('content')
<div class="page-content">

    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div
                class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">

                <div class="d-inline-block">
                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Tous <les></les> services</h5>
                </div>
                <!-- Additional info -->
                <div class="align-items-center ml-4 d-inline-flex">
                    <span class="h4 text-info mb-0 mr-2">{{$servicescount}}</span>
                    <span class="text-sm opacity-7 text-white">Services actifs</span>
                </div>

            </div>

        </div>
    </div>
    <!-- Listing -->
    <div class="card mb-10">

        <div class="card-header actions-toolbar border-0">

            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <h6 class="d-inline-block mb-0">Services</h6>
                </div>
                <div class="col text-right">
                    <div class="actions">

                    </div>
                </div>
            </div>
        </div>
        <!-- Table -->
        <div class="table-responsive">
            <table class="table align-items-center">
                <thead>
                    <tr>
                        <th scope="col" class="sort" data-sort="name">Nom</th>
                        <th scope="col" class="sort" data-sort="budget">Domaine</th>
                        <th scope="col" class="sort" data-sort="serveur">Serveur</th>
                        <th scope="col" class="sort" data-sort="status">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>



                <tbody class="list">
                    @foreach($services as $service)


                    <tr>
                        <th scope="row">
                            <div class="media align-items-center">
                                <div>
                                    <i class="fas fa-server"></i>
                                </div>
                                <div class="media-body ml-4">
                                    <a href="/admin/services/{{$service->id}}" class="name mb-0 h6 text-sm"> {{$service->product->name}}</a>
                                </div>
                            </div>
                        </th>



                        <td class="budget">
                            {{$service->hostname}}
                        </td>
                        <td>
                            <span class="badge badge-server mr-4">
                                <span class="serveur"> {{$service->nodes}}</span>
                            </span>
                        </td>
                        <td>


                            @if($service->status == "active")
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
                            </span>
                            @elseif($service->status == "unpaid")
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

                            @endif


                        </td>
                        <td class="text-right">
                            <div class="dropdown" data-toggle="dropdown">
                                <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="far fa-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a target="_blank"
                                           href="https://storm.lunafy.fr/login_up.php?login_name={{Str::lower(Auth::user()->last_name.Auth::user()->first_name.Auth::user()->id)}}&passwd={{Auth::user()->plesk_password}}" class="dropdown-item">Plesk</a>
                                        <a href="/services/{{$service->id}}" class="dropdown-item">Information</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>


                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

</div>
@stop
