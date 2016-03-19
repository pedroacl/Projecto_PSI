CREATE TABLE Habilitacoes_Academicas (
   id                  INT NOT NULL AUTO_INCREMENT,
   tipo                VARCHAR(50) NOT NULL,
   data_conclusao      DATE DEFAULT NULL,
   curso               VARCHAR(50) DEFAULT NULL,
   instituto_ensino    VARCHAR(50) DEFAULT NULL,
   PRIMARY KEY (id)
);