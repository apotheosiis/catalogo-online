# Documento de Visão do Projeto (DVP) - TechShop

**Nome do Projeto:** Plataforma de Pré-Venda TechShop
**Versão do Documento:** 2.0
**Data:** 23 de setembro de 2025
**Autor:** Marllus Monteiro

---

## 1. Introdução

### 1.1. Propósito
O propósito deste documento é fornecer uma visão geral de alto nível do projeto **"Plataforma de Pré-Venda TechShop"**. Ele descreve o problema a ser resolvido, os principais stakeholders, os recursos do sistema e os requisitos não-funcionais, servindo como um guia para a equipe de desenvolvimento e outras partes interessadas.

### 1.2. Escopo
Este projeto engloba o desenvolvimento de um sistema web completo que atua como uma ponte entre a vitrine online e o processo de compra negociada. O sistema permite que clientes se cadastrem, montem um carrinho de compras e enviem uma "solicitação de compra" formal para o administrador da loja. Inclui uma interface pública, uma área de cliente logado e um painel administrativo seguro para gerenciamento de produtos e pedidos.

### 1.3. Definições, Acrônimos e Abreviações
* **DVP:** Documento de Visão do Projeto
* **CRUD:** Create, Read, Update, Delete (Criar, Ler, Atualizar, Deletar)
* **UI/UX:** User Interface / User Experience
* **API:** Application Programming Interface
* **SQL:** Structured Query Language
* **XSS:** Cross-Site Scripting

---

## 2. Posicionamento

### 2.1. Oportunidade de Negócio
Pequenos e médios varejistas de tecnologia necessitam de uma plataforma online para não apenas exibir seu inventário, mas também para capturar a intenção de compra de seus clientes de forma organizada. Este projeto atende a essa necessidade, oferecendo uma solução que formaliza pedidos informais (antes feitos por WhatsApp/telefone) e cria uma fundação de e-commerce robusta, pronta para futuras expansões como a integração de pagamentos online.

### 2.2. Declaração do Problema

| O Problema de:       | Lojas de pequeno porte e seus clientes.                                                                                             |
| -------------------- | -------------------------------------------------------------------------------------------------------------------------------------- |
| **Afeta:** | A eficiência da comunicação entre as partes.                                                                                           |
| **O Impacto é:** | A frustração do cliente ao tentar montar e comunicar um pedido complexo, e a sobrecarga do administrador ao receber solicitações desestruturadas, levando a erros e perda de tempo. |
| **Uma Solução Seria:** | Um sistema web com contas de usuário, carrinho de compras persistente e um processo formal para "solicitação de compra", que organiza todas as informações para o administrador e simplifica a vida do cliente. |

### 2.3. Declaração de Posição do Produto
> **Para:** Pequenos varejistas de tecnologia e seus clientes.
>
> **Que:** Buscam uma forma organizada e eficiente de gerenciar solicitações de compra online.
>
> **O:** TechShop
>
> **É uma:** Plataforma de Pré-Venda Online.
>
> **Que:** Centraliza a comunicação, permite que clientes cadastrados montem e salvem carrinhos de compra, e formalizem pedidos detalhados em um painel de controle intuitivo para o administrador.
>
> **Diferente de:** Canais de comunicação informais como WhatsApp e telefone.
>
> **Nosso Produto:** Organiza todas as solicitações de compra em um único lugar, com detalhes completos do pedido (itens, forma de pagamento sugerida, horários), e cria uma base de e-commerce sólida, pronta para futuras integrações.

---

## 3. Descrição dos Stakeholders e Usuários

### 3.1. Perfil dos Usuários

* **Visitante Não Cadastrado:**
    * **Objetivo:** Explorar o catálogo de produtos, usar a busca e a ordenação para encontrar itens de interesse.
    * **Características:** Qualquer pessoa navegando na internet. O sistema deve ser rápido e convidativo para incentivá-lo a se cadastrar.

* **Cliente Cadastrado:**
    * **Objetivo:** Utilizar o sistema como uma ferramenta rápida para montar e salvar pedidos.
    * **Características:** Cliente recorrente ou novo que deseja formalizar uma compra. Sua principal necessidade é a **agilidade**: salvar produtos no carrinho ao longo do tempo, em diferentes sessões, e enviar uma solicitação de compra completa com o mínimo de passos possível.

* **Administrador do Sistema:**
    * **Objetivo:** Gerenciar o catálogo de produtos e, crucialmente, receber e processar as solicitações de compra dos clientes de forma centralizada e organizada.
    * **Características:** Proprietário da loja ou funcionário responsável. Valoriza uma interface que apresente os pedidos de forma clara e completa para facilitar o contato com o cliente e a separação dos produtos.

---

## 4. Recursos do Produto (Funcionalidades)

### 4.1. Funcionalidades Públicas Gerais
* **FG.01 - Visualização Responsiva:** O layout do site se adapta perfeitamente a qualquer dispositivo (mobile-first).
* **FG.02 - Listagem de Produtos:** A página inicial exibe todos os produtos ativos do catálogo.
* **FG.03 - Busca e Filtro em Tempo Real:** Barra de pesquisa que filtra produtos por nome ou descrição instantaneamente.
* **FG.04 - Ordenação Dinâmica:** Seletor para reordenar produtos por preço e nome.
* **FG.05 - Navegação Intuitiva:** Cabeçalho com ícones de acesso rápido e barra de navegação por categorias.
* **FG.06 - Rodapé Completo:** Rodapé com informações institucionais, redes sociais e formas de pagamento.
* **FG.07 - Captura de Newsletter:** Seção dedicada para que visitantes se inscrevam para receber ofertas.

### 4.2. Funcionalidades da Conta do Cliente
* **FC.01 - Cadastro e Login de Clientes:** Sistema seguro para criação e acesso a contas de cliente.
* **FC.02 - Adição e Remoção de Itens do Carrinho:** Botões para manipular o carrinho de compras.
* **FC.03 - Carrinho de Compras Persistente:** O carrinho de compras é salvo e associado à conta do cliente entre diferentes sessões.
* **FC.04 - Página de Carrinho Detalhada:** Página para revisar itens, ajustar quantidades e ver subtotais.
* **FC.05 - Envio de Solicitação de Compra:** Formulário para confirmar o pedido, selecionar uma forma de pagamento sugerida e informar um horário preferencial para entrega/retirada.
* **FC.06 - Histórico de Pedidos:** Área na conta do cliente para visualizar solicitações de compra já enviadas.

### 4.3. Funcionalidades Administrativas
* **FA.01 - Acesso via Login Seguro:** Painel restrito e protegido por autenticação robusta.
* **FA.02 - Gerenciamento de Produtos (CRUD):** Interface completa para criar, visualizar, atualizar e deletar produtos.
* **FA.03 - Visualização de Pedidos dos Clientes:** Seção para o administrador ver todas as solicitações de compra recebidas com informações chave (cliente, data, valor, status).
* **FA.04 - Detalhes do Pedido:** Visualização detalhada de cada pedido (produtos, quantidades, pagamento, horário).
* **FA.05 - Notificações de Feedback:** Mensagens visuais informam o administrador sobre o sucesso ou falha de suas ações.

---

## 5. Requisitos Não-Funcionais

| Categoria            | Requisito                                                                                                                                                                                                                                                                                          |
| -------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Desempenho** | **1. Carregamento Inicial:** O tempo de carregamento da página principal deve ser otimizado.<br>**2. Interatividade:** Ações do usuário logado (login, adição ao carrinho) devem ter uma resposta rápida.                                                                                         |
| **Segurança** | **1. Injeção de SQL:** Proteção com Prepared Statements (PDO).<br>**2. Hashing de Senhas:** Senhas armazenadas com hash seguro (`password_hash`).<br>**3. Força Bruta:** Login do admin protegido com limite de tentativas.<br>**4. Sequestro de Sessão:** ID da sessão regenerado após o login.<br>**5. Vazamento de Credenciais:** Senhas do BD mantidas em arquivo `.env`.<br>**6. XSS:** Saída de dados tratada com `htmlspecialchars()`.<br>**7. Validação Server-Side:** Dados de formulários validados no backend. |
| **Usabilidade** | A interface deve ser limpa, intuitiva e responsiva (mobile-first) em todas as áreas do sistema.                                                                                                                                                                                                      |
| **Privacidade de Dados** | O sistema deve garantir a privacidade dos dados do cliente, armazenando senhas de forma segura e não expondo informações pessoais.                                                                                                                                                                 |
| **Escalabilidade** | A arquitetura do sistema deve permitir a futura integração de novas funcionalidades, como um sistema de pagamento online.                                                                                                                                                                                |

---

## 6. Escopo do Projeto e Limitações

### 6.1. Dentro do Escopo
* Todas as funcionalidades listadas na Seção 4.
* Criação de contas de cliente e um único administrador.
* Envio de solicitações de compra para visualização do administrador.

### 6.2. Fora do Escopo
* Integração com gateways de pagamento real (PagSeguro, Stripe, etc.).
* Cálculo automático de frete com base no CEP.
* Múltiplos níveis de permissão para administradores.
* Funcionalidade real de envio de e-mails automáticos.
* Sistema de avaliação e comentários de produtos pelos clientes.
* Gerenciamento de estoque.

---

## 7. Anexos

### 7.1. Tecnologias Utilizadas
* **Backend:** PHP 8+
* **Frontend:** HTML5, CSS3, JavaScript (ES6+)
* **Banco de Dados:** MySQL
* **Servidor:** Apache
* **Biblioteca de Ícones:** Font Awesome

### 7.2. Estrutura do Projeto
```
/catalogo-produtos/
|-- index.php
|-- admin/
|   |-- crud.php, login.php, logout.php, auth.php
|-- api/
|   |-- create.php, read.php, update.php, delete.php
|-- config/
|   |-- db.php
|-- css/
|   |-- style.css, admin.css
|-- js/
|   |-- script.js
|-- imagens/
|-- sql/
|   |-- database.sql
|-- .env
|-- .gitignore
|-- README.md
|-- DVP.md
```
