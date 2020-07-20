@extends('admin.layouts.app')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote.css') }}"> --}}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb pull-right">
        <li><a href="{{ route('questions.index') }}">Preguntas Frecuentes</a></li>
        <li class="active"><a href="#">Crear</a></li>
    </ol>
@stop
@section('header')
    Crear Pregunta Frecuente <small>Completa el formulario para crear una pregunta frecuente</small>
@endsection
@section('content')
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Crear Pregunta Frecuente</h4>
            </div>
            <div class="panel-body">
                <form id="form" class="form-horizontal" data-parsley-validate enctype="multipart/form-data" action="{{ route('questions.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pregunta</label>
                        <div class="col-md-9">
                            <input
                                data-parsley-required
                                class="form-control"
                                placeholder="Pregunta"
                                name="question">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Respuesta</label>
                        <div class="col-md-9">
                            <textarea
                                data-parsley-required
                                class="form-control"
                                placeholder="Respuesta"
                                name="answer"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Guardar</label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-sm btn-success">Guardar pregunta</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
{{-- <script type="text/javascript" src="{{ asset('plugins/summernote/summernote.min.js') }}"></script> --}}
<script type="text/javascript">
    $(document).ready(function() {
        // $('#summernote').summernote({
        //     placeholder: 'Respuesta a la pregunta',
        // });
        $('#form').parsley();
    });
</script>
@endsection
