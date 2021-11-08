@include('layouts.errors')
<div class="row">

    <div class="col-12">
    
        <div class="card-body">
            
            <div class="row">

                <div  class="col-sm-2">
                <div class="form-group">
                    <label for="id">
                        ID:
                    </label>
                        <input type="text" class="form-control" id="id" name="id" maxlength="20" disabled>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nome">
                            Nome:*
                        </label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ $objeto->nome ?? old('nome') }}" maxlength="45">
                    </div>
                </div>

                <div class="col-sm-2">

                    <label for="">
                        Ativo:*
                    </label>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ativo" id="sim" value="1" @isset($objeto->ativo) {{ $objeto->ativo == 1 ? 'checked' : ''}} @endisset @empty($objeto->ativo) {{ old('ativo') == 1 ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ativo" id="nao" value="0" @isset($objeto->ativo) {{ $objeto->ativo == 0 ? 'checked' : ''}} @endisset @empty($objeto->ativo) {{ old('ativo') == 0 ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="nao">Não</label>        
                        </div>
                    </div>
                </div>
                
            <div class="row">
                <div class="col-sm-4">
                    <label for="">Categoria de Pessoa:</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria_pessoa" id="categoria_pessoa_sim" value="1">
                            <label class="form-check-label" for="categoria_pessoa_sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria_pessoa" id="categoria_pessoa_nao" value="0">
                            <label class="form-check-label" for="categoria_pessoa_nao">Não</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="">Categoria de Produto e Serviço:*</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria_produto_servico" id="categoria_produto_servico_sim" value="1">
                            <label class="form-check-label" for="categoria_produto_servico_sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria_produto_servico" id="categoria_produto_servico_nao" value="0">
                            <label class="form-check-label" for="categoria_produto_servico_nao">Não</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="">Categoria de Objeto de Manutenção:</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria_objeto_manutencao" id="categoria_objeto_manutencao_sim" value="1">
                            <label class="form-check-label" for="categoria_objeto_manutencao_sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria_objeto_manutencao" id="categoria_objeto_manutencao_nao" value="0">
                            <label class="form-check-label" for="categoria_objeto_manutencao_nao">Não</label>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>

</div>