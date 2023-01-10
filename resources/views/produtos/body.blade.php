@include('layouts.errors')
<div class="row">

    <div class="col-12">
    
        <div class="card-body">
            
            <div class="row">

                <div  class="col-sm-3">
                <div class="form-group">
                    <label for="id">
                        ID:
                    </label>
                        <input type="text" class="form-control" id="id" name="id" value="{{ $object->id ?? '' }}" maxlength="20" disabled>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="codigo_barras">
                            Código de Barras:
                        </label>
                        <input type="text" class="form-control" id="codigo_barras" name="codigo_barras" value="{{ $object->codigo_barras ?? old('codigo_barras') }}" maxlength="14"
                        onkeypress="return onlynumber();">
                    </div>
                </div>

                <div class="col-sm-3">
                    <label for="">
                        Ativo:*
                    </label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ativo" id="sim" value="S" @isset($object->ativo) {{ $object->ativo == 'S' ? 'checked' : ''}} @endisset @empty($object->ativo) {{ old('ativo') == 'S' ? 'checked' : (old('ativo') == '' ? 'checked' : '') }} @endempty>
                            <label class="form-check-label" for="sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ativo" id="nao" value="N" @isset($object->ativo) {{ $object->ativo == 'N' ? 'checked' : ''}} @endisset @empty($object->ativo) {{ old('ativo') == 'N' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="nao">Não</label>        
                        </div>
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
                    <label>Unidade:*</label>
                        <select class="form-control" name="unidade_id">
                            @forelse($unidades as $unidade)
                            <option value="{{$unidade->id}}" @isset($object->unidade->id) {{ $object->unidade->id == $unidade->id ? 'selected' : '' }} @endisset> {{ $unidade->nome }}</option>
                            @empty
                            <option value="">Sem Informação</option>
                            @endforelse
                        </select>
                    </div>
                </div>
        </div>
    </div>

</div>


<script>

function onlynumber(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    
    key = String.fromCharCode( key );
    //var regex = /^[0-9.,]+$/;
    var regex = /^[0-9.]+$/;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

</script>
