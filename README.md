# Teste para Desenvolvedores no Grupo Ergon

O teste foi desenvolvido com PHP e Laravel v10. Na parte referente aos botões de seguir e votar, utilizei componentes Livewire com Alpine.js. Banco em sqlite para testes. Na parte de autenticação fui ligeiramente rápido. Não alterei nenhuma view. Está sendo utilizado Jetstream Fortify + Tall Stack. 

# Como testar a aplicação

## Pré-requisitos

São necessários as seguintes tecnologias intaladas na máquina local para testar a aplicação:

Tecnologia    | Versão
------------- | -------------
PHP           | ^8.1
Composer      |  ^2.5
Node.js       |  ^18.15

## Passo a passo

* Clone o repositório `git clone https://github.com/lobofoltran/teste-grupo-ergon-laravel.git`
* Dentro do diretório, utilize o comando  `composer install`
* Renomeie o arquivo `.env.example` para `.env` 
* Utilize os comandos `npm install` e `npm run dev`
* Para criar o banco de dados em sqlite, utilize `php artisan migrate --seed` e digite `yes`
* Crie uma chave para o projeto, utilize `php artisan key:generate`
* E por fim, utilize `php artisan serve --port=8000`
* O servidor local ficará disponível em `http://localhost:8000`

## Autenticação

Foram criados dois usuários para testes através das seeds, caso queiram utilizá-los para testes:

* Usuário `test@test.com` - senha `1234`
* Usuário `test2@test.com` - senha `1234`

## Testes Unitários (TDD)

Foram preparados uma cadeia de testes para testar e garantir que a aplicação após futuras releases continuem funcionando como era antes. Para testar a aplicação, execute o passo a passo:

* Execute o comando `php artisan migrate --seed --env=testing` e digite `yes`
* E por fim, utilize `php artisan test --env=testing`
* Pronto! O retorno esperado é que todos os testes estejam assertivos.
