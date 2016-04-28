CREATE TABLE Utilizadores (
	id 				NUMBER(4),
	email				VARCHAR2(20) 	CONSTRAINT nn_email 			     NOT NULL,
	password 		VARCHAR2(20) 	CONSTRAINT nn_password 		     NOT NULL,
	nome 				VARCHAR2(50) 	CONSTRAINT nn_nome 			     NOT NULL,
	telefone 		VARCHAR2(20) 	CONSTRAINT nn_telefone 		     NOT NULL,
   telefone       VARCHAR2(20)   CONSTRAINT nn_tipo_utilizador   NOT NULL,
	created_at 		DATE 				CONSTRAINT nn_created_at 	     NOT NULL,
	updated_at 		DATE 				CONSTRAINT nn_updated_at 	     NOT NULL,
	foto 				VARCHAR2(20),
	recovery_token VARCHAR2(20),

	CONSTRAINT pk_utilizador PRIMARY KEY (id),
   CONSTRAINT uc_email UNIQUE (email),
   CONSTRAINT uc_nome  UNIQUE (nome)
);


CREATE TABLE Voluntarios (
   id                          NUMBER(4),
   id_area_geografica          NUMBER(4)        CONSTRAINT nn_id_area_geografica       NOT NULL,
   id_habilitacoes_academicas  NUMBER(4)        CONSTRAINT nn_id_habilitacao_academica NOT NULL,
   id_utilizador               NUMBER(4)        CONSTRAINT nn_id_utilizador            NOT NULL,
   foto                        VARCHAR2(100),
   genero                      CHAR(1)          CONSTRAINT nn_genero                   NOT NULL,
   data_nascimento             DATE             CONSTRAINT nn_data_nascimento          NOT NULL,

   CONSTRAINT pk_voluntario PRIMARY KEY (id),
   CONSTRAINT fk_utilizador               FOREIGN KEY (id_utilizador)               REFERENCES Utilizadores(id),
   CONSTRAINT fk_area_geografica          FOREIGN KEY (id_area_geografica)          REFERENCES Areas_Geograficas(id),
   CONSTRAINT fk_habilitacoes_academicas  FOREIGN KEY (id_habilitacoes_academicas)  REFERENCES Habilitacoes_Academicas(id),
);


CREATE TABLE Utilizadores_Grupos_Atuacao (
   id_utilizador        NUMBER(4),
   id_grupo_atuacao     NUMBER(4),

	CONSTRAINT pk_utilizador_grupo_atuacao PRIMARY KEY (id_utilizador, id_grupo_atuacao)
);


CREATE TABLE Utilizadores_Areas_Interesse (
   id_utilizador        NUMBER(4),
   id_area_interesse    NUMBER(4),

   CONSTRAINT pk_utilizador_area_interesse PRIMARY KEY (id_utilizador, id_area_interesse)
);


CREATE TABLE Areas_Geograficas (
   id                   NUMBER(4),
   freguesia            VARCHAR2(50) CONSTRAINT nn_freguesia NOT NULL,
   concelho             VARCHAR2(50) CONSTRAINT nn_concelho  NOT NULL,
   distrito             VARCHAR2(50) CONSTRAINT nn_distrito  NOT NULL,

   CONSTRAINT pk_area_geografica PRIMARY KEY (id)
);


CREATE TABLE Instituicoes (
   id                   NUMBER(4),
   id_area_geografica   NUMBER(4)      CONSTRAINT nn_area_geografica    NOT NULL,
   id_utilizador        NUMBER(4)      CONSTRAINT nn_id_utilizador      NOT NULL,
   descricao            VARCHAR2(100)  CONSTRAINT nn_descricao          NOT NULL,
   morada               VARCHAR2(100)  CONSTRAINT nn_morada             NOT NULL,
   email_instituicao    VARCHAR2(20)   CONSTRAINT nn_email_instituicao  NOT NULL,
   website              VARCHAR2(20),

   CONSTRAINT pk_instituicao     PRIMARY KEY (id),
   CONSTRAINT fk_area_geografica FOREIGN KEY (id_area_geografica) REFERENCES Areas_Geograficas(id),
   CONSTRAINT fk_utilizador      FOREIGN KEY (id_utilizador)      REFERENCES Utilizadores(id),
);


CREATE TABLE Areas_Interesse (
   id                 NUMBER(4),
   nome               VARCHAR2(50),

   CONSTRAINT pk_area_interesse PRIMARY KEY (id),
   CONSTRAINT uc_nome UNIQUE (nome),
);


CREATE TABLE Disponibilidades (
   id                   NUMBER(4),
   data_inicio          DATE  CONSTRAINT nn_data_inicio  NOT NULL,
   data_fim             DATE  CONSTRAINT nn_data_fim     NOT NULL,

   CONSTRAINT pk_disponibilidade PRIMARY KEY (id),
);


CREATE TABLE Periodicidades (
   id                   NUMBER(4),
   id_disponibilidade   NUMBER(4) CONSTRAINT nn_is_disponibilidade NOT NULL,
   tipo                 BIT(1)    CONSTRAINT nn_tipo               NOT NULL,
   data_fim             DATETIME  CONSTRAINT nn_data_fim           NOT NULL,

   CONSTRAINT pk_disponibilidade PRIMARY KEY (id),

   CONSTRAINT fk_disponibilidade FOREIGN KEY (id_disponibilidade)
      REFERENCES Disponibilidades(id) ON DELETE CASCADE,
);


CREATE TABLE Grupos_Atuacao (
   id                NUMBER(4),
   nome              VARCHAR(100),
   descricao         TEXT,

   CONSTRAINT pk_grupo_atuacao PRIMARY KEY (id),
   CONSTRAINT uc_nome UNIQUE (nome)
);


CREATE TABLE Habilitacoes_Academicas (
   id                   NUMBER(4),
   id_tipo              VARCHAR2(50)   NOT NULL,
   data_conclusao       DATE           NOT NULL,
   curso                VARCHAR2(50)   NOT NULL,
   instituto_ensino     VARCHAR2(50)   NOT NULL,

   PRIMARY KEY (id)
   CONSTRAINT fk_id_tipo FOREIGN KEY (id_tipo) REFERENCES Tipos_Habilitacoes_Academicas(id)
      ON DELETE CASCADE
);


CREATE TABLE Tipos_Habilitacoes_Academicas (
   id          NUMBER(4),
   nome        VARCHAR2(50)   CONSTRAINT nn_nome NOT NULL,
   descricao   VARCHAR2(200),

   CONSTRAINT pk_tipo_habilitacao_academica PRIMARY KEY (id),
);


CREATE TABLE IF NOT EXISTS Oportunidades_Voluntariado (
   id                  INT             AUTO_INCREMENT,
   id_area_interesse   INT             NOT NULL,
   id_grupo_atuacao    INT             NOT NULL,
   id_disponibilidade  INT             NOT NULL,
   id_area_geografica  INT             NOT NULL,
   id_instituicao      INT             NOT NULL,
   nome                VARCHAR(150)    NOT NULL,
   funcao              VARCHAR(50)     NOT NULL,
   pais                VARCHAR(50)     NOT NULL,
   vagas               INT             DEFAULT 1,
   ativa               BIT(1)          DEFAULT 0,
   PRIMARY KEY (id),
   FOREIGN KEY (id_area_interesse)  REFERENCES Areas_Interesse(id),
   FOREIGN KEY (id_grupo_atuacao)   REFERENCES Grupos_Atuacao(id),
   FOREIGN KEY (id_disponibilidade) REFERENCES Disponibilidades(id),
   FOREIGN KEY (id_area_geografica) REFERENCES Areas_Geograficas(id),
   FOREIGN KEY (id_instituicao)     REFERENCES Instituicoes(id)
);