<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <div>
            <h2 class="text-xl font-bold text-gray-800 uppercase tracking-tight">Gerenciamento de Usuários</h2>
            <p class="text-sm text-gray-500">Lista de contas e níveis de acesso ao sistema</p>
        </div>
        <?php echo $this->Html->link('<span>+</span> Novo Usuário', array('action' => 'add'), array('class' => 'bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-bold transition-all flex items-center gap-2 shadow-md', 'escape' => false)); ?>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-gray-400 text-xs uppercase tracking-widest bg-gray-50/30">
                    <th class="px-6 py-4 font-semibold"><?php echo $this->Paginator->sort('id', '#'); ?></th>
                    <th class="px-6 py-4 font-semibold"><?php echo $this->Paginator->sort('username', 'Usuário'); ?></th>
                    <th class="px-6 py-4 font-semibold"><?php echo $this->Paginator->sort('group_id', 'Grupo'); ?></th>
                    <th class="px-6 py-4 font-semibold"><?php echo $this->Paginator->sort('created', 'Criado em'); ?></th>
                    <th class="px-6 py-4 font-semibold text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 italic">
                <?php foreach ($users as $user): ?>
                <tr class="hover:bg-indigo-50/30 transition-colors">
                    <td class="px-6 py-4 text-gray-500 font-mono text-sm"><?php echo h($user['User']['id']); ?></td>
                    <td class="px-6 py-4 font-bold text-gray-700"><?php echo h($user['User']['username']); ?></td>
                    <td class="px-6 py-4">
                        <?php 
                            // Lógica de cores baseada no ID do Grupo que vimos no seu UsersController
                            $badgeStyle = 'bg-gray-100 text-gray-600'; // Default
                            if ($user['User']['group_id'] == 1) $badgeStyle = 'bg-red-100 text-red-700 border border-red-200'; // Admin
                            if ($user['User']['group_id'] == 2) $badgeStyle = 'bg-blue-100 text-blue-700 border border-blue-200'; // Manager
                            if ($user['User']['group_id'] == 3) $badgeStyle = 'bg-green-100 text-green-700 border border-green-200'; // User
                        ?>
                        <span class="px-3 py-1 rounded-full text-xs font-extrabold uppercase <?php echo $badgeStyle; ?>">
                            <?php echo h($user['Group']['name']); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500"><?php echo date('d/m/Y H:i', strtotime($user['User']['created'])); ?></td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <?php echo $this->Html->link('Editar', array('action' => 'edit', $user['User']['id']), array('class' => 'text-indigo-600 hover:text-indigo-900 font-bold text-sm underline')); ?>
                        <?php echo $this->Form->postLink('Excluir', array('action' => 'delete', $user['User']['id']), array('class' => 'text-red-500 hover:text-red-700 font-bold text-sm underline', 'confirm' => __('Deseja realmente excluir o usuário %s?', $user['User']['username']))); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-between items-center text-sm text-gray-500">
        <div><?php echo $this->Paginator->counter(array('format' => __('Página {:page} de {:pages}'))); ?></div>
        <div class="flex gap-2">
            <?php echo $this->Paginator->prev('← Anterior', array('class' => 'px-3 py-1 bg-white border border-gray-300 rounded hover:bg-gray-100'), null, array('class' => 'hidden')); ?>
            <?php echo $this->Paginator->next('Próxima →', array('class' => 'px-3 py-1 bg-white border border-gray-300 rounded hover:bg-gray-100'), null, array('class' => 'hidden')); ?>
        </div>
    </div>
</div>