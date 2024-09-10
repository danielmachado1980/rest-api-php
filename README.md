# NEXT BP | Case - Desenvolvedor Case: Desenvolvimento de um Sistema de Autenticação e CRUD de Usuários

API RESTful em PHP

## Pré-requisitos

Antes de começar, você vai precisar ter as seguintes ferramentas instaladas em sua máquina:

- [Git](https://git-scm.com)
- [PHP](https://www.php.net/) >= 7.4
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) ou outro banco de dados compatível

Além disso, é recomendável usar o [XAMPP](https://www.apachefriends.org/index.html) ou [Laragon](https://laragon.org/) para um ambiente local de desenvolvimento com o PHP.

## Como clonar o repositório

Abra o terminal e execute o seguinte comando para clonar o repositório:

```bash
git clone https://github.com/danielmachado1980/rest-api-php

```bash
cd rest-api-php

```bash
composer install

### Configuração do Ambiente

```bash
cp .env.example .env

```bash
php artisan key:generate

Configure as variáveis de ambiente no arquivo .env, principalmente as configurações de banco de dados:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=next
DB_USERNAME={seu_usuario}
DB_PASSWORD={sua_senha}

```bash
php artisan jwt:secret

```bash
php artisan migrate

## Executando o Servidor

```bash
php artisan serve

Acesse em http://localhost:8000/api/documentation



