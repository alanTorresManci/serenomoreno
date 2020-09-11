@extends('admin.layouts.app')
@section('breadcrumb')
    <ol class="breadcrumb pull-right">
        <li class="active"><a href="javascript:;">Textos</a></li>
    </ol>
@endsection
@section('header')
    Textos<small> maneja los textos</small>
@endsection
@section('content')
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <h4 class="panel-title">Textos</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Contenido</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($texts as $key => $text)
                            <tr class=" gradeC">
                                <td>
                                    <a href="{{ route('texts.show', $text->id) }}">
                                        {{ $text->title }}
                                    </a>
                                </td>
                                <td>{{ Str::words($text->text, '10', '...') }}</td>
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
