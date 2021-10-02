<div class="form-group">
    <label for="id">
       ID:
    </label>
    <input type="text" class="form-control" id="id" name="id" value="{{ $objeto->id ?? old('id')}}" maxlength="{{ $informacoesComunsViews['qtd_max_caracteres_inputs'][120] }}" disabled>
</div>
