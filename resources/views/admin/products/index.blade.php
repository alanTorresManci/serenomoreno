@extends('admin.layouts.app')
@section('breadcrumb')
    <ol class="breadcrumb pull-right">
        <li class="active"><a href="javascript:;">Conócenos</a></li>
    </ol>
@endsection
@section('header')
    Conócenos<small> maneja los textos</small>
    <a class="btn btn-success btn-icon btn-circle btn-sm" href="{{ route('products.create') }}">
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
                <h4 class="panel-title">Textos</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Contenido</th>
                            <th>Otros</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $product)
                            <tr class=" gradeC">
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}">
                                        {{ $product->title }}
                                    </a>
                                </td>
                                <td>{{ Str::words($product->description, '10', '...') }}</td>
                                <td>
                                    <p>
                                        <a class="btn btn-danger btn-icon btn-circle btn-sm delete" product="{{ $product->id }}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        <form class="form{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="post">
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
