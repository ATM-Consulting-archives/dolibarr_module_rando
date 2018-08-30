<?php

include '../connect2.php';

//Ma classe mere dont extends toutes les classes
class SeedObject {

	// Descripteurs
	// propriétés définie par les classes en interne

	public $bddTable;
	public $TFields = array();
	public $TReferences = array();

	// Données
	// données commune à toutes mes classes
	public $id;

	// Gestion d'erreurs
	public $TErrors = array();

	public function __construct()
	{
		foreach ($this ->TFields AS $key =>$dummy) {
			$this-> {$key} = '';
		}
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////CREATE

	public function create($TData)
	{
		global $bdd;//connexion à la bdd par une supervariable
		
		$MesKey = '';//string vide qui se rempli par la boucle foreach, permet de remplir les valeurs pour la requette sql
		$MesValeurs = '';

// 		$myKeys = implode(', ', array_keys($this->TFields)); Autre façon de faire pour concaténer la requete sql
// 		$TPreparedValues = array();
		
//		Preparation de la requete sql en fonction de l'objet à créer
		$i = 0;
		foreach ($this->TFields as $key => $dummy)
		{
			
// 		$TPreparedKeys[] = ':'.$key;; Autre façon de faire pour concaténer la requete sql

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
				
		$sql = 'INSERT INTO '.$this->bddTable.'('.$MesKey.') VALUES ('.$MesValeurs.')';
		
		$req = $bdd->prepare($sql);
		
		$TParams = array_intersect_key(get_object_vars($this), $this->TFields);//cette fonction ne garde que les keys qui correspondent entre la bdd et mon $this
		
		$req->execute($TParams);

		$this -> id = $bdd -> lastInsertId();//récupération de la derniére entrée dans la bdd
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////UPDATE

	public function update($TData)
	{
		global $bdd;//connexion à la bdd par une supervariable
		if ($this ->id <= 0 )
		{
			return;
		}

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
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////DELETE
	
	public function delete()
	{
		if ($this ->id <= 0 ) //si aucune id n'est presente (aucun objet chargé)
		{
			return;
		}
		
		global $bdd;//connexion à la bdd par une supervariable
		$sql = 'DELETE FROM ' .$this->bddTable. ' WHERE id = '.$this->id;

		$bdd->query($sql);
	}
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////FETCHALL

	public function fetchAll($TFilter = [])
	{
		global $bdd;//connexion à la bdd par une supervariable

		$sql = 'SELECT id FROM '.$this->bddTable.' WHERE 1 ';
		foreach ($TFilter AS $key => $value) {
			$sql = $sql . ' AND ' .$key.' = "'.$value.'"';//ATTENTION AU QUOTES !!!!!!!!!
		}
		
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
	
////////////////////////////////////////////////////////////////////////////FETCHONE

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
		
		if(! empty($this->TReferences)) {
			$this -> fetchReferences();
		}

		return 1;
	}

////////////////////////////////////////////////////////////////////////////FETCHREFERENCE
	
	public function fetchReferences ()
	{
		if ($this ->id <= 0)
		{
			return;
		}

		foreach($this->TReferences AS $key => $value) {
			$obj = new $key();

			$TFilter = array($value => $this->id);
			$newvar = 'T'.$key.'s';

			$this -> $newvar = $obj-> fetchAll($TFilter);
		}
	}
	
}
	

