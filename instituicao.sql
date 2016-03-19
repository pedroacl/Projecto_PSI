CREATE TABLE Instituicao (
    id                  INT NOT NULL AUTO_INCREMENT,
    id_area_geografica  INTEGER NOT NULL,
    nome                VARCHAR2(20) NOT NULL,
    descricao           VARCHAR2(20) NOT NULL,
    telefone            VARCHAR2(20) NOT NULL,
    morada              VARCHAR2(20) NOT NULL,
    website             VARCHAR2(20) DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_area_geografica) REFERENCES Area_Geografica
);

CREATE TABLE Habilitacoes_Academicas (
    id                  INTEGER,
    tipo                VARCHAR2(20),
    data_conclusao      DATE,
    curso               VARCHAR(20),
    instituto_ensino    VARCHAR(20),
    PRIMARY KEY (id)
);

CREATE TABLE Area_Geografica (
    id                  INTEGER,
    concelho            VARCHAR2(20),
    distrito            VARCHAR2(20),
    freguesia           VARCHAR2(20),
    PRIMARY KEY (id)
);

CREATE TABLE Oportunidade_Voluntariado (
    id                  INTEGER,
    id_area_interesse   INTEGER,
    id_grupo_atuacao    INTEGER,
    id_disponibilidade  INTEGER,
    id_area_geografica  INTEGER,
    id_instituicao      INTEGER,
    ativa               INTEGER,
    nome                VARCHAR2(20),
    vagas               INTEGER,
    funcao              VARCHAR2(20),
    pais                VARCHAR2(20),
    PRIMARY KEY (id)
    FOREIGN KEY (id_area_interesse) REFERENCES Area_Interesse,
    FOREIGN KEY (id_grupo_atuacao) REFERENCES Grupo_Atuacao,
    FOREIGN KEY (id_disponibilidade) REFERENCES Disponibilidade,
    FOREIGN KEY (id_area_geografica) REFERENCES Area_Geografica,
    FOREIGN KEY (id_instituicao) REFERENCES Instituicao
);

CREATE TABLE Inscreve_Se (
    id_voluntario                   INTEGER,
    id_oportunidade_voluntariado    INTEGER,
    data_inscricao                  DATE,
    PRIMARY KEY (id_voluntario, id_oportunidade_voluntariado),
    FOREIGN KEY (id_voluntario) REFERENCES Voluntario ON DELETE CASCADE,
    FOREIGN KEY (id_oportunidade_voluntariado) REFERENCES Oportunidade_Voluntariado ON DELETE CASCADE
);

CREATE TABLE Area_Interesse (
    id              INTEGER,
    nome            VARCHAR2(20),
    PRIMARY KEY (id)
);

CREATE TABLE Grupo_Atuacao (
    id              INTEGER,
    nome            VARCHAR2(20),
    PRIMARY KEY (id)
);

CREATE TABLE Disponibilidade (
    id                  INTEGER,
    data_inicio         DATE,
    data_fim            DATE,
    PRIMARY KEY (id)
);

CREATE TABLE Periodicidade (
    id                  INTEGER,
    id_disponibilidade  INTEGER,
    tipo                VARCHAR2,
    data_fim            DATE,
    PRIMARY KEY (id),
    FOREIGN KEY (id_disponibilidade) REFERENCES Disponibilidade ON DELETE CASCADE
);