@extends('admin.layouts.app')
@section('css')

@endsection

@section('breadcrumb')
    <ol class="breadcrumb pull-right">
        <li><a href="{{ route('users.index') }}">Usuarios</a></li>
        <li class="active"><a href="#">Crear</a></li>
    </ol>
@stop
@section('header')
    Crear Usuario <small>Completa el formulario para crear un usuario</small>
@endsection
@section('content')
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Crear Usuario</h4>
            </div>
            <div class="panel-body">
                <form id="form" class="form-horizontal" data-parsley-validate enctype="multipart/form-data" action="{{ route('users.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nombre</label>
                        <div class="col-md-9">
                            <input
                                data-parsley-required
                                class="form-control"
                                placeholder="Nombre de usuario"
                                name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Correo electrónico</label>
                        <div class="col-md-9">
                            <input
                                data-parsley-type="email"
                                data-parsley-required
                                class="form-control"
                                placeholder="Correo electrónico"
                                name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Contraseña</label>
                        <div class="col-md-9">
                            <input
                            id="password"
                            data-parsley-required
                            type="password"
                            class="form-control"
                            placeholder="Contraseña"
                            name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Confirmación de Contraseña</label>
                        <div class="col-md-9">
                            <input
                            data-parsley-required
                            type="password"
                            class="form-control"
                            placeholder="Confirmación de Contraseña"
                            data-parsley-equalto="#password"
                            name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Guardar</label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-sm btn-success">Guardar plan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script type="text/javascript">
    $('#form').parsley();
</script>
@endsection
