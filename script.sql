CREATE DATABASE PSI;

USE PSI;

CREATE TABLE Utilizadores (
   id                  	INT NOT NULL AUTO_INCREMENT,
   email               	VARCHAR(100) NOT NULL,
   password            	VARCHAR(20) NOT NULL,
   foto						VARCHAR(100),
   recovery_token      	VARCHAR(50) NOT NULL,
   created_at          	DATE NOT NULL,
   updated_at          	DATE NOT NULL,
   PRIMARY KEY (id)
);

CREATE TABLE Areas_Geograficas (
   id                  INT NOT NULL AUTO_INCREMENT,
   concelho            VARCHAR(50) NOT NULL,
   distrito            VARCHAR(50) NOT NULL,
   freguesia           VARCHAR(50) NOT NULL,
   PRIMARY KEY (id)
);

CREATE TABLE Instituicoes (
   id                  INT NOT NULL AUTO_INCREMENT,
   id_area_geografica  INT NOT NULL,
   nome                VARCHAR(50) NOT NULL,
   descricao           VARCHAR(50) NOT NULL,
   telefone            VARCHAR(20) NOT NULL,
   morada              VARCHAR(50) NOT NULL,
   website             VARCHAR(20) DEFAULT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (id_area_geografica) REFERENCES Areas_Geograficas(id)
);

CREATE TABLE Areas_Interesse (
   id			INT NOT NULL AUTO_INCREMENT,
   nome		VARCHAR(20),
   PRIMARY KEY (id)
);

CREATE TABLE Disponibilidades (
   id                  INT NOT NULL AUTO_INCREMENT,
   data_inicio         DATE NOT NULL,
   data_fim            DATE NOT NULL,
   PRIMARY KEY (id)
);

CREATE TABLE Periodicidades (
   id                  INT NOT NULL AUTO_INCREMENT,
   id_disponibilidade  INT NOT NULL,
   tipo                VARCHAR(20) NOT NULL,
   data_fim            DATE NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (id_disponibilidade) REFERENCES Disponibilidades(id) ON DELETE CASCADE
);

CREATE TABLE Grupos_Atuacao (
   id              INT NOT NULL AUTO_INCREMENT,
   nome            VARCHAR(50),
   PRIMARY KEY (id)
);

CREATE TABLE Habilitacoes_Academicas (
   id                  INT NOT NULL AUTO_INCREMENT,
   tipo                VARCHAR(50) NOT NULL,
   data_conclusao      DATE DEFAULT NULL,
   curso               VARCHAR(50) DEFAULT NULL,
   instituto_ensino    VARCHAR(50) DEFAULT NULL,
   PRIMARY KEY (id)
);

CREATE TABLE Voluntarios (
	id                          INT NOT NULL AUTO_INCREMENT,
	id_area_geografica          INT NOT NULL,
	id_habilitacoes_academicas  INT NOT NULL,
	nome                        VARCHAR(100) DEFAULT NULL,
	genero                      CHAR DEFAULT NULL,
	data_nascimento             DATE DEFAULT NULL,
	telefone                    VARCHAR(20) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (id_area_geografica) REFERENCES Areas_Geograficas(id),
	FOREIGN KEY (id_habilitacoes_academicas) REFERENCES Habilitacoes_Academicas(id)
);

CREATE TABLE Oportunidades_Voluntariado (
   id                  INT NOT NULL AUTO_INCREMENT,
   id_area_interesse   INT NOT NULL,
   id_grupo_atuacao    INT NOT NULL,
   id_disponibilidade  INT NOT NULL,
   id_area_geografica  INT NOT NULL,
   id_instituicao      INT NOT NULL,
   nome                VARCHAR(100) NOT NULL,
   funcao              VARCHAR(50) NOT NULL,
   pais                VARCHAR(50) NOT NULL,
   vagas               INT DEFAULT 1,
   ativa               BIT(1) DEFAULT 0,
   PRIMARY KEY (id),
   FOREIGN KEY (id_area_interesse) REFERENCES Areas_Interesse(id),
   FOREIGN KEY (id_grupo_atuacao) REFERENCES Grupos_Atuacao(id),
   FOREIGN KEY (id_disponibilidade) REFERENCES Disponibilidades(id),
   FOREIGN KEY (id_area_geografica) REFERENCES Areas_Geograficas(id),
   FOREIGN KEY (id_instituicao) REFERENCES Instituicoes(id)
);

CREATE TABLE Inscreve_Se (
   id_voluntario                   INT NOT NULL AUTO_INCREMENT,
   id_oportunidade_voluntariado    INT NOT NULL,
   data_inscricao                  DATE NOT NULL,
   PRIMARY KEY (id_voluntario, id_oportunidade_voluntariado),
   FOREIGN KEY (id_voluntario) REFERENCES Voluntarios(id) ON DELETE CASCADE,
   FOREIGN KEY (id_oportunidade_voluntariado) REFERENCES Oportunidades_Voluntariado(id) ON DELETE CASCADE
);
