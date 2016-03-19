CREATE TABLE Voluntarios (
	id                          INT NOT NULL AUTO_INCREMENT,
	id_area_geografica          INT NOT NULL,
	id_habilitacoes_academicas  INT NOT NULL,
	nome                        VARCHAR(100) DEFAULT NULL,
	genero                      CHAR DEFAULT NULL,
	data_nascimento             DATE DEFAULT NULL,
	telefone                    VARCHAR(20) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (id_area_geografica) REFERENCES Areas_Geograficas(id),
	FOREIGN KEY (id_habilitacoes_academicas) REFERENCES Habilitacoes_Academicas(id)
);
