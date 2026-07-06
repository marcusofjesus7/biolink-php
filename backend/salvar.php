<?php
// Este arquivo recebe o formulário do painel e salva o link no banco.
// Ele funciona como o "responsável por receber os dados e mandar para a classe".

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Se alguém abrir esse arquivo diretamente sem enviar o formulário, volta para o painel.
    header("Location: ../admin.php");
    exit;
}

// Importa as classes que serão usadas aqui.
require_once "../class/database.php";
require_once "../class/link.php";

// Cria um objeto da classe Database para abrir a conexão com o banco.
$database = new Database();
$db = $database->connect();

// Cria um objeto da classe Link, passando a conexão para ele.
$link = new Link($db);

// Pega os dados enviados pelo formulário e limpa espaços extras.
$link->titulo = trim($_POST['titulo'] ?? '');
$link->url = trim($_POST['url'] ?? '');

// Só salva se os dois campos estiverem preenchidos.
if ($link->titulo !== '' && $link->url !== '') {
    $link->cadastrar();
}

// Depois de salvar, volta para a página de administração.
header("Location: ../admin.php");
exit;