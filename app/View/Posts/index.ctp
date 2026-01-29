<div class="flex flex-col md:flex-row gap-6 p-6 bg-gray-50 min-h-screen font-sans">
    
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
                <?php echo $this->Html->link('👥 Lista de Usuários', array('controller' => 'users', 'action' => 'index'), array('class' => 'flex items-center gap-2 p-3 rounded-xl hover:bg-gray-50 text-gray-700 font-bold transition-all')); ?>
                <?php echo $this->Html->link('🛡️ Grupos de Acesso', array('controller' => 'groups', 'action' => 'index'), array('class' => 'flex items-center gap-2 p-3 rounded-xl hover:bg-gray-50 text-gray-700 font-bold transition-all')); ?>
                <?php echo $this->Html->link('➕ Criar Novo Post', array('action' => 'add'), array('class' => 'flex items-center gap-2 p-3 rounded-xl bg-emerald-50 text-emerald-700 font-bold hover:bg-emerald-100 transition-all')); ?>
                
                <hr class="my-2 border-gray-50">
                
                <?php echo $this->Html->link('🚪 Encerrar Sessão', array('controller' => 'users', 'action' => 'logout'), array('class' => 'flex items-center gap-2 p-3 rounded-xl text-red-400 hover:text-red-600 font-bold transition-all text-sm')); ?>
            </nav>
        </div>
    </aside>

    <main class="w-full md:w-3/4">
        <header class="mb-8">
            <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Feed de Publicações</h1>
            <p class="text-gray-500 font-medium italic">Visualize e gerencie os conteúdos recentes.</p>
        </header>

        <div class="grid grid-cols-1 gap-6">
            <?php foreach ($posts as $post): ?>
                <article class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 leading-tight"><?php echo h($post['Post']['title']); ?></h2>
                        <div class="flex gap-2">
                            <?php echo $this->Html->link('Editar', array('action' => 'edit', $post['Post']['id']), array('class' => 'text-xs font-bold px-3 py-1 bg-gray-100 rounded-lg text-gray-600 hover:bg-indigo-600 hover:text-white transition-all')); ?>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 leading-relaxed mb-6 italic">
                        <?php echo h($post['Post']['body']); ?>
                    </p>

                    <footer class="pt-6 border-t border-gray-50 flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="text-sm font-bold text-gray-400">Postado por: <span class="text-gray-700"><?php echo h($post['User']['username']); ?></span></span>
                        </div>
                        <time class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                            <?php echo date('d/m/Y', strtotime($post['Post']['created'])); ?>
                        </time>
                    </footer>
                </article>
            <?php endforeach; ?>
        </div>
    </main>
</div>