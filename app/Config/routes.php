<?php
/**
 * Routes configuration - Projeto CakePHP 2.x + Tailwind
 */

/**
 * ROTA PRINCIPAL
 * Redireciona a raiz (/) diretamente para a tela de Login.
 */
Router::connect('/', array('controller' => 'posts', 'action' => 'index'));

/**
 * PÁGINAS ESTÁTICAS
 * Mantém o funcionamento de URLs como /pages/home ou outras páginas em View/Pages
 */
Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * CARREGAMENTO DE PLUGINS E PADRÕES
 */
CakePlugin::routes();

/**
 * Carrega as rotas padrão do core do CakePHP. 
 * Necessário para que /controller/action funcione automaticamente.
 */
require CAKE . 'Config' . DS . 'routes.php';