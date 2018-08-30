<?php 

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