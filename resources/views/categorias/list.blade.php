@extends('adminlte::page')
@section('content_header')
<span></span>
@endsection

@section('content')
<section class="content">

    <div class="container-fluid">

        <div class="row">

            <!-- left column -->
            <div class="col-md-12">

                <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $informationsCommonFrontEnd['label_card_list'] }} - Quantidade: {{ $qtdRegisters }}</h3>
                        </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="textoBusca" name="textoBusca" placeholder="{{ $informationsCommonFrontEnd['informative_search'] }}">
                                    </div>
                                    <button type="submit" class="btn btn-secondary col-sm-2"><i class="fas fa-search"></i> Pesquisar</button>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="{{ route($informationsCommonFrontEnd['route_name_view'].'.create') }}" class="btn btn-secondary"><i class="fas fa-file"></i> Novo</a>
                                <a href="{{ route($informationsCommonFrontEnd['route_name_view'].'.pdf') }}" class="btn btn-secondary"><i class="fas fa-file-pdf"></i> PDF</a>
                                <a href="{{ route($informationsCommonFrontEnd['route_name_view'].'.email') }}" class="btn btn-secondary"><i class="far fa-envelope"></i> Email</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-12">
      
                <div class="card">
                <!-- /.card-header -->
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Código
                                    </th>
                                    <th>
                                        Nome
                                    </th>
                                    <th>
                                        Cat. de Pessoa
                                    </th>
                                    <th>
                                        Cat. de Prod/Serv.
                                    </th>
                                    <th>
                                        Cat. de Obj. Manut.
                                    </th>
                                    <th>
                                        Ativo
                                    </th>
                                    <th>
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            @include('layouts.errors')
                            <tbody>
                            @if($objects['data'] && !$objects['errors'])
                                @forelse ($objects['data'] as $object)
                                <tr>
                                    <td>
                                        {{$object->id}}
                                    </td>
                                    <td>
                                        {{$object->nome}}
                                    </td>
                                    <td>
                                        {{$object->categoria_pessoa}}
                                    </td>
                                    <td>
                                        {{$object->categoria_produto_servico}}
                                    </td>
                                    <td>
                                        {{$object->categoria_objeto_manutencao}}
                                    </td>
                                    <td>
                                        {{$object->ativo}}
                                    </td>
                                    <td>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Ações</button>
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="btn btn-app bg-primary" href="{{ route($informationsCommonFrontEnd['route_name_view'].'.edit', $object->id) }}">
                                                    <i class="fas fa-edit"></i> Alterar
                                                </a>
                                                <a class="btn btn-app bg-info" href="{{ route($informationsCommonFrontEnd['route_name_view'].'.edit', $object->id) }}">
                                                    <i class="fas fa-search-plus"></i> Detalhar
                                                </a>
                                                <a class="btn btn-app bg-warning" href="{{ route($informationsCommonFrontEnd['route_name_view'].'.replicate', $object->id) }}">
                                                    <i class="far fa-copy"></i> Clonar
                                                </a>
                                                <a class="btn btn-app bg-secondary" href="{{ route($informationsCommonFrontEnd['route_name_view'].'.inactiveOrActive', $object->id) }}">
                                                    <i class="fas fa-adjust"></i> Inativar/Ativar
                                                </a>
                                                <a class="btn btn-app bg-danger" href="{{ route($informationsCommonFrontEnd['route_name_view'].'.destroy', $object->id) }}">
                                                    <i class="fas fa-trash"></i> Excluir
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </td>
                  
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7"> Nenhuma categoria cadastrada!</td>
                                </tr>
                                @endforelse
                            @endif                              
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                        <div>
                            Aqui vai ter o link
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->    
            </div> 
        </div>
    </div> 
</section>        
@endsection



