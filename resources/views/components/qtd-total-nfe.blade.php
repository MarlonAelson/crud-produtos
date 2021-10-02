<div class="form-group">
    <label for="qtd_total_nfe">
        Qtd Total NF-e:{{ $informacoesComunsViews['obrigatoriedade_inputs'] ? $informacoesComunsViews['simbolo_obrigatoriedade_inputs'] : '' }}
    </label>
    <input type="text" class="form-control" id="qtd_total_nfe" name="qtd_total_nfe" value="{{ $objeto->qtd_total_nfe ?? old('qtd_total_nfe') }}">
</div>
