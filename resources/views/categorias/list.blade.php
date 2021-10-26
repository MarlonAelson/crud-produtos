@extends('adminlte::page')
@section('content_header')

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
                            <h3 class="card-title">{{ $informacoesComunsViews['label_card_list'] }} - Quantidade: {{ $qtdRegistros }}</h3>
                        </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="textoBusca" name="textoBusca" placeholder="{{ $informacoesComunsViews['informativo_pesquisa'] }}">
                                    </div>
                                    <button type="submit" class="btn btn-secondary col-sm-2"><i class="fas fa-search"></i> Pesquisar</button>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="{{ route($informacoesComunsViews['route_name_view'].'.create') }}" class="btn btn-secondary"><i class="far fa-file"></i> Novo</a>
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
                            <tbody>
                            @if(!$objetos['data'] && $objetos['errors'])
                                <tr>
                                    <td colspan="7">
                                        {{$objetos['mensagem']}}
                                    </td>
                                </tr>
                            @elseif($objetos['data'] && !$objetos['errors'])
                                @forelse ($objetos['data'] as $objeto)
                                <tr>
                                    <td>
                                        {{$objeto->id}}
                                    </td>
                                    <td>
                                        {{$objeto->nome}}
                                    </td>
                                    <td>
                                        {{$objeto->categoria_pessoa}}
                                    </td>
                                    <td>
                                        {{$objeto->categoria_produto_servico}}
                                    </td>
                                    <td>
                                        {{$objeto->categoria_objeto_manutencao}}
                                    </td>
                                    <td>
                                        {{$objeto->ativo}}
                                    </td>
                                    <td>
                                        <a href="{{ route($informacoesComunsViews['route_name_view'].'.edit', $objeto->id) }}" class="btn btn-outline-primary"><i class="fas fa-list-ol"></i> Editar</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td> Nenhuma categoria cadastrada!</td>
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



