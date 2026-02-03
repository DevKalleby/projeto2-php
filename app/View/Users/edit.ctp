<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">

    <h1 class="text-2xl font-bold mb-6 text-gray-800">
        Editar Usuário
    </h1>

    <?php
    echo $this->Form->create('User', array(
        'class' => 'space-y-4'
    ));
    ?>

	<?php
		echo $this->Form->input('id');
	?>


    <!-- USUÁRIO -->
    <div>
        <?php
        echo $this->Form->label('username', 'Usuário', array(
            'class' => 'block text-sm font-medium text-gray-700 mb-1'
        ));

        echo $this->Form->input('username', array(
            'label' => false,
            'class' => 'w-full border border-gray-300 rounded px-3 py-2
                        focus:outline-none focus:ring-2 focus:ring-blue-500'
        ));
        ?>
    </div>

    <!-- GRUPO -->
    <div>
        <?php
        echo $this->Form->label('group_id', 'Grupo', array(
            'class' => 'block text-sm font-medium text-gray-700 mb-1'
        ));

        echo $this->Form->input('group_id', array(
            'label' => false,
            'type' => 'select',
            'class' => 'w-full border border-gray-300 rounded px-3 py-2
                        focus:outline-none focus:ring-2 focus:ring-blue-500'
        ));
        ?>
    </div>

    <!-- BOTÕES -->
    <div class="flex justify-between items-center mt-6">

        <?php
        echo $this->Form->end(array(
            'label' => 'Salvar',
            'class' => 'bg-blue-600 text-white px-6 py-2 rounded
                        hover:bg-blue-700 transition'
        ));
        ?>

        <div class="space-x-2">

            <?php
            echo $this->Html->link(
                'Voltar',
                array('action' => 'index'),
                array(
                    'class' => 'bg-gray-300 text-gray-800 px-4 py-2 rounded
                                hover:bg-gray-400 transition'
                )
            );
            ?>

            <?php
            echo $this->Form->postLink(
                'Deletar',
                array('action' => 'delete', $this->Form->value('User.id')),
                array(
                    'class' => 'bg-red-600 text-white px-4 py-2 rounded
                                hover:bg-red-700 transition'
                ),
                'Tem certeza que deseja deletar este usuário?'
            );
            ?>

        </div>

    </div>

</div>
