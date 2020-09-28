# Gerencimaneto-de-Clientes

Informações sobre implementação de um projeto laravel:

Apos a clonagem do projeto no repositório é necessário instalar as dependecias do composer com o comando

## composer install

Depois da instalação das deprendencias do composer segue a instalação das dependências do nodejs com o comando

## npm install

Após a instalação das dependências e necessário configurar o arquivo .env onde encontra-se as configurações do banco de dados. Copie o arquivo .env.example para .env na pasta raiz. Você pode digitar copy .env.example .env se estiver usando o comando Prompt Windows ou cp .env.example .env se estiver usando o terminal linux. Abra o arquivo e configure o banco de dados. Como não houve uma exigência dei preferência ao uso do banco MySQL.

Para gerar uma nova chave, execute o comando

## php artisan key:generate

Como o não cobrou migraçoes, optei por usar um sql basico e pode ser encontrado na pasta database dentro do projeto. o Nome do arquivo é Gerenciamento_Clientes.sql

## composer o sql // NÃO ESQUEÇA DE ALTERAR O NOME DA BASE DE DADOS DO ARQUIVO .ENV

Para executar o projeto com o serve-laravel, execute o comando

## php artisan serve
