<?php

class BaseDeDonnees
{
	private $server = "";
	private $dbName = "";
	private $user = "";
	private $pwd = "";
	
	var $link = null;
	
	var $key = "";
	
	/**
	 * Constructeur
	 * @param type $valServer Adresse du serveur
	 * @param type $valDBName Nom de la base de données
	 * @param type $valUser Utilisateur
	 * @param type $valPwd Mot de passe de l'utilisateur
	 */
	protected function __construct($valServer, $valDBName, $valUser, $valPwd)
	{
		$this->server = $valServer;
		$this->dbName = $valDBName;
		$this->user = $valUser;
		$this->pwd = $valPwd;
	}
	
	/**
	 * Destructeur
	 */
	function __destruct()
	{
		$this->disconnect();
	}
	
	/**
	 * Connexion à la base de données
	 * @return True si la connexion a réussi, false sinon
	 */
	protected function connect()
	{
		$valRet = false;
		
        try {
            $this->link = new PDO('mysql:host='.$this->server.';dbname='.$this->dbName.';charset=utf8', $this->user,                    $this->pwd);
            $valRet = true;
            } catch(Exception $e) {
                die('Erreur : '.$e->getMessage());
            }
		return $valRet;
	}
	
	/**
	 * Déconnexion de la base de données
	 */
	protected function disconnect()
	{
		$this->link = null;
	}
	
	/**
	 * Execute une requete de type SELECT
	 * @param type $requete Requete SQL à exéctuer
     * @param type $params Liste de paramètres à intégrer à la requete ( ['name' => 'nom parametre', 'value' => 'valeur du paramètre', 'type' => 'type du paramètre'] )
	 * @param type $resultat Résultat obtenu
	 * @return True si la requete a retourné des résultats, false sinon
	 */
	public function get($requete, &$resultat, $params = array())
	{
		$valRet = false;
		
		if($this->link)
		{
            if(count($params))
            {
			    $query = $this->link->prepare($requete);

                foreach($params as $param)
                {
                    $query->bindValue($param['name'], $param['value'], $this->getPDOType($param['type']));
                }

                $statement = $query->execute();

                if($statement !== false)
                {			
                    $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
                }
            }
            else
            {
                $statement = $this->link->query($requete);

                if($statement !== false)
                {
                    $resultat = $statement->fetchAll(PDO::FETCH_ASSOC);
                }
            }
		
            if(count($resultat))
                $valRet = true;
		}
		
		return $valRet;
	}
	
	/**
	 * Exécute une requete de type UPDATE, INSERT, DELETE (sans retour de résultat)
	 * @param $requete Requete à exéctuer
     * @param $params Liste de paramètres à intégrer à la requete ( ['name' => 'nom parametre', 'value' => 'valeur du paramètre', 'type' => 'type du paramètre'] )
     * @return True si la requete a correctement été exécuté, false sinon.
	 */
	public function execute($requete, $params = array())
	{
		$valRet = false;
						
		if($this->link) {
            if(count($params)) {
			    $query = $this->link->prepare($requete);

                foreach($params as $param)
                {
                    $query->bindValue($param['name'], $param['value'], $this->getPDOType($param['type']));
                }
                $valRet = $query->execute() !== false;
                
            } else {
                $valRet = $this->link->query($requete) !== false;
            }
		}
		
		return $valRet;
	}
    
    /**
	 * Exécute une requete INSERT et retourne l'id de l'objet inséré
	 * @param $requete Requete à exécuter
     * @param $params Liste de paramètres à intégrer à la requete ( ['name' => 'nom parametre', 'value' => 'valeur du paramètre', 'type' => 'type du paramètre'] )
     * @return l'id de l'objet
	 */
    public function insert($requete, $params = array())
	{
		$valRet = false;
						
		if($this->link) {
            if(count($params)) {
			    $query = $this->link->prepare($requete);

                foreach($params as $param)
                {
                    $query->bindValue($param['name'], $param['value'], $this->getPDOType($param['type']));
                }

                 $valRet = $query->execute() !== false;
                return $this->link->lastInsertId();
            } else {
                $valRet = $this->link->query($requete) !== false;
            }
		}
		
		return $valRet;
	}

    /**
     * Retourne le type PDO corespondant au type demandé
     * @param mixed $type Type demandé
     * @return integer Constante correspondant au type PDO
     */
    function getPDOType($type)
    {
        $valRet = '';

        if($type == 'bool')
            $valRet = PDO::PARAM_BOOL;
        else if($type == 'int')
            $valRet = PDO::PARAM_INT;
        else
            $valRet = PDO::PARAM_STR;

        return $valRet;
    }
    
    /**
     * Renvoie la dernière clé primaire générée lors du dernier insert réalisé
     */
    public function getLastId()
    {   
        if($this->link)
        {
            return $this->link->lastInsertId();
        }
        
        return 0;
    }

    /**
     * Renvoie un identifiant unique au format UUID
     * @return mixed valeur de l'identifiant au format UUID
     */
    public function getUUID()
    {
        if($this->link)
        {
            $result = $this->link->query("SELECT UUID() as id;");
            
            $array = $result->fetch();
            
            return $array['id'];
        }

        return '';
    }
}
?>