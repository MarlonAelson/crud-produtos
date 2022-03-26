# PROJETO MODELO
Este projeto servirá para o desenvolvimento de qualquer outro sistema! <br/>

# DETATLHES PROJETO
Versão do Laravel: 8.6.2; <br/>

Criado uma pasta "Repositories" dentro de "app" para armazenar classes que recebem como dependência no construtor um "Model" e, com isso, a responsabalidade por gerir os métodos e demais detalhes ficará sempre no "Repository" daquele Model ou no "próprio Model"; <br/>

Criado uma classe "AbstractRepository" "para ser extendida (Extends) pelas outras classes Repository" e, com isso, disponibilizar de forma padrão (a partir da variável protected $model) todos os métodos comuns (inserir, alterar, deletar os registros no banco de dados). Ela também recebe de forma simples os relacionamentos (a partir da variável protected $relationShip) dos Models para salvar, alterar etc de forma mais automatizada; <br/>

Implementado para que os "Controllers especificados nas rotas recebam apenas o Request e passe o mesmo como parâmetro nos métodos das classes Repository na qual recebe como dependência" e, com isso, os controllers apenas "retornam" o "sucesso" ou a "falha" que virá do Repository; <br/>

"Adicionado SoftDeletes" do próprio Laravel ao projeto em "alguns models e migrations"; <br/>

### PRECISA MELHORAR AQUI AINDA
Centralizado todos os cadastros na Tabela/Model Pessoa definindo se é empresa do grupo e/ou cliente e/ou fornecedor e/ou colocaborador e/ou outros e com possbilidade de qualquer cadastro desses ter acesso ou não ao sistema devido a ter ajustado a autenticação do Laravel para esta Tabela/Model (pasta docs tem o passo a passo de como realizar a mudança); <br/>

Traduzido a aplicação do laravel colocando manualmente uma pasta pt-BR dentro de resources/lang; <br/>

Configurado para utilizar o controle de permissões pelo Spatie (pasta docs tem o passo a passo de como realizar a configuração). Site Oficial: https://spatie.be/docs/laravel-permission/v5/introduction ; <br/>

### PRECISA MELHORAR AQUI AINDA
Criado uma seeder para inserir algumas permissões para ficar de modelo e exemplo; <br/>
### PRECISA MELHORAR AQUI AINDA
Criado uma seeder para inserir dois usuários para que seja testado as permissões: usuario: admin123, senha: admin123, email: admin@sistema.com | usuário: usuario123, senha: usuario123, usuario@sistema.com; <br/>
### PRECISA MELHORAR AQUI AINDA
Criado uma seeder para inserir categorias (que serão centralizadas numa única tabela e model) de pessoas, objetos de manutenção e/ou produtos e serviços; <br/>

Adicionado "Route::pattern('id', '[0-9]+')" no método "boot()" do arquivo "App\Providers\RouteServiceProvider.php" para certificar que todo id passado serão números inteiros; <br/>

# PACOTES EXTRAS ADICIONADOS
Adicionado o pacote de pdf "dompdf" (https://github.com/barryvdh/laravel-dompdf) e implementado na classe AbstractRepository (para que fique centralizado e possa ser utilizado por qualquer Repository que precisar) através da classe <strong>Pdf</strong> dentro das pastas de serviços <strong>(App\Services\...)</strong>; <br/>

Adicionado o pacote de código de barras "milon/barcode" (https://github.com/milon/barcode). Porém, ainda não implementado na classe AbstractRepository (para que fique centralizado e possa ser utilizado por qualquer Repository que precisar) como acontece com os outros pacotes.
Observação: O Adianti Framework usa o "picqer". Só para ter noção de outro pacote.


Adicionado o pacote de impressão térmica "mike42/escpos" (https://github.com/mike42/escpos-php). Porém, ainda não implementado na classe AbstractRepository (para que fique centralizado e possa ser utilizado por qualquer Repository que precisar) como acontece com os outros pacotes.

Adicionado o pacote de email do próprio Laravel através do comando php artisan:mail "nome_da_classe" e implementado na classe AbstractRepository (para que fique centralizado e possa ser utilizado por qualquer Repository que precisar) através da classe <strong>Mail</strong> dentro das pastas de serviços <strong>(App\Services\...)</strong>; <br/>

### PRECISA MELHORAR AQUI AINDA
# INTEGRAÇÕES
Integrado o AdminLte 3.7: https://github.com/jeroennoten/Laravel-AdminLTE - ao projeto. Mas será possível configurar se o retorno dos dados (data) será para um <strong>Frontend</strong> via <strong>blade</strong> ou só <strong>JSON</strong> para os casos de ser uma pasta separada com tecnologia vue, angular etc. Essa configuração está no arquivo .env e .env.example. A configuração será utilizada para verificação e controle nos repositories, portanto como informado anteriormente as <strong>classes Controllers</strong> apenas retornarão o que vier de lá e dessa forma tanto faz a forma que usa <strong>Frontend</strong> na aplicação; <br/>