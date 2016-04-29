USE PSI;

INSERT INTO Areas_Geograficas (freguesia, concelho, distrito)
VALUES ('Campo Grande', 'Lisboa', 'Lisboa');

INSERT INTO Areas_Geograficas (freguesia, concelho, distrito)
VALUES ('Leiria', 'Leiria', 'Leiria');


INSERT INTO Areas_Interesse (nome)
VALUES ('Saude');

INSERT INTO Areas_Interesse (nome)
VALUES ('Educação');

INSERT INTO Areas_Interesse (nome)
VALUES ('Desporto');


INSERT INTO Grupos_Atuacao (nome, descricao)
VALUES ('Idosos', 'Grupo de pessoas idosas');

INSERT INTO Grupos_Atuacao (nome, descricao)
VALUES ('Crianças', 'Grupos de crianças');


INSERT INTO Tipos_Habilitacoes_Academicas (nome, descricao)
VALUES ('Licenciatura', 'Grau de licenciado');

INSERT INTO Tipos_Habilitacoes_Academicas (nome, descricao)
VALUES ('Mestrado', 'Grau de mestre');

INSERT INTO Tipos_Habilitacoes_Academicas (nome, descricao)
VALUES ('Doutoramento', 'Grau de doutorado');
