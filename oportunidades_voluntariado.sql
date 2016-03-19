CREATE TABLE Oportunidades_Voluntariado (
    id                  INT AUTO INCREMENT,
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
    PRIMARY KEY (id)
    FOREIGN KEY (id_area_interesse) REFERENCES Area_Interesse,
    FOREIGN KEY (id_grupo_atuacao) REFERENCES Grupo_Atuacao,
    FOREIGN KEY (id_disponibilidade) REFERENCES Disponibilidade,
    FOREIGN KEY (id_area_geografica) REFERENCES Area_Geografica,
    FOREIGN KEY (id_instituicao) REFERENCES Instituicao
);