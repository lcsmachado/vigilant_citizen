@extends('adminlte::page')
@section('title','Detalhes')

@section('content_header')
    <ol class="breadcrumb">
        <li><a  href="{{route('painel')}}">Home</a></li>
        <li><a  href="{{route('admin')}}">Admin</a></li>
        <li><a>Usuários</a></li>
    </ol>
@stop

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-2 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">

            <div class="small-box bg-aqua">
                <div class="inner">
                    <p><strong>Perfil:</strong> {{$admin->role_id == 1? 'Admin' : 'Editor'}}</p>
                    <p><strong>Nome: </strong>{{ $admin->name }}</p>
                    <p><strong>E-mail: </strong>{{ $admin->email }}</p>
                    <p><strong>Status: </strong>{{ $admin->status ? 'Ativo' : 'Desativo'}}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>

                <form  method="POST" action="{{route('admin.destroy',$admin->id)}}">
                    {!! method_field('DELETE') !!}
                    {!! csrf_field() !!}
                    <button style="border: none;padding: 5px;" type="submit" class="small-box-footer bg-red btn-block"><i class="fa fa-user-times fa-2x" aria-hidden="true"></i>
                        &nbsp;Excluir</button>
                </form>

            </div>
        </div>
    </div>

@endsection