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
        <tbody>
            <?php foreach ($groups as $group): ?>
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2">
                    <?= h($group['Group']['id']); ?>
                </td>
                <td class="px-4 py-2">
                    <?= h($group['Group']['name']); ?>
                </td>
                <td class="px-4 py-2 text-center space-x-2">
                    <?= $this->Html->link(
                        'Editar',
                        array('action' => 'edit', $group['Group']['id']),
                        array('class' => 'text-blue-600 hover:underline')
                    ); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
