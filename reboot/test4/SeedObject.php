<?php

include '../connect2.php';

class SeedObject {
	
	public $TFields = array();
	public $TErrors = array();

	public function __construct()
	{
		foreach ($this ->TFields AS $key =>$dummy) {
			$this-> {$key} = '';
		}
	}
	
	public function create($TData)
	{
		$MesKey = '';//string vide qui se rempli par la boucle foreach, permet de remplir les valeurs pour la requette sql
		$MesValeurs = '';

// 		$myKeys = implode(', ', array_keys($this->TFields)); Autre façon de faire pour concaténer 
// 		$TPreparedValues = array();
		
		$i = 0;
		
		foreach ($this->TFields as $key => $dummy)
		{
			// 			$TPreparedKeys[] = ':'.$key;; Autre façon de faire pour concaténer 
			if ($i != 0) {
				$MesKey = $MesKey.',';
				$MesValeurs = $MesValeurs.',';
			}
			$MesKey = $MesKey . $key;
			$MesValeurs = $MesValeurs . ':'.$key;

			if (isset($TData[$key])) {
				$this -> {$key} = $TData[$key];
			}
			$i ++;
		}
		
// 		$myValues = implode(', ', $TPreparedKeys); Autre façon de faire pour concaténer 
		
		global $bdd;//connexion à la bdd par une supervariable
		
		$sql = 'INSERT INTO '.$this->bddTable.'('.$MesKey.') VALUES ('.$MesValeurs.')';
		
		$req = $bdd->prepare($sql);
		$TParams = array_intersect_key(get_object_vars($this), $this->TFields);//cette fonction ne garde que les keys qui correspondent entre la bdd et mon $this
		
		$req->execute($TParams);

		$this -> id = $bdd -> lastInsertId();
	}
	
	public function fetchAll($TFilter = [])
	{
		$sql = 'SELECT id FROM '.$this->bddTable.' WHERE 1 ';

		foreach ($TFilter AS $key => $value) {
			$sql = $sql . ' AND ' .$key.' = "'.$value.'"';//ATTENTION AU QUOTES !!!!!!!!!
		}
		
		global $bdd;//connexion à la bdd par une supervariable
		
		$req = $bdd->query($sql);

		$TResults = $req->fetchAll(PDO::FETCH_ASSOC);
		$TOut = array();

		$classname = get_class($this);

		foreach ($TResults as $TObj)
		{
			$obj = new $classname();
			$obj->fetchOne($TObj['id']);
			$TOut[] = $obj;
		}
		return $TOut;
	}
	
	public function fetchOne($id)
	{	
		global $bdd;//connexion à la bdd par une supervariable
		
		$sql = 'SELECT * FROM ' .$this->bddTable. ' WHERE id = '.$id;
		$req = $bdd->query($sql);
		
		if ($req === false) {
			$this->TErrors[] = 'Bad SQL request';
			return -1;
		}
		
		$TResults = $req->fetch(PDO::FETCH_ASSOC);

		if ($TResults === false) {
			$this->TErrors[] = 'No entry in result set';
			return -2;
		}
		
		foreach ($TResults as $key => $value)
		{
			$this -> {$key} = $value;
		}

		return 1;
	}
	
	public function update($TData)
	{
		if ($this ->id <= 0 )
		{
			return;
		}
		global $bdd;//connexion à la bdd par une supervariable

		$stringSql = '';//string vide qui se rempli par la boucle foreach, permet de remplir les valeurs pour la requette sql

		$i = 0;
		
		foreach ($this->TFields as $key => $dummy)
		{
			if ($i != 0) {
				$stringSql = $stringSql .' , ';
			}
			$stringSql = $stringSql . $key . ' = :' . $key;
			
			if (isset($TData[$key])) {
				$this -> {$key} = $TData[$key];
			}
			$i ++;
		}
	
		$sql = 'UPDATE ' .$this->bddTable. ' SET ' .$stringSql.' WHERE id = ' .$this->id;

		$req = $bdd->prepare($sql);
		
		$TParams = array_intersect_key(get_object_vars($this), $this->TFields);//cette fonction ne garde que les keys qui correspondent entre la bdd et mon $this TFields

		$req->execute($TParams);
				
	}
	
	public function delete()
	{
		
		if ($this ->id <= 0 ) 
		{
			return;
		}
		
		global $bdd;//connexion à la bdd par une supervariable
		$sql = 'DELETE FROM ' .$this->bddTable. ' WHERE id = '.$this->id;

		$req = $bdd->query($sql);
		
	}
		
}
