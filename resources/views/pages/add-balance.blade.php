@extends('layouts.layout')

@section('content')
    <div class="page-content">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="page-title">
                    <div class="row justify-content-between align-items-center">
                        <div
                            class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                            <div class="d-inline-block">
                                <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Ajouter du solde</h5>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <form class="mt-4" method="POST" action="{!! URL::to('paypal') !!}">
                            {{ csrf_field() }}
                            @if ($message = Session::get('success'))
                                <div class="alert alert-modern alert-success w-100">
                   <span class="badge badge-success badge-pill">
                    Succès
                </span>
                                    <span class="alert-content">{!! $message !!}</span>
                                </div>


                                <?php Session::forget('success');?>
                            @endif

                            @if ($message = Session::get('error'))

                                <div class="alert alert-modern alert-danger w-100">
                <span class="badge badge-danger badge-pill">
                 Erreur
             </span>
                                    <span class="alert-content">{!! $message !!}</span>
                                </div>

                                <?php Session::forget('error');?>
                            @endif
                            <div class="form-group">
                                <label class="form-control-label">
                                    Insérer ci-dessous le montant que vous souhaitez crédité à votre compte.
                                </label>
                                <input type="text" name="amount" id="amount" placeholder="1.19" text="€" required
                                       class="form-control">
                                <input style="display: none;" disabled type="text" placeholder="1.00€"
                                       value="{{Auth::user()->id}}" name="userid" required class="form-control">
                            </div>
                            <hr/>
                            <button type="submit" class="btn btn-primary btn-icon w-100">
                                <span class="btn-inner--icon">
                                  <i class="fab fa-paypal"></i>
                                </span>

                                <span class="btn-inner--text"> Payer avec paypal</span>

                            </button>
                        </form>
                        <hr/>
                        <a href="/discount-code" class="btn btn-secondary btn-icon w-100">
                                <span class="btn-inner--icon">
                                    <i class="fas fa-tags"></i>
                                </span>

                            <span class="btn-inner--text"> Vous avez un code promo ?</span>

                        </a>

                    </div>
                </div>


            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        function setInputFilter(textbox, inputFilter) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
                textbox.addEventListener(event, function () {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        this.value = "";
                    }
                });
            });
        }

        setInputFilter(document.getElementById("amount"), function (value) {
            return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
        });


    </script>



@stop
