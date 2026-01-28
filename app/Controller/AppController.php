<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $components = array(
        'Session',
        'Acl',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User',
                    'fields' => array(
                        'username' => 'username',
                        'password' => 'password'
                    )
                )
            ),
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'loginRedirect' => array(
                'controller' => 'posts',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            //'authorize' => array(
              //  'Actions' => array('actionPath' => 'controllers')
            //)
        )
    );

    public function beforeFilter() {
        $this->Auth->allow('login');
        $this->Auth->allow('display');
    }
}
