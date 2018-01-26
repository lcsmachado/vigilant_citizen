@extends('adminlte::page')
@section('title',$title)
@section('content_header')
    <h1>{{$title}}</h1>
    <ol class="breadcrumb">
        <li><a  href="{{route('painel')}}">Home</a></li>
        <li><a  href="{{route('categorie')}}">Categorias</a></li>
        <li><a  >Create</a></li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2">
            @if(session()->has('notification'))
                <div class="alert alert-success">
                    <p>{{session()->get('notification')}}</p>
                </div>
            @endif
            @if(isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif
            @if(isset($categorie))
                <form role="form" method="POST" action="{{route('categorie.update',$categorie->id)}}">
                    {!! method_field('PUT') !!}
                    @else
                        <form role="form" method="POST" action="{{route('categorie.store')}}">
                            @endif
                            {!! csrf_field() !!}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input class="form-control" id="name" placeholder="Nome" type="text" name="name" value="{{$categorie->name or old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Descrição</label>
                                    <input class="form-control" id="description" placeholder="Descrição" type="description" name="description" value="{{$categorie->description or old('description')}}">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Selecione</option>
                                        <option value="1" @if(isset($categorie) && $categorie->status == 1) selected @endif>Ativo</option>
                                        <option value="0" @if(isset($categorie) && $categorie->status == 0) selected @endif>Desativo</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check" aria-hidden="true"></i>
                                &nbsp;Enviar</button>
                        </form>
        </div>
    </div>
@endsection