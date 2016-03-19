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