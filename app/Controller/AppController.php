<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            ),
            'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authError' => 'Você não tem permissão para acessar essa página.',
        ),
        'Session',
        'Flash'
    );

    public function beforeFilter() {
        // Permite acesso público a login e display
        $this->Auth->allow('login', 'display', 'logout');
        $this->Auth->deny();

        // Se a requisição for AJAX, usar layout ajax
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
    }
}