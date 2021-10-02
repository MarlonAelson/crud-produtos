<div class="form-group">
    <label for="qtd_total_cte">
        Qtd Total CT-e:{{ $informacoesComunsViews['obrigatoriedade_inputs'] ? $informacoesComunsViews['simbolo_obrigatoriedade_inputs'] : '' }}
    </label>
    <input type="text" class="form-control" id="qtd_total_cte" name="qtd_total_cte" value="{{ $objeto->qtd_total_cte ?? old('qtd_total_cte') }}">
</div>
