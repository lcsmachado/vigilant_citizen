@extends('adminlte::page')
@section('title',$title)
@section('content_header')
    <h1>{{$title}}</h1>
    <ol class="breadcrumb">
        <li><a  href="{{route('painel')}}">Home</a></li>
        <li><a  href="{{route('admin')}}">Admin</a></li>
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
            @if(isset($admin))
                <form role="form" method="POST" action="{{route('admin.update',$admin->email)}}">
                    {!! method_field('PUT') !!}
                    @else
                        <form role="form" method="POST" action="{{route('admin.store')}}">
                            @endif
                            {!! csrf_field() !!}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input class="form-control" id="name" placeholder="Nome" type="text" name="name" value="{{$admin->name or old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email" placeholder="Email" type="email" name="email" value="{{$admin->email or old('email')}}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Senha</label>
                                    <input class="form-control" id="password" type="password" name="password">
                                </div>
                                <div class="form-group">
                                    <label>Perfil</label>
                                    <select class="form-control" name="role_id">
                                        <option value="">Selecione</option>
                                        <option value="1" @if(isset($admin) && $admin->role_id == 1) selected @endif>Admin</option>
                                        <option value="2" @if(isset($admin) && $admin->role_id == 2) selected @endif>Editor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Selecione</option>
                                        <option value="1" @if(isset($admin) && $admin->status == 1) selected @endif>Ativo</option>
                                        <option value="0" @if(isset($admin) && $admin->status == 0) selected @endif>Desativo</option>
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