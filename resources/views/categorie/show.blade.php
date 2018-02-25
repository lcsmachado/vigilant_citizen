@extends('adminlte::page')
@section('title','Detalhes')

@section('content_header')
    <h1>categorie</h1>
    <ol class="breadcrumb">
        <li><a  href="{{route('painel')}}">Home</a></li>
        <li><a  href="{{route('categorie')}}">Categorias</a></li>
        <li><a>Show</a></li>
    </ol>
@stop

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-2 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">

            <div class="small-box bg-aqua">
                <div class="inner">
                    <p><strong>Nome: </strong>{{ $categorie->name }}</p>
                    <p><strong>Descrição: </strong>{{ $categorie->description }}</p>
                    <p><strong>Status: </strong>{{ $categorie->status ? 'Ativo' : 'Desativo'}}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>

                <form  method="POST" action="{{route('categorie.destroy',$categorie->id)}}">
                    {!! method_field('DELETE') !!}
                    {!! csrf_field() !!}
                    @if(Route::current()->getName() =='categorie.show')
                    <button style="border: none;padding: 5px;" type="submit" class="small-box-footer bg-red btn-block"><i class="fa fa-user-times fa-2x" aria-hidden="true"></i>
                        &nbsp;Excluir</button>
                    @endif
                </form>

            </div>
        </div>
    </div>

@endsection
