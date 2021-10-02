@include('layouts.erros')
<div class="row">

    <div class="col-12">

        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Dados Básicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Permissões</a>
                    </li>
                </ul>
            </div>
        </div>
    
    
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

                <div class="row">

                    <div  class="col-sm-2">
                        @include('components.id')
                    </div>
                    <div class="col-sm-1">
                        @include('components.ativo')    
                    </div>
                    @include('components.definicao_pessoa')
                    </div>
                    <div class="row">
                    <div class="col-sm-6">
                        @include('components.nome')
                    </div>
                    <div class="col-sm-6">
                        @include('components.nome_alternativo')
                    </div>
                    </div>
                
                </div>

                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    Mauris         
            </div>
        </div>
    </div>

</div>