<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">

    <h1 class="text-2xl font-bold mb-6 text-gray-800">
        Editar Post
    </h1>

    <?php
    echo $this->Form->create('Post', array(
        'class' => 'space-y-4'
    ));
    ?>

    <!-- TÍTULO -->
    <div>
        <?php
        echo $this->Form->label('title', 'Título', array(
            'class' => 'block text-sm font-medium text-gray-700 mb-1'
        ));

        echo $this->Form->input('title', array(
            'label' => false,
            'class' => 'w-full border border-gray-300 rounded px-3 py-2
                        focus:outline-none focus:ring-2 focus:ring-blue-500'
        ));
        ?>
    </div>

    <!-- CONTEÚDO -->
    <div>
        <?php
        echo $this->Form->label('body', 'Conteúdo', array(
            'class' => 'block text-sm font-medium text-gray-700 mb-1'
        ));

        echo $this->Form->textarea('body', array(
            'label' => false,
            'rows' => 6,
            'class' => 'w-full border border-gray-300 rounded px-3 py-2
                        focus:outline-none focus:ring-2 focus:ring-blue-500'
        ));
        ?>
    </div>

    <!-- AUTOR -->
    <div>
        <?php
        echo $this->Form->label('user_id', 'Autor', array(
            'class' => 'block text-sm font-medium text-gray-700 mb-1'
        ));

        echo $this->Form->input('user_id', array(
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
            echo $this->Form->Link(
    'Deletar',
    array('action' => 'delete', $this->request->data['Post']['id']),
    array(
        'class' => 'bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700'
    ),
    'Tem certeza que deseja deletar este post?'
);

            ?>

        </div>

    </div>

</div>

