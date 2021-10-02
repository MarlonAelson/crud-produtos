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
                            <a href="{{ route($informacoesComunsViews['route_name_view'].'.form') }}" class="btn btn-secondary"><i class="far fa-file"></i> Novo</a>
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
                    @include($informacoesComunsViews['route_name_view'].'.head')
                  </tr>
                  </thead>
                  <tbody>
                    @include($informacoesComunsViews['route_name_view'].'.grid')
                  </tbody>
                  <tfoot>
                    <tr>
                    @include($informacoesComunsViews['route_name_view'].'.foot')
                    </tr>
                  </tfoot>
                </table>
                <div>
                  @include($informacoesComunsViews['route_name_view'].'.link')
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->    
        </div> 
    </div> 
    </section>        
@endsection



