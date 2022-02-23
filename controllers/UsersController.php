<?php
function valid_data($données)
{
    //trim permet de supprimer les espaces inutiles
    $données = trim($données);
    //stripslashes supprimes les antishlashs
    $données = stripslashes($données);
    //htmlspecialchars permet d'échapper certains caractéres spéciaux et les transforment en entité HTML
    $données = htmlspecialchars($données);
    return $données;
}


class UsersController extends Controller
{  

    
    /**
     * Fonction register Enregistre un user en base de données aprés vérification et sécurisation des données entrée en formulaire
     *
     * @return void
     */
    public static function register(){

        $error_email = "";
        $error_name = "";
        $error_surname = "";
        $error_password = "";
        $error_adresse = "";
        $error_validPassword = "";

        
        if ( isset ($_POST['submit'])){
            if ( !empty($_POST['email']))
            {
                if ( !empty ($_POST['surname']))
                {
                    if ( !empty ($_POST['name']))
                    {
                        if ( !empty ($_POST['password']))
                        {
                            if ( !empty ($_POST['validPassword'])){

                                $password = valid_data($_POST['password']);
                                $validPassword = valid_data($_POST['validPassword']);

                                if ( $password === $validPassword){
                                    $email = valid_data($_POST['email']);
                                    $surname = valid_data($_POST['surname']);
                                    $name = valid_data($_POST['name']);

                                    $model = new UsersModel();
                                    $valid_email = $model->findBy(['email' => $email]);

                                    if ( empty ($valid_email) ){

                                        $model = new UsersModel();

                                        $user = $model
                                        ->SetNom($name)
                                        ->SetPrenom($surname)
                                        ->SetEmail($email)
                                        ->SetPassword($password);
                                        var_dump($user);
                                        $user->create($model);

                                        header ('location: users/login');

                                    } else {
                                        $error_email = "E-mail déjà utilisé";
                                    }

                                } else {
                                    $error_validPassword = "Insérer deux mot de passe identiques";
                                }
                            
                            } else {
                                $error_validPassword = "Veuillez valider votre mot de passe";
                            }
                        } else {
                            $error_password = "Veuillez insérer un mot de passe";
                        }
                    } else {
                        $error_name = "Veuillez insérer un nom";
                    }
                } else {
                    $error_surname = "Veuillez insérer un prénom";
                }
            } else {
                $error_email = "Veuillez insérer un E-mail";
            }
        }
    
    Renderer::render('users/register' , compact( 'error_email' , 'error_surname' , 'error_name' , 'error_password' , 'error_validPassword'));
        // var_dump($user->create($model));
    }

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