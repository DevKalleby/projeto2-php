<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow">

    <h2 class="text-2xl font-semibold mb-6 text-gray-800">
        Novo Grupo
    </h2>

    <?php
    echo $this->Form->create('Group');

    echo $this->Form->input('name', array(
        'label' => 'Nome do grupo',
        'placeholder' => 'Ex: Administrador',
        'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm
                    focus:border-blue-500 focus:ring focus:ring-blue-200'
    ));

    echo $this->Form->end(array(
        'label' => 'Salvar',
        'class' => 'mt-6 w-full bg-blue-600 text-white py-2 px-4 rounded
                    hover:bg-blue-700 transition'
    ));
    ?>

    <div class="mt-4 text-center">
        <?php
        echo $this->Html->link(
            'Voltar',
            array('action' => 'index'),
            array('class' => 'text-blue-600 hover:underline')
        );
        ?>
    </div>

</div>
