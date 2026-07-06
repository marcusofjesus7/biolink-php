<?php
// Classe responsável por salvar e buscar links no banco.
// Ela agrupa tudo que diz respeito a um "link" em um só lugar.
class Link {
    // A conexão com o banco vem de fora e fica guardada aqui.
    private PDO $conn;

    // Dados do link que serão salvos.
    public string $titulo = '';
    public string $url = '';

    // Construtor: é chamado quando criamos um objeto Link.
    // Aqui recebemos a conexão do banco e guardamos para usar depois.
    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    // Método para salvar um link no banco.
    public function cadastrar(): bool {
        // SQL que insere os dados na tabela links.
        $query = "INSERT INTO links (titulo, url) VALUES (:titulo, :url)";
        $stmt = $this->conn->prepare($query);

        // Limpa caracteres simples para evitar problemas no HTML.
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->url = htmlspecialchars(strip_tags($this->url));

        // Substitui os placeholders pelos valores reais.
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':url', $this->url);

        // Executa o insert e retorna true ou false.
        return $stmt->execute();
    }

    // Método para buscar todos os links do banco e mostrar na página.
    public function listar(): array {
        // SQL para pegar os links mais recentes primeiro.
        $query = "SELECT * FROM links ORDER BY criado_em DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        // Retorna todos os resultados como array.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}