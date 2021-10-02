<label for="">Ativo:{{ $informacoesComunsViews['obrigatoriedade_inputs'] ? $informacoesComunsViews['simbolo_obrigatoriedade_inputs'] : '' }}</label>
<div class="form-group">
    @isset($objeto->ativo)
    <div class="form-check">
        <input class="form-check-input" type="radio" name="ativo" id="sim" value="S" {{ $objeto->ativo === 'S' || old('ativo') === 'S' ? 'checked': '' }}>
        <label class="form-check-label" for="sim">Sim</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="ativo" id="nao" value="N" {{ $objeto->ativo === 'N' || old('ativo') === 'N' ? 'checked': '' }}>
        <label class="form-check-label" for="nao">Não</label>        
    </div>
    @endisset
    @empty($objeto->ativo)
    <div class="form-check">
        <input class="form-check-input" type="radio" name="ativo" id="sim" value="S" checked>
        <label class="form-check-label" for="sim">Sim</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="ativo" id="nao" value="N" {{ old('ativo') === 'N' ? 'checked': '' }}>
        <label class="form-check-label" for="nao">Não</label>        
    </div>
    @endempty
</div>
           
               
                