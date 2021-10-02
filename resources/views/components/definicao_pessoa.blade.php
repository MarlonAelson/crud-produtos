@isset($objeto)
<div class="col-sm-1">
    <label for="">Cliente:{{ $informacoesComunsViews['obrigatoriedade_inputs'] ? $informacoesComunsViews['simbolo_obrigatoriedade_inputs'] : '' }}</label>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="cliente" id="cliente_sim" value="S" {{ $objeto->cliente === 'S' || old('cliente') === 'S' ? 'checked': '' }}>
            <label class="form-check-label" for="cliente_sim">Sim</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="cliente" id="cliente_nao" value="N" {{ $objeto->cliente === 'N' || old('cliente') === 'N' ? 'checked' : '' }}>
            <label class="form-check-label" for="cliente_nao">Não</label>
        </div>
    </div>
</div>
<div class="col-sm-1">
    <label for="">Fornecedor:{{ $informacoesComunsViews['obrigatoriedade_inputs'] ? $informacoesComunsViews['simbolo_obrigatoriedade_inputs'] : '' }}</label>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="fornecedor" id="fornecedor_sim" value="S" {{ $objeto->fornecedor === 'S' || old('fornecedor') === 'S' ? 'checked' : '' }}>
            <label class="form-check-label" for="fornecedor_sim">Sim</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="fornecedor" id="fornecedor_nao" value="N" {{ $objeto->fornecedor === 'N' || old('fornecedor') === 'N' ? 'checked' : '' }}>
            <label class="form-check-label" for="fornecedor_nao">Não</label>
        </div>
    </div>
</div>
<div class="col-sm-1">
    <label for="">Colaborador:{{ $informacoesComunsViews['obrigatoriedade_inputs'] ? $informacoesComunsViews['simbolo_obrigatoriedade_inputs'] : '' }}</label>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="colaborador" id="colaborador_sim" value="S" {{ $objeto->colaborador === 'S' || old('colaborador') === 'S' ? 'checked' : '' }}>
            <label class="form-check-label" for="colaborador_sim">Sim</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="colaborador" id="colaborador_nao" value="N" {{ $objeto->colaborador === 'N' || old('colaborador') === 'N' ? 'checked' : '' }}>
            <label class="form-check-label" for="colaborador_nao">Não</label>
        </div>
    </div>
</div>
@endisset
@empty($objeto)
<div class="col-sm-1">
    <label for="">Cliente:{{ $informacoesComunsViews['obrigatoriedade_inputs'] ? $informacoesComunsViews['simbolo_obrigatoriedade_inputs'] : '' }}</label>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="cliente" id="cliente_sim" value="S" {{ old('cliente') === 'S' ? 'checked' : '' }}>
            <label class="form-check-label" for="cliente_sim">Sim</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="cliente" id="cliente_nao" value="N" {{ old('cliente') === 'N' ? 'checked' : '' }}>
            <label class="form-check-label" for="cliente_nao">Não</label>
        </div>
    </div>
</div>
<div class="col-sm-1">
    <label for="">Fornecedor:{{ $informacoesComunsViews['obrigatoriedade_inputs'] ? $informacoesComunsViews['simbolo_obrigatoriedade_inputs'] : '' }}</label>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="fornecedor" id="fornecedor_sim" value="S" {{ old('fornecedor') === 'S' ? 'checked' : '' }}>
            <label class="form-check-label" for="fornecedor_sim">Sim</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="fornecedor" id="fornecedor_nao" value="N" {{ old('fornecedor') === 'N' ? 'checked' : '' }}>
            <label class="form-check-label" for="fornecedor_nao">Não</label>
        </div>
    </div>
</div>
<div class="col-sm-1">
    <label for="">Colaborador:{{ $informacoesComunsViews['obrigatoriedade_inputs'] ? $informacoesComunsViews['simbolo_obrigatoriedade_inputs'] : '' }}</label>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="colaborador" id="colaborador_sim" value="S" {{ old('colaborador') === 'S' ? 'checked' : '' }}>
            <label class="form-check-label" for="colaborador_sim">Sim</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="colaborador" id="colaborador_nao" value="N" {{ old('colaborador') === 'N' ? 'checked' : '' }}>
            <label class="form-check-label" for="colaborador_nao">Não</label>
        </div>
    </div>
</div>
@endempty