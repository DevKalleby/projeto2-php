<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Meu Projeto Cake</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <?php echo $this->fetch('content'); ?>
    </div>

    <script>
    $(document).ready(function() {
        // Intercepta o formulário de login para fazer via AJAX
        $(document).on('submit', 'form', function(e) {
            e.preventDefault();
            var formElement = $(this);
            
            $.ajax({
                type: formElement.attr('method'),
                url: formElement.attr('action'),
                data: formElement.serialize(),
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                success: function(response) {
                    console.log('Resposta:', response);
                    if (response.success) {
                            // Login bem-sucedido, redireciona para a página principal
                            var redirect = response.redirect || '/';
                            // Se não for URL absoluta, prefixa com origin
                            if (!/^https?:\/\//i.test(redirect) && redirect.charAt(0) !== '/') {
                                redirect = '/' + redirect;
                            }
                            if (!/^https?:\/\//i.test(redirect)) {
                                redirect = window.location.origin + redirect;
                            }
                            window.location.href = redirect;
                        } else {
                        // Erro de login, mostra mensagem
                        alert(response.message);
                        formElement[0].reset();
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Erro:', status, error);
                    console.log('Resposta:', xhr.responseText);
                    alert('Erro ao conectar ao servidor: ' + error);
                }
            });
        });
    });
    </script>
</body>
</html>
