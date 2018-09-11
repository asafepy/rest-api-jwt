# Desafio API REST 
 Consiste em criar uma API para cursos e categorias.

### Requisitos para Instalação
- Laravel 5.4
- Mysql 5.6
- Php 5.6

### Instalação

Dependências

```sh
$ make setup_local
```


Migração

```sh
$ make db_migrate
```

Iniciando serviço

```sh
$ make server
```

Parar o serviço

```sh
$ make server_stop
```


### Testes

Criação de dados para teste da API

```sh
$ make db_populate
```

Recriar todo o banco de dados

```sh
$ make db_reload_force
```

### Api

#### Endpoints:
        - /api/cursos/
        - /api/categorias/

#### Exemplos:

Para obtenção do Json Web Token, é necessário logar
        
        [POST] http://example.com/api/auth/login/

        usuário : admin@admin.com
        senha: admin

Para cadastrar um curso ou uma categoria
	
        [POST] http://example.com/api/cursos/
                
                # Requisitos
                - name
                - category_id

        [POST] http://example.com/api/categorias/
                
                # Requisitos
                - name

Para listar todos os cursos ou todas as categorias
	
        [GET] http://example.com/api/cursos/
        [GET] http://example.com/api/categorias/

Para listar um curso ou uma categoria 
	
        [GET] http://example.com/api/cursos/{id}/?token={token}
        [GET] http://example.com/api/categorias/{id}/?token={token}


Para deletar um determinado curso ou categoria

        [DELETE] http://example.com/api/cursos/{id}/
        [DELETE] http://example.com/api/categorias/{id}/

Para autalizar um determinado curso ou categoria

        [PUT] http://example.com/api/cursos/{id}/
        [PUT] http://example.com/api/categorias/{id}/


Para remover uma determinada categoria de curso

        [DELETE] http://example.com/api/cursos/{course_id}/{category_id}/

OBS: caso delete uma categoria, será deletado todo e qualquer relacionamento existente com produto, na tabela, "course_category"

### Informações Importantes

Para obtenção o Token, é necessário fazer o login no endpoint descrito a cima.

Infelizmente por conta de tempo, não foi possível criar os testes unitários nem tratamento de exceções.

Procurei trabalhar melhor forma o Strategy.

