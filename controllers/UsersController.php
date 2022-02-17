<?php

require_once('libraries/Renderer.php');

class UsersController extends Controller
{  

    public static function selectAll(){
        echo "je suis dans le UsersController";
        $user = new UsersModel();
        $users = ['1' => 1, '2' => 2];
        Renderer::render('user' , compact('users'));
    
    }

    // public static function  find()
    // {
    //     echo "gloss";
    // }
}