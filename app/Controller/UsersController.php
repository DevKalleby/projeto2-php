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
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());

        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
    }

    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $user = $this->User->findById($id);
        $this->set('user', $user);

        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
    }

    public function add() {
    if ($this->request->is('post')) {
        $this->User->create();
        if ($this->User->save($this->request->data)) {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                echo json_encode([
                    'success' => true,
                    'message' => 'Usuário criado com sucesso',
                    'redirect' => Router::url(['controller' => 'users', 'action' => 'index'])
                ]);
                return;
            }
            $this->Session->setFlash('Usuário criado com sucesso');
            return $this->redirect(['action' => 'index']);
        } else {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                echo json_encode(['success' => false, 'message' => 'Erro ao criar usuário']);
                return;
            }
            $this->Session->setFlash('Erro ao criar usuário');
        }
    }

    // 🔑 Passa lista de grupos para a view
    $groups = $this->User->Group->find('list');
    $this->set(compact('groups'));
}

public function edit($id = null) {
    if (!$this->User->exists($id)) {
        throw new NotFoundException(__('Usuário inválido'));
    }

    if ($this->request->is(['post', 'put'])) {
        if ($this->User->save($this->request->data)) {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                echo json_encode([
                    'success' => true,
                    'message' => 'Usuário atualizado com sucesso',
                    'redirect' => Router::url(['controller' => 'users', 'action' => 'index'])
                ]);
                return;
            }
            $this->Session->setFlash('Usuário atualizado com sucesso');
            return $this->redirect(['action' => 'index']);
        } else {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                echo json_encode(['success' => false, 'message' => 'Erro ao atualizar usuário']);
                return;
            }
            $this->Session->setFlash('Erro ao atualizar usuário');
        }
    } else {
        $this->request->data = $this->User->findById($id);
    }

    // 🔑 Passa lista de grupos para a view
    $groups = $this->User->Group->find('list');
    $this->set(compact('groups'));
}


    public function delete($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete($id)) {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                echo json_encode(array('success' => true, 'message' => 'User deleted'));
                return;
            }
            $this->Session->setFlash(__('The user has been deleted.'));
        } else {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                echo json_encode(array('success' => false, 'message' => 'User could not be deleted'));
                return;
            }
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function login() {
    if ($this->request->is('post')) {
        if ($this->Auth->login()) {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                echo json_encode(array(
                    'success' => true,
                    'message' => 'Login realizado com sucesso',
                    'redirect' => Router::url(array('controller' => 'posts', 'action' => 'index'))
                ));
                return;
            }
            return $this->redirect($this->Auth->redirect());
        } else {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                echo json_encode(array('success' => false, 'message' => 'Usuário ou senha inválidos'));
                return;
            }
            $this->Session->setFlash('Usuário ou senha inválidos');
        }
    }
}


    public function logout() {
    if ($this->request->is('ajax')) {
        $this->autoRender = false;
        echo json_encode(array(
            'success' => true,
            'message' => 'Sessão encerrada',
            'redirect' => Router::url(array('controller' => 'users', 'action' => 'login'))
        ));
        return;
    }
    $this->Session->setFlash('Good-Bye');
    return $this->redirect($this->Auth->logout());
}

}