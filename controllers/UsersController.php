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

        // Si le formulaire est envoyé
        if ( isset ($_POST['submit']))
        {    
            if ( !empty($_POST['email']))
            {
                if ( !empty ($_POST['surname']))
                {
                    if ( !empty ($_POST['name']))
                    {
                        if ( !empty ($_POST['password']))
                        {
                            if ( !empty ($_POST['validPassword'])){

                                // Sécurisation des password et récupération dans des variables
                                $password = valid_data($_POST['password']);
                                $validPassword = valid_data($_POST['validPassword']);

                                // Vérification des passwords
                                if ( $password === $validPassword){

                                    // Sécurisation des données du formulaire
                                    $email = valid_data($_POST['email']);
                                    $surname = valid_data($_POST['surname']);
                                    $name = valid_data($_POST['name']);
                                    // Vérification de l'unicité des Emails en base de données
                                    $model = new UsersModel();
                                    $valid_email = $model->findBy(['email' => $email]);

                                    // Si l'E-mail n'existe pas
                                    if ( empty ($valid_email) ){
                                        $password_hash = password_hash($password, PASSWORD_DEFAULT);

                                        $adresse = valid_data($_POST['adresse']);

                                        // On crée un nouveau UserModel
                                        $model = new UsersModel();

                                        // On récupère les informations entrées en formulaire
                                        $user = $model
                                        ->setNom($name)
                                        ->setPrenom($surname)
                                        ->setEmail($email)
                                        ->setPassword($password_hash)
                                        ->setAdresse($adresse);
                                        
                                        // On inscrit l'utilisateur en base de données
                                        $user->create($model);
                                        // On le redirige vers la connection
                                        header ('location: login');

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
     * Fonction Login fonction de connexion de l'utilisateur, création d'une session
     *
     * @return résultat_requete
     */
    public static function login(){

        $error_email = "";
        $error_password = "";
        $error = "";

        if ( isset ( $_POST['submit']))
        {
            if ( !empty ($_POST['email']))
            {
                if ( !empty ( $_POST['password']))
                {
                    $password = valid_data($_POST['password']);
                    $email = valid_data($_POST['email']);

                    $user = new UsersModel();
                    $data_user = $user->findBy(['email' => $email]);

                    if ( !empty ( $data_user ))
                    {
                        if ( password_verify($password, $data_user[0]->password) )
                        {
                            $_SESSION['user_data'] = 
                            [
                                'id' => $data_user[0]->id,
                                'email' => $data_user[0]->email,
                                'nom' => $data_user[0]->nom,
                                'prenom' => $data_user[0]->prenom,
                                'adresse' => $data_user[0]->adresse
                            ];
                            var_dump($_SESSION['user_data']);
                            // header ('location: ../index');

                        } else {
                            $error = "Login/Mot de passe incorrect";
                        }
                    } else {
                        $error = "Login/Mot de passe incorrect";
                    }
                } else {
                    $error_password = "Veuillez insérer un password";
                }
            } else {
                $error_email = "Veuillez insérer un E-mail";
            }
        }
        Renderer::render('users/login' , compact('error_email' , 'error_password' , 'error'));
    }

    public static function disconnect()
    {
        session_destroy();
        header('location: ../index');
    }

    public static function selectUser(){
        $model = new UsersModel();
        $userData = $model->find(2);
        var_dump($userData);
    }


    public static function updateProfil()
    {
        $model = new UsersModel();
        
        $user = $model
            // ->setId(2)
            // ->SetNom('Max')
            // ->setPrenom('Max')
            ->setAdresse('Marseille')
            ->setEmail('Max')
            ->setPassword('Max');
        var_dump($user);
        // var_dump($user->update($model));

        Renderer::render('users/profil' , compact('user'));
    }

    public static function deleteUser(){
        $model = new UsersModel();
        var_dump($delete = $model->delete(8));
        
    } 
}