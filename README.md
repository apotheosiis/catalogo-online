# Plataforma de Pré-Venda TechShop

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=for-the-badge&logo=javascript)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3)

**Autor:** Marllus Monteiro
**Status:** Em Desenvolvimento Ativo

Uma plataforma web completa de pré-venda, desenvolvida do zero com PHP, MySQL e JavaScript puro. O projeto simula a experiência de uma loja virtual, permitindo que clientes se cadastrem, montem um carrinho de compras e enviem solicitações de pedido para um painel administrativo seguro e funcional.

*(Aqui você pode adicionar um screenshot ou GIF do projeto em funcionamento)*
`![Demonstração do TechShop](caminho/para/sua/imagem.gif)`

---

## 🚀 Features Principais

O projeto foi estruturado com uma clara separação entre a experiência do cliente e a do administrador.

### Lado do Cliente (Vitrine e Conta)
- **Catálogo Dinâmico:** Produtos carregados do banco de dados e exibidos em um layout de grade responsivo.
- **Filtro por Categoria:** Navegação funcional por categorias que atualiza a lista de produtos instantaneamente.
- **Busca e Ordenação em Tempo Real:** Ferramentas de busca e ordenação que operam no lado do cliente para máxima velocidade.
- **Páginas de Produto Individuais:** Cada produto possui uma página de detalhes dedicada.
- **Sistema de Autenticação de Cliente:** Fluxo completo de cadastro e login para clientes.
- **Carrinho de Compras Persistente:** O carrinho é salvo na conta de cada cliente, permitindo continuar a compra em outras sessões.
- **Gerenciamento de Carrinho:** Adicionar, atualizar quantidade e remover itens de forma dinâmica.
- **Fluxo de "Finalização de Pedido":** Envio de uma solicitação de compra para o administrador.

### Lado do Administrador (Painel de Controle)
- **Acesso Seguro e Secreto:** A página de login do admin fica em uma URL não-pública para maior segurança.
- **Autenticação Robusta:** Login protegido contra ataques de força bruta.
- **Gerenciamento de Produtos (CRUD):** Interface completa para criar, editar e excluir produtos do catálogo.
- **Visualização de Pedidos:** (Funcionalidade futura) Painel para visualizar as solicitações de compra enviadas pelos clientes.

---

## 🛠️ Tecnologias Utilizadas
* **Backend:** PHP 8+ (Processamento de dados, lógica de negócio e API)
* **Frontend:** HTML5, CSS3, JavaScript (ES6+) (Interface, interatividade e comunicação com a API)
* **Banco de Dados:** MySQL (Armazenamento de produtos, clientes, usuários e carrinhos)
* **Servidor:** Apache (via XAMPP/LAMPP)
* **Controle de Versão:** Git e GitHub
* **Biblioteca de Ícones:** Font Awesome

---

## ⚙️ Como Rodar o Projeto Localmente

Siga os passos abaixo para configurar e executar o projeto na sua máquina.

### Pré-requisitos
* **XAMPP ou LAMPP:** Um ambiente de servidor local com Apache e MySQL.
* **Git:** Para clonar o repositório.
* **Navegador Web:** Chrome, Firefox, ou similar.

### Passo a Passo da Instalação
1.  **Clone o Repositório**
    Navegue até o diretório `htdocs` do seu XAMPP (ex: `C:/xampp/htdocs/`) e execute o comando:
    ```bash
    git clone [link do repositorio] catalogo-produtos
    ```

2.  **Inicie os Serviços**
    Abra o painel de controle do XAMPP e inicie os módulos **Apache** e **MySQL**.

3.  **Crie e Configure o Banco de Dados**
    * Abra o **phpMyAdmin** (geralmente em `http://localhost/phpmyadmin`).
    * Crie um novo banco de dados chamado `catalogo_db`.
    * Selecione o banco `catalogo_db`, clique na aba **"Importar"** e escolha o arquivo `sql/database.sql` do projeto.
    * **Importante:** Este arquivo já cria todas as tabelas e insere os produtos de exemplo e o usuário administrador padrão.

4.  **Configure as Variáveis de Ambiente**
    * No diretório do projeto, renomeie o arquivo `.env.example` para `.env`.
    * Abra o arquivo `.env` e verifique se as credenciais correspondem à sua configuração do MySQL (a configuração padrão do XAMPP geralmente já está correta).

5. **Execute o setup_admin.php
    *Digite a url: `http://localhost/catalogo-online/setup_admin.php`
    *Após isso, exclua este arquivo.
---

## 🔑 Acesso e Credenciais Padrão

### Acesso ao Site (Público)
* **URL:** `http://localhost/catalogo-produtos/`

### Acesso do Cliente
1.  Primeiro, crie uma conta na página de cadastro.
2.  **URL de Login:** `http://localhost/catalogo-produtos/login_cliente.php`

### Acesso do Administrador
O acesso ao painel de admin é intencionalmente **não linkado** de nenhum lugar do site por segurança.
* **URL de Login Secreta:** `http://localhost/catalogo-produtos/admin/painel-acesso.php`
* **Usuário:** `admin`
* **Senha:** `admin123`

---

## 📂 Estrutura do Projeto
```
/catalogo-produtos/
|-- index.php                 # Página inicial (catálogo)
|-- produto.php               # Página de detalhes do produto
|-- carrinho.php              # Página do carrinho de compras
|-- login_cliente.php         # Login para clientes
|-- registro.php              # Cadastro de clientes
|-- minha-conta.php           # (Placeholder) Página do cliente logado
|-- admin/
|   |-- painel-acesso.php     # Login SEGURO do admin
|   |-- crud.php              # Painel de gerenciamento de produtos
|   |-- .htaccess             # Bloqueia listagem de diretório
|   |-- ...
|-- api/
|   |-- read.php              # API para ler produtos
|   |-- carrinho_api.php      # API para gerenciar o carrinho
|   |-- ...
|-- config/
|   |-- db.php                # Conexão com o banco de dados
|-- css/
|   |-- style.css             # Estilos do site público
|   |-- admin.css             # Estilos do painel de admin e login
|-- js/
|   |-- script.js             # Lógica do catálogo (busca, filtro)
|   |-- notifications.js      # Lógica de notificações
|-- sql/
|   |-- database.sql          # Estrutura completa e dados iniciais do banco
|-- .env                      # (Local) Credenciais do banco de dados
|-- .env.example              # Exemplo de arquivo .env
|-- DVP.md                    # Documento de Visão do Projeto
|-- README.md                 # Este arquivo
```

---

## 📄 Documentação Adicional
Para uma visão detalhada dos objetivos, escopo, requisitos e funcionalidades do projeto, consulte o [Documento de Visão do Projeto (DVP.md)](DVP.md).