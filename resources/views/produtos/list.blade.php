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
                        <form class="form-horizontal" method="post" action="{{ route($informationsCommonFrontEnd['route_name_view'].'.search') }}">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="textSearch" name="filters[textSearch]" placeholder="{{ $informationsCommonFrontEnd['informative_search'] }}">
                                    </div>
                                    <button type="submit" class="btn btn-secondary col-sm-2"><i class="fas fa-search"></i> Pesquisar</button>
                                
                                </div>

                                <div class="form-group row">
                                    
                                    <div class="col-sm-2">
                                        <label>Busca</label>
                                        <input type="text" class="form-control" name="search" value="simple" readonly>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Quantidade</label>
                                        <input type="text" class="form-control" name="offset" value="0" readonly>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Ordenação Por</label>
                                        <select class="form-control" name="orderByColunm">
                                            <option value="id">Código</option>
                                            <option value="nome" selected>Nome</option>
                                            <option value="preco">Preço</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-sm-2">
                                        <label for="">
                                            Forma Ordenação
                                        </label>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="orderByType" id="sim" value="asc" checked @isset($object->ativo) {{ $object->ativo == 'S' ? 'checked' : ''}} @endisset @empty($object->ativo) {{ old('ativo') == 'S' ? 'checked' : '' }} @endempty>
                                                <label class="form-check-label" for="sim">Crescente</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="orderByType" id="nao" value="desc" @isset($object->ativo) {{ $object->ativo == 'N' ? 'checked' : ''}} @endisset @empty($object->ativo) {{ old('ativo') == 'N' ? 'checked' : '' }} @endempty>
                                                <label class="form-check-label" for="nao">Decrescente</label>        
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Quantidade</label>
                                        <select class="form-control" name="paginate">
                                            <option value="15" selected>15</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                            <option value="*">Todos</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        <label for="">
                                            Ativo
                                        </label>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="filters[ativo]" id="sim" value="S" checked @isset($object->ativo) {{ $object->ativo == 'S' ? 'checked' : ''}} @endisset @empty($object->ativo) {{ old('ativo') == 'S' ? 'checked' : '' }} @endempty>
                                                <label class="form-check-label" for="sim">Sim</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="filters[ativo]" id="nao" value="N" @isset($object->ativo) {{ $object->ativo == 'N' ? 'checked' : ''}} @endisset @empty($object->ativo) {{ old('ativo') == 'N' ? 'checked' : '' }} @endempty>
                                                <label class="form-check-label" for="nao">Não</label>        
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="filters[ativo]" id="todos" value="S','N" @isset($object->ativo) {{ $object->ativo == 'N' ? 'checked' : ''}} @endisset @empty($object->ativo) {{ old('ativo') == 'N' ? 'checked' : '' }} @endempty>
                                                <label class="form-check-label" for="todos">Todos</label>        
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="{{ route($informationsCommonFrontEnd['route_name_view'].'.create') }}" class="btn btn-secondary"><i class="fas fa-file"></i> Novo</a>
                                <a href="{{ route($informationsCommonFrontEnd['route_name_view'].'.pdf') }}" class="btn btn-secondary" target="_blank"><i class="fas fa-file-pdf"></i> PDF</a>
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
                                        Código Interno
                                    </th>
                                    <th>
                                        Código de Barras
                                    </th>
                                    <th>
                                        Nome
                                    </th>
                                    <th>
                                        Unidade
                                    </th>
                                    <th>
                                        Preço
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
                                        {{$object->codigo_barras}}
                                    </td>
                                    <td>
                                        {{$object->nome}}
                                    </td>
                                    <td>
                                        {{$object->unidade->nome}}
                                    </td>
                                    <td>
                                        {{$object->preco}}
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
                            {{ $objects['data']->links() }}
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



