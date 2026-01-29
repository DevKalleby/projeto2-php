<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    
    <script src="https://cdn.tailwindcss.com"></script>

    <?php
        echo $this->Html->meta('icon');
        // Comentei o generic para não dar conflito, mas você pode remover se quiser
        // echo $this->Html->css('cake.generic'); 

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans">

    <div id="container" class="min-h-screen flex flex-col">
        
        <header class="bg-white shadow-sm py-4 px-6 border-b border-gray-200">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold text-indigo-600">
                    <?php echo $this->Html->link('Meu Projeto Cake', '/', array('class' => 'hover:text-indigo-800 transition')); ?>
                </h1>
                <nav class="space-x-4">
                    <a href="#" class="text-gray-600 hover:text-indigo-600">Dashboard</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600">Sair</a>
                </nav>
            </div>
        </header>

        <main id="content" class="flex-grow container mx-auto p-6">
            <div class="mb-4">
                <?php echo $this->Flash->render(); ?>
            </div>

            <?php echo $this->fetch('content'); ?>
        </main>

        <footer class="bg-white border-t border-gray-200 py-6 mt-10">
            <div class="container mx-auto px-6 text-center text-sm text-gray-500">
                <p>&copy; <?php echo date('Y'); ?> - Desenvolvido com CakePHP <?php echo Configure::version(); ?></p>
            </div>
        </footer>
    </div>

    <?php echo $this->element('sql_dump'); ?>
</body>
</html>