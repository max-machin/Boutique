<?php

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

class ConcoursController extends Controller
{
    public static function concoursRegister(){

        $error = "";
        $success = "";
        if (isset ($_POST['submit']))
        {
            if ( !empty($_POST['email']))
            {
                if ( !empty($_POST['surname']))
                {
                    if ( !empty($_POST['adresse']))
                    {
                        if ( !empty($_POST['codePostale']))
                        {
                            if ( !empty($_POST['ville']))
                            {
                                $email = valid_data($_POST['email']);

                                $find = new ConcoursModel();
                                $findUser = $find->findBy(['email' => $email]);

                                if ( empty ($findUser))
                                {
                                    $prenom = valid_data($_POST['surname']);

                                    $adresse = valid_data($_POST['adresse']);
                                    $ville = valid_data($_POST['ville']);
                                    $codePostale = valid_data($_POST['codePostale']);

                                    $livraison = $adresse." ".$codePostale." ".$ville;


                                    $user = new ConcoursModel();
                                    $newUser = $user
                                        ->setEmail($email)
                                        ->setPrenom($prenom)
                                        ->setAdresse($livraison);
                                    $newUser->create($user);

                                    $success = '<div class="success" style="width: 60%; margin: auto;"> <i class="fa-solid fa-thumbs-up"></i> Bravo, vous êtes désormais inscrit au concours</div>';
                                } else {
                                    $error = "Bien tenté! Mais vous participez déjà au concours...";
                                }
                            } else {
                                $error = "Veuillez entrer une ville";
                            }
                        } else {
                            $error = "Veuillez entrer votre code postale";
                        }
                    } else {
                        $error = "Veuillez entrer votre adresse";
                    }
                } else {
                    $error = "Veuillez entrer votre prénom";
                }
            } else {
                $error = "Veuillez entrer une adresse E-mail";
            }
        }

        // Date Anglaise donc prévoir une heure avant , doit être égale à l'heure de JS
        // ! SUR PLESK PAS BESOIN DE METTRE UNE HEURE DE MOINS
        $dateDebut = new DateTime("01-04-2022 10:20:00");
        $dateActuelle = new DateTime(date("d-m-Y H:i:s"));
        if($dateDebut < $dateActuelle){
            if (!isset ($winner)){
                $user = new ConcoursModel();
                $winner = $user->findWinner();
            }
        }
        Renderer::render('concours/concours', compact('error', 'success', 'winner'));
    }
}

