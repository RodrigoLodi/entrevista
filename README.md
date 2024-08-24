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

## Documentação do Projeto

### 1. Alterei o Docker Compose para Adicionar o Laravel

* Dentro do `docker-compose.yml`, foram adicionados alguns parametros para utilização do projeto, tais como:
    - Laravel (Framework PHP)
    - Adminer (Gerenciador Básico de Banco de Dados)

### 2. Criei um Novo Projeto Laravel

* Executei o comando abaixo para criar um novo projeto Laravel:

  * docker-compose run --rm composer create-project --prefer-dist laravel/laravel .

### 3. Instalação de Pacotes Adicionais no Docker

* Dentro do container Docker, executei os seguintes comandos para instalar zip, unzip, git e outras dependências necessárias:

  * apt-get update
  * apt-get install -y zip unzip git
  * docker-php-ext-install zip

### 4. Instalação do Composer

* Baixei e instalei o Composer:

  * curl -sS https://getcomposer.org/installer | php
  * mv composer.phar /usr/local/bin/composer

### 5. Instalação do Node.js e npm

* Instalei o Node.js e npm:

  * curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
  * apt-get install -y nodejs

### 6. Instalação do Laravel Breeze

* O Breeze é um kit de inicialização para autenticação em Laravel. Instalei com o Composer:

  * composer require laravel/breeze --dev
  * php artisan breeze:install

### 7. Instalação do TailwindCSS

* Instalei o TailwindCSS e suas dependências:

  * npm install -D tailwindcss postcss autoprefixer
  * npx tailwindcss init -p

### 8. Criação de Modelos (Models)

* Criei os modelos para Veiculos, Motoristas e Viagens:

  * php artisan make:model Veiculos -m
  * php artisan make:model Motoristas -m
  * php artisan make:model Viagens -m

### 9. Criação de Controladores (Controllers)

* Criei os controladores para Veiculos, Motoristas e Viagens:

  * php artisan make:controller VeiculosController --resource
  * php artisan make:controller MotoristasController --resource
  * php artisan make:controller ViagensController --resource

### 10. Criação de Migrations

* Criei as migrations para as tabelas veiculos, motoristas e viagens:

  * php artisan make:migration create_veiculos_table --create=veiculos
  * php artisan make:migration create_motoristas_table --create=motoristas
  * php artisan make:migration create_viagens_table --create=viagens

* E também adicionei colunas de motorista_id e veiculo_id à tabela viagens:

  * php artisan make:migration add_motorista_id_and_veiculo_id_to_viagens_table --table=viagens

## Configuração do Projeto
  * Este projeto foi desenvolvido utilizando Laravel, Docker, Node.js, Laravel Breeze e TailwindCSS. Este guia irá orientá-lo na configuração e execução do projeto em seu ambiente local.

### Pré-requisitos

  * Antes de iniciar, certifique-se de ter o Docker e o Docker Compose instalados em sua máquina.

### Passos de Configuração

### 1. Clonando o Repositório

  * Clone o repositório do projeto para sua máquina local:

    * git clone https://github.com/RodrigoLodi/entrevista.git

### 2. Configurando o Docker Compose

  * O projeto está configurado para rodar em um ambiente Docker. O arquivo docker-compose.yml já está preparado com as definições necessárias para o Laravel, incluindo o Adminer para gerenciamento de banco de dados.

### 3. Criando o Container do Laravel

  * Execute o comando abaixo para criar e iniciar o container do Laravel:

    * docker-compose run --rm composer create-project --prefer-dist laravel/laravel .

### 4. Instalando Dependências Adicionais

  * Dentro do container Docker, você precisará instalar algumas dependências:

    * docker-compose exec app bash
    * apt-get update
    * apt-get install -y zip unzip git
    * docker-php-ext-install zip

### 5. Instalando o Composer

  * O Composer é utilizado para gerenciar as dependências do PHP:

    * curl -sS https://getcomposer.org/installer | php
    * mv composer.phar /usr/local/bin/composer

### 6. Instalando o Node.js e npm

  * Para trabalhar com o front-end, instale o Node.js e npm:

    * curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
    * apt-get install -y nodejs

### 7. Instalando o Laravel Breeze
  
  * Laravel Breeze oferece uma estrutura simples para autenticação. Instale-o com o Composer:

    * composer require laravel/breeze --dev
    * php artisan breeze:install

### 8. Instalando o TailwindCSS

  * O TailwindCSS é utilizado para o design do front-end:

    * npm install -D tailwindcss postcss autoprefixer
    * npx tailwindcss init -p

### 9. Rodando as Migrations

  * Execute as migrations para criar as tabelas no banco de dados:

    * php artisan migrate

### 10. Executando o Projeto

  * Após completar todas as configurações, você pode iniciar o servidor do Laravel:

    * docker-compose up -d
