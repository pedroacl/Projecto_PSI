CREATE TABLE Inscreve_Se (
   id_voluntario                   INT NOT NULL AUTO_INCREMENT,
   id_oportunidade_voluntariado    INT NOT NULL,
   data_inscricao                  DATE NOT NULL,
   PRIMARY KEY (id_voluntario, id_oportunidade_voluntariado),
   FOREIGN KEY (id_voluntario) REFERENCES Voluntarios(id) ON DELETE CASCADE,
   FOREIGN KEY (id_oportunidade_voluntariado) REFERENCES Oportunidades_Voluntariado(id) ON DELETE CASCADE
);