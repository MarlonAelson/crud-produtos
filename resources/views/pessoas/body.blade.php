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

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nome_alternativo">
                            Nome Alternativo:*
                        </label>
                        <input type="text" class="form-control" id="nome_alternativo" name="nome_alternativo" value="{{ $object->nome_alternativo ?? old('nome_alternativo') }}" maxlength="45">
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
                    <label for="">Cliente:</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cliente" id="cliente_sim" value="S" @isset($object->cliente) {{ $object->cliente == 'S' ? 'checked' : ''}} @endisset @empty($object->cliente) {{ old('cliente') == 'S' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="cliente_sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cliente" id="cliente_nao" value="N" @isset($object->cliente) {{ $object->cliente == 'N' ? 'checked' : ''}} @endisset @empty($object->cliente) {{ old('cliente') == 'N' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="cliente_nao">Não</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="">Fornecedor:</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="fornecedor" id="fornecedor_sim" value="S" @isset($object->fornecedor) {{ $object->fornecedor == 'S' ? 'checked' : ''}} @endisset @empty($object->fornecedor) {{ old('fornecedor') == 'S' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="fornecedor_sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="fornecedor" id="fornecedor_nao" value="N" @isset($object->fornecedor) {{ $object->fornecedor == 'N' ? 'checked' : ''}} @endisset @empty($object->fornecedor) {{ old('fornecedor') == 'N' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="fornecedor_nao">Não</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="">Colaborador:*</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="colaborador" id="colaborador_sim" value="S" @isset($object->colaborador) {{ $object->colaborador == 'S' ? 'checked' : ''}} @endisset @empty($object->colaborador) {{ old('colaborador') == 'S' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="colaborador_sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="colaborador" id="colaborador_nao" value="N" @isset($object->colaborador) {{ $object->colaborador == 'N' ? 'checked' : ''}} @endisset @empty($object->colaborador) {{ old('colaborador') == 'N' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="colaborador_nao">Não</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="">Empresa:</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="empresa" id="empresa_sim" value="S" @isset($object->empresa) {{ $object->empresa == 'S' ? 'checked' : ''}} @endisset @empty($object->empresa) {{ old('empresa') == 'S' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="empresa_sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="empresa" id="empresa_nao" value="N" @isset($object->empresa) {{ $object->empresa == 'N' ? 'checked' : ''}} @endisset @empty($object->empresa) {{ old('empresa') == 'N' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="empresa_nao">Não</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="">Outros:</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="outros" id="outros_sim" value="S" @isset($object->outros) {{ $object->outros == 'S' ? 'checked' : ''}} @endisset @empty($object->outros) {{ old('outros') == 'S' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="outros_sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="outros" id="outros_nao" value="N" @isset($object->outros) {{ $object->outros == 'N' ? 'checked' : ''}} @endisset @empty($object->outros) {{ old('outros') == 'N' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="outros_nao">Não</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                @forelse($permissoes as $permissao)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permissoes[]" value="{{ $permissao->id }}">
                        <label class="form-check-label" >{{$permissao->nome_alternativo}}</label>
                    </div>
                @empty
                @endforelse
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="enderecos[]" value="1">
                        <label class="form-check-label" >1</label>
                    </div>
                </div>
                <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="enderecos[]" value="2">
                        <label class="form-check-label" >2</label>
                </div>
            </div>
            
        </div>
    </div>

</div>