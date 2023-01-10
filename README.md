# PROJETO CRUD
Este projeto é só para demonstrar um simples crud feito no Laravel. Porém, com alguns detalhes a mais adicionados ao projeto para servir de conhecimento! <br/>

### A QUEM POSSA INTERESSAR

Para utilizá-lo (após clonar) será necessário ter o Composer e Node instalado no seu computador e seguir os passos abaixo:
- Habilitar no PHP.INI a extensão gd;
- Dentro da pasta do projeto pelo prompt de comando (CMD), instalar os pacotes do PHP com o comando: "composer install";
- Renomear o arquivo ".env.example" para ".env";
- Dentro da pasta do projeto pelo prompt de comando (CMD), gerar chave do Laravel com o comando: "php artisan key:generate";
- Dentro da pasta do projeto pelo prompt de comando (CMD), instalar os pacotes do NODE com os comandos: "npm install && npm run dev";
- Dentro da pasta do projeto pelo prompt de comando (CMD), iniciar o servidor com o comando: "php artisan serve". Caso deseje evitar está iniciando o servidor sempre pelo Laravel, realize uma configuração de servidor no próprio do xampp, wampp, lampp, etc;
- Abrir o navegador de sua preferência, digitar o endereco: localhost:8000 ou 127.0.0.1:8000, e logar na aplicação com os dados => usuario: admin | Senha: admin ou usuario: usuario | Senha: usuario (esse não tem permissão);

### ALGUMAS INFORMAÇÕES DO PROJETO

- Laravel versão 8;
- Node versão 14.17.5;
- Banco de dados SQLite ;

### INTEGRAÇÕES
Integrado o AdminLte 3.7: https://github.com/jeroennoten/Laravel-AdminLTE - ao projeto. Mas será possível retornar os dados (data) para um <strong>Frontend</strong> via <strong>blade</strong> ou só <strong>JSON</strong> para os casos de ser uma pasta separada com tecnologia vue, angular etc. A configuração necessária para o projeto realizar a verificação e, com isso, retornar os dados da forma desejada está no arquivo .env. Ela é utilizada e verificada nos repositories já que as <strong>classes Controllers</strong> servem apenas para retornar o que vier de lá. Assim, tanto faz a forma que usa <strong>Frontend</strong> na aplicação; <br/>

### CONFIGURAÇÕES DE AUTOMATIZAÇÃO E OUTROS DETALHES
Criado uma pasta "project" dentro de "route" para separar as rotas da aplicação dentro dela e importar no arquivo "web.php"; <br/>

Criado uma pasta "Repositories" dentro de "app" para armazenar classes que recebem como dependência no construtor um "Model" e, com isso, a responsabalidade por gerir os métodos e demais detalhes ficará sempre no "Repository" daquele Model ou no "próprio Model"; <br/>

Criado uma classe "AbstractRepository" "para ser extendida (Extends) pelas outras classes Repository" e, com isso, disponibilizar de forma padrão (a partir da variável protected $model) todos os métodos comuns (inserir, alterar, deletar os registros no banco de dados). Ela também recebe de forma simples os relacionamentos (a partir da variável protected $relationShip) dos Models para salvar, alterar etc de forma mais automatizada; <br/>

Implementado para que os "Controllers especificados nas rotas recebam apenas o Request e passe o mesmo como parâmetro nos métodos das classes Repository na qual recebe como dependência" e, com isso, os controllers apenas "retornam" o "sucesso" ou a "falha" que virá do Repository; <br/>

"Adicionado SoftDeletes" (models e migrations) do próprio Laravel ao projeto; <br/>

Ajustado a autenticação do laravel para a Tabela/Model pessoas e alterado o campo de login para nome_alternativo apenas para fins de conhecimento e teste; <br/>

Adicionado "Route::pattern('id', '[0-9]+')" no método "boot()" do arquivo "App\Providers\RouteServiceProvider.php" para certificar que todo id passado serão números inteiros; <br/>

Traduzido a aplicação do laravel colocando manualmente uma pasta pt-BR dentro de resources/lang; <br/>

- Criado uma seeder para inserir algumas permissões para ficar de modelo e exemplo; <br/>

- Criado uma seeder para inserir dois usuários para que seja testado as permissões: usuario: admin e senha: admin | usuário: usuario e senha: usuario; <br/>

- Criado uma seeder para inserir categorias (que serão centralizadas numa única tabela e model) de pessoas, objetos de manutenção e/ou produtos e serviços; <br/>

## PACOTES EXTRAS ADICIONADOS
Adicionado o pacote de permissões "Spatie" (https://spatie.be/docs/laravel-permission/v5/introduction) e configurado para utilizar o controle por ele (pasta docs tem o passo a passo de como realizar a configuração); <br/>

Adicionado o pacote de pdf "dompdf" (https://github.com/barryvdh/laravel-dompdf) e implementado na classe AbstractRepository (para que fique centralizado e possa ser utilizado por qualquer Repository que precisar) através da classe <strong>Pdf</strong> dentro das pastas de serviços <strong>(App\Services\...)</strong>; <br/>

Adicionado (mas não implementado) o pacote de email do próprio Laravel através do comando php artisan:mail "nome_da_classe" e implementado na classe AbstractRepository (para que fique centralizado e possa ser utilizado por qualquer Repository que precisar) através da classe <strong>Mail</strong> dentro das pastas de serviços <strong>(App\Services\...)</strong>; <br/>
