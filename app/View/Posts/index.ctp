<header class="mb-8">
    <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Feed de Publicações</h1>
    <p class="text-gray-500 font-medium italic">Visualize e gerencie os conteúdos recentes.</p>
</header>

<div class="grid grid-cols-1 gap-6">
    <?php foreach ($posts as $post): ?>
        <article class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-6">
                <h2 class="text-2xl font-bold text-gray-800 leading-tight">
                    <?php echo h($post['Post']['title']); ?>
                </h2>
                <div class="flex gap-2">
                    <?php echo $this->Html->link(
                        'Editar',
                        array('action' => 'edit', $post['Post']['id']),
                        array('class' => 'text-xs font-bold px-3 py-1 bg-gray-100 rounded-lg text-gray-600 hover:bg-indigo-600 hover:text-white transition-all')
                    ); ?>
                </div>
            </div>
            
            <p class="text-gray-600 leading-relaxed mb-6 italic">
                <?php echo h($post['Post']['body']); ?>
            </p>

            <footer class="pt-6 border-t border-gray-50 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="text-sm font-bold text-gray-400">
                        Postado por: <span class="text-gray-700"><?php echo h($post['User']['username']); ?></span>
                    </span>
                </div>
                <time class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                    <?php echo date('d/m/Y', strtotime($post['Post']['created'])); ?>
                </time>
            </footer>
        </article>
    <?php endforeach; ?>
</div>