# Documento de Visão do Projeto (DVP) - TechShop

**Nome do Projeto:** Plataforma de Pré-Venda TechShop
**Versão do Documento:** 2.1
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
* **FG.01 - Visualização Responsiva:** O layout do site se adapta a qualquer dispositivo (mobile-first).
* **FG.02 - Listagem de Produtos:** A página inicial exibe todos os produtos do catálogo.
* **FG.03 - Página de Produto Dedicada:** Cada produto possui uma página individual com detalhes, seletor de quantidade e botão para adicionar ao carrinho.
* **FG.04 - Filtro por Categoria:** Navegação funcional por categorias que atualiza a lista de produtos.
* **FG.05 - Busca e Ordenação em Tempo Real:** Ferramentas que operam no lado do cliente para máxima velocidade.
* **FG.06 - Navegação Consistente:** Cabeçalho e rodapé completos e consistentes em todas as páginas públicas, com logo clicável para a home e links de navegação.

### 4.2. Funcionalidades da Conta do Cliente
* **FC.01 - Autenticação de Cliente:** Fluxo completo e seguro para cadastro, login e logout de clientes.
* **FC.02 - Carrinho de Compras Persistente:** O carrinho é salvo na conta do cliente e pode ser acessado em diferentes sessões.
* **FC.03 - Gerenciamento do Carrinho:** Página dedicada (`carrinho.php`) para visualizar, atualizar quantidades e remover itens do carrinho.
* **FC.04 - Simulação de Envio de Pedido:** Ao finalizar, o cliente recebe uma notificação de sucesso e seu carrinho é automaticamente esvaziado, completando o ciclo de "pré-venda".
* **FC.05 - Acesso Restrito:** As páginas "Minha Conta" e "Carrinho" só podem ser acessadas por clientes logados.
* **FC.06 - Painel "Minha Conta":** (Pendente) Uma página dedicada para o cliente visualizar seu histórico de pedidos e gerenciar seus dados.

### 4.3. Funcionalidades Administrativas
* **FA.01 - Acesso via Login Seguro:** Acesso ao painel restrito por uma URL não pública, com proteção contra força bruta.
* **FA.02 - Gerenciamento de Produtos (CRUD):** Interface completa para criar, visualizar, atualizar e deletar produtos.
* **FA.03 - Notificações de Feedback:** Mensagens visuais informam o administrador sobre o sucesso ou falha de suas ações.
* **FA.04 - Visualização de Pedidos:** (Pendente) Seção futura no painel para o administrador visualizar as solicitações de compra enviadas pelos clientes.

---

## 5. Requisitos Não-Funcionais

| Categoria            | Requisito                                                                                                                                                                                                                                                                                                                              |
| -------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Desempenho** | **1. Carregamento Inicial:** O tempo de carregamento da página principal deve ser otimizado.<br>**2. Interatividade:** Ações do usuário logado (login, adição ao carrinho) devem ter uma resposta rápida.                                                                                                                                   |
| **Segurança** | **1. Injeção de SQL:** Proteção com Prepared Statements (PDO).<br>**2. Hashing de Senhas:** Senhas armazenadas com hash seguro (`password_hash`).<br>**3. Força Bruta:** Login do admin protegido com limite de tentativas.<br>**4. Sequestro de Sessão:** ID da sessão regenerado após o login.<br>**5. Vazamento de Credenciais:** Senhas do BD mantidas em arquivo `.env`.<br>**6. XSS:** Saída de dados tratada com `htmlspecialchars()`.<br>**7. Validação Server-Side:** Dados de formulários validados no backend.<br>**8. Prevenção de Listagem de Diretório:** A pasta `/admin` é protegida com `.htaccess`. |
| **Usabilidade** | A interface deve ser limpa, intuitiva e responsiva (mobile-first) em todas as áreas do sistema, com navegação consistente.                                                                                                                                                                                                              |
| **Privacidade de Dados** | O sistema deve garantir a privacidade dos dados do cliente, armazenando senhas de forma segura e não expondo informações pessoais.                                                                                                                                                                                                     |
| **Escalabilidade** | A arquitetura do sistema deve permitir a futura integração de novas funcionalidades, como um sistema de pagamento online.                                                                                                                                                                                                                  |

---

## 6. Escopo do Projeto e Limitações

### 6.1. Dentro do Escopo
* Todas as funcionalidades listadas como implementadas na Seção 4.
* Criação de contas de cliente e um único administrador.
* Envio de solicitações de compra que limpam o carrinho e notificam o usuário (sem salvar o pedido para o admin nesta fase).

### 6.2. Fora do Escopo
* Integração com gateways de pagamento real.
* Cálculo automático de frete.
* Múltiplos níveis de permissão para administradores.
* Funcionalidade real de envio de e-mails automáticos.
* Sistema de avaliação e comentários de produtos.
* Gerenciamento de estoque.
* Salvar e exibir o histórico de pedidos para cliente e admin.

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
|-- produto.php
|-- carrinho.php
|-- minha-conta.php
|-- login_cliente.php
|-- registro.php
|-- auth_cliente.php
|-- registrar_cliente.php
|-- logout_cliente.php
|-- admin/
|   |-- painel-acesso.php
|   |-- crud.php
|   |-- auth.php
|   |-- logout.php
|   |-- .htaccess
|-- api/
|   |-- read.php
|   |-- carrinho_api.php
|   |-- create.php, update.php, delete.php
|-- config/
|   |-- db.php
|-- css/
|   |-- style.css, admin.css
|-- js/
|   |-- script.js, notifications.js
|-- imagens/
|-- sql/
|   |-- database.sql
|-- .env, .env.example
|-- DVP.md
|-- README.md
```