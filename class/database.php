<?php
// Classe responsável por abrir a conexão com o banco de dados.
// Pense nela como um "porteiro" que entrega a ligação com o MySQL para o resto do sistema.
class Database {
    // Configurações básicas da conexão.
    private string $host = "localhost";
    private string $dbname = "biolink_db";
    private string $username = "root";
    private string $password = "";

    // Guarda a conexão criada para não abrir várias vezes.
    private ?PDO $conn = null;

    // Método que cria e devolve a conexão.
    public function connect(): ?PDO {
        // Se já existe uma conexão aberta, usa ela de novo.
        if ($this->conn !== null) {
            return $this->conn;
        }

        try {
            // Monta a string de conexão com o banco.
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8mb4";

            // Configurações extras do PDO para deixar tudo mais seguro.
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            // Cria a conexão de verdade.
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            // Se der errado, mostra a mensagem do erro e para a execução.
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }

        return $this->conn;
    }
}