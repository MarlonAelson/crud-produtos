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
                        <label for="emitente_id">
                            Emitente_id:*
                        </label>
                        <input type="text" class="form-control" id="emitente_id" name="emitente_id" value="{{ $object->emitente_id ?? old('emitente_id') }}" maxlength="45">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="destinatario_id">
                            destinatario_id:*
                        </label>
                        <input type="text" class="form-control" id="destinatario_id" name="destinatario_id" value="{{ $object->destinatario_id ?? old('destinatario_id') }}" maxlength="45">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="numero">
                            numero:*
                        </label>
                        <input type="text" class="form-control" id="numero" name="numero" value="{{ $object->numero ?? old('numero') }}" maxlength="45">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="situacao">
                            situacao:*
                        </label>
                        <input type="text" class="form-control" id="situacao" name="situacao" value="{{ $object->situacao ?? old('situacao') }}" maxlength="45">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="itens[]" value="1">
                            <label class="form-check-label" >1</label>
                        </div>
                    </div>
                    <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="itens[]" value="2">
                            <label class="form-check-label" >2</label>
                    </div>
                </div>

            </div>
            
        </div>
    </div>

</div>