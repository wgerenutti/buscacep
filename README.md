# Consulta de CEP

Este é um projeto Laravel que permite ao usuário consultar informações de endereço com base em um CEP fornecido.

## Funcionalidades

- Consulta de CEP: O usuário pode inserir um CEP e obter informações de endereço correspondentes.
- Armazenamento de CEP: As informações de endereço consultadas são armazenadas no banco de dados para consultas futuras.
- Deleção de CEP: O usuário pode deletar um registro de endereço do banco de dados.

## Rotas

- `GET /`: Exibe a página inicial onde o usuário pode inserir um CEP para consulta.
- `GET /cep`: Exibe a página de consulta de CEP.
- `POST /cep`: Realiza a consulta do CEP e retorna as informações de endereço correspondentes.

## Como usar

1. Clone o repositório.
2. Instale as dependências com `composer install`.
3. Configure o banco de dados no arquivo `.env`.
4. Rode as migrations com `php artisan migrate`.
5. Inicie o servidor com `php artisan serve`.
6. Acesse `http://localhost:8000` no seu navegador.

## Dependências

- Laravel
- GuzzleHTTP

## Licença

Este projeto está licenciado sob a licença MIT.


# Zip Code Lookup

This is a Laravel project that allows the user to look up address information based on a provided zip code.

## Features

- Zip Code Lookup: The user can enter a zip code and get corresponding address information.
- Zip Code Storage: Looked up address information is stored in the database for future queries.
- Zip Code Deletion: The user can delete an address record from the database.

## Routes

- `GET /`: Displays the home page where the user can enter a zip code for lookup.
- `GET /cep`: Displays the zip code lookup page.
- `POST /cep`: Performs the zip code lookup and returns the corresponding address information.

## How to Use

1. Clone the repository.
2. Install dependencies with `composer install`.
3. Set up the database in the `.env` file.
4. Run migrations with `php artisan migrate`.
5. Start the server with `php artisan serve`.
6. Access `http://localhost:8000` in your browser.

## Dependencies

- Laravel
- GuzzleHTTP

## License

This project is licensed under the MIT license.
