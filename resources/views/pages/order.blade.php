@extends('layouts.layout')

@section('content')

    <div class="page-content">
        <div class="page-title">
            <div class="row justify-content-between align-items-center">
                <div
                    class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                    <div class="d-inline-block">
                        <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Commander un service</h5>
                    </div>
                </div>

            </div>
        </div>
        @if ($message = Session::get('error'))
            <br/>
            <div class="alert alert-modern alert-danger w-100">
                <span class="badge badge-danger badge-pill">
                 Erreur
             </span>
                <span class="alert-content">{!! $message !!}</span>
            </div>
            <?php Session::forget('error');?>
        @endif

        <div class="row">
            @if(count($products) <= 0)
                <div class="alert alert-info alert-dismissible fade show mt-5 mb-10" role="alert">
                    <strong>Aucun produit disponible.
                    </strong>
                </div>
            @endif
            @foreach($products as $product)

                <div class="col-lg-3 col-sm-6">
                    <div class="card card-product">
                        <div class="card-header border-0">
                            <h2 class="h6">
                                <a href="#">
                                    @if($product->type == "webhosting")
                                        Hébergement Web
                                    @endif

                                </a>
                                <p class="text-primary">{{$product->name}}</p>
                            </h2>
                        </div>

                        <div class="card-body">
                            <!-- Price -->
                            <div class="d-flex align-items-center mt-4">
                                <span class="h6 mb-0">{{$product->price}}€ <sup>/mois</sup></span>

                                @isset($product->stock)
                                    @if($product->stock == 0)
                                        <span class="badge badge-danger rounded-pill ml-auto">Hors stock</span>
                                    @elseif($product->stock <= 10)
                                        <span class="badge badge-warning rounded-pill ml-auto">{{$product->stock}} restant!</span>
                                    @else
                                        <span class="badge badge-success rounded-pill ml-auto">En stock</span>
                                    @endif

                                @else
                                    <span class="badge badge-success rounded-pill ml-auto">En stock</span>
                                @endisset


                            </div>
                        </div>
                        {!! $product->dashboard_display !!}
                        <div class="card-footer">
                            <div class="actions justify-content-between text-center">
                                @isset($product->stock)
                                    @if($product->stock == 0)


                                        <button type="button"
                                                class="btn btn-sm text-center btn-primary disabled btn-icon rounded-pill shadow hover-translate-y-n3">
                                            <span class="btn-inner--text">Commander</span>
                                        </button>
                                    @else


                                        <button type="button" data-toggle="modal" data-target="#modal{{$product->id}}"
                                                class="btn btn-sm text-center btn-primary btn-icon rounded-pill shadow hover-translate-y-n3">
                                            <span class="btn-inner--text">Commander</span>
                                        </button>
                                    @endif

                                @else


                                    <button type="button" data-toggle="modal" data-target="#modal{{$product->id}}"
                                            class="btn btn-sm text-center btn-primary btn-icon rounded-pill shadow hover-translate-y-n3">
                                        <span class="btn-inner--text">Commander</span>
                                    </button>
                                @endisset

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal{{$product->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Êtes vous sûr ?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Vous vous appréter d'acheter {{$product->name}}
                            </div>
                            <div class="modal-footer">

                                <form class="mt-2" method="POST" action="{!! URL::to('order') !!}/{{$product->id}}">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div>


                                            <div class="form-group">
                                                <label class="form-control-label">Votre nom de domaine</label>
                                                <input class="form-control" placeholder="mon-nom-de-domaine.fr"
                                                       name="domainname" type="text">
                                                <p class="mt-2">*Nom de domaine non inclus</p>
                                            </div>

                                        </div>
                                        <div class="px-5 pt-4 mt-4 delimiter-top text-center">
                                            <p class="text-muted text-sm">Vous recevrez un email lors de la commande
                                                expliquant comment utiliser votre service.</p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler
                                    </button>


                                    <button type="submit" href="/order/{{$product->id}} " class="btn btn-primary">Oui,
                                        je suis sûr !
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>@stop

