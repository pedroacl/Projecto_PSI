CREATE TABLE Voluntarios (
	id                          INT NOT NULL AUTO_INCREMENT,
	id_area_geografica          INTEGER NOT NULL,
	id_habilitacoes_academicas  INTEGER NOT NULL,
	nome                        VARCHAR2(20) DEFAULT NULL,
	genero                      VARCHAR2(20) DEFAULT NULL,
	data_nascimento             DATE DEFAULT NULL,
	telefone                    VARCHAR2(20) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (id_area_geografica) REFERENCES Areas_Geograficas,
	FOREIGN KEY (id_habilitacoes_academicas) REFERENCES Habilitacoes_Academicas
);

