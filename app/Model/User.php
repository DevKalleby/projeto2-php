<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
    public $belongsTo = array('Group');
    public $actsAs = array('Acl' => array('type' => 'requester'));

    //Deixar a senha criptografada antes de salvar
    public function beforeSave($options = array()) {
    if (!empty($this->data[$this->alias]['password'])) {
        $this->data[$this->alias]['password'] =
            AuthComponent::password($this->data[$this->alias]['password']);
    }
    return true;
}


    public function parentNode() {
        if (!$this->id && empty($this->data)) return null;
        $groupId = isset($this->data['User']['group_id']) ? $this->data['User']['group_id'] : $this->field('group_id');
        if (!$groupId) return null;
        return array('Group' => array('id' => $groupId));
    }
}