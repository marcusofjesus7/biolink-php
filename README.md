# Biolink PHP (Clone do Linktree)

Esse projeto é um agregador de links personalizado (estilo Linktree ou Meus Links) desenvolvido para fins de estudo. O foco principal aqui foi sair do PHP procedural básico e aplicar conceitos reais de **Programação Orientada a Objetos (POO)** e boas práticas de segurança no backend.

## 🚀 Proposta do Projeto

A ideia é ter um sistema web dividido em duas partes:
1. **Painel Admin (`admin.php`):** Onde o usuário consegue cadastrar, listar e gerenciar seus links de redes sociais ou páginas externas.
2. **Página Pública (`index.php`):** A página que vai para a bio das redes sociais, renderizando dinamicamente os botões salvos no banco de dados com um visual limpo.

## 🛠️ Tecnologias e Ferramentas

* **PHP 8+** (Utilizando Programação Orientada a Objetos)
* **PDO (PHP Data Objects):** Abstração de banco de dados para garantir segurança contra SQL Injection e facilitar uma eventual troca de SGBD.
* **MySQL:** Banco de dados relacional para armazenar os links (gerenciado via MySQL Workbench).
* **HTML5 / CSS3:** Para a estrutura e estilização básica do painel e da página pública.

## 📁 Estrutura do Código

O projeto foi organizado separando a lógica de negócios da camada de apresentação:
* `classes/`: Contém as classes que gerenciam a conexão (`Database.php`) e as regras/ações dos links (`Link.php`).
* Arquivos raiz: Páginas que o usuário acessa diretamente e scripts de processamento de formulários.

## 🔧 Como rodar o projeto localmente

### 1. Pré-requisitos
* Ter o PHP instalado na máquina (versão 8.0 ou superior recomendada).
* Ter o MySQL rodando localmente.

### 2. Configurar o Banco de Dados
Abra o seu gerenciador do MySQL (como o Workbench) e execute o script para criar a tabela:

```sql
CREATE DATABASE IF NOT EXISTS biolink_db;
USE biolink_db;

CREATE TABLE IF NOT EXISTS links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    url VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

### 3. Clonar e Rodar
Baixe ou clone este repositório na sua máquina.

Ajuste as credenciais de conexão com o banco de dados no arquivo classes/Database.php (se necessário).

Abra o terminal na raiz da pasta do projeto e suba o servidor embutido do PHP:

php -S localhost:8000

### 4. Acesse no seu navegador:

* Página pública: http://localhost:8000

* Painel de cadastro: http://localhost:8000/admin.php