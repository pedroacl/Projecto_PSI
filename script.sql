CREATE DATABASE IF NOT EXISTS PSI;

USE PSI;


CREATE TABLE IF NOT EXISTS Areas_Geograficas (
   id                   INT         AUTO_INCREMENT,
   freguesia            VARCHAR(50) NOT NULL,
   concelho             VARCHAR(50) NOT NULL,
   distrito             VARCHAR(50) NOT NULL,
   PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS Utilizadores (
   id                  	INT 			   AUTO_INCREMENT,
   email               	VARCHAR(100) 	NOT NULL UNIQUE,
   password            	VARCHAR(100) 	NOT NULL,
   tipo_utilizador      VARCHAR(20)    NOT NULL,
   nome                 VARCHAR(100),
   telefone             VARCHAR(20),
   id_area_geografica   INT,
   created_at          	TIMESTAMP 		NOT NULL,
   updated_at          	TIMESTAMP 		NOT NULL,
   recovery_token       VARCHAR(50)    DEFAULT NULL,
   FOREIGN KEY (id_area_geografica) REFERENCES Areas_Geograficas(id),
   PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS Utilizadores_Grupos_Atuacao (
   id_utilizador        INT,
   id_grupo_atuacao     INT,
   PRIMARY KEY (id_utilizador, id_grupo_atuacao)
);


CREATE TABLE IF NOT EXISTS Utilizadores_Areas_Interesse (
   id_utilizador        INT,
   id_area_interesse    INT,
   PRIMARY KEY (id_utilizador, id_area_interesse)
);


CREATE TABLE IF NOT EXISTS Areas_Interesse (
   id					    INT AUTO_INCREMENT,
   nome					 VARCHAR(20) UNIQUE,
   PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS Disponibilidades (
   id                  	INT 	NOT NULL AUTO_INCREMENT,
   data_inicio         	DATE 	NOT NULL,
   data_fim           	DATE 	NOT NULL,
   PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS Utilizadores_Disponibilidades (
   id_utilizador           INT,
   id_disponibilidade      INT,
   PRIMARY KEY (id_utilizador, id_disponibilidade)
);


CREATE TABLE IF NOT EXISTS Periodicidades (
   id                  	INT 		      AUTO_INCREMENT,
   id_disponibilidade  	INT 		      NOT NULL,
   tipo                	VARCHAR(100) 	NOT NULL,
   data_fim            	DATETIME	      NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (id_disponibilidade) REFERENCES Disponibilidades(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS Grupos_Atuacao (
   id              	INT AUTO_INCREMENT,
   nome            	VARCHAR(50) UNIQUE,
   descricao			TEXT,

   PRIMARY KEY (id)
);



CREATE TABLE IF NOT EXISTS Tipos_Habilitacoes_Academicas (
   id          INT               AUTO_INCREMENT,
   nome        VARCHAR(50)       NOT NULL UNIQUE,
   descricao   VARCHAR(200),

   PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS Voluntarios (
   id                          INT           AUTO_INCREMENT,
   id_utilizador               INT           DEFAULT NULL,
   genero                      CHAR          DEFAULT NULL,
   data_nascimento             DATE          DEFAULT NULL,
   foto                        VARCHAR(100)  DEFAULT NULL,

   PRIMARY KEY (id),
   FOREIGN KEY (id_utilizador)               REFERENCES Utilizadores(id)
);


CREATE TABLE IF NOT EXISTS Habilitacoes_Academicas (
   id                   INT         AUTO_INCREMENT,
   id_tipo              INT         NOT NULL,
   id_voluntario        INT         NOT NULL,
   data_conclusao       DATE        NOT NULL,
   curso                VARCHAR(50) NOT NULL,
   instituto_ensino     VARCHAR(50) NOT NULL,

   PRIMARY KEY (id),
   FOREIGN KEY (id_voluntario) REFERENCES Voluntarios(id) ON DELETE CASCADE,
   FOREIGN KEY (id_tipo) REFERENCES Tipos_Habilitacoes_Academicas(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS Voluntarios_Oportunidades_Voluntariado (
   id_voluntario                 INT NOT NULL,
   id_oportunidade_voluntariado  INT NOT NULL,

   PRIMARY KEY (id_voluntario, id_oportunidade_voluntariado)
);


CREATE TABLE IF NOT EXISTS Instituicoes (
   id                   INT          AUTO_INCREMENT,
   id_utilizador        INT          NOT NULL,
   descricao            VARCHAR(500),
   morada               VARCHAR(50),
   email_instituicao    VARCHAR(20),
   website              VARCHAR(20),
   PRIMARY KEY (id),
   FOREIGN KEY (id_utilizador) REFERENCES Utilizadores(id)
);


CREATE TABLE IF NOT EXISTS Oportunidades_Voluntariado (
   id                  INT 				AUTO_INCREMENT,
   id_area_interesse   INT,
   id_grupo_atuacao    INT,
   id_area_geografica  INT,
   id_instituicao      INT 				NOT NULL,
   nome                VARCHAR(150) 	NOT NULL UNIQUE,
   funcao              VARCHAR(50) 		NOT NULL,
   pais                VARCHAR(50) 		NOT NULL,
   vagas               INT 				DEFAULT 1,
   ativa               CHAR(1) 			DEFAULT 0,
   PRIMARY KEY (id),
   FOREIGN KEY (id_area_interesse) 	REFERENCES Areas_Interesse(id),
   FOREIGN KEY (id_grupo_atuacao) 	REFERENCES Grupos_Atuacao(id),
   FOREIGN KEY (id_area_geografica) REFERENCES Areas_Geograficas(id),
   FOREIGN KEY (id_instituicao) 		REFERENCES Instituicoes(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS Inscreve_Se (
   id_voluntario                   	INT 		NOT NULL AUTO_INCREMENT,
   id_oportunidade_voluntariado    	INT 		NOT NULL,
   data_inscricao                  	DATETIME NOT NULL,
   aceite							      BIT(1)  	DEFAULT 0,
   PRIMARY KEY (id_voluntario, id_oportunidade_voluntariado),
   FOREIGN KEY (id_voluntario) 				       REFERENCES Voluntarios(id) ON DELETE CASCADE,
   FOREIGN KEY (id_oportunidade_voluntariado) 	 REFERENCES Oportunidades_Voluntariado(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS Oportunidades_Voluntariado_Disponibilidades (
   id_oportunidade_voluntariado  INT,
   id_disponibilidade            INT,
   PRIMARY KEY (id_oportunidade_voluntariado, id_disponibilidade)
);


## CODEIGNITER
CREATE TABLE IF NOT EXISTS `ci_sessions` (
   `id` varchar(40) NOT NULL,
   `ip_address` varchar(45) NOT NULL,
   `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
   `data` blob NOT NULL,
   PRIMARY KEY (id),
   KEY `ci_sessions_timestamp` (`timestamp`)
);


# Inserts
USE PSI;

INSERT INTO Areas_Geograficas (freguesia, concelho, distrito)
VALUES ('Campo Grande', 'Lisboa', 'Lisboa');

INSERT INTO Areas_Geograficas (freguesia, concelho, distrito)
VALUES ('Leiria', 'Leiria', 'Leiria');


INSERT INTO Areas_Interesse (nome)
VALUES ('Saude');

INSERT INTO Areas_Interesse (nome)
VALUES ('Educação');

INSERT INTO Areas_Interesse (nome)
VALUES ('Desporto');


INSERT INTO Grupos_Atuacao (nome, descricao)
VALUES ('Idosos', 'Grupo de pessoas idosas');

INSERT INTO Grupos_Atuacao (nome, descricao)
VALUES ('Crianças', 'Grupos de crianças');


INSERT INTO Tipos_Habilitacoes_Academicas (nome, descricao)
VALUES ('Licenciatura', 'Grau de licenciado');

INSERT INTO Tipos_Habilitacoes_Academicas (nome, descricao)
VALUES ('Mestrado', 'Grau de mestre');

INSERT INTO Tipos_Habilitacoes_Academicas (nome, descricao)
VALUES ('Doutoramento', 'Grau de doutorado');
