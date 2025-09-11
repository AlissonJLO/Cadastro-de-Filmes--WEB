# Relatório do Projeto - AP1: Cine-Teca

## 1. Descrição Geral do Projeto

O projeto "Cine-Teca" é um sistema web desenvolvido para a Avaliação Prática 1 (AP1) da disciplina de Programação Web. O sistema funciona como um catálogo pessoal de filmes, permitindo ao usuário gerenciar um acervo de forma simples e organizada.

O tema principal escolhido foi o **cadastro de filmes**, com as seguintes entidades:
* **Entidade Principal:** Filmes.
* **Entidade Secundária:** Gêneros.

O sistema implementa todas as operações básicas de **CRUD** (Cadastrar, Listar, Atualizar e Deletar) para ambas as entidades, permitindo uma gestão completa do catálogo. A interface foi construída seguindo um layout pré-definido, utilizando tecnologias web modernas como HTML5 semântico, CSS Grid e Flexbox.

## 2. Estrutura de Pastas e Organização do Código

A organização do projeto foi um ponto central do desenvolvimento, buscando separar as responsabilidades de cada parte do código, mesmo em um paradigma procedural. A estrutura de pastas adotada foi a seguinte:

* **/ (raiz)**: Contém o `index.php`, que funciona como o controlador principal (roteador) da aplicação, e os arquivos de configuração do ambiente (`docker-compose.yaml`, `start.sh`, `database.sql`).
* **`src/config/`**: Arquivos de configuração da aplicação, como as constantes de conexão com o banco de dados (`config.php`) e a função de conexão PDO (`conexao.php`).
* **`src/css/`**: Contém a folha de estilos principal (`style.css`) responsável por toda a aparência do site.
* **`src/layout/`**: Partes reutilizáveis do layout HTML, como o cabeçalho (`header.php`), o menu de navegação (`menu.php`) e o rodapé (`footer.php`).
* **`src/repository/`**: Camada de acesso a dados. Contém os arquivos com todas as funções que interagem diretamente com o banco de dados, executando as queries SQL para filmes (`filme.php`) and gêneros (`genero.php`).
* **`src/service/`**: Camada de serviço/lógica de negócio. O arquivo `forms.php` atua como um controlador que recebe todas as submissões de formulários, processa os dados, gerencia o upload de arquivos e redireciona o usuário.
* **`src/uploads/`**: Diretório onde as imagens (pôsteres) dos filmes são armazenadas após o upload.
* **`src/view/`**: Camada de apresentação. Contém os arquivos que renderizam o conteúdo principal da página, como formulários (`cadastrar_filme.php`) e listagens (`listar_filmes.php`).

## 3. Tecnologias e Ferramentas Utilizadas

* **Backend**: PHP 8.2, seguindo uma abordagem procedural com funções bem definidas para cada responsabilidade.
* **Frontend**: HTML5, com uso de tags semânticas (`<header>`, `<nav>`, `<main>`, `<footer>`), e CSS3, utilizando **Grid Layout** para a estrutura principal da página e **Flexbox** para alinhamentos internos de componentes.
* **Banco de Dados**: PostgreSQL 15, executado em um container Docker para facilitar a portabilidade e configuração do ambiente.
* **Ambiente de Desenvolvimento**:
    * **Docker e Docker Compose**: Para orquestrar o container do banco de dados de forma isolada e consistente.
    * **Nix e `shell.nix`**: Para criar um ambiente de desenvolvimento reprodutível, garantindo que todos os desenvolvedores utilizem as mesmas versões de PHP, Docker e outras ferramentas.
    * **Shell Script (`start.sh`)**: Um script de automação foi criado para iniciar, configurar o banco de dados (executando o `database.sql` automaticamente) e parar o ambiente com um único comando.

## 4. Funcionalidades Implementadas

O sistema atende a todos os requisitos solicitados na especificação da avaliação:

* **CRUD de Gêneros (Entidade Secundária)**:
    * Cadastro de novos gêneros com nome e descrição.
    * Listagem de todos os gêneros em uma tabela.
    * Edição e Atualização das informações de um gênero.
    * Exclusão de um gênero.

* **CRUD de Filmes (Entidade Principal)**:
    * Cadastro de filmes com 5 campos (título, sinopse, ano, duração, destaque) e um arquivo de imagem.
    * Listagem de todos os filmes, exibindo o pôster e as informações principais.
    * Edição e Atualização de todas as informações de um filme, incluindo a substituição da imagem.
    * Exclusão de um filme, que também remove o arquivo de imagem associado do servidor.

* **Gerenciamento de Imagens**: O sistema realiza o upload de pôsteres para um diretório (`src/uploads/`), renomeando cada arquivo com um identificador único para evitar sobrescrita.

* **Relacionamento**: A tabela `filmes` está relacionada com `generos` através de uma chave estrangeira. Ao excluir um gênero, o campo `genero_id` nos filmes associados é definido como `NULL`, evitando a exclusão em cascata.

* **Páginas Especiais**:
    * **Página Inicial**: Exibe os 5 filmes mais recentes marcados como "Destaque".
    * **Página "Visualizar Item"**: Uma página de detalhes que mostra todas as informações de um filme, e que também contém os botões para editar e excluir o item.

* **Uso de Sessão (`Session`)**: A sessão é utilizada para exibir mensagens de feedback (flash messages) ao usuário após a realização de uma ação (ex: "Filme cadastrado com sucesso!").

## 5. Fontes e Uso de Inteligência Artificial Generativa

Este projeto foi desenvolvido com o auxílio da ferramenta de Inteligência Artificial Generativa **Google Gemini**. A IA foi utilizada como uma assistente de programação para depuração de código, refatoração, implementação de novas funcionalidades e documentação.

A seguir, estão listados os principais arquivos/scripts que foram gerados ou significativamente aprimorados pela IA, juntamente com exemplos dos *prompts* (comandos) utilizados.

* **Arquivos/Scripts influenciados pela IA:**
    * `index.php` (roteador principal)
    * `src/service/forms.php` (processamento de formulários)
    * `src/repository/filme.php` e `src/repository/genero.php` (funções de banco de dados)
    * `src/view/cadastrar_filme.php`, `src/view/listar_filmes.php`, `src/view/visualizar_filme.php`, `src/view/home.php`
    * `src/css/style.css` (estilos para novas funcionalidades)
    * Este documento de descrição (`DESCRICAO_DO_PROJETO.md`).
