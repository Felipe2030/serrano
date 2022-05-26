CREATE TABLE users (
	id serial PRIMARY KEY,
  	nome varchar(255) NOT NULL,
  	sexo char(2) NOT NULL,
  	datanascimento date,
  	idade int NOT NULL
)
