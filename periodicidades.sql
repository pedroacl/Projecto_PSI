CREATE TABLE Periodicidades (
   id                  INT NOT NULL AUTO_INCREMENT,
   id_disponibilidade  INT NOT NULL,
   tipo                VARCHAR(20) NOT NULL,
   data_fim            DATE NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (id_disponibilidade) REFERENCES Disponibilidades(id) ON DELETE CASCADE
);