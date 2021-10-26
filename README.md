# projeto-modelo
Este projeto servirá para o desenvolvimento de qualquer outro sistema. <br/>
Versão do Laravel: 8.6.2; <br/>
Integrado com AdminLte 3.7: https://github.com/jeroennoten/Laravel-AdminLTE. Mas será possível configurar se o sistema irá utilizar o frontend via blade ou não (podendo ser em uma pasta separada com tecnologia vue, angular etc. Essa configuração está no arquivo .env e .env.example. A configuração será utilizada para verificação e controle nos repositories, portanto o controle apenas retornará o que vier de lá e dessa forma tanto faz a forma que usa frontend na sua aplicação; <br/>
Mudado a autenticação do Laravel para a model/tabela Pessoa e, com isso, centralizar todos os cadastros definindo se empresa do grupo e/ou cliente e/ou fornecedor e/ou colocaborador e/ou outros com possbilidade de acesso ou não ao sistema (pasta docs tem o passo a passo de como realizar a mudança); <br/>
Traduzido a aplicação do laravel colocando manualmente uma pasta pt-BR dentro de resources/lang; <br/>
Configurado para utilizar o controle de permissões pelo Spatie: https://spatie.be/docs/laravel-permission/v5/introduction; <br/>
Criado uma seeder para inserir algumas permissões para ficar de modelo e exemplo;
Criado uma seeder para inserir dois usuários para que seja testado as permissões: usuario: admin123, senha: admin123, email: admin@sistema.com | usuário: usuario123, senha: usuario123, usuario@sistema.com; <br/>
Criado uma seeder para inserir categorias (que serão centralizadas numa única tabela e model) de pessoas, objetos de assistência e/ou produtos e serviços; <br/>
Adicionado "Route::pattern('id', '[0-9]+')" no método "boot()" do arquivo "App\Providers\RouteServiceProvider.php" para certificar que todo id passado serão números inteiros; <br/>
Adicionado no método "boot()" a configuração de rota do arquivo "tenant";
