<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">
            Grupos
        </h2>

        <?php
        echo $this->Html->link(
            'Novo Grupo',
            array('action' => 'add'),
            array(
                'class' => 'bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition'
            )
        );
        ?>
    </div>

    <table class="min-w-full border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">ID</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nome</th>
                <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 italic">
    <?php foreach ($groups as $group): ?>
    <?php
        $badgeStyle = 'bg-gray-100 text-gray-600'; // Default
        if ($group['Group']['id'] == 1) $badgeStyle = 'bg-red-100 text-red-700 border border-red-200'; // Admin
        if ($group['Group']['id'] == 2) $badgeStyle = 'bg-blue-100 text-blue-700 border border-blue-200'; // Manager
        if ($group['Group']['id'] == 3) $badgeStyle = 'bg-green-100 text-green-700 border border-green-200'; // User
    ?>
    <tr class="hover:bg-indigo-50/30 transition-colors">
        <td class="px-6 py-4 font-bold text-gray-700">
            <span class="px-3 py-1 rounded-full text-xs font-extrabold uppercase <?php echo $badgeStyle; ?>">
                <?php echo h($group['Group']['name']); ?>
            </span>
        </td>
        <td class="px-6 py-4 text-sm text-gray-500">
            Criado em: <?php echo date('d/m/Y H:i', strtotime($group['Group']['created'])); ?>
        </td>
        <td class="px-6 py-4 text-center space-x-2">
            <?php echo $this->Html->link('Editar', ['action' => 'edit', $group['Group']['id']], ['class' => 'text-indigo-600 hover:text-indigo-900 font-bold text-sm underline']); ?>
            <?php echo $this->Form->postLink('Excluir', ['action' => 'delete', $group['Group']['id']], ['class' => 'text-red-500 hover:text-red-700 font-bold text-sm underline', 'confirm' => __('Deseja realmente excluir o grupo %s?', $group['Group']['name'])]); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
    </table>

</div>
