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

* Clone o repositório `https://github.com/lobofoltran/teste-grupo-ergon-laravel.git`
* Dentro do diretório, duplique o arquivo `.env.example` e renomeie-o para `.env` 
* Na pasta base, utilize os comandos `composer install`, `npm install` e `npm run dev`
* E por fim, utilize `php artisan serve --port=8000`
* O servidor local ficará disponível em `http://localhost:8000`

## Autenticação

Foi criado dois usuários para teste através das seeds, caso queiram utilizá-los para testes rápidos:

* Usuário `test@test.com` - senha `1234`
* Usuário `test2@test.com` - senha `1234`

Fique a vontade caso queira rodar o comando `php artisan migrate:refresh --seed`

# Testes Unitários (TDD)

