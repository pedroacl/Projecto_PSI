CREATE TABLE Periodicidade (
   id                  INT PRIMARY KEY NOT NULL,
   id_disponibilidade  INT NOT NULL,
   tipo                VARCHAR(20),
   data_fim            DATE NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (id_disponibilidade) REFERENCES Disponibilidade ON DELETE CASCADE
);