CREATE TABLE Utilizadores (
   id                  INT NOT NULL AUTO_INCREMENT,
   email               VARCHAR(100) NOT NULL,
   password            VARCHAR(20) NOT NULL,
   recovery_token      VARCHAR(50) NOT NULL,
   created_at          DATE NOT NULL,
   updated_at          DATE NOT NULL,
   PRIMARY KEY (id)
);
