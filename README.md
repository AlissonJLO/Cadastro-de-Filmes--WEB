# Avaliação Prática 1 - Catálogo de Filmes

## Descrição do Projeto

Este projeto consiste em um sistema web para gerenciar um catálogo de filmes, desenvolvido como parte da Avaliação Prática 1. O sistema permite realizar as operações básicas de CRUD (Cadastrar, Listar, Atualizar e Deletar) para duas entidades principais: Filmes e Gêneros.

## Tecnologias Utilizadas

- **Frontend:** HTML5 (com tags semânticas), CSS3 (utilizando Grid Layout para a estrutura principal e Flexbox para alinhamentos específicos).
- **Backend:** PHP 8.2 (de forma procedural).
- **Banco de Dados:** PostgreSQL 15, gerenciado via Docker.
- **Ambiente de Desenvolvimento:** Nix com `shell.nix` para garantir a reprodutibilidade do ambiente e das ferramentas (como PHP e Docker Compose).

## Execução do Ambiente

O ambiente de desenvolvimento foi projetado para ser configurado de forma rápida e automatizada, utilizando Docker para o banco de dados e um script de inicialização (`start.sh`).

### Como Subir o Banco de Dados

Para iniciar o banco de dados, não é necessário nenhum passo manual de criação de tabelas. O script `start.sh` funciona como um instalador automático. Siga os passos:

1.  **Inicie e configure o banco de dados:** Ainda dentro do `nix-shell`, execute o script de inicialização:

    ```bash
    ./start.sh
    ```

### O que o script `start.sh` faz?

Ao ser executado, o script realiza as seguintes ações:

1.  **Inicia o Container:** Ele usa o `docker-compose.yml` para criar e iniciar um container Docker com o PostgreSQL 15. Os dados são salvos em um volume, garantindo que não sejam perdidos ao parar o container.
2.  **Aguarda a Prontidão:** O script espera até que o serviço do PostgreSQL dentro do container esteja totalmente pronto para aceitar conexões.
3.  **Executa o Setup Inicial:** Assim que o banco está pronto, o script executa automaticamente o arquivo `database.sql`.

É neste último passo que a mágica acontece: o `database.sql` contém todos os comandos para **criar as tabelas `generos` e `filmes`** e também para **inserir os dados iniciais** (os quatro gêneros padrão).

Portanto, ao final da execução do `./start.sh`, **o banco de dados já estará totalmente pronto para uso**, com a estrutura necessária e os dados iniciais já carregados, permitindo que a aplicação PHP funcione imediatamente.

### Iniciando a Aplicação Web

Após o banco de dados estar no ar, inicie o servidor web embutido do PHP com o comando:

```bash
php -S localhost:8000
```

Agora você pode acessar `http://localhost:8000` em seu navegador para ver o sistema funcionando.

### Como Parar o Ambiente

Para parar o container do banco de dados, utilize o mesmo script com a flag `-s`:

```bash
./start.sh -s
```
