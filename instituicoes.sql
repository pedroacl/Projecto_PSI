CREATE TABLE Instituicoes (
    id                  INT NOT NULL AUTO_INCREMENT,
    id_area_geografica  INT NOT NULL,
    nome                VARCHAR(50) NOT NULL,
    descricao           VARCHAR(50) NOT NULL,
    telefone            VARCHAR(20) NOT NULL,
    morada              VARCHAR(50) NOT NULL,
    website             VARCHAR(20) DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_area_geografica) REFERENCES Area_Geografica
);
