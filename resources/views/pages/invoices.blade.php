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
                        <h4 class="h4 d-inline-block font-weight-400 mb-0 text-white">Factures</h4>
                    </div>
                    <!-- Additional info -->
                </div>

            </div>
        </div>
        <!-- Listing -->
        <div class="row">
            @if(count($invoices) <= 0)
                <div class="alert alert-info alert-dismissible fade show mt-5 mb-10" role="alert">
                    <strong>Vous n'avez pas de facture.
                    </strong>
                        </button>
                </div>
                @endif

            @foreach($invoices as $invoice)

                <div class="col-lg-4">
                    <div class="card hover-shadow-lg">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h6 class="mb-0"><a href="/invoice/{{$invoice->id}}">{{$invoice->product_name}}</a>
                                    </h6>
                                </div>
                                <div class="col-2 text-right">
                                    <div class="actions">
                                        <div class="dropdown" data-toggle="dropdown">
                                            <a href="#" class="action-item"><i class="far fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item">Refresh</a>
                                                <a href="#" class="dropdown-item">Manage Widgets</a>
                                                <a href="#" class="dropdown-item">Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="p-3 border border-dashed">
                                <span class="text-sm text-muted font-weight-600">Facture #{{$invoice->id}}</span>
                                <div class="row align-items-center mt-3">
                                    <div class="col-6">
                                        <h6 class="mb-0">{{$invoice->price}}€</h6>
                                        <span class="text-sm text-muted">Montant</span>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="mb-0">{{Str::words($invoice->created_at,'1','')}}</h6>
                                        <span class="text-sm text-muted">Date</span>
                                    </div>
                                </div>
                            </div>
                            <div class="media mt-4 align-items-center">
                                <div class="media-body pl-3">
                                    @if ($invoice->product_name == "Ajout de crédit")
                                        <div class="text-sm my-0">Payé avec <a
                                                                               class="text-primary font-weight-600">paypal</a>
                                        </div>
                                    @else
                                        <div class="text-sm my-0">Payé avec des <a
                                                                               class="text-primary font-weight-600">crédits</a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach


        </div>

    </div>

@stop
