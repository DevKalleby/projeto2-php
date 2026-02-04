<?php
App::uses('AppController', 'Controller');

class GroupsController extends AppController {

    public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();
        // Exemplo: permitir acesso público apenas a index e view
        $this->Auth->allow( 'view');
    }

    public function index() {
        $this->Group->recursive = 0;
        $this->set('groups', $this->Paginator->paginate());

        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
    }

    public function view($id = null) {
        if (!$this->Group->exists($id)) {
            throw new NotFoundException(__('Invalid group'));
        }
        $options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
        $this->set('group', $this->Group->find('first', $options));

        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                if ($this->request->is('ajax')) {
                    $this->autoRender = false;
                    echo json_encode(array('success' => true, 'message' => 'Group saved'));
                    return;
                }
                $this->Session->setFlash(__('The group has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                if ($this->request->is('ajax')) {
                    $this->autoRender = false;
                    echo json_encode(array('success' => false, 'message' => 'Group could not be saved'));
                    return;
                }
                $this->Session->setFlash(__('The group could not be saved.'));
            }
        }
    }

    public function edit($id = null) {
        if (!$this->Group->exists($id)) {
            throw new NotFoundException(__('Invalid group'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Group->save($this->request->data)) {
                if ($this->request->is('ajax')) {
                    $this->autoRender = false;
                    echo json_encode(array('success' => true, 'message' => 'Group updated'));
                    return;
                }
                $this->Session->setFlash(__('The group has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                if ($this->request->is('ajax')) {
                    $this->autoRender = false;
                    echo json_encode(array('success' => false, 'message' => 'Group could not be updated'));
                    return;
                }
                $this->Session->setFlash(__('The group could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
            $this->request->data = $this->Group->find('first', $options);
        }
    }

    public function delete($id = null) {
    $this->Group->id = $id;
    if (!$this->Group->exists()) {
        throw new NotFoundException(__('Grupo inválido'));
    }

    if ($this->request->is('post') || $this->request->is('delete')) {
        if ($this->Group->delete()) {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                echo json_encode([
                    'success' => true,
                    'message' => 'Grupo excluído com sucesso',
                    'redirect' => Router::url(['controller' => 'groups', 'action' => 'index'])
                ]);
                return;
            }
            $this->Session->setFlash(__('Grupo excluído com sucesso'));
            return $this->redirect(['action' => 'index']);
        } else {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                echo json_encode(['success' => false, 'message' => 'Erro ao excluir grupo']);
                return;
            }
            $this->Session->setFlash(__('Erro ao excluir grupo'));
            return $this->redirect(['action' => 'index']);
        }
    }
}
}