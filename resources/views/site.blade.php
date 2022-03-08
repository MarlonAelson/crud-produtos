<p>site</p>
<br>
<form method="post" action="{{ route('verifyTenant') }}">
@csrf  
<label for="identificador">Informe o identificador da Empresa:</label><br>
<input type="text" name="identificador" required>
<button type="submit">Enviar</button>
</form>