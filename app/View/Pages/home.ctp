<?php
if (!Configure::read('debug')):
    throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
?>

<div class="py-10 space-y-8">
    <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-3xl p-8 shadow-2xl text-white relative overflow-hidden">
        <div class="relative z-10">
            <h1 class="text-4xl font-extrabold tracking-tight">Painel de Controle</h1>
            <p class="text-slate-300 mt-2 text-lg">Status do sistema e verificações do CakePHP <?php echo Configure::version(); ?></p>
        </div>
        <div class="absolute top-[-20%] right-[-10%] w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
    </div>

    <?php if (file_exists(WWW_ROOT . 'css' . DS . 'cake.generic.css')): ?>
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm flex items-start space-x-3">
        <div class="flex-shrink-0 text-red-500 text-xl font-bold">⚠️</div>
        <div>
            <h4 class="text-red-800 font-bold">Aviso de URL Rewriting</h4>
            <p class="text-red-700 text-sm">O Apache não está reescrevendo URLs corretamente. 
                <a href="https://book.cakephp.org/2.0/en/installation/url-rewriting.html" target="_blank" class="underline font-bold hover:text-red-900 transition">Clique aqui para corrigir</a>.
            </p>
        </div>
    </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">PHP Version</p>
            <div class="flex items-center space-x-2">
                <?php if (version_compare(PHP_VERSION, '5.2.8', '>=')): ?>
                    <span class="flex-shrink-0 w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-xl font-bold text-gray-700"><?php echo PHP_VERSION; ?></span>
                <?php else: ?>
                    <span class="flex-shrink-0 w-3 h-3 bg-red-500 rounded-full"></span>
                    <span class="text-xl font-bold text-red-600">Upgrade Required</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Permissões TMP</p>
            <div class="flex items-center space-x-2">
                <?php if (is_writable(TMP)): ?>
                    <span class="text-green-600 font-bold text-lg">✓ Gravável</span>
                <?php else: ?>
                    <span class="text-red-600 font-bold text-lg">✕ Bloqueado</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Banco de Dados</p>
            <?php
                $dbPresent = file_exists(CONFIG . 'database.php');
                App::uses('ConnectionManager', 'Model');
                try {
                    $connected = $dbPresent ? ConnectionManager::getDataSource('default')->isConnected() : false;
                } catch (Exception $e) { $connected = false; }
            ?>
            <div class="flex items-center space-x-2">
                <span class="w-3 h-3 rounded-full <?php echo $connected ? 'bg-green-500' : 'bg-red-500'; ?>"></span>
                <span class="text-lg font-bold text-gray-700"><?php echo $connected ? 'Conectado' : 'Erro DB'; ?></span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">DebugKit Plugin</p>
            <div class="flex items-center space-x-2">
                <?php if (CakePlugin::loaded('DebugKit')): ?>
                    <span class="text-indigo-600 font-bold">Ativo</span>
                <?php else: ?>
                    <span class="text-gray-400 font-bold italic text-sm text-wrap">Não Instalado</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-200 overflow-hidden shadow-sm">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-lg font-bold text-gray-800">Recursos do Framework</h3>
        </div>
        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="https://book.cakephp.org/2.0/en/" target="_blank" class="group p-4 border border-gray-100 rounded-xl hover:bg-slate-50 transition-all">
                <div class="text-slate-800 font-bold group-hover:text-blue-600">Documentação Oficial →</div>
                <p class="text-xs text-gray-500 mt-1">Manual completo do CakePHP 2.x</p>
            </a>
            <a href="https://api.cakephp.org/2.x" target="_blank" class="group p-4 border border-gray-100 rounded-xl hover:bg-slate-50 transition-all">
                <div class="text-slate-800 font-bold group-hover:text-blue-600">Referência da API →</div>
                <p class="text-xs text-gray-500 mt-1">Busque classes e métodos</p>
            </a>
            <div class="p-4 bg-blue-50/50 rounded-xl border border-blue-100">
                <p class="text-xs text-blue-800 font-semibold mb-1">Local do Arquivo:</p>
                <code class="text-[10px] text-blue-900 bg-blue-100 px-1 py-0.5 rounded">APP/View/Pages/home.ctp</code>
            </div>
        </div>
    </div>
</div>