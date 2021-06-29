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
                                <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Code promotionnel</h5>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <form class="mt-4" method="POST" action="{!! URL::to('discount') !!}">
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
                                    Insérer ci-dessous un code promotionnel.
                                </label>
                                <input type="text" name="code" required maxlength="16"
                                       class="form-control">
                                <input style="display: none;" disabled type="text"
                                       value="{{Auth::user()->id}}" name="userid" required class="form-control">
                            </div>
                            <hr/>
                            <button type="submit" class="btn btn-primary btn-icon w-100">
                                <span class="btn-inner--icon">
                                   <i class="fas fa-tags"></i>
                                </span>

                                <span class="btn-inner--text"> Valider le code promotionnel</span>

                            </button>
                        </form>


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
