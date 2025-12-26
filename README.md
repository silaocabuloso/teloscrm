# TelosCRM - Teste Técnico

Este projeto é um mini sistema ERP para gestão de pedidos de fornecedores, desenvolvido como teste técnico.

## Tecnologias utilizadas

- Laravel 12
- PHP 8
- Docker (Laravel Sail)
- MySQL
- Redis
- Vue 3
- Inertia.js
- Vite
- Mailpit

## Requisitos para rodar o projeto

- Docker Desktop
- WSL2 (para Windows)
- Git

## Passo a passo para executar o projeto

Clone o repositório:

```bash
git clone https://github.com/silaocabuloso/teloscrm.git
cd teloscrm

Suba os containers:

./vendor/bin/sail up -d

Instale as dependências do frontend:

./vendor/bin/sail npm install
./vendor/bin/sail npm run dev

Execute as migrations:

./vendor/bin/sail artisan migrate

Acesse no navegador:

http://localhost

Observações importantes

O frontend utiliza Vite, portanto o comando npm run dev deve permanecer em execução durante o desenvolvimento.

O envio de e-mails é testado utilizando o Mailpit, acessível após subir os containers.

