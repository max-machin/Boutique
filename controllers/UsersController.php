<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once ('libraries/phpmailer/Exception.php');
require_once ('libraries/phpmailer/PHPMailer.php');
require_once ('libraries/phpmailer/SMTP.php');

// Validation des données
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


                                        // On crée un nouveau UserModel
                                        $model = new UsersModel();

                                        // On récupère les informations entrées en formulaire
                                        $user_data = $model
                                        ->setNom($name)
                                        ->setPrenom($surname)
                                        ->setEmail($email)
                                        ->setPassword($password_hash);
                                        
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
                            ];
                            $_SESSION['user_data']['promo'] = NULL;
                            header ('location: profil');

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
        header('location: ../accueil');
    }

    /**
     * UpdateProfil Fonction permettant à l'utilisateur de modifier ses informations personnelles
     * Séparer en deux formulaires disctincts (infos & mot de passe)
     * Demande de confirmation de l'ancien mot de passe pour modification de ce dernier.
     * Affichage des commandes passés précedemment
     * Affichage des commentaires de l'utilisateur et possibilité de les supprimer
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

                $_SESSION['user_data']['email'] = $email;

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

                $_SESSION['user_data']['prenom'] = $prenom;
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

                $_SESSION['user_data']['nom'] = $nom;
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
        
        $model = new CommandsModel();
        $userCommands = $model->findCommand($_SESSION['user_data']['id']);

        $products = new FavorisModel();
        $userProducts = $products->userFavoris($_SESSION['user_data']['id']);

        $comments = new CommentsModel();
        $userComments = $comments->userComments($_SESSION['user_data']['id']);

        if ( isset ( $_POST['deleteComment']) )
        {
            $delete = new CommentsModel();
            $deleteComment = $delete->deleteBy(['id' => $_POST['id_comment']]);
            header('Refresh: 0');
        }
        

        Renderer::render('users/profil' , compact('user', 'error_new_password', 'error_validPassword', 'error_old_password', 'display1' , 'display2', 'userCommands', 'userProducts','userComments'));
    }

    /**
     * Fonction de récupération du mot de passe par Mail
     *
     * @return void
     */
    public static function forgotPassword()
    {
        $errorMail = "";
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
                    $errorMail =  "Il y a eu une erreur lors de l'envoi de l'email.";
                    echo 'Mailer error: ' . $mail->ErrorInfo;
                }
                else
                {
                    $errorMail = 'Le mail a été envoyer avec succés. Consultez vos courriels indésirables';
                }

            }
        } 
        Renderer::render('users/forgotPassword', compact('errorMail'));
    }
    /**
     * Fonction d'affichage de la commande user en fonction du panier user 
     * Possibilité dans cette fonction pour l'user d'ajouter un code PROMO sur sa commande afin de bénficier d'une réduction
     *
     * @return void
     */
    public static function seeCommand()
    {
        $error = "";

        $model = new BagsModel();
        $command = $model->checkBag($_SESSION['user_data']['id']);

        foreach ($command as $table){
            $model = new BagsModel();
            $images = $model->findImages($_SESSION['user_data']['id'], $table['id']);
        }

        $modelColors = new BagsModel();
        $commandColors = $modelColors->checkBagColors($_SESSION['user_data']['id']);

        foreach ($commandColors as $tables){
            $model = new BagsModel();
            $imagesColors = $model->findImages($_SESSION['user_data']['id'], $tables['id']);
          
        }
        
        $find = new DeliveriesModel();
        $findDeliveries = $find->findAll();

        // Si l'utilisateur n'est pas connecté alors on le redirige vers le login
        if ( empty ( $_SESSION['user_data']) )
        {
            header('location: login');
        }

        // Ajout d'un code PROMO sur la commande
        if ( isset($_POST['promo']))
        {
            // Si le code n'est pas vide
            if ( !empty ($_POST['codePromo']) )
            {
                // Si le code correspond
                if ( $_POST['codePromo'] === codePromo)
                {
        
                    $_SESSION['user_data']['promo'] = 1;
                    
                }
            }
        } 
        if ( isset ($_POST['paiement_button']))
        {
            // Si les informations de livraisons de sont pas remplis
            if ( empty ($_POST['adresse']) || empty ($_POST['ville']) || empty ($_POST['codePostale']) || empty ($_POST['facturation']) || empty ( $_POST['mode']))
            {
                $error = "Veuillez remplir les informations de livraison";
            }
        }
        Renderer::render('users/commands', compact('command','commandColors' ,'error', 'findDeliveries', 'images', 'imagesColors'));
    } 

    /**
     * Fonction permettant à l'utilisateur de procéder au paiment de sa commande à l'aide de STRIPE
     *
     * @return void
     */
    public static function paiement() 
    {
        // Si toutes les informations de livraisons ont été correctement remplies
        if ( !empty ($_POST['adresse']) && !empty($_POST['facturation']) && !empty ($_POST['ville']) && !empty ($_POST['codePostale']))
        {   
            // Sécurisation des données
            $adresse = valid_data($_POST['adresse']);
            $ville = valid_data($_POST['ville']);
            $codePostale = valid_data($_POST['codePostale']);


            // On concatene 'l'adresse' + 'le code postale' + 'la ville' afin de le rentrer en BDD en tant que colonne unique
            // ex = 13 av de marseille 13000 Marseille 
            $_SESSION['user_data']['livraison'] = $adresse." ".$codePostale." ".$ville;

            $_SESSION['user_data']['facturation'] = $_POST['facturation'];
            
            if ( isset($_POST['mode']))
            {
                $model = new DeliveriesModel();

                $find = $model->findBy(['mode' => $_POST['mode']]);

                $_SESSION['user_data']['deliveryMode'] = $_POST['mode'];

                $_SESSION['user_data']['deliveryPrice'] = $find[0]['price'];
                
            } else {
                $_SESSION['user_data']['deliveryMode'] = null;

                $_SESSION['user_data']['deliveryPrice'] = null;
            }

            // Si un prix est définit / différent de vide = commande vide
            if ( isset ( $_POST['prix']) && !empty ( $_POST['prix']))
            {
                require_once('vendor/autoload.php');
                $prix = ($_POST['prix']);

                // On insctancie stripe
                \Stripe\Stripe::setApiKey('sk_test_51KZXuDJm5576Uzo35LWKkxbWACB19bTEv0cn494ONQLuQqfQd7GHXeCWMp2LxLUbbCikvt6siO7nY5TdBdaMeFcd00Hl7keAL2');

                $intent = \Stripe\PaymentIntent::create([
                'amount' => intval($prix)*100,
                'currency' => 'eur'
            ]);
            // On redirige vers la page commande car vide
            } else {
                header('location: commands');
            }
        // On redirige vers la page commande car informations mal remplis
        } else {
            header('location: commands');
        }
            Renderer::render('users/paiement', compact('intent'));
    }

    public static function successCommand()
    {
        $model = new BagsModel();

        $command = $model->checkCommandBag($_SESSION['user_data']['id']);

        // Vérification que la commande n'est pas vide 
        if (isset($command)){
            // Si la commande n'est pas vide
            if ( !empty ($command))
            {
                // On récupère le plus grand numéro de commande et on l'incrémente pour la prochaine commande à entrer en BDD
                $check = new CommandsModel();
                $checkNum = $check->checkNumCommand();
                $numCommand = intval($checkNum['MAX(id_command)'])+1;
                
                // Si l'utilisateur a entré un code PROMO
                if ( $_SESSION['user_data']['promo'] === 1){
                    // Insertion de la commande avec PROMO ( totalité de la table bags + infos par rapport à l'id user)
                    foreach ($command as $product)
                    {
                        $promo = 15;
                        
                        $insert = new CommandsModel();
                        $insertCommand = $insert
                            ->setPrice($product['price'])
                            ->setTotal_price($product['price'] * $product['quantity_product'])
                            ->setId_user($_SESSION['user_data']['id'])
                            ->setId_command($numCommand)
                            ->setId_product($product['id'])
                            ->setId_color($product['id_color'])
                            ->setPromo($promo)
                            ->setQuantity_product($product['quantity_product'])
                            ->setAdresse_livraison($_SESSION['user_data']['livraison'])
                            ->setAdresse_facturation($_SESSION['user_data']['facturation'])
                            ->setPrice_livraison($_SESSION['user_data']['deliveryPrice'])
                            ->setMode($_SESSION['user_data']['deliveryMode']);
                        $insertCommand->create($insert);
                    }
                } else {
                    // Insertion de la commande sans PROMO ( totalité de la table bags + infos par rapport à l'id user)
                    foreach ($command as $product)
                    {
                        $promo = 0;
  
                        $insert = new CommandsModel();
                        $insertCommand = $insert
                            ->setPrice($product['price'])
                            ->setTotal_price($product['price'] * $product['quantity_product'])
                            ->setId_user($_SESSION['user_data']['id'])
                            ->setId_command($numCommand)
                            ->setId_product($product['id'])
                            ->setId_color($product['id_color'])
                            ->setQuantity_product($product['quantity_product'])
                            ->setPromo($promo)
                            ->setAdresse_livraison($_SESSION['user_data']['livraison'])
                            ->setAdresse_facturation($_SESSION['user_data']['facturation'])
                            ->setPrice_livraison($_SESSION['user_data']['deliveryPrice'])
                            ->setMode($_SESSION['user_data']['deliveryMode']);
                        $insertCommand->create($insert);
                    }
                }
                // On vide le panier car insérer en base de données dans la table COMMANDS
                $delete = new BagsModel();
                $deleteBag = $delete->deleteBy(['id_user' => $_SESSION['user_data']['id']]);

               
            // Redirection vers le panier car commande vide 
            } else {
                header('location: ../bags');
            }
        }
        // Remise à null de la command car payé et insérer en BDD
        // Réinitialisation des variables plus nécessaires
        $command = NULL;
        $_SESSION['user_data']['promo'] = 0;
        unset($_SESSION['user_data']['livraison']);
        unset($_SESSION['user_data']['facturation']);
        unset($_SESSION['user_data']['deliveryMode']);
        unset($_SESSION['user_data']['deliveryPrice']);

        Renderer::render('users/successCommand' , compact('command'));
    }
}