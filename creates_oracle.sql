CREATE USER PSI IDENTIFIED BY PSI;

ALTER SESSION SET CURRENT_SCHEMA = PSI;

CREATE TABLE Utilizadores (
   id                   NUMBER(10)          ,
   email                VARCHAR2(100)  NOT NULL UNIQUE,
   password             VARCHAR2(100)  NOT NULL,
   nome                 VARCHAR2(100)   NOT NULL,
   telefone             VARCHAR2(20)    NOT NULL,
   tipo_utilizador      VARCHAR2(20)    NOT NULL,
   created_at           TIMESTAMP(0)      NOT NULL,
   updated_at           TIMESTAMP(0)      NOT NULL,
   recovery_token       VARCHAR2(50)    DEFAULT NULL,
   PRIMARY KEY (id)
);

-- Generate ID using sequence and trigger
CREATE SEQUENCE Utilizadores_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER Utilizadores_seq_tr
 BEFORE INSERT ON Utilizadores FOR EACH ROW
 WHEN (NEW.id IS NULL)
BEGIN
 SELECT Utilizadores_seq.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/


CREATE TABLE Utilizadores_Grupos_Atuacao (
   id_utilizador        NUMBER(10),
   id_grupo_atuacao     NUMBER(10),
   PRIMARY KEY (id_utilizador, id_grupo_atuacao)
);


CREATE TABLE Utilizadores_Areas_Interesse (
   id_utilizador        NUMBER(10),
   id_area_interesse    NUMBER(10),
   PRIMARY KEY (id_utilizador, id_area_interesse)
);


CREATE TABLE Areas_Geograficas (
   id                   NUMBER(10)     ,
   freguesia            VARCHAR2(50) NOT NULL,
   concelho             VARCHAR2(50) NOT NULL,
   distrito             VARCHAR2(50) NOT NULL,
   PRIMARY KEY (id)
);

-- Generate ID using sequence and trigger
CREATE SEQUENCE Areas_Geograficas_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER Areas_Geograficas_seq_tr
 BEFORE INSERT ON Areas_Geograficas FOR EACH ROW
 WHEN (NEW.id IS NULL)
BEGIN
 SELECT Areas_Geograficas_seq.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/


CREATE TABLE Areas_Interesse (
   id                 NUMBER(10),
   nome               VARCHAR2(20) UNIQUE,
   PRIMARY KEY (id)
);

-- Generate ID using sequence and trigger
CREATE SEQUENCE Areas_Interesse_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER Areas_Interesse_seq_tr
 BEFORE INSERT ON Areas_Interesse FOR EACH ROW
 WHEN (NEW.id IS NULL)
BEGIN
 SELECT Areas_Interesse_seq.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/


CREATE TABLE Disponibilidades (
   id                   NUMBER(10)  NOT NULL,
   data_inicio          DATE  NOT NULL,
   data_fim             DATE  NOT NULL,
   PRIMARY KEY (id)
);

-- Generate ID using sequence and trigger
CREATE SEQUENCE Disponibilidades_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER Disponibilidades_seq_tr
 BEFORE INSERT ON Disponibilidades FOR EACH ROW
 WHEN (NEW.id IS NULL)
BEGIN
 SELECT Disponibilidades_seq.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/


CREATE TABLE Periodicidades (
   id                   NUMBER(10)  ,
   id_disponibilidade   NUMBER(10)     NOT NULL,
   tipo                 RAW(1)   NOT NULL,
   data_fim             TIMESTAMP(0)   NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (id_disponibilidade) REFERENCES Disponibilidades(id) ON DELETE CASCADE
);

-- Generate ID using sequence and trigger
CREATE SEQUENCE Periodicidades_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER Periodicidades_seq_tr
 BEFORE INSERT ON Periodicidades FOR EACH ROW
 WHEN (NEW.id IS NULL)
BEGIN
 SELECT Periodicidades_seq.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/


CREATE TABLE Grupos_Atuacao (
   id                NUMBER(10),
   nome              VARCHAR2(50) UNIQUE,
   descricao         CLOB,
   PRIMARY KEY (id)
);

-- Generate ID using sequence and trigger
CREATE SEQUENCE Grupos_Atuacao_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER Grupos_Atuacao_seq_tr
 BEFORE INSERT ON Grupos_Atuacao FOR EACH ROW
 WHEN (NEW.id IS NULL)
BEGIN
 SELECT Grupos_Atuacao_seq.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/



CREATE TABLE Tipos_Habilitacoes_Academicas (
   id          NUMBER(10)              ,
   nome        VARCHAR2(50)       NOT NULL UNIQUE,
   descricao   VARCHAR2(200),
   PRIMARY KEY (id)
);

-- Generate ID using sequence and trigger
CREATE SEQUENCE Tipos_Habilitacoes_Academicas_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER Tipos_Habilitacoes_Academicas_seq_tr
 BEFORE INSERT ON Tipos_Habilitacoes_Academicas FOR EACH ROW
 WHEN (NEW.id IS NULL)
BEGIN
 SELECT Tipos_Habilitacoes_Academicas_seq.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/


CREATE TABLE Habilitacoes_Academicas (
   id                   NUMBER(10)     ,
   id_tipo              NUMBER(10)         NOT NULL,
   data_conclusao       DATE        NOT NULL,
   curso                VARCHAR2(50) NOT NULL,
   instituto_ensino     VARCHAR2(50) NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (id_tipo) REFERENCES Tipos_Habilitacoes_Academicas(id) ON DELETE CASCADE
);

-- Generate ID using sequence and trigger
CREATE SEQUENCE Habilitacoes_Academicas_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER Habilitacoes_Academicas_seq_tr
 BEFORE INSERT ON Habilitacoes_Academicas FOR EACH ROW
 WHEN (NEW.id IS NULL)
BEGIN
 SELECT Habilitacoes_Academicas_seq.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/




CREATE TABLE Voluntarios (
   id                          NUMBER(10)          ,
   id_area_geografica          NUMBER(10)           NOT NULL,
   id_habilitacoes_academicas  NUMBER(10)           NOT NULL,
   id_utilizador               NUMBER(10)           NOT NULL,
   genero                      CHAR          NOT NULL,
   data_nascimento             DATE          NOT NULL,
   foto                        VARCHAR2(100)  DEFAULT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (id_area_geografica)          REFERENCES Areas_Geograficas(id),
   FOREIGN KEY (id_habilitacoes_academicas)  REFERENCES Habilitacoes_Academicas(id),
   FOREIGN KEY (id_utilizador)               REFERENCES Utilizadores(id)
);

-- Generate ID using sequence and trigger
CREATE SEQUENCE Voluntarios_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER Voluntarios_seq_tr
 BEFORE INSERT ON Voluntarios FOR EACH ROW
 WHEN (NEW.id IS NULL)
BEGIN
 SELECT Voluntarios_seq.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/


CREATE TABLE Instituicoes (
   id                   NUMBER(10)         ,
   id_area_geografica   NUMBER(10)          NOT NULL,
   id_utilizador        NUMBER(10)          NOT NULL,
   descricao            VARCHAR2(50)  NOT NULL,
   morada               VARCHAR2(50)  NOT NULL,
   email_instituicao    VARCHAR2(20)  NOT NULL,
   website              VARCHAR2(20)  DEFAULT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (id_area_geografica) REFERENCES Areas_Geograficas(id),
   FOREIGN KEY (id_utilizador) REFERENCES Utilizadores(id)
);

-- Generate ID using sequence and trigger
CREATE SEQUENCE Instituicoes_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER Instituicoes_seq_tr
 BEFORE INSERT ON Instituicoes FOR EACH ROW
 WHEN (NEW.id IS NULL)
BEGIN
 SELECT Instituicoes_seq.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/


CREATE TABLE Oportunidades_Voluntariado (
   id                  NUMBER(10)         ,
   id_area_interesse   NUMBER(10)            NOT NULL,
   id_grupo_atuacao    NUMBER(10)            NOT NULL,
   id_disponibilidade  NUMBER(10)            NOT NULL,
   id_area_geografica  NUMBER(10)            NOT NULL,
   id_instituicao      NUMBER(10)            NOT NULL,
   nome                VARCHAR2(150)   NOT NULL UNIQUE,
   funcao              VARCHAR2(50)       NOT NULL,
   pais                VARCHAR2(50)       NOT NULL,
   vagas               NUMBER(10)            DEFAULT 1,
   ativa               RAW(1)          DEFAULT 0,
   PRIMARY KEY (id),
   FOREIGN KEY (id_area_interesse)  REFERENCES Areas_Interesse(id),
   FOREIGN KEY (id_grupo_atuacao)   REFERENCES Grupos_Atuacao(id),
   FOREIGN KEY (id_disponibilidade) REFERENCES Disponibilidades(id),
   FOREIGN KEY (id_area_geografica) REFERENCES Areas_Geograficas(id),
   FOREIGN KEY (id_instituicao)     REFERENCES Instituicoes(id)
);

-- Generate ID using sequence and trigger
CREATE SEQUENCE Oportunidades_Voluntariado_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER Oportunidades_Voluntariado_seq_tr
 BEFORE INSERT ON Oportunidades_Voluntariado FOR EACH ROW
 WHEN (NEW.id IS NULL)
BEGIN
 SELECT Oportunidades_Voluntariado_seq.NEXTVAL INTO :NEW.id FROM DUAL;
END;
/


CREATE TABLE Inscreve_Se (
   id_voluntario                    NUMBER(10)     NOT NULL,
   id_oportunidade_voluntariado     NUMBER(10)     NOT NULL,
   data_inscricao                   TIMESTAMP(0) NOT NULL,
   aceite                           RAW(1)   DEFAULT 0,
   PRIMARY KEY (id_voluntario, id_oportunidade_voluntariado),
   FOREIGN KEY (id_voluntario)            REFERENCES Voluntarios(id) ON DELETE CASCADE,
   FOREIGN KEY (id_oportunidade_voluntariado)   REFERENCES Oportunidades_Voluntariado(id) ON DELETE CASCADE
);

-- Generate ID using sequence and trigger
CREATE SEQUENCE Inscreve_Se_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER Inscreve_Se_seq_tr
 BEFORE INSERT ON Inscreve_Se FOR EACH ROW
 WHEN (NEW.id_voluntario IS NULL)
BEGIN
 SELECT Inscreve_Se_seq.NEXTVAL INTO :NEW.id_voluntario FROM DUAL;
END;
/

--# CODEIGNITER
CREATE TABLE ci_sessions (
   id varchar2(40) NOT NULL,
   ip_address varchar2(45) NOT NULL,
   timestamp number(10) DEFAULT 0 check (timestamp > 0) NOT NULL,
   data blob NOT NULL,
   PRIMARY KEY (id)
);

CREATE INDEX ci_sessions_timestamp ON ci_sessions (timestamp);


-- Inserts
ALTER SESSION SET CURRENT_SCHEMA = PSI;

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
