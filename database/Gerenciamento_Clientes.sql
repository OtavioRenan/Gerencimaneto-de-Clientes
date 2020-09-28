CREATE DATABASE `gerenciamento_clientes` CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `gerenciamento_clientes`;

CREATE TABLE IF NOT EXISTS `users`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
	`status` INT NOT NULL DEFAULT 1,
    `name` VARCHAR(191) NOT NULL,
    `email` VARCHAR(191) UNIQUE NOT NULL,
    `password` VARCHAR(191) NOT NULL,
    `remember_token` VARCHAR(100),
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `users_status`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(191) NOT NULL,    
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`)
);

INSERT INTO `users_status` (id, nome) VALUES
(1, 'ATIVO'),
(2, 'DELETADO');

CREATE TABLE `estados`(
`id_estado` INT NOT NULL AUTO_INCREMENT, 
`codigo_ibge` VARCHAR(4) NOT NULL,
`sigla` CHAR(2) NOT NULL,
`nome` VARCHAR(30) NOT NULL,   
`dtm_lcto` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(`id_estado`)
);

Insert Into estados (codigo_ibge,sigla,nome) Values(12,'AC','Acre');  
Insert Into estados (codigo_ibge,sigla,nome) Values(27,'AL','Alagoas');  
Insert Into estados (codigo_ibge,sigla,nome) Values(13,'AM','Amazonas');
Insert Into estados (codigo_ibge,sigla,nome) Values(16,'AP','Amapá');
Insert Into estados (codigo_ibge,sigla,nome) Values(29,'BA','Bahia');
Insert Into estados (codigo_ibge,sigla,nome) Values(23,'CE','Ceará');
Insert Into estados (codigo_ibge,sigla,nome) Values(53,'DF','Distrito Federal');
Insert Into estados (codigo_ibge,sigla,nome) Values(32,'ES','Espírito Santo');
Insert Into estados (codigo_ibge,sigla,nome) Values(52,'GO','Goiás');
Insert Into estados (codigo_ibge,sigla,nome) Values(21,'MA','Maranhão');
Insert Into estados (codigo_ibge,sigla,nome) Values(31,'MG','Minas Gerais');
Insert Into estados (codigo_ibge,sigla,nome) Values(50,'MS','Mato Grosso do Sul');
Insert Into estados (codigo_ibge,sigla,nome) Values(51,'MT','Mato Grosso');
Insert Into estados (codigo_ibge,sigla,nome) Values(15,'PA','Pará');
Insert Into estados (codigo_ibge,sigla,nome) Values(25,'PB','Paraíba');
Insert Into estados (codigo_ibge,sigla,nome) Values(26,'PE','Pernambuco');
Insert Into estados (codigo_ibge,sigla,nome) Values(22,'PI','Piauí');
Insert Into estados (codigo_ibge,sigla,nome) Values(41,'PR','Paraná');
Insert Into estados (codigo_ibge,sigla,nome) Values(33,'RJ','Rio de Janeiro');
Insert Into estados (codigo_ibge,sigla,nome) Values(24,'RN','Rio Grande do Norte');
Insert Into estados (codigo_ibge,sigla,nome) Values(11,'RO','Rondônia');
Insert Into estados (codigo_ibge,sigla,nome) Values(14,'RR','Roraima');
Insert Into estados (codigo_ibge,sigla,nome) Values(43,'RS','Rio Grande do Sul');
Insert Into estados (codigo_ibge,sigla,nome) Values(42,'SC','Santa Catarina');
Insert Into estados (codigo_ibge,sigla,nome) Values(28,'SE','Sergipe');
Insert Into estados (codigo_ibge,sigla,nome) Values(35,'SP','São Paulo');
Insert Into estados (codigo_ibge,sigla,nome) Values(17,'TO','Tocantins');

CREATE TABLE IF NOT EXISTS `clientes`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(191) NOT NULL,
    `rg` VARCHAR(191) UNIQUE,
    `cpf` VARCHAR(191) UNIQUE NOT NULL,
    `telefone` VARCHAR(191) NOT NULL,
    `uf` INT(11) NOT NULL,
    `nascimento` DATETIME NOT NULL,
    `id_user_create` INT(11) NOT NULL,
    `id_user_update` INT(11) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`id_user_create`) REFERENCES `users`(`id`),
    FOREIGN KEY(`id_user_update`) REFERENCES `users`(`id`),
    FOREIGN KEY(`uf`) REFERENCES `estados`(`id_estado`)
);