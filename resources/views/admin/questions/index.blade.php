@extends('admin.layouts.app')
@section('breadcrumb')
    <ol class="breadcrumb pull-right">
        <li class="active"><a href="javascript:;">Preguntas Frecuentes</a></li>
    </ol>
@endsection
@section('header')
    Preguntas Frecuentes <small>maneja las preguntas frecuentes</small>
    <a class="btn btn-success btn-icon btn-circle btn-sm" href="{{ route('questions.create') }}">
        <i class="fa fa-plus"></i>
    </a>
@endsection
@section('content')
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Preguntas Frecuentes</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>Pregunta</th>
                            <th>Respuesta</th>
                            <th>Otros</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $key => $question)
                            <tr class=" gradeC">
                                <td>
                                    <a href="{{ route('questions.show', $question->id) }}">
                                        {{ $question->question }}
                                    </a>
                                </td>
                                <td>{{ $question->answer }}</td>
                                <td>
                                    <p>
                                        <a class="btn btn-danger btn-icon btn-circle btn-sm delete" product="{{ $question->id }}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        <form class="form{{ $question->id }}" action="{{ route('questions.destroy', $question->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end panel -->
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/assets/base.js') }}"></script>

@endsection
