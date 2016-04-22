CREATE DATABASE IF NOT EXISTS PSI;

USE PSI;

CREATE TABLE Utilizadores (
   id                  	INT 			   AUTO_INCREMENT,
   salt                 INT            NOT NULL,
   email               	VARCHAR(100) 	NOT NULL,
   password            	VARCHAR(100) 	NOT NULL,
   foto					   VARCHAR(100)	DEFAULT NULL,
   recovery_token      	VARCHAR(50) 	DEFAULT NULL,
   created_at          	TIMESTAMP 		NOT NULL,
   updated_at          	TIMESTAMP 		NOT NULL,
   PRIMARY KEY (id)
);

ALTER TABLE Utilizadores
ADD CONSTRAINT unique_email_utilizador UNIQUE (email);


CREATE TABLE Areas_Geograficas (
   id                  	INT 			AUTO_INCREMENT,
   freguesia           	VARCHAR(50) NOT NULL,
   concelho            	VARCHAR(50) NOT NULL,
   distrito            	VARCHAR(50) NOT NULL,
   PRIMARY KEY (id)
);


CREATE TABLE Instituicoes (
   id                   INT 			 AUTO_INCREMENT,
   id_area_geografica   INT			 NOT NULL,
   id_utilizador        INT          NOT NULL,
   nome                 VARCHAR(50)  NOT NULL,
   descricao            VARCHAR(50)  NOT NULL,
   telefone             VARCHAR(20)  NOT NULL,
   morada               VARCHAR(50)  NOT NULL,
   website              VARCHAR(20)  DEFAULT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (id_area_geografica) REFERENCES Areas_Geograficas(id),
   FOREIGN KEY (id_utilizador) REFERENCES Utilizadores(id)
);

ALTER TABLE Instituicoes
ADD CONSTRAINT unique_nome_instituicao UNIQUE (nome);


CREATE TABLE Areas_Interesse (
   id					    INT AUTO_INCREMENT,
   nome					 VARCHAR(20),
   PRIMARY KEY (id)
);

ALTER TABLE Areas_Interesse
ADD CONSTRAINT unique_nome_area_interesse UNIQUE (nome);


CREATE TABLE Disponibilidades (
   id                  	INT 	NOT NULL AUTO_INCREMENT,
   data_inicio         	DATE 	NOT NULL,
   data_fim           	DATE 	NOT NULL,
   PRIMARY KEY (id)
);


CREATE TABLE Periodicidades (
   id                  	INT 		AUTO_INCREMENT,
   id_disponibilidade  	INT 		NOT NULL,
   tipo                	BIT(1) 	NOT NULL,
   data_fim            	DATETIME	NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (id_disponibilidade) REFERENCES Disponibilidades(id) ON DELETE CASCADE
);


CREATE TABLE Grupos_Atuacao (
   id              	INT AUTO_INCREMENT,
   nome            	VARCHAR(50),
   descricao			TEXT,
   PRIMARY KEY (id)
);

ALTER TABLE Grupos_Atuacao
ADD CONSTRAINT unique_nome_grupo_atuacao UNIQUE (nome);


CREATE TABLE Habilitacoes_Academicas (
   id                  	INT 			AUTO_INCREMENT,
   tipo                	VARCHAR(50) NOT NULL,
   data_conclusao      	DATE			DEFAULT NULL,
   curso               	VARCHAR(50) DEFAULT NULL,
   instituto_ensino    	VARCHAR(50) DEFAULT NULL,
   PRIMARY KEY (id)
);


CREATE TABLE Voluntarios (
	id                          INT 			   AUTO_INCREMENT,
	id_area_geografica          INT 			   NOT NULL,
	id_habilitacoes_academicas  INT 			   NOT NULL,
   id_utilizador               INT           NOT NULL,
	nome                        VARCHAR(100) 	DEFAULT NULL,
	genero                      CHAR(1)			DEFAULT NULL,
	data_nascimento             DATE 			DEFAULT NULL,
	telefone                    VARCHAR(20) 	NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (id_area_geografica) 			REFERENCES Areas_Geograficas(id),
	FOREIGN KEY (id_habilitacoes_academicas) 	REFERENCES Habilitacoes_Academicas(id),
   FOREIGN KEY (id_utilizador)               REFERENCES Utilizadores(id)
);

ALTER TABLE Voluntarios
ADD CONSTRAINT unique_nome_voluntario UNIQUE (nome);


CREATE TABLE Oportunidades_Voluntariado (
   id                  INT 				AUTO_INCREMENT,
   id_area_interesse   INT 				NOT NULL,
   id_grupo_atuacao    INT 				NOT NULL,
   id_disponibilidade  INT 				NOT NULL,
   id_area_geografica  INT 				NOT NULL,
   id_instituicao      INT 				NOT NULL,
   nome                VARCHAR(150) 	NOT NULL,
   funcao              VARCHAR(50) 		NOT NULL,
   pais                VARCHAR(50) 		NOT NULL,
   vagas               INT 				DEFAULT 1,
   ativa               BIT(1) 			DEFAULT 0,
   PRIMARY KEY (id),
   FOREIGN KEY (id_area_interesse) 	REFERENCES Areas_Interesse(id),
   FOREIGN KEY (id_grupo_atuacao) 	REFERENCES Grupos_Atuacao(id),
   FOREIGN KEY (id_disponibilidade) REFERENCES Disponibilidades(id),
   FOREIGN KEY (id_area_geografica) REFERENCES Areas_Geograficas(id),
   FOREIGN KEY (id_instituicao) 		REFERENCES Instituicoes(id)
);

ALTER TABLE Oportunidades_Voluntariado
ADD CONSTRAINT unique_nome_oportunidade UNIQUE (nome);


CREATE TABLE Inscreve_Se (
   id_voluntario                   	INT 		NOT NULL AUTO_INCREMENT,
   id_oportunidade_voluntariado    	INT 		NOT NULL,
   data_inscricao                  	DATETIME NOT NULL,
   aceite							      BIT(1)  	DEFAULT 0,
   PRIMARY KEY (id_voluntario, id_oportunidade_voluntariado),
   FOREIGN KEY (id_voluntario) 				REFERENCES Voluntarios(id) ON DELETE CASCADE,
   FOREIGN KEY (id_oportunidade_voluntariado) 	REFERENCES Oportunidades_Voluntariado(id) ON DELETE CASCADE
);
