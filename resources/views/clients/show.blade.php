@extends('template')
    @section('content')
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2 class="mb-4">PERFIL</h2>
                </div>
            </div>
            <div class="ftco-search">
                <div class="row">
                    <div class="col-md-12 tab-wrap">
                        <form action="#" class="bg-light p-5 contact-form">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input disabled type="text" class="form-control" value="{{ $user->name }} {{ $user->client->last_name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input disabled type="text" class="form-control" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="birthday" value="{{ $user->client->birthday }}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Teléfono:</label>
                                <input required="required" type="number" class="form-control" name="phone" value="{{ $user->client->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Modo de preparación:</label>
                                <input required="required" type="text" class="form-control" name="grain_type" value="{{ $user->client->grain_type }}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Dirección:</label>
                                <input disabled type="text" class="form-control" name="address" value="{{ $user->client->address }}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Código Postal:</label>
                                <input disabled type="text" class="form-control" name="pc" value="{{ $user->client->pc }}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Estatus de Pago:</label>
                                @if ($user->client->paypal == 1)
                                    <input disabled type="text" class="form-control" value="Cuenta Vinculada">
                                @else
                                    <div class="form-group">
                                        {{-- <a href="{{ route('payments.show') }}" class="btn btn-warning">Pagar Ahora</a> --}}
                                        <a href="#" class="btn btn-warning">Pagar Ahora</a>
                                    </div>
                                @endif
                            </div>

                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">

                    </div>
                    <div class="col-md-2">
                        {{-- <a id="closeAccount" href="{{ route('clients.cancel') }}" class="btn btn-danger">Cerrar Cuenta</a> --}}
                        <a id="closeAccount" href="#" class="btn btn-danger">Cerrar Cuenta</a>
                        <form id="deleteForm" style="display: none;" action="{{ route('clients.cancel') }}" method="get">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
    @section('js')
        <link href="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />
        <script src="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                swal({
                    title: 'Bienvenido',
                    text: "Nuestro equipo se comunicará contigo a la brevedad",
                    type: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                });
                $('#closeAccount').on('click', function(e) {
                    // e.eventPreventDefault();
                    deleteLink = $('#deleteForm');
                    swal({
                        title: '¿Seguro?',
                        text: "No hay forma de revertir esta acción",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: "Cancelar",
                        confirmButtonText: 'Si, eliminar'
                    }).then(function () {
                        deleteLink.submit();
                    })
                })
            });

        </script>
    @endsection
