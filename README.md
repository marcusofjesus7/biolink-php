# Biolink PHP

Um projeto simples em PHP para reunir links em uma página só, como uma bio para redes sociais. A ideia é cadastrar os links pelo painel e exibi-los na página pública.

## O que tem aqui

- Um painel para adicionar links
- Uma página pública com botões para cada link
- Conexão com MySQL usando PDO

## Como rodar localmente

1. Crie o banco de dados e a tabela:

```sql
CREATE DATABASE IF NOT EXISTS biolink_db;
USE biolink_db;

CREATE TABLE IF NOT EXISTS links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    url VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

2. Ajuste as credenciais no arquivo [class/database.php](class/database.php) se necessário.
3. Na raiz do projeto, rode:

```bash
php -S localhost:8000
```

4. Acesse:

- Página pública: http://localhost:8000
- Painel: http://localhost:8000/admin.php