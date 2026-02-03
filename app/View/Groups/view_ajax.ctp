<div class="bg-indigo-50 p-6 rounded-2xl border-2 border-indigo-100">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-indigo-800 font-black uppercase tracking-tighter text-xl">
            Membros do Grupo: <?php echo h($group['Group']['name']); ?>
        </h3>
        <span class="bg-indigo-600 text-white text-[10px] font-bold px-3 py-1 rounded-full">
            <?php echo count($group['User']); ?> USUÁRIOS
        </span>
    </div>

    <?php if (!empty($group['User'])): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <?php foreach ($group['User'] as $user): ?>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-indigo-50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-black text-xs">
                            <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                        </div>
                        <span class="text-sm font-bold text-gray-800"><?php echo h($user['username']); ?></span>
                    </div>
                    <span class="text-[10px] text-gray-400 font-mono">ID #<?php echo $user['id']; ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-gray-500 italic text-sm p-4 bg-white rounded-xl border border-dashed border-gray-200 text-center">
            Nenhum usuário encontrado neste grupo.
        </p>
    <?php endif; ?>
</div>