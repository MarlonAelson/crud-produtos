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
                        <h3 class="card-title">{{ $informacoesComunsViews['label_card_form'] }}</h3>
                    </div>
                <!-- /.card-header -->
                <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{ route($informacoesComunsViews['route_name_view'].'.store') }}">
                    @csrf    
                    <div class="card-body">
                        <small><strong>Os campos com o asterisco (*) são obrigatórios informar!</strong></small>
                            @include($informacoesComunsViews['route_name_view'].'.body')
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-outline-success"><i class="fas fa-save"></i> Salvar</button>
                            <a href="{{ route($informacoesComunsViews['route_name_view'].'.list') }}" class="btn btn-outline-primary"><i class="fas fa-list-ol"></i> Ir P/ Listagem</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>        
@endsection


