<?php
App::uses('AppController', 'Controller');

class PostsController extends AppController {

    public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();
        // Permite acesso público a index e view
        $this->Auth->allow('index', 'view');
    }

    public function index() {
        $this->Post->recursive = 0;
        $this->set('posts', $this->Paginator->paginate());

        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
    }

    public function view($id = null) {
        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid post'));
        }
        $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
        $this->set('post', $this->Post->find('first', $options));

        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                if ($this->request->is('ajax')) {
                    $this->autoRender = false;
                    echo json_encode(array('success' => true, 'message' => 'Post saved'));
                    return;
                }
                $this->Session->setFlash(__('The post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                if ($this->request->is('ajax')) {
                    $this->autoRender = false;
                    echo json_encode(array('success' => false, 'message' => 'Post could not be saved'));
                    return;
                }
                $this->Session->setFlash(__('The post could not be saved. Please, try again.'));
            }
        }
        $users = $this->Post->User->find('list');
        $this->set(compact('users'));
    }

    public function edit($id = null) {
        if (!$id || !$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                if ($this->request->is('ajax')) {
                    $this->autoRender = false;
                    echo json_encode(array('success' => true, 'message' => 'Post updated'));
                    return;
                }
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                if ($this->request->is('ajax')) {
                    $this->autoRender = false;
                    echo json_encode(array('success' => false, 'message' => 'Unable to update post'));
                    return;
                }
                $this->Session->setFlash(__('Unable to update your post.'));
            }
        } else {
            $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
            $this->request->data = $this->Post->find('first', $options);
        }

        $users = $this->Post->User->find('list');
        $this->set(compact('users'));
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->Post->delete($id)) {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                echo json_encode(array('success' => true, 'message' => 'Post deleted'));
                return;
            }
            $this->Session->setFlash(__('Post deleted successfully.'));
        } else {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                echo json_encode(array('success' => false, 'message' => 'Could not delete post'));
                return;
            }
            $this->Session->setFlash(__('Could not delete the post.'));
        }

        return $this->redirect(array('action' => 'index'));
    }
}