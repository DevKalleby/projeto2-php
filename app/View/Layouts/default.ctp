<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->fetch('title'); ?></title>
    
    <script src="https://cdn.tailwindcss.com"></script>

    <?php
        echo $this->Html->meta('icon');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans">

    <div id="container" class="min-h-screen flex flex-col">
        
        <!-- Cabeçalho -->
        <header class="bg-white shadow-sm py-4 px-6 border-b border-gray-200">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold text-indigo-600">
                    <?php echo $this->Html->link('Meu Projeto Cake', '/', array('class' => 'hover:text-indigo-800 transition')); ?>
                </h1>
                <nav class="space-x-4">
                    <a href="#" class="text-gray-600 hover:text-indigo-600">Dashboard</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600">Sair</a>
                </nav>
            </div>
        </header>

        <!-- Conteúdo principal com duas colunas -->
        <main class="flex-grow container mx-auto p-6 flex flex-col md:flex-row gap-6">
            
            <!-- Menu lateral fixo -->
            <aside class="w-full md:w-1/4 space-y-6">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                            <?php echo strtoupper(substr($this->Session->read('Auth.User.username'), 0, 1)); ?>
                        </div>
                        <div>
                            <h3 class="text-sm font-black text-gray-400 uppercase tracking-widest">Usuário</h3>
                            <p class="text-lg font-bold text-gray-800"><?php echo h($this->Session->read('Auth.User.username')); ?></p>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-gray-50 text-xs font-bold text-indigo-500 italic">
                        Sessão Ativa
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6">Administração</h3>
                    <nav class="flex flex-col gap-3">
                        <?php echo $this->Html->link('👥 Lista de Usuários', ['controller' => 'users', 'action' => 'index'], ['class' => 'flex items-center gap-2 p-3 rounded-xl hover:bg-gray-50 text-gray-700 font-bold transition-all']); ?>
                        <?php echo $this->Html->link('🛡️ Grupos de Acesso', ['controller' => 'groups', 'action' => 'index'], ['class' => 'flex items-center gap-2 p-3 rounded-xl hover:bg-gray-50 text-gray-700 font-bold transition-all']); ?>
                        <?php echo $this->Html->link('📝 Lista de Posts', ['controller' => 'posts', 'action' => 'index'], ['class' => 'flex items-center gap-2 p-3 rounded-xl hover:bg-gray-50 text-gray-700 font-bold transition-all']); ?>
                        <?php echo $this->Html->link('➕ Criar Novo Post', ['controller' => 'posts', 'action' => 'add'], ['class' => 'flex items-center gap-2 p-3 rounded-xl bg-emerald-50 text-emerald-700 font-bold hover:bg-emerald-100 transition-all']); ?>
                        
                        <hr class="my-2 border-gray-50">
                        
                        <?php
                        echo $this->Form->postLink(
                            '🚪 Encerrar Sessão',
                            ['controller' => 'users', 'action' => 'logout'],
                            ['class' => 'flex items-center gap-2 p-3 rounded-xl text-red-400 hover:text-red-600 font-bold transition-all text-sm'],
                            __('Tem certeza que deseja sair?')
                        );
                        ?>
                    </nav>
                </div>
            </aside>

            <!-- Área dinâmica SPA -->
            <section id="spa-content" class="w-full md:w-3/4">
                <div class="mb-4">
                    <?php echo $this->Session->flash(); ?>
                </div>
                <?php echo $this->fetch('content'); ?>
            </section>
        </main>

        <!-- Rodapé -->
        <footer class="bg-white border-t border-gray-200 py-6 mt-10">
            <div class="container mx-auto px-6 text-center text-sm text-gray-500">
                <p>&copy; <?php echo date('Y'); ?> - Desenvolvido com CakePHP <?php echo Configure::version(); ?></p>
            </div>
        </footer>
    </div>

    <?php echo $this->element('sql_dump'); ?>
</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', function() {

    function bindLinks() {
        document.querySelectorAll('#spa-content a').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.href.includes(window.location.host)) {
                    e.preventDefault();
                    carregarConteudo(this.href);
                }
            });
        });
    }

    function bindForms() {
        document.querySelectorAll('#spa-content form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let data = new FormData(form);

                fetch(form.action, {
                    method: form.method,
                    body: data,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        if (result.redirect) {
                            carregarConteudo(result.redirect);
                        }
                    } else {
                        alert(result.message);
                    }
                });
            });
        });
    }

    function bindDeleteLinks() {
        document.querySelectorAll('#spa-content .delete-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                if (!confirm('Deseja realmente excluir este item?')) return;

                fetch(this.href, {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success && result.redirect) {
                        carregarConteudo(result.redirect);
                    } else {
                        alert(result.message);
                    }
                });
            });
        });
    }

    function carregarConteudo(url) {
        document.querySelector('#spa-content').innerHTML = '<p>Carregando...</p>';
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.text())
            .then(html => {
                document.querySelector('#spa-content').innerHTML = html;
                history.pushState(null, '', url);
                bindLinks();
                bindForms();
                bindDeleteLinks();
            });
    }

    // intercepta links iniciais
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.href.includes(window.location.host)) {
                e.preventDefault();
                carregarConteudo(this.href);
            }
        });
    });

    // suporte ao botão voltar/avançar
    window.addEventListener('popstate', function() {
        carregarConteudo(location.href);
    });

    // intercepta logout
    document.addEventListener('submit', function(e) {
        if (e.target.action.includes('/users/logout')) {
            e.preventDefault();
            fetch(e.target.action, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(result => {
                if (result.success && result.redirect) {
                    carregarConteudo(result.redirect);
                }
            });
        }
    });

});
</script>