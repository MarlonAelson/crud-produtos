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
                        <input type="text" class="form-control" id="id" name="id" value="{{ $objeto->id ?? '' }}" maxlength="20" disabled>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="nome">
                            Nome:*
                        </label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ $objeto->nome ?? old('nome') }}" maxlength="45">
                    </div>
                </div>

                <div class="col-sm-2">

                    <label for="">
                        Ativo:*
                    </label>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ativo" id="sim" value="SIM" @isset($objeto->ativo) {{ $objeto->ativo == 'SIM' ? 'checked' : ''}} @endisset @empty($objeto->ativo) {{ old('ativo') == 'SIM' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="sim">Sim</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ativo" id="nao" value="NAO" @isset($objeto->ativo) {{ $objeto->ativo == 'NAO' ? 'checked' : ''}} @endisset @empty($objeto->ativo) {{ old('ativo') == 'NAO' ? 'checked' : '' }} @endempty>
                            <label class="form-check-label" for="nao">Não</label>        
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>

</div>