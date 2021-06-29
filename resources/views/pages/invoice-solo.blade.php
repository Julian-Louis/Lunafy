@extends('layouts.layout')

@section('content')
    <div class="page-content" id="print">
        <!-- Page title -->
        <div class="page-title">
            <div class="row justify-content-between align-items-center">
                <div
                    class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                    <!-- Page title + Go Back button -->
                    <div class="d-inline-block">
                        <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Facture #{{$invoice->id}}</h5>
                    </div>
                    <!-- Additional info -->
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
                    <div class="actions actions-dark d-inline-block">
                        <a href="#" class="action-item ml-md-4">
                            <i class="far fa-file-export mr-2"></i>Export
                        </a>
                        <a href="#" class="action-item ml-3">
                            <i class="far fa-cog mr-2"></i>Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Listing -->
        <div class="card card-body p-md-5">
            <div class="row align-items-center mb-5">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <img src="/img/lunafy-dark.svg" alt="" height="30">
                </div>
                <div class="col-sm-6 text-sm-right">
                    <h6 class="d-inline-block m-0 d-print-none">Facture</h6>
                    @if($invoice->status == "paid")
                        <span class="badge badge-pill badge-success ml-3">Payé</span>
                    @else
                        <span class="badge badge-pill badge-danger ml-3">Non payé</span>
                    @endif

                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-6 col-md-8">
                    <h6 class="">Bonjour {{Auth::user()->first_name}} {{Auth::user()->last_name}},</h6>
                    <p class="text-sm">
                        Merci d'avoir passé votre commande. Votre commande #{{$invoice->id}} a été enregistrée dans
                        notre
                        système. Nous mettrons tout en œuvre pour que votre achat vous parvienne dans les plus brefs
                        délais, à partir de plus de 30 minutes d'attente, veuillez contactez notre support technique.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h5>Produit</h5>
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th class="px-0 bg-transparent border-top-0">Nom</th>
                                <!--<th class="px-0 bg-transparent border-top-0">Quantité</th>-->
                                <th class="px-0 bg-transparent border-top-0 text-right">Coût</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="px-0">
                                    <span class="h6 text-sm">{{$invoice->product_name}}</span>
                                </td>
                                <!--<td class="px-0">
                                    125
                                </td>-->
                                <td class="px-0 text-right">
                                    {{$invoice->price}}€
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                    <div class="card my-5 bg-secondary">
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 order-md-2 mb-4 mb-md-0">
                                    <div class="d-flex align-items-center justify-content-md-end">
                                        <span class="h6 text-muted d-inline-block mr-3 mb-0">Prix total:</span>
                                        <span class="h4 mb-0">{{$invoice->price}}€</span>
                                    </div>
                                </div>
                                <div class="col-md-6 order-md-1">
                                    <button type="button" class="btn btn-sm btn-primary">Télécharger</button>
                                    <a href="#" onClick="print('print')"

                                       class="btn btn-sm btn-link text-dark font-weight-bold">Imprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <h5>Reçu par</h5>
                    <dl class="row mt-4 align-items-center">
                        <dt class="col-sm-3 h6 text-sm">Client</dt>
                        <dd class="col-sm-9 text-sm">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</dd>
                        <dt class="col-sm-3 h6 text-sm">Adresse email</dt>
                        <dd class="col-sm-9 text-sm">{{Auth::user()->email}} </dd>
                        <dt class="col-sm-3 h6 text-sm">Adresse</dt>
                        <dd class="col-sm-9 text-sm">{{Auth::user()->address}} </dd>
                        <dt class="col-sm-3 h6 text-sm">Ville</dt>
                        <dd class="col-sm-9 text-sm">{{Auth::user()->city}} </dd>
                        <dt class="col-sm-3 h6 text-sm">Pays</dt>
                        <dd class="col-sm-9 text-sm">{{Auth::user()->country}} </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>

        function print(elem) {
            const mywindow = window.open('', 'PRINT', 'height=400,width=600');

            mywindow.document.write('<html><head><title>' + document.title + '</title>');

            mywindow.document.write(document.getElementById(elem).innerHTML);


            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        }

    </script>
@stop
