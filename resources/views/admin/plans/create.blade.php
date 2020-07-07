@extends('admin.layouts.app')
@section('css')

@endsection

@section('breadcrumb')
    <ol class="breadcrumb pull-right">
        <li><a href="{{ route('plans.index') }}">Planes</a></li>
        <li class="active"><a href="#">Crear</a></li>
    </ol>
@stop
@section('header')
    Crear Plan <small>Completa el formulario para crear un plan</small>
@endsection
@section('content')
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Crear Plan</h4>
            </div>
            <div class="panel-body">
                <form id="form" class="form-horizontal" data-parsley-validate enctype="multipart/form-data" action="{{ route('plans.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nombre</label>
                        <div class="col-md-9">
                            <input
                                data-parsley-required
                                class="form-control"
                                placeholder="Nombre del plan"
                                name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Precio</label>
                        <div class="col-md-9">
                            <input
                                data-parsley-type="number"
                                data-parsley-required
                                class="form-control"
                                placeholder="Precio mensual del plan"
                                name="price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Descripción</label>
                        <div class="col-md-9">
                            <input
                            data-parsley-required
                            class="form-control"
                            placeholder="Descripción del plan"
                            name="description">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Características del plan</label>
                        <div class="col-md-9">
                            <textarea
                                data-parsley-required
                                class="form-control"
                                placeholder="Características del plan"
                                name="plan_attributes"></textarea>
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
