Projeto CakePHP 2 com sistema de **login, logout e ACL** configurado para diferentes grupos de usuários (Admin, Manager, User).

---

## Permissões básicas

| Grupo      | Permissões                                      |
|-----------|------------------------------------------------|
| Admin      | Acesso completo a todas as controllers       |
| Manager    | Acesso completo a Posts e Widgets            |
| User       | Apenas `add` e `edit` em Posts e Widgets, logout |
| Visitante  | Pode visualizar `index` e `view` de Posts/Widgets e a página inicial (`PagesController::display`) |

---

## Requisitos

- PHP 5.6+  
- CakePHP 2.x  
- MySQL (ou outro banco compatível)

---

## Configuração rápida

1. Clone o repositório:

```bash
git clone https://github.com/USERNAME/REPO.git
cd REPO
Configure o banco de dados:

Copie app/Config/database.php.default para database.php

Atualize usuário, senha e nome do banco

public $default = array(
    'datasource' => 'Database/Mysql',
    'persistent' => false,
    'host' => 'localhost',
    'login' => 'root',
    'password' => '',
    'database' => 'cake_acl',
    'prefix' => '',
);
(Opcional) Inicialize ACL:

Descomente temporariamente initDB() no UsersController e acesse no navegador:

http://localhost:8080/users/initDB
Depois comente/remova a função e a linha $this->Auth->allow('initDB');

Rode o servidor embutido do PHP:

cd app
php -S localhost:8080
Acesse em: http://localhost:8080

Login/Logout
Use os usuários cadastrados no banco.

Logout exibe a mensagem: Good-Bye.

Observações
Arquivos sensíveis (database.php) e temporários (tmp) estão no .gitignore.

Plugins e vendors não são enviados; instale manualmente se necessário.