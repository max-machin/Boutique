<?php

require_once('libraries/Renderer.php');

class UsersController extends Controller
{  

    /**
     * Fonction selectAll (fonction permettant de selectionner la totalité de données de la table du Model)
     *
     * @return résultat_requete
     */
    public static function selectAllUsers(){
        $model = new UsersModel();
        $users = $model->findAll();
        var_dump($users);
    }

    public static function selectUser(){
        $model = new UsersModel();
        $userData = $model->find(2);
        var_dump($userData);
    }

    public static function createUser(){
        $model = new UsersModel();
        $user = $model
            ->SetNom('Max')
            ->SetPrenom('Max')
            ->SetEmail('Max')
            ->SetPassword('Max');
        var_dump($user);
        // var_dump($user->create($model));
    }

    public static function updateUser()
    {
        $model = new UsersModel();
        
        $user = $model
            ->setId(2)
            ->SetNom('Max')
            ->setPrenom('Max')
            ->setAdresse('Marseille')
            ->setEmail('Max')
            ->setPassword('Max');
        var_dump($user);
        var_dump($user->update($model));
    }

    public static function deleteUser(){
        $model = new UsersModel();
        var_dump($delete = $model->delete(8));
        
    }

}