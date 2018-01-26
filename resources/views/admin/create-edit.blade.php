@extends('adminlte::page')
@section('title',$title)
@section('content_header')
<<<<<<< HEAD
=======
    <h1>{{$title}}</h1>
>>>>>>> 9fe7ea07e6febddd72120e69a9544f7d1f391d04
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
<<<<<<< HEAD
            @if(isset($admin))
                <form role="form" method="POST" action="{{route('admin.update',$admin->id)}}">
=======
            @if(isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif
            @if(isset($admin))
                <form role="form" method="POST" action="{{route('admin.update',$admin->email)}}">
>>>>>>> 9fe7ea07e6febddd72120e69a9544f7d1f391d04
                    {!! method_field('PUT') !!}
                    @else
                        <form role="form" method="POST" action="{{route('admin.store')}}">
                            @endif
                            {!! csrf_field() !!}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input class="form-control" id="name" placeholder="Nome" type="text" name="name" value="{{$admin->name or old('name')}}">
<<<<<<< HEAD
                                    @if ($errors->has('name'))
                                        <span class="text-danger text-center">
                                            <i class="fa fa-close"></i>
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
=======
>>>>>>> 9fe7ea07e6febddd72120e69a9544f7d1f391d04
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email" placeholder="Email" type="email" name="email" value="{{$admin->email or old('email')}}">
<<<<<<< HEAD
                                    @if ($errors->has('email'))
                                        <span class="text-danger text-center">
                                            <i class="fa fa-close"></i>
                                        <strong>{{ $errors->first('email') }}</strong>

                                    </span>
                                    @endif
=======
>>>>>>> 9fe7ea07e6febddd72120e69a9544f7d1f391d04
                                </div>
                                <div class="form-group">
                                    <label for="password">Senha</label>
                                    <input class="form-control" id="password" type="password" name="password">
<<<<<<< HEAD
                                    @if ($errors->has('password'))
                                        <span class="text-danger text-center">
                                            <i class="fa fa-close"></i>
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirme a Senha</label>
                                    <input class="form-control" id="password_confirmation" type="password" name="password_confirmation">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger text-center">
                                            <i class="fa fa-close"></i>
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
=======
>>>>>>> 9fe7ea07e6febddd72120e69a9544f7d1f391d04
                                </div>
                                <div class="form-group">
                                    <label>Perfil</label>
                                    <select class="form-control" name="role_id">
                                        <option value="">Selecione</option>
                                        <option value="1" @if(isset($admin) && $admin->role_id == 1) selected @endif>Admin</option>
                                        <option value="2" @if(isset($admin) && $admin->role_id == 2) selected @endif>Editor</option>
                                    </select>
<<<<<<< HEAD
                                    @if ($errors->has('role_id'))
                                        <span class="text-danger text-center">
                                            <i class="fa fa-close"></i>
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                    @endif
=======
>>>>>>> 9fe7ea07e6febddd72120e69a9544f7d1f391d04
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Selecione</option>
                                        <option value="1" @if(isset($admin) && $admin->status == 1) selected @endif>Ativo</option>
                                        <option value="0" @if(isset($admin) && $admin->status == 0) selected @endif>Desativo</option>
                                    </select>
<<<<<<< HEAD
                                    @if ($errors->has('status'))
                                        <span class="text-danger text-center">
                                            <i class="fa fa-close"></i>
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
=======
>>>>>>> 9fe7ea07e6febddd72120e69a9544f7d1f391d04
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check" aria-hidden="true"></i>
                                &nbsp;Enviar</button>
                        </form>
        </div>
    </div>
@endsection