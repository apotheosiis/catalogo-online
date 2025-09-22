# Catálogo de Produtos de Tecnologia

Este é um sistema completo de catálogo de produtos, desenvolvido com PHP, MySQL, HTML5, CSS3 e JavaScript. O projeto segue boas práticas de segurança, como o uso de variáveis de ambiente e prepared statements, e está pronto para ser hospedado em um repositório público no GitHub.

## Funcionalidades

- **Listagem de Produtos:** Visualização elegante e responsiva dos produtos.
- **Busca em Tempo Real:** Filtre produtos por nome ou descrição sem recarregar a página.
- **Ordenação Dinâmica:** Ordene os produtos por nome (A-Z, Z-A) ou preço (menor, maior).
- **CRUD Completo:** Uma área administrativa (`crud.php`) para Criar, Ler, Atualizar e Excluir produtos.
- **Design Moderno:** Interface mobile-first, utilizando Flexbox e Grid para um layout adaptável.
- **Segurança:** As credenciais do banco de dados são gerenciadas via arquivo `.env`, que não é enviado para o repositório. Todas as queries SQL utilizam *prepared statements* para prevenir SQL Injection.

## Tecnologias Utilizadas

- **Backend:** PHP 8+
- **Frontend:** HTML5, CSS3, JavaScript (ES6+)
- **Banco de Dados:** MySQL
- **Servidor:** Apache (compatível com XAMPP/LAMPP/WAMPP)

---

## Instalação e Configuração

Siga os passos abaixo para rodar o projeto localmente.

### Pré-requisitos

- **XAMPP ou LAMPP:** Certifique-se de ter um ambiente de servidor local com Apache e MySQL instalados e em execução.
- **Git:** Para clonar o repositório.
- **Navegador Web:** Chrome, Firefox, ou similar.

### Passo a Passo

1.  **Clone o Repositório**
    Navegue até o diretório `htdocs` do seu XAMPP/LAMPP (geralmente `/opt/lampp/htdocs/` no Linux ou `C:/xampp/htdocs/` no Windows) e clone o projeto:
    ```bash
    git clone <URL_DO_SEU_REPOSITORIO> catalogo-produtos
    cd catalogo-produtos
    ```

2.  **Crie o Banco de Dados**
    - Abra o **phpMyAdmin** (geralmente acessível em `http://localhost/phpmyadmin`).
    - Crie um novo banco de dados chamado `catalogo_db`.
    - Selecione o banco `catalogo_db`, clique na aba "Importar", escolha o arquivo `sql/database.sql` do projeto e execute a importação. Isso criará a tabela `produtos` e inserirá alguns dados de exemplo.

3.  **Configure as Variáveis de Ambiente**
    - No diretório do projeto, renomeie o arquivo `.env.example` para `.env`.
    - Abra o arquivo `.env` e edite as credenciais do banco de dados, se necessário. A configuração padrão do XAMPP geralmente é:
      ```ini
      DB_HOST="localhost"
      DB_USER="root"
      DB_PASS=""
      DB_NAME="catalogo_db"
      ```

4.  **Acesse o Sistema**
    - Com o Apache e o MySQL rodando, abra seu navegador e acesse: `http://localhost/catalogo-produtos/`
    - Para acessar a área de gerenciamento (CRUD), acesse: `http://localhost/catalogo-produtos/crud.php`

---

## Estrutura do Projeto

/catalogo-produtos/
|-- .gitignore           # Ignora arquivos sensíveis como .env
|-- .env.example         # Modelo para as variáveis de ambiente
|-- README.md            # Este arquivo
|-- index.php            # Página principal do catálogo (view do cliente)
|-- crud.php             # Painel administrativo para gerenciar produtos
|-- api/                 # Endpoints PHP para as operações do CRUD
|   |-- create.php
|   |-- read.php         # Usado pelo JavaScript para buscar os produtos
|   |-- update.php
|   |-- delete.php
|-- config/
|   |-- db.php           # Lógica de conexão com o banco de dados (lê o .env)
|-- css/
|   |-- style.css        # Folha de estilos principal
|-- js/
|   |-- script.js        # Lógica de busca e ordenação do frontend
|-- imagens/             # Pasta para as imagens dos produtos
|-- sql/
|   |-- database.sql     # Script de criação do banco e da tabela