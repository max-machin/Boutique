<?php

/**
 * Class Model hérite de 'Database.php', prépare les requêtes génériques aux models 
 */
class Model extends Database
{
    //Table de la base de donnée
    protected $table;

    //Instance de la Database
    private $database;


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

        //On vérifie si on a des attributs 
        if ($attributs !== null){
            // var_dump($attributs);
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
     * Trouver toutes les informations d'une table
     *
     * @return void
     */
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM '. $this->table);
        var_dump($query);
        return $query->fetchAll();
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
}