<?php
// Esta página é o painel de controle do projeto.
// Ela busca os links já cadastrados e mostra no formulário para o usuário ver.
require_once "class/database.php";
require_once "class/link.php";

// Abre a conexão com o banco.
$db = new Database();
$conexao = $db->connect();

// Cria o objeto Link e pega os links já salvos.
$linkObjeto = new Link($conexao);
$meusLinks = $linkObjeto->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Links</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-slate-800 p-6 rounded-2xl shadow-2xl border border-slate-700 animate__animated animate__fadeInUp">

        <div class="text-center mb-8">
            <div class="bg-indigo-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 shadow-lg shadow-indigo-500/50">
                <i class="fa-solid fa-link text-xl text-white"></i>
            </div>
            <h1 class="text-2xl font-bold">Painel de links</h1>
            <p class="text-slate-400 text-sm mt-1">Adicione links para a sua página pública</p>
        </div>

        <form action="backend/salvar.php" method="POST" class="space-y-4">

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Nome do botão</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                        <i class="fa-solid fa-font"></i>
                    </span>
                    <input type="text" name="titulo" required placeholder="Ex: GitHub"
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl py-2.5 pl-10 pr-4 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 transition-colors">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">URL</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                        <i class="fa-solid fa-globe"></i>
                    </span>
                    <input type="url" name="url" required placeholder="https://github.com/..."
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl py-2.5 pl-10 pr-4 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 transition-colors">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-medium py-2.5 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 shadow-lg shadow-indigo-600/30 flex items-center justify-center gap-2">
                <i class="fa-solid fa-plus text-sm"></i> Salvar link
            </button>
        </form>

        <hr class="border-slate-700 my-6">

        <div>
            <h2 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-3">Links salvos</h2>

            <div class="space-y-2 max-h-48 overflow-y-auto pr-1">
                <?php if (empty($meusLinks)): ?>
                    <p class="text-sm text-slate-500 italic text-center py-4">Nenhum link cadastrado ainda.</p>
                <?php else: ?>
                    <?php foreach($meusLinks as $link): ?>
                        <div class="flex items-center justify-between bg-slate-900/50 p-3 rounded-xl border border-slate-700/50">
                            <div class="truncate">
                                <p class="text-sm font-medium text-slate-200"><?= htmlspecialchars($link['titulo']) ?></p>
                                <p class="text-xs text-slate-500 truncate max-w-[250px]"><?= htmlspecialchars($link['url']) ?></p>
                            </div>
                            <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" class="text-indigo-400 hover:text-indigo-300 p-1">
                                <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>

</body>
</html>