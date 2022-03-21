<p>site</p>
<br>
<form method="post" action="{{ route('verifyIdentification') }}">
@csrf  
<label for="identification">Informe o identificador da Empresa:</label><br>
<input type="text" name="identification" required>
<button type="submit">Enviar</button>
</form>