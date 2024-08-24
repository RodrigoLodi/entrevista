# Avaliação
Projeto de avaliação dos conhecimentos de desenvolvimento. 
Após finalizar, deve disponibilizar o link do repositório no github.

## Prazo
O candidato terá 3 dias corridos a partir da disponibilização deste arquivo para finalizar o projeto.

## Especificações
*Este projeto conta com o ambiente de banco dados já prepardo no docker.*
* Docker
  * Postgres 14+
* Laravel (última versão)

## Observações
Quaisquer configurações ou alterações necessárias para que o projeto seja executado,
devem ser documentadas no projeto

# Objetivo
- Criar um sistema para controle de viagens.
- O Sistema deve conter as seguintes funcionalidades:
* Veículos
  * Modelo
  * Ano
  * Data de aquisição
  * KMs rodados no momento da aquisição
  * Renavam - Deve ser único
* Motoristas
  * Nome 
  * Data de nascimento - ter no minímo, 18 anos
  * N° da CNH.
* Viagens
  * Veiculo
  * KM Inicial no início da viagem
  * KM Final na volta da viagem
  * Motoristas

# Laravel Project Setup

Este projeto foi configurado utilizando Docker e Laravel. Siga as etapas abaixo para configurar o ambiente de desenvolvimento.

## Requisitos

- Docker
- Docker Compose

## Configuração do Projeto

### 1. Alterar o Docker Compose para Adicionar o Laravel

* Certifique-se de que o arquivo `docker-compose.yml` esteja configurado para suportar o Laravel.

  * Dentro do `docker-compose.yml`, foram adicionados alguns parametros para utilização do projeto, tais como:
    - Laravel (Framework PHP)
    - Adminer (Gerenciador Básico de Banco de Dados)

### 2. Criar um Novo Projeto Laravel

* Execute o comando abaixo para criar um novo projeto Laravel:

  * docker-compose run --rm composer create-project --prefer-dist laravel/laravel .

### 3. Instalação de Pacotes Adicionais no Docker

* Dentro do container Docker, execute os seguintes comandos para instalar zip, unzip, git e outras dependências necessárias:

  * apt-get update
  * apt-get install -y zip unzip git
  * docker-php-ext-install zip

### 4. Instalação do Composer

* Baixe e instale o Composer:

  * curl -sS https://getcomposer.org/installer | php
  * mv composer.phar /usr/local/bin/composer

### 5. Instalação do Node.js e npm

* Instale o Node.js e npm:

  * curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
  * apt-get install -y nodejs

### 6. Instalação do Laravel Breeze

* O Breeze é um kit de inicialização para autenticação em Laravel. Instale com o Composer:

  * composer require laravel/breeze --dev
  * php artisan breeze:install

### 7. Instalação do TailwindCSS

* Instale o TailwindCSS e suas dependências:

  * npm install -D tailwindcss postcss autoprefixer
  * npx tailwindcss init -p

### 8. Criação de Modelos (Models)

* Crie os modelos para Veiculos, Motoristas e Viagens:

  * php artisan make:model Veiculos -m
  * php artisan make:model Motoristas -m
  * php artisan make:model Viagens -m

### 9. Criação de Controladores (Controllers)

* Crie os controladores para Veiculos, Motoristas e Viagens:

  * php artisan make:controller VeiculosController --resource
  * php artisan make:controller MotoristasController --resource
  * php artisan make:controller ViagensController --resource

### 10. Criação de Migrations

* Crie as migrations para as tabelas veiculos, motoristas e viagens:

  * php artisan make:migration create_veiculos_table --create=veiculos
  * php artisan make:migration create_motoristas_table --create=motoristas
  * php artisan make:migration create_viagens_table --create=viagens

* E também adicione colunas de motorista_id e veiculo_id à tabela viagens:

  * php artisan make:migration add_motorista_id_and_veiculo_id_to_viagens_table --table=viagens