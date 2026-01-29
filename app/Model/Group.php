<?php
App::uses('AppModel', 'Model');

/**
 * Group Model
 *
 * @property User $User
 */
class Group extends AppModel {

	/**
	 * ACL Behavior
	 */
	public $actsAs = array(
		'Acl' => array('type' => 'requester')
	);

	/**
	 * Validation rules
	 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => 'notBlank'
			),
		),
	);

	/**
	 * hasMany associations
	 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'group_id'
		)
	);

	/**
	 * ACL parent node
	 */
	public function parentNode() {
		return null;
	}
}