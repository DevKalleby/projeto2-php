<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * User Model
 *
 * @property Group $Group
 * @property Post $Post
 */
class User extends AppModel {

    /**
     * ACL Behavior
     */
    public $actsAs = array(
        'Acl' => array(
            'type' => 'requester',
            'enabled' => false
        )
    );

    /**
     * Validation rules
     */
    public $validate = array(
        'username' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Username cannot be empty.'
            ),
        ),
        'password' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Password cannot be empty.'
            ),
        ),
        'group_id' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Group ID must be numeric.'
            ),
        ),
    );

    /**
     * belongsTo associations
     */
    public $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id'
        )
    );

    /**
     * hasMany associations
     */
    public $hasMany = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'user_id'
        )
    );

    /**
     * ACL parent node
     */
    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }

        $groupId = isset($this->data['User']['group_id'])
            ? $this->data['User']['group_id']
            : $this->field('group_id');

        if (!$groupId) {
            return null;
        }

        return array('Group' => array('id' => $groupId));
    }

    /**
     * Hash password before saving
     */
    public function beforeSave($options = array()) {
        if (!empty($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password(
                $this->data['User']['password']
            );
        }
        return true;
    }

    /**
     * Bind user to ACL node
     */
    public function bindNode($user) {
        return array(
            'model' => 'Group',
            'foreign_key' => $user['User']['group_id']
        );
    }
}
