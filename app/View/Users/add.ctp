<div class="max-w-4xl mx-auto py-8">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        
        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-tight">Novo Usuário</h2>
            <p class="text-sm text-gray-500">Preencha os dados abaixo para criar uma nova conta de acesso.</p>
        </div>

        <div class="p-8">
            <?php echo $this->Form->create('User', array(
                'class' => 'space-y-6',
                'inputDefaults' => array(
                    'div' => 'flex flex-col gap-1',
                    'label' => array('class' => 'text-sm font-semibold text-gray-700'),
                    'class' => 'w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all placeholder-gray-400'
                )
            )); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php
                    echo $this->Form->input('username', array(
                        'label' => 'Nome de Usuário',
                        'placeholder' => 'Ex: joao.silva'
                    ));

                    echo $this->Form->input('password', array(
                        'label' => 'Senha de Acesso',
                        'placeholder' => '••••••••'
                    ));
                ?>
            </div>

            <div class="w-full md:w-1/2">
                <?php
                    echo $this->Form->input('group_id', array(
                        'label' => 'Nível de Permissão (Grupo)',
                        'class' => 'w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all cursor-pointer'
                    ));
                ?>
            </div>

            <div class="pt-6 border-t border-gray-100 flex items-center justify-between">
                <?php echo $this->Html->link('Cancelar e Voltar', array('action' => 'index'), array('class' => 'text-gray-500 hover:text-gray-700 font-medium transition-colors')); ?>
                
                <?php echo $this->Form->submit('Salvar Usuário', array(
                    'class' => 'bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-md hover:shadow-lg transition-all transform active:scale-95 cursor-pointer'
                )); ?>
            </div>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>

    <div class="mt-8 flex flex-wrap gap-4 justify-center">
        <?php echo $this->Html->link('Listar Grupos', array('controller' => 'groups', 'action' => 'index'), array('class' => 'text-xs font-bold text-indigo-600 bg-indigo-50 px-4 py-2 rounded-full hover:bg-indigo-100 transition-all uppercase tracking-wider')); ?>
        <?php echo $this->Html->link('Ver Posts', array('controller' => 'posts', 'action' => 'index'), array('class' => 'text-xs font-bold text-indigo-600 bg-indigo-50 px-4 py-2 rounded-full hover:bg-indigo-100 transition-all uppercase tracking-wider')); ?>
    </div>
</div>