# TelosCRM

## Visão geral

O TelosCRM é um **mini ERP de pedidos para fornecedores**, desenvolvido como parte de um **teste técnico para a vaga de Programador Full Stack**.

A ideia do projeto é cobrir um fluxo completo, semelhante ao que se encontra em sistemas reais de ERP, incluindo controle de usuários, fornecedores, produtos, pedidos, API, processamento em background e um dashboard de acompanhamento.

O sistema possui:

* Autenticação de usuários
* Controle de permissões (Administrador e Vendedor)
* Cadastro de fornecedores
* Cadastro de produtos (manual e via CSV)
* Cadastro e listagem de pedidos
* API autenticada para pedidos
* Processamento assíncrono com Jobs
* Envio de e-mails
* Relatórios automáticos via agendamento (Cron)
* Dashboard com indicadores e gráfico

---

## Tecnologias utilizadas

* Laravel 12
* Vue 3 + Inertia
* Docker (Laravel Sail)
* MySQL
* Redis
* Chart.js
* Mailpit

---

## Requisitos para rodar o projeto

Antes de iniciar, é necessário ter instalado:

* Docker Desktop
* Git
* Node.js (versão 18 ou superior)
* WSL 2 (caso esteja no Windows)

Não é necessário ter PHP ou MySQL instalados localmente, todo o ambiente roda dentro do Docker.

---

## Como rodar o projeto localmente

### 1. Clonar o repositório


git clone https://github.com/silaocabuloso/teloscrm.git
cd teloscrm


---

### 2. Criar o arquivo de ambiente


cp .env.example .env


O `.env` já está configurado para funcionar com o Laravel Sail.

---

### 3. Subir os containers com Docker


./vendor/bin/sail up -d


Isso irá subir os containers de:

* PHP
* MySQL
* Redis
* Mailpit

Para conferir se está tudo rodando:


./vendor/bin/sail ps


---

### 4. Instalar dependências do backend


./vendor/bin/sail composer install


---

### 5. Gerar a chave da aplicação


./vendor/bin/sail artisan key:generate


---

### 6. Criar as tabelas e usuários iniciais


./vendor/bin/sail artisan migrate --seed


Esse comando:

* Cria todas as tabelas do banco
* Cria o usuário administrador
* Cria um usuário vendedor padrão

---

## Usuários do sistema

### Usuário administrador

Criado automaticamente pelo seeder:

* **Email:** [admin@teloscrm.com](mailto:admin@teloscrm.com)
* **Senha:** password
* **Perfil:** Administrador

O administrador tem acesso completo ao sistema.

---

### Usuário vendedor (via seeder)

Este sistema foi pensado como um **ERP interno**, portanto **não existe cadastro público de usuários**.

Os vendedores são criados via **seeder**, simulando um cadastro feito por um administrador.

Caso queira recriar o vendedor:


./vendor/bin/sail artisan make:seeder VendedorUserSeeder


Arquivo:


database/seeders/VendedorUserSeeder.php


Conteúdo:


User::firstOrCreate(
    ['email' => 'vendedor@teloscrm.com'],
    [
        'name' => 'Vendedor Teste',
        'password' => Hash::make('password'),
        'tipo' => 'vendedor',
        'status' => true,
    ]
);


Registrar no `DatabaseSeeder.php`:


$this->call(VendedorUserSeeder::class);


Executar:


./vendor/bin/sail artisan db:seed


Credenciais do vendedor:

* **Email:** [vendedor@teloscrm.com](mailto:vendedor@teloscrm.com)
* **Senha:** password
* **Perfil:** Vendedor

O vendedor só consegue acessar dados após estar vinculado a um fornecedor.

---

## Vínculo vendedor × fornecedor

Essa funcionalidade é exclusiva para administradores.

URL:


/vinculos


Passos:

1. Logar como administrador
2. Selecionar o vendedor
3. Selecionar o fornecedor
4. Clicar em “Vincular”

Esse vínculo define quais fornecedores, produtos, pedidos e dados de API o vendedor pode acessar.

---

## Funcionalidades principais

### Dashboard

Após o login, o sistema apresenta um dashboard com:

* Total de pedidos
* Valor total dos pedidos
* Pedidos agrupados por status
* Gráfico com Chart.js
* Menu de navegação rápida

### Fornecedores

* Cadastro
* Edição
* Ativação e inativação

### Produtos

* Cadastro manual
* Listagem
* Upload de produtos via CSV

### Pedidos

* Criação de pedidos
* Listagem
* Cálculo automático do valor total

---

## Upload de produtos via CSV

Formato esperado do arquivo:

csv
fornecedor_id,nome,cor,preco
3,Produto A,Azul,10.50
4,Produto B,Vermelho,20.00


Tela disponível em:


/produtos/upload


O processamento do arquivo ocorre via **Job em background**.

---

## Filas (Jobs)

Para processar jobs (upload CSV, e-mails, relatórios), é necessário rodar:


./vendor/bin/sail artisan queue:work


---

## Visualização de e-mails

Os e-mails enviados pelo sistema podem ser visualizados no Mailpit:


http://localhost:8025


---

## Relatório diário (Cron)

Existe um job agendado para gerar relatórios automáticos.

Para executar manualmente (simulação):


./vendor/bin/sail artisan schedule:run


---

## API de pedidos

### Autenticação


curl -X POST http://localhost/api/v1/autenticacao \
-H "Content-Type: application/json" \
-d '{"email":"admin@teloscrm.com","password":"password"}'


A resposta retorna um token de autenticação.

### Header obrigatório


Authorization: Bearer SEU_TOKEN_AQUI
Content-Type: application/json


### Endpoints disponíveis

* GET `/api/v1/fornecedor/{cnpj}/pedidos`
* GET `/api/v1/pedidos/{id}`
* POST `/api/v1/pedidos`
* PUT `/api/v1/pedidos/{id}`
* DELETE `/api/v1/pedidos/{id}`

Todas as rotas da API exigem autenticação via token.

---

## Cache (Redis)

Para limpar o cache manualmente:


./vendor/bin/sail artisan cache:clear


---

## Comandos úteis


./vendor/bin/sail down
./vendor/bin/sail artisan optimize:clear
./vendor/bin/sail artisan route:list


---

## Status do projeto

* Todas as etapas do teste foram implementadas
* O sistema está funcional
* Código organizado e comentado
* Pronto para avaliação

---

## Autor

**Silas Henrique de Oliveira**
Teste Técnico — Programador Full Stack
