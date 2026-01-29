<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $components = array(
        'Paginator',
        'Session',
        'Auth',
        'Acl'
    );

    public function beforeFilter() {
        parent::beforeFilter();
        // Permite login e logout sempre
        $this->Auth->allow('login', 'logout');
        //$this->Auth->allow('add');
        // Permite temporariamente acessar initDB
        // Depois de rodar, comente ou remova esta linha
        //$this->Auth->allow('initDB');
    }

    /**
     * List users
     */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());
    }

    /**
     * View a single user
     */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $user = $this->User->findById($id);
        $this->set('user', $user);
    }

    /**
     * Add a new user
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    /**
     * Edit an existing user
     */
    public function edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->findById($id);
        }

        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    /**
     * Delete a user
     */
    public function delete($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__('The user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * Login user
     */
    public function login() {
    if ($this->request->is('post')) {
        if ($this->Auth->login()) {
            return $this->redirect($this->Auth->redirect());
        }
        $this->Session->setFlash('Usuário ou senha inválidos');
    }
}


    /**
     * Logout user
     */
    public function logout() {
        $this->Session->setFlash('Good-Bye');
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Função temporária para criar permissões ACL
     */
    /*
    public function initDB() {
        $group = $this->User->Group;

        // Permissão total para admins
        $group->id = 1;
        $this->Acl->allow($group, 'controllers');

        // Permissões para managers
        $group->id = 2;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Posts');
        $this->Acl->allow($group, 'controllers/Widgets');

        // Permissões limitadas para users
        $group->id = 3;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Posts/add');
        $this->Acl->allow($group, 'controllers/Posts/edit');
        $this->Acl->allow($group, 'controllers/Widgets/add');
        $this->Acl->allow($group, 'controllers/Widgets/edit');

        // Permitir logout
        $this->Acl->allow($group, 'controllers/users/logout');

        echo "all done";
        exit;
    }*/
    
}