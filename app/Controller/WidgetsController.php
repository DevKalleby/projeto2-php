<?php
App::uses('AppController', 'Controller');

class WidgetsController extends AppController {

    public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();
        // Permite acesso público a index e view
        $this->Auth->allow('index', 'view');
    }

    public function index() {
        $this->Widget->recursive = 0;
        $this->set('widgets', $this->Paginator->paginate());

        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
    }

    public function view($id = null) {
        if (!$this->Widget->exists($id)) {
            throw new NotFoundException(__('Invalid widget'));
        }
        $options = array('conditions' => array('Widget.' . $this->Widget->primaryKey => $id));
        $this->set('widget', $this->Widget->find('first', $options));

        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Widget->create();
            if ($this->Widget->save($this->request->data)) {
                if ($this->request->is('ajax')) {
                    $this->autoRender = false;
                    echo json_encode(array('success' => true, 'message' => 'Widget saved'));
                    return;
                }
                $this->Session->setFlash(__('The widget has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                if ($this->request->is('ajax')) {
                    $this->autoRender = false;
                    echo json_encode(array('success' => false, 'message' => 'Widget could not be saved'));
                    return;
                }
                $this->Session->setFlash(__('The widget could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        if (!$this->Widget->exists($id)) {
            throw new NotFoundException(__('Invalid widget'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Widget->save($this->request->data)) {
                if ($this->request->is('ajax')) {
                    $this->autoRender = false;
                    echo json_encode(array('success' => true, 'message' => 'Widget updated'));
                    return;
                }
                $this->Session->setFlash(__('The widget has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                if ($this->request->is('ajax')) {
                    $this->autoRender = false;
                    echo json_encode(array('success' => false, 'message' => 'Widget could not be updated'));
                    return;
                }
                $this->Session->setFlash(__('The widget could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Widget.' . $this->Widget->primaryKey => $id));
            $this->request->data = $this->Widget->find('first', $options);
        }
    }

    public function delete($id = null) {
        if (!$this->Widget->exists($id)) {
            throw new NotFoundException(__('Invalid widget'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Widget->delete($id)) {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                echo json_encode(array('success' => true, 'message' => 'Widget deleted'));
                return;
            }
            $this->Session->setFlash(__('The widget has been deleted.'));
        } else {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                echo json_encode(array('success' => false, 'message' => 'Widget could not be deleted'));
                return;
            }
            $this->Session->setFlash(__('The widget could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}