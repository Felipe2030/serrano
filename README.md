# Crud de Usuarios 
## Configurações do Projeto
```
cd frontend
npm install
cd ../
```

## Rodar o Projeto 
```
docker-compose up --build
```

## Configurar Banco de dados 
```
host: localhost
port: 5432
database: postgres
user: postgres
password: postgres

CREATE TABLE users (
	id serial PRIMARY KEY,
  	nome varchar(255) NOT NULL,
  	sexo char(2) NOT NULL,
  	datanascimento date,
  	idade int NOT NULL
)
```
Criar a tabela de usuario no banco de dados 

## API endpoints

```
GET /users
Codes 200
```
Retorna todos os usuários.

```
GET /users?
Codes 200 / 404
Param id, nome, sexo, datanascimento, dade
```
Retorna os usuários de acordo com o termo passado via querystring e paginação.

```
GET /users/{id}
Codes 200 / 404
```
Retorna os dados de um usuário.

```
POST /users
Codes 201 / 400
```
Adiciona um novo usuário.

```
PUT /users/{id}
Codes 200 / 400
```
Atualiza os dados de um usuário.

```
DELETE /users/{id}
Codes 204 / 400
```
Apaga o registro de um usuário.

