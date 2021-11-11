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
                        <input type="text" class="form-control" id="id" name="id" value="{{ $object->id ?? '' }}" maxlength="20" disabled>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nome">
                            Nome:*
                        </label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ $object->nome ?? old('nome') }}" maxlength="45">
                    </div>
                </div>

                <div class="col-sm-2">

                    <label for="">
                        Ativo:*
                    </label>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ativo" id="sim" value="S" @isset($object->ativo) {{ $object->ativo == 'S' ? 'checked' : ''}} @endisset @empty($object->ativo) {{ old('ativo') == 'S' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ativo" id="nao" value="N" @isset($object->ativo) {{ $object->ativo == 'N' ? 'checked' : ''}} @endisset @empty($object->ativo) {{ old('ativo') == 'N' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="nao">Não</label>        
                        </div>
                    </div>
                </div>
                
            <div class="row">
                <div class="col-sm-4">
                    <label for="">Categoria de Pessoa:</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria_pessoa" id="categoria_pessoa_sim" value="S" @isset($object->categoria_pessoa) {{ $object->categoria_pessoa == 'S' ? 'checked' : ''}} @endisset @empty($object->categoria_pessoa) {{ old('categoria_pessoa') == 'S' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="categoria_pessoa_sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria_pessoa" id="categoria_pessoa_nao" value="N" @isset($object->categoria_pessoa) {{ $object->categoria_pessoa == 'N' ? 'checked' : ''}} @endisset @empty($object->categoria_pessoa) {{ old('categoria_pessoa') == 'N' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="categoria_pessoa_nao">Não</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="">Categoria de Produto e Serviço:*</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria_produto_servico" id="categoria_produto_servico_sim" value="S" @isset($object->categoria_produto_servico) {{ $object->categoria_produto_servico == 'S' ? 'checked' : ''}} @endisset @empty($object->categoria_produto_servico) {{ old('categoria_produto_servico') == 'S' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="categoria_produto_servico_sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria_produto_servico" id="categoria_produto_servico_nao" value="N" @isset($object->categoria_produto_servico) {{ $object->categoria_produto_servico == 'N' ? 'checked' : ''}} @endisset @empty($object->categoria_produto_servico) {{ old('categoria_produto_servico') == 'N' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="categoria_produto_servico_nao">Não</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="">Categoria de objeto de Manutenção:</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria_objeto_manutencao" id="categoria_objeto_manutencao_sim" value="S" @isset($object->categoria_objeto_manutencao) {{ $object->categoria_objeto_manutencao == 'S' ? 'checked' : ''}} @endisset @empty($object->categoria_objeto_manutencao) {{ old('categoria_objeto_manutencao') == 'S' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="categoria_objeto_manutencao_sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="categoria_objeto_manutencao" id="categoria_objeto_manutencao_nao" value="N" @isset($object->categoria_objeto_manutencao) {{ $object->categoria_objeto_manutencao == 'N' ? 'checked' : ''}} @endisset @empty($object->categoria_objeto_manutencao) {{ old('categoria_objeto_manutencao') == 'N' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="categoria_objeto_manutencao_nao">Não</label>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>

</div>