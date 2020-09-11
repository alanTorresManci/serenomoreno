@extends('admin.layouts.app')
@section('css')

@endsection

@section('breadcrumb')
    <ol class="breadcrumb pull-right">
        <li><a href="{{ route('products.index') }}">Conócenos</a></li>
        <li class="active"><a href="#">Crear</a></li>
    </ol>
@stop
@section('header')
    Crear Entrada <small>Completa el formulario para crear una entrada </small>
@endsection
@section('content')
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Crear Entrada</h4>
            </div>
            <div class="panel-body">
                <form id="form" class="form-horizontal" data-parsley-validate enctype="multipart/form-data" action="{{ route('products.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Título</label>
                        <div class="col-md-9">
                            <input
                                data-parsley-required
                                class="form-control"
                                placeholder="Título"
                                name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Texto</label>
                        <div class="col-md-9">
                            <textarea
                                data-parsley-required
                                class="form-control"
                                placeholder="Texto"
                                name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Imagen</label>
                        <div class="col-md-9">
                            <input data-parsley-required type="file" accept="image/*" class="form-control" name="image" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Guardar</label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-sm btn-success">Guardar Entrada</button>
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
