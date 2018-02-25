@extends('adminlte::page')
@section('title','Admin')
@section('content_header')
    <ol class="breadcrumb">
        <li><a  href="{{route('painel')}}">Home</a></li>
        <li><a >Admin</a></li>
    </ol>
@stop
@section('content')
    <div class="row" style="margin-top: 2rem;">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-md-offset-1 col-lg-offset-1">

            <a href="{{route('admin.create')}}" type="button" class="btn btn-info btn-flat" style="margin-bottom: 10px;">
                <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp; Novo Usuário
            </a>

            <a href="{{route('admin.trash')}}" type="button" class="btn btn-danger btn-flat pull-right" style="margin-bottom: 10px;">
                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Lixeira
            </a>
            @if(session()->has('notification'))
                <div class="alert alert-success" >
                    <p>{{session()->get('notification')}}</p>
                </div>
            @endif


            @if(isset($admins) && count($admins) > 0)
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body" style="padding: 15px 15px 0px 15px !important;">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <!--<th style="width: 10px">#</th>
                                <th>Perfil</th>-->
                                <th>Nome</th>
                                <th>Email</th>
                                <!--<th class="text-center" style="width: 5em;">Status</th>-->
                                <th class="text-center">Opções</th>
                            </tr>
                            @foreach($admins->all() as $admin)
                                <tr>
                                    <!--<td>{{$admin->role_id == 1? 'Admin' : 'Editor'}}</td>-->
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <!--<td class="text-center" style="width: 5em;">{{$admin->status ? 'Ativo' : 'Desativo'}}</td>-->
                                    <td class="text-center">
                                        <a href="{{route('admin.edit',$admin->id)}}" type="button" class="btn btn-primary btn-flat">Editar</a>
                                        <a href="{{route('admin.show',$admin->id)}}" type="button" class="btn btn-danger btn-flat">Visualizar</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pull-right" style="margin: 0px;padding: 0px">
                    {!! $admins->links() !!}
                </div>
            @endif
        </div>
    </div>
@endsection