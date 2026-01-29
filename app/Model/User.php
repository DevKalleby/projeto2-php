<?php
App::uses('AppModel', 'Model');
class User extends AppModel {
    public $belongsTo = array('Group');
    public $actsAs = array('Acl' => array('type' => 'requester'));

    public function parentNode() {
        if (!$this->id && empty($this->data)) return null;
        $groupId = isset($this->data['User']['group_id']) ? $this->data['User']['group_id'] : $this->field('group_id');
        if (!$groupId) return null;
        return array('Group' => array('id' => $groupId));
    }
}