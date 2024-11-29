# LaraToolkit

**LaraToolkit** é uma biblioteca para Laravel que fornece um conjunto de ferramentas e abstrações para agilizar o desenvolvimento de aplicações. Com comandos personalizados, traits úteis e classes de abstração, o LaraToolkit ajuda a padronizar e simplificar tarefas comuns no desenvolvimento com Laravel.

## Índice

- [Instalação](#instalação)
- [Requisitos](#requisitos)
- [Funcionalidades](#funcionalidades)
    - [Comandos Artisan Personalizados](#comandos-artisan-personalizados)
        - [`make:service`](#makeservice)
        - [`make:repository`](#makerepository)
    - [Trait `ApiControllerTrait`](#trait-apicontrollertrait)
    - [Classe `AbstractRepository`](#classe-abstractrepository)
- [Como Utilizar](#como-utilizar)
    - [Gerando um Service](#gerando-um-service)
    - [Gerando um Repository](#gerando-um-repository)
    - [Usando a Trait `ApiControllerTrait`](#usando-a-trait-apicontrollertrait)
    - [Criando Exceções Personalizadas](#criando-exceções-personalizadas)
- [Contribuição](#contribuição)
- [Licença](#licença)

## Instalação

Para instalar o LaraToolkit, adicione o pacote ao seu projeto Laravel usando o Composer:

```bash
composer require marioneto/lara-toolkit
```

## Requisitos

- **PHP**: >= 8.0
- **Laravel**: 8.x, 9.x ou 10.x

## Funcionalidades

### Comandos Artisan Personalizados

O LaraToolkit adiciona comandos personalizados ao Artisan para gerar classes de Service e Repository de forma padronizada.

#### `make:service`

Gera uma classe de Service organizada por domínio.

**Sintaxe:**

```bash
php artisan make:service {nome} {dominio}
```

- `{nome}`: O nome do Service a ser criado.
- `{dominio}`: O domínio ao qual o Service pertence.

**Exemplo:**

```bash
php artisan make:service Create User
```

Isso criará a classe `CreateService` em `app/Services/User/CreateService.php`.

#### `make:repository`

Gera uma classe de Repository que estende `AbstractRepository`.

**Sintaxe:**

```bash
php artisan make:repository {nome}
```

- `{nome}`: O nome Model para o Repository a ser criado.

**Exemplo:**

```bash
php artisan make:repository User
```

Isso criará a classe `UserRepository` em `app/Repositories/UserRepository.php`.

### Trait `ApiControllerTrait`

A trait `ApiControllerTrait` fornece métodos para padronizar as respostas de APIs em suas controllers.

- **`returnSuccess($data, string $message = null, int $statusCode = 200)`**: Retorna uma resposta JSON de sucesso.
- **`returnError(string $message, Throwable $exception = null, int $statusCode = 500)`**: Retorna uma resposta JSON de erro, registrando a exceção no log sem usar facades ou helpers.

### Classe `AbstractRepository`

A classe `AbstractRepository` é uma abstração que fornece métodos comuns para interagir com modelos Eloquent, como:

- `getAll()`
- `getById($id)`
- `create(array $attributes)`
- `update($id, array $attributes)`
- `delete($id)`

## Como Utilizar

### Gerando um Service

1. Execute o comando `make:service`:

   ```bash
   php artisan make:service NomeDoService Dominio
   ```

   Exemplo:

   ```bash
   php artisan make:service Create User
   ```

2. O Service será criado em `app/Services/{Dominio}/{NomeDoService}Service.php`.

3. Implemente a lógica necessária no método `execute()` da classe gerada.

### Gerando um Repository

1. Execute o comando `make:repository`:

   ```bash
   php artisan make:repository NomeDoModel
   ```

   Exemplo:

   ```bash
   php artisan make:repository User
   ```

2. O Repository será criado em `app/Repositories/{NomeDoModel}Repository.php`.

3. No Repository gerado, o método `model()` já está definido para usar o modelo especificado.

### Usando a Trait `ApiControllerTrait`

1. Na sua controller, importe e utilize a trait:

   ```php
   <?php

   namespace App\Http\Controllers;

   use App\Http\Controllers\Controller;
   use LaraToolkit\Traits\ApiControllerTrait;

   class UserController extends Controller
   {
       use ApiControllerTrait;

       // ...
   }
   ```

2. Utilize os métodos `returnSuccess` e `returnError` nas suas ações:

   ```php
   public function index()
   {
       try {
           $users = $this->userRepository->getAll();

           return $this->returnSuccess($users, 'Usuários obtidos com sucesso.');
       } catch (\Exception $exception) {
           return $this->returnError('Erro ao obter usuários.', $exception);
       }
   }
   ```

### Usnado Exceções De Negócio

Caso você precise gerar uma excessão onde deseja que a mensagem seja retornada no JSON de erro, você pode usar a excessão `BusinessException`.
```php
if ($data['age'] < 18) {
   throw new BusinessException('O usuário deve ter pelo menos 18 anos.');
}
```
Se você estiver usando a trait `ApiControllerTrait`, você pode usar o método `returnError` para retornar a mensagem da `BusinessException` no JSON de erro, suprimindo a mensagem padrão.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues e pull requests no repositório do GitHub.

## Licença

Este projeto está licenciado sob a licença MIT. Consulte o arquivo [LICENSE](LICENSE) para obter mais informações.