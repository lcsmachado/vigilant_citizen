@extends('adminlte::page')
@section('title','Admin')
@section('content_header')
    <ol class="breadcrumb">
        <li><a  href="{{route('painel')}}">Home</a></li>
        <li><a href="{{route('admin')}}">Admin</a></li>
        <li><a>Lixeira</a></li>
    </ol>
@stop
@section('content')
    <div class="row" style="margin-top: 2rem;">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-md-offset-1 col-lg-offset-1">

            @if(isset($admins) && count($admins) > 0)
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">

                    </div>
                    <div class="panel-body" style="padding: 15px 15px 0px 15px !important;">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th>Perfil</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th class="text-center">Opções</th>
                            </tr>
                            @foreach($admins->all() as $admin)
                                <tr>
                                    <td>{{$admin->role_id == 1? 'Admin' : 'Editor'}}</td>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.restore',$admin->id)}}" type="button" class="btn btn-primary btn-flat">Restaurar</a>
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
            @else
                <div class="alert alert-info">
                    <p class="text-center">Lixeira vazia!</p>
                </div>
            @endif
        </div>
    </div>
@endsection