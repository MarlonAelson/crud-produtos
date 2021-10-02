<div class="form-group">
    <label for="nome_alternativo">
        Nome Alternativo: {{ !$informacoesComunsViews['obrigatoriedade_inputs'] ? $informacoesComunsViews['simbolo_obrigatoriedade_inputs'] : '' }}
    </label>
    <input type="text" class="form-control" id="nome_alternativo" name="nome_alternativo" value="{{ $objeto->nome_alternativo ?? old('nome_alternativo') }}" maxlength="{{ $informacoesComunsViews['qtd_max_caracteres_inputs'][120] }}">
</div>
