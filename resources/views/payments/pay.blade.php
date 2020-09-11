@extends('template')
    @section('content')

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2 class="mb-4">PAGO</h2>
                </div>
            </div>
            <div class="ftco-search">
                <div class="row">
                    <div class="col-md-12 tab-wrap">

                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">
                                <div class="speaker-wrap ftco-animate d-flex">
                                    <div class="text pl-md-10">
                                        <h2>Costo Mensual de Paquete {{ $client->plan->name }}</h2>
                                    </div>
                                    <div class="text pl-md-2">
                                        <h2 style="text-align: right;">$ <span class="number">{{ $client->plan->price }}</span></h2>
                                    </div>
                                </div>
                                <div class="speaker-wrap ftco-animate d-flex">
                                    <div class="text pl-md-10">
                                        <h2>Costo Mensual de envío</h2>
                                    </div>
                                    <div class="text pl-md-2">
                                        @foreach ($deliveryOptions as $key => $option)
                                            <h2 style="text-align: right;">
                                                {{ $option->provider }} | {{ $option->service_level_name }} $ <span class="number">{{ $option->total_pricing }}</span>
                                                <input type="radio" class="radioProvider" value="{{ $option->total_pricing }}" {{ $key == 0 ? "checked":"" }} name="provider">
                                            </h2>
                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-10">
                        <h2 style="text-align: right;">Total: $ <span class="number" id="total">{{ $client->plan->price + $deliveryOptions[0]->total_pricing }}</span></h2>
                    </div>
                    <div class="col-md-2">
                        <a href="#" id="pagar" class="btn btn-primary">Pagar Ahora</a>
                    </div>
                    <form id="formPagar" action="{{ route('payments.pay') }}" method="GET">
                        <input id="inputTotal" type="hidden" name="total" value="{{ $client->plan->price + $deliveryOptions[0]->total_pricing }}">
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endsection
    @section('js')
        <script type="text/javascript">
            $(document).ready(function () {
                $('.radioProvider').on('change', function() {
                    precio = $(this).val();
                    total = parseFloat("{{ $client->plan->price }}") + parseFloat(precio);
                    $('#total').text(total);
                    $('#inputTotal').val(total);
                });
                $('#pagar').on('click', function() {
                    $('#formPagar').submit();
                });
            });
        </script>
    @endsection
