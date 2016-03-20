USE PSI;

INSERT INTO Utilizadores (email, password, foto)
VALUES ('voluntario@alunos.fc.ul.pt', '12345', 'voluntario/foto');

INSERT INTO Areas_Geograficas (freguesia, concelho, distrito)
VALUES ('Campo Grande', 'Lisboa', 'Lisboa');

INSERT INTO Instituicoes (id_area_geografica, nome, descricao, telefone, morada, website)
VALUES ('1', 'FCUL', 'Faculdade de Ciencias', '+351 2167483386', 'Campo Grande', 'www.fc.ul.pt');

INSERT INTO Areas_Interesse (nome)
VALUES ('Saude');

INSERT INTO Disponibilidades (data_inicio, data_fim)
VALUES (STR_TO_DATE('10-03-2016', '%d-%m-%Y'), STR_TO_DATE('12-03-2016', '%d-%m-%Y'));

INSERT INTO Periodicidades (id_disponibilidade, tipo, data_fim)
VALUES ('1', 's', STR_TO_DATE('12-03-2016', '%d-%m-%Y'));

INSERT INTO Grupos_Atuacao (nome, descricao)
VALUES ('Idosos', 'Grupo de pessoas idosas');

INSERT INTO Habilitacoes_Academicas (tipo, data_conclusao, curso, instituto_ensino)
VALUES ('licenciatura', STR_TO_DATE('12-03-2015', '%d-%m-%Y'), 'Engenharia Informatica', 'FCUL');

INSERT INTO Voluntarios (id_area_geografica, id_habilitacoes_academicas, nome, genero, data_nascimento, telefone)
VALUES ('1', '1', 'Miguel Lopes', 'm', STR_TO_DATE('12-03-1990', '%d-%m-%Y'), '+351 925837654');

INSERT INTO Oportunidades_Voluntariado (id_area_interesse, id_grupo_atuacao, id_disponibilidade, id_area_geografica,
	id_instituicao, nome, funcao, pais, vagas, ativa)
VALUES ('1', '1', '1', '1', '1', 'Oportunidade de Voluntariado', 'Voluntariado', 'Portugal', '10', '1');

INSERT INTO Inscreve_Se (id_voluntario, id_oportunidade_voluntariado, data_inscricao, aceite)
VALUES ('1', '1', STR_TO_DATE('12-03-2016', '%d-%m-%Y'), '1');





