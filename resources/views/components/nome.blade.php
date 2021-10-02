<div class="form-group">
    <label for="nome">
        Nome:{{ $informacoesComunsViews['obrigatoriedade_inputs'] ? $informacoesComunsViews['simbolo_obrigatoriedade_inputs'] : '' }}
    </label>
    <input type="text" class="form-control" id="nome" name="nome" value="{{ $objeto->nome ?? old('nome') }}" maxlength="{{ $informacoesComunsViews['qtd_max_caracteres_inputs'][120] }}">
</div>
