<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once ('libraries/phpmailer/Exception.php');
require_once ('libraries/phpmailer/PHPMailer.php');
require_once ('libraries/phpmailer/SMTP.php');


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
     * 
     * Fonction register Enregistre un user en base de données aprés vérification et sécurisation des données entrée en formulaire
     *
     * @return void
     */
    public static function register(){

        // Création des valeurs pas défault des variables utilisées
        $error_email = "";
        $error_name = "";
        $error_surname = "";
        $error_adresse = "";
        $error_password = "";
        $error_validPassword = "";

        // Validation du formulaire
        if ( isset ($_POST['submit']))
        {    
            // Vérification des champs
            if ( !empty($_POST['email']))
            {
                // Vérification des champs
                if ( !empty ($_POST['surname']))
                {
                    // Vérification des champs
                    if ( !empty ($_POST['name']))
                    {
                        // Vérification des champs
                        if ( !empty ($_POST['password']))
                        {
                            // Vérification des champs
                            if ( !empty ($_POST['validPassword'])){

                                // Sécurisation des données
                                $password = valid_data($_POST['password']);
                                $validPassword = valid_data($_POST['validPassword']);

                                // Vérification de la correspondance des mot de passe
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
                                        // Hashage du mot de passe avant insertion en base de données
                                        $password_hash = password_hash($password, PASSWORD_DEFAULT);

                                        // Sécurisation des données
                                        $adresse = valid_data($_POST['adresse']);

                                        // On crée un nouveau UserModel
                                        $model = new UsersModel();

                                        // On récupère les informations entrées en formulaire
                                        $user_data = $model
                                        ->setNom($name)
                                        ->setPrenom($surname)
                                        ->setEmail($email)
                                        ->setPassword($password_hash)
                                        ->setAdresse($adresse);
                                        
                                        // On inscrit l'utilisateur en base de données
                                        $user_data->create($model);
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
        // Création des valeurs pas défault des variables utilisées
        $error_email = "";
        $error_password = "";
        $error = "";

        // Validation du formulaire
        if ( isset ( $_POST['submit']))
        {
            // Vérification des champs
            if ( !empty ($_POST['email']))
            {
                // Vérification des champs
                if ( !empty ( $_POST['password']))
                {
                    // Sécurisation des données
                    $password = valid_data($_POST['password']);
                    $email = valid_data($_POST['email']);

                    // Création du model et vérification de l'existance de l'Email inscrit en POST
                    $login = new UsersModel();
                    $data_user = $login->findBy(['email' => $email]);

                    // Si des données sont récupérées
                    if ( !empty ( $data_user ))
                    { 
                        // Si le mot de passe entré en POST correspond au password connu en base de données déhasher
                        if ( password_verify($password, $data_user[0]['password']) )
                        {
                            // On conserve les infos user en $_SESSION
                            $_SESSION['user_data'] = 
                            [
                                'id' => $data_user[0]['id'],
                                'email' => $data_user[0]['email'],
                                'nom' => $data_user[0]['nom'],
                                'prenom' => $data_user[0]['prenom'],
                                'adresse' => $data_user[0]['adresse']
                            ];
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

    /**
     * Fonction disconnect Destroy la $_SESSION de l'utilisateur et et le redirige vers l'index
     *
     * @return void
     */
    public static function disconnect()
    {
        session_destroy();
        header('location: ../index');
    }

    /**
     * UpdateProfil Fonction permettant à l'utilisateur de modifier ses informations personnelles
     * Séparer en deux formulaires disctincts (infos & mot de passe)
     * Demande de confirmation de l'ancien mot de passe pour modification de ce dernier.
     *
     * @return void
     */
    public static function updateProfil()
    {
        // Création des valeurs pas défault des variables utilisées
        $error_old_password = "";
        $error_new_password = "";
        $error_validPassword = "";
        $display1 = "";
        $display2 = "none";

        // Création du model user 
        $model = new UsersModel();
        
        // Récupération des informations de l'utilisateur à l'aide de son id
        $user = $model->find($_SESSION['user_data']['id']);

        // Si le formulaire d'infos est envoyé
        if ( isset ($_POST['submit']))
        {
            // Si le champ E-mail est bien rempli
            if ( !empty ( $_POST['email']))
            {
                // On sécurise les données 
                $email = valid_data($_POST['email']);

                // On set les valeurs dans le model user précedemment crée
                $users = $model
                    ->setId($_SESSION['user_data']['id'])
                    ->setEmail($email);

                // Puis on update les infos et on rafraichit la page pour affichage des informations à jour
                $users->Update($model);
                header('refresh: 0');
            }

            // Même fonctionnement que pour l'E-mail
            if ( !empty ( $_POST['surname']))
            {
                // Sécurisation des données
                $prenom = valid_data($_POST['surname']);

                $users = $model

                    ->setId($_SESSION['user_data']['id'])
                    ->setPrenom($prenom);

                $users->Update($model);
                header('refresh: 0');
            }
            
            // Même fonctionnement que pour l'E-mail
            if ( !empty ( $_POST['name']))
            {
                // Sécurisation des données
                $nom = valid_data($_POST['name']);

                $users = $model

                    ->setId($_SESSION['user_data']['id'])
                    ->setNom($nom);

                $users->Update($model);
            }
        }
        // FORMULAIRE NOUVEAU MOT DE PASSE
        elseif ( isset ( $_POST['subPassword']))
        {
            // Vérification des champs
            if ( !empty ( $_POST['oldPassword']))
            {
                // Sécurisaion des données
                $password = valid_data($_POST['oldPassword']);

                // On récupère les informations de l'utilisateur concerné
                $users = $model->find($_SESSION['user_data']['id']);

                // Si le mot de passe entré en POST correspond à celui en base de données alors on donne accés au formulaire de modif
                if ( password_verify( $password, $users['password'] ) )
                {
                    $display2 = "block";
                    $display1 = "none";
                } else {
                    $error_old_password = "Ancien mot de passe incorrect";
                }
            } else {
                $error_old_password = "Veuillez remplir le champ";
            }
        }

        // FORMULAIRE MODIFICATION NOUVEAU MOT DE PASSE
        elseif ( isset ( $_POST['subNewPassword']))
        {
            // Vérification des champs
            if ( !empty ( $_POST['newPassword']))
            {
                // Vérification des données
                if ( !empty ( $_POST['validPassword']))
                {
                    // Sécurisation des données
                    $newPassword = valid_data($_POST['newPassword']);
                    $validPassword = valid_data($_POST['validPassword']);

                    if ( $newPassword == $validPassword )
                    {
                        var_dump($_POST);
                        $hash = password_hash( $newPassword, PASSWORD_DEFAULT );

                        $users = $model
                            ->setId($_SESSION['user_data']['id'])
                            ->setPassword($hash);
                        
                        $users->Update($model);
                    } else {
                        $error_validPassword = "Validation de mot de passe échouée";
                        $display2 = "block";
                        $display1 = "none";
                    }
                } else {
                    $error_validPassword = "Veuillez valider votre mot de passe";
                    $display2 = "block";
                    $display1 = "none";
                }
            } else {
                $error_new_password = "Veuillez remplir le champ";
                $display2 = "block";
                $display1 = "none";
            }
        }

        $command = new CommandsModel();
        $userCommand = $command->userCommand( $_SESSION['user_data']['id']);
       

        Renderer::render('users/profil' , compact('user', 'error_new_password', 'error_validPassword', 'error_old_password', 'display1' , 'display2', 'userCommand'));
    }

    /**
     * Fonction de récupération du mot de passe par Mail
     *
     * @return void
     */
    public static function forgotPassword()
    {
        // Envoi du formulaire
        if ( isset ( $_POST['sendPassword'] ) )
        {
            // Vérification des champs
            if ( isset ( $_POST['email']))
            {
                // Création du nouveau password
                $newPassword = uniqid ();
                
                // Hachage du password précédemment crée
                $hashedPassword = password_hash ( $newPassword, PASSWORD_DEFAULT );

                // Sécuristaion des données
                $email = valid_data($_POST['email']);

                // Instanciation du Model User pour update password
                $model = new UsersModel();
                
                // Update du password
                $model->emailPassword($hashedPassword, $email);
            
                // Envoi du mail
                // Création du nouveau Model de PHPMailer
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->From = "everglowcosmeticscontact@gmail.com";
                $mail->FromName  =  "My name";
                $mail->AddAddress("$email");
                $mail->SMTPAuth = "true";
                $mail->Username = "everglowcosmeticscontact@gmail.com";
                $mail->Password =  "Everglow13";
                $mail->Port  =  "587";
                $mail->SMTPSecure = 'tls';
            
                $mail->Subject = "Nouveau mot de passe";
                $mail->Body = " Suite à votre demande de récupération de mot de passe.
                Votre nouveau mot de passe : $newPassword";
                $mail->WordWrap = 50;
            
                if(!$mail->Send())
                {
                    echo "Il y a eu une erreur lors de l'envoi de l'email.";
                    echo 'Mailer error: ' . $mail->ErrorInfo;
                }
                else
                {
                    echo 'Le mail a été envoyer avec succés. Consultez vos courriels indésirables';
                }

            }
        }
        Renderer::render('users/forgotPassword');
    }

    public static function seeCommand()
    {

        $_SESSION['user_data']['promo'] = NULL;
        $model = new BagsModel();
        $command = $model->checkBag($_SESSION['user_data']['id']);
        if ( empty ( $_SESSION['user_data']) )
        {
            header('location: login');
        }

        if ( isset($_POST['promo']))
        {
            if ( !empty ($_POST['codePromo']) )
            {
                if ( $_POST['codePromo'] === codePromo)
                {
                    foreach ($command as $product) 
                    {
                        $_SESSION['user_data']['promo'] = 1;
                    }
                }
            }
        } 

        Renderer::render('users/commands', compact('command'));
    } 

    public static function paiement() 
    {
        
        if ( isset ( $_POST['prix']) && !empty ( $_POST['prix']))
        {
            require_once('vendor/autoload.php');
            $prix = ($_POST['prix']);

            // On insctancie stripe
            \Stripe\Stripe::setApiKey('sk_test_51KZXuDJm5576Uzo35LWKkxbWACB19bTEv0cn494ONQLuQqfQd7GHXeCWMp2LxLUbbCikvt6siO7nY5TdBdaMeFcd00Hl7keAL2');

            $intent = \Stripe\PaymentIntent::create([
               'amount' => $prix*100,
               'currency' => 'eur'
           ]);
        } else {
            header('location: commands');
        }
        Renderer::render('users/paiement', compact('intent'));
    }

    public static function successCommand()
    {
        $model = new BagsModel();

        $command = $model->checkCommandBag($_SESSION['user_data']['id']);

        

        $DateAndTime = date('m-d-Y h:i:s');
        if (isset($command)){
            if ( !empty ($command))
            {
                $check = new CommandsModel();
                $checkNum = $check->checkNumCommand();
                $numCommand = intval($checkNum['MAX(id_command)'])+1;
                
                if ( isset ( $_SESSION['user_data']['promo'])){
                    foreach ($command as $product)
                    {
                        $promo = 15;
                        $insert = new CommandsModel();
                        $insertCommand = $insert
                            ->setPrice($product['price'])
                            ->setId_user($_SESSION['user_data']['id'])
                            ->setId_command($numCommand)
                            ->setId_product($product['id'])
                            ->setPromo($promo)
                            ->setQuantity_product($product['quantity_product']);
                        $insertCommand->create($insert);
                    }
                } else {
                    foreach ($command as $product)
                    {
                        $insert = new CommandsModel();
                        $insertCommand = $insert
                            ->setPrice($product['price'])
                            ->setId_user($_SESSION['user_data']['id'])
                            ->setId_command($numCommand)
                            ->setId_product($product['id'])
                            ->setQuantity_product($product['quantity_product']);
                        $insertCommand->create($insert);
                    }
                }
                
                $delete = new BagsModel();
                $deleteBag = $delete->deleteBy(['id_user' => $_SESSION['user_data']['id']]);

                unset($_SESSION['user_data']['promo']);

            } else {
                header('location: ../bags');
            }
        }
        $command = NULL;
        

        Renderer::render('users/successCommand' , compact('command'));
    }
}