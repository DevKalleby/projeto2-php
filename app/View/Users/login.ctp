<div class="min-h-[60vh] flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Acessar Sistema</h2>

        <?php
        echo $this->Form->create('User', array(
        'class' => 'space-y-5',
        'id' => 'login-form'
        ));

        // Estilizando o campo de Usuário
        echo $this->Form->input('username', array(
            'label' => array('class' => 'block text-sm font-semibold text-gray-700 mb-1', 'text' => 'Usuário'),
            'class' => 'w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all',
            'div' => false, // Removemos a div padrão para ter controle total
            'placeholder' => 'Digite seu usuário'
        ));

        // Estilizando o campo de Senha
        echo $this->Form->input('password', array(
            'label' => array('class' => 'block text-sm font-semibold text-gray-700 mb-1', 'text' => 'Senha'),
            'class' => 'w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all',
            'div' => false,
            'placeholder' => '••••••••'
        ));
        ?>

        <div class="pt-2">
            <?php
            // O Form->end gera o botão. Passamos as classes de botão moderno do Tailwind.
            echo $this->Form->submit('Entrar no Painel', array(
                'class' => 'w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-md hover:shadow-lg transition-all transform active:scale-[0.98]'
            ));
            echo $this->Form->end();
            ?>
        </div>

    </div>
</div>