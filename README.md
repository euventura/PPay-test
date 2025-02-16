
# Perfect Pay

## Descrição

O Perfect Pay é uma aplicação para gerenciar pagamentos utilizando diferentes métodos de pagamento, como Boleto, PIX e Cartão de Crédito. A aplicação integra com a API do Asaas para processar os pagamentos.

## Funcionalidades

- Criação de pagamentos
- Suporte a múltiplos métodos de pagamento (Boleto, PIX, Cartão de Crédito)
- Integração com a API do Asaas
- Validação de dados de pagamento
- Exibição de mensagens de erro em português

## Tecnologias Utilizadas

- PHP
- Laravel
- Bootstrap
- jQuery

## Instalação

1. Clone o repositório:

    ```bash
    git clone https://github.com/seu-usuario/perfect-pay.git
    ```

2. Navegue até o diretório do projeto:

    ```bash
    cd perfect-pay
    ```

3. Instale as dependências do Composer:

    ```bash
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
    ```

4. Copie o arquivo `.env.example` para `.env` e configure suas variáveis de ambiente:

    ```bash
    cp .env.example .env
    ./vendor/bin/sail up -d
    ```

5. Gere a chave da aplicação:

    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

6. Execute as migrações do banco de dados:

    ```bash
    ./vendor/bin/sail artisan migrate
    ```

7. Acesse a aplicação no navegador:

    ```
    http://localhost
    ```

3. Preencha o formulário de pagamento e envie para processar o pagamento.

