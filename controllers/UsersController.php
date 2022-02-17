<?php

require_once('libraries/Render.php');

class UsersController extends Controller
{  

    public static function selectAll(){
        echo "je suis dans le UsersController";
        $user = new UsersModel();
        $user->lol();
        return $user;
        Render::render('user');
    
    }

    // public static function  find()
    // {
    //     echo "gloss";
    // }
}