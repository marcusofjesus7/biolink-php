<?php
// Esta página mostra os links salvos no banco para quem abrir a bio pública.
// Primeiro, carrega as classes que vão buscar os dados.
require_once "class/database.php";
require_once "class/link.php";

// Abre a conexão com o banco.
$db = new Database();
$conexao = $db->connect();

// Cria um objeto Link e pede para ele buscar os links salvos.
$linkObjeto = new Link($conexao);
$meusLinks = $linkObjeto->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Biolink</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col items-center justify-start p-6 pt-16">

    <div class="w-full max-w-md text-center mb-8 animate__animated animate__fadeInDown">
        <div class="w-24 h-24 bg-gradient-to-tr from-indigo-500 to-purple-600 rounded-full mx-auto p-1 shadow-xl shadow-indigo-500/20 mb-4">
            <div class="w-full h-full bg-slate-900 rounded-full flex items-center justify-center overflow-hidden">
                <i class="fa-solid fa-user text-3xl text-slate-400"></i>
            </div>
        </div>

        <h1 class="text-xl font-bold text-white">Seu nome</h1>
        <p class="text-sm text-indigo-400 font-medium">@seu_usuario</p>

        <p class="text-sm text-slate-400 mt-2 max-w-xs mx-auto">
            Links rápidos para o que eu compartilho por aí.
        </p>
    </div>

    <div class="w-full max-w-md space-y-4 animate__animated animate__fadeInUp animate__delay-1s">

        <?php if (empty($meusLinks)): ?>
            <div class="text-center p-8 bg-slate-900/40 rounded-2xl border border-slate-800 border-dashed">
                <i class="fa-solid fa-circle-exclamation text-slate-600 text-2xl mb-2"></i>
                <p class="text-sm text-slate-500 italic">Ainda não tem ninguém por aqui. Quando você adicionar links, eles aparecem aqui.</p>
            </div>
        <?php else: ?>
            <?php foreach($meusLinks as $link): ?>
                <a href="<?= htmlspecialchars($link['url']) ?>"
                   target="_blank"
                   class="w-full bg-slate-900 hover:bg-slate-800 border border-slate-800 hover:border-indigo-500/50 p-4 rounded-2xl flex items-center justify-between group transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-indigo-500/5 shadow-md">

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-slate-800 group-hover:bg-indigo-600/20 rounded-xl flex items-center justify-center text-slate-400 group-hover:text-indigo-400 transition-colors">
                            <i class="fa-solid fa-arrow-up-right-from-square text-sm"></i>
                        </div>
                        <span class="font-medium text-slate-200 group-hover:text-white transition-colors">
                            <?= htmlspecialchars($link['titulo']) ?>
                        </span>
                    </div>

                    <i class="fa-solid fa-chevron-right text-xs text-slate-600 group-hover:text-indigo-400 transition-colors transform group-hover:translate-x-1 duration-300"></i>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>

    <footer class="mt-auto pt-12 text-center text-xs text-slate-600 animate__animated animate__fadeIn animate__delay-2s">
        <p>Feito com PHP e um pouco de carinho.</p>
    </footer>

</body>
</html>