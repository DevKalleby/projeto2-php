<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $components = array(
    'Acl',
    'Auth' => array(
        'authorize' => array(
            'Actions' => array('actionPath' => 'controllers')
        )
    ),
    'Session',
    'Flash'
);

    public function beforeFilter() {
        $this->Auth->allow('login');
        $this->Auth->allow('display');
    }
}
