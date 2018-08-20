<?php

if (!class_exists('SeedObject'))
{
	/**
	 * Needed if $form->showLinkedObjectBlock() is call
	 */
	define('INC_FROM_DOLIBARR', true);
	require_once dirname(__FILE__).'/../config.php';
}


class wayPoint extends SeedObject
{
	
	public $table_element = 'wayPoint';

	public $element = 'wayPoint';
	
	public function __construct($db)
	{
		global $conf,$langs;
		
		$this->db = $db;
		
		$this->fields=array(
				'lattitude'=>array('type'=>'string')
				,'longitude'=>array('type'=>'string')
				,'fk_rando'=>array('type'=>'int')
				,'entity'=>array('type'=>'integer','index'=>true)
		);
		
		$this->init();
		

		$this->entity = $conf->entity;
	}

	public function save()
	{
		global $user;
		
		if (!$this->id) $this->fk_user_author = $user->id;
		
		$res = $this->id>0 ? $this->updateCommon($user) : $this->createCommon($user);
		
		return $res;
	}
	
	
	public function loadBy($value, $field, $annexe = false)
	{
		$res = parent::loadBy($value, $field, $annexe);
		
		return $res;
	}
	
	public function load($id, $ref, $loadChild = true)
	{
		global $db;
		
		$res = parent::fetchCommon($id, $ref);
		
		if ($loadChild) $this->fetchObjectLinked();
		
		return $res;
	}
	
	public function delete(User &$user)
	{
		
		$this->deleteObjectLinked();
		
		parent::deleteCommon($user);
	}
	
}


