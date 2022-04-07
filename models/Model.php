<?php

/**
 * Class Model hérite de 'Database.php', prépare les requêtes génériques aux models 
 */
class Model extends Database
{
    //Table de la base de donnée
    protected $table;

    //Instance de la Database
    protected $database;

    /**
     * Gestion des préparations et execute des requetes en fonctions des attributs
     *
     * @param [type] $sql
     * @param array|null $attributs
     * @return void
     */
    public function requete($sql, ?array $attributs = null){
    
        //On récupere l'instance de database
        $this->database = DataBase::getPdo();
        // var_dump($sql);
        //On vérifie si on a des attributs 
        if ($attributs !== null){
            //requête préparée
            $query = $this->database->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            //requête simple
            return $this->database->query($sql);
        }
    }

    /**
     * Trouver une annonce selon un id
     * $annonce->find(10) recupère toutes les informations de l'annonce dont l'id = 10
     * 
     * @param integer $id
     * @return this->requete
     */
    public function find($id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

    

     /**
     * Trouver des lignes de la table en fonction de critéres
     * findBy(['actif' => 15])
     * 
     * @param array $criteres
     * @return requete
     */
    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach($criteres as $champ => $valeur){
            //SELECT * FROM annonces where actif = ? AND signale = 0
            //bindValue(1, valeur);
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }

        // On transforme le tableau champs en chaine de caractére
        $liste_champs = implode(' AND ', $champs);

        // On éxecute la requête 
        return $this->requete('SELECT * FROM '.$this->table.' WHERE '. $liste_champs, $valeurs)->fetchAll();
    }

         /**
     * Effacer des lignes de la table en fonction de critéres
     * deleteBy(['actif' => 15])
     * 
     * @param array $criteres
     * @return requete
     */
    public function deleteBy(array $criteres)
    {

        $champs = [];
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach($criteres as $champ => $valeur){
            //SELECT * FROM annonces where actif = ? AND signale = 0
            //bindValue(1, valeur);
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }

        // On transforme le tableau champs en chaine de caractére
        $liste_champs = implode(' AND ', $champs);

        // On éxecute la requête 
        return $this->requete('DELETE FROM '.$this->table.' WHERE '. $liste_champs, $valeurs);
    }


    /**
     * Trouver toutes les informations d'une table
     *
     * @return void
     */
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM '. $this->table);
        $find_all = $query->fetchAll();
        // var_dump($find_all);
        return $find_all;
    }

    /**
     * Trouver toutes les informations d'une table
     *
     * @return void
     */
    public function countAll()
    {
        $query = $this->requete('SELECT COUNT(*) FROM '. $this->table);
        $find_all = $query->fetchAll();
        // var_dump($find_all);
        return $find_all;
    }

    /**
     * Crée une annonce/user 
     *
     * @return void
     */
    public function create(model $model) 
    {
        $champs = [];
        $inter = [];
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach($this as $champ => $valeur){
            // INSERT INTO annonces (titre, description, actif) values (?,?,?)
            
            if($valeur != null && $champ != 'database' && $champ != 'table'){
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
            
        }

        //transformer la tableau champs en chaine de caractére
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        //On éxecute la requête 
        return $this->requete('INSERT INTO '.$this->table.' ('.$liste_champs.') VALUES ('.$liste_inter.')', $valeurs);
    }

    /**
     * Update des informations d'une annonce/user selon un id
     *
     * @return void
     */
    public function update(model $model)
    {
        $champs = [];
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach($this as $champ => $valeur){
            //UPDATE annonces SET titre = ?, description = ?, actif = ? WHERE id = ?
            
            if($valeur != null && $champ != 'database' && $champ != 'table'){
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $this->id;
        //transformer la tableau champs en chaine de caractére
        $liste_champs = implode(', ', $champs);

        //On éxecute la requête 
        return $this->requete('UPDATE '.$this->table.' SET '. $liste_champs .' WHERE id =?', $valeurs);
    }

    /**
     * Supprime une annonce/user selon un id
     *
     * @param integer $id
     * @return requete
     */
    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id =?", [$id]);
    }


    //Requête générique Inner Join en développement
    
    // public function innerJoin(array $criteres, string $tableJoin, string $where1, string $where2)
    // {
    //     $champs = [];
    //     foreach ( $criteres as $champ)
    //     {
    //         $champs[] = $champ;
    //     }

    //     $liste_champ = implode(',', $champs);
    //     //On éxecute la requête 
    //     return $this->requete('SELECT '.$liste_champ.' FROM '. $this->table.' INNER JOIN '. $tableJoin.' WHERE '.$this->table.'.'.$where1.' = '.$tableJoin.'.'.$where2.'')->fetchAll();
    // }
}